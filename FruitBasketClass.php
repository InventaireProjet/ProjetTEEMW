<?php
class FruitBasket {
	private $fruits;
	public function __construct() {
		$this->fruits = array ();
	}
	public function display() {
		ksort ( $this->fruits );
		foreach ( $this->fruits as $x => $value ) {
			echo "<br>$value $x<br>";
		}
	}
	public function addFruit($name, $numbers) {
		if ($this->fruits != null) {
			
			if (isset ( $this->fruits [$name] )) {
				$this->fruits [$name] += $numbers;
			} else
				$this->fruits [$name] = $numbers;
		} 

		else {
			$this->fruits [$name] = $numbers;
		}
	}
	public function removeFruit($name, $numbers) {
		if ($this->fruits != null) {
			
			if (isset ( $this->fruits [$name] )) {
				
				if ($numbers >= $this->fruits [$name]) {
					unset ( $this->fruits [$name] );
				} else	
					$this->fruits [$name] -= $numbers;
			}
		}
	}
}

