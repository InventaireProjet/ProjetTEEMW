<?php
require_once 'class.Annonceur.php';
require_once 'class.MySqlConn.php';
class MySqlManager {
	private $_conn;
	public function __construct() {
		$this->_conn = new MySqlConn ();
	}
	public function saveAnnonceur($fname, $lname, $uname, $pwd, $phone, $email, $adress, $IBAN) {
		$pwd = sha1 ( $pwd );
		$query = "INSERT into annonceur(Prenom, Nom, UserName,
		MotDePasse, Telephone, Email, Adresse, IBAN)VALUES('$fname', '$lname', '$uname', '$pwd', '$phone', '$email', '$adress', '$IBAN');";
		return $this->_conn->executeQuery ( $query );
	}
	public function checkLogin($uname, $pwd) {
		$pwd = sha1 ( $pwd );
		$query = "SELECT * FROM Annonceur WHERE UserName='$uname' AND
		MotDePasse='$pwd'";
		$result = $this->_conn->selectDB ( $query );
		$row = $result->fetch ();
		if (! $row)
			return false;
		return new Annonceur ( $row ['IDAnnonceur'], $row ['Prenom'], $row ['Nom'], $row ['UserName'], $row ['MotDePasse'], $row ['Telephone'], $row ['Email'], $row ['Adresse'] );
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
			
			// TODO G�rer lieu
			$query = "INSERT into Annonce (Nom, DateDepart, DateArrivee,
			AdresseDepart, AdresseArrivee, EnCours, TransportRealise, IDMarchandise, IDLieuDepart, IDLieuArrivee, IDAnnonceur )VALUES('$nom', '$datedep', '$datearr', '$adressedep', '$adressearr', true, false, '$idMarchandise', '$idLieuDepart', '$idLieuArrivee','$idAnnonceur');";
			$this->_conn->executeQuery ( $query );
			
			$this->_conn->getConnection ()->commit ();
			return true;
		} catch ( Exception $e ) {
			$this->_conn->getConnection ()->rollback ();
		}
	}
	public function enregistrerDevis($prix, $dateExpiration, $description, /*$idTransporteur,*/ $idAnnonceur) {
		// TODO G�rer FK transporteur et annonce ==> pour test FK annonceur
		try {		
		$this->_conn->getConnection ()->beginTransaction ();
		$query = "INSERT into Devis (Prix, DateExpiration, Description, EnCours, Accepte, IDTransporteur, IDAnnonce )VALUES('$prix', '$dateExpiration', '$description', true, false, '$idAnnonceur', 1);";
		$this->_conn->executeQuery ( $query );
		echo "je suis dans MySQLManager";
		
		$this->_conn->getConnection ()->commit ();
		return true;
		} catch ( Exception $e ) {
			$this->_conn->getConnection ()->rollback ();
		}
	}
	
	// R�cup�ration des types de transport et renvoi d'un array
	public function afficherTypeTransport() {
		$query = "SELECT * FROM TypeTransport";
		$result = $this->_conn->selectDB ( $query );
		$nomsTypes = array ();
		while ( $row = $result->fetch () ) {
			$nomsTypes [] = $row;
		}
		
		return $nomsTypes;
	}
}
?>