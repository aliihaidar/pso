<?php
	include_once "conf/config.php";
	include_once(CLASS_PATH."tmp_user.class.php");

	//session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PSO-CMS - Publiscreen Online</title>
    <meta name="description" content="." />
    <meta name="keywords" content="." />
    <style type="text/css" media="all">
		@import url("css/style.css");
		@import url("css/visualize.css");
		@import url("css/date_input.css");
		@import url("css/jquery.wysiwyg.css");
		@import url("css/jquery.fancybox.css");
    </style>
    
    <!--[if lt IE 9]>
    <style type="text/css" media="all"> @import url("css/ie.css"); </style>
    <![endif]-->
</head>

<body>
<div id="header">
    <h1><a href="#"><?php echo PROJECT_NAME; ?></a></h1>
    <form action="" method="post" class="searchform">
        <input type="text" class="text" value="Search..." />
        <input type="submit" class="submit" value="" />
    </form>
    <div class="userprofile">
        <ul>
            <li><a href="#"><?php echo $_SESSION['us_fname'].' '.$_SESSION['us_lname'];?></a>
                <ul>
                    <li><a href="chgPassForm.php">Change Password</a></li>
                    <li><a href="login.php?cAction=Logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div> <!-- .userprofile ends -->
</div> <!-- #header ends -->

<?php include "ssi/menu.php" ?>

<div id="content">

    <h2>Welcome to Publiscreen website content management</h2>
    <h4>&laquo; Please select a menu from the left sidebar to get started</h4>

</div>

<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/excanvas.js"></script>
<script type="text/javascript" src="js/jquery.visualize.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.pager.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.filter.js"></script>
<script type="text/javascript" src="js/jquery.date_input.min.js"></script>
<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="js/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/custom.js"></script>



</body>

</html>

