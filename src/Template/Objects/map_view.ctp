<?php
  use Cake\Routing\Router;
?>
<center><h1>VISUALIZAÇÃO DE OBJETOS PERDIDOS</h1></center>
<div class="jumbotron hero-spacer">
	<div class="mapa">
		<div id="mapa" style="height: 500px; width: 100%"></div>
	</div>
</div>
<script type="text/javascript">
var map;
function initialize() {
	var latlng = new google.maps.LatLng(-20.502524,-54.613458);
	var options = {
		zoom: 16,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("mapa"), options);
}
initialize();

var idInfoBoxAberto;
var infoBox = [];
var markers = [];
var latlngbounds = new google.maps.LatLngBounds();
 
function abrirInfoBox(id, marker) {
    if (typeof(idInfoBoxAberto) == 'number' && typeof(infoBox[idInfoBoxAberto]) == 'object') {
        infoBox[idInfoBoxAberto].close();
    }
    infoBox[id].open(map, marker);
    idInfoBoxAberto = id;
}
function carregarPontos() {
	$.ajax({
		type:"POST",
		url:"<?php echo Router::url(array('controller' => 'Objects', 'action' => 'generateDataMaps'));?>",
		success: function(data){
			$.each(data, function(index, ponto) {
				var marker = new google.maps.Marker({
					position: new google.maps.LatLng(ponto.latitude, ponto.longitude),
					title: "Meu ponto personalizado! :-D",
					map: map,
					icon: 'webroot/img/marcador.png'
				});
				var myOptions = {
					content: "<div class='map-content'><p id='map-title'>Nome do objeto: <span id='map-name'>" + ponto.name + "</span></p><p id='map-title'>Tipo do objeto: <span id='map-name'>" + ponto.type + "</span></p><p id='map-title'>Latitude: <span id='map-name'>" + ponto.latitude + "</span></p><p id='map-title'>Longitude: <span id='map-name'>" + ponto.longitude + "</span></p></div>",
					pixelOffset: new google.maps.Size(-150, 0)
				};
				infoBox[ponto.id] = new InfoBox(myOptions);
				infoBox[ponto.id].marker = marker;
				infoBox[ponto.id].listener = google.maps.event.addListener(marker, 'click', function (e) {
					abrirInfoBox(ponto.id, marker);
				});
				markers.push(marker);
				latlngbounds.extend(marker.position);
			});
			var markerCluster = new MarkerClusterer(map, markers);
			map.fitBounds(latlngbounds);
		},
		error: function () {
			alert('error');
		}
	});
}
carregarPontos();
</script>