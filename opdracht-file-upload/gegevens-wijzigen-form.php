<?php
	session_start();

	include_once('Classes/Database.php');

	$db 		=	new PDO('mysql:host=localhost;dbname=opdracht-file-upload', 'root', '');

	$dbInstance =   new Database( $db );

	$loginUser 		   	=	false;
	$notification      	=   false;
	$typeNotification 	=   false;
  	$message           	=   false;
  	$profilePicture 	=	false;
  	$userId				=	false;

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

		$userQueryString = 'SELECT salt, profile_picture, id
							FROM users
							WHERE email = :email';

		$userQueryPH 	=	array(':email'=> $emailCookie);

		$results	 	=	$dbInstance->query($userQueryString, $userQueryPH);

		$saltUserDB 	= 	$results[0]['salt'];

		$hashUserDB 	=	hash('sha512', $emailCookie . $saltUserDB);

		if ($hashUserDB === $hashCookie)
		{
			$loginUser 		=	$emailCookie;
			$profilePicture =	$results[0]['profile_picture'];
			$userId			=	$results[0]['id'];
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
        <title>Opdracht File Upload - Gegevens wijzigen</title>
    <style>
    	img
    	{
    		width: 300px;
    	}

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

	<h1>Opdracht File Upload - Gegevens wijzigen</h1>

    <p><a href="dashboard.php">Terug naar dashboard</a> | Ingelogd als <?= $loginUser ?> | <a href="logout.php">uitloggen</a></p>

	<?php if ($notification): ?>
    	<p class="notification <?= $typeNotification ?>"><?= $message ?></p>
    <?php endif ?>

    <h1>Gegevens wijzigen</h1>

	<form action="gegevens-wijzigen-process.php" method="POST" enctype="multipart/form-data">
	    
	    <ul>
	        <li>
	            <label for="profile_picture">Profielfoto</label>
	            <img src="img/<?= ( $profilePicture != '' ) ? $profilePicture : 'default-placeholder.png' ?>" alt="<?= $loginUser ?>">
	            <input type="file" id="profile_picture" name="profile_picture">
	        </li>

	        <li>
	            <label for="emailInput">E-mail</label>
	            <input type="text" id="emailInput" name="emailInput" value="<?= $loginUser ?>">
	        </li>
	    </ul>
	    <input type="hidden" name="id" value="<?= $userId ?>">
	    <input type="hidden" name="email" value="<?= $loginUser ?>">
	    <input type="submit" name="gegevensWijzigen" value="Gegevens Wijzigen">
	</form>


    </body>
</html>