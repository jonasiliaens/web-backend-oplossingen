<?php
  session_start();

  $notification     =   false;
  $typeNotification =   false;
  $message          =   false;

  if (isset($_SESSION['notification']))
  {
    $notification   =   true;
    $typeNotification   =   $_SESSION['notification']['type'];
    $message        =   $_SESSION['notification']['message'];
    session_destroy();
  }

  if (isset($_COOKIE['login']))
  {
    $message = 'U bent al ingelogd!';
  
    $_SESSION['notification']['type'] = 'notice';
    $_SESSION['notification']['message'] = $message;
    header( 'location: dashboard.php' );
  }
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht File Upload - Inloggen</title>
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

    	<h1>Opdracht File Upload - Inloggen</h1>

      <?php if ($notification): ?>
        <p class="notification <?= $typeNotification ?>"><?= $message ?></p>
      <?php endif ?>

      <div>
        <form action="login-process.php" method="POST"> 

          <label for="email">E-mail</label>
          <input type="text" name="email" id="email">

          <label for="password">Paswoord</label>
          <input type="password" name="password" id="password">

          <button type="submit" name="inloggen" >Inloggen</button>
        </form>
        <p>Nog geen account? Maak er dan eentje aan op de <a href="registratie-form.php">registratiepagina</a>.</p>
      </div>  
    </body>
</html>