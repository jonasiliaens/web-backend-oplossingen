<?php
	class Todo
	{	
		public function __construct($post, $soort, $sessie)
		{
			$todo 		=	$_SESSION[$soort][$_POST[$post]];
			unset($_SESSION[$soort][$_POST[$post]]);
			$_SESSION[$sessie][] 	=	$todo;
			$todosTonen				=	true;
		}
	}
?>