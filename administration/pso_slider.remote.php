<?php 

include_once 'conf/config.php';
include_once 'lang/pso_slider.lang.inc';
include_once CLASS_PATH . 'pso_slider.class.php';

globalizePost();
    
$obj    = new pso_slider();

$rows   = MAX_PAGE_RECORDS;

/**
 * Get query data
 */
$obj->Select(array('sl_title', 'sl_img', 'sl_order', 'sl_link', 'IF(sl_published = 1, "'. $yesNo[$_SESSION['lang']][1] .'", "'. $yesNo[$_SESSION['lang']][0] .'") sl_published', 'sl_id'), '', $whereClause . ' ORDER BY ' . ($_POST['sort'] - 2) . ' ' . $_POST['dir'], $_POST['page'], $rows, false);

while (!$obj->EOF()) {
    $row    = $obj->Row();
	print	'	<td>
										<input type="checkbox" name="chkRecord" id="chkRecord_'. $row->sl_id .'" value="'. $row->sl_id .'"/>
									</td>'; 

	print '    <td><img src="'.PROJECT_UPLOAD_BO_URL.$row->sl_img.'" class="img-responsive img-circle"/></td>'; 
	print '    <td>' . $row->sl_title . '</td>'; 
	print '    <td>' . $row->sl_order . '</td>'; 
	print '    <td>' . $row->sl_link . '</td>'; 
	print '    <td>' . $row->sl_published . '</td>'; 
	
	print ' 			<td>
										 <div class="action-group btn-group pull-right mtm mbm">
											<button type="button" class="btn btn-default" onclick="javascript:window.location.assign(\'pso_slider.form.php?recordId='. $row->sl_id .'&in2Action=editRecord\');"><i class="fa fa-edit"></i>&nbsp;Edit</button>
											<button type="button" class="btn btn-default" onclick="javascript:deleteRecord(\'sl_id\', '. $row->sl_id .');"><i class="fa fa-trash-o"></i>&nbsp;Delete</button>
										</div>
									</td>'; 
	
	print '</tr>';

} 

 
?>