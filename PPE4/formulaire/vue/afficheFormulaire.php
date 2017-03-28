<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<?php @session_start();
			include '../../lib/php/head.php';
		?>
	</head>

    <body>

    <div data-role="page">
        <div data-role="header">
            <p>
                <br /><br />
                Bonjour
                <?php
                echo $_SESSION['myusername'];
                ?>
                <br /><br /><br />
            </p>
        </div><!-- /header -->
        <div data-role="content">
            <div data-role="fieldcontain">
                <fieldset data-role="controlgroup">
                    <legend>Choisir un langage informatique :</legend>
                    <input type="radio" name="radio-choix-1" id="radio-choix-1" value="choix-1" />
                    <label for="radio-choix-1">PHP</label>
                    <input type="radio" name="radio-choix-1" id="radio-choix-2" value="choix-2" />
                    <label for="radio-choix-2">C++</label>
                    <input type="radio" name="radio-choix-1" id="radio-choix-3" value="choix-3" />
                    <label for="radio-choix-3">C#</label>
                    <input type="radio" name="radio-choix-1" id="radio-choix-4" value="choix-4" checked="checked" />
                    <label for="radio-choix-4">JAVA</label>
                </fieldset>
            </div>

        </div><!-- /content -->
        <div data-role="footer">
            <h4>&copy;Mesguen Transport  </h4>
        </div><!-- /footer -->
    </div><!-- /page -->


    </body>

</html>

