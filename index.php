<?php
 // buat koneksi ke mysql dari file config.php
include("config/config.php");

//jika ada sesi yics_user maka
if (isset ($_SESSION['yics_user'])){
  header("location: page/dashboard.php");
  }

  // cek apakah form telah di submit
if (isset($_POST['submit'])) {
  $username = trim(mysqli_real_escape_string($link_yics, $_POST['username']));
  $password = sha1(trim(mysqli_real_escape_string($link_yics, $_POST['password'])));
  $query_login = mysqli_query($link_yics, "SELECT * FROM yics_db.data_user WHERE username = '$username' AND pass = '$password' ") or die (mysqli_error($link_yics));
  if ($query_login->num_rows > 0) {
      $result_login = mysqli_fetch_assoc($query_login);
      $_SESSION['yics_user'] =  $username;
      $_SESSION['yics_level'] =  $result_login['level'];
      $_SESSION['yics_nama'] =  $result_login['nama'];
      mysqli_free_result($query_login);      
      header("location: page/dashboard.php");
  } else {
      $pesan = "galat";  
  }
}
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">

    <title>YICS</title>

    <link rel="apple-touch-icon" href="base/assets/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="base/assets/images/favicon.ico">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="global/css/bootstrap.min.css">
    <link rel="stylesheet" href="global/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="base/assets/css/site.min.css">

    <!-- Plugins -->
    <link rel="stylesheet" href="global/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="global/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="global/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="global/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="global/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="global/vendor/flag-icon-css/flag-icon.css">
    <link rel="stylesheet" href="global/vendor/waves/waves.css">
    <link rel="stylesheet" href="base/assets/examples/css/pages/login.css">


    <!-- Fonts -->
    <link rel="stylesheet" href="global/fonts/material-design/material-design.min.css">
    <link rel="stylesheet" href="global/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    <link rel="stylesheet" href="global/fonts/web-icons/web-icons.min.css">

    <!--[if lt IE 9]>
    <script src="global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="global/vendor/media-match/media.match.min.js"></script>
    <script src="global/vendor/respond/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="global/vendor/breakpoints/breakpoints.js"></script>
    <script>
    Breakpoints();
    </script>
</head>

<body class="animsition page-login layout-full page-dark">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Page -->
    <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <div class="page-content vertical-align-middle">
            <div class="brand">
                <h1 class="brand-text">Yearly Investment Control System (YICS)</h1>
            </div>
            <p>Silahkan masuk ke akun Anda</p>

            <?php
                  if(isset($pesan)){?>
            <!--jika password dan user salah keluarkan alert gagal-->
            <div class="alert alert-danger alert-dismissible fade show">
                <label for="aa" style="cursor: pointer;"><b> Login gagal - </b>"username atau password salah!"</label>
                <button id="aa" name="aa" type="button" aria-hidden="true" class="close" data-dismiss="alert"
                    aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?php  
                  }
              ?>

            <form method="post" action="#" class="ml-25">
                <div class="form-group form-material floating" data-plugin="formMaterial">
                    <input type="text" class="form-control empty" id="username" name="username" autocomplete="off"
                        required>
                    <label class="floating-label font" for="username">NPK</label>
                </div>
                <div class="form-group form-material floating" data-plugin="formMaterial">
                    <input type="password" class="form-control empty" id="password" name="password" autocomplete="off"
                        required>
                    <label class="floating-label font" for="password">Password</label>
                </div>

                <button type="submit" class="btn btn-primary btn-block" name="submit">Sign in</button>
            </form>


            <footer class="page-copyright page-copyright-inverse">
                <p>Crafted with <i class="red-600 wb wb-heart"></i> By Team Digitalization In Body Division-PT ADM</p>
                <p>© 2022.All Right Reserved</p>
            </footer>
        </div>
    </div>
    <!-- End Page -->


    <!-- Core  -->
    <script src="global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
    <script src="global/vendor/jquery/jquery.js"></script>
    <script src="global/vendor/popper-js/umd/popper.min.js"></script>
    <script src="global/vendor/bootstrap/bootstrap.js"></script>
    <script src="global/vendor/animsition/animsition.js"></script>
    <script src="global/vendor/mousewheel/jquery.mousewheel.js"></script>
    <script src="global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
    <script src="global/vendor/asscrollable/jquery-asScrollable.js"></script>
    <script src="global/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
    <script src="global/vendor/waves/waves.js"></script>

    <!-- Plugins -->
    <script src="global/vendor/switchery/switchery.js"></script>
    <script src="global/vendor/intro-js/intro.js"></script>
    <script src="global/vendor/screenfull/screenfull.js"></script>
    <script src="global/vendor/slidepanel/jquery-slidePanel.js"></script>
    <script src="global/vendor/jquery-placeholder/jquery.placeholder.js"></script>

    <!-- Scripts -->
    <script src="global/js/Component.js"></script>
    <script src="global/js/Plugin.js"></script>
    <script src="global/js/Base.js"></script>
    <script src="global/js/Config.js"></script>

    <script src="base/assets/js/Section/Menubar.js"></script>
    <script src="base/assets/js/Section/GridMenu.js"></script>
    <script src="base/assets/js/Section/Sidebar.js"></script>
    <script src="base/assets/js/Section/PageAside.js"></script>
    <script src="base/assets/js/Plugin/menu.js"></script>

    <script src="global/js/config/colors.js"></script>
    <script src="base/assets/js/config/tour.js"></script>
    <script>
    Config.set('assets', 'base/assets');
    </script>

    <!-- Page -->
    <script src="base/assets/js/Site.js"></script>
    <script src="global/js/Plugin/asscrollable.js"></script>
    <script src="global/js/Plugin/slidepanel.js"></script>
    <script src="global/js/Plugin/switchery.js"></script>
    <script src="global/js/Plugin/jquery-placeholder.js"></script>
    <script src="global/js/Plugin/material.js"></script>

    <script>
    (function(document, window, $) {
        'use strict';

        var Site = window.Site;
        $(document).ready(function() {
            Site.run();
        });
    })(document, window, jQuery);
    </script>

</body>

</html>