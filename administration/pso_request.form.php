<?php 

include_once 'conf/config.php';
include_once 'lang/pso_request.lang.inc';
include_once CLASS_PATH .'pso_request.class.php';


/**
 * Add SESSION variable to prevent main form to REDO the delete action
 */
$_SESSION['REDO']   = true;

/**
 * Errors Management
 */
if ($_GET['error'] == 1) {
    $notification   = formatFormErrors($_SESSION['errorMsgs']);
}

$actScript  = 'pso_request.form.php';

globalizeGet();
globalizePost();

$obj    = new pso_request();

$title  = getTitleFromMenuCaption('Request Quote');

//  Update number values
//  Remove the thousands seperator 
$_REQUEST['re_id'] = str_replace(".", "", $_REQUEST['re_id']); 
$_REQUEST['re_id'] = str_replace(",", ".", $_REQUEST['re_id']); 
$_REQUEST['re_published'] = str_replace(".", "", $_REQUEST['re_published']); 
$_REQUEST['re_published'] = str_replace(",", ".", $_REQUEST['re_published']); 

//  Set value of checkbox = 0 if not passed in the request
	$_REQUEST['re_published'] = (isset($_REQUEST['re_published']) && $_REQUEST['re_published'] == "on") ? 1 : 0;


switch ($in2Action) {
    case 'add': 
		$_REQUEST['re_cruser'] = $_SESSION['us_id']; 
		$_REQUEST['re_crdate'] = $_SESSION['us_id']; 

		$lastId    = $obj->InsertRequest(false);
        
        foreach ($_FILES as $uploadedFile) {
            $Extention = explode('.', $uploadedFile['name']);
            $uploadedFile['filename'] = 're_img_' . $lastId . '.' . $Extention[1];
            $fileObj = new file2($uploadedFile);
            $fileObj->manipImageUpload('pso_request', $lastId, REQUEST_PHOTO_SML, REQUEST_PHOTO_MED, REQUEST_PHOTO_BIG, true, false, REQUEST_PHOTO_MEDBIG, REQUEST_PHOTO_LRG, REQUEST_PHOTO_BO);
            $fileObj = null;
        }
        
        if ($obj->ErrorMsgs) {
            $_SESSION['errorMsgs']  = $obj->ErrorMsgs;

            $error  = '&error=1';
        }
        
        goToURL($actScript . "?recordId=$lastId&in2Action=editRecord&frmAction=add$error");
        
        break;
	        
    case 'deleteFile':
        $obj->DeleteFile($fileFieldName, array('re_id' => $re_id), true, true);
        
        if ($obj->ErrorMsgs) {
            $_SESSION['errorMsgs']  = $obj->ErrorMsgs;

            $error  = '&error=1';
        }
        
        goToURL($actScript . "?recordId=$re_id&in2Action=editRecord&frmAction=edit$error");
        
        break;

    case 'edit': 
			$_REQUEST['re_mduser'] = $_SESSION['us_id']; 
			$_REQUEST['re_mddate'] = $_SESSION['us_id']; 

        $notification   .= formatFormErrors($obj->ErrorMsgs);
        
        $obj->UpdateRequest(false);
        
        foreach ($_FILES as $uploadedFile) {
            $Extention = explode('.', $uploadedFile['name']);
            $uploadedFile['filename'] = 're_img_' . $_REQUEST['re_id'] . '.' . $Extention[1];
            $fileObj = new file2($uploadedFile);
            $fileObj->manipImageUpload('pso_request', $_REQUEST['re_id'],REQUEST_PHOTO_SML, REQUEST_PHOTO_MED, REQUEST_PHOTO_BIG, true, false, REQUEST_PHOTO_MEDBIG, REQUEST_PHOTO_LRG, REQUEST_PHOTO_BO);
            $fileObj = null;
        }
        
        
        $in2Action = 'edit';
        $frmAction = 'edit';
        
        goToURL($actScript . "?recordId=".$_REQUEST['re_id']."&in2Action=editRecord&frmAction=edit$error");
        
    case 'editRecord':
        if ($recordId) {
            $id    = $recordId;
        } elseif ($re_id) {
            $id    = $re_id;
        } else {
            $id    = null;
        }

        if ($id) {
            $where     = "WHERE re_id = " . $obj->getSqlColValue('re_id', $id);
            
            $record    = $obj->SelectRecord(null, $where, MYSQL_ASSOC, false);
            
            if (is_array($record)) {
                globalizeArray($record);
            } else {

                $_SESSION['errorMsgs']  = array('erroneousParam'   => 'Erroneous parameter passed.');

                $error  = '&error=1';

                goToURL($actScript . $error);
            }
        } else {
            goToURL($actScript);
        }
        
		$buttons = '<a href="#" class="btn btn-info btn-circle btn-block"><i class="icon-eye"></i>&nbsp;Preview</a>';
		$buttons .= '<hr/>';
		$buttons .= '<button type="submit" class="btn btn-block btn-success btn-circle" onclick="document.getElementById(\'in2Action\').value=\'edit\'"><i class="fa fa-check"></i>&nbsp;'.$arrLang[$_SESSION['lang']]['update'].'</button>';
		$buttons .= '<button type="button" class="btn btn-block btn-danger btn-circle" onclick="jQuery(\'#btnReset\').click(); deleteFrmRecord()"><i class="fa fa-trash-o"></i>&nbsp;'.$arrLang[$_SESSION['lang']]['delete'].'</button>';
		$buttons .= '<button type="button" class="btn btn-block btn-default btn-circle" onclick="window.location=\''.$actScript.'\'"><i class="fa fa-plus"></i>&nbsp;'.$arrLang[$_SESSION['lang']]['addnew'].'</button>';
		
		
        
        /**
         * If image/doc/video value exists; add View & Remove buttons
         */
   if ($re_img) {
			        $buttonsImg_re_img = '<div class="col-md-3 gallery-pages">
					   						<div class="thumbnail">
					                            <div class="caption">
					                            	<h4>Current Image</h4>
					                                <p>
					                                    <a href="' . PROJECT_UPLOAD_LRG_URL . $re_img . '?v=' . rand(100000, 999999) . '"
					                                       rel="tooltip" title="Enlarge"
					                                       data-lightbox="image-1" data-title="'.$sl_title.'"
					                                       class="label label-info mix-zoom mrs">'.$arrLang[$_SESSION['lang']]['view'].'</a>
					                                    <a href="javascript:deleteFile(\'re_img\', \'img\');" rel="tooltip" class="label label-danger" title="Delete">'.$arrLang[$_SESSION['lang']]['remove'].'</a>
					                                </p>
					                            </div>
					                            <img src="' . PROJECT_UPLOAD_BO_URL . $re_img . '"/>
					                           </div>
					                          </div>';
			
    			}

        
		$recordDetails = '<div class="panel">
                            	<div class="panel-heading">
                            		<div class="caption"><i aria-hidden="true" class="icon-equalizer"></i>Record Details</div>
                            	</div>
                                <div class="panel-body">
                                	<h4>Create</h4>
                                	<p>
                                		<i aria-hidden="true" class="icon-user"> '.$re_cruser.'</i><br/><i aria-hidden="true" class="icon-calendar"> '.$re_crdate.'</i>
                                	</p>
                                	<hr/>
                                	<h4>Update</h4>
                                	<p>
                                		<i aria-hidden="true" class="icon-user"> '.$re_mduser.'</i><br/><i aria-hidden="true" class="icon-calendar"> '.$re_mddate.'</i>
                                	</p>
                                </div>
                            </div>';

        break;
        
    case 'delete':
        $obj->DeleteRequest(false);

        if ($obj->ErrorMsgs) {
            $_SESSION['errorMsgs']  = $obj->ErrorMsgs;

            $error  = '&error=1';
        }
        
        goToURL($actScript . "?frmAction=delete$error");
        
        break;
	
	default:
        $in2Action = 'add';
        
        $buttons  = '<button type="submit" class="btn btn-block btn-success btn-circle" onclick="document.getElementById(\'in2Action\').value=\'add\'"><i class="fa fa-plus"></i>&nbsp;'.$arrLang[$_SESSION['lang']]['add'].'</button>';
		
        
        break;
	}

/**
 * Manipulate frmAction for the notification
 */
switch ($frmAction) {
    case 'add':
        
        $notification = '<div class="alert alert-success">
								    <div class="alert-icon fa fa-check-circle"></div>
								    <div class="alert-content">
								        <strong>Success!</strong>
								        <p>'.$arrLang[$_SESSION['lang']]['Recordadded'].'</p>
								    </div>
								</div>';

        break;

    case 'edit':
		$notification = '<div class="alert alert-info">
								    <div class="alert-icon fa fa-check-circle"></div>
								    <div class="alert-content">
								        <strong>Success!</strong>
								        <p>'.$arrLang[$_SESSION['lang']]['Recordupdated'].'</p>
								    </div>
								</div>';
		
        break;

    case 'editpassword':
        $notification = '<div class="alert alert-info">
								    <div class="alert-icon fa fa-check-circle"></div>
								    <div class="alert-content">
								        <strong>Success!</strong>
								        <p>'.$arrLang[$_SESSION['lang']]['passwordupdated'].'</p>
								    </div>
								</div>';

        break;        
        
    case 'delete':
        $notification = '<div class="alert alert-warning">
								    <div class="alert-icon fa fa-check-circle"></div>
								    <div class="alert-content">
								        <strong>Success!</strong>
								        <p>'.$arrLang[$_SESSION['lang']]['Recorddeleted'].'</p>
								    </div>
								</div>';

        break;
}

$notification   = ($notification ? '<div id="notificationDiv" class="message info">'.$notification.'</div>' : '');

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
    
    <link type="text/css" rel="stylesheet" href="assets/vendors/bootstrap-datepicker/css/datepicker.css">
    <link type="text/css" rel="stylesheet" href="assets/vendors/bootstrap-colorpicker/css/colorpicker.css">
    <link type="text/css" rel="stylesheet" href="assets/vendors/bootstrap-daterangepicker/daterangepicker-bs3.css">
    <link type="text/css" rel="stylesheet" href="assets/vendors/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
    <link type="text/css" rel="stylesheet" href="assets/vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
    <link type="text/css" rel="stylesheet" href="assets/vendors/bootstrap-clockface/css/clockface.css">
    
    <link type="text/css" rel="stylesheet" href="assets/vendors/lightbox/css/lightbox.css">
    
    <link type="text/css" rel="stylesheet" href="global/css/core.css">
    <link type="text/css" rel="stylesheet" href="assets/css/system.css">
    <link type="text/css" rel="stylesheet" href="assets/css/system-responsive.css">
</head>

				<body class="sidebar-color-grey font-source-sans-pro">
					<div class="fluid">
						
					    <!--BEGIN TOPBAR-->
					    <div class="page-header-topbar">
					        <?php include "ssi/topbar.php"?>
					    </div>
					    <!--END TOPBAR-->
					    <div id="wrapper"><!--BEGIN PAGE WRAPPER-->
					        <div id="page-wrapper">
					        	<!--BEGIN SIDEBAR MAIN-->
					            <?php include "ssi/menu.php" ?>
					            <!--END SIDEBAR MAIN-->
					            <!--BEGIN PAGE CONTENT-->
					            <div class="page-content"><!--BEGIN TITLE & BREADCRUMB PAGE-->
					                <div class="page-title-breadcrumb">
					                    <div class="page-header pull-left">
					                        <div class="page-title"><?php echo $title;?></div>
					                    </div>
					                    <ol class="breadcrumb page-breadcrumb hidden-xs">
					                        <li><i class="fa fa-home"></i>&nbsp;<a href="main.php">Dashboard</a>&nbsp;&nbsp;<i
					                                class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
					                        </li>
					                        <li class="active">Slideshow</li>
					                    </ol>
					                </div>
					                <!--END TITLE & BREADCRUMB PAGE-->
					                <div class="box-content">
					                	<!--BEGIN CONTENT-->
					                    <div class="content">
					                        <div class="row">
					                        	<form  class="form-horizontal" method="post" enctype="multipart/form-data" name="frmManip" id="frmManip" action="<?php echo $actScript ?>" onsubmit="jQuery('.notification').hide('slow');">
						                        	<div class="col-md-12">
						                        		<?php echo $notification ?>
						                        	</div>
						                        	<div class="col-md-9">
						                                <div class="panel">
						                                	<div class="panel-heading">
						                                		<div class="caption"><i aria-hidden="true" class="icon-pencil"></i>Edit Content</div>
						                                	</div>
						                                    <div class="panel-body">
											                        <input type="hidden" name="in2Action" id="in2Action" value="<?php print $in2Action ?>" />
											                        <input type="hidden" name="re_id" id="re_id" value="<?php print $re_id ?>" />
											                        <input type="hidden" name="fileFieldName" id="fileFieldName" value="" />
											                        <input type="hidden" name="frmParam" id="frmParam" value="<?php echo $frmParam ?>" />
																	<div class="form-body">
  
<div class="form-group">
	<label class="col-md-2 control-label"><?php echo $arrLang[$_SESSION['lang']]['re_name']; ?></label>
										            <div class="col-md-10">
										                <input type="text" placeholder="<?php echo $arrLang[$_SESSION['lang']]['re_name']; ?>"  class="form-control input-large" name="re_name" id="re_name" value="<?php echo htmlentities($re_name, ENT_NOQUOTES) ?>" />
										            </div> </div>
                                                    
                                                    
                                                    <div class="form-group">
	<label class="col-md-2 control-label"><?php echo $arrLang[$_SESSION['lang']]['re_company']; ?></label>
										            <div class="col-md-10">
										                <input type="text" placeholder="<?php echo $arrLang[$_SESSION['lang']]['re_company']; ?>"  class="form-control input-large" name="re_company" id="re_company" value="<?php echo htmlentities($re_company, ENT_NOQUOTES) ?>" />
										            </div> </div>
                                                    
                                                    
                                                    <div class="form-group">
	<label class="col-md-2 control-label"><?php echo $arrLang[$_SESSION['lang']]['re_email']; ?></label>
										            <div class="col-md-10">
										                <input type="text" placeholder="<?php echo $arrLang[$_SESSION['lang']]['re_email']; ?>"  class="form-control input-large" name="re_email" id="re_email" value="<?php echo htmlentities($re_email, ENT_NOQUOTES) ?>" />
										            </div> </div>
                                                    
                                                    
                                                    <div class="form-group">
	<label class="col-md-2 control-label"><?php echo $arrLang[$_SESSION['lang']]['re_phone']; ?></label>
										            <div class="col-md-10">
										                <input type="text" placeholder="<?php echo $arrLang[$_SESSION['lang']]['re_phone']; ?>"  class="form-control input-large" name="re_phone" id="re_phone" value="<?php echo htmlentities($re_phone, ENT_NOQUOTES) ?>" />
										            </div> </div>
  
  
<div class="form-group">
	<label class="col-md-2 control-label"><?php echo $arrLang[$_SESSION['lang']]['re_desc']; ?></label>
										            <div class="col-md-10">
										            	<textarea id="content" rows="10" class="form-control" name="re_desc" id="re_desc"><?php echo htmlentities($re_desc, ENT_NOQUOTES) ?></textarea>
										            </div> </div>
  
  
			</div>
							</div>
						</div>
					</div><div class="col-md-3">
                    <div class="panel">
                    	<div class="panel-heading">
                    		<div class="caption"><i aria-hidden="true" class="icon-settings"></i>Actions</div>
                    	</div>
                        <div class="panel-body">
                        	<div class="form-group">
                        		<div class="col-md-6">
                        			<label class="control-label"><?php echo $arrLang[$_SESSION['lang']]['re_published']; ?></label>
                        		</div>
                        		<div class="col-md-6">
                        			<div class="form-group">
                        				<div data-on="success" data-off="danger" data-on-label="YES" data-off-label="NO" class="make-switch">
                                 							<input name="re_published" id="re_published" type="checkbox" class="switch"/>
                                 						</div>
                        			</div>
                        		</div>
                        		<div class="col-md-12">
                        			<div class="form-group">
                        				<hr/>
                                		<?php print $buttons?>
                                	</div>
                            	</div>
                            </div>
                        </div>
                    </div>
                    
                    <?php print $recordDetails;?>
                    
            	</div></form>
                        </div>
                    </div>
                </div>
                <!--END CONTENT--></div>
            </div>
            <!--END PAGE CONTENT--></div>
        <!--END PAGE WRAPPER--></div>
            	<!--BEGIN FOOTER-->
			    <div id="footer">
			        <div class="copyright"> by Publiscreen Online
                        <div class="pull-left"> PSO © 2015</div>
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
				    form_components.init();
					form_editor.init();
					form_picker.init();
				    
				    $('.thumbnail').hover(
	        	
				        function () {
				            $(this).find('.caption').slideDown(250);
				        },
				        function () {
				            $(this).find('.caption').slideUp(250);
				        }
				    );
				    
				    
				    $("#frmManip").validate({
				            errorElement: 'span',
				            errorClass: 'help-block',
				            rules: {
									
										re_name: {
							                required: true
							            },
										re_company: {
							                required: true
							            },
										re_email: {
							                required: true
							            },
										re_phone: {
							                required: true
							            },
										re_img: {
							                required: false
							            },
										re_desc: {
							                required: false
							            },
										re_published: {
							                required: false
							            }},
				            highlight: function (element) {
				                $(element)
				                    .closest('.form-group').removeClass('has-success').addClass('has-error');
				            },
				            unhighlight: function (element) {
				                $(element)
				                    .closest('.form-group').removeClass('has-error');
				            }
                       });

	if(<?php echo ($re_published ? $re_published : 0) ?> == 1){
						$('#re_published').parent().bootstrapSwitch('setState' , true);
					}
					
					$('#re_published').parent().on('change', function(event,  state) {
				        if($('#re_published').parent().bootstrapSwitch('status')) $('#re_published').attr('checked', 'checked')
				        else $('#re_published').removeAttr('checked')
				    });
	
	      	  });
		</script>
						</body>
					</html>