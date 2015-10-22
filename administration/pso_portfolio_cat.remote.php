<?php 

include_once 'conf/config.php';
include_once 'lang/pso_portfolio_cat.lang.inc';
include_once CLASS_PATH . 'pso_portfolio_cat.class.php';

globalizePost();
    
$obj    = new pso_portfolio_cat();

$rows   = MAX_PAGE_RECORDS;

/**
 * Get query data
 */
$obj->Select(array('pocat_title', 'pocat_order', 'IF(pocat_published = 1, "'. $yesNo[$_SESSION['lang']][1] .'", "'. $yesNo[$_SESSION['lang']][0] .'") pocat_published', 'pocat_id'), '', $whereClause . ' ORDER BY ' . ($_POST['sort'] - 2) . ' ' . $_POST['dir'], $_POST['page'], $rows, false);

while (!$obj->EOF()) {
    $row    = $obj->Row();
	print	'	<td>
					<input type="checkbox" name="chkRecord" id="chkRecord_'. $row->pocat_id .'" value="'. $row->pocat_id .'"/>
				</td>'; 

	print '    <td>' . $row->pocat_title . '</td>'; 
	print '    <td>' . $row->pocat_order . '</td>'; 
	print '    <td>' . $row->pocat_published . '</td>'; 
	print ' 			<td>
	
<div class="action-group btn-group pull-right mtm mbm">
<button type="button" class="btn btn-default" onclick="javascript:window.location.assign(\'pso_portfolio_cat.form.php?recordId='. $row->pocat_id .'&in2Action=editRecord\');"><i class="fa fa-edit"></i>&nbsp;Edit</button>
<button type="button" class="btn btn-default" onclick="javascript:deleteRecord(\'pocat_id\', '. $row->pocat_id .');"><i class="fa fa-trash-o"></i>&nbsp;Delete</button>
</div>
</td>'; 
	print '</tr>';

} 

 
?>