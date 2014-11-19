<?php

	$getal = 7;

	$dag = 'onbekend';


	switch ($getal) 
	{
		case 1:
			$dag = 'maandag';
			break;

		case 2:
			$dag = 'dinsdag';
			break;

		case 3:
			$dag = 'woensdag';
			break;

		case 4:
			$dag = 'donderdag';
			break;

		case 5:
			$dag = 'vrijdag';
			break;

		case 6:
			$dag = 'zaterdag';
			break;

		case 7:
			$dag = 'zondag';
			break;
		
		default:
			$dag = 'onbekend';
			break;
	}


?>



<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Oplossing opdracht switch</title>
    </head>
    <body>
         <h1>Oplossing opdracht switch</h1>

         <p> De dag is: <?= $dag ?></p>
        
    </body>
</html>