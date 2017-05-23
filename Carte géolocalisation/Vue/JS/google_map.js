var Nom = '<?php echo $Nom; ?>';
var Prenom = '<?php echo $Prenom; ?>';

var villes = [
	['Toulouse', 'la ville rose', 43.604482, 1.443962, 'CSS/images/marker.png'],
	['Blois', 'ville historique', 47.593889, 1.328056, 'CSS/images/marker.png'],
	[Nom, Prenom, 48.856578, 2.351828, 'CSS/images/GeoSuspect.png']
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
		var myLatLng = new google.maps.LatLng(villes[2],villes[3]);
		var infoWindow = new google.maps.InfoWindow();
		var marker = new google.maps.Marker ({
			position: myLatLng,
			map: map,
			icon: villes[4],
			animation: google.maps.Animation.DROP
		});
		(function(i){
			google.maps.event.addListener(marker, "click", function(){
				var villes = locations[i];
				infoWindow.close();
				infoWindow.setContent("<div>"+villes[0]+"<br />"+villes[1]+"</div>");
				infoWindow.open(map, this);
			});
		})(i);
	}
}
