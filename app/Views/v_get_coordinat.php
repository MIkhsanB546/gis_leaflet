<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Latitude</label>
            <input class="form-control" name="latitude" id="Latitude">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>Longitude</label>
            <input class="form-control" name="longitude" id="Longitude">
        </div>
    </div>
    
    <div class="col-sm-12">
        <div class="form-group">
            <label>Posisi</label>
            <input class="form-control" name="posisi" id="Posisi">
        </div>
    </div>

    <div class="col-sm-12">
        <br>
        <div id="map" style="width: 100%; height: 100vh;"></div>
    </div>
</div>

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

    // get coordinat
    var latInput = document.querySelector("[name=latitude]");
    var lngInput = document.querySelector("[name=longitude]");
    var posisi = document.querySelector("[name=posisi]");

    var curLocation = [-6.579813989890926, 106.77248335359333];
    map.attributionControl.setPrefix(false);

    var marker = new L.marker(curLocation, {
        draggable : true,
    });

    // mengambil coordinat saat marker di pindah
    marker.on('dragend', function(e) {
        var position = marker.getLatLng();
        marker.setLatLng(position, {
            curLocation,
        }).bindPopup(position).update();
        $("#Latitude").val(position.lat);
        $("#Longitude").val(position.lng);
        $("#Posisi").val(position.lat + ', ' + position.lng);
    });

    // mengambil coordinat saat diclick
    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        if (!marker) {
            marker = L.marker(e.latlng).addTo(map);
        } else {
            marker.setLatLng(e.latlng);
        }
        latInput.value = lat;
        lngInput.value = lng;
        posisi.value = lat + ', ' + lng;
    });

    map.addLayer(marker);
</script>   