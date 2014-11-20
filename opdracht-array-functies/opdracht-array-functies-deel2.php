<?php

	$dieren 		     = array('hond', 'kat', 'eend', 'varken', 'muis', 'slang', 'beer');

	$aantal 		     = count($dieren);

    $gesorteerdedieren   = $dieren;

    sort($gesorteerdedieren);

    $zoogdieren          = array('dolfijn', 'aap', 'olifant');

    $dierenlijst         = array_merge($dieren, $zoogdieren);

?>


<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht array functies deel 2</title>
    </head>

    <body>

    	<h1>Opdracht array functies deel 2:</h1>

        <h2>Array dieren alfabetisch gesorteerd:</h2>

        <pre><?php var_dump($gesorteerdedieren) ?></pre>

        <h2>Array van zoogdieren:</h2>

        <pre><?php var_dump($zoogdieren) ?></pre>

        <h2>Samenvoegen van de array's dieren en zoogdieren in de array dierenlijst:</h2>

        <pre><?php var_dump($dierenlijst) ?></pre>

    	
      
    </body>
</html>