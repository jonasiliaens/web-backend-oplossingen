<?
	$text 			= file_get_contents('text-file.txt');

	$textNoUpper = strtolower($text);

	$textChars 		= str_split($textNoUpper);

	sort($textChars);

	$charsTellen 	= array();

	foreach ($textChars as $value)
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
        <title>Opdracht foreach deel 2</title>
    </head>
    <body>
    	<h1>Opdracht foreach deel2:</h1>

    	<h2>Inhoud van de variabele $text:</h2>
    		<p><?= $text;?></p>

    	<h2>Lijst van aantal karakters:</h2>
    		<p><?= var_dump($charsTellen) ?></p>
        

    </body>
</html>