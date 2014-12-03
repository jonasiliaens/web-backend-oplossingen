<?php

	$md5HashKey 	= 'd1fa402db91a7a93c4f414b8278ce073';

	$argument1 		=	'2';

	$argument2		=	'8';

	$argument3 		=	'a';

	function functie1($haystack, $needle) // hier zijn de $haystack en $ needle parameters
	{
		$count 				= 	strlen($haystack);
		$aantal 			= 	substr_count($haystack, $needle);
		$percentBerekening 	= 	($aantal / $count) * 100;
		
		return $percentBerekening;
	}

	function functie2($needle)
	{
		global $md5HashKey;
		$haystack 			= 	$md5HashKey;
		$count 				= 	strlen($haystack);
		$aantal 			= 	substr_count($haystack, $needle);
		$percentBerekening 	= 	($aantal / $count) * 100;
		
		return $percentBerekening;
	}

	function functie3($needle)
	{	
		$haystack 			= 	$GLOBALS['md5HashKey'];
		$count 				= 	strlen($haystack);
		$aantal 			= 	substr_count($haystack, $needle);
		$percentBerekening 	= 	($aantal / $count) * 100;
		
		return $percentBerekening;
	}


	$functieresultaat1 = functie1($md5HashKey, $argument1); //Hier zijn de $md5HashKey en $argument1 argumenten

	$functieresultaat2 = functie2($argument2);

	$functieresultaat3 = functie3($argument3);	

?>

<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht functies gevorderd deel 1</title>
    </head>

    <body>
    	<h1>Opdracht functies gevorderd deel 1:</h1>

	    	<p>Functie 1: De needle '<?= $argument1 ?>' komt <?= $functieresultaat1 ?>% voor in de hash key '<?= $md5HashKey ?>'</p>

	    	<p>Functie 2: De needle '<?= $argument2 ?>' komt <?= $functieresultaat2 ?>% voor in de hash key '<?= $md5HashKey ?>'</p>

	    	<p>Functie 3: De needle '<?= $argument3 ?>' komt <?= $functieresultaat3 ?>% voor in de hash key '<?= $md5HashKey ?>'</p>
	        
    </body>

</html>