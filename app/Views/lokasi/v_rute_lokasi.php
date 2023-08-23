<div name="jarak" id="Jarak"></div>
<div name="posisi" id="Posisi"></div>

<div id="map" style="width: 100%; height:80vh;"></div>

<script>
    streets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
    });

    hybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
    });

    sattelite = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
    });

    const map = L.map('map', {
        // center: [-6.579813989890926, 106.77248335359333],
        zoom: 14,
        layers: [streets]
    });

    const baseLayers = {
        'streets': streets,
        'hybrid': hybrid,
        'sattelite': sattelite,
    };

    const layerControl = L.control.layers(baseLayers, null, {collapsed:false}).addTo(map);
    

    //geolocation
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {


            const userLatLng = L.latLng(position.coords.latitude, position.coords.longitude);
            // Set the map's center to the user's location
            map.setView(userLatLng);

            //rute
            var routingControl = L.Routing.control({
                waypoints: [
                    L.latLng(position.coords.latitude, position.coords.longitude),  //lokasi asal
                    L.latLng(<?= $lokasi['latitude'] ?>, <?= $lokasi['longitude'] ?>),  //lokasi tujuan
                ]
            }).addTo(map);
            
            //mengambil jarak
            routingControl.on('routesfound', function(e) {
                var routes = e.routes;
                var summary = routes[0].summary;
                var totalDistance = summary.totalDistance;
                //kirim nilai jarak ke elemen input
                document.getElementById('Jarak').value = totalDistance;
                animasiCar(routes[0]);
            });
        });

        //animasi perjalanan
        function animasiCar(route) {
            var iconMobil = L.icon({
                iconUrl: '<?= base_url('marker/car.png') ?>',
                iconSize: [30, 35],
            });
            var mobil = L.marker([route.coordinates[0].lat, route.coordinates[0].lng], {
                icon : iconMobil
            }).addTo(map);

            var index = 0;
            var maxIndex = route.coordinates.length - 1;

            function animate() {
                mobil.setLatLng([route.coordinates[index].lat, route.coordinates[index].lng]);
                index++;
                if (index > maxIndex) {
                    index = 0;
                }
                setTimeout(animate, 50);
            }
            animate();
        }
    } else {
        alert('Geolocation tidak support pada browser yang anda gunakan!')
    }


</script>