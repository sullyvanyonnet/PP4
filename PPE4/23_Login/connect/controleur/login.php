<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<?php 
			include '../../lib/php/head.php';
		?>
	</head>

	<body>

		<div data-role="page" id="index">
			<div data-role="header">
				<h1>
					<img src="../../images/lock.png" alt="Locked"/>
					Identification
				</h1>
			</div><!-- /header -->
			
			<div data-role="content">
				
				<form id="formulaire" method="get" action="../modele/checklogin.php" data-ajax="false" >	 			
		 			<div data-role="fieldcontain" >
		   				<label for="login">Utilisateur :</label>
						<input id="login" name="login" type="text" value="admin" />
					</div>	
 					<div data-role="fieldcontain" >
		   				<label for="password">Password :</label>
    					<input id="password" name="password" type="password" value="password" />
    				</div>
    				<br />
					<input id="inputsubmit1" type="submit" name="inputsubmit1" value="Connexion" />
   		    	</form>
				
			</div><!-- /content -->		
			
			<div data-role="footer" data-position="fixed" id='footer'>
			
				<?php
    				if (isset($_GET['message']))
    					echo "<h4>".$_GET['message']."</h4>";
    				else
    					echo "<h4>&nbsp;</h4>";
    			?>
    			
			</div><!-- /footer -->
			
		</div><!-- /page -->
		
	</body>

</html>

