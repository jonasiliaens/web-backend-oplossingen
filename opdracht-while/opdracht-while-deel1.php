<?php

	$getallenreeks = array();

	$getallenKommaSpatie = '';

	$getallen3	= '';

	$getallen3Reeks = '';


	$teller = 0;

	while ($teller < 101)
	{
		$getallenreeks [] = $teller;
		++$teller;
	}

	$getallenKommaSpatie = implode(', ', $getallenreeks);


	$teller = 0;

	while ($teller < 101)
	{
		if (($teller > 40) && ($teller % 3 == 0) && ($teller < 80))
		{
			$getallen3 [] = $teller;
		}
		
		++$teller;
	}


	$getallen3Reeks = implode(', ', $getallen3);



?>


<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht-while deel 1</title>
    </head>

    <body>

    	<h1>Opdracht-while deel 1:</h1>

    	<h2>Getallenreeks van 0 tot 100:</h2>

    	<p><?= $getallenKommaSpatie ?></p>

    	<h2>Getallen die deelbaar zijn door 3 en tussen 40 en 80 liggen:</h2>

    	<p><?= $getallen3Reeks ?></p>

        
    </body>
</html>