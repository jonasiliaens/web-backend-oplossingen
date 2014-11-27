<?php

	$helden = array('Spider-man', 'Batman', 'Superman', 'Iron Man', 'The Flash');

    $html = '<html>Voorbeeld van een string met htmltag\'s </html>';

	

	function drukArrayAf($array)
	{

        $container = array();

        foreach ($array as $key => $value) 
        {
            $container [] = 'array['.$key.'] heeft als waarde '.$value;
        }

		return $container;
	}

    function validateHtmlTag($html)
    {
        $openingTag = '<html>';

        $closingtag = '</html>';

        $validate = false;

        if (strpos($html, $openingTag) === 0)
        {
            $posClosingTag = strlen($html) - strlen($closingtag);

            if (strpos($html, $closingtag) == $posClosingTag)
            {
                $validate = true;
            }
        }
        
        return $validate;
    }

	$drukaf = drukArrayAf($helden);

    $validateHtml = validateHtmlTag($html);

?>


<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <title>Opdracht functies deel 2</title>
    </head>

    <body>

    	<h1>Opdracht functies deel 2:</h1>

    	<h2>Een array afdrukken met de functie drukArrayAf:</h2>

    	   <ul>
                <?php foreach ($drukaf as $key => $value): ?>
                    <li><?= $value ?></li>
                <?php endforeach ?>
           </ul>
    		    	
        <h2>De functie validateHtmlTag:</h2>

            <p>De html string "<?= htmlentities($html) ?>" is een <?= ($validateHtml) ? 'correcte' : 'foute' ?> html string.</p>

    </body>
</html>