<?php
	session_start();

	define( 'BASE_URL', 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ] );

	$regEx 			=	'';
	$zoekString 	=	'';
	$vervangString 	=	'<span>#</span>';
	$resultaat 		=	false;

	if (isset($_POST['submit']))
	{
		$regEx 		=	$_POST['regex'];
		$zoekString	=	$_POST['string'];

		$_SESSION['regex'] =	$regEx;
		$_SESSION['string']=	$zoekString;

		$regEx 	=	'/' . $regEx . '/';

		$resultaat 	=	preg_replace($regEx, $vervangString, $zoekString);
	}

	$regEx2 	=	'/[a-d]|[u-z]|[A-D]|[U-Z]/';
	$zoekString2=	"Memory can change the shape of a room; it can change the color of a car. And memories can be 
                    distorted. They're just an interpretation, they're not a record, and they're irrelevant if you have the facts.";
	$resultaat2	=	preg_replace($regEx2, $vervangString, $zoekString2);

	$regEx3 	=	'/colo[u]?r/';
	$zoekString3=	"Zowel colour als color zijn correct Engels.";
	$resultaat3	=	preg_replace($regEx3, $vervangString, $zoekString3);

	$regEx4 	=	'/1\d{3}/';
	$zoekString4=	"1020 1050 9784 1560 0231 1546 8745";
	$resultaat4	=	preg_replace($regEx4, $vervangString, $zoekString4);

	$regEx5 	=	'/[0-9]{2}[\/\-\.][0-9]{2}[\/\-\.][0-9]{4}/';
	$zoekString5=	"24/07/1978 en 24-07-1978 en 24.07.1978";
	$resultaat5	=	preg_replace($regEx5, $vervangString, $zoekString5);
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht regular expressions - deel 1</title>
        <style>
        	body
        	{
        		width: 1024px;
        		margin: auto 20px;
        	}
        	label
        	{
        		display: block;
        		margin-left: 5px;
        	}

        	input, textarea
        	{
        		display: block;
        		margin: 0px 5px 10px 5px;
        	}

        	ul
        	{
        		margin: 10px;
        	}

        	li
        	{
        		margin-bottom: 5px;
        	}

        	.result span
			{
				font-weight	:bold;
				color:	#FF0000;
			}
        </style>
    </head>
    <body>
    	<h1>Opdracht regular expressions - deel 1</h1>

    	<form action="<?= BASE_URL ?>" method="POST">
    		<label for="regex">Regular Expression</label>
    		<input type="text" name="regex" id="regex" value="<?= ( isset($_SESSION['regex'])) ? $_SESSION['regex'] : '' ?>">  
	
    		<label for="string">String</label>
    		<textarea name="string" id="string"><?= ( isset($_SESSION['string'])) ? $_SESSION['string'] : '' ?></textarea>

    		<button type="submit" name="submit" id="submit">Verzenden</button>
    	</form>

    	<?php if ($resultaat): ?>
        	<p class="result"><?= $resultaat ?></p>
      	<?php endif ?>

      	<h1>Opdracht regular expressions - deel 2</h1>
      	<ul>
            <li>
                Match alle letters tussen a en d, en u en z (hoofdletters inclusief)
                <ul>
                    <li>String: <?= $zoekString2 ?></li>
                    <li class="result">Resultaat: <?= $resultaat2 ?></li>
                    <li>Gebruikte regex: <?= $regEx2 ?></li>
                </ul>
            </li>

            <li>
                Match zowel colour als color
                <ul>
                    <li>String: <?= $zoekString3 ?></li>
                    <li class="result">Resultaat: <?= $resultaat3 ?></li>
                    <li>Gebruikte regex: <?= $regEx3 ?></li>
                </ul>
            </li>

            <li>
                Match enkel de getallen die een 1 als duizendtal hebben.
                <ul>
                    <li>String: <?= $zoekString4 ?></li>
                    <li class="result">Resultaat: <?= $resultaat4 ?></li>
                    <li>Gebruikte regex: <?= $regEx4 ?></li>
                </ul>
            </li>

            <li>
                Match alle data zodat er enkel een reeks "en" overblijft.
                <ul>
                    <li>String: <?= $zoekString5 ?></li>
                    <li class="result">Resultaat: <?= $resultaat5 ?></li>
                    <li>Gebruikte regex: <?= $regEx5 ?></li>
                </ul>
            </li>
        </ul>
    </body>
</html>