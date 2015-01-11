<?php
	
	function my_autoloader ($class_name)
	{
		include ('classes/'.$class_name.'.php');
	}

    spl_autoload_register('my_autoloader');

	$run 	=	new Percent(150, 100);

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht Classes: begin</title>
        <style>
                table
                {
                    border:1px solid lightgrey;
                    border-collapse:collapse;
                    max-width:350px;
                }
                
                td
                {
                    border:1px solid lightgrey;
                    padding:12px;
                }
        </style>
    </head>
    <body>

    	<h1>Opdracht Classes: begin</h1>

    	<table>
        	<caption>Hoeveel procent is 150 van 100?</caption>
        	<tbody>
        	    <tr>
        	        <td>Absoluut</td>
        	        <td><?= $run->absolute ?></td>
        	    </tr>
        	    <tr>
        	        <td>Relatief</td>
        	        <td><?= $run->relative ?></td>
        	    </tr>
        	    <tr>
        	        <td>Geheel getal</td>
        	        <td><?= $run->hundred ?>%</td>
        	    </tr>
        	    <tr>
        	        <td>Nominaal</td>
        	        <td><?= $run->nominal ?></td>
        	    </tr>
        	</tbody>
   		</table>
        
    </body>
</html>