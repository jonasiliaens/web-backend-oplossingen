<?
	$text 			= file_get_contents('text-file.txt');

	$textChars 		= str_split($text);

	rsort($textChars);

	$textCharsRev 	= array_reverse($textChars);

	$charsTellen 	= array();

	foreach ($textCharsRev as $value)
	{
		if (isset($charsTellen[$value]))
		{
			++$charsTellen[$value];
		}
		else
		{
			$charsTellen[$value] = 1;

		}
	}


?>


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht foreach deel 1</title>
    </head>
    <body>
    	<h1>Opdracht foreach deel1:</h1>

    	<h2>Inhoud van de variabele $text:</h2>
    		<p><?= $text;?></p>

    	<h2>Inhoud van de array $textChars van Z tot A:</h2>
    		<p><?= var_dump($textChars) ?></p>

    	<h2>Inhoud van de array $textChars van A tot Z:</h2>
    		<p><?= var_dump($textCharsRev) ?></p>

    	<h2>Lijst van aantal karakters:</h2>
    		<p><?= var_dump($charsTellen) ?></p>
        



    </body>
</html>