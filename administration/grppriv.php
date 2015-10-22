<?php

include_once 'conf/config.php';
include_once 'lang/grppage.lang.inc';

include_once CLASS_PATH . 'grp_page.class.php';
include_once CLASS_PATH . 'page.class.php';
include_once CLASS_PATH . 'grp.class.php';

$actScript  = 'grppriv.php';

globalizePost();

$obj    = new grp_page();
$_REQUEST['gr_id']= $_REQUEST['gr_id'] + 0;

$title  = getTitleFromMenuCaption('Group Privileges');
if (!is_integer($_REQUEST['gr_id'])){
	$_REQUEST['gr_id'] = 0;
}
//var_dump($_POST);

function clearTableData($gpx_gr_id, $debug)
{
	global $obj;
	$obj->execute(MySQL::BuildSQLDelete('grp_page',array('gpx_gr_id'=>$obj->getSqlColValue('gpx_gr_id', $gpx_gr_id))),$debug);
}

function insertTableData( $gpx_pg_id, $gpx_gr_id, $debug)
{
	global $obj;
	$obj->execute(MySQL::BuildSQLInsert('grp_page',array('gpx_pg_id'=>$obj->getSqlColValue('gpx_pg_id', $gpx_pg_id),'gpx_gr_id'=>$obj->getSqlColValue('gpx_gr_id', $gpx_gr_id)),$debug));
}

$ugpStmt   = 'SELECT g.gr_id, g.gr_title FROM grp g order by g.gr_title;';
$mnuStmt   = 'SELECT mnu.pg_id, (case when mnu.pg_title=\'sep\' then \'---------------------------------\' else mnu.pg_title end) as menu, 
IFNULL(ugpm.gpx_pg_id,-1) as sel, IFNULL(mnu.pg_pg_id,-1) as isparent,
IFNULL((select mnu1.pg_pg_id from page mnu1 where mnu.pg_pg_id = mnu1.pg_id),-1) as ischild,
IFNULL((select mnu2.pg_order from page mnu2 where mnu2.pg_id = mnu.pg_pg_id), mnu.pg_order) as parentOrder,
(case when mnu.pg_pg_id is null then (select min(mnu3.pg_order) - min(mnu3.pg_order) from page mnu3 where mnu3.pg_pg_id = mnu.pg_id) else mnu.pg_order end) as pg_order
FROM page mnu
LEFT OUTER JOIN grp_page ugpm on ugpm.gpx_gr_id ='.  $_REQUEST['gr_id'].'  and mnu.pg_id = ugpm.gpx_pg_id
WHERE '.$_REQUEST['gr_id'].'>0
order by parentOrder, pg_order';

if ($_POST['btnsave']){
	$valSel = $_REQUEST['selMe'];
	clearTableData($_REQUEST['gr_id'],false);
	if ($valSel){
		foreach ($valSel as $key=>$element){
			insertTableData($element, $_REQUEST['gr_id'], true);
		}
	}
}
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
	
	<link type="text/css" rel="stylesheet" href="assets/vendors/DataTables/media/css/jquery.dataTables.css">
	<link type="text/css" rel="stylesheet"
	href="assets/vendors/DataTables/extensions/TableTools/css/dataTables.tableTools.min.css">
	<link type="text/css" rel="stylesheet" href="assets/vendors/DataTables/media/css/dataTables.bootstrap.css">
	
	<link type="text/css" rel="stylesheet" href="global/css/core.css">
	<link type="text/css" rel="stylesheet" href="assets/css/system.css">
	<link type="text/css" rel="stylesheet" href="assets/css/system-responsive.css">
</head>

<body class="sidebar-color-grey font-source-sans-pro">
	<div class="fluid">
		<!--BEGIN TOPBAR-->
		<div class="page-header-topbar">
			<?php include "ssi/topbar.php" ?>
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
								<form id="frmGrp" name="frmGrp" method="post" enctype="multipart/form-data" action="<?php echo $actScript ?>">
									<div class="panel">
										<div class="panel-heading">
											<div class="caption"><i aria-hidden="true" class="icon-users"></i>Select Group</div>
										</div>
										<div class="panel-body">
											<div class="form-group">
												<div class="col-md-4">
													<?php  echo genTableList('gr_id', 'grp', $ugpStmt, 'gr_id', 'gr_title',false,  true, $labelNull = $arrLang[$_SESSION['lang']]['genTableSelect'], $selectedVal = $_REQUEST['gr_id'], $listClass = 'form-control',$listStyle = null, $onChange = 'submitFrm(\'frmGrp\', null, null, null, 1)');?>
												</div>
												<div class="col-md-8">
													<input type="submit" id="btnsave" name="btnsave" class="btn btn-success btn-circle" value="<?php echo $arrLang[$_SESSION['lang']]['save']; ?>"/>
													<input type="button" class="btn btn-danger btn-circle" value="<?php echo $arrLang[$_SESSION['lang']]['clear'];?>" onclick="window.location = '<?php echo $actScript ?>'"/>
												</div>
											</div>
										</div>
									</div>
									
									<div class="panel">
										<div class="panel-body">
											<div class="row mbm">
												<div class="col-md12">
													<div class="table-responsive">
														
														<table id="table_id" class="table table-hover table-striped table-advanced">
															<thead>
																<tr>
																	<th><?php echo $arrLang[$_SESSION['lang']]['sl_img']; ?></th>
																	<th style="width: 3%; padding: 5px 10px;"><input type="checkbox" class="chkRecordAll" onclick="privAll()" /></th>
																</tr>
															</thead>
															<tbody>
																<?php
																$obj->SelectQuery($mnuStmt, false);
																while (!$obj->EOF()) {
																	
																	$row    = $obj->Row();
																	if ($row->isparent == -1){
																		$style='success';
																	}else{
																		$style='';
																	}
																	print '<tr class="'.$style.'">';
																	print '    <td>' . $row->menu . '</td>';
																	print	'	<td><input type="checkbox" id="chkRecord_'. $row->pg_id .'" value="'. $row->pg_id .'" name="selMe[]" class="chkRecord" '. ($row->sel==-1?"":"checked")  .' onclick="chkPrivAll();" /></td>'; 
				                                                            //print '    <td><input type="checkbox" id="chkRecord_'. $row->pg_id .'" value="'. $row->pg_id .'" name="selMe[]" class="chkRecord" '. ($row->sel==-1?"":"checked")  .' onclick="chkPrivAll();" /></td>';
																	print '</tr>';
																}
																
																?>
															</tbody>
															
														</table>
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
				<!--END CONTENT--></div>
			</div>
			<!--END PAGE CONTENT--></div>
			<!--END PAGE WRAPPER--></div>
			
			<!--BEGIN FOOTER-->
			<div id="footer">
				<div class="copyright"> Publiscreen Online
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
			<script src="assets/vendors/DataTables/media/js/jquery.dataTables.js"></script>
			<script src="assets/vendors/DataTables/media/js/dataTables.bootstrap.js"></script>
			<script src="assets/vendors/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
			<script src="assets/js/table-advanced.js"></script>
			<!--CORE JAVASCRIPT-->
			<script src="global/js/core.js"></script>
			<script src="assets/js/system-layout.js"></script>
			<script src="assets/js/jquery-responsive.js"></script>
			<script src="assets/js/common.js"></script>
			<script>jQuery(document).ready(function () {
				"use strict";
				JQueryResponsive.init();
				Layout.init();
				table_advanced.init();
				
				chkPrivAll();
				
				
			});
			</script>
		</body>
		</html>
