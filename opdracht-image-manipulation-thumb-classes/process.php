<?php
	session_start();

    function relocate( $url )
    {
        header('location: ' . $url );
    }

    function my_autoloader($class) {
        include 'classes/' . $class . '.php';
    }

    spl_autoload_register( 'my_autoloader' );

    define( 'BASE_URL', 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ] );

    $message    =   false;

    if ( Message::hasMessage() )
    {
        $message = Message::getMessage();
        Message::remove();
    }

	if (isset($_POST['submit']))
	{
		$image 	=	new Image($_FILES['image']['name'],
								$_FILES['image']['tmp_name'],
								$_FILES['image']['type'],
								$_FILES['image']['size']);

		$fileIsValid 	=	$image->validateFile();

		if ($fileIsValid)
		{
			$image->createThumbnail(100, 100);
			new Message( 'De thumbnail is gemaakt', 'succes' );
            relocate( 'form.php' );
		}
		else
		{
			new Message( 'De aangeboden file is van een fout bestandstype, of groter dan 5mb', 'error' );
            relocate( 'form.php' );
		}
	}

?>