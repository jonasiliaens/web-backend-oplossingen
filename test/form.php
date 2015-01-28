<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Formulier</title>
        <link rel="stylesheet" type="text/css" href="css/form.css">
    </head>
    <body>
    <div class="page">
        <h1>Bevestiging Formulier</h1>
        <form>
        <fieldset>
            <legend>Uw persoonlijke gegevens</legend>
    	
    	   <p>Naam: <?= $_POST['fnaam'] ?></p>
    	   <p>Postcode: <?= $_POST['fpostcode'] ?></p>
    	   <p>E-mailadres: <?= $_POST['femail'] ?></p>
        </fieldset>

        <fieldset>
            <legend>Uw huisdier gegevens</legend>
        
        <p>Naam: <?= $_POST['fnaamdier'] ?></p>
        <p>Ras: <?= $_POST['fras'] ?></p>
        <p>Leeftijd: <?= $_POST['fleeftijddier'] ?></p>
        </fieldset>
        </form>
    </div>
    </body>
</html>