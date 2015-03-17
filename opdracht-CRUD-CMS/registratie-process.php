<?php
	session_start();

	include_once('Classes/Database.php');

	$db 		=	new PDO('mysql:host=localhost;dbname=opdracht-crud-cms', 'root', '');

	$dbInstance =   new Database( $db );

	$message	=	false;

	if (isset($_POST['registreer']))
	{
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		{
			$email 		= 	$_POST['email'];

			$controleMailQueryString = 'SELECT email
										FROM users
										WHERE email = :email';

			$controleMailPH 	= 	array(':email'=> $email);

			$resultaat = $dbInstance->query($controleMailQueryString, $controleMailPH);

			if ($_POST['password'] == '')
			{
				$message = 'Opgelet, Paswoord mag niet leeg zijn!';
	
				$_SESSION['notification']['type'] = 'error';
				$_SESSION['notification']['message'] = $message;
				header( 'location: registratie-form.php' );
			}
			else
			{
				if ($resultaat)
				{
					$message = 'Dit mailadres bestaat al, gelieve een ander te gebruiken of <a href="login-form.php">in te loggen</a>';
	
					$_SESSION['notification']['type'] = 'error';
					$_SESSION['notification']['message'] = $message;
					header( 'location: registratie-form.php' );
				}
				else
				{
	
					$password 	=	$_POST['password'];
					$salt 		= 	uniqid(mt_rand(), true);
					$logintime 	=	'NOW()';
			
					$hashedPassword 	=	hash('sha512', $salt . $password);
			
					$insertQueryString 	=	'INSERT INTO users
														(email,
        			    								 salt,
        			    								 hashed_password,
        			    								 last_login_time)
  											VALUES (:email,
  											        :salt,
  											        :password,
  											        :logintime)';
					
					$insertQueryPlaceholders = array( ':email'=> $email,
														':salt'=> $salt,
														':password'=> $hashedPassword,
														':logintime'=>  $logintime);
			
					$dbInstance->insert($insertQueryString, $insertQueryPlaceholders);
		
					$hashMailSalt 	=	hash('sha512', $email . $salt);
					$cookieValue 	=	$email . ',' . $hashMailSalt;
		
					setcookie('login', $cookieValue, time() + 60*60*24*30);
					header( 'location: dashboard.php' );
				}
			}
		}
		else
		{
			$message = 'Dit mailadres is in een fout formaat, vb: azerty@mail.be';

			$_SESSION['notification']['type'] = 'error';
			$_SESSION['notification']['message'] = $message;
			header( 'location: registratie-form.php' );
		}
	}

	if (isset($_POST['genereer']))
	{
		$email 	=	$_POST['email'];

		$generatedPassword	=	generatePassword(16, true, true, true);

		$_SESSION['registration']['email']		=	$email;
		$_SESSION['registration']['password']	=	$generatedPassword;

		header( 'location: registratie-form.php' );
	}

	function generatePassword($lengte,
							$numeriek 		= true,
							$alpha 			= false,
							$uppercase 		= false,
							$specialChars 	= false)
	{
		$password 		= 	'';
	
		$passwordChars 	=	array();
	
		if ($numeriek) 
		{
			$passwordChars['numeriek'] = array(0,1,2,3,4,5,6,7,8,9); // hardcoded array met opeenvolgende cijfers/letters kunnen vervangen worden door (voor bv. cijfers) range(0,9)
		}	
			
		if ($alpha) 
		{
			$passwordChars['alpha'] = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
		}	
			
		if ($uppercase) 
		{
			$passwordChars['uppercase'] = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		}	
			
		if ($specialChars) 
		{
			$passwordChars['specialChars'] = array('+','-','*','/','$','%','@','#','_');
		}

		$characterCount = 0;
		
		while ($characterCount < $lengte) 
		{
		
			$arrayCount = 0;
		
			foreach ($passwordChars as $value) 
			{
				if ($characterCount < $lengte)
				{
					$randomCharacter = rand(0,(count($value)-1));
					
					$password .= $value[$randomCharacter];
					
					$characterCount++;
				}
				
				$arrayCount++;
			}
		}
		
		$password = str_shuffle($password);
		
		return $password;	
	}
?>