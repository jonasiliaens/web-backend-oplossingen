<?php
  session_start();
	
	define( 'BASE_URL', 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ] );

	$message 	=	false;
  $confirm  = false;
  $editForm = false;
	
	$db 		=	new PDO('mysql:host=localhost;dbname=bieren', 'root', '');

  if (isset($_POST['confirm']))
  {
    $confirm                = true;
    $deleteBrId             = $_POST['confirm'];
    $_SESSION['brouwerNr']  = $deleteBrId;
  }

  if (isset($_POST['annuleer']))
  {
    $confirm  = false;
  }

	if (isset($_POST['delete']))
   	{
   	  $deleteBrId   = $_SESSION['brouwerNr'];	
   		$deleteQuery 	=	'DELETE FROM brouwers 
  								WHERE brouwernr  = :brouwerId
  								LIMIT 1';

  		$statementDelete 	=	$db->prepare($deleteQuery);
  		$statementDelete->bindValue(':brouwerId', $deleteBrId);

  		$statementDelete->execute();

  		$message 	=	'De brouwer met id: ' . $deleteBrId . ' is succesvol verwijderd.';
   	}

  if (isset($_POST['edit']))
  {
    $editForm   = true;
    $editBrId   = $_POST['edit'];

    $selectEditQuery  = 'SELECT *
                          FROM brouwers 
                          WHERE brouwernr  = :brouwerId
                          LIMIT 1';

    $statementEdit  = $db->prepare($selectEditQuery);
    $statementEdit->bindValue(':brouwerId', $editBrId);

    $statementEdit->execute();

    $brouwerToEdit  = array();

    while ($row = $statementEdit->fetch(PDO::FETCH_ASSOC))
    {
      $brouwerToEdit[]   = $row;
    }
  }

  if (isset($_POST['cancelUpdate']))
  {
    $editForm   = false;
    $brouwerToEdit = array();
  }

  if (isset($_POST['update']))
  {
    $nr         = $_POST['brouwernr'];
    $naam       = $_POST['brnaam'];
    $adres      = $_POST['adres'];
    $postcode   = $_POST['postcode'];
    $gemeente   = $_POST['gemeente'];
    $omzet      = $_POST['omzet'];

    $updateQuery = 'UPDATE `brouwers` 
                      SET `brnaam`=:brnaam,
                          `adres`=:adres,
                          `postcode`=:postcode,
                          `gemeente`=:gemeente,
                          `omzet`=:omzet 
                          WHERE brouwernr  = :brouwerId';

    $statementUpdate = $db->prepare($updateQuery);

    $statementUpdate->bindValue(':brouwerId', $nr);
    $statementUpdate->bindValue(':brnaam', $naam);
    $statementUpdate->bindValue(':adres', $adres);
    $statementUpdate->bindValue(':postcode', $postcode);
    $statementUpdate->bindValue(':gemeente', $gemeente);
    $statementUpdate->bindValue(':omzet', $omzet);

    $statementUpdate->execute();

    $message  = 'De brouwer ' . $naam . ' is succesvol aangepast.';
  }

  $selectQuery    = 'SELECT * 
                FROM `brouwers` 
                WHERE 1';

  $statementSelect  = $db->prepare($selectQuery);

  $statementSelect->execute();

  $brouwers   = array();

  while ($row = $statementSelect->fetch(PDO::FETCH_ASSOC))
      {
        $brouwers[]   = $row;
      }

    $brouwersKolomnamen = array_keys( $brouwers[0] );


?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht CRUD Update - Deel 1</title>
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

    	.delete-button 
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

    	<h1>Opdracht CRUD Update - Deel 1</h1>

    	<?php if ($message): ?>
    		<p class="bevestiging"><?= $message ?></p>
    	<?php endif ?>

      <?php if ($confirm): ?>
        <div>
          <form action="<?= BASE_URL ?>" method="POST">
            <p>Bent u zeker dat u deze brouwer wil verwijderen? Dit kan niet ongedaan gemaakt worden!</p>
            <button type="submit" name="annuleer">Nee</button>
            <button type="submit" name="delete">Ja</button>
          </form>
        </div>
      <?php endif ?>

      <?php if ($editForm): ?>
        <div>
          <form action="<?= BASE_URL ?>" method="POST">

            <?php foreach ($brouwerToEdit as $brouwer): ?>
              <h1>Brouwerij <?= $brouwer['brnaam'] ?> (# <?= $brouwer['brouwernr'] ?>) wijzigen</h1>

              <input type="hidden" name="brouwernr" id="brouwernr" value="<?= $brouwer['brouwernr'] ?>">

              <label for="brnaam">Brouwernaam</label>
              <input type="text" name="brnaam" id="brnaam" value="<?= $brouwer['brnaam'] ?>">
              
              <label for="adres">Adres</label>
                <input type="text" name="adres" id="adres" value="<?= $brouwer['adres'] ?>">
              
              <label for="postcode">Postcode</label>
                <input type="text" name="postcode" id="postcode" value="<?= $brouwer['postcode'] ?>">
      
              <label for="gemeente">Gemeente</label>
                <input type="text" name="gemeente" id="gemeente" value="<?= $brouwer['gemeente'] ?>">
      
              <label for="omzet">Omzet</label>
                <input type="text" name="omzet" id="omzet" value="<?= $brouwer['omzet'] ?>">

              <button type="submit" name="cancelUpdate">Annuleer</button>
              <button type="submit" name="update">Wijzigen</button>
              
            <?php endforeach ?>
            
          </form>
        </div>
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
        		      	<button type="submit" name="confirm" value="<?= $brouwer['brouwernr'] ?>" class="delete-button">
        		      		<img src="icon-delete.png" alt="Icon Delete">
        		      	</button>
                    <button type="submit" name="edit" value="<?= $brouwer['brouwernr'] ?>" class="delete-button">
                      <img src="icon-edit.png" alt="Icon Edit">
                    </button>
        		      </td>
        		    </tr>
        		  <?php endforeach ?>
        		</tbody>

      		</table>
      	</form>
        
    </body>
</html>