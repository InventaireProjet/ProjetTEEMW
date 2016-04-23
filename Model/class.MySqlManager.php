<?php
	require_once 'class.Annonceur.php';
	require_once 'class.MySqlConn.php';
	class MySqlManager {
		private $_conn;
		public function __construct() {
			$this->_conn = new MySqlConn ();
		}
		public function saveUser($fname, $lname, $uname, $pwd) {
			$pwd = sha1 ( $pwd );
			$query = "INSERT into Annonceur(Prenom, Nom, UserName,
		MotDePasse)VALUES('$fname', '$lname', '$uname', '$pwd');";
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
			// TODO Transaction pour les 3
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
			
			// TODO Gérer lieu, FK annonceur et marchandise
			$query = "INSERT into Annonce (Nom, DateDepart, DateArrivee,
			AdresseDepart, AdresseArrivee, EnCours, TransportRealise, IDMarchandise, IDLieuDepart, IDLieuArrivee, IDAnnonceur )VALUES('$nom', '$datedep', '$datearr', '$adressedep', '$adressearr', true, false, '$idMarchandise', '$idLieuDepart', '$idLieuArrivee','$idAnnonceur');";
			$this->_conn->executeQuery ( $query );
		}
	}
	?>