<?php
	function my_autoloader($className)
	{
		require_once ('classes/'.$className.'.php');
	}

	spl_autoload_register('my_autoloader');

	//Instanties van de Animal class
	$kermit 	=	new Animal('Kermit', 'Man', 100);
	$dikkie 	=	new Animal('Dikkie', 'Man', 90);
	$flipper 	=	new Animal('Flipper', 'Vrouw', 80);

	//Instanties van de Lion class
	$simba 		=	new Lion('Simba', 'Man', 120, 'Congo lion');
	$scar 		=	new Lion('Scar', 'Man', 40, 'Kenia lion');

	//Instanties van de Zebra class
	$zeke 		=	new Zebra('Zeke', 'Man', 60, 'Quagga');
	$zana 		=	new Zebra('Zana', 'Vrouw', 70, 'Selous');

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Herhaling Opdracht Classes Extends</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    	<h1>Herhaling Opdracht Classes Extends</h1>

    	<h2>Instanties van de Animal class</h2>

    	<p><?= $kermit->getName() ?> is van het geslacht <?= $kermit->getGender() ?> en heeft <?= $kermit->getHealth() ?> levenspunten.</p>

    	<p><?= $dikkie->getName() ?> is van het geslacht <?= $dikkie->getGender() ?> en heeft <?= $dikkie->getHealth() ?> levenspunten.</p>

    	<p><?= $flipper->getName() ?> is van het geslacht <?= $flipper->getGender() ?> en heeft <?= $flipper->getHealth() ?> levenspunten.</p>

    	<p><?= $flipper->getName() ?> krijgt 10 levenspunten bij en heeft nu dus <?= $flipper->changeHealth(10) ?> levenspunten en heeft als special move: '<?= $flipper->doSpecialMove() ?>'.</p>
    
    	<h2>Instanties van de Lion class</h2>
    	
    	<p>De special move van <?= $simba->getName() ?> (soort: <?= $simba->getSpecies() ?>) is: <?= $simba->doSpecialMove() ?></p>

    	<p>De special move van <?= $scar->getName() ?> (soort: <?= $scar->getSpecies() ?>) is: <?= $scar->doSpecialMove() ?></p>

    	<h2>Instanties van de Zebra class</h2>
    	
    	<p>De special move van <?= $zeke->getName() ?> (soort: <?= $zeke->getSpecies() ?>) is: <?= $zeke->doSpecialMove() ?></p>

    	<p>De special move van <?= $zana->getName() ?> (soort: <?= $zana->getSpecies() ?>) is: <?= $zana->doSpecialMove() ?></p>
    </body>
</html>