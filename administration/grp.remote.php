<?php 

include_once 'conf/config.php';
include_once CLASS_PATH . 'grp.class.php';

globalizePost();
    
$obj    = new grp();

$rows   = MAX_PAGE_RECORDS;

/**
 * WHERE clause building
 */ 
$gr_title    = trim($gr_title);
$gr_brief    = trim($gr_brief);

$whereClause    = " WHERE UPPER(IFNULL(gr_title, '')) LIKE UPPER(CONCAT('%', IFNULL(" . $obj->getSqlColValue('gr_title', $gr_title) . ", ''), '%'))
                      AND UPPER(IFNULL(gr_brief, '')) LIKE UPPER(CONCAT('%', IFNULL(" . $obj->getSqlColValue('gr_brief', $gr_brief) . ", ''), '%'))
"; 

/**
 * Get query data
 */
$obj->Select(array('gr_title', 'gr_brief', 'gr_id'), '', $whereClause . ' ORDER BY ' . ($_POST['sort'] - 2) . ' ' . $_POST['dir'], $_POST['page'], $rows, false);

while (!$obj->EOF()) {
    $row    = $obj->Row();
   
	print	'	<td><input type="checkbox" name="chkRecord" id="chkRecord_'. $row->gr_id .'" value="'. $row->gr_id .'"/></td>'; 
	print '    <td>' . $row->gr_title . '</td>'; 
	print '    <td>' . $row->gr_brief . '</td>'; 
	print ' 			<td>
					 <div class="action-group btn-group pull-right mtm mbm">
						<button type="button" class="btn btn-default" onclick="javascript:window.location.assign(\'grp.form.php?recordId='. $row->gr_id .'&in2Action=editRecord\');"><i class="fa fa-edit"></i></button>
						<button type="button" class="btn btn-default" onclick="javascript:deleteRecord(\'gr_id\', '. $row->gr_id .');"><i class="fa fa-trash-o"></i></button>
					</div>
				</td>'; 
	print '</tr>';

} 

 
?>