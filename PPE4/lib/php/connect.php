<?php
	
	$ip=explode(".",$_SERVER['SERVER_ADDR']);
	
	switch ($ip[0]) {
		
		case 127 :
		case 192 :	
			//local
			$host = "127.0.0.1";
			$user = "root";
			$password = "";
			$dbname = "slam4";
			$port='3306';
			break;
			
			
		case 212 :
			//free
			$host="localhost";
			$user="erwan.leguen2";
			$password="****";
			$dbname="erwan.leguen2";
			$port='3306';
			break;			
			
		default :
			exit ("Serveur non reconnu...");
			break;	
	}
	
	// ceation du Data Source Name, ou DSN, qui contient les infos
	// requises pour se connecter à la base.
	$dsn='mysql:host='.$host.';port='.$port.';dbname='.$dbname;
	
	//echo "DSN : $dsn<br />";
	
	try {
		$connexion = new PDO($dsn, $user, $password);
	}	
	catch(Exception $e) {
		echo 'Erreur : '.$e->getMessage().'<br />';
		echo 'N° : '.$e->getCode();
		die();
	}
	
	
?>