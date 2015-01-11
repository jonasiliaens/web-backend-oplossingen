<?php
	
	//Een array met dieren op de eerste manier
	$dieren1 	=	array('Leeuw', 'Paard', 'Aap', 'Hond', 'Kat', 'Vogel', 'Muis', 'Spin', 'Zebra', 'Giraf');

	//Een array met dieren op de tweede manier
	$dieren2[] 	=	'Leeuw';
	$dieren2[] 	=	'Paard';
	$dieren2[] 	=	'Aap';
	$dieren2[] 	=	'Hond';
	$dieren2[] 	=	'Kat';
	$dieren2[] 	=	'Vogel';
	$dieren2[] 	=	'Muis';
	$dieren2[] 	=	'Spin';
	$dieren2[] 	=	'Zebra';
	$dieren2[] 	=	'Giraf';

	//Een 2-dimensionele array met voertuigen
	$voertuigen 	=	array('landvoertuigen' => array('Vespa', 'Fiets'),
								'watervoertuigen' => array('Surfplank', 'Vlot', 'Schoener', 'Driemaster'),
								'luchtvoertuigen' => array('Luchtballon', 'Helicopter', 'B52'));

	
	$getallen1 			=	array(1, 2, 3, 4, 5);

	$productGetallen 	=	array_product($getallen1);

	$getallenOneven 	=	array();

	foreach ($getallen1 as $value)
	{
		if ($value % 2 != 0)
		{
			$getallenOneven[] 	=	$value;
		}
	}

	$getallen1Reverse 	=	array_reverse($getallen1);

	$getallenSom 		=	array();

	foreach ($getallen1 as $key => $value)
	{
		$getal1 		=	$value;
		$getal2 		=	$getallen1Reverse[$key];

		$getallenSom[] 	=	$getal1 + $getal2;
	}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Herhaling Opdracht Arrays Basis (Deel1 en Deel2)</title>
    </head>
    <body>
    	<h1>Herhaling Opdracht Arrays Basis Deel1</h1>

    	<h2>De Array dieren op 2 manieren:</h2>

    	<p><?php var_dump($dieren1) ?></p>
    	<p><?php var_dump($dieren2) ?></p>

    	<h2>De 2-dimensionele array met voertuigen:</h2>

    	<p><?php var_dump($voertuigen) ?></p>

    	<h1>Herhaling Opdracht Arrays Basis Deel2</h1>

    	<h2>De Array getallen:</h2>

    	<ul>
    	   <?php foreach ($getallen1 as $key => $value): ?>
    	   	<li><?= $value ?></li>
    	   <?php endforeach ?>
    	</ul>

    	<h2>Het product van Array getallen:</h2>

    	<p><?= $productGetallen ?></p>

    	<h2>De Array met oneven getallen:</h2>

    	<ul>
    	   <?php foreach ($getallenOneven as $key => $value): ?>
    	   	<li><?= $value ?></li>
    	   <?php endforeach ?>
    	</ul>

    	<h2>De Array getallen omgekeerd:</h2>

    	<ul>
    	   <?php foreach ($getallen1Reverse as $key => $value): ?>
    	   	<li><?= $value ?></li>
    	   <?php endforeach ?>
    	</ul>

    	<h2>De som van Array getallen en Array getallen omgekeerd:</h2>

    	<ul>
    	   <?php foreach ($getallenSom as $key => $value): ?>
    	   	<li><?= $value ?></li>
    	   <?php endforeach ?>
    	</ul>    
    </body>
</html>