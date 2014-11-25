<?php

	$tafels = array();

	$tafelstot = 10;

	$teller = 0;


	while ($teller <= $tafelstot)
	{
		$tafelcontainer = array() ;

		$maal = 0;

		while ($maal <= 10)
		{
			$tafelcontainer [] = $teller * $maal;



			++$maal;
		}


		$tafels [$teller] = $tafelcontainer;




		++$teller;
	}
	

?>


<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht-while deel 2</title>
        <style>
        .even
            {
                background-color:   green;
            }
        </style>
    </head>

    <body>

    	<h1>Opdracht-while deel 2:</h1>

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