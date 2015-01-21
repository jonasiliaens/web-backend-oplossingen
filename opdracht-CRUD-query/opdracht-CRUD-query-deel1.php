<?php

	$message 	=	'';

	try
	{
		$db 		=	new PDO('mysql:host=localhost;dbname=bieren', 'root', '');
		$message 	=	'Connectie met de database is geslaagd';

		$queryString 		=	'SELECT * 
							FROM `bieren` 
    						INNER JOIN brouwers 
    						ON bieren.brouwernr = brouwers.brouwernr 
    						WHERE bieren.naam LIKE "Du%" 
    						AND brouwers.brnaam LIKE "%a%"';

   		$statement 	=	$db->prepare($queryString);

   		$statement->execute();

   		$fetch 		=	array();

   		while ($row = $statement->fetch(PDO::FETCH_ASSOC))
   		{
   			$fetch[] 	=	$row;
   		}

   		$kolomNamen 	=	array();
   		$kolomNamen[] 	=	'#';

   		foreach ($fetch[0] as $key => $value) 
   		{
   			$kolomNamen[] 	=	$key;
   		}

	}
	catch (PDOexception $e)
	{
		$message 	=	'Er ging iets mis' . $e->getMessage();
	}

?>


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht CRUD Query - Deel 1</title>
        <style>
        	table
			{
			    margin:8px 0;
			    border:1px solid lightgrey;
			    border-collapse: collapse;
			}
			
			td, th
			{
			    padding:8px;
			    border:1px solid lightgrey;
			}
        </style>
    </head>
    <body>
    	<h1>Opdracht CRUD Query - Deel 1</h1>

    	<p><?= $message ?></p>

    	<table>
    		<thead>
    			<tr>
    				<?php foreach ($kolomNamen as $kolomnaam): ?>
    					<td><?= $kolomnaam ?></td>
    				<?php endforeach ?>
    			</tr>
    		</thead>

    		<tbody>
    			<?php foreach ($fetch as $key => $bier): ?>
					<tr>
						<td><?= ($key + 1) ?></td>
						<?php foreach ($bier as $value): ?>
							<td><?= $value ?></td>
						<?php endforeach ?>
					</tr>
				<?php endforeach ?>
    		</tbody>
    	</table>
    </body>
</html>