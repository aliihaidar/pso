<div id="header-wrapper">
    <!-- #top-bar start -->
    <div id="top-bar">
        <!-- .container start -->
        <div class="container">
            <ul class="contact-info">
                <li><span class="phone">+961 1 902 471</span></li>
                <li><span class="phone-text">Call us for a Free Quote</span></li>
            </ul><!-- .contact-info end -->
            <ul class="top-links">
                <li><i class="fa fa-envelope-o"></i> <a href="#" class="newsletter">Newsletter</a></li>
                <li><i class="fa fa-key"></i> <a href="#" class="login">Login</a></li>
                <li><i class="fa fa-unlock-alt"></i> <a href="#" class="register">Register</a></li>
            </ul><!-- .links end -->
        </div><!-- .container end -->
    </div><!-- #top-bar end -->  

    <!-- #header start -->
    <header id="header" class="">
        <!-- .container start -->
        <div class="container">
            <!-- .navbar start -->
            <nav class="navbar yamm navbar-default" role="navigation">
                <!-- .container start -->
                <div class="container">
                    <!-- .navbar-header start -->
                    <div class="navbar-header">
                        <!-- #logo start -->
                        <div id="logo" style="margin-top: 5px">
                            <a href="index-2.php">
                                <img src="img/logo.png" style="width: 130px !important; height: 130px !important;" alt="publiscreen online pso"/>
                            </a>
                        </div><!-- #logo end -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <i class="fa fa-bars fa-2x"></i>
                        </button>
                    </div><!-- .navbar-header end -->
                    <!-- #navbar start -->
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class="<?= (($page=='home')?'active':'') ?>"><a href="index.php">Home</a></li>
                            <li class="<?= (($page=='about')?'active':'') ?>"><a href="about.php" class="navbar-toggle">About Us</a></li>
                            <li class="<?= (($page=='services')?'active':'') ?>"><a href="services.php" class="navbar-toggle">Services</a></li>
                            <li class="<?= (($page=='portfolio')?'active':'') ?>"><a href="portfolio.php">Portfolio</a></li>
                            <li class="<?= (($page=='blog')?'active':'') ?>"><a href="#">Blog</a></li>
                            <li class="<?= (($page=='features')?'active':'') ?>"><a href="#">Features</a></li>
                            <li class="<?= (($page=='contact')?'active':'') ?>"><a href="contact.php">Contact</a></li>
                        </ul>
                    </div><!-- #navbar end -->
                </div><!-- .container start -->
            </nav><!-- .navbar end -->
        </div><!-- .container end -->
    </header><!-- #header end -->
</div>

<script src="js/jquery-1.11.0.min.js"></script>

<script>

$(window).scroll(function() {

    if ($(window).scrollTop() > 50) {
        $('#header').addClass('always-visible sticky');
    } else {
        $('#header').removeClass('always-visible sticky');
    }
});

</script>

<style>

.sticky
{
    position: fixed !important;
    top: 0px !important;
}
.banner-btn
{
    color: #00ADEE !important;
}
.banner-btn:hover
{
    color: #fff !important;
}
.active a
{
    color: #00ADEE !important;
}
#header
{
    background-color: rgba(255,255,255,0.95) !important;
    z-index: 99 !important;
}
.always-visible
{
    max-height: 80px !important;
}
.always-visible a img
{
    max-height: 80px !important;
    max-width: 80px !important;
    margin-top: -5px !important;
}
.always-visible ul li a
{
    padding-top: 30px !important;
}
.navbar-nav li a
{
    padding-top: 60px !important;
}

</style>