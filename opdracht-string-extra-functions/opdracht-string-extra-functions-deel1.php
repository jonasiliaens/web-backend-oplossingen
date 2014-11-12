<?php

	$fruit		=	'kokosnoot';

	$lengte		=	strlen($fruit);

	$zoekletter	=	'o';

	$eersteO	=	strpos($fruit, $zoekletter)



?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Untitled</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="author" href="humans.txt">
    </head>
    <body>


    	<p>Aantal karakters van variabele fruit: <?= $lengte?></p>
    	<p>Positie van de eerste o: <?= $eersteO?></p>


        
        <script src="js/main.js"></script>
    </body>
</html>