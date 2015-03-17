<?php
	session_start();

	include_once('Classes/Database.php');

	$db 		=	new PDO('mysql:host=localhost;dbname=opdracht-crud-cms', 'root', '');

	$dbInstance =   new Database( $db );

	$message	=	false;

	if (isset($_POST['inloggen']))
	{
		$email 		=	$_POST['email'];
		$password 	=	$_POST['password'];

		$userOpzoekQString = 'SELECT *
							FROM users
							WHERE email = :email';

		$userOpzoekQPH 	= 	array(':email'=> $email);

		$user = $dbInstance->query($userOpzoekQString, $userOpzoekQPH);

		if (empty($user))
		{
			$message = 'De gebruiker ' . $email . ' is niet gevonden, gelieve u te registreren!';
	
			$_SESSION['notification']['type'] = 'error';
			$_SESSION['notification']['message'] = $message;
			header( 'location: registratie-form.php' );
		}
		else
		{
			$saltDB 	=	$user[0]['salt'];
			$hashedPassword 	=	hash('sha512', $saltDB . $password);

			if ($hashedPassword === $user[0]['hashed_password'])
			{
				$hashMailSalt 	=	hash('sha512', $email . $saltDB);

				$cookieValue 	=	$email . ',' . $hashMailSalt;
				setcookie('login', $cookieValue, time() + 60*60*24*30);

				$message = 'Uw bent ingelogd.';
				$_SESSION['notification']['type'] = 'notice';
				$_SESSION['notification']['message'] = $message;

				header( 'location: dashboard.php' );
			}
			else
			{
				$message = 'Uw e-mail en/of paswoord is fout! Gelieve opnieuw te proberen.';
	
				$_SESSION['notification']['type'] = 'error';
				$_SESSION['notification']['message'] = $message;
				header( 'location: login-form.php' );
			}
		}
	}
?>