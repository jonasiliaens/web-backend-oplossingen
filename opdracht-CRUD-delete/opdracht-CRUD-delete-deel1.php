<?php
	
	define( 'BASE_URL', 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ] );

	$message 	=	false;
	
	$db 		=	new PDO('mysql:host=localhost;dbname=bieren', 'root', '');

	if (isset($_POST['delete']))
   	{
   		$deleteBrId 	=	$_POST['delete'];
   		
   		$deleteQuery 	=	'DELETE FROM brouwers 
  								WHERE brouwernr  = :brouwerId
  								LIMIT 1';

  		$statementDelete 	=	$db->prepare($deleteQuery);
  		$statementDelete->bindValue(':brouwerId', $deleteBrId);

  		$statementDelete->execute();

  		$message 	=	'De brouwer is succesvol verwijderd.';
   	}

	$selectQuery 		=	'SELECT * 
								FROM `brouwers` 
								WHERE 1';

	$statementSelect 	=	$db->prepare($selectQuery);

	$statementSelect->execute();

	$brouwers 	=	array();

	while ($row = $statementSelect->fetch(PDO::FETCH_ASSOC))
   		{
   			$brouwers[] 	=	$row;
   		}

   	$brouwersKolomnamen = array_keys( $brouwers[0] );








?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht CRUD Delete - Deel 1</title>
    <style>
    	table 
    	{
            margin:8px 0;
            border:1px solid lightgrey;
            border-collapse: collapse;
         }

       	thead 
       	{
       		background-color: #999999;
       	}

        td, th 
        {
            padding:4px;
            border:1px solid lightgrey;
         }

    	.delete-button 
    	{
    		background-color: transparent;
    		border:none;
    	}

    	.bevestiging 
    	{
        	background-color: #66FF66;
        }

        .odd
        {
            background: #F1F1F1;
        }
    </style>
    </head>
    <body>

    	<h1>Opdracht CRUD Delete</h1>

    	<?php if ($message): ?>
    		<p class="bevestiging"><?= $message ?></p>
    	<?php endif ?>

    	<form action="<?= BASE_URL ?>" method="POST">
    		<table>

    			<thead>
    				<tr>
    					<th>#</th>
    					<?php foreach ($brouwersKolomnamen as $kolomnaam): ?>
    						<th><?= $kolomnaam ?></th>
    					<?php endforeach ?>
    					<th></th>
    				</tr>
    			</thead>

        		<tbody>
        		  <?php foreach ($brouwers as $key => $brouwer): ?>
        		    <tr class="<?= ( ( $key + 1 ) % 2 !== 0 ) ? 'odd' : '' ?>">
        		      <td><?= ($key + 1) ?></td>
        		      <?php foreach ($brouwer as $value): ?>
        		        <td><?= $value ?></td>
        		      <?php endforeach ?>
        		      <td>
        		      	<button type="submit" name="delete" value="<?= $brouwer['brouwernr'] ?>" class="delete-button">
        		      		<img src="icon-delete.png" alt="Icon Delete">
        		      	</button>
        		      </td>
        		    </tr>
        		  <?php endforeach ?>
        		</tbody>

      		</table>
      	</form>
        
    </body>
</html>