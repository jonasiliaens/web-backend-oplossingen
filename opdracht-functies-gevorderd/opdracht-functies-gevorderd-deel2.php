<?php

	$pigHealth 		= 	5;

	$maximumThrows 	= 	8;

	$raak = array();


	function calculateHit()
	{
		global $pigHealth;

		$raakkans = rand(0,9);

		$container = array();

		if ($raakkans < 6)
		{
			$pigHealth = $pigHealth - 1;

			if ($pigHealth <= 1)
			{
				if ($pigHealth == 0)
				{
					$container = 'Raak! Er zijn geen varkens meer over.';
				}
				else
				{
					$container = 'Raak! Er is nog maar '.$pigHealth.' varken over.';
				}
				
			}
			else
			{
				$container = 'Raak! Er zijn nog  '.$pigHealth.' varkens over.';
			}
			
		}

		else
		{
			if ($pigHealth < 2)
			{
				$container = 'Mis! Nog steeds maar '.$pigHealth.' varken over.';
			}
			else
			{
				$container = 'Mis! Nog '.$pigHealth.' varkens in het team.';
			}	
		}

		return $container;
	
	}

	function launchAngryBird()
	{
		global $raak;

		global $pigHealth;

		global $maximumThrows;

		if ($maximumThrows !== 0 && $pigHealth > 0)
		{
			$raak [] = calculateHit();
			$maximumThrows = $maximumThrows -1;
			launchAngryBird();
		}

		else
		{
			if ($pigHealth == 0)
			{
				$raak [] = 'Je hebt gewonnen!';
			}

			else
			{
				$raak [] = 'Spijtig, je hebt verloren!';
			}
		}
		return $raak;

	}

launchAngryBird();
	
?>

<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht functies gevorderd deel 2 (Angry Birds)</title>
        <style>
        	li 
        	{
        		list-style-type: none;
        		padding: 3px;
        	}
        </style>
    </head>

    <body>
    	<h1>Opdracht functies gevorderd deel 2 (Angry Birds):</h1>

    	<ul>
    		<?php foreach ($raak as $value): ?>
    	    	<li><?= $value ?></li>
    	    <?php endforeach ?>
    	</ul>

	    	
	        
    </body>

</html>