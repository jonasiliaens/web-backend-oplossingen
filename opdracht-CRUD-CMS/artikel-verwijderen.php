<?php
	include_once('Classes/Database.php');

	$db 		=	new PDO('mysql:host=localhost;dbname=opdracht-crud-cms', 'root', '');

	$dbInstance =   new Database( $db );
	
	if (isset($_GET['artikel']))
	{
		$artikelId = $_GET['artikel'];

		$updateQstring 	=	'UPDATE artikels SET is_archived = 1 WHERE artikelId=:artikelId';

		$updatePH 	= 	array(':artikelId'=> $artikelId);

		$dbInstance->query($updateQstring, $updatePH);

		header( 'location: artikel-overzicht.php' );
	}
?>