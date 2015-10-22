<?php
	
	include_once "conf/config.php";
	include_once(CLASS_PATH."tmp_user.class.php");
	//session_start();
?>


<!DOCTYPE html>
				<html lang="en">
				<head><title>PSO | Dashboard</title>
				    <meta charset="utf-8">
				    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
				    <meta name="viewport" content="width=device-width, initial-scale=1.0">
				    <link rel="shortcut icon" href="images/icons/favicon.ico">
				    <link rel="apple-touch-icon" href="images/icons/favicon.png">
				    <link rel="apple-touch-icon" sizes="72x72" href="images/icons/favicon-72x72.png">
				    <link rel="apple-touch-icon" sizes="114x114" href="images/icons/favicon-114x114.png">
				    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
				    <link type="text/css" rel="stylesheet" href="global/vendors/font-awesome/css/font-awesome.min.css">
				    <link type="text/css" rel="stylesheet" href="global/vendors/simple-line-icons/simple-line-icons.css">
				    <link type="text/css" rel="stylesheet" href="global/vendors/bootstrap/css/bootstrap.min.css">
				    <link type="text/css" rel="stylesheet" href="global/vendors/animate.css/animate.css">
				    <link type="text/css" rel="stylesheet" href="global/vendors/iCheck/skins/all.css">
				    <link type="text/css" rel="stylesheet" href="assets/vendors/bootstrap-switch/css/bootstrap-switch.css">
				    <link type="text/css" rel="stylesheet" href="assets/vendors/google-code-prettify/prettify.css">
				    <link type="text/css" rel="stylesheet" href="" id="font-layout">
				    
				    <link type="text/css" rel="stylesheet" href="global/css/core.css">
				    <link type="text/css" rel="stylesheet" href="assets/css/system.css">
				    <link type="text/css" rel="stylesheet" href="assets/css/system-responsive.css">
				</head>

 <body class="sidebar-color-grey font-source-sans-pro">
				<div class="fluid">
				<!--BEGIN TOPBAR-->
    <div class="page-header-topbar">
        <?php include "ssi/topbar.php"; ?>
    </div>
    <!-- END TOPBAR-->
    <div id="wrapper"><!--BEGIN PAGE WRAPPER-->
        <div id="page-wrapper">
        	<!--BEGIN SIDEBAR MAIN-->
            <?php include "ssi/menu.php" ?>
            <!--END SIDEBAR MAIN-->
            <!--BEGIN PAGE CONTENT-->
            <div class="page-content"><!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">Dashboard</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb hidden-xs">
                        <li class="active"><i class="fa fa-home"></i>&nbsp;Dashboard</li>
                    </ol>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <div class="box-content"><!--BEGIN CONTENT-->
                    <div class="content">
                        <div class="row">
                        	<div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row mbm">
                                            <div class="col-md12">
                                            	Welcome to PSO, Please Select a Menu to Start.
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                        	</div>
                        </div>
                        </div>
                        
                    </div>
                    <!--END CONTENT--></div>
            </div>
            <!--END PAGE CONTENT--></div>
        <!--END PAGE WRAPPER--></div>
	
            	<!--BEGIN FOOTER-->
			    <div id="footer">
			        <div class="copyright"> Publiscreen Online
			            <div class="pull-left">PSO S.A.L © 2015</div>
			        </div>
			    </div>
			    <!--END FOOTER--></div>	
            
            	<script src="global/js/jquery-1.10.2.min.js"></script>
				<script src="global/js/jquery-migrate-1.2.1.min.js"></script>
				<script src="global/js/jquery-ui.js"></script>
				<script src="global/vendors/bootstrap/js/bootstrap.min.js"></script>
				<script src="global/vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script>
				<script src="global/js/html5shiv.js"></script>
				<script src="global/js/respond.min.js"></script>
				<script src="global/vendors/metisMenu/jquery.metisMenu.js"></script>
				<script src="global/vendors/iCheck/icheck.min.js"></script>
				<script src="global/vendors/iCheck/custom.min.js"></script>
				<script src="assets/vendors/bootstrap-switch/js/bootstrap-switch.min.js"></script>
				<script src="assets/vendors/jquery-cookie/jquery.cookie.js"></script>
				<script src="assets/vendors/jquery.pulsate.js"></script>
				<!--CORE JAVASCRIPT-->
				<script src="global/js/core.js"></script>
				<script src="assets/js/system-layout.js"></script>
				<script src="assets/js/jquery-responsive.js"></script>
				<script src="assets/js/common.js"></script>
				<script>jQuery(document).ready(function () {
				    "use strict";
				    JQueryResponsive.init();
				    Layout.init();
				});
				</script>
				</body>
				</html>