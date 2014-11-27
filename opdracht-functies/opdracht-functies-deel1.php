<?php

	$getal1 	= 3;

	$getal2 	= 4;

	$getal 		= 7;

	$string 	= 'Dit is een voorbeeld van een string';

	function berekenSom ($getal1, $getal2)
	{

		$som = $getal1 + $getal2;

		return $som;
	}


	function vermenigvuldig ($getal1, $getal2)
	{
		$product = $getal1 * $getal2;

		return $product;
	}

	function isEven ($getal)
	{
		$even = false;

		if ($getal % 2 == 0)
		{
			$even = true;
		}

		return $even;
	}

	function lengteUppercaseString ($text)
	{
		$resultaat [ 'count' ] = strlen($text);
		$resultaat [ 'uppercase' ] = strtoupper($text);

		return $resultaat;
	}

	$evenOneven 	= isEven ($getal);

	$somBerekend 	= berekenSom ($getal1, $getal2);

	$productBerekend = vermenigvuldig ($getal1, $getal2);

	$textomzet = lengteUppercaseString($string);


?>


<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht functies deel 1</title>
    </head>

    <body>

    	<h1>Opdracht functies deel 1:</h1>

    	<h2>De functie berekenSom:</h2>

    		<p>De som van <?= $getal1 ?> en <?= $getal2 ?> is <?= $somBerekend ?></p>

    	<h2>De functie vermenigvuldig:</h2>

    		<p>Het product van <?= $getal1 ?> en <?= $getal2 ?> is <?= $productBerekend ?></p>

    	<h2>De functie isEven:</h2>

    		<p>Het getal <?= $getal ?> is een <?= ($evenOneven == true) ? 'even' : 'oneven' ?> getal.</p>

    	<h2>Uitbreiding:</h2>

    		<p>De lengte van de string:  "<?= $string ?>" is <?= $textomzet [ 'count' ] ?> tekens.</p>

    		<p>In uppercase is deze string: <?= $textomzet [ 'uppercase' ] ?>.</p>
        
    </body>
</html>