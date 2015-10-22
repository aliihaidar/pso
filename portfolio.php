<!DOCTYPE html>
<html>
<?php $page='portfolio'; ?>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>PSO - Portfolio</title>
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
                            <h2>Our Latest Portfolio</h2>
                        </div>
                        <div class="col-xs-6">
                            <ul class="breadcrumb">
                                <li class="active"><a href="index.php">Home</a></li>
                                <li>Portfolio</li>
                            </ul>
                        </div>
                    </div><!-- .row end -->
                </div><!-- .container end -->
            </div><!-- #page-title-wrapper end -->
        </section><!-- #page-title end -->

        <section class="default-margin">
            <!-- .portfolio-3-col start -->
            <div class="portfolio portfolio-3-col">
                <!-- .container start -->
                <div class="container">
                    <!-- .row start -->
                    <div class="row d-animate d-callback d-delay04" data-callback="show_portfolio">
                        <div class="col-md-12">
                            <!-- .portfolio-button-group start -->
                            <div class="portfolio-button-group filter-button-group">
                                <button class="btn btn-portfolio-filter btn-white btn-active-primary active" data-filter="*">All</button>
                                <button class="btn btn-portfolio-filter btn-white btn-active-primary" data-filter=".web-design">Web Design</button>
                                <button class="btn btn-portfolio-filter btn-white btn-active-primary" data-filter=".ui-design">UI Design</button>
                                <button class="btn btn-portfolio-filter btn-white btn-active-primary" data-filter=".creative">Creative</button>
                                <button class="btn btn-portfolio-filter btn-white btn-active-primary" data-filter=".graphics">Graphics</button>
                                <button class="btn btn-portfolio-filter btn-white btn-active-primary" data-filter=".mockup">Mockup</button>
                            </div><!-- .portfolio-button-group end -->
                            <!-- .portfolio-grid start -->
                            <div class="portfolio-grid">
                                <!-- .portfolio-grid-item start -->
                                <div class="portfolio-grid-item extended creative">
                                    <div class="portfolio-info">
                                        <div class="links">
                                            <a href="img/portfolio-1.png" class="preview"><i class="fa fa-search"></i></a>
                                            <a href="#" class="open"><i class="fa fa-external-link"></i></a>
                                        </div>
                                    </div>
                                    <div class="hover-layer all-transitions"></div>
                                    <img src="img/portfolio-1.png" alt="">
                                    <div class="bottom-info">
                                        <h6 class="portfolio-title">Project Title</h6>
                                        <div class="meta">
                                            <div class="category">Creative</div>
                                            <div class="likes"><i class="fa fa-heart-o"></i> 1548</div>
                                        </div>
                                    </div>
                                </div><!-- .portfolio-grid-item end -->
                                <!-- .portfolio-grid-item start -->
                                <div class="portfolio-grid-item extended mockup web-design">
                                    <div class="portfolio-info all-transitions">
                                        <div class="links">
                                            <a href="img/portfolio-2.png" class="preview"><i class="fa fa-search"></i></a>
                                            <a href="#" class="open"><i class="fa fa-external-link"></i></a>
                                        </div>
                                    </div>
                                    <div class="hover-layer all-transitions"></div>
                                    <img src="img/portfolio-2.png" alt="">
                                    <div class="bottom-info">
                                        <h6 class="portfolio-title">Project Title</h6>
                                        <div class="meta">
                                            <div class="category">Mockup, Web Design</div>
                                            <div class="likes"><i class="fa fa-heart-o"></i> 1548</div>
                                        </div>
                                    </div>
                                </div><!-- .portfolio-grid-item end -->
                                <!-- .portfolio-grid-item start -->
                                <div class="portfolio-grid-item extended graphics">
                                    <div class="portfolio-info">
                                        <div class="links">
                                            <a href="img/portfolio-3.png" class="preview"><i class="fa fa-search"></i></a>
                                            <a href="#" class="open"><i class="fa fa-external-link"></i></a>
                                        </div>
                                    </div>
                                    <div class="hover-layer all-transitions"></div>
                                    <img src="img/portfolio-3.png" alt="">
                                    <div class="bottom-info">
                                        <h6 class="portfolio-title">Project Title</h6>
                                        <div class="meta">
                                            <div class="category">Graphics</div>
                                            <div class="likes"><i class="fa fa-heart-o"></i> 1548</div>
                                        </div>
                                    </div>
                                </div><!-- .portfolio-grid-item end -->
                                <!-- .portfolio-grid-item start -->
                                <div class="portfolio-grid-item extended graphics">
                                    <div class="portfolio-info">
                                        <div class="links">
                                            <a href="img/portfolio-4.png" class="preview"><i class="fa fa-search"></i></a>
                                            <a href="#" class="open"><i class="fa fa-external-link"></i></a>
                                        </div>
                                    </div>
                                    <div class="hover-layer all-transitions"></div>
                                    <img src="img/portfolio-4.png" alt="">
                                    <div class="bottom-info">
                                        <h6 class="portfolio-title">Project Title</h6>
                                        <div class="meta">
                                            <div class="category">Graphics</div>
                                            <div class="likes"><i class="fa fa-heart-o"></i> 1548</div>
                                        </div>
                                    </div>
                                </div><!-- .portfolio-grid-item end -->
                                <!-- .portfolio-grid-item start -->
                                <div class="portfolio-grid-item extended mockup">
                                    <div class="portfolio-info">
                                        <div class="links">
                                            <a href="img/portfolio-5.png" class="preview"><i class="fa fa-search"></i></a>
                                            <a href="#" class="open"><i class="fa fa-external-link"></i></a>
                                        </div>
                                    </div>
                                    <div class="hover-layer all-transitions"></div>
                                    <img src="img/portfolio-5.png" alt="">
                                    <div class="bottom-info">
                                        <h6 class="portfolio-title">Project Title</h6>
                                        <div class="meta">
                                            <div class="category">Mockup</div>
                                            <div class="likes"><i class="fa fa-heart-o"></i> 1548</div>
                                        </div>
                                    </div>
                                </div><!-- .portfolio-grid-item end -->
                                <!-- .portfolio-grid-item start -->
                                <div class="portfolio-grid-item extended ui-design">
                                    <div class="portfolio-info">
                                        <div class="links">
                                            <a href="img/portfolio-6.png" class="preview"><i class="fa fa-search"></i></a>
                                            <a href="#" class="open"><i class="fa fa-external-link"></i></a>
                                        </div>
                                    </div>
                                    <div class="hover-layer all-transitions"></div>
                                    <img src="img/portfolio-6.png" alt="">
                                    <div class="bottom-info">
                                        <h6 class="portfolio-title">Project Title</h6>
                                        <div class="meta">
                                            <div class="category">UI Design</div>
                                            <div class="likes"><i class="fa fa-heart-o"></i> 1548</div>
                                        </div>
                                    </div>
                                </div><!-- .portfolio-grid-item end -->
                                <!-- .portfolio-grid-item start -->
                                <div class="portfolio-grid-item extended mockup web-design">
                                    <div class="portfolio-info">
                                        <div class="links">
                                            <a href="img/portfolio-7.png" class="preview"><i class="fa fa-search"></i></a>
                                            <a href="#" class="open"><i class="fa fa-external-link"></i></a>
                                        </div>
                                    </div>
                                    <div class="hover-layer all-transitions"></div>
                                    <img src="img/portfolio-7.png" alt="">
                                    <div class="bottom-info">
                                        <h6 class="portfolio-title">Project Title</h6>
                                        <div class="meta">
                                            <div class="category">Mockup, Web Design</div>
                                            <div class="likes"><i class="fa fa-heart-o"></i> 1548</div>
                                        </div>
                                    </div>
                                </div><!-- .portfolio-grid-item end -->
                                <!-- .portfolio-grid-item start -->
                                <div class="portfolio-grid-item extended mockup web-design">
                                    <div class="portfolio-info">
                                        <div class="links">
                                            <a href="img/portfolio-8.png" class="preview"><i class="fa fa-search"></i></a>
                                            <a href="#" class="open"><i class="fa fa-external-link"></i></a>
                                        </div>
                                    </div>
                                    <div class="hover-layer all-transitions"></div>
                                    <img src="img/portfolio-8.png" alt="">
                                    <div class="bottom-info">
                                        <h6 class="portfolio-title">Project Title</h6>
                                        <div class="meta">
                                            <div class="category">Mockup, Web Design</div>
                                            <div class="likes"><i class="fa fa-heart-o"></i> 1548</div>
                                        </div>
                                    </div>
                                </div><!-- .portfolio-grid-item end -->
                                <!-- .portfolio-grid-item start -->
                                <div class="portfolio-grid-item extended mockup web-design">
                                    <div class="portfolio-info">
                                        <div class="links">
                                            <a href="img/portfolio-9.png" class="preview"><i class="fa fa-search"></i></a>
                                            <a href="#" class="open"><i class="fa fa-external-link"></i></a>
                                        </div>
                                    </div>
                                    <div class="hover-layer all-transitions"></div>
                                    <img src="img/portfolio-9.png" alt="">
                                    <div class="bottom-info">
                                        <h6 class="portfolio-title">Project Title</h6>
                                        <div class="meta">
                                            <div class="category">Mockup, Web Design</div>
                                            <div class="likes"><i class="fa fa-heart-o"></i> 1548</div>
                                        </div>
                                    </div>
                                </div><!-- .portfolio-grid-item end -->
                                <!-- .portfolio-grid-item start -->
                                <div class="portfolio-grid-item extended mockup web-design">
                                    <div class="portfolio-info">
                                        <div class="links">
                                            <a href="img/portfolio-10.png" class="preview"><i class="fa fa-search"></i></a>
                                            <a href="#" class="open"><i class="fa fa-external-link"></i></a>
                                        </div>
                                    </div>
                                    <div class="hover-layer all-transitions"></div>
                                    <img src="img/portfolio-10.png" alt="">
                                    <div class="bottom-info">
                                        <h6 class="portfolio-title">Project Title</h6>
                                        <div class="meta">
                                            <div class="category">Mockup, Web Design</div>
                                            <div class="likes"><i class="fa fa-heart-o"></i> 1548</div>
                                        </div>
                                    </div>
                                </div><!-- .portfolio-grid-item end -->
                                <!-- .portfolio-grid-item start -->
                                <div class="portfolio-grid-item extended mockup web-design">
                                    <div class="portfolio-info">
                                        <div class="links">
                                            <a href="img/portfolio-11.png" class="preview"><i class="fa fa-search"></i></a>
                                            <a href="#" class="open"><i class="fa fa-external-link"></i></a>
                                        </div>
                                    </div>
                                    <div class="hover-layer all-transitions"></div>
                                    <img src="img/portfolio-11.png" alt="">
                                    <div class="bottom-info">
                                        <h6 class="portfolio-title">Project Title</h6>
                                        <div class="meta">
                                            <div class="category">Mockup, Web Design</div>
                                            <div class="likes"><i class="fa fa-heart-o"></i> 1548</div>
                                        </div>
                                    </div>
                                </div><!-- .portfolio-grid-item end -->
                                <!-- .portfolio-grid-item start -->
                                <div class="portfolio-grid-item extended mockup web-design">
                                    <div class="portfolio-info">
                                        <div class="links">
                                            <a href="img/portfolio-12.png" class="preview"><i class="fa fa-search"></i></a>
                                            <a href="#" class="open"><i class="fa fa-external-link"></i></a>
                                        </div>
                                    </div>
                                    <div class="hover-layer all-transitions"></div>
                                    <img src="img/portfolio-12.png" alt="">
                                    <div class="bottom-info">
                                        <h6 class="portfolio-title">Project Title</h6>
                                        <div class="meta">
                                            <div class="category">Mockup, Web Design</div>
                                            <div class="likes"><i class="fa fa-heart-o"></i> 1548</div>
                                        </div>
                                    </div>
                                </div><!-- .portfolio-grid-item end -->
                            </div><!-- .portfolio-grid end -->
                        </div>
                    </div><!-- .row end -->
                </div><!-- .container end -->
            </div><!-- .portfolio-3-col end -->
        </section>

        <section>
            <!-- .call-to-action start -->
            <div class="call-to-action">
                <!-- .container start -->
                <div class="container">
                    <!-- .row start -->
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Ready to Get Started?</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In elit turpis, rhoncus vitae neque vel, ultricies cursus velit.</p>
                        </div>
                        <div class="col-md-3 col-md-push-3">
                            <a href="#" class="contact-us">
                                <img src="img/cta-contact.png" alt="Contact Us">
                                <h6>Contact Us</h6>
                            </a>
                        </div>
                        <div class="col-md-3 col-md-pull-3">
                            <div class="cta-image">
                                <img src="img/cta-girl.png" alt="">
                            </div>
                        </div>
                    </div><!-- .row end -->
                </div><!-- .container end -->
            </div><!-- .call-to-action end -->
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

</html>