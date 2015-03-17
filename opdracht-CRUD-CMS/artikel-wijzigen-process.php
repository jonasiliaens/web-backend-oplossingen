<?php
	session_start();

	include_once('Classes/Database.php');

	$db 		=	new PDO('mysql:host=localhost;dbname=opdracht-crud-cms', 'root', '');

	$dbInstance =   new Database( $db );

	if (isset($_POST['artikelWijzigen']))
	{
		$artikelId 		= 	$_POST['artikelId'];
		$titel 			= 	$_POST['titel'];
		$artikel 		= 	$_POST['artikel'];
		$kernwoorden 	= 	$_POST['kernwoorden'];
		$datum 			= 	$_POST['datum'];

		$updateQString 	=	'UPDATE artikels 
                      		SET titel = :titel,
                          		artikel = :artikel,
                          		kernwoorden = :kernwoorden,
                          		datum = :datum
                          	WHERE artikelId  = :artikelId';

        $updatePH 		=	array( ':artikelId'=> $artikelId,
        							':titel'=> $titel,
									':artikel'=> $artikel,
									':kernwoorden'=> $kernwoorden,
									':datum'=>  $datum);

        $dbInstance->insert($updateQString, $updatePH);

		header( 'location: artikel-overzicht.php' );
	}
?>