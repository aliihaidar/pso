<!DOCTYPE html>
<html>
<?php $page='contact'; ?>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>PSO - Contact Us</title>
        <meta name="description" content="SpeedUp Responsive Bootstrap Template">
        <meta name="author" content="borisolhor">
        <meta name="keywords" content="HTML, CSS, HTML5, template, corporate, jQuery, portfolio, theme, business">
        <meta name="viewport" content="initial-scale=1, width=device-width">

        <!-- stylesheets -->
        <link rel="stylesheet" href="css/bootstrap.css" />
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/responsive.css" />
        <link rel="stylesheet" href="css/retina.css" />

        <!-- Revolution Slider -->
        <link rel="stylesheet" type="text/css" href="css/rs-styles.css" media="screen" /> 
        <link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen" />

        <!-- Maginic Popup - image lightbox -->
        <link rel="stylesheet" href="css/magnific-popup.css" />

        <!-- Owl carousel -->
        <link rel="stylesheet" href="css/owl.carousel.css"/>
        <link rel="stylesheet" href="css/owl.theme.css"/>

        <!-- Yamm Mega Menu -->
        <link rel="stylesheet" href="css/yamm.css"/>

        <!-- Scrolling Pack CSS -->
        <link rel="stylesheet" href="css/scrolling_pack.css"/>

        <!-- google web fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,900italic,900,700italic,700,500italic,500,400italic,300italic,300,100italic,100&amp;subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,800,900,200,100' rel='stylesheet' type='text/css'>
        
        <!-- Icons -->
        <link rel="stylesheet" href="css/font-awesome.min.css"/>
        
    </head>

    <body>  
        <!-- #header-wrapper start -->
        <?php include 'header.php'; ?>
        <!-- #header-wrapper end -->

        <!-- #page-title start -->
        <section id="page-title" data-type="background" data-speed="7">
            <!-- #page-title-wrapper start -->
            <div id="page-title-wrapper">
                <!-- .container start -->
                <div class="container">
                    <!-- .row start -->
                    <div class="row">
                        <div class="col-xs-6">
                            <h2>Contact Us</h2>
                        </div>
                        <div class="col-xs-6">
                            <ul class="breadcrumb">
                                <li class="active"><a href="index.php">Home</a></li>
                                <li><a href="contact.html">Contact Us</a></li>
                            </ul>
                        </div>
                    </div><!-- .row end -->
                </div><!-- .container end -->
            </div><!-- #page-title-wrapper end -->
        </section><!-- #page-title end -->

        <!-- #map-wrapper start -->
        <section id="map-wrapper">
            <div id="map" data-latitude="33.8947302" data-longitude="35.5629128" data-zoom="15"></div>
        </section><!-- #map-wrapper end -->

        <section class="default-margin">
            <!-- .services-default start -->
            <div class="services-default">
                <!-- .container start -->
                <div class="container">
                    <!-- .row start -->
                    <div class="row">
                        <!-- .item start -->
                        <div class="col-md-4 item d-animate d-opacity d-delay02">
                            <i class="fa fa-map-marker all-transitions"></i>
                            <h6>Address</h6>
                            <div class="small-divider"></div>
                            <p>Jdeideh Highway<br>Yara Center, 6th Floor</p>
                        </div><!-- .item end -->
                        <!-- .item start -->
                        <div class="col-md-4 item d-animate d-opacity d-delay04">
                            <i class="fa fa-phone all-transitions"></i>
                            <h6>Phone</h6>
                            <div class="small-divider"></div>
                            <p>+961 1 902 471</p>
                        </div><!-- .item end -->
                        <!-- .item start -->
                        <div class="col-md-4 item d-animate d-opacity d-delay06">
                            <i class="fa fa-envelope all-transitions"></i>
                            <h6>Email Address</h6>
                            <div class="small-divider"></div>
                            <p>info@publiscreenonline.com</p>
                        </div><!-- .item end -->
                    </div><!-- .row end -->
                </div><!-- .container end -->
            </div><!-- .services-default end -->
        </section>

        <section class="default-margin">
            <!-- .container start -->
            <div class="container">
                <!-- .row start -->
                <div class="row"></div>
                <!-- .row start -->
                <div class="row section-info d-animate d-opacity d-delay02">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="section-title normal-case"><i>If you have any questions, please do not hesitate to</i> <em>Send us a Message</em></h2>
                        <div class="big-divider"></div>
                    </div>
                </div><!-- .row end -->
                <div class="row d-animate d-opacity d-delay02">
                    <!-- #contact-us start -->
                    <form id="contact-us">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 col-md-offset-2">
                                    <input type="text" name="name" class="form-control" placeholder="Name">
                                    <input type="text" name="email" class="form-control" placeholder="Email">
                                    <input type="text" name="subject" class="form-control" placeholder="Subject">
                                </div>
                                <div class="col-md-5">
                                    <textarea name="text"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2 text-center">
                                    <input type="submit" class="btn btn-default blue" value="Send Message">
                                </div>
                            </div>
                        </div>
                    </form><!-- #contact-us end -->
                </div><!-- .row end -->
            </div><!-- .container end -->
        </section>

        <!-- #footer-wrapper start -->
        <?php include 'footer.php'; ?>
        <!-- #footer-wrapper end -->

        <script src="js/jquery-1.11.0.min.js"></script><!-- jQuery Library -->
        <script src="js/jquery.bootstrap.min.js"></script><!-- bootstrap -->
        <script type="text/javascript" src="rs-plugin/js/jquery.themepunch.tools.min.js"></script>   
        <script type="text/javascript" src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
        <script src="js/isotope.pkgd.min.js"></script> <!-- jQuery isotope -->
        <script src="js/jquery.magnific-popup.min.js"></script><!-- used for image lightbox -->
        <script src="js/owl.carousel.min.js"></script><!-- OwlCarousel -->
        <script src="js/circles.min.js"></script><!-- Circles JS for Round Skills -->
        <script src="https://maps.googleapis.com/maps/api/js?&amp;callback=initMap&amp;signed_in=true" async defer></script>
        <script src="js/scrolling_pack.js"></script><!-- Scrolling Pack JS -->
        <script src="js/script.js"></script><!-- Last file with all custom scripts -->
    </body>

    <style>

    .blue
    {
        background: #00ADEE !important;
    }

    .blue:hover
    {
        background: white !important;
        border:1px solid #00ADEE;
        color:#00ADEE;
    }

    </style>

</html>