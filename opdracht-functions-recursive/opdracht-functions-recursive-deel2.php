	<?php

	$basisBedrag = 100000;

	$jarenSparen = 10;

	$percent = 8;

	function renteBereken ($dataArray)
	{

		if ($dataArray['teller'] != $dataArray['looptijd'])
		{
			$rente = round(($dataArray['bedrag']/100) * $dataArray['percent']);
			$dataArray['bedrag'] += $rente;
			++$dataArray['teller'];
			$dataArray ['historiek'] [] = array('bedrag' => $dataArray['bedrag'], 
												'teller' => $dataArray['teller'], 
												'looptijd' => $dataArray['looptijd'], 
												'rente' => $rente);
			
			return renteBereken($dataArray);
		}
		else
		{
			return $dataArray;
		}
	}

	$einde = renteBereken (array('bedrag' => $basisBedrag, 
									'looptijd' => $jarenSparen,
									'percent' => $percent, 
									'teller' => 0, 
									'historiek' => array()));
	

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht functions recursive deel 2</title>
    </head>
    <body>
    	<h1>Opdracht functions recursive deel 2</h1>
    	<p>Hans spaart een bedrag van <?= $basisBedrag ?> € voor <?= $jarenSparen ?> jaar aan een rente van <?= $percent ?>% per jaar.</p>
    		<ul>
    			<?php foreach ($einde ['historiek'] as $value): ?>
    		    	<li>Na <?= $value['teller'] ?> jaar sparen heeft hans een winst van <?= $value['rente'] ?> € en een totaalbedrag van <?= $value['bedrag'] ?> €</li>
    		    <?php endforeach ?>
    		</ul>


        
    </body>
</html>