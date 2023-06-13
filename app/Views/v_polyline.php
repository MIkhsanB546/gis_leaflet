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
		center: [-6.579813989890926, 106.77248335359333],
		zoom: 14,
		layers: [streets]
	});

    const baseLayers = {
		'streets': streets,
		'hybrid': hybrid,
		'sattelite': sattelite,
	};

    const layerControl = L.control.layers(baseLayers, null, {collapsed:false}).addTo(map);

    // polyline
    L.polyline ([
        [-6.581745421188467, 106.77811017935737],
        [-6.578709856963534, 106.77409552525502],
        [-6.579079388659057, 106.77377369883729],
        [-6.578942371319964, 106.77353546369586],
        [-6.579876579700558, 106.77257416400245],
    ], {
        color: 'blue',
        weight: '5  ',
    })
    .bindPopup (
        "<b>info</b>"
    )
    .addTo(map);
</script>