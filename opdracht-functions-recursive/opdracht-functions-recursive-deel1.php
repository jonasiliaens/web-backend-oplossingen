	<?php

	$basisBedrag = 100000;

	$jarenSparen = 10;

	$percent = 8;

	function renteBereken ($bedrag, $aantalJaar, $percent)
	{
		static $container = array();

		static $counter = 0;

		if ($counter != $aantalJaar)
		{
			$rente = round(($bedrag/100) * $percent);
			$bedrag = $bedrag + $rente;
			++$counter;
			$container [] = array('bedrag' => $bedrag, 'jaar' => $counter, 'rente' => $rente);
			
			return renteBereken($bedrag, $aantalJaar, $percent);
		}
		else
		{
			return $container;
		}
	}

	$einde = renteBereken ($basisBedrag, $jarenSparen, $percent);


	

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
    		    	<li>Na <?= $value['jaar'] ?> jaar sparen heeft hans een winst van <?= $value['rente'] ?> euro en een totaalbedrag van <?= $value['bedrag'] ?> euro</li>
    		    <?php endforeach ?>
    		</ul>


        
    </body>
</html>