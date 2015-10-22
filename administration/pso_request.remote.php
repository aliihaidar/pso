<?php 

include_once 'conf/config.php';
include_once 'lang/pso_request.lang.inc';
include_once CLASS_PATH . 'pso_request.class.php';

globalizePost();
    
$obj    = new pso_request();

$rows   = MAX_PAGE_RECORDS;

/**
 * Get query data
 */
$obj->Select(array('re_name','re_company','re_email','re_phone', 'IF(re_published = 1, "'. $yesNo[$_SESSION['lang']][1] .'", "'. $yesNo[$_SESSION['lang']][0] .'") re_published', 're_id'), '', $whereClause . ' ORDER BY ' . ($_POST['sort'] - 2) . ' ' . $_POST['dir'], $_POST['page'], $rows, false);

while (!$obj->EOF()) {
    $row    = $obj->Row();
	print	'	<td>
					<input type="checkbox" name="chkRecord" id="chkRecord_'. $row->re_id .'" value="'. $row->re_id .'"/>
				</td>'; 

	print '    <td>' . $row->re_name . '</td>'; 
	print '    <td>' . $row->re_companmy . '</td>'; 
	print '    <td>' . $row->re_email . '</td>'; 
	print '    <td>' . $row->re_phone . '</td>'; 
	print '    <td>' . $row->re_published . '</td>'; 
	
	print '    <td>
				 <div class="action-group btn-group pull-right mtm mbm">
					<button type="button" class="btn btn-default" onclick="javascript:window.location.assign(\'pso_request.form.php?recordId='. $row->re_id .'&in2Action=editRecord\');"><i class="fa fa-edit"></i>&nbsp;Edit</button>
					<button type="button" class="btn btn-default" onclick="javascript:deleteRecord(\'re_id\', '. $row->re_id .');"><i class="fa fa-trash-o"></i>&nbsp;Delete</button>
				</div>
			  </td>'; 
	print '</tr>';

} 

 
?>