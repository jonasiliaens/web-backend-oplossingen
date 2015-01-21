<?php

	$message 	=	'';

	try
	{
		$db 		=	new PDO('mysql:host=localhost;dbname=bieren', 'root', '');
		$message 	=	'Connectie met de database is geslaagd';
	}
	catch (PDOexception $e)
	{
		$message 	=	'Er ging iets mis' . $e->getMessage();
	}

	


?>


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht CRUD Query</title>
    </head>
    <body>
    	<h1>Opdracht CRUD Query</h1>

    	<p><?= $message ?></p>
        
    </body>
</html>