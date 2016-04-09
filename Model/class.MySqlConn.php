<?php
class MySqlConn {
	const HOST = "localhost";
	const PORT = "80";
	const DATABASE = "grp5";
	const USER = "grp5";
	const PWD = "Reunion2012";
	private $_connection;
	public function __construct() {
		try {
			$this->_connection = new PDO ( 'mysql:host=' . self::HOST . ';port=' . self::PORT . ';dbname=' . self::DATABASE, self::USER, self::PWD );
		} catch ( PDOException $e ) {
			die ( 'Connection failed: ' . $e->getMessage () );
		}
	}
	public function getConnection() {
		if (! isset ( $this->_connection ) || $this->_connection == null) {
			new MySqlConn ();
		}
		
		return $this->_connection;
	}
	public function selectDB($query) {
		$result = $this->getConnection ()->query ( $query ) or die ( print_r ( $this->getConnection ()->errorInfo (), true ) );
		return $result;
	}
	public function executeQuery($query) {
		$result = $this->getConnection ()->exec ( $query );
		$e = $this->getConnection ()->errorInfo ();
		if ($e [1] != null) {
			if ($e [1] == 1062)
				return 'doublon';
			else
				die ( print_r ( $this->getConnection ()->errorInfo (), true ) );
		}
		return $result;
	}
}

/*
 * $c = new MySqlConn ();
 * var_dump ( $c );
 */

?> 