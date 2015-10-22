<?php

include_once 'conf/config.php';
include_once 'lang/chgPassForm.lang.inc';
include_once CLASS_PATH . 'usr.class.php';

$actScript  = 'chgPassForm.php';

globalizeGet();
globalizePost();

$obj    = new usr();
$title  = 'Change Password';
$id = $_SESSION['us_id'];

if (!$in2Action){
	$in2Action = 'editRecord';
} 

//  Update number values
//  Remove the thousands seperator
$_REQUEST['us_id'] = str_replace(",", "", $_REQUEST['us_id']);

switch ($in2Action) {

	case 'edit':

	$obj->Select(Array('us_password','us_username'),'', 'WHERE us_id = ' . $id , 1, null, false);   

	$cntObj = $obj->RowCount();             

	if ($cntObj) {    

		while (!$obj->EOF()) { 
			$rowObj  = $obj->Row() ; 
			$oldPass = $rowObj->us_password;
			$us_username = $rowObj->us_username; 
		}
	}

	if(md5($_REQUEST['us_oldpassword']) != $oldPass) {
		$in2Action = 'editRecord';

		$frmAction = 'nomatch';

	}
	else {	 
		$_REQUEST['us_mduser'] = $_SESSION['us_id'];
		$_REQUEST['us_mddate'] = date('Y-m-d');
		$_REQUEST['us_isactive'] = 1;
		$_REQUEST['us_password'] = md5($_REQUEST['us_password']);
		$_REQUEST['us_id'] = $id;

		$obj->UpdateRequest(false);

		$in2Action = 'edit';

		$frmAction = 'edit';
	}

	$buttons   = '<input type="submit" value="'.$arrLang[$_SESSION['lang']]['update'].'" class="btn btn-success btn-circle" onclick="document.getElementById(\'in2Action\').value=\'edit\'" />';
	break;

	case 'editRecord':
	if ($id) {
		$where     = "WHERE us_id = " . $obj->getSqlColValue('us_id', $id);

		$record    = $obj->SelectRecord(null, $where, MYSQL_ASSOC, false);

		if (is_array($record)) {
			globalizeArray($record);
		} else {
			goToURL($actScript);
		}
	} else {
		goToURL($actScript);
	}

	$buttons   = '<input type="submit" value="'.$arrLang[$_SESSION['lang']]['update'].'" class="btn btn-success btn-circle" onclick="document.getElementById(\'in2Action\').value=\'edit\'" />';

	break;

}
/**
 * Manipulate frmAction for the notification
 */
switch ($frmAction) {

	case 'edit':
        //$notification = '<div id="notificationDiv" class="message success">'.$arrLang[$_SESSION['lang']]['Recordupdated'].'</div>';
	$notification = '<div class="alert alert-success">
	<div class="alert-icon fa fa-check-circle"></div>
	<div class="alert-content">
	<strong>Success!</strong>
	<p>'.$arrLang[$_SESSION['lang']]['Recordupdated'].'</p>
	</div>
	</div>';

	break;

	case 'nomatch':

	$notification = '<div class="alert alert-danger">
	<div class="alert-icon fa fa-times-circle"></div>
	<div class="alert-content">
	<strong>Error!</strong>
	<p>'.$arrLang[$_SESSION['lang']]['Nomatch'].'</p>
	</div>
	</div>';

	break;    

}

$notification   = ($notification ? '<div id="notificationDiv" class="message info">'.$notification.'</div>' : '');

?>


<!DOCTYPE html>
<html lang="en">
<head><title> PSO | Change Password</title>
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
	<link type="text/css" rel="stylesheet" href="assets/vendors/bootstrap-datepicker/css/datepicker.css">
	<link type="text/css" rel="stylesheet" href="assets/vendors/bootstrap-colorpicker/css/colorpicker.css">
	<link type="text/css" rel="stylesheet" href="assets/vendors/bootstrap-daterangepicker/daterangepicker-bs3.css">
	<link type="text/css" rel="stylesheet" href="assets/vendors/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
	<link type="text/css" rel="stylesheet" href="assets/vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
	<link type="text/css" rel="stylesheet" href="assets/vendors/bootstrap-clockface/css/clockface.css">
	<link type="text/css" rel="stylesheet" href="global/css/core.css">
	<link type="text/css" rel="stylesheet" href="assets/css/system.css">
	<link type="text/css" rel="stylesheet" href="assets/css/system-responsive.css">
</head>

<body class="sidebar-color-grey font-source-sans-pro">
	<div class="fluid">
		<div class="page-header-topbar">
			<?php include "ssi/topbar.php" ?>
		</div>

		<div id="wrapper">
			<div id="page-wrapper">

				<?php include "ssi/menu.php" ?>
				
				<!--BEGIN PAGE CONTENT-->
				<div class="page-content"><!--BEGIN TITLE & BREADCRUMB PAGE-->
					<div class="page-title-breadcrumb">
						<div class="page-header pull-left">
							<div class="page-title"><?php echo $title;?></div>
						</div>
						<ol class="breadcrumb page-breadcrumb hidden-xs">
							<li><i class="fa fa-home"></i>&nbsp;<a href="main.php">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
						</li>
						<li class="active"><?php echo $title;?></li>
					</ol>
				</div>
				<!--END TITLE & BREADCRUMB PAGE-->
				<div class="box-content"><!--BEGIN CONTENT-->
					<div class="content">
						<div class="row">
							<div class="col-md-12">
								<?php echo $notification ?>
							</div>
							<div class="col-md-12">
								<form class="form-horizontal" method="post" enctype="multipart/form-data" name="frmManip" id="frmManip" action="<?php echo $actScript ?>">
									<div class="panel">
										<div class="panel-heading">
											<div class="caption"><i aria-hidden="true" class="icon-lock"></i>Change Password</div>
										</div>
										<div class="panel-body">
											<input type="hidden" name="us_id" id="us_id" value="" />
											<input type="hidden" name="in2Action" id="in2Action" value="<?php print $in2Action ?>" />
											<input type="hidden" name="frmAction" id="frmAction" value="<?php print $frmAction ?>" />
											<div class="form-body">
												<div class="col-md-12">
													<div class="form-group">
														<label class="col-md-2 control-label"><?php echo $arrLang[$_SESSION['lang']]['us_usernameLbl']; ?></label>
														<div class="col-md-10">
															<div class="form-control input-large"><?php echo htmlentities($us_username, ENT_NOQUOTES) ?></div>
														</div> 
													</div>

													<div class="form-group">
														<label class="col-md-2 control-label"><?php echo $arrLang[$_SESSION['lang']]['us_oldpasswordLbl']; ?></label>
														<div class="col-md-10">
															<input type="password" placeholder="Old Password"  class="form-control input-large" name="us_oldpassword" id="us_oldpassword" value="" />
														</div> 
													</div>

													<div class="form-group">
														<label class="col-md-2 control-label"><?php echo $arrLang[$_SESSION['lang']]['us_passwordLbl']; ?></label>
														<div class="col-md-10">
															<input type="password" placeholder="New Password"  class="form-control input-large" name="us_password" id="us_password" value="" />
														</div> 
													</div>

													<div class="form-group">
														<label class="col-md-2 control-label"><?php echo $arrLang[$_SESSION['lang']]['us_confpasswordLbl']; ?></label>
														<div class="col-md-10">
															<input type="password" placeholder="Confirm Password"  class="form-control input-large" name="us_confpassword" id="us_confpassword" value="" />
														</div> 
													</div>

												</div>
												<div class="col-md-12">
													<label class="col-md-2 control-label">&nbsp;</label>
													<div class="col-md-10">	
														<?php print $buttons?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--BEGIN FOOTER-->
<div id="footer">
	<div class="copyright"> Publiscreen Online
		<div class="pull-left">PSO © 2015</div>
	</div>
</div>
<!--END FOOTER-->
</div>	

<script src="global/js/jquery-1.10.2.min.js"></script>
<script src="global/js/jquery-migrate-1.2.1.min.js"></script>
<script src="global/js/jquery-ui.js"></script>
<script src="global/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="global/vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script>
<script src="global/js/html5shiv.js"></script>
<script src="global/js/respond.min.js"></script>
<script src="global/vendors/metisMenu/jquery.metisMenu.js"></script>
<script src="global/vendors/slimScroll/jquery.slimscroll.js"></script>
<script src="global/vendors/iCheck/icheck.min.js"></script>
<script src="global/vendors/iCheck/custom.min.js"></script>
<script src="assets/vendors/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="assets/vendors/google-code-prettify/prettify.js"></script>
<script src="assets/vendors/jquery-cookie/jquery.cookie.js"></script>
<script src="assets/vendors/jquery.pulsate.js"></script>
<!--LOADING SCRIPTS FOR PAGE-->
<script src="assets/vendors/jquery-maskedinput/jquery-maskedinput.js"></script>
<script src="assets/vendors/charCount.js"></script>
<script src="assets/js/form-components.js"></script>
<script src="assets/vendors/jquery-validation/dist/jquery.validate.js"></script>
<script src="assets/vendors/lightbox/js/lightbox.min.js"></script>
<script src="assets/js/page-gallery.js"></script>
<script src="assets/vendors/ckeditor/ckeditor.js"></script>
<script src="assets/js/form-editor.js"></script>
<script src="assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="assets/vendors/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="assets/vendors/bootstrap-daterangepicker/moment.js"></script>
<script src="assets/vendors/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/vendors/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script src="assets/vendors/bootstrap-clockface/js/clockface.js"></script>
<script src="assets/js/form-picker.js"></script>
<!--CORE JAVASCRIPT-->
<script src="global/js/core.js"></script>
<script src="assets/js/system-layout.js"></script>
<script src="assets/js/jquery-responsive.js"></script>
<script src="assets/js/common.js"></script>

<script>jQuery(document).ready(function () {

	"use strict";
	JQueryResponsive.init();
	Layout.init();

	$("#frmManip").validate({
		errorElement: 'span',
		errorClass: 'help-block',
		rules: {
			us_oldpassword: {
				required: true
			},
			us_password: {
				required: true
			},
			us_confpassword: {
				required: true,
				equalTo: "#us_password"
			}
		},
		highlight: function (element) {
			$(element)
			.closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		unhighlight: function (element) {
			$(element)
			.closest('.form-group').removeClass('has-error');
		}
	});
});

</script>
</body>
</html>