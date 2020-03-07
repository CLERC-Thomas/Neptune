<!DOCTYPE html>
<html>
<head>
	<title>Hôtel Neptune</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="header">
		<?php require('header.php'); ?>
	</div>

	<?php
    require "info_user.php";
		$error = getVar('error');
		if(!is_bool($error)){
			// ERROR
			global $ERRORS;
			if(array_key_exists($error, $ERRORS)){
				echo "<span style='font-color=red'>";
				echo $ERRORS[$error];
				echo "</span>";
			}
		}
		$page = getPage();
		if(!includeHtml($page)){
		    global $DEFAULT_PAGE;
			includeHtml($DEFAULT_PAGE);
		}
	?>
    <html>
    <div class="containerContact">
        <div class="contact">
            <h1>Nous contacter</h1>
            <form>
                <input name="name" type="text" class="retour" placeholder="Nom" />
                <input name="email" type="text" class="retour" placeholder="Email" />
                <textarea name="text" class="retour" placeholder="Votre message"></textarea>
                <input type="submit" value="Envoyer"/>
            </form>
        </div>
    </div>
    <?php includePhp('footer'); ?>
</body>
</html>