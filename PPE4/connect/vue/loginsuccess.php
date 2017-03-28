<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<?php @session_start();
			include '../../lib/php/head.php';
		?>
	</head>

	<body>

		<div data-role="page" id="index">
			<div data-role="header">
				<h1>Acces autorisé</h1>
			</div><!-- /header -->
			
			<div data-role="content">
				
				<form style="text-align:center" id="form1" method="get" action="../modele/logout.php" data-ajax="false" >			
    				<p>
    					<br /><br />
    					Bonjour 
    					<?php 
    						echo $_SESSION['myusername'];
    					?>
    					<br /><br /><br />
    				</p>
    				<p>
	 					<img src="../../images/unlock.png"/ >
						<br /><br />
					</p>
					<p>
   						<input id="inputsubmit1" type="submit" name="inputsubmit1" value="Deconnexion..." />
   					</p>
   				</form>
				
			</div><!-- /content -->		
			
			<div data-role="footer" data-position="fixed" id='footer'>
			
    			
			</div><!-- /footer -->
			
		</div><!-- /page -->
		
	</body>

</html>

