<?php

	$tafels = array();

	$tafelstot = 10;



	for ($teller = 0; $teller <= $tafelstot; ++$teller)
	{
		$tafelcontainer = array() ;

		for ($maal = 0; $maal <= 10; ++$maal)
		{
			$tafelcontainer [] = $teller * $maal;
			
		}


		$tafels [$teller] = $tafelcontainer;
		
	}
	

?>


<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht-for deel 2</title>
        <style>
        .even
            {
                background-color:   green;
            }
        </style>
    </head>

    <body>

    	<h1>Opdracht-for deel 2:</h1>

    	<table>
    		<?php foreach($tafels as $key=>$value): ?>
    			<tr>

    				<?php foreach($value as $product): ?>
    					<td class="<?= (($product) % 2 > 0) ? ' ' : 'even' ?>"><?php echo $product ?></td>
        			<?php endforeach ?>

        			
    			</tr>
    		<?php endforeach ?>
		</table>


    	
        
    </body>
</html>