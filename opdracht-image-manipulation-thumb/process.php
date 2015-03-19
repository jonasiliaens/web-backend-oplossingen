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
		if ($_FILES['picture']['type'] == 'image/jpeg' 
			|| $_FILES['picture']['type'] == 'image/png' 
			|| $_FILES['picture']['type'] == 'image/gif' 
			&& $_FILES['picture']['size'] < 5000000)
		{
			$imageFile 	=	$_FILES['picture']['tmp_name'];

			$fileParts	=	pathinfo($_FILES['picture']['name']);
			$fileName	=	$fileParts['filename'];
			$ext		=	$fileParts['extension'];

			$thumbDimensions['w'] 	=	100;
			$thumbDimensions['h'] 	=	100;
		
			list($width, $height) = getimagesize($imageFile);

			if ($width < $height)
			{
				$imageDimension 	=	'portret';
				$cropDimensions['w'] = $width;
				$cropDimensions['h'] = $width;
				$x 	=	0;
				$y 	=	($height - $width)/2;
			}

			if ($width > $height)
			{
				$imageDimension 	=	'landscape';
				$cropDimensions['w'] = $height;
				$cropDimensions['h'] = $height;
				$x 	=	($width - $height)/2;
				$y 	=	0;
			}

			if ($width == $height)
			{
				$imageDimension 	=	'square';
				$x 	=	0;
				$y 	=	0;
			}

			switch ($ext)
			{
				case ('jpg'):
				case ('jpeg'):
					$source 	= 	imagecreatefromjpeg($imageFile);
					break;
					
				case ('png'):
					$source 	=	imagecreatefrompng($imageFile);
					break;
		
				case ('gif'):
					$source 	=	imagecreatefromgif($imageFile);
					break;
			}

			if ($imageDimension == 'landscape' || $imageDimension == 'portret')
			{
				$crop = imagecreatetruecolor($cropDimensions['w'], $cropDimensions['h']);
	
				imagecopyresized($crop, $source, 0,0,$x,$y, $cropDimensions['w'],$cropDimensions['h'], $cropDimensions['w'], $cropDimensions['h']);
		
				$thumb = imagecreatetruecolor($thumbDimensions['w'], $thumbDimensions['h']);
		
				imagecopyresized($thumb, $crop, 0,0,0,0, $thumbDimensions['w'],$thumbDimensions['h'], $cropDimensions['w'], $cropDimensions['h']);
			}
	
			if ($imageDimension == 'square')
			{
				$thumb = imagecreatetruecolor($thumbDimensions['w'], $thumbDimensions['h']);
		
				imagecopyresized($thumb, $source, 0,0,0,0, $thumbDimensions['w'],$thumbDimensions['h'], $width, $height);
			}
			
			$resized 	= 	imagejpeg($thumb, ('img/'.$fileName. '_thumb.jpg'), 100);

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