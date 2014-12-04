<?php
	
	$artikels = array( 

						array( 'titel' => 'Daar is de eerste sneeuw',
								'datum' => 'Donderdag 3 September 2014',
								'inhoud' => 'Een dag nadat de weerkundige winter van start ging, dwarrelden gisteravond de eerste sneeuwvlokjes 
								naar beneden in Vlaanderen. Ook aan de andere kant van het land zag het hier en daar mooi wit met plaatselijk een 
								laagje van 2 tot 4 cm. Van een perfecte timing gesproken. Afgelopen nacht zijn de strooidiensten voor het eerst in 
								het hele land uitgerukt. Ze hebben een 300 ton zout gestrooid. Dat was vooral nodig in Limburg, Vlaams-Brabant en 
								Antwerpen, maar ook in delen van Oost- en West-Vlaanderen werd preventief gestrooid.',
								'afbeelding' => 'artikel-1.jpg',
								'afbeeldingBeschrijving' => 'Een auto bedekt met de eerste sneeuw.'),

						array( 'titel' => 'Lading smartphones gestolen',
								'datum' => 'Donderdag 3 September 2014',
								'inhoud' => 'Bij een ramkraak op telecomwinkel Allo Telecom in Tienen zijn dieven er in de nacht van maandag op dinsdag 
								vandoor gegaan met een nog ongekende lading smartphones. Het gaat al om de zesde ramkraak in het gerechtelijk arrondissement 
								Leuven in een maand tijd.De daders sloegen toe rond 2 uur in de nacht van maandag op dinsdag. Met een zware hamer sloegen 
								ze de glazen inkomdeur van telecomwinkel Allo Telecom aan de Leuvensestraat in Tienen aan diggelen. Het alarm 
								van de zaak trad onmiddellijk in werking, waardoor verschillende buren gewekt werden. Maar daar trokken de daders 
								zich duidelijk niets van aan. Ze trokken meteen naar de stockruimte achteraan in de winkel, waar ze met grof geweld 
								de deur forceerden. De dieven graaiden mee wat ze konden.',
								'afbeelding' => 'artikel-2.jpeg',
								'afbeeldingBeschrijving' => 'De daders sloegen in de nacht van maandag op dinsdag toe bij Allo Telecom.'),

						array( 'titel' => 'Renovatie kathedraal klaar na 50 jaar',
								'datum' => 'Donderdag 3 September 2014',
								'inhoud' => 'Dé trots van Antwerpen straalt weer in al haar glorie. Met een nieuw portaal, hypermodern, maar wel perfect
								 geïntegreerd in de gotische stijl van de Onze-Lieve-Vrouwekathedraal. Buiten een paar herstellingen na - die nog aan het
								  leien dak moeten worden uitgevoerd - zit een restauratieperiode van maar liefst 50 jaar er zo goed als op. Een 52 miljoen
								   euro is in het project gepompt.',
								'afbeelding' => 'artikel-3.jpeg',
								'afbeeldingBeschrijving' => 'In de kathedraal hoeft voor het eerst sinds 50 jaar geen enkele stelling meer te staan.')


		);

	$getSet 				= 	false;
	$individueelArtikel 	= 	false;
	$id 					= 	'';
	$artikelContainer 		= 	$artikels;
	$artikelBestaatNiet		= 	false;
	$boodschap				=	'';

	if (isset($_GET ['id'] ))
	{
		$getSet 				= 	true;
		$artid 					= 	$_GET ['id'];

		if (array_key_exists($artid, $artikels))
		{
			$individueelArtikel 	= 	true;
			$artikelContainer		= 	array($artid => $artikels[$artid]);
		}	
		else	
		{	
			$artikelBestaatNiet		= 	true;
		}
	}


	
	

	if (isset($_GET['zoekKnop']))
	{
		$artikelContainer = array();
		$zoek = $_GET['zoekVeld'];

		foreach ($artikels as $key => $value) 
		{
			if (strpos($value['inhoud'], $zoek) !== false)
			{
				
				
				$artikelContainer [$key] = $value;

				$individueelArtikel = true;
			}
		}	

		if (empty($artikelContainer))
		{
			$boodschap = 'De string '.$_GET['zoekVeld'].' is niet gevonden in één van de artikels.';
		}
	}

?>

<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php if ( !$individueelArtikel ): ?>
        	<title>Opdracht get deel 2</title>
        <?php else: ?>
        	<title><?= $artikelContainer[$artid]['titel'] ?></title>
        <?php endif ?>
        <style>

        	body
			{
			font-family:"Segoe UI";
			color:#423f37;
			}

			h1
			{
				text-align: center;
			}


        	.truncate 
        	{
			  width: 250px;
			  white-space: nowrap;
			  overflow: hidden;
			  text-overflow: ellipsis;
			}

			.container
			{
				width: 1024px;
				margin: 0 auto;
			}

			img 
			{
				max-width: 100%;
			}

			.alleArtikels
			{
				float:left;
				width:288px;
				margin:16px;
				padding:16px;
				box-sizing:border-box;
				background-color:#EEEEEE;
			}

			.artikel img
			{
				margin-left: 200px;
			}

			.artikel
			{
				background-color: #EEEEEE;
				padding: 16px;
			}

        </style>
    </head>

    <body>

    	<h1>Opdracht Get deel 2</h1>

    	<div class="container">

    		<form action"opdracht-get-deel2.php" method="GET">
    			<label for="zoekVeld">Zoek:
    				<input type="text" name="zoekVeld" id="zoekVeld" >
    			</label>

    			<label for="zoekKnop">
    				<input type="submit" name="zoekKnop" id="zoekKnop">
    			</label>
    		</form>

    		<p><?= $boodschap ?></p>

    		<?php if ($individueelArtikel == false && $artikelBestaatNiet == false): ?>
		   		<?php foreach ($artikels as $id => $value): ?>

		   			<article class="alleArtikels">
			    	   	<h2><?= $value['titel'] ?></h2>
			    	   	<p><?= $value['datum'] ?></p>
			    	   	<p><img src="img/<?= $value['afbeelding'] ?>" alt="<?= $value['afbeeldingBeschrijving'] ?>"></p>
			    	

			    	   	<?php if ($getSet == false): ?>
			    	   		<p class="truncate"><?= substr($value['inhoud'],0,50) ?></p>
			    	   		<a href="opdracht-get-deel2.php?id=<?= $id ?>">Lees Meer</a>
			    	   	<?php endif ?>

			    	   	<?php if ($getSet == true): ?>
			    	   		<p><?= $value['inhoud'] ?></p>
			    	   	<?php endif ?>
		    	   	</article>

		   		<?php endforeach ?>
	   		<?php endif ?>


	   		<?php if ($individueelArtikel == true && $artikelBestaatNiet == false): ?>

	   			<?php foreach ($artikelContainer as $id => $value): ?>

	   				<article class="artikel">
			    	   	<h2><?= $value['titel'] ?></h2>
			    	   	<p><?= $value['datum'] ?></p>
			    	   	<p><img src="img/<?= $value['afbeelding'] ?>" alt="<?= $value['afbeeldingBeschrijving'] ?>"></p>
			    	   	<p><?= $value['inhoud'] ?></p>
		    	   	</article>

	    	   	<?php endforeach ?>

	   		<?php endif ?>

	   		<?php if ( $artikelBestaatNiet): ?>
	   			<h1>Dit artikel bestaat niet!</h1>
	   		<?php endif ?>
	   	</div>
	    
    </body>
</html>