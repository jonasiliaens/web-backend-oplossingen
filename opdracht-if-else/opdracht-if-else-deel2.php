
<?php

	$aantalsec 	= 221108521;

	$minuten 	= round($aantalsec/60, 0);

	$uren 		= round($minuten/60, 0);

	$dagen 		= round($uren/24, 0);

	$weken 		= round($dagen/7, 0);

	$maanden 	= round($dagen/31, 0);

	$jaren 		= round($dagen/365, 0);

	




?>



<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Oplossing if else deel 2</title>
    </head>
    <body>

    	<h1>Oplossing if else deel 2:</h1>

    	<p>in <?= $aantalsec ?> seconden zitten :</p>

    	<ul>
	    	<li>minuten: <?= $minuten ?></li>
	    	<li>uren: <?= $uren ?></li>
	    	<li>dagen: <?= $dagen ?></li>
	    	<li>weken: <?= $weken ?></li>
	    	<li>maanden: <?= $maanden ?></li>
	    	<li>jaren: <?= $jaren ?></li>
	    </ul>

    </body>
        
</html>