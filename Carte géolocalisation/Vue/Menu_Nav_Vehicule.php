		<nav class="navbar navbar-inverse navbar-fixed-top">
  			<div class="container">
    			<div class="navbar-header">
      				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        				<span class="sr-only">Toggle navigation</span>
        				<span class="icon-bar"></span>
      				</button>
      				<a class="navbar-brand" href='head_Vehicule.php'>MENU</a>
    			</div>
    			<div id="navbar" class="collapse navbar-collapse">
      				<ul class="nav navbar-nav">

						<li>
						<?php
						$_SESSION['loged'] = 1;
						if ( isset($_SESSION['loged']) and $_SESSION['loged'] == 1 ) {
							echo '<p class="navbar-text pull-right">Bonjour '. 'Utilisateur'. ', <a href="../Model/Logout.php"> d&eacute;connexion</a></p>';//$_SESSION['Pseudo'] . ' , <a href="../Model/Logout.php"> d&eacute;connexion</a></p>';
						} else {
							echo "<meta http-equiv='refresh' content='0;url=../Model/Logout.php'>";
						}
						?>
						</li>
      				</ul>
    			</div><!--/.nav-collapse -->
  			</div>
		</nav>
		
		<br/><br/>
	