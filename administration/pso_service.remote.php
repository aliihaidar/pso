<?php 

include_once 'conf/config.php';
include_once 'lang/pso_service.lang.inc';
include_once CLASS_PATH . 'pso_service.class.php';

globalizePost();
    
$obj    = new pso_service();

$rows   = MAX_PAGE_RECORDS;

/**
 * Get query data
 */
$obj->Select(array('se_title', 'se_img', 'IF(se_published = 1, "'. $yesNo[$_SESSION['lang']][1] .'", "'. $yesNo[$_SESSION['lang']][0] .'") se_published', 'se_id'), '', $whereClause . ' ORDER BY ' . ($_POST['sort'] - 2) . ' ' . $_POST['dir'], $_POST['page'], $rows, false);

while (!$obj->EOF()) {
    $row    = $obj->Row();
	print	'	<td>
					<input type="checkbox" name="chkRecord" id="chkRecord_'. $row->se_id .'" value="'. $row->se_id .'"/>
				</td>'; 

	print '    <td><img src="'.PROJECT_UPLOAD_BO_URL.$row->se_img.'" class="img-responsive img-circle"/></td>'; 
	print '    <td>' . $row->se_title . '</td>'; 
	print '    <td>' . $row->se_published . '</td>'; 
	
	print '    <td>
				 <div class="action-group btn-group pull-right mtm mbm">
					<button type="button" class="btn btn-default" onclick="javascript:window.location.assign(\'pso_service.form.php?recordId='. $row->se_id .'&in2Action=editRecord\');"><i class="fa fa-edit"></i>&nbsp;Edit</button>
					<button type="button" class="btn btn-default" onclick="javascript:deleteRecord(\'se_id\', '. $row->se_id .');"><i class="fa fa-trash-o"></i>&nbsp;Delete</button>
				</div>
			  </td>'; 
	print '</tr>';

} 

 
?>