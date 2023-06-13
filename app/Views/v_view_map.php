<div id="map" style="width: 100%; height:100vh;"></div>

<script>
    const map = L.map('map').setView([-6.579813989890926, 106.77248335359333], 14);

    terrain = L.tileLayer('http://{s}.google.com/vt?lyrs=p&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
    }).addTo(map);
</script>