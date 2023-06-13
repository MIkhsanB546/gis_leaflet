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

    // marker

    L.marker([-6.579813989890926, 106.77248335359333])
    .bindPopup("<img src='<?= base_url('gambar/rumahku.png') ?>' width='250px'><br>" +
        "<b>My Home</b><br>" +
        "alamat: Gg.Kelor<br>" + 
        "Kota Bogor"
    )
    .addTo(map);

    L.marker([-6.579292350125355, 106.77626244582666])
    .bindPopup(
        "<b>location</b><br>" +
        "alamat: cilendek<br>" + 
        "Kota Bogor"
    )
    .addTo(map);

    L.marker([-6.578067860108129, 106.77396175881374])
    .bindPopup(
        "<b>location</b><br>" +
        "alamat: cilendek<br>" + 
        "Kota Bogor"
    )
    .addTo(map);
</script>