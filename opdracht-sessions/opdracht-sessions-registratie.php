<?php

    session_start();

    if ( isset( $_GET['session'] ) )
    {
        if ( $_GET['session']  == 'destroy' )
        {
            session_destroy( );
            header( 'location: opdracht-sessions-registratie.php' );
        }
    }



?>


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht Sessions Registratie</title>
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
    	<h1>Deel 1: Registratiegegevens</h1>

        <a href="opdracht-sessions-registratie.php?session=destroy">Vernietig sessie</a>


        <form action="opdracht-sessions-adres.php" method="POST">
		    	<label for="email">e-mail
		    		<input type="text" name="email" id="email">
		    	</label>

		    	<label for="nickname">Nickname
		    		<input type="text" name="nickname" id="nickname">
		    	</label>

		    	<label>
		    		<input type="submit" name="verzenden" id="verzenden">
		    	</label>
	    </form>

    </body>
</html>