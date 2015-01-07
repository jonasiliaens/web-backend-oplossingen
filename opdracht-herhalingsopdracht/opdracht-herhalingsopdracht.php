<?php

    $cursus             =   false;
    $voorbeelden        =   false;
    $oplossingen        =   false;
    $zoek               =   false;
    $stringNtGevonden   =   false;

    if (isset ($_GET['link'])) 
    {
        switch ($_GET['link'])
        {
            case 'cursus':
                $cursus         =   true;
                break;

            case 'voorbeelden':
                $voorbeelden    =   true;
                $map            =   '/Users/jonas/Documents/Syntra/Webontwikkelaar/web-backend/cursus/public/cursus/voorbeelden';
                $link           =   'http://web-backend.local/cursus/voorbeelden/';
                $bestanden      =   showList( $map );
                break;

            case 'oplossingen':
                $oplossingen    =   true;
                $map            =   '/Users/jonas/Documents/Syntra/Webontwikkelaar/web-backend/oplossingen';
                $link           =   'http://oplossingen.web-backend.local/';
                $bestanden      =   showList( $map );
                break;
        }
    }

    if (isset ($_GET['zoek'])) 
    {
        $zoek = true;

        $voorbeeldenBestanden = showList( '/Users/jonas/Documents/Syntra/Webontwikkelaar/web-backend/cursus/public/cursus/voorbeelden' );
        $oplossingenBestanden = showList( '/Users/jonas/Documents/Syntra/Webontwikkelaar/web-backend/oplossingen' );

        $bestandenMergen  =   array_merge($voorbeeldenBestanden, $oplossingenBestanden);

        $resultaten =   array();
        $zoekString =   $_GET['zoek'];

        foreach ($bestandenMergen as $bestand)
        {
            $zoekStringGevonden = strpos($bestand, $zoekString);

            if ($zoekStringGevonden !== false)
            {
                $resultaten[]   =   $bestand;
            }
        }

        $bestanden = $resultaten;

            if (empty($bestanden) == true)
            {
                $stringNtGevonden = true;
            }
    }

    function showList ($map)
    {
        $bestanden  = scandir ($map);

        array_shift($bestanden);
        array_shift($bestanden);
        array_shift($bestanden);

        return $bestanden;
    }

?>


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Herhalingsopdracht</title>
        <style>

        	iframe
        	{
        		width: 1000px;
        		height: 750px;
        	}

        </style>
    </head>
    <body>
    	<h1>Herhalingsopdracht</h1>

    	<h2>Indexpagina</h2>

    	<ul>
    	    <li><a href="opdracht-herhalingsopdracht.php?link=cursus">Cursus</a></li>
    	    <li><a href="opdracht-herhalingsopdracht.php?link=voorbeelden">Voorbeelden</a></li>
    	    <li><a href="opdracht-herhalingsopdracht.php?link=oplossingen">Oplossingen</a></li>
    	</ul>

        <form action="opdracht-herhalingsopdracht.php" method="GET">
            <label id="zoek">Zoek naar:</label>
            <input type="text" name="zoek" id="zoek">
            <input type="submit">
        </form>

        <?php if ($cursus): ?>
            <iframe src="http://web-backend.local/cursus/web-backend-cursus.pdf"></iframe>
        <?php endif ?>

        <?php if ($voorbeelden || $oplossingen): ?>
            <ul>
                <?php foreach ($bestanden as $bestand): ?>
                    <li><a href="<?= $link ?>/<?= $bestand ?>"><?= $bestand ?></a></li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>

        <?php if ($zoek): ?>
            <ul>
                <?php foreach ($bestanden as $bestand): ?>
                    <li><a href="<?= $bestand ?>"><?= $bestand ?></a></li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>

        <?php if ($stringNtGevonden): ?>
            <p>Spijtig, geen resultaat gevonden voor <?= $zoekString ?>.</p>
        <?php endif ?>

    </body>
</html>