<?php

	$getallen 		    = array(8, 7, 8, 7, 3, 2, 1, 2, 4);

    $zonderduplicaten   = array_unique($getallen);

    $gesorteerd         = $zonderduplicaten;

    sort($gesorteerd);

?>


<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht array functies deel 3</title>
    </head>

    <body>

    	<h1>Opdracht array functies deel 3:</h1>

        <h2>De originele array:</h2>

        <pre><?php var_dump($getallen) ?></pre>

        <h2>De nieuwe array zonder de duplicaten:</h2>

        <pre><?php var_dump($zonderduplicaten) ?></pre>

        <h2>De array zonder de duplicaten gesorteerd:</h2>

        <pre><?php var_dump($gesorteerd) ?></pre>

        
    	
      
    </body>
</html>