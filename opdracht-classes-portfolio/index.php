<?php

	function my_autoloader ($class_name)
	{
		include ('classes/'.$class_name.'.php');
	}

    spl_autoload_register('my_autoloader');

    $page 	=	new HTMLBuilder('header.partial.php','body.partial.php','footer.partial.php');



?>