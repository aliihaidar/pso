<?php 

include_once 'conf/config.php';
include_once 'lang/pso_client.lang.inc';
include_once CLASS_PATH . 'pso_client.class.php';

globalizePost();
    
$obj    = new pso_client();

$rows   = MAX_PAGE_RECORDS;

/**
 * Get query data
 */
$obj->Select(array('cl_title', 'cl_img', 'IF(cl_published = 1, "'. $yesNo[$_SESSION['lang']][1] .'", "'. $yesNo[$_SESSION['lang']][0] .'") cl_published', 'cl_id'), '', $whereClause . ' ORDER BY ' . ($_POST['sort'] - 2) . ' ' . $_POST['dir'], $_POST['page'], $rows, false);

while (!$obj->EOF()) {
    $row    = $obj->Row();
	print	'	<td>
					<input type="checkbox" name="chkRecord" id="chkRecord_'. $row->cl_id .'" value="'. $row->cl_id .'"/>
				</td>'; 

	print '    <td><img src="'.PROJECT_UPLOAD_BO_URL.$row->cl_img.'" class="img-responsive img-circle"/></td>'; 
	print '    <td>' . $row->cl_title . '</td>'; 
	print '    <td>' . $row->cl_published . '</td>'; 
	
	print '    <td>
				 <div class="action-group btn-group pull-right mtm mbm">
					<button type="button" class="btn btn-default" onclick="javascript:window.location.assign(\'pso_client.form.php?recordId='. $row->cl_id .'&in2Action=editRecord\');"><i class="fa fa-edit"></i>&nbsp;Edit</button>
					<button type="button" class="btn btn-default" onclick="javascript:deleteRecord(\'cl_id\', '. $row->cl_id .');"><i class="fa fa-trash-o"></i>&nbsp;Delete</button>
				</div>
			  </td>'; 
	print '</tr>';

} 

 
?>