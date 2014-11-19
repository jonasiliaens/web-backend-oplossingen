<?php

	$dieren 		= array('hond', 'kat', 'eend', 'varken', 'muis', 'slang', 'beer');

	$aantal 		= count($dieren);

	$tezoekendier 	= 'muis';

	$antwoord 		= array_search($tezoekendier, $dieren)





?>


<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht array functies deel 1</title>
    </head>

    <body>

    	<h1>Opdracht array functies deel 1:</h1>

    	<p>Aantal dieren in de array: <?= $aantal ?></p>

    	<?php if ($antwoord == true):  ?>
    		<p>Het dier <?= $tezoekendier ?> is gevonden</p>

    	<?php else: ?>
    		<p>Het dier <?= $tezoekendier ?> is niet gevonden</p>

    	<?php endif ?>
      
    </body>
</html>