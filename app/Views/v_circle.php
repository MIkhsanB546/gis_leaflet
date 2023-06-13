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

    // circle
    L.marker([-6.579813989890926, 106.77248335359333]).addTo(map);
    L.circle([-6.579813989890926, 106.77248335359333], {
        color: 'green',
        fillColor: 'green',
        fillOpacity: 0.5,
        radius: 100
    }).bindPopup("<img src='<?= base_url('gambar/rumahku.png') ?>' width='250px'><br>" +
        "<b>My Home</b><br>" +
        "alamat: Gg.Kelor<br>" + 
        "Kota Bogor"
    )
    .addTo(map);

    L.circle([-6.579849725407717, 106.77888833274689], {
        color: 'blue',
        fillColor: 'blue',
        fillOpacity: 0.5,
        radius: 150
    }).addTo(map);

    L.circle([-6.576402219114005, 106.77237295671402], {
        color: 'red',
        fillColor: 'red',
        fillOpacity: 0.5,
        radius: 200
    }).addTo(map);

</script>