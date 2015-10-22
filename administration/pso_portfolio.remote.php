<?php 

include_once 'conf/config.php';
include_once 'lang/pso_portfolio.lang.inc';
include_once CLASS_PATH . 'pso_portfolio.class.php';
include_once CLASS_PATH . 'pso_portfolio_cat.class.php';

globalizePost();
    
$obj    = new pso_portfolio();

$rows   = MAX_PAGE_RECORDS;

/**
 * Get query data
 */
$obj->Select(array('(SELECT pocat_title FROM pso_portfolio_cat parent WHERE pso_portfolio.po_pocat_id = parent.pocat_id) po_pocat_id', 'po_title', 'po_img', 'IF(po_published = 1, "'. $yesNo[$_SESSION['lang']][1] .'", "'. $yesNo[$_SESSION['lang']][0] .'") po_published', 'po_id'), '', $whereClause . ' ORDER BY ' . ($_POST['sort'] - 2) . ' ' . $_POST['dir'], $_POST['page'], $rows, false);

while (!$obj->EOF()) {
    $row    = $obj->Row();
	print	'	<td>
										<input type="checkbox" name="chkRecord" id="chkRecord_'. $row->po_id .'" value="'. $row->po_id .'"/>
									</td>'; 

					

	print '    <td><img src="'.PROJECT_UPLOAD_BO_URL.$row->po_img.'" class="img-responsive img-circle"/></td>'; 
	print '    <td>' . $row->po_pocat_id . '</td>'; 
	print '    <td>' . $row->po_title . '</td>';  
	print '    <td>' . $row->po_link . '</td>'; 
	print '    <td>' . $row->po_published . '</td>'; 
	print ' 			<td>
										 <div class="action-group btn-group pull-right mtm mbm">
											<button type="button" class="btn btn-default" onclick="javascript:window.location.assign(\'pso_portfolio.form.php?recordId='. $row->po_id .'&in2Action=editRecord\');"><i class="fa fa-edit"></i>&nbsp;Edit</button>
											<button type="button" class="btn btn-default" onclick="javascript:deleteRecord(\'po_id\', '. $row->po_id .');"><i class="fa fa-trash-o"></i>&nbsp;Delete</button>
										</div>
									</td>'; 
	print '</tr>';

} 

 
?>