<?php

    session_start();


    if (isset($_POST['verzenden']))
    {
        $_SESSION['dataRegistratie']['straat'] = $_POST['straat'];
        $_SESSION['dataRegistratie']['nummer'] = $_POST['nummer'];
        $_SESSION['dataRegistratie']['gemeente'] = $_POST['gemeente'];
        $_SESSION['dataRegistratie']['postcode'] = $_POST['postcode'];
    }

    $dataRegistratie2['registratie'] = $_SESSION['dataRegistratie'];






?>


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht Sessions Overzicht</title>
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
    	<h2>Deel 3: Overzicht:</h2>
        <ul>
            <?php foreach ($dataRegistratie2['registratie'] as $key => $value): ?>
                <li><?= $key ?>: <?= $value ?></li>
            <?php endforeach ?>
        </ul>

        
        

    </body>
</html>