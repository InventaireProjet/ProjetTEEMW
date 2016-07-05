<?php
require_once 'class.Annonceur.php';
require_once 'class.Transporteur.php';
require_once 'class.MySqlConn.php';
class MySqlManager {
	private $_conn;
	public function __construct() {
		$this->_conn = new MySqlConn ();
	}
	public function enregistrerAnnonceur($Prenom, $Nom, $Utilisateur, $Mdp, $Telephone, $Email, $Adresse, $npa, $localite, $pays) {
		$Mdp = sha1 ( $Mdp );
		try {
			
			$this->_conn->getConnection ()->beginTransaction ();
		
			$query = "INSERT into Lieu (NPA, Localite, Pays)VALUES('$npa', '$localite', '$pays');";
			$this->_conn->executeQuery ( $query );
				
			$idLieu = $this->_conn->getLastId ();
			
			$query = "INSERT into Annonceur(Prenom, Nom, UserName,
		MotDePasse, Telephone, Email, Adresse, IDLieu)VALUES('$Prenom', '$Nom', '$Utilisateur', '$Mdp', '$Telephone', '$Email', '$Adresse','$idLieu');";
			$result= $this->_conn->executeQuery ( $query );
			
			$this->_conn->getConnection ()->commit ();
			return $result;
		} catch ( Exception $e ) {
			$this->_conn->getConnection ()->rollback ();
		}
	}
	public function enregistrerTransporteur($nomSociete, $telephone, $email, $username, $pwd, $adresse, $npa, $localite, $pays, $IBAN) {
		$pwd = sha1 ( $pwd );
		try {
			
			$this->_conn->getConnection ()->beginTransaction ();
			$query = "INSERT into Lieu (NPA, Localite, Pays)VALUES('$npa', '$localite', '$pays');";
			$this->_conn->executeQuery ( $query );
			
			$idLieu = $this->_conn->getLastId ();
			
			$query = "INSERT into Transporteur(NomSociete, Telephone, Email, Username, MotDePasse, Adresse, IDLieu, IBAN)
		VALUES('$nomSociete', '$telephone', '$email', '$username', '$pwd', '$adresse', '$idLieu', '$IBAN');";
			$result=$this->_conn->executeQuery ( $query );
			
			$this->_conn->getConnection ()->commit ();
			return $result;
		} catch ( Exception $e ) {
			$this->_conn->getConnection ()->rollback ();
		}
	}
	public function enregistrerTypesTransportTransporteur($idTypeTransport, $idTransporteur) {
		try {
			$this->_conn->getConnection ()->beginTransaction ();
			
			$query = "INSERT INTO RelationTransporteurTransportSet(IDTypeTransport, IDTransporteur)  VALUES ('$idTypeTransport', '$idTransporteur')";
			$this->_conn->executeQuery ( $query );
			
			$this->_conn->getConnection ()->commit ();
			return true;
		} catch ( Exception $e ) {
			$this->_conn->getConnection ()->rollback ();
		}
	}
	public function VerifierLoginAnnonceur($uname, $pwd) {
		$pwd = sha1 ( $pwd );
		$query = "SELECT * FROM Annonceur WHERE UserName='$uname' AND
		MotDePasse='$pwd'";
		$result = $this->_conn->selectDB ( $query );
		$row = $result->fetch ();
		if (! $row)
			return false;
		return new Annonceur ( $row ['IDAnnonceur'], $row ['Prenom'], $row ['Nom'], $row ['UserName'], $row ['MotDePasse'], $row ['Telephone'], $row ['Email'], $row ['Adresse'] );
	}
	public function VerifierLoginTransporteur($uname, $pwd) {
		$pwd = sha1 ( $pwd );
		$query = "SELECT * FROM Transporteur WHERE UserName='$uname' AND
		MotDePasse='$pwd'";
		$result = $this->_conn->selectDB ( $query );
		$row = $result->fetch ();
		if (! $row)
			return false;
		return new Transporteur ( $row ['IDTransporteur'], $row ['NomSociete'], $row ['Telephone'], $row ['Email'], $row ['Username'], $row ['MotDePasse'], $row ['IBAN'], $row ['Adresse'] );
	}
	public function enregistrerAnnonce($nom, $datedep, $adressedep, $npadep, $localdep, $paysdep, $datearr, $adressearr, $npaarr, $localarr, $paysarr, $type, $desc, $qte, $vol, $pds, $idAnnonceur) {
		
		// Transaction pour les 5
		try {
			
			$this->_conn->getConnection ()->beginTransaction ();
			
			$query = "INSERT into Lieu (NPA, Localite, Pays)VALUES('$npadep', '$localdep', '$paysdep');";
			$this->_conn->executeQuery ( $query );
			$idLieuDepart = $this->_conn->getLastId ();
			
			$query = "INSERT into Lieu (NPA, Localite, Pays) VALUES('$npaarr', '$localarr', '$paysarr');";
			$this->_conn->executeQuery ( $query );
			$idLieuArrivee = $this->_conn->getLastId ();
			
			$query = "INSERT into Marchandise (Description, Quantite, Volume,
			Poids) VALUES('$desc', '$qte', '$vol', '$pds');";
			$this->_conn->executeQuery ( $query );
			$idMarchandise = $this->_conn->getLastId ();
			
			$query = "INSERT into RelationMarchandiseTransportSet (IDMarchandise,IDTypeTransport) VALUES('$idMarchandise', '$type');";
			$this->_conn->executeQuery ( $query );
			
			$query = "INSERT into Annonce (Nom, DateDepart, DateArrivee,
			AdresseDepart, AdresseArrivee, EnCours, TransportRealise, IDMarchandise, IDLieuDepart, IDLieuArrivee, IDAnnonceur )
			VALUES('$nom', '$datedep', '$datearr', '$adressedep', '$adressearr', true, false, 
			'$idMarchandise', '$idLieuDepart', '$idLieuArrivee','$idAnnonceur');";
			$this->_conn->executeQuery ( $query );
			
			$this->_conn->getConnection ()->commit ();
			return true;
		} catch ( Exception $e ) {
			$this->_conn->getConnection ()->rollback ();
		}
	}
	public function enregistrerDevis($prix, $dateExpiration, $description, $idTransporteur, $idAnnonce) {
		try {
			$this->_conn->getConnection ()->beginTransaction ();
			$query = "INSERT into Devis (Prix, DateExpiration, Description, EnCours, Accepte, IDTransporteur, IDAnnonce )
			VALUES('$prix', '$dateExpiration', '$description', true, false, '$idTransporteur', '$idAnnonce');";
			$this->_conn->executeQuery ( $query );
			
			$this->_conn->getConnection ()->commit ();
			return true;
		} catch ( Exception $e ) {
			$this->_conn->getConnection ()->rollback ();
		}
	}
	
	// Récupération des types de transport et renvoi d'un array
	public function afficherTypeTransport() {
		$query = "SELECT * FROM TypeTransport";
		$result = $this->_conn->selectDB ( $query );
		$nomsTypes = array ();
		while ( $row = $result->fetch () ) {
			$nomsTypes [] = $row;
		}
		return $nomsTypes;
	}
	
	// Récupération des Annonces selon IDAnnonceur
	public function getAnnonces($IDAnnonceur) {
		$query = "SELECT * FROM Annonce WHERE IDAnnonceur = $IDAnnonceur AND EnCours = 1";
		$result = $this->_conn->selectDB ( $query );
		$annonces = array ();
		while ( $object = $result->fetch () ) {
			$annonces [] = $object;
		}
		return $annonces;
	}
	
	// Récupération d'une annonce selon IDAnnonce
	public function getAnnonce($IDAnnonce) {
		$query = "SELECT * FROM Annonce WHERE IDAnnonce = $IDAnnonce";
		$result = $this->_conn->selectDB ( $query );
		$annonce = $result->fetch ();
		return $annonce;
	}
	
	// Récupération d'une annonce et des données liées sur les lieux et la marchandise selon IDAnnonce
	public function getAnnonceMarchandiseLieu($IDAnnonce) {
		$query = "SELECT a.Nom, a.DateDepart, a.AdresseDepart, a.AdresseArrivee, a.DateArrivee, l.NPA as 'NPADepart',
		l.Localite as 'LieuDepart', l.Pays as 'PaysDepart', l2.NPA as 'NPAArrivee', l2.Localite as 'LieuArrivee', 
		l2.Pays as 'PaysArrivee', m.IDMarchandise, m.Description, m.Volume, m.Quantite, m.Poids FROM Annonce a, Marchandise m, Lieu l, Lieu l2
		WHERE a.IDAnnonce = $IDAnnonce and a.IDMarchandise=m.IDMarchandise and a.IDLieuDepart=l.IDLieu and a.IDLieuArrivee=l2.IDLieu ";
		$result = $this->_conn->selectDB ( $query );
		$annonce = $result->fetch ();
		return $annonce;
	}
	
	// Tout est dans le nom de la fonction
	public function nombreDevisParAnnonce($IDAnnonce) {
		$query = "SELECT count(IDDevis) from Devis where IDAnnonce = $IDAnnonce";
		$result = $this->_conn->selectDB ( $query );
		$nombre = $result->fetchcolumn ();
		return $nombre;
	}
	
	// Récupération des Devis selon IDAnnonce
	public function getDevis($IDAnnonce) {
		$query = "SELECT * from Devis where IDAnnonce = $IDAnnonce";
		$result = $this->_conn->selectDB ( $query );
		$devis = array ();
		while ( $object = $result->fetch () ) {
			$devis [] = $object;
		}
		return $devis;
	}
	
	// Récupération du Devis valide selon IDAnnonce
	public function getDevisValide($IDAnnonce) {
		$query = "SELECT * from Devis where IDAnnonce = $IDAnnonce and Accepte=1";
		$result = $this->_conn->selectDB ( $query );
		$devis = $result->fetch ();
		return $devis;
	}
	
	// Récupération d'un devis selon IDDevis
	public function getUnDevis($IDDevis) {
		$query = "SELECT * from Devis where IDDevis = $IDDevis";
		$result = $this->_conn->selectDB ( $query );
		$devis = $result->fetch ();
		return $devis;
	}
	
	// Validation d'un devis selon IDDevis et IDAnnonce, changement des valeurs encours et accepté
	public function validerDevis($IDDevis, $IDAnnonce) {
		try {
			$this->_conn->getConnection ()->beginTransaction ();
			// Tous les devis et l'annonce concernés sont désactivés
			$query = "UPDATE Annonce a, Devis d SET d.Encours=0, a.EnCours=0
			WHERE   d.IDAnnonce=$IDAnnonce and d.IDAnnonce=a.IDAnnonce";
			$result = $this->_conn->executeQuery ( $query );
			// Le devis choisi est marqué
			$query = "UPDATE Devis d SET d.Accepte=1 
			WHERE d.IDDevis=$IDDevis ";
			$result = $this->_conn->executeQuery ( $query );
			$this->_conn->getConnection ()->commit ();
			return true;
		} catch ( Exception $e ) {
			$this->_conn->getConnection ()->rollback ();
		}
	}
	
	// Obtenir le transporteur et son lieu d'après l'ID du devis
	public function getTransporteur($IDDevis) {
		$query = "SELECT * from transporteur t, Devis d, Lieu l where IDDevis = $IDDevis and d.IDTransporteur=t.IDTransporteur and t.IDLieu=l.IDLieu";
		$result = $this->_conn->selectDB ( $query );
		$transporteur = $result->fetch ();
		return $transporteur;
	}
	
	// Récupération des annonces pour lesquelles le transporteur doit effectuer le transport
	public function getTransportsAEffectuer($IDTransporteur) {
		$query = "SELECT * from Devis d, Annonce a where d.IDTransporteur=$IDTransporteur 
		and d.Accepte=1 and d.IDAnnonce = a.IDAnnonce and a.TransportRealise=0 ";
		$result = $this->_conn->selectDB ( $query );
		$annonces = array ();
		while ( $object = $result->fetch () ) {
			$annonces [] = $object;
		}
		return $annonces;
	}
	
	// Récupération des annonces pour lesquelles le transporteur a soumis un devis et qui ne sont pas encore attribuées
	public function getAnnoncesPossibles($IDTransporteur) {
		$query = "SELECT * from Devis d, Annonce a where d.IDTransporteur=$IDTransporteur and d.Accepte=0 and d.EnCours=1 
		and d.IDAnnonce = a.IDAnnonce and a.TransportRealise=0 ";
		$result = $this->_conn->selectDB ( $query );
		$annonces = array ();
		while ( $object = $result->fetch () ) {
			$annonces [] = $object;
		}
		return $annonces;
	}
	
	// Récupération d'un devis selon le transporteur et l'annonce
	public function getDevisTransporteurAnnonce($IDTransporteur, $IDAnnonce) {
		$query = "SELECT * from Devis where IDTransporteur = $IDTransporteur and IDAnnonce=$IDAnnonce";
		$result = $this->_conn->selectDB ( $query );
		$devis = $result->fetch ();
		return $devis;
	}
	
	// Récupération d'un annonceur ayant accepte un devis
	public function getAnnonceurDevis($IDDevis) {
		$query = "SELECT c.IDAnnonceur, c.Prenom, c.Nom, c.Telephone, c.Email, c.Adresse, c.IDLieu from Annonceur c, 
		Devis d, Annonce a where d.IDDevis = $IDDevis and d.IDAnnonce=a.IDAnnonce
		and c.IDAnnonceur=a.IDAnnonceur";
		$result = $this->_conn->selectDB ( $query );
		$devis = $result->fetch ();
		return $devis;
	}
	
	// Archivage
	public function archiverAnnonce($IDAnnonce) {
		try {
			$this->_conn->getConnection ()->beginTransaction ();
			$query = "UPDATE Annonce SET TransportRealise=1 WHERE IDAnnonce = $IDAnnonce";
			$result = $this->_conn->executeQuery ( $query );
			$this->_conn->getConnection ()->commit ();
			return true;
		} catch ( Exception $e ) {
			$this->_conn->getConnection ()->rollback ();
		}
	}
	public function getLieu($IDLieu) {
		$query = "SELECT * from Lieu where IDLieu = $IDLieu";
		$result = $this->_conn->selectDB ( $query );
		$lieu = $result->fetch ();
		return $lieu;
	}
	
	// Retourne le type de tranport associé à la marchandise à livrer
	public function getTypeTransportFromMarchandise($IDMarchandise) {
		$query = "SELECT * from TypeTransport tt, RelationMarchandiseTransportSet mt where mt.IDMarchandise = $IDMarchandise 
		and mt.IDTypeTransport=tt.IDTypeTransport";
		$result = $this->_conn->selectDB ( $query );
		$typeTransport = $result->fetch ();
		return $typeTransport;
	}
	
	// Retourne les annonces correspondant aux types de transport pris en charge par le transporteur
	public function getSelectionAnnonces($IDTransporteur) {
		$query = "SELECT a.IDAnnonce, a.IDLieuDepart, a.DateDepart, a.DateArrivee, a.IDLieuArrivee, a.Nom as 'NomAnnonce', tt.Nom as 'TypeTransport'  
		FROM RelationMarchandiseTransportSet rmt, RelationTransporteurTransportSet rtt, Annonce a, 
				TypeTransport tt, Marchandise m 
				WHERE rtt.IDTransporteur=$IDTransporteur and rtt.IDTypeTransport=tt.IDTypeTransport 
				and tt.IDTypeTransport=rmt.IDTypeTransport and rmt.IDMarchandise =m.IDMarchandise 
				and m.IDMarchandise=a.IDMarchandise and a.EnCours=1 ";
		$result = $this->_conn->selectDB ( $query );
		$annonces = array ();
		while ( $object = $result->fetch () ) {
			$annonces [] = $object;
		}
		return $annonces;
	}
	
	// Récupération des Annonces terminé selon IDAnnonceur -> pour les tests afficher les non réalisé donc 0
	public function getAnnonceRealise($IDAnnonceur) {
		$query = "SELECT * FROM Annonce WHERE IDAnnonceur = $IDAnnonceur AND TransportRealise = 1";
		$result = $this->_conn->selectDB ( $query );
		$annonces = array ();
		while ( $object = $result->fetch () ) {
			$annonces [] = $object;
		}
		return $annonces;
	}
	
	// Récupération des Transports effectué selon IDAnnonceur -> pour les tests afficher les non réalisé donc 0 et Devis Accepte 0 aussi
	// EN réalité, mettre Accepte 1 et TransportRealise 1
	public function getTransportsEffectue($IDTransporteur) {
		$query = "SELECT * from Devis d, Annonce a where d.IDTransporteur=$IDTransporteur 
		and d.Accepte=1 and d.IDAnnonce = a.IDAnnonce and a.TransportRealise=1 ";
		$result = $this->_conn->selectDB ( $query );
		$annonces = array ();
		while ( $object = $result->fetch () ) {
			$annonces [] = $object;
		}
		return $annonces;
	}
}
?>