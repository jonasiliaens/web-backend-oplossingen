<?php
	session_start();

	include_once('Classes/Database.php');

	$db 		=	new PDO('mysql:host=localhost;dbname=opdracht-file-upload', 'root', '');

	$dbInstance =   new Database( $db );
	
	$message 	= false;
	$type 		= false;

	if (isset($_POST['gegevensWijzigen']))
	{
		$userId 	= 	$_POST['id'];
		$email 		=	$_POST['email'];
		$emailInput =	$_POST['emailInput'];
		
		if ($_FILES['profile_picture']['type'] == 'image/jpeg' 
			|| $_FILES['profile_picture']['type'] == 'image/png' 
			|| $_FILES['profile_picture']['type'] == 'image/gif' 
			&& $_FILES["file"]["size"] < 2000000)
		{
			if ($_FILES['profile_picture']['error'] > 0)
			{
				//fout afhandelen
			}
			else
			{
				define('ROOT', dirname(__FILE__));

				if (file_exists(ROOT . '/img/' . $_FILES['profile_picture']['name']))
				{
					$message 	= 'Deze file bestaat al';
					$type		=	'error';
				}
				else
				{
					$bestandsNaam 	=	time() . '_' . $_FILES['profile_picture']['name'];

					move_uploaded_file($_FILES['profile_picture']['tmp_name'], (ROOT . '/img/' . $bestandsNaam));

					$updateQString 	=	'UPDATE users 
                      						SET profile_picture = :profile_picture
                          					WHERE id  = :userId';

        			$updatePH 		=	array( ':profile_picture'=> $bestandsNaam,
												':userId'=> $userId);

        			$dbInstance->insert($updateQString, $updatePH);

					$message =	'File succesvol geupload';
					$type 	=	'notice';
				}
			}
		}

		if ($email !== $emailInput)
		{
			$updateQString 	=	'UPDATE users 
                      				SET email = :email
                          			WHERE id  = :userId';

        	$updatePH 		=	array( ':email'=> $emailInput,
										':userId'=> $userId);

        	$dbInstance->insert($updateQString, $updatePH);
			
			$userQueryString = 'SELECT salt
								FROM users
								WHERE email = :email';

			$userQueryPH 	=	array(':email'=> $emailInput);

			$results	 	=	$dbInstance->query($userQueryString, $userQueryPH);

			$saltDB 		=	$results[0]['salt'];

			$hashMailSalt 	=	hash('sha512', $emailInput . $saltDB);

			$cookieValue 	=	$emailInput . ',' . $hashMailSalt;
			setcookie('login', $cookieValue, time() + 60*60*24*30);

			$message =	'E-mail succesvol gewijzigd';
			$type 	=	'notice';
		}
	}

	if ($message)
	{
		$_SESSION['notification']['type'] = $type;
		$_SESSION['notification']['message'] = $message;

		header( 'location: gegevens-wijzigen-form.php' );
	}
?>