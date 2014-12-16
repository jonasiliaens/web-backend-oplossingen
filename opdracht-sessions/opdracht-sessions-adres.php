<?php

    session_start();

    if (isset($_POST['verzenden']))
    {
        $_SESSION['dataRegistratie']['email'] = $_POST['email'];
        $_SESSION['dataRegistratie']['Nickname'] = $_POST['nickname'];
    }

    $dataRegistratie1['registratie'] = $_SESSION['dataRegistratie'];





?>


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht Sessions Adres</title>
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
    	<h2>Registratiegegevens:</h2>
        <ul>
            <?php foreach ($dataRegistratie1['registratie'] as $key => $value): ?>
                <li><?= $key ?>: <?= $value ?></li>
            <?php endforeach ?>
        </ul>

        <h2>Deel 2: Adresgegevens:</h2>
        <form action="opdracht-sessions-overzicht.php" method="POST">
                <label for="straat">Straat
                    <input type="text" name="straat" id="straat">
                </label>

                <label for="nummer">Nummer
                    <input type="text" name="nummer" id="nummer">
                </label>

                <label for="gemeente">Gemeente
                    <input type="text" name="gemeente" id="gemeente">
                </label>

                <label for="postcode">Postcode
                    <input type="text" name="postcode" id="postcode">
                </label>

                <label>
                    <input type="submit" name="verzenden" id="verzenden">
                </label>
        </form>
        

    </body>
</html>