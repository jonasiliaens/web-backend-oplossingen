
<?php
$getal = 5;
$dag = 'onbekende dag';

if ( $getal == 1 ) 
    { 
        $dag = 'maandag'; 
    } 

if ($getal == 2)
	{
		$dag = 'dinsdag';
	}

if ($getal == 3)
	{
		$dag = 'woensdag';
	} 

if ($getal == 4)
	{
		$dag = 'donderdag';
	}

if ($getal == 5)
	{
		$dag = 'vrijdag';
	}

if ($getal == 6)
	{
		$dag = 'zaterdag';
	}

if ($getal == 7)
	{
		$dag = 'zondag';
	}


?>




<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>oplossing conditional statements</title>
    </head>
    <body>
    	<h1>Oplossing deel 1 Conditional Statements:</h1>

        <p>De dag die overeenkomt met het getal "<?php echo $getal; ?>" is: <?php echo $dag; ?></p>
        
    </body>
</html>