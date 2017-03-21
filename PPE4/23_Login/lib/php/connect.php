<?php
	
	$ip=explode(".",$_SERVER['SERVER_ADDR']);
	
	switch ($ip[0]) {
		
		case 127 :
		 default :	
			//local
			$host = "anthonybigbdd.mysql.db";
			$user = "anthonybigbdd";
			$password = "Mesgpass1";
			$dbname = "anthonybigbdd";
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