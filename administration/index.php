<?php
include_once "conf/config.server.php";
include_once "lang/index.lang.inc";

if ($_REQUEST['InvalidCreds']){
	$notification = '<div role="alert" class="alert alert-danger alert-dismissible alert-custom">
		                <button type="button" data-dismiss="alert" class="close"><span>&times;</span></button>
		                '.$arrLang['en']['InvalidCredantial'].'
		            </div>';
}

if ($_REQUEST['AlreadyLoggedIn']){
	$notification = '<div role="alert" class="alert alert-danger alert-dismissible alert-custom">
		                <button type="button" data-dismiss="alert" class="close"><span>&times;</span></button>
		                '.$arrLang['en']['AlreadyLogin'].'
		            </div>';
}

if ($_REQUEST['EmailSent']){
    $notification = '<div role="alert" class="alert alert-danger alert-dismissible alert-custom">
		                <button type="button" data-dismiss="alert" class="close"><span>&times;</span></button>
		                '.$arrLang['en']['EmailSent'].'
		            </div>';
}

if ($_REQUEST['EnterUsername']){
	$notification = '<div role="alert" class="alert alert-danger alert-dismissible alert-custom">
		                <button type="button" data-dismiss="alert" class="close"><span>&times;</span></button>
		                '.$arrLang['en']['EnterUsername'].'
		            </div>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head><title> PSO - Login Page </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="http://www.next-themes.com/mtek/code/images/icons/favicon.ico">
    <link type="text/css" rel="stylesheet"
          href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="global/vendors/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="global/vendors/simple-line-icons/simple-line-icons.css">
    <link type="text/css" rel="stylesheet" href="global/vendors/bootstrap/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="global/vendors/iCheck/skins/all.css">
    <link type="text/css" rel="stylesheet" href="global/css/core.css">
    <link type="text/css" rel="stylesheet" href="assets/css/system.css">
</head>
<body class="page-signin">
<div class="page-form">
    <form class="form" action="login.php" method="POST">
    	<input type="hidden" id="cAction" name="cAction" value="" />
        <div class="header-content text-center"><h1>Login to your account</h1></div>
        <div class="body-content">
            <?php echo $notification;?>
            <div class="list-group">
                <div class="list-group-item"><input type="text" placeholder="Username" class="form-control" name="us_username" id="us_username" required></div>
                <div class="list-group-item"><input type="password" placeholder="Password" class="form-control" name="us_password" id="us_password" required></div>
            </div>
            <div class="form-group pull-left"><label><input type="checkbox" class="form-control-shadow">&nbsp;
                Remember me</label></div>
            <div class="form-group pull-right"><a href="page_signin.html#" class="btn-link">Forgotten your Password?</a></div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-sm-5">
                    <button type="submit" class="btn btn-success btn-circle btn-block btn-shadow mbs">Log in</button>
                </div>
            </div>
            <hr>
            <div class="form-group"><p>Need Help? <a id="btn-register" href="page_signup.html"
                                                                 class="btn-link">Contact PSO </a></p></div>
        </div>
    </form>
</div>
<script src="global/js/jquery-1.10.2.min.js"></script>
<script src="global/js/jquery-migrate-1.2.1.min.js"></script>
<script src="global/js/jquery-ui.js"></script>
<script src="global/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="global/vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script>
<script src="global/js/html5shiv.js"></script>
<script src="global/js/respond.min.js"></script>
<script src="global/vendors/iCheck/icheck.min.js"></script>
<script src="global/vendors/iCheck/custom.min.js"></script>
<!--CORE JAVASCRIPT-->
<script src="global/js/core.js"></script>
<script src="assets/js/system.js"></script>
</body>
</html>