<?php
	session_start();

	include_once('Classes/Database.php');

	$db 		=	new PDO('mysql:host=localhost;dbname=opdracht-crud-cms', 'root', '');

	$dbInstance =   new Database( $db );

	$loginUser 		   	=	false;
	$notification      	=   false;
	$typeNotification 	=   false;
  	$message           	=   false;

  	if (isset($_SESSION['notification']))
  	{
  	  	$notification   	=   true;
  	  	$typeNotification 	=   $_SESSION['notification']['type'];
  	  	$message        	=   $_SESSION['notification']['message'];
  	  	session_destroy();
  	}
	
	if (isset($_COOKIE['login']))
	{
		$cookie 		=	$_COOKIE['login'];
		$emailEnSalt 	=	explode(',', $cookie);
		$emailCookie	=	$emailEnSalt[0];
		$hashCookie		=	$emailEnSalt[1];

		$userQueryString = 'SELECT salt
							FROM users
							WHERE email = :email';

		$userQueryPH 	=	array(':email'=> $emailCookie);

		$results	 	=	$dbInstance->query($userQueryString, $userQueryPH);

		foreach ($results as $key => $salt) 
		{
			$saltUserDB = $salt;
		}

		$saltUserDB 	= 	implode($saltUserDB);

		$hashUserDB 	=	hash('sha512', $emailCookie . $saltUserDB);

		if ($hashUserDB === $hashCookie)
		{
			$loginUser 	=	$emailCookie;
		}
	}
	else
	{
		setcookie('login', $_COOKIE['login'], time() -3600);
		header('location: login-form.php');
	}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht CRUD CMS - Artikel Toevoegen</title>
    <style>
      label
      {
        display: block;
      }

      input
      {
        display: block;
        width: 200px;
        font-size: 13px;
        margin: 5px;
      }

      .notification
      {
      	display: inline-block;
      	padding: 5px;
      	border: 1px solid;
      	border-radius: 5px;
      }

      .error
      {
      	background-color: #FF3333;
      	border: 1px solid #990000;
      }

      .notice
      {
      	background-color: #99FF33;
      	border: 1px solid #339900;
      }
    </style>
    </head>
    <body>

	<h1>Opdracht CRUD CMS - Artikel Toevoegen</h1>

    <p><a href="dashboard.php">Terug naar dashboard</a> | Ingelogd als <?= $loginUser ?> | <a href="logout.php">uitloggen</a></p>
    <p><a href="artikel-overzicht.php">Terug naar overzicht</a></p>

	<?php if ($notification): ?>
    	<p class="notification <?= $typeNotification ?>"><?= $message ?></p>
    <?php endif ?>

    <h1>Artikel toevoegen</h1>

	<form action="artikel-toevoegen-process.php" method="POST">
	    
	    <ul>
	        <li>
	            <label for="titel">Titel</label>
	            <input type="text" id="titel" name="titel">
	        </li>

	        <li>
	            <label for="artikel">Artikel</label>
	            <textarea id="artikel" name="artikel"></textarea>
	        </li>

	        <li>
	            <label for="kernwoorden">Kernwoorden</label>
	            <input type="text" id="kernwoorden" name="kernwoorden">
	        </li>

	        <li>
	            <label for="datum">Datum (dd-mm-jjjj)</label>
	            <input type="text" id="datum" name="datum">
	        </li>

	        <input type="submit" name="artikelToevoegen" value="Artikel toevoegen">
	    </ul>
	</form>


    </body>
</html>