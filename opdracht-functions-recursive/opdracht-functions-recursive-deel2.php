<?php

	$basisBedrag = 100000;

	$jarenSparen = 10;

	$percent = 8;

	function renteBereken ($configArray)
	{ 
		
		if ($configArray ['counter'] != $configArray ['aantalJaar'])
		{
			$rente = round(($configArray['bedrag']/100) * $configArray ['percent'])
			$configArray['rente'][] = $rente;
			$configArray['bedrag'] = $configArray['bedrag'] + $rente ;
			$configArray['counter'] = $configArray['counter'] +1;
			return renteBereken($configArray);
		}
		else
		{
			return $configArray;
		}
	}

	$einde = renteBereken (array('bedrag' => $basisBedrag, 'aantalJaar' => $jarenSparen, 'percent' => $percent, 'counter' => 0));

var_dump($einde)
	

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht functions recursive</title>
    </head>
    <body>
    	<h1>Opdracht functions recursive</h1>
    	<p>Hans spaart een bedrag van <?= $basisBedrag ?> euro voor <?= $jarenSparen ?> jaar aan een rente van <?= $percent ?>% per jaar.</p>
    		<ul>
    			<?php foreach ($einde as $value): ?>
    		    	<li>Na <?= $value['counter'] ?> jaar sparen heeft hans een winst van <?= $value['rente'] ?> euro en een totaalbedrag van <?= $value['bedrag'] ?> euro</li>
    		    <?php endforeach ?>
    		</ul>


        
    </body>
</html>