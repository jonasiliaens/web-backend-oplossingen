<?php
	session_start();
    
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
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht image manipulation thumb</title>
        <style>
        .notification
      	{
      		display: inline-block;
      		padding: 5px;
      		border: 1px solid;
      		border-radius: 5px;
      	}
	
      	.error
      	{
      		background-color: #FF3333;
      		border: 1px solid #990000;
      	}
	
      	.succes
      	{
      		background-color: #99FF33;
      		border: 1px solid #339900;
      	}
        </style>
    </head>
    <body>
    	<h1>Opdracht image manipulation thumb (met gebruik van classes)</h1>

    	<?php if ($message): ?>
    		<p class="notification <?= $message['type'] ?> "><?= $message['text'] ?></p>
    	<?php endif ?>

    	<form action="process.php" method="POST" enctype="multipart/form-data">
	    
	    <ul>
	        <li>
	            <label for="image">Foto Kiezen
	            	<input type="file" id="image" name="image">
	            </label>
	        </li>
	    </ul>
	    	<input type="submit" name="submit" value="Resizen">
		</form>
        
    </body>
</html>