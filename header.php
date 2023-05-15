<?php
session_start();
?>


<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Masonry Responsive Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/templatemo-style.css">
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    <!--
Masonry Template
    http://www.templatemo.com/preview/templatemo_434_masonry
    -->
</head>

<section>
    <!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
        your browser</a> to improve your experience.</p>
    <![endif]-->

    <div id="loader-wrapper">
        <div id="loader"></div>
    </div>

    <div class="content-bg"></div>
    <div class="bg-overlay"></div>

    <!-- SITE TOP -->
    <div class="site-top">
        <div class="site-header clearfix">
            <div class="container">
                <a href="#" class="site-brand pull-left"><strong>Masonry</strong> Free Template</a>
                <div class="social-icons pull-right">
                    <ul>
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-behance"></a></li>
                        <li><a href="#" class="fa fa-dribbble"></a></li>
                        <li><a href="#" class="fa fa-google-plus"></a></li>

                    </ul>
                </div>
            </div>
        </div> <!-- .site-header -->
        <div class="container">
            <div class="col-md-offset-2 col-md-8 text-center">
                <ul>


                    <?php
                    if (isset($_SESSION["useruid"])) {
                        echo "<li><a href='includes/logout.inc.php'>Log Out</a> </li>";
                        echo "<li><a href='upload.php'>Upload</a></li>";
                    } else {
                        echo "<li><a href='signup.php'>Sign up</a> </li>";
                        echo "<li><a href='login.php'>Log in</a> </li>";
                    }

                    ?>
                </ul>
            </div>
        </div>
    </div> <!-- .site-banner -->
    </div> <!-- .site-top -->

</section>