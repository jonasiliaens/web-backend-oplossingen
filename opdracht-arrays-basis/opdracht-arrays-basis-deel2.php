<?php

	$getallen       =    array(1, 2, 3, 4, 5);
      
	$maal           =    array_product($getallen);
      
    $omkeer         =    array_reverse($getallen);
      
    $oneven         =    '';
      
    $getallensom    =    '';


	foreach ($getallen as $value) 
	{
		if ($value % 2 != 0)
        {
            $oneven [] = $value;
        }
	}

    foreach ($getallen as $key => $value) 
    {
        if (isset($omkeer [$key] ))
        {
            $getallensom = $omkeer [$key] + $value;
        }
    }




?>

<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Oplossing opdracht arrays basis deel 2</title>
    </head>

    <body>

    	<h1>Oplossing opdracht arrays basis deel 2</h1>

        <p>De array: <pre><?php var_dump($getallen) ?></pre></p>
                
    	<p>Alle getallen vermenigvuldigd: <?= $maal ?></p>

        <p>De oneven getallen: <pre><?= var_dump($oneven) ?></pre></p>

        <p> De array omgekeerd: <pre><?= var_dump($omkeer) ?></pre></p>

        <p>De getallen van beide arrays met elkaar opgeteld: </p>

       

        
    </body>
</html>