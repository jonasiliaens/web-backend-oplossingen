<?php

	$timestamp 			= 	mktime(22, 35, 25, 01, 21, 1904);

	$dateFromTimestamp 	= 	date('d F Y, h:i:s a', $timestamp);

?>


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht Date deel 1</title>
        
    </head>
    <body>
    	<h1>Opdracht Date deel 1</h1>

    	<p>De timestamp van 22u 35m 25sec 21 januari 1904 is: <?= $timestamp ?></p>
    	<p>De timestamp omgezet naar een datum: <?= $dateFromTimestamp ?></p>
        
   
    </body>
</html>