<?php
	
	function my_autoloader ($class_name)
	{
		include ('classes/'.$class_name.'.php');
	}

    spl_autoload_register('my_autoloader');

    $kermit 	=	new Animal('Kermit', 'Male', 54);
    $dikkie 	=	new Animal('Dikkie', 'Male', 67);
    $flipper 	=	new Animal('Flipper', 'Female', 34);


 	$kermitNaam 	=	$kermit->getName();
 	$dikkieNaam 	=	$dikkie->getName();
 	$flipperNaam 	=	$flipper->getName();

 	$kermitGender	=	$kermit->getGender();
 	$dikkieGender	=	$dikkie->getGender();
 	$flipperGender 	=	$flipper->getGender();

 	$kermitHealth	=	$kermit->getHealth();
 	$dikkieHealth	=	$dikkie->getHealth();
 	$flipperHealth 	=	$flipper->getHealth();

 	$flipperHealthChanged 	=	$flipper->changeHealth(50);

 	$flipperSpecialMove 	=	$flipper->doSpecialMove();

 	$simba 			=	new Lion('Simba', 'Male', 88, 'Congo lion');
 	$scar 			=	new Lion('Scar', 'Male', 23, 'Kenia lion');

 	$simbaNaam 		=	$simba->getName();
 	$scarNaam 		=	$scar->getName();

 	$simbaSoort 	=	$simba->getSpecies();
 	$scarSoort 		=	$scar->getSpecies();

 	$simbaSM 		=	$simba->doSpecialMove();
 	$scarSM 		=	$scar->doSpecialMove();

 	$zeke 			=	new Zebra('Zeke', 'Male', 12, 'Quagga');
 	$zana 			=	new Zebra('Zana', 'Female', 97, 'Selous');

 	$zekeNaam 		=	$zeke->getName();
 	$zanaNaam 		=	$zana->getName();

 	$zekeSoort 		=	$zeke->getSpecies();
 	$zanaSoort 		=	$zana->getSpecies();

 	$zekeSM 		=	$zeke->doSpecialMove();
 	$zanaSM 		=	$zana->doSpecialMove();





?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht Classes: Extends</title>
    </head>
    <body>

    	<h1>Opdracht Classes: Extends</h1>

    	<h2>Instanties van de Animal class</h2>

    	<p><?= $kermitNaam ?> is van het geslacht <?= $kermitGender ?> en heeft momenteel <?= $kermitHealth ?> levenspunten.</p>
    	<p><?= $dikkieNaam ?> is van het geslacht <?= $dikkieGender ?> en heeft momenteel <?= $dikkieHealth ?> levenspunten.</p>
    	<p><?= $flipperNaam ?> is van het geslacht <?= $flipperGender ?> en heeft momenteel <?= $flipperHealth ?> levenspunten. We tellen 50 punten bij: <?= $flipperHealthChanged ?> levenspunten. Specialmove: <?= $flipperSpecialMove ?></p>
  
    	<h2>Instanties van de Lion class</h2>

    	<p>De speciale move van <?= $simbaNaam ?> (soort: <?= $simbaSoort ?>): <?= $simbaSM ?></p>
    	<p>De speciale move van <?= $scarNaam ?> (soort: <?= $scarSoort ?>): <?= $scarSM ?></p>

    	<h2>Instanties van de Zebra class</h2>

    	<p>De speciale move van <?= $zekeNaam ?> (soort: <?= $zekeSoort ?>): <?= $zekeSM ?></p>
    	<p>De speciale move van <?= $zanaNaam ?> (soort: <?= $zanaSoort ?>): <?= $zanaSM ?></p>



    </body>
</html>