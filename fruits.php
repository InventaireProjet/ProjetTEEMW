<?php
$fruits = array("mangue"=>"125", "figue"=>"8155440", "cerise"=>"2", "noix"=>"32");

asort($fruits);
echo "Ordre alphabétique : <br>";
foreach ($fruits as $x => $value) {
	echo "$value $x";
	echo "<br>"
	;
}
echo "<br>";

ksort($fruits);
echo "Ordre numérique : <br>";
foreach ($fruits as $x => $value) {
	echo "$value $x";
	echo "<br>"
			;
}
include_once 'FruitBasketClass.php';
 $panier = new FruitBasket();
 
 
 
 $panier->addFruit("tomate", "147");
 $panier->addFruit("mangue", "125");
 $panier->addFruit("figue", "10");
 $panier->addFruit("noix", "32");
  $panier->display();
 
 $panier->addFruit("noix", "30");
 $panier->removeFruit("mangue", "12");
 $panier->display();
 
