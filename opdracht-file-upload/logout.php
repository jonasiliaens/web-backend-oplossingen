<?php
	session_start();

	setcookie('login', $_COOKIE['login'], time() -3600);

	$_SESSION['notification']['message'] 	=	'U bent uitgelogd. Tot de volgende keer';
	$_SESSION['notification']['type'] 	=	'notice';
	
	header('location: login-form.php');
?>