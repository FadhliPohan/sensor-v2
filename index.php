<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="assets_modern/images/logos/favicon.png" />

    <!-- Core Css -->
    <link rel="stylesheet" href="assets_modern/css/styles.css" />

    <title>Aplikasi Sensor</title>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="assets/img/logo_sensor.png" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <div id="main-wrapper">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100">
            <div class="position-relative z-index-5">
                <div class="row">
                    <div class="col-xl-7 col-xxl-8">
                        <a href="../main/index.html" class="text-nowrap logo-img d-block px-4 py-9 w-100">
                            <img src="assets/img/logo_sensor.png" class="dark-logo" alt="Logo-Dark" style="height: 70px;" />
                            <img src="assets/img/logo_sensor.png" class="light-logo" alt="Logo-light" style="height: 70px;" />
                        </a>
                        <div class="d-none d-xl-flex align-items-center justify-content-center" style="height: calc(100vh - 80px);">
                            <img src="assets_modern/images/backgrounds/login-security.svg" alt="" class="img-fluid" width="500">
                        </div>
                    </div>
                    <div class="col-xl-5 col-xxl-4">
                        <div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
                            <div class="col-sm-8 col-md-6 col-xl-9">
                                <h2 class="mb-3 fs-7 fw-bolder">Selamat Datang Di Amoniac</h2>
                                <p class=" mb-9">Silahkan Lakukan Login</p>

                                <?php
                                //kode php ini kita gunakan untuk menampilkan pesan eror
                                if (!empty($_GET['error'])) {
                                    if ($_GET['error'] == 4) {
                                        echo '<font color=red><h5>Username dan Password tidak terdaftar!</h5></font>';
                                    }
                                }
                                ?>

                                <form name="login" action="otentikasi.php" role="form" method="post">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1">
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign In</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dark-transparent sidebartoggler"></div>
    <!-- Import Js Files -->

    <script src="assets_modern/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets_modern/js/app.min.js"></script>
    <script src="assets_modern/js/app.init.js"></script>
    <script src="assets_modern/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets_modern/libs/simplebar/dist/simplebar.min.js"></script>

    <script src="assets_modern/js/sidebarmenu.js"></script>
    <script src="assets_modern/js/theme.js"></script>

</body>

</html>