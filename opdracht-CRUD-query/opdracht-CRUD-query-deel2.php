<?php

	$message 	=	'';

  $brouwerNr  = true;

  if (isset($_GET['brouwernr']))
  {
    $brouwerNr  = $_GET['brouwernr'];   
  }

	try
	{
		$db 		  =	new PDO('mysql:host=localhost;dbname=bieren', 'root', '');
		$message 	=	'';

		$queryBrouwers 		=	'SELECT brouwers.brouwernr, brouwers.brnaam 
                        FROM `brouwers` ';

   		$statementBrouwers 	=	$db->prepare($queryBrouwers);

   		$statementBrouwers->execute();

   		$brouwers 		=	array();

   		while ($row = $statementBrouwers->fetch(PDO::FETCH_ASSOC))
   		{
   			$brouwers[] 	=	$row;
   		}

    $queryBierenPerBrouwer =  'SELECT bieren.naam 
                                FROM `bieren` 
                                  INNER JOIN brouwers
                                  ON bieren.brouwernr = brouwers.brouwernr
                                WHERE brouwers.brouwernr = :brouwerNr';

    $statementBier  = $db->prepare($queryBierenPerBrouwer);

    $statementBier->bindValue(':brouwerNr', $brouwerNr );

    $statementBier->execute();

    $bierenPerBrouwer   = array();

    while ($bier = $statementBier->fetch(PDO::FETCH_ASSOC))
    {
      $bierenPerBrouwer[]   = $bier;
    }

    $kolomnamen   = array();
    $kolomnamen[] = '#';

    foreach ($bierenPerBrouwer[0] as $key => $value) 
    {
      $kolomnamen[]   = $key;
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
        <title>Opdracht CRUD Query - Deel 2</title>
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
    	<h1>Opdracht CRUD Query - Deel 2</h1>

    	<p><?= $message ?></p>

      <form action="<?= $_SERVER['PHP_SELF'] ?>" method="GET">

        <select name="brouwernr">
          <?php foreach ($brouwers as $key => $brouwer): ?>
            <option value="<?= $brouwer['brouwernr'] ?>" <?= ( $brouwerNr === $brouwer['brouwernr'] ) ? 'selected' : '' ?>><?= $brouwer['brnaam'] ?></option>
          <?php endforeach ?>
        </select>

        <input type="submit" value="Al de bieren van deze brouwer">
        
      </form>

      <table>
        <thead>
          <tr>
            <?php foreach ($kolomnamen as $value): ?>
              <td><?= $value ?></td>
            <?php endforeach ?>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($bierenPerBrouwer as $key => $bier): ?>
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