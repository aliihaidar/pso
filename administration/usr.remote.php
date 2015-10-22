<?php 

include_once 'conf/config.php';
include_once 'lang/usr.lang.inc';
include_once CLASS_PATH . 'usr.class.php';

globalizePost();

$obj    = new usr();

/**
 * Get query data
 */
$obj->Select(array('us_lname', 'us_fname', 'us_dob','us_img', 'us_address', 'us_phone', 'us_mobile', 'us_email', 'us_username', 'us_password', 'IF(us_isactive = 1, "'. $yesNo[$_SESSION['lang']][1] .'", "'. $yesNo[$_SESSION['lang']][0] .'") us_isactive', '(SELECT gr_title FROM grp parent WHERE usr.us_gr_id = parent.gr_id) us_gr_id', 'us_id'), '', $whereClause . ' ORDER BY ' . ($_POST['sort'] - 2) . ' ' . $_POST['dir'], $_POST['page'], $rows, false);

while (!$obj->EOF()) {
	$row    = $obj->Row();

	print	'	<td><input type="checkbox" name="chkRecord" id="chkRecord_'. $row->us_id .'" value="'. $row->us_id .'"/></td>'; 
	print '    <td><img src="'.PROJECT_UPLOAD_BO_URL.$row->us_img.'" class="img-responsive img-circle"/></td>'; 
	print '    <td>' . $row->us_lname . '</td>'; 
	print '    <td>' . $row->us_fname . '</td>'; 
	print '    <td>' . $row->us_email . '</td>'; 
	print '    <td>' . $row->us_username . '</td>'; 
	print '    <td>' . $row->us_isactive . '</td>'; 
	print '    <td>' . $row->us_gr_id . '</td>'; 
	print ' 			<td>
	<div class="action-group btn-group pull-right mtm mbm">
	<button type="button" class="btn btn-default" onclick="javascript:window.location.assign(\'usr.form.php?recordId='. $row->us_id .'&in2Action=editRecord\');"><i class="fa fa-edit"></i></button>
	<button type="button" class="btn btn-default" onclick="javascript:deleteRecord(\'us_id\', '. $row->us_id .');"><i class="fa fa-trash-o"></i></button>
	</div>
	</td>'; 
	print '</tr>';

}

?>