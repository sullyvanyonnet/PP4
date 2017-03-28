<?php
    ob_start();
	session_start();

	include '../../lib/php/connect.php';

	// username and password sent from form
	$myusername=$_GET['login'];
	$mypassword=$_GET['password'];

    // Utilisation du crypotage MD5
    $mypassword = md5($mypassword);

	$sql="SELECT COUNT(*) FROM jqm_user WHERE login='$myusername' and passwd='$mypassword'";
	//echo "SQL : $sql.<br />";
	
	//renvoie la valeur du compteur 
    $count=compteSQL($sql);
	echo "COMPTEUR : $count";
	
	if($count==1){
		// Register $myusername, $mypassword and redirect to file "loginSuccess.php"
		$_SESSION['myusername'] = $myusername;
		header("location:../../formulaire/vue/afficheFormulaire.php");
	} else {
		//retourne a la page de login avec une message
		session_destroy();
		header("location:../controleur/login.php?message=<font color=red> Identification invalide... </font>");
	}

	ob_end_flush();
?>
