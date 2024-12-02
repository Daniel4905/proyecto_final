<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Coordenadas</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        #map {
            height: 400px;
            width: 100%;
            z-index: 100;
        }
    </style>
</head>

<body>
    <h1>Seleccionar Coordenadas</h1>
    <div id="map"></div>
    <p>Latitud: <span id="latitude"></span></p>
    <p>Longitud: <span id="longitude"></span></p>

    <script>
        const map = L.map('map').setView([3.430318, -76.491551], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);


        let marker = null;
        map.on('click', function (e) {
            const { lat, lng } = e.latlng;
            document.getElementById('latitude').textContent = lat.toFixed(6);
            document.getElementById('longitude').textContent = lng.toFixed(6);

            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker([lat, lng]).addTo(map);
        });
    </script>
</body>

</html>