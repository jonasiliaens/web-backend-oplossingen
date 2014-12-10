<?php

	$password 	=	'azert';

	$username 	=	'Jonas';

	$boodschap	=	'Gelieve in te loggen';

	if (isset($_POST ['verzenden']))
	{
		if ($_POST['gebruiker'] == $username && $_POST['paswoord'] == $password) //beter eerst opvangen in een variabele
		{
			$boodschap = 'U bent ingelogd.';
		}
		else
		{
			$boodschap = 'Uw wachtwoord en username komen niet overéén, probeer opnieuw.';
		}
	}



?>



<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht post</title>
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
        </style>
    </head>

    <body>
    	<h1>Opdracht post</h1>

    	<form action="opdracht-post.php" method="POST">
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

    	<p><?= $boodschap ?></p>
        
    </body>
</html>