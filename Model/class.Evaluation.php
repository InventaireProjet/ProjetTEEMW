<?php
class Evaluation {
	public $ID;
	public $Points;
	public $Commentaire;
	public function __construct($id, $points, $commentaire) {
		$this->ID = $id;
		$this->Points = $points;
		$this->Commentaire = $commentaire;
	}
}
?>