
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>GIS | <?= $judul ?></title>
        <link rel="icon" href="<?= base_url('gambar/') ?>gis_icon.ico" type="image/ico">

        <link href="<?= base_url('sb_admin/') ?>css/styles.css" rel="stylesheet" />
        
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <!-- bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url('sb_admin/') ?>js/scripts.js"></script>
        <!-- leaflet -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
        <!-- rute -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
        <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

        <!-- data table -->
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url('sb_admin/') ?>js/datatables-simple-demo.js"></script>

        <style>
            #map {
                cursor: default;
            }

            /* fun :) */
            /* body {
                animation: roll 500ms;
            }
            @keyframes roll {
                100% {
                    transform: rotateZ(360deg);
                }
            } */
        </style>
    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="<?= base_url('lokasi/pemetaanLokasi') ?>">GIS Lokasi Ratnalisa</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <?php if (session()->get('logged_in') === TRUE) : ?>
                            <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a></li>
                        <?php else : ?>
                            <li><a class="dropdown-item" href="<?= base_url('login') ?>">Login</a></li>
                        <?php endif ?>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <!-- <div class="sb-sidenav-menu-heading">Core</div> -->

                            <a class="nav-link mt-4" href="<?= base_url('Home') ?>">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div>
                                Tentang Kami
                            </a>

                            <a class="nav-link mt-4" href="<?= base_url('lokasi/pemetaanLokasi') ?>">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-map-location-dot"></i></div>
                                Lokasi
                            </a>
                            
                            <?php if (session()->get('role') === 'admin') : ?>
                            <a class="nav-link" href="<?= base_url('lokasi/inputLokasi') ?>">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-file-arrow-down"></i></div>
                                Input Lokasi
                            </a>
                            <?php endif ?>
                            
                            <a class="nav-link" href="<?= base_url('lokasi/index') ?>">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-table-list"></i></div>
                                Data Lokasi
                            </a>
                            
                            
                            

                            <!-- <div class="sb-sidenav-menu-heading">Tanpa database</div>

                            <a class="nav-link" href="<?= base_url('Home/viewMap') ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-map"></i></div>
                                View Map
                            </a>

                            <a class="nav-link" href="<?= base_url('Home/baseMap') ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-layer-group"></i></div>
                                Base Map
                            </a>

                            <a class="nav-link" href="<?= base_url('Home/marker') ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-map-marker-alt"></i></div>
                                Marker
                            </a>
                            
                            <a class="nav-link" href="<?= base_url('Home/circle') ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-circle"></i></div>
                                Circle
                            </a>
                            
                            <a class="nav-link" href="<?= base_url('Home/polyline') ?>">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-arrow-trend-up"></i></div>
                                Polyline
                            </a>
                            
                            <a class="nav-link" href="<?= base_url('Home/polygon') ?>">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-draw-polygon"></i></div>
                                Polygon
                            </a>
                            
                            <a class="nav-link" href="<?= base_url('Home/geojson') ?>">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-earth-asia"></i></div>
                                GeoJSON
                            </a>                            
                            
                            <a class="nav-link" href="<?= base_url('Home/getCoordinat') ?>">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-compass"></i></div>
                                Get Coordinat
                            </a>
                            
                            <a class="nav-link" href="<?= base_url('Home/geolocation') ?>">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-location-crosshairs"></i></div>
                                Geolocation
                            </a>
                            
                            <a class="nav-link" href="<?= base_url('Home/rute') ?>">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-route"></i></div>
                                Rute
                            </a>
                            
                            <a class="nav-link" href="<?= base_url('Home/rute2') ?>">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-route"></i></div>
                                Rute2
                            </a> -->
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php if (session()->get('logged_in') === TRUE) : ?>
                        <?php echo session()->get('name') ?>
                        <?php else : ?>
                        Guest
                        <?php endif ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h4 class="mt-4"> <?= $judul ?></h4>
                        <hr>
                        <?php if ($page) {
                            echo view($page);
                        } ?>

                    </div>
                </main>
                <!-- <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer> -->
            </div>
        </div>
        
    </body>
</html>
