<?php

	$pigHealth 		= 	5;

	$maximumThrows 	= 	8;


	function calculateHit ($currentPigHealth, $currentThrows)
	{
		$container	=	array();

		$pigHealth 	=	$currentPigHealth;

		$throws 	=	$currentThrows;

		$randomNr 	=	rand(0,9);

		$isHit 		= false;

		$message 	= 'Mis! Er zijn nog '.$currentPigHealth.' varkens over in het team!';

		if ($randomNr <= 5)
		{
			-- $pigHealth;

			$isHit 		= 	true;

			$message 	= 	'Raak! Er zijn nog '.$currentPigHealth.' varkens over in het team!';
		}

		-- $throws;

		$container ['pigHealth'] 	= 	$pigHealth;

		$container ['throws'] 		=	$throws;

		$container ['ishit'] 		=	$isHit;

		$container ['boodschap'] 	=	$message;

		return $container;

	}

	function launchAngryBird ($currentPigHealth, $currentThrows)
	{
		static $container 	=	array();

		if ($currentPigHealth != 0 && $currentThrows != 0)
		{
			$worp 			= calculateHit($currentPigHealth, $currentThrows);

			$container [] 	= $worp;

			launchAngryBird($worp['pigHealth'], $worp['throws']);
		}
		else
		{
			$eindresultaatArray     =   array( 'boodschap' => 'Verloren!' );
            
            if ( $currentPigHealth === 0 )
            {
                $eindresultaatArray['boodschap'] = 'Gewonnen!';
            }
            
            $container[] = $eindresultaatArray;

		}

		return $container;


	}

	$spel = launchAngryBird($pigHealth, $maximumThrows);

	
?>

<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht functies gevorderd deel 2 (Angry Birds herhaling)</title>
    </head>

    <body>
    	<h1>Opdracht functies gevorderd deel 2 (Angry Birds herhaling):</h1>

    	<ul>
    		<?php foreach ($spel as $worp): ?>
    	    <li><?= $worp['boodschap'] ?></li>
    		<?php endforeach ?>
    	</ul>
	    	
	        
    </body>

</html>