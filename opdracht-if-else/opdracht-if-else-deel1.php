
<?php

	$jaartal = 2016;

	$antwoord = 'onbekend';

	if ((($jaartal % 4 == 0) && ($jaartal % 100 != 0)) || ($jaartal % 400 == 0))
	{
		$antwoord = 'schrikkeljaar';
	}
	else
	{
		$antwoord = 'geen schrikkeljaar';
	}

?>



<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Oplossing if else deel 1</title>
    </head>
    <body>

    	<h1>Oplossing if else deel 1:</h1>

    	<p>Het jaar <?= $jaartal ?> is een <?= $antwoord ?></p>

    </body>
        
</html>