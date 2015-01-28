<?php

	define( 'BASE_URL', 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ] );

	$lastID 	=	false;

	$errorMessage 	=	'';

	if (isset($_POST['submit']))
	{
		try
		{
			$db 		=	new PDO('mysql:host=localhost;dbname=bieren', 'root', '');

			$naam 		=	$_POST['brnaam'];
			$adres 		=	$_POST['adres'];
			$postcode 	=	$_POST['postcode'];
			$gemeente 	=	$_POST['gemeente'];
			$omzet 		=	$_POST['omzet'];
	
			$queryString 	=	'INSERT INTO brouwers
        	     							(brnaam,
        	     							adres,
        	     							postcode,
        	     							gemeente,
        	     							omzet)
								VALUES
											(:naam,
        	    							 :adres,
        	    							 :postcode,
        	    							 :gemeente,
        	    							 :omzet)';
		
			$statement 		=	$db->prepare($queryString);
	
			$statement->bindValue(':naam', $naam);
			$statement->bindValue(':adres', $adres);
			$statement->bindValue(':postcode', $postcode);
			$statement->bindValue(':gemeente', $gemeente);
			$statement->bindValue(':omzet', $omzet);
	
			$statement->execute();
	
			$lastID 	=	$db->lastInsertId();

			$err 	=	$statement->errorInfo();
			$error 	=	$err[2];

			if ($error != null)
			{
				throw new Exception($error);
			}	
		}
		catch (Exception $e)
		{
			$errorMessage 	=	'Er ging iets mis, foutmelding: ' . $e->getMessage();
		}
	}
	
?>


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht CRUD Insert</title>
        <link rel="author" href="humans.txt">
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

        	.bevestiging
        	{
        		background-color: #66FF66;
        	}
        </style>
    </head>
    <body>
    	<h1>Opdracht CRUD Insert</h1>

    	<h2>Voeg nieuwe brouwer toe</h2>

    	<p><?= $errorMessage ?></p>

    	<?php if ($lastID): ?>
    		<p class="bevestiging">Brouwerij succesvol toegevoegd. Het unieke nummer van deze brouwerij is <?= $lastID ?></p>
    	<?php endif ?>

    	<form action="<?= BASE_URL ?>" method="POST">
    		<label for="brnaam">Brouwernaam
    			<input type="text" name="brnaam" id="brnaam">
    		</label>

    		<label for="adres">Adres
    			<input type="text" name="adres" id="adres">
    		</label>

    		<label for="postcode">Postcode
    			<input type="text" name="postcode" id="postcode">
    		</label>

    		<label for="gemeente">Gemeente
    			<input type="text" name="gemeente" id="gemeente">
    		</label>

    		<label for="omzet">Omzet
    			<input type="text" name="omzet" id="omzet">
    		</label>

    		<input type="submit" name="submit" value="Voeg toe">
    	</form>
        
    </body>
</html>