<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label>Posisi</label>
            <input class="form-control" name="posisi" id="Posisi">
        </div>
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
    
    const baseLayers = {
            'streets': streets,
            'hybrid': hybrid,
            'sattelite': sattelite,
        };


    //geolocation
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert('Geolocation tidak support pada browser yang anda gunakan!')
    }

    function showPosition(position) {
        document.getElementById("Posisi").value =
            position.coords.latitude + ", " + position.coords.longitude;

        //menampilakn posisi pada map
        const map = L.map('map', {
            center: [position.coords.latitude, position.coords.longitude],
            zoom: 14,
            layers: [streets]
        });
        
        const layerControl = L.control.layers(baseLayers, null, {collapsed:false}).addTo(map);

        //marker posisi users
        L.marker([position.coords.latitude, position.coords.longitude]).addTo(map)
        .bindPopup('anda disini!')
        .openPopup()
    }
</script>