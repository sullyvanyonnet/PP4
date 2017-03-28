<?php
ob_start();
session_start();

include '../../lib/php/connect.php';

// username and password sent from form
$sql=   "SELECT * FROM tournee";
//echo "SQL : $sql.<br />";

//renvoie la valeur du compteur
$Tournees = $connexion->query($sql)->fetchColumn();

// Register $myusername, $mypassword and redirect to file "loginSuccess.php"
$_SESSION['Tournees'] = $Tournees;
header("location:../vue/afficheFormulaire.php");


?>