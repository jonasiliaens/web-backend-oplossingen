<?php
	class Delete
	{	
		public function __construct($deleteWelke, $sessie)
		{
			$delete 		=	$_POST[$deleteWelke];
			unset($_SESSION[$sessie][$delete]);
			$todosTonen 	=	true;
		}
	}
?>