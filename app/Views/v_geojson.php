<div id="map" style="width: 100%; height:100vh;"></div>

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
		center: [-0.9961475259106021, 118.3282531436],
		zoom: 5,
		layers: [streets]
	});

    const baseLayers = {
		'streets': streets,
		'hybrid': hybrid,
		'sattelite': sattelite,
	};

    const layerControl = L.control.layers(baseLayers, null, {collapsed:false}).addTo(map);

    // geojson
    $.getJSON("<?= base_url('provinsi/31.geojson') ?>", function(data) {
        L.geoJson(data, {
            style: function(feature) {
                return {
                    color: 'red',
                    // fillOpacity: 1.0,
                }
            }
        })
        .bindPopup (
        "<b>provinsi</b>"
    )
        .addTo(map);
    });
    $.getJSON("<?= base_url('provinsi/32.geojson') ?>", function(data) {
        L.geoJson(data, {
            style: function(feature) {
                return {
                    color: 'green',
                    // fillOpacity: 1.0,
                }
            }
        })
        .bindPopup (
        "<b>provinsi</b>"
    )
        .addTo(map);
    });
    $.getJSON("<?= base_url('provinsi/33.geojson') ?>", function(data) {
        L.geoJson(data, {
            style: function(feature) {
                return {
                    color: 'blue',
                    // fillOpacity: 1.0,
                }
            }
        })
        .bindPopup (
        "<b>provinsi</b>"
    )
        .addTo(map);
    });
    $.getJSON("<?= base_url('provinsi/34.geojson') ?>", function(data) {
        L.geoJson(data, {
            style: function(feature) {
                return {
                    color: 'yellow',
                    // fillOpacity: 1.0,
                }
            }
        })
        .bindPopup (
        "<b>provinsi</b>"
    )
        .addTo(map);
    });
</script>