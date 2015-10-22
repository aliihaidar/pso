<?php

include_once "config.server.php";

UserIsVerify($_SERVER['SCRIPT_NAME'], false);

/*
$oVerUser = new FormClass();
    		$query = 'SELECT s.mnu_href, u.xgm_select, u.xgm_update, u.xgm_delete, u.xgm_insert, s.mnu_label 
    				FROM sys_usergroup_menu u,sys_menu s
					WHERE u.mnu_id=s.mnu_id
					AND s.mod_id='. $this->module . ' AND u.ugp_id='.$this->usergroup . ' AND u.mnu_id='.$this->menuid ;
			 return $oVerUser->ExecuteStatement($query, $debug, null, null, true);
*/

?>