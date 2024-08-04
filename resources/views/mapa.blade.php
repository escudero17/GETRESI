<!DOCTYPE html>
<html>
<head>
    <title>Mapa Simple</title>
    <style>
        /* Estilo para el contenedor del mapa */
        #map {
            height: 400px; /* Altura del mapa */
            width: 100%; /* Ancho del mapa */
        }
    </style>
</head>
<body>
    <!-- Contenedor del mapa -->
    <div id="map"></div>

    <script>
        // Función para inicializar el mapa
        function initMap() {
            // Coordenadas del centro del mapa
            var myLatLng = { lat: 40.7128, lng: -74.0060 };

            // Crear un nuevo mapa y colocarlo en el contenedor #map
            var map = new google.maps.Map(document.getElementById('map'), {
                center: myLatLng, // Centrar el mapa en las coordenadas especificadas
                zoom: 12 // Nivel de zoom
            });

            // Crear un marcador en las coordenadas especificadas
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: '¡Hola, mundo!' // Título del marcador
            });
        }
    </script>

    <!-- Incluir el script de la API de Google Maps con tu clave de API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUwrZUI61eat02XQkJhhPJfGOr3CyKhKE&callback=initMap" async defer></script>
</body>
</html>