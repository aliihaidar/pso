<?php
include_once "administration/conf/config.server.php";
include_once CLASS_PATH .'pso_portfolio_cat.class.php';
include_once CLASS_PATH .'pso_portfolio.class.php';


/* Portfolio Cat*/

$objPorCat    = new pso_portfolio_cat();

$whereClausePorCat = 'WHERE pocat_published=1 ORDER BY pocat_order ASC';

$objPorCat->Select(array('pocat_title','pocat_id', 'pocat_order', 'pocat_published'), '' ,$whereClausePorCat, '', false);

$printPorCat ='';
$printPortfolio ='';

while (!$objPorCat->EOF()) {
    $rowPorCat    = $objPorCat->Row();
	
	$printPorCat .='<button class="btn btn-portfolio-filter btn-white btn-active-primary" data-filter=".cat-'.$rowPorCat->pocat_id.'">'.$rowPorCat->pocat_title.'</button>';
	
	
/* // Portfolio Cat */

/* Portfolio*/

$objPortfolio    = new pso_portfolio();

$whereClausePortfolio = 'WHERE po_published=1 AND po_pocat_id='.$rowPorCat->pocat_id;

$objPortfolio->Select(array('po_pocat_id','po_id', 'po_title','po_link','po_desc' ,'po_img','po_published'), '' ,$whereClausePortfolio, '', false);


while (!$objPortfolio->EOF()) {
    $rowPortfolio    = $objPortfolio->Row();
	
	$PortfolioDesc = strip_tags($rowPortfolio->po_desc);
		if(strlen($rowPortfolio->po_desc)>100){
			$PortfolioDesc = substr($PortfolioDesc,0,100);
			$PortfolioDesc = explode(' ', $PortfolioDesc);
			array_pop($PortfolioDesc);
			$PortfolioDesc = implode(' ', $PortfolioDesc);
			$PortfolioDesc .= "...";
		}
	
	$printPortfolio .='<div class="portfolio-grid-item extended cat-'.$rowPorCat->pocat_id.'">
						<div class="portfolio-info">
							<div class="links">
								<a href="'.PROJECT_UPLOAD_BIG_URL.$rowPortfolio->po_img.'" class="preview"><i class="fa fa-search"></i></a>
								<a href="#" class="open"><i class="fa fa-external-link"></i></a>
							</div>
						</div>
						<div class="hover-layer all-transitions"></div>
						<img src="'.PROJECT_UPLOAD_MED_URL.$rowPortfolio->po_img.'" alt="">
						<div class="bottom-info">
							<h6 class="portfolio-title">'.$rowPortfolio->po_title.'</h6>
							<div class="meta">
								<div class="category">'.$PortfolioDesc.'</div>
							</div>
						</div>
					</div>';
		}
}                     

/* // Portfolio */
		
?>


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
                        <?php echo $printPorCat;?>        
                            </div><!-- .portfolio-button-group end -->
                            <!-- .portfolio-grid start -->
                            <div class="portfolio-grid">
                                <?php echo $printPortfolio;?>
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