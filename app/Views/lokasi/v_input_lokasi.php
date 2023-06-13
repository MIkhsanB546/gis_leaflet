<div class="row">
    <div class="col-sm-8">
        <div id="map" style="width: 100%; height:80vh;"></div>
    </div>
    
    <div class="col-sm-4">
        <div class="row">
            <?php
            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-success">';
                echo session()->getFlashdata('pesan');
                echo '</div>';
            }
            ?>
            <?php $errors = validation_errors() ?>
            <?php echo form_open_multipart('Lokasi/insertData') ?>
            <div class="form-group">
                <label>Nama Lokasi</label>
                <input class="form-control" name="nama_lokasi">
                <p class="text-danger"><?= isset($errors['nama_lokasi']) == isset($errors['nama_lokasi']) ? validation_show_error('nama_lokasi') : '' ?></p>
            </div>
            <div class="form-group">
                <label>Alamat Lokasi</label>
                <input class="form-control" name="alamat_lokasi">
                <p class="text-danger"><?= isset($errors['alamat_lokasi']) == isset($errors['alamat_lokasi']) ? validation_show_error('alamat_lokasi') : '' ?></p>
            </div>
            <div class="form-group">
                <label>Latitude</label>
                <input class="form-control" name="latitude" id="Latitude">
                <p class="text-danger"><?= isset($errors['latitude']) == isset($errors['latitude']) ? validation_show_error('latitude') : '' ?></p>
            </div>
            <div class="form-group">
                <label>Longitude</label>
                <input class="form-control" name="longitude" id="Longitude">
                <p class="text-danger"><?= isset($errors['longitude']) == isset($errors['longitude']) ? validation_show_error('longitude') : '' ?></p>
            </div>
            <div class="form-group">
                <label>Foto Lokasi</label>
                <input type="file" class="form-control" name="foto_lokasi" accept="image/*">
                <p class="text-danger"><?= isset($errors['foto_lokasi']) == isset($errors['foto_lokasi']) ? validation_show_error('foto_lokasi') : '' ?></p>
            </div>

            <br>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-success">Reset</button>

            <?php echo form_close() ?>
        </div>
    </div>
</div>


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

    // get coordinat
    var latInput = document.querySelector("[name=latitude]");
    var lngInput = document.querySelector("[name=longitude]");

    var curLocation = [-6.565195231419341, 106.76370440672855];
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
    });

    map.addLayer(marker);
</script>