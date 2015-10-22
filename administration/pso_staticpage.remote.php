<?php 

include_once 'conf/config.php';
include_once 'lang/pso_staticpage.lang.inc';
include_once CLASS_PATH . 'pso_staticpage.class.php';

globalizePost();
    
$obj    = new pso_staticpage();

$rows   = MAX_PAGE_RECORDS;

/**
 * Get query data
 */
$obj->Select(array('sp_type', 'sp_title', 'sp_img', 'IF(sp_published = 1, "'. $yesNo[$_SESSION['lang']][1] .'", "'. $yesNo[$_SESSION['lang']][0] .'") sp_published', 'sp_id'), '', $whereClause . ' ORDER BY ' . ($_POST['sort'] - 2) . ' ' . $_POST['dir'], $_POST['page'], $rows, false);

while (!$obj->EOF()) {
    $row    = $obj->Row();
	print	'	<td>
					<input type="checkbox" name="chkRecord" id="chkRecord_'. $row->sp_id .'" value="'. $row->sp_id .'"/>
				</td>'; 

	print '    <td><img src="'.PROJECT_UPLOAD_BO_URL.$row->sp_img.'" class="img-responsive img-circle"/></td>'; 
	print '    <td>' . $arrLang[$_SESSION['lang']]['sp_type_'.$row->sp_type] . '</td>'; 
	print '    <td>' . $row->sp_title . '</td>'; 
	print '    <td>' . $row->sp_published . '</td>'; 
	
	print '    <td>
				 <div class="action-group btn-group pull-right mtm mbm">
					<button type="button" class="btn btn-default" onclick="javascript:window.location.assign(\'pso_staticpage.form.php?recordId='. $row->sp_id .'&in2Action=editRecord\');"><i class="fa fa-edit"></i>&nbsp;Edit</button>
					<button type="button" class="btn btn-default" onclick="javascript:deleteRecord(\'sp_id\', '. $row->sp_id .');"><i class="fa fa-trash-o"></i>&nbsp;Delete</button>
				</div>
			  </td>'; 
	print '</tr>';

} 

 
?>