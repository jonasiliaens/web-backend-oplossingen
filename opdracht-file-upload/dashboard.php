<?php
	session_start();

	include_once('Classes/Database.php');

	$db 		=	new PDO('mysql:host=localhost;dbname=opdracht-file-upload', 'root', '');

	$dbInstance =   new Database( $db );

	$loginUser 		     =	 false;
	$notification      =   false;
	$typeNotification	 =   false;
  $message           =   false;

  	if (isset($_SESSION['notification']))
  	{
  	  $notification   		=   true;
  	  $typeNotification 	=   $_SESSION['notification']['type'];
  	  $message        		=   $_SESSION['notification']['message'];
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
        <title>Opdracht File Upload - Dashboard</title>
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

    <?php if ($loginUser): ?>
	    <h1>Opdracht File Upload - Dashboard</h1>

      <p><a href="dashboard.php">Terug naar dashboard</a> | Ingelogd als <?= $loginUser ?> | <a href="logout.php">uitloggen</a></p>

	    <?php if ($notification): ?>
        <p class="notification <?= $typeNotification ?>"><?= $message ?></p>
      <?php endif ?>

      <ul>
        <li><a href="artikel-overzicht.php">Artikels</a></li>
        <li><a href="gegevens-wijzigen-form.php">Gegevens wijzigen</a></li>
      </ul>
	    
	<?php endif ?>


      
    </body>
</html>