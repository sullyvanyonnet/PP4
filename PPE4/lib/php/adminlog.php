<?php
 	ob_start();

 	//supprime l'affichage des erreurs
	error_reporting(0);
	if (session_id() == "") session_start();
	//if (!isset(session_id()) session_start();

	if (!isset($_SESSION['myusername'])) {
		//header("Location:../controleur/login.php");
		//require_once('index.php');
		echo "<meta http-equiv='refresh' content='0;url=../controleur/login.php'>";
	}

	//active l'affichage des erreurs
	error_reporting(-1);

	// dans le footer ob_end_flush();
?>