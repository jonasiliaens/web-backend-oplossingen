<?php
	session_start();

	define( 'BASE_URL', 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ] );

	function my_autoloader ($class_name)
	{
		require_once ('classes/'.$class_name.'.php');
	}

    spl_autoload_register('my_autoloader');

	$fout       =	false;
    $warning    =   false;

	if (isset($_SESSION))				//zorgt ervoor dat als er bij het openen vd browser al todo's zijn, deze getoond worden
	{
		$todosTonen 	=	true;
	}

	if (isset($_POST['verzenden']))
	{
		if ($_POST['toevoegen'] == '')	//controlleert of een nieuwe todo niet leeg is
		{
			$fout 	=	true;
		}
		else
		{	
			$_SESSION['todos'][]	=	$_POST['toevoegen'];	//voegt een nieuwe todo toe
			$todosTonen				=	true;
		}
	}

    if (isset($_POST['warning']))       //als er op reset geklikt wordt, zet deze de "warning" zichtbaar
    {
        $warning    =   true;
    }

    if (isset($_POST['annuleer']))      //als er op nee geklikt wordt, zet deze de "warning" terug onzichtbaar
    {
        $warning    =   false;
    }

    if (isset($_POST['reset']))         //als er op ja geklikt wordt, wist dit de session en herlaad de pagina opnieuw
    {
        session_destroy();
        header('location: index.php');
    }

	if (isset($_POST['tedoen'])) 		//zet een todo van "nog te doen" naar "gedaan"
	{
		new Todo('tedoen', 'todos', 'gedaan');
	}

	if (isset($_POST['gedaan']))		//zet een todo van "gedaan" naar "nog te doen"
	{
		new Todo('gedaan', 'gedaan', 'todos');
	}

	if (isset($_POST['deleteTodo']))	//verwijderdt een todo uit de lijst met nog te doen
	{
		new Delete('deleteTodo', 'todos');
	}

	if (isset($_POST['deleteDone']))	//verwijderdt een todo uit de lijst met gedaan
	{
		new Delete('deleteDone', 'gedaan');
	}

    if (empty($_SESSION['todos']))		//controlleert of alle todo's van nog te doen naar done is done zijn verzet
    {
    	$allesGedaan 	=	true;
    }
    else
    {
    	$allesGedaan 	=	false;
    }

    if (empty($_SESSION['todos']) && empty($_SESSION['gedaan'])) //controlleert of er nog todo's zijn of niet
    {
    	$todosTonen 	=	false;
    }
    
	if (array_key_exists('gedaan', $_SESSION));	//controlleert of er todo's staan bij done is done
	{
		if (empty($_SESSION['gedaan']))
		{
			$werkAdWinkel 	=	true;
		}
		else
		{
			$werkAdWinkel 	=	false;
		}
	}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Todo App</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    	<?php if ($fout): ?>
    		<p class="fout">Opgelet! Lege todos zijn niet toegestaan!</p>
    	<?php endif ?>

    	<h1>Todo app</h1>

    	<?php if ($todosTonen == false): ?>
    		<p>Je hebt nog geen TODO's toegevoegd. Zo weinig werk of meesterplanner?</p>
    	<?php endif ?>

    	<?php if ($todosTonen): ?>
    		<h2>Nog te doen</h2>

    		<?php if ($allesGedaan): ?>
    			<p>Schouderklopje, alles is gedaan!</p>
    		<?php endif ?>

    		<ul class="todo">
    			<form action="<?= BASE_URL ?>" method="POST">
    			<?php foreach ($_SESSION['todos'] as $key => $todo): ?>
    					<li>
    						<button name="tedoen" value="<?= $key ?>" class="tedoen"><?= $todo ?></button>
    						<button type="submit" name="deleteTodo" value="<?= $key ?>" class="delete-button">
        		      			<img src="icon-delete.png" alt="Icon Delete">
        		      		</button>
    					</li>
    			<?php endforeach ?>
    			</form>
    		</ul>
    		<h2>Done and done</h2>

    		<?php if ($werkAdWinkel): ?>
    			<p>Werk aan de winkel</p>
    		<?php endif ?>

    		<?php if ($werkAdWinkel == false): ?>
    			<ul class="todo">
    				<form action="<?= BASE_URL ?>" method="POST">
    				<?php foreach ($_SESSION['gedaan'] as $key => $todo): ?>
    						<li>
    							<button name="gedaan" value="<?= $key ?>" class="gedaan"><?= $todo ?></button>
    							<button type="submit" name="deleteDone" value="<?= $key ?>" class="delete-button">
        		      				<img src="icon-delete.png" alt="Icon Delete">
        		      			</button>
    						</li>
    				<?php endforeach ?>
    				</form>
    			</ul>
    		<?php endif ?>
    	<?php endif ?>

    	<h1>Todo toevoegen</h1>
        <ul>
            <li>
    	       <form action="<?= BASE_URL ?>" method="POST">
    		      <label for="toevoegen">Toevoegen:
    			     <input type="text" name="toevoegen">
    		      </label>
            </li>
        </ul>

            <input type="submit" name="verzenden" value="Toevoegen">
            <?php if ($todosTonen): ?>
    		  <input type="submit" name="warning" value="Reset">
            <?php endif ?>
    	</form>
        <?php if ($warning): ?>
        <div class="warning">
          <form action="<?= BASE_URL ?>" method="POST">
            <p>Bent u zeker dat u al de todo's wil verwijderen? Dit kan niet ongedaan gemaakt worden!</p>
            <input type="submit" name="reset" value="Ja">
            <input type="submit" name="annuleer" value="Nee">
          </form>
        </div>
      <?php endif ?>
    </body>
</html>