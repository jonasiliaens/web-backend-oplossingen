<?php
	session_start();

	include_once('Classes/Database.php');

	$db 		=	new PDO('mysql:host=localhost;dbname=opdracht-crud-cms', 'root', '');

	$dbInstance =   new Database( $db );

	$loginUser 		     =	 false;
	$notification      =   false;
	$typeNotification	 =   false;
  $message           =   false;
  $artikels          =   false;

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

		$userQueryString = 'SELECT salt, user_type
							FROM users
							WHERE email = :email';

		$userQueryPH 	=	array(':email'=> $emailCookie);

		$results	 	=	$dbInstance->query($userQueryString, $userQueryPH);

		$saltUserDB = $results[0]['salt'];

		$hashUserDB 	=	hash('sha512', $emailCookie . $saltUserDB);

		if ($hashUserDB === $hashCookie)
		{
			$loginUser 	=	$emailCookie;
      $userType   = $results[0]['user_type'];
		}

	}
	else
	{
		setcookie('login', $_COOKIE['login'], time() -3600);
		header('location: login-form.php');
	}

  $alleArtikelsQString = 'SELECT *
                          FROM artikels
                          WHERE 1';

  $artikels = $dbInstance->query($alleArtikelsQString);

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht CRUD CMS - Artikels Overzicht</title>
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

      .artikel
      {
        margin-left: 10px;
      }

      .artikel h2
      {
        margin-left: 15px;
        padding-top: 3px;
        border-bottom: 1px solid lightgrey;
      }

      .artikel ul li
      {
        padding: 2px;
      }

      .artikel p
      {
        padding: 5px;
      }

      .artikel a
      {
        color: black;
      }

      .notActive
      {
        background-color: #999999;
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
	    <h1>Opdracht CRUD CMS - Artikels Overzicht</h1>

      <p><a href="dashboard.php">Terug naar dashboard</a> | Ingelogd als <?= $loginUser ?> | <a href="logout.php">uitloggen</a></p>

	    <?php if ($notification): ?>
        <p class="notification <?= $typeNotification ?>"><?= $message ?></p>
      <?php endif ?>

      <h1>Overzicht van de artikels</h1>

      <p><a href="artikel-toevoegen-form.php">Voeg een artikel toe</a></p>

      <?php foreach ($artikels as $artikel): ?>
        <?php if ($artikel['is_archived'] == 0): ?>
          <article class="artikel <?= ( $artikel['is_active'] == 0 ) ? 'notActive' : '' ?>">
            <h2><?= $artikel['titel'] ?></h2>
            <ul>
                <li>Artikel: <?= $artikel['artikel'] ?></li>
                <li>Kernwoorden: <?= $artikel['kernwoorden'] ?></li>
                <li>Datum: <?= $artikel['datum'] ?></li>
            </ul>

            <?php if ($userType == 0): ?>
              <p>
                  <a href="artikel-wijzigen-form.php?artikel=<?= $artikel['artikelId'] ?>">Artikel wijzigen</a> | 
                  <a href="artikel-activeren.php?artikel=<?= $artikel['artikelId'] ?>">Artikel <?= ( $artikel['is_active'] == 0 ) ? 'activeren' :   'deactiveren' ?></a> | 
                  <a href="artikel-verwijderen.php?artikel=<?= $artikel['artikelId'] ?>">Artikel verwijderen</a>
              </p>
            <?php endif ?>
          </article>
        <?php endif ?>
      <?php endforeach ?>
	    
	<?php endif ?>


      
    </body>
</html>