<?php
	
	$inhoudTxt 		= 	file_get_contents('opdracht-cookies-deel1.txt');

	$arrayInhoudTxt = 	explode(',', $inhoudTxt);

	$loggedIn 		= 	false;

	$message 		= 	'';

	if (isset($_GET[ 'cookie' ]))
	{
		if ($_GET[ 'cookie' ] == 'delete')
		{
			setcookie('authenticated', true, time() - 3600);
			header('location: opdracht-cookies-deel1.php');
		}
	}

	if (isset($_POST[ 'verzenden' ]))
	{
		$username 	=	$_POST[ 'gebruiker' ];

		$password 	= 	$_POST[ 'paswoord' ];

		if ($arrayInhoudTxt[ '0' ] == $username && $arrayInhoudTxt[ '1' ] == $password)
		{
			setcookie('authenticated', true, time() + 3600);
			header('location: opdracht-cookies-deel1.php');
		}
		else
		{
			$message 	= 	'Gebruikersnaam en/of paswoord niet correct. Probeer opnieuw.';
		}
	}

	if (isset($_COOKIE[ 'authenticated' ]))
	{
		$loggedIn 	= 	true;
	}


?>



<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht Cookies deel 1</title>
        <style>
        	body
        	{
        		width: 1024px;
        		margin: auto 20px;
        	}
        	label
        	{
        		display: block;
        	}

        	input
        	{
        		display: block;
        		margin: 5px;
        	}
        	
        	.foutBoodschap
        	{
        		color: red;
        		background-color: #FEA2A3;
        	}
        </style>
    </head>
    <body>
    	<h1>Opdracht Cookies deel 1</h1>

    	<?php if ($message): ?>
    		<p class="foutBoodschap"><?= $message ?></p>
    	<?php endif ?>

    	<?php if ($loggedIn): ?>

    		<p>U bent ingelogd</p>
    		<a href="?cookie=delete">Uitloggen</a>

    	<?php else: ?>

	    	<form action="<?= $_SERVER[ 'PHP_SELF' ] ?>" method="POST">
		    	<label for="gebruiker">Gebruiker
		    		<input type="text" name="gebruiker" id="gebruiker">
		    	</label>

		    	<label for="paswoord">Paswoord
		    		<input type="password" name="paswoord" id="paswoord">
		    	</label>

		    	<label>
		    		<input type="submit" name="verzenden" id="verzenden">
		    	</label>
	    	</form>

	    <?php endif ?>
        
      
    </body>
</html>