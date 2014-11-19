<?php

	$dier [] = 'Leeuw';
	$dier [] = 'Aap';
	$dier [] = 'Tijger';
	$dier [] = 'Pinguïn';
	$dier [] = 'Hond';
	$dier [] = 'Kat';
	$dier [] = 'Goudvis';
	$dier [] = 'Parkiet';
	$dier [] = 'Vos';
	$dier [] = 'Mol';


	$dierAndereManier = array('Muis', 'Eend', 'Buffel', 'Varken', 'Egel', 'Eekhoorn', 'Merel', 'Rat', 'Schaap', 'Koe');


	$voertuigen ['Landvoertuigen'] = array('Fiets', 'Vespa');
	$voertuigen ['Watervoertuigen'] = array('Boot', 'Vlot', 'Schoener');
	$voertuigen ['Luchtvoertuigen'] = array('Luchtballon', 'Helicopter');

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Oplossing opdracht arrays basis deel 1</title>
    </head>
    <body>

    	<h1>Oplossing opdracht arrays basis deel 1</h1>

    	<p>eerste methode:</p>

    	<pre>
    		<?php var_dump($dier) ?>
    	</pre>

		<p>tweede methode:</p>

    	<pre>
    		<?php var_dump($dierAndereManier) ?>
    	</pre>

    	<p>Voertuigen:</p>

    	<pre>
    		<?php var_dump($voertuigen) ?>
    	</pre>


        
    </body>
</html>