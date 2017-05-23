<?php 
// On démarre la session AVANT d'écrire du code HTML
session_start();

?>
<!DOCTYPE HTML>

<html>
	<head>
		<?php
			include 'head_Vehicule.php';
			echo "<link href='CSS/default1.css' rel='stylesheet'>";
			echo "<link rel='stylesheet' href='CSS/google_map.css' />";
			echo "<script src='https://maps.googleapis.com/maps/api/js?sensor=false'></script>";
		?>
	</head>
	
	
	<body onload="initialize()">
		<?php $_SESSION['Nav_Activ'] = 1;
		include 'Menu_Nav_Vehicule.php';?>

	<?php
			if (empty($_GET['Immatriculation'])) {
				$Immatriculation = 'TW-080-XH';
				//$Immatriculation=$_SESSION['Immatriculation'];
				//$_SESSION['Immatriculation']=$Immatriculation;
			} else {
				$Immatriculation=$_GET['Immatriculation'];
				$_SESSION['Immatriculation']=$Immatriculation;
			}
		
			//$sql="SELECT Immatriculation,NumeroSerie,Nom,Prenom,Marque,Modele,Genre,Couleur,Teinte,Pays FROM Vehicule where Immatriculation='$Immatriculation';";
			//$results = tableSQL($sql);
		
			echo "<table id=\"affichetableau\">";
			echo "<tbody>";
		
				//foreach ($results as $ligne) {
					//on extrait chaque valeur de la ligne courante
					$Immatriculation = 'TW-080-XH';
					$NumeroSerie = 'unNumeroSerie';
					$Nom = 'UnNom';
					$Prenom = 'UnPrenom';
					$Marque = 'Peugeot';
					$Modele = '308 SW';
					$Couleur = 'Grise';
					$Pays = 'France';
					//$Immatriculation = $ligne[0];
					//$NumeroSerie = $ligne[1];
					//$Nom = $ligne[2];
					//$Prenom = $ligne[3];
					//$Marque = $ligne[4];
					//$Modele = $ligne[5];
					//$Couleur = $ligne[7];
					//$Pays = $ligne[9];
				//}
		?>

		<div class="container">
			<h1><a id="logo">Géolocalisation du véhicule (Test)</a></h1>
			<hr/>
			<div id="map_canvas"></div>
		
			<form id='annuler' action ='' method='post'>	
				<p>					
					<br/>
					<button type='submit' class='btn btn-default' aria-label='Left Align'>
  						Annuler
					</button>
				</p>
			</form>
		</div>
	</body>
</html>

<script>
var Immatriculation = '<?php echo $Immatriculation; ?>';
var NumeroSerie = '<?php echo $NumeroSerie; ?>';
var Nom = '<?php echo $Nom; ?>';
var Prenom = '<?php echo $Prenom; ?>';
var Pays = '<?php echo $Pays; ?>';
var Latitude = 48.390394; // Haut-Bas
var Longitude = -4.4860760000000255; // Gauche-Droite

// Ajout d'une ou plusieurs coordonnées.
var villes = [
	['Immatriculation : ' + Immatriculation, 'Numero de Série : ' + NumeroSerie, 'Nom : ' + Nom, 'Prénom : ' + Prenom, 'Pays : ' + Pays, Latitude, Longitude, 'CSS/images/GeoBlue.png'],
];

function initialize(){
	var mapOptions={
		zoom: 6, // 0 à 21
		center: new google.maps.LatLng(47,2), // centre de la carte
		mapTypeId: google.maps.MapTypeId.ROADMAP, // ROADMAP, SATELLITE, HYBRID, TERRAIN
	}
	var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
	setMarkers(map,villes);
}

function setMarkers(map,locations){
	for(var i=0; i<locations.length; i++){
		var villes = locations[i];
		var myLatLng = new google.maps.LatLng(villes[5],villes[6]);
		var infoWindow = new google.maps.InfoWindow();
		var marker = new google.maps.Marker ({
			position: myLatLng,
			map: map,
			icon: villes[7],
			animation: google.maps.Animation.DROP
		});
		(function(i){
			google.maps.event.addListener(marker, "click", function(){
				var villes = locations[i];
				infoWindow.close();
				infoWindow.setContent("<div>"+villes[0]+"<br />"+villes[1]+"<br />"+villes[2]+"<br />"+villes[3]+"<br />"+villes[4]+"</div>");
				infoWindow.open(map, this);
			});
		})(i);
	}
}

</script>