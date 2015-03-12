<?php
  session_start();
	
  include_once('Database.php');

	define( 'BASE_URL', 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ] );

	$message 	=	false;
  $confirm  = false;
  $editForm = false;
  $updateValues = '';
	
	$db 		=	new PDO('mysql:host=localhost;dbname=bieren', 'root', '');

  $dbInstanceTemp =   new Database( $db );

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
   	  $deleteBrouwerId   = $_SESSION['brouwerNr'];	
   		$deleteQueryString 	=	'DELETE FROM brouwers 
  								            WHERE brouwernr  = :brouwerId
  								            LIMIT 1';

      $deleteBrouwerPlaceholders    =   array(':brouwerId' => $deleteBrouwerId);

      $dbInstanceTemp->delete( $deleteQueryString, 
                                $deleteBrouwerPlaceholders);

  		$message 	=	'De brouwer met id: ' . $deleteBrouwerId . ' is succesvol verwijderd.';
   	}

  if (isset($_POST['edit']))
  {
    $editForm   = true;
    $editBrId   = $_POST['edit'];

    $editQueryString  = 'SELECT *
                          FROM brouwers 
                          WHERE brouwernr  = :brouwerId
                          LIMIT 1';

    $editQueryPlaceholders    =   array(':brouwerId' => $editBrId);

    $brouwerToEdit  = $dbInstanceTemp->query($editQueryString,
                                            $editQueryPlaceholders);
  }

  if (isset($_POST['cancelUpdate']))
  {
    $editForm   = false;
    $brouwerToEdit = array();
  }

  $selectQuery    = 'SELECT * 
                FROM `brouwers` 
                WHERE 1';

  $brouwers = $dbInstanceTemp->query($selectQuery);

  $brouwersKolomnamen = array_keys( $brouwers[0] );
  
  foreach ($brouwersKolomnamen as $key => $value) 
  {
    $updateValues = $updateValues . '`' . $value . '`' . '=:' . $value . ', ';
  }

  $updateValues = rtrim($updateValues, ', ');
    

  if (isset($_POST['update']))
  {
    $naam       = $_POST['brnaam'];
    $id         = $_POST['brouwernr'];

    $placeholders = array();
    $placeholders = array();

    foreach ($_POST as $key => $value) 
    {
      $placeholders[':' . $key] = $value;
    }

    array_pop($placeholders);

    $updateQueryString = 'UPDATE `brouwers` SET ' . $updateValues . ' WHERE brouwernr  = :brouwernr';
    
    $dbInstanceTemp->query($updateQueryString, $placeholders);

    $message  = 'De brouwer ' . $naam . ' met id ' . $id . ' is succesvol aangepast.';
  }


  $selectQuery    = 'SELECT * 
                FROM `brouwers` 
                WHERE 1';

  $brouwers = $dbInstanceTemp->query($selectQuery);

  $brouwersKolomnamen = array_keys( $brouwers[0] );
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht CRUD Update - Deel 2</title>
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

    	<h1>Opdracht CRUD Update - Deel 2</h1>

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
              <?php foreach ($brouwer as $label => $value): ?>
                <?php if ($value === reset($brouwer)): ?>
                  <input type="hidden" name="<?= $label ?>" id="<?= $label ?>" value="<?= $value ?>">
                <?php else : ?>
                  <label for="<?= $label ?>"><?= $label ?></label>
                  <input type="text" name="<?= $label ?>" id="<?= $label ?>" value="<?= $value ?>">
                <?php endif ?>
              <?php endforeach ?>
              
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