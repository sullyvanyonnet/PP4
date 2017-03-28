<?php
/**
 *  Bibliotheque de fonctions AccesDonnees.php
*
*
*
* @author Erwan
* @copyright Estran
* @version 5.3.6 Vendredi 24 Mars 2017
*
* - Ajout de la fonction ExecuteSQL_GE qui permet au developpeur de gerer les erreurs MySQL
* - Ajout de la fonction ProtectSQL qui protege des injections SQL en enlevant les carateres speciaux
* - Ajout de la fonction chemin
* - Ajout de la fonction import
* - Modification de la documentation
*
* Suite implementation Oracle
*
*/

///////////// CONFIGURATION DE L'ACCES AUX DONNEES ////////////////////

// nom du moteur d'acces a la base : mysql - mysqli - pdo
$modeacces = "pdo";

// type de la base de donnees : mysql - oracle
$typebase = "mysql";

// enregistrement des logs de connexion : true - false
$logcnx = FALSE;

// enregistrement des requetes SQL : none - all - modif
$logsql = "none";

//////////////////////////////////////////////////////////////////////




$mysql_data_type_hash = array(
		1=>'tinyint',
		2=>'smallint',
		3=>'int',
		4=>'float',
		5=>'double',
		7=>'timestamp',
		8=>'bigint',
		9=>'mediumint',
		10=>'date',
		11=>'time',
		12=>'datetime',
		13=>'year',
		16=>'bit',
		//252 is currently mapped to all text and blob types (MySQL 5.0.51a)
		252=>'blob',
		253=>'string',
		254=>'string',
		246=>'decimal'
);






/**
 *
 *Affiche les informations de connexion pour le debugage
 *
 *
 *
 */
function info($dbname) {

	global $modeacces, $typebase;

	echo "<br/>Base : ". $dbname." <br />";
	echo "Mode acces : $modeacces<br />";
	echo "Version AD : ".numeroVersion()."<br />";

}



/**
 *
 *Retourne le chemin courant
 *
 *
 * @return string - Retourne une chaine de caracteres representant le chemin courant
 *
 */
function chemin() {

	return realpath(getcwd());
}



/**
 *
 *Retourne les infomations sur la version de la bibliotheque AccesDonnee.php
 *
 *
 * @return string - Retourne une chaine de caracteres representant le numero de la version de la
 *         bibliotheque AccesDonnees.php
 */
function version() {

	return "AccesDonnees.php -- Version ".numeroVersion()." du ".dateVersion()."<br />";
}



/**
 *
 *Retourne le numero de version
 *
 *
 * @return string - Retourne une chaine de caracteres representant le numero de la version de la
 *         bibliotheque AccesDonnees.php
 */
function numeroVersion() {

	return "5.3.6";
}



/**
 *
 *Retourne la date de la version
 *
 *
 * @return string - Retourne une chaine de caracteres representant le date de la version de la
 *         bibliotheque AccesDonnees.php
 */
function dateVersion() {

	return "Vendredi 24 Mars 2017";
}



/**
 *
 * Ouvre une connexion a un serveur MySQL ou ORACLE et selectionne une base de donnees.
 * @param host string
 *  <p>Adresse du serveur MySQL.</p>
 * @param port integer
 *  <p>Numero du port du serveur MySQL.</p>
 * @param dbname string
 *  <p>Nom de la base de donnees.</p>
 * @param user string
 *  <p>Nom de l'utilisateur.</p>
 * @param password string
 *  <p>Mot de passe de l'utilisateur.</p>
 *
 *
 * @return resource - Retourne l'identifiant de connexion MySQL en cas de succes
 *         ou FALSE si une erreur survient.
 */
function connexion($host,$port,$dbname,$user,$password) {

	global $modeacces, $logcnx, $connexion, $typebase;



	/*  TEST CNX ORACLE
	 *
	 */
	if ($modeacces=="pdo") {

		if ($typebase=="mysql") {

			// ceation du Data Source Name, ou DSN, qui contient les infos
			// requises pour se connecter a  un base de donnees MySQL en
			// utilisant un driver PDO.
			$dsn='mysql:host='.$host.';port='.$port.';dbname='.$dbname;

		}

		if ($typebase=="oracle") {

			// ceation du Data Source Name, ou DSN, qui contient les infos
			// requises pour se connecter a  la base en PDO driver oracle.
			// exemple : oci:dbname=//10.100.22.20:1521/ora18sdis29
			$dsn='oci:dbname=//'.$host.':'.$port.'/'.$dbname;

		}
			
		try
		{
			$connexion = new PDO($dsn, $user, $password);
		}
			
		catch(Exception $e)
		{
			/*echo 'Erreur : '.$e->getMessage().'<br />';
			 echo 'Numero : '.$e->getCode();
			 die();*/
			$chaine = "Connexion PB - ".date("j M Y - G:i:s - ").$user." - ". $e->getCode() . " - ". $e->getMessage()."\r\n";
			$connexion = FALSE;
		}
			
		if ($connexion) {
			$chaine = "Connexion OK - ".date("j M Y - G:i:s - ").$user."\r\n";
		}


	}


	if ($modeacces=="mysql") {
			
		@$link = mysql_connect("$host:$port", "$user", "$password");

		if (!$link) {
			$chaine = "Connexion PB - ".date("j M Y - G:i:s - ").$user." - ". mysql_error()."\r\n";
			$connexion = FALSE;
		} else {
			@$connexion = mysql_select_db("$dbname");
			if (!$connexion) {
				$chaine = "Selection base PB - ".date("j M Y - G:i:s - ").$user." - ". mysql_error()."\r\n";
				$connexion = FALSE;
			} else {
				$chaine = "Connexion OK - ".date("j M Y - G:i:s - ").$user."\r\n";
			}
		}

	}


	if ($modeacces=="mysqli") {

		@$connexion = new mysqli("$host", "$user", "$password", "$dbname", $port);

		if ($connexion->connect_error) {
			$chaine = "Connexion PB - ".date("j M Y - G:i:s - ").$user." - ". $connexion->connect_error."\r\n";
			$connexion = FALSE;
		} else {
			$chaine = "Connexion OK - ".date("j M Y - G:i:s - ").$user."\r\n";
		}

	}


	if ($logcnx) {
		$handle=fopen("log.txt","a");
		fwrite($handle,$chaine);
		fclose($handle);
	} else {
		//echo $chaine."<br />";
	}
	return $connexion;

}



/**
 *
 * Ouvre une connexion a un serveur MySQL.
 * @param host string
 *  <p>Adresse du serveur MySQL.</p>
 * @param port integer
 *  <p>Numero du port du serveur MySQL.</p>
 * @param user string
 *  <p>Nom de l'utilisateur.</p>
 * @param password string
 *  <p>Mot de passe de l'utilisateur.</p>
 *
 *
 * @return resource - Retourne l'identifiant de connexion MySQL en cas de succes
 *         ou FALSE si une erreur survient.
 */
function cnxserveur($host,$port,$user,$password) {

	global $modeacces, $typebase;



	if ($modeacces=="pdo") {

		if ($typebase=="mysql") {
			$dsn='mysql:host='.$host.';port='.$port;
			echo "test2...";
		}

		if ($typebase=="oracle") {
			$dsn='oci:dbname=//'.$host.':'.$port.'/'.$dbname;
		}
			
		@$link = new PDO($dsn, $user, $password);
		var_dump($link);

	}



	if ($modeacces=="mysql") {
		@$link = mysql_connect("$host:$port", "$user", "$password");
	}

	if ($modeacces=="mysqli") {
		@$link = mysqli_connect($host, $user, $password);
	}

	if (!$link) {
		return FALSE;
	} else {
		return $link;
	}

}



/**
 *
 * Selectionne une base de donnee sur la connexion ouverte.
 * @param dbname string
 *  <p>Nom de la base de donnee.</p>
 *
 *
 * @return resource - Retourne TRUE en cas de succes
 *         ou FALSE si une erreur survient.
 */
function selectDB($dbname) {

	global $modeacces, $connexion;

	if ($modeacces=="pdo") {
		//$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$connexion->exec("use ".$dbname);
	}

	if ($modeacces=="mysql") {
		return (@$connexion = mysql_select_db("$dbname"));
	}

	if ($modeacces=="mysqli") {
		return (mysqli_select_db($connexion, $dbname));
	}

}



/**
 *
 * Ferme la connexion MySQL.
 *
 */
function deconnexion() {

	global $modeacces, $connexion;

	if ($modeacces=="pdo") {
		$connexion=NULL;
	}

	if ($modeacces=="mysql") {
		mysql_close();
	}

	if ($modeacces=="mysqli") {
		$connexion->close();
	}

}



/**
 *
 * Protege des injections SQL en enlevant les caracteres speciaux
 *  * @param sql string
 *  <p>Requete SQL.</p>
 *
 *
 * @return string - Requete SQL sans les caracteres speciaux
 *
 *
 *
 */
function protectSQL($sql) {

	global $modeacces, $connexion;

	if ($modeacces=="pdo") {
		//protect SQL ne sert a rien en PDO
		//utiliser les requetes prerparer
		return $sql;
	}

	if ($modeacces=="mysql") {
		return mysql_real_escape_string($sql);
	}

	if ($modeacces=="mysqli") {
		return $connexion->real_escape_string($sql);
	}

}



/**
 *
 *Envoie une requete a un serveur MySQL.
 * @param sql string
 *  <p>Requete SQL.</p>
 *
 *
 * @return resource - Pour les requetes du type SELECT, SHOW, DESCRIBE, EXPLAIN et
 *          les autres requetes retournant un jeu de resultats, mysql_query()
 *          retournera une ressource en cas de succes, ou DIE en cas d'erreur.
 *
 *          Pour les autres types de requetes, INSERT, UPDATE, DELETE, DROP, etc.,
 *          mysql_query() retourne TRUE en cas de succes ou DIE en cas d'erreur.
 */
function executeSQL($sql) {

	global $modeacces, $connexion, $logsql;

	$uneChaine = date("j M Y - G:i:s --> ").$sql."\r\n";

	if ($logsql=="all") {

		ecritRequeteSQL($uneChaine);

	} else {

		if ($logsql=="modif") {

			$mot=strtolower(substr($sql,0, 6));
			if ($mot=="insert" || $mot=="update") {
				ecritRequeteSQL($uneChaine);
			}

		}

	}

	if ($modeacces=="pdo") {
		$result = $connexion->query($sql)
		or die ( afficheErreur($sql,$connexion->errorInfo()[2]));
	}

	if ($modeacces=="mysql") {
		$result = mysql_query($sql)
		or die (afficheErreur($sql, mysql_error()));

	}

	if ($modeacces=="mysqli") {
		$result = $connexion->query($sql)
		//or die (afficheErreur($sql, mysqli_error_list($connexion)[0]['error']));
		or die (afficheErreur($sql, $connexion->error_list[0]['error']));


	}

	return $result;
}

/**
 *
 *Formate l'erreur de la requete SQL pour afficher les informations :
 *    - Nom du serveur
 *    - Nom du fichier
 *    - Ligne de l'erreur
 *    - Erreur SQL
 *    - Requete SQL (en gras)
 * @param sql string
 *  <p>Requete SQL.</p>
 * @param erreir string
 *  <p>Erreur SQL.</p>
 *
 * @return string - Chaine de carateres bien formatee.
 */
function afficheErreur($sql, $erreur) {

	$uneChaine = "ERREUR SQL : ".date("j M Y - G:i:s.u --> ").$sql." : ($erreur) \r\n";

	ecritRequeteSQL($uneChaine);

	return "Erreur SQL de <b>".$_SERVER["SCRIPT_NAME"].
	"</b>.<br />Dans le fichier : ".__FILE__.
	" a la ligne : ".__LINE__.
	"<br />".$erreur.
	"<br /><br /><b>REQUETE SQL : </b>$sql<br />";

}

/**
 *
 *Ecrit une requete SQL a la fin du fichier
 * @param sql string
 *  <p>Requete SQL.</p>
 *
 *
 */
function ecritRequeteSQL($uneChaine) {
	$handle=fopen("requete.sql","a");
	fwrite($handle,$uneChaine);
	fclose($handle);
}



/**
 *
 *Envoie une requete a un serveur MySQL laisse le programmeur Gerer les Erreurs.
 * @param sql string
 *  <p>Requete SQL.</p>
 *
 *
 * @return resource - Pour les requetes du type SELECT, SHOW, DESCRIBE, EXPLAIN et
 *          les autres requetes retournant un jeu de resultats, mysql_query()
 *          retournera une ressource en cas de succes, ou FALSE en cas d'erreur.
 *
 *          Pour les autres types de requetes, INSERT, UPDATE, DELETE, DROP, etc.,
 *          mysql_query() retourne TRUE en cas de succes ou FALSE en cas d'erreur.
 */
function executeSQL_GE($sql) {

	global $modeacces, $connexion;


	if ($modeacces=="pdo") {
		$result = $connexion->query($sql);
	}

	if ($modeacces=="mysql") {
		$result = mysql_query($sql);

	}

	if ($modeacces=="mysqli") {
		$result = $connexion->query($sql);
	}

	return $result;
}



/**
 *
 *Retourne un tableau resultat d'une requete SQL
 * @param $sql string
 * 		<p>Requete SQL</p>
 *
 * @return array Tableau indexe et associatif resultat de la requete SQL
 *
 * <br/>
 * @example
 <code>
 $sql = "select * from user";				<br />
 $results = tableSQL($sql);					<br />
 foreach ($results as $row) {				<br />
 &nbsp;&nbsp;$login = $row['login'];		<br />
 &nbsp;&nbsp;$password = $row[3];			<br />
 &nbsp;&nbsp;echo $login." ".$password; 	<br />
 }											<br />
 </code>
 */
function tableSQL($sql) {

	global $modeacces, $connexion;

	$result = executeSQL($sql);
	$rows=array();

	if ($modeacces=="pdo") {
		//while ($row = $result->fetch(PDO::FETCH_BOTH)) {
		//	array_push($rows,$row);
		//}
		$rows = $result->fetchAll(PDO::FETCH_BOTH);
	}


	if ($modeacces=="mysql") {
		while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
			array_push($rows,$row);
		}
	}

	if ($modeacces=="mysqli") {
		while ($row = $result->fetch_array(MYSQLI_BOTH)) {
			array_push($rows,$row);
		}
		//$rows = $result->fetch_all(MYSQLI_BOTH);
		
	}

	return $rows;
}



/**
 *
 *Retourne le nombre de lignes d'une requete MySQL.
 * @param sql string
 *  <p>Requete SQL.</p>
 *
 *
 * @return integer - Le nombre de lignes dans un jeu de resultats en cas de succes
 *         ou FALSE si une erreur survient.
 */
function compteSQL($sql) {

	global $modeacces, $connexion, $typebase;

	if ($modeacces=="pdo") {

		if ($typebase=="mysql") {
			$repueteP=$connexion->prepare($sql);
			$repueteP->execute();
			$num_rows = $repueteP->rowCount();
		}

		if ($typebase=="oracle") {
			$recordset=$connexion->query($sql);
			$fields = $recordset->fetchAll(PDO::FETCH_ASSOC);
			$num_rows = sizeof($fields);
		}

	}

	if ($modeacces=="mysql") {
		$result = executeSQL($sql);
		$num_rows = mysql_num_rows($result);
	}

	if ($modeacces=="mysqli") {
		$result = executeSQL($sql);
		$num_rows = $connexion->affected_rows;
	}

	return $num_rows;
}



/**
 *
 *Retourne un seul champ resultat d'une requete MySQL.
 * @param sql string
 *  <p>Requete SQL.</p>
 *
 *
 * @return string - une chaine resultat de la requete MySQL.
 */
function champSQL($sql) {

	global $modeacces, $connexion;

	$result = executeSQL($sql);

	if ($modeacces=="pdo") {
		$rows = $result->fetch(PDO::FETCH_BOTH);
	}

	if ($modeacces=="mysql") {
		$rows = mysql_fetch_array($result, MYSQL_NUM);
	}

	if ($modeacces=="mysqli") {
		$rows = $result->fetch_array(MYSQLI_NUM);
	}

	return $rows[0];
}



/**
 *
 *Retourne un seule ligne resultat d'une requete SQL
 * @param $sql string
 *  	<p>Requete SQL</p>
 *
 * @return array Tableau indexe et associatif representant la ligne
 *
 * <br/>
 * @example
 <code>
 $sql = "select * from user where numero = 1 "; <br />
 $results = ligneSQL($sql);						<br /><br />
 $login =$results['login'];						<br />
 $password = $results[3];					    <br />
 echo $login." ".$password;						<br />
 </code>
 */
function ligneSQL($sql) {

	global $modeacces, $connexion;

	$result = executeSQL($sql);

	if ($modeacces=="pdo") {
		$rows = $result->fetch(PDO::FETCH_BOTH);
	}

	if ($modeacces=="mysql") {
		$rows = mysql_fetch_array($result, MYSQL_BOTH);
	}

	if ($modeacces=="mysqli") {
		$rows = $result->fetch_array(MYSQLI_BOTH);
	}

	return $rows;
}



/**
 *
 *Retourne le nombre de champs d'une requete MySQL
 * @param sql string
 *  <p>Requete SQL.</p>
 *
 *
 * @return integer - Retourne le nombre de champs d'un jeu de resultat en cas de succes
 *         ou FALSE si une erreur survient.
 */
function nombreChamp($sql) {

	global $modeacces, $connexion;

	if ($modeacces=="pdo") {
		//utilisation d'une requete preparee
		$requeteP=$connexion->prepare($sql);
		$requeteP->execute();
		$num_rows = $requeteP->columnCount();
		return $num_rows;
	}

	if ($modeacces=="mysql") {
		$result = executeSQL($sql);
		return mysql_num_fields($result);
	}

	if ($modeacces=="mysqli") {
		$result = executeSQL($sql);
		return  $result->field_count;
	}

}



/**
 *
 *Retourne le type d'une colonne MySQL specifique
 * @param sql string
 *  <p>Requete SQL.</p>
 * @param field_offset integer
 *  <p>La position numerique du champ. field_offset commence a  0. Si field_offset
 *     n'existe pas, une alerte E_WARNING sera egalement generee.</p>
 *
 *
 * @return string - Retourne le type du champ retourne peut etre : "int", "real", "string", "blob"
 *         ou d'autres, comme detaille Â» dans la documentation MySQL.
 *
 */
function typeChamp($sql, $field_offset) {

	global $modeacces, $connexion, $mysql_data_type_hash, $typebase;

	$result = executeSQL($sql);

	if ($modeacces=="pdo") {

		//recupere le  nom de la table
		$posfrom = strpos(strtoupper($sql), "FROM");
		$newsql = substr($sql, $posfrom+5, strlen($sql)-5-$posfrom);
		$nomtables = explode(' ',$newsql);
		$nomtable = trim($nomtables[0]);
		//gestion des , plusieurs tables
		$nomtables = explode(',',$nomtable);
		$nomtable = trim($nomtables[0]);

		if ($typebase=="mysql") {
			$recordset = $connexion->query("SHOW COLUMNS FROM $nomtable");
			$fields = $recordset->fetchAll(PDO::FETCH_ASSOC);
			$letype = ($fields[$field_offset]["Type"]);
		}
			
		if ($typebase=="oracle") {
			$nomDuChamp = nomChamp($sql,$field_offset);
			$sqlD =" SELECT data_type
			FROM user_tab_cols
			WHERE COLUMN_NAME='$nomDuChamp' AND TABLE_NAME='$nomtable'";
			$letype =  champSQL($sqlD);
		}
			
		// harmonisation entre les differents types des bases de donnees
		if (stristr($letype,'varchar')!=FALSE) {
			$letype="string";
		}
		if (stristr($letype,'char')!=FALSE) {
			$letype="string";
		}
		if (stristr($letype,'int')!=FALSE) {
			$letype="int";
		}
		if (stristr($letype,'number')!=FALSE) {
			$letype="int";
		}
		if (stristr($letype,'date')!=FALSE) {
			$letype="date";
		}

		return $letype;
	}

	if ($modeacces=="mysql") {
		return mysql_field_type($result, $field_offset);
	}

	if ($modeacces=="mysqli") {
		return  $mysql_data_type_hash[$result->fetch_field_direct($field_offset)->type];
	}

}




/**
 *
 *Retourne le nom d'une colonne MySQL specifique
 * @param sql string
 *  <p>Requete SQL.</p>
 * @param field_offset integer
 *  <p>La position numerique du champ. field_offset commence a  0. Si field_offset
 *     n'existe pas, une alerte E_WARNING sera egalement generee.</p>
 *
 *
 * @return string - Retourne le nom du champ d'une colonne specifique
 *
 */
function nomChamp($sql, $field_offset) {

	global $modeacces, $connexion, $mysql_data_type_hash;

	/* getColumnMeta est EXPERIMENTALE. Cela signifie que le comportement de cette fonction, son nom et,
	 * concretement, TOUT ce qui est documente ici peut changer dans un futur proche, SANS PREAVIS !
	 * Soyez-en conscient, et utilisez cette fonction a  vos risques et perils.
	 *
	 *    $select = $connexion->query($sql);
	 *	  $meta = $select->getColumnMeta($field_offset);
	 *	  return ($meta["name"]);
	 */

	if ($modeacces=="pdo") {
		$requeteP=$connexion->prepare($sql);
		$requeteP->execute();
		$fields = $requeteP->fetch(PDO::FETCH_BOTH);
		return (array_keys($fields)[$field_offset*2]);
	}

	if ($modeacces=="mysql") {
		$result = executeSQL($sql);
		return mysql_field_name($result, $field_offset);
	}

	if ($modeacces=="mysqli") {
		$result = executeSQL($sql);
		$infos = $result->fetch_field_direct($field_offset);
		return $infos->name;
	}

}



/**
 *
 *Retourne la version du serveur
 *
 *
 * @return string - Retourne une chaine de caracteres representant la version du serveur
 *         auquel l'extension  est connectee (represente par le parametre $connexion).
 */
function versionBase() {

	global $typebase, $connexion;

	if ($typebase=="mysql") {

		return versionMYSQL();
			
	}

	if ($typebase=="oracle") {

		return versionOracle();
	}

}

/**
 *
 *Retourne la version du serveur MySQL
 *
 *
 * @return string - Retourne une chaine de caracteres representant la version du serveur MySQL
 *         auquel l'extension  est connectee (represente par le parametre $connexion).
 */
function versionMYSQL() {

	global $modeacces, $connexion;

	if ($modeacces=="pdo") {
		return $connexion->getAttribute(constant("PDO::ATTR_SERVER_VERSION"));
	}

	if ($modeacces=="mysql") {
		return mysql_get_server_info();
	}

	if ($modeacces=="mysqli") {
		return   $connexion->server_info;
	}

}

/**
 *
 *Retourne la version du serveur ORACLE
 *
 *
 * @return string - Retourne une chaine de caracteres representant la version du serveur ORACLE
 *         auquel l'extension  est connectee (represente par le parametre $connexion).
 */
function versionOracle() {

	///////////////////////
	///////////////////////
	//////////////////////
	// TODO EN PDO
	$conn = oci_connect('scott', 'tiger', '10.0.220.100:1521/ORAPROF');
	$version = oci_server_version($conn);
	oci_close($conn);

	return $version;
}



/**
 *
 *Retourne le nom de la base courante
 *
 *
 * @return string - Retourne une chaine de caracteres representant le nom de la base de donnees
 *         auquel l'extension  est connectee (represente par le parametre $connexion).
 */
function nomBase() {

	global $modeacces, $connexion;

	$sql = "SELECT DATABASE()";
	return champSQL($sql);
}



/**
 *
 *Affiche sous forme d'un tableau le resultat d'une requette SQL
 * @param sql string
 *  <p>Requete SQL.</p>
 *
 *
 */
function afficheRequete($sql) {

	$results = tableSQL($sql);

	$nbchamps = nombreChamp($sql);

	echo "<table style=\"border: 2px solid blue; border-collapse: collapse; \">";
	echo "   <caption style=\"color:green;font-weight:bold\">$sql</caption>
	<tr style=\"border: 2px solid blue; border-collapse: collapse; \" >";
	for ($i=0;$i<$nbchamps;$i++) {
		echo "<th style=\"border: 2px solid blue; border-collapse: collapse; \">".nomChamp($sql,$i)."(".typeChamp($sql,$i).")</th>";
	}
	echo "   </tr>";

	foreach ($results as $ligne) {
		echo "<tr style=\"border: 1px solid red; border-collapse: collapse; \">";
		//on extrait chaque valeur de la ligne courante
		for ($i=0;$i<$nbchamps;$i++) {
			echo "<td style=\"border: 1px solid red; border-collapse: collapse; \">".$ligne[$i]."</td>";
		}
		echo "</tr>";
	}

	echo "</table>";
}



/**
 *
 *Sauvegarde (DUMP) dans un fichier texte la base de donnees courante.
 * @param mode string
 *  <p>S pour la structure de la base de donnees
 *     D pour les donnees de la base
 *     A pour la structure et les donnees de la base</p>
 * @param repertoire string
 *  <p>Nom du repertoire dans lequel le fichier dump sera sauvagarde
 *     si NULL on sauvegarde dans le repertoire courant</p>
 * @param nomfichier string
 *  <p>Nom du fichier pour le dump (ajout de l'extension .slq)
 *     si NULL on utilise 'nomDeLaBase'.sql </p>
 *
 */
function export($mode,$repertoire,$nomfichier) {

	global $modeacces, $connexion;

	$dbname=nomBase();
	
	date_default_timezone_set('Europe/Paris');
	// --- La setlocale() fonctionnne pour strftime mais pas pour DateTime->format()
	setlocale(LC_TIME, 'fr_FR.utf8','fra');// OK
	// strftime("jourEnLettres jour moisEnLettres annee") de la date courante
	$datefr1 = ucfirst(strftime("%A %d"));
	$datefr2 = ucfirst(strftime("%B %Y").date(" \à H:i:s"));
	$datefr = $datefr1 ." ". $datefr2;
	$entete  = "-- ----------------------\n";
	$entete .= "-- Dump de la base ".$dbname." du ".$datefr."\n";
	$entete .= "-- ----------------------\n\n\n";
	
	$creations ="";
	$insertions="\n\n";

	$sql = "show tables";
	$results = tableSQL($sql);


	foreach ($results as $ligne) {
		//on extrait chaque valeur de la ligne courante
		$table = $ligne[0];


		// structure de la table
		$creations .= "-- -----------------------------\n";
		$creations .= "-- Structure de la table ".$table."\n";
		$creations .= "-- -----------------------------\n";

		$sql1 = "show create table ".$table;
		$requetes = ligneSQL($sql1);
		 
		$creations .= $requetes[1]."\n\n";


		// donnees de la table
		$sql2 = "SELECT * FROM ".$table;
		$results2 = tableSQL($sql2);

		$insertions .= "-- -----------------------------\n";
		$insertions .= "-- Contenu de la table ".$table."\n";
		$insertions .= "-- -----------------------------\n";

		foreach($results2 as $ligne2) {

			$nombredechamps = nombrechamp($sql2);

			$insertions .= "INSERT INTO ".$table." VALUES(";

			for($i=0; $i <$nombredechamps; $i++) {
					
				$letypeduchamp = typechamp($sql2,$i);
				$lavaleurduchamp =  $ligne2[$i];
					
				if ($i != 0)
					$insertions .=  ", ";

					if ($letypeduchamp == "string" || $letypeduchamp == "blob")
						$insertions .=  "'";

						//ajouter un NULL a la place d'un '' pour un champ de type INT
						if  ($letypeduchamp == "int" && $lavaleurduchamp == '')
							$insertions .="NULL";
							else
								$insertions .= addslashes($lavaleurduchamp);
									
								if ($letypeduchamp == "string" ||$letypeduchamp == "blob")
									$insertions .=  "'";
			}

			$insertions .=  ");\n";

		}

		$insertions .= "\n";

	}


	if ($repertoire == NULL)
		$repertoire = ".";

		if ($nomfichier == NULL) {
			$info = date("dMy(H-i-s)");
			$nomfichier = $dbname."_".$info.".sql";
		}

		$nf =  $repertoire."/".$nomfichier;

		//echo "Nom fic : $nf <br />";

		$fichierDump = fopen($nf, "w");
		fwrite($fichierDump, $entete);
		//echo "Entete $dbname sauvegardee...<br />";
		if ($mode == 'S' or $mode == 'A') {
			fwrite($fichierDump, $creations);
			//echo "Structure de la base $dbname sauvegardee...<br />";
		}
		if ($mode == 'D' or $mode == 'A') {
			fwrite($fichierDump, $insertions);
			//echo "Donnees de la base $dbname sauvegardee...<br />";
		}
		fclose($fichierDump);

}

/**
 *
 *Exporte la structure et les donnees de la base de donnees courante a  la racine
 *avec pour nom le nom de la base de donnees.
 *
 */
function dump() {
	export("A",NULL,nomBase().".sql");
}

/**
 *
 *Exporte la structure de la base de donnees courante a  la racine
 *avec pour nom le nom de la base de donnees.
 *
 */
function exportBase() {
	export("S",NULL,nomBase().".sql");
}

/**
 *Sauvegarde dans le repertoire 'repertoire' les donnees de la base.
 *le nom du fichier est gere en fonction de la date et de l'heure
 * @param repertoire string
 *  <p>Nom du repertoire dans lequel le fichier dump sera sauvagarde
 *     si NULL on sauvegarde dans le repertoire courant</p>
 *
 */
function sauvegarde($repertoire) {
	dump("D",$repertoire,NULL);
}



/**
 *
 *Restaure depuis un fichier texte la base de donnees dbname.
 *
 * @param fichier string
 *  <p>Nom du repertoire dans lequel le fichier dump sera sauvagarde</p>
 *
 * @param dbname string
 *  <p>Nom du repertoire dans lequel le fichier dump sera sauvagarde</p>
 *
 * @return string - Retourne des informations sur l'importation
 *
 */

function import($fichier,$dbname){

	global $modeacces, $connexion;


	//quelques informations importantes
	$ipsrv=$_SERVER['SERVER_ADDR'];
	$versionPHP=getenv("SERVER_SOFTWARE");
	$namesrv=$_SERVER['SERVER_NAME'];

	if (selectDB($dbname)) {
		$sql = "SHOW tables";
		$results = tableSQL($sql);
		foreach ($results as $ligne) {
			//on extrait chaque valeur de la ligne courante
			$nomTable = $ligne[0];
			$sql = "DROP TABLE `$nomTable`";
			$result = executeSQL($sql);
		}
	}  else {
		//sinon on cree la base
		$sql="CREATE DATABASE `$dbname` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
		$result = executeSQL($sql);
	}

	//on utilise la base de donnees
	$sql="USE `$dbname`";
	$result = executeSQL($sql);

	//desactive les cle etrangere pour pouvoir effacer les tables de la base
	$sql = "SET FOREIGN_KEY_CHECKS = 0";
	$result = executeSQL($sql);

	$versionMySQL=versionMYSQL();

	//restaure la base en fonction du fichier creer par le dump (V2)
	//Lit le fichier et renvoie le resultat dans un tableau
	$lines = file($fichier);
	$versionBase=$lines[1];

	$sql="";

	//execute toutes les requetes du fichier de dump
	for($i=0;$i<count($lines);$i++){

		$line=$lines[$i];
		if ($line[0]!='-' && $line[0]!='/' && strlen($line)>2) {
			$sql=$sql.$line;
			$test=strrev($line);
			$pospv=strpos($test,";");
			if ($pospv>0 && $pospv<5){
				$result = executeSQL($sql);
				$sql="";
			}
		}
	}

	//reactive les cle etrangere la base
	$sql = "SET FOREIGN_KEY_CHECKS = 1";
	$result = executeSQL($sql);

	$versionBase= substr($versionBase,23+strlen($dbname),strlen($versionBase)-23-strlen($dbname));
	$versionBase = str_replace("a ","<br />",$versionBase);

	//retourne les infos
	return "<font color=green> Version base  $dbname <br /> $versionBase <br />$namesrv(IP : $ipsrv)<br />$versionPHP<br />MySQL : $versionMySQL</font>";

}
?>