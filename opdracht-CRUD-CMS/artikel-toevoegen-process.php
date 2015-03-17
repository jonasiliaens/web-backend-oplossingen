<?php
	session_start();

	include_once('Classes/Database.php');

	$db 		=	new PDO('mysql:host=localhost;dbname=opdracht-crud-cms', 'root', '');

	$dbInstance =   new Database( $db );

	$message	=	false;

	if (isset($_POST['artikelToevoegen']))
	{
		$titel 			=	$_POST['titel'];
		$artikel 		=	$_POST['artikel'];
		$kernwoorden 	=	$_POST['kernwoorden'];
		$datum 			=	$_POST['datum'];
		
		$insertQueryString 	=	'INSERT INTO artikels
											(titel,
            								 artikel,
            								 kernwoorden,
            								 datum)
  								VALUES (:titel,
  								        :artikel,
  								        :kernwoorden,
  								        :datum)';
		
		$insertQueryPH = array( ':titel'=> $titel,
									':artikel'=> $artikel,
									':kernwoorden'=> $kernwoorden,
									':datum'=>  $datum);

		$dbInstance->insert($insertQueryString, $insertQueryPH);

		$message = 'Uw artikel is met succes toegevoegd.';
		$_SESSION['notification']['type'] = 'notice';
		$_SESSION['notification']['message'] = $message;

		header( 'location: artikel-overzicht.php' );
	}
?>