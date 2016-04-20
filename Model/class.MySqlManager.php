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
			return new Annonceur ( $row ['IDAnnonceur'], $row ['Prenom'], $row ['Nom'], $row ['UserName'], $row ['MotDePasse'],
					$row ['Telephone'],$row ['Email'],$row ['Adresse']);
		}
		
		public function saveAnnonce($nom, $dDepart, $dArrivee, $aDepart, $aArrivee) {
				
			$query = "INSERT into Annonce (Nom, DateDepart, DateArrivee,
			AdresseDepart, AdresseArrivee, EnCours, TransportRealise)VALUES('$fname', '$lname', '$uname', '$pwd');";
			return $this->_conn->executeQuery ( $query );
		}
	}
	?>