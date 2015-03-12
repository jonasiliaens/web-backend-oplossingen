<?php
	
	include_once('Database.php');

	define( 'BASE_URL', 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ] );

	$db = new PDO('mysql:host=localhost;dbname=bieren', 'root', '');

	$dbInstanceTemp =   new Database( $db );

	$orderByTabel = 'bieren';
	$orderByKolom = 'naam';
	$orderByRichting = '';

	$default = false;

	if (isset($_POST['orderBy']))
	{
		$orderByKolom = $_POST['orderBy'];

		$orderByRichting = $_POST['richting'];


		if ($orderByKolom === 'brnaam')
		{
			$orderByTabel = 'brouwers';
		}

		if ($orderByKolom === 'soort')
		{
			$orderByTabel = 'soorten';
		}

		$default = true;

	}

	if (isset($_POST['richting']))
	{
		if ($_POST['richting'] === 'DESC')
		{
			$default = false;
		}
	}

	$orderByString = ' ORDER BY ' . $orderByTabel . '.' . $orderByKolom . ' '. $orderByRichting .'';

	$queryString = 'SELECT bieren.biernr, bieren.naam, brouwers.brnaam, soorten.soort, bieren.alcohol 
							FROM bieren 
							INNER JOIN brouwers 
							ON bieren.brouwernr = brouwers.brouwernr 
							INNER JOIN soorten ON bieren.soortnr = soorten.soortnr'
							. $orderByString;

	$resultaten = $dbInstanceTemp->query($queryString);

	$kolomnamen = array_keys($resultaten[0]);

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht CRUD Query Order By</title>
    <style>
    	table 
    	{
        margin:8px 0;
        border:1px solid lightgrey;
        border-collapse: collapse;
      }

      label
      {
        display: block;
      }

      input
      {
        display: block;
        width: 200px;
        font-size: 13px;
        margin: 5px;
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

    	button 
    	{
    		background-color: transparent;
    		border:none;
    	}

    	.bevestiging 
    	{
      	background-color: #66FF66;
        display: inline-block;
        border:1px solid #3FB139;
        padding: 10px;
        border-radius: 5px;
        margin-left: 35px;
      }

      .odd
      {
          background: #F1F1F1;
      }
    </style>
    </head>
    <body>

    	<h1>Opdracht CRUD Query Order By</h1>

    	
    		<table>

    			<thead>
    				<tr>
    					<?php foreach ($kolomnamen as $kolomnaam): ?>
    						<th>
    						<form action="<?= BASE_URL ?>" method="POST">
    							<?= $kolomnaam ?>
    							<button type="submit" name="orderBy" value="<?= $kolomnaam ?>">
    								<?php if ($default == false && $kolomnaam == $orderByKolom): ?>
                  						<img src="icon-desc.png" alt="">
                					<?php else : ?>
                  						<img src="icon-asc.png" alt="">
                					<?php endif ?>
    							</button>
    							<input type="hidden" name="richting" value= "<?= ($default == false && $kolomnaam == $orderByKolom) ? 'ASC' : 'DESC' ?>">
    						</form>
    						</th>
    					<?php endforeach ?>
    				</tr>
    			</thead>

        		<tbody>
        		  <?php foreach ($resultaten as $key => $resultaat): ?>
        		    <tr class="<?= ( ( $key + 1 ) % 2 !== 0 ) ? 'odd' : '' ?>">
        		      <?php foreach ($resultaat as $value): ?>
        		        <td><?= $value ?></td>
        		      <?php endforeach ?>
        		    </tr>
        		  <?php endforeach ?>
        		</tbody>

      		</table>
      	

    	
        
    </body>
</html>