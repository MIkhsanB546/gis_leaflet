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
		  center: [-6.565195231419341, 106.76370440672855],
		  zoom: 14,
		  layers: [streets]
	  });

    const baseLayers = {
		  'streets': streets,
		  'hybrid': hybrid,
		  'sattelite': sattelite,
	  };

    const layerControl = L.control.layers(baseLayers, null, {collapsed:false}).addTo(map);

    //custom icon
    const marker = L.icon({
        iconUrl:      '<?= base_url('gambar/icon.png') ?>',
        iconSize:     [40, 44], // size of the icon
        iconAnchor:   [20, 44], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -44] // point from which the popup should open relative to the iconAnchor
    });

    //pemetaan lokasi
    <?php foreach ($lokasi as $key => $value) { ?>
        L.marker([<?= $value['latitude'] ?>, <?= $value['longitude'] ?>], {icon: marker})
        .bindPopup('<img src="<?= base_url('foto/' . $value['foto_lokasi']) ?>" width="250px"><br>' +
            '<h4><?= $value['nama_lokasi'] ?></h4>' + 
            'Alamat : <?= $value['alamat_lokasi'] ?>')
        .addTo(map);
    <?php } ?>
</script>