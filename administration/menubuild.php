<?php
	ob_start();
	include_once("conf/config.server.php");
	include_once(CLASS_PATH."page.class.php");
	include_once(CLASS_PATH."tmp_user.class.php");

	session_start();

	
	$MenuHead       = '';
    $MenuFoot       = '';
    $MenuSubHead    = '';
    $MenuSubFoot    = '';
    $otmp_user = new tmp_user();
    
	function getCursorFromDB($oObject, $Query = '', $isDebug = false)
	{
		$oObject->selectQuery($Query,$isDebug);
		return $oObject;
	}
	
    function buildmenu($MenCaption = '', $MenClass = '', $MenRef = '', $MenMain = 0, $SubMain = 0, $MenSep = 0, $EndMenu = 0, $EndSubMenu = 0, $buildMenu = 0, $fixhref = '', $skipmenu = 0)
    {
        global $MenuHead, $MenuFoot, $MenuSubHead, $MenuSubFoot,$otmp_user;
        
        if (1 == $buildMenu) {
        	if ($otmp_user->CheckIfExists(array('us_id'=>$_SESSION['us_id']),false)){
        		$otmp_user->Update(array('us_menu'=>$otmp_user->GetSqlColValue('us_menu',$MenuHead)),array('us_id'=>$_SESSION['us_id']),false);
        	} else {
        		$otmp_user->Insert(array('us_id'=>$_SESSION['us_id'], 'us_menu'=>$otmp_user->GetSqlColValue('us_menu',$MenuHead)),false);
        	}
            //print $MenuHead;
            return;
        }
        
        if (1 == $EndMenu) {
            $MenuHead   = $MenuHead . chr(13) . $MenuFoot;
            $MenuFoot   = '';
            return;
        }
        
        if (1 == $EndSubMenu) {
            $MenuHead   = $MenuHead . chr(13) . $MenuSubHead;
            $MenuHead   = $MenuHead . chr(13) . $MenuSubFoot . chr(13);
            
            $MenuSubHead    = '';
            $MenuSubFoot    = '';
            return;
        }
        
        if (1 == $MenMain) {
            $MenuHead   = $MenuHead . '<li class="sidebar-hide"><h4 class="sidebar-title-section"';
            
            if ($fixhref != '') {
                $MenuHead   = $MenuHead . ' href="' . $fixhref . '" ';
            }
            
            $MenuHead   = $MenuHead . '>' . $MenCaption . '</h4>' . chr(13);
            
            if ($skipmenu == 0){
                //$MenuHead   = $MenuHead . '<ul>' . chr(13);
            }
            
            $MenuFoot   = '</li>' . chr(13) . $MenuFoot;
            
            if ($skipmenu == 0) {
                //$MenuFoot   = '</ul>' . chr(13) . $MenuFoot;
            }
            
            return;
        }
        if (1 == $SubMain) {
            $MenuHead   = $MenuHead . '<li><a>' . $MenCaption . '</a></li>' . chr(13);
            //$MenuHead   = $MenuHead . '<ul>' . chr(13);
            
            //$MenuSubFoot    = '</ul>' . chr(13) .'</li>' . chr(13) . $MenuSubFoot;
            //$MenuSubFoot    = '</li>' . chr(13) . $MenuSubFoot;

            return;
        }
        
        if (1 == $MenSep) {
            $MenuHead   = $MenuHead . '<li class="separator"><span></span></li>' . chr(13);
            
            return;
        }
        
        $MenuHead   = $MenuHead . '<li><a href="' . $MenRef . '"><i class="'.$MenClass.'"></i><span class="menu-title">' . $MenCaption . '</a></li>' . chr(13);
    }
    
    function closemenu($Type)
    {	
        switch ($Type) {
            case 1:
                buildmenu('', '', '', 0, 0, 0, 1);
                break;
                
            case 3:
                buildmenu('', '', '', 0, 0, 0, 0, 1);
                break;
        }
    }
    
    function buildmenudb($row, $pg_type)
    {
        if ($row['pg_title']=='sep')
        $pg_type=0;
        
        
        switch ($pg_type) {
            case 1:
                buildmenu($row['pg_title'] . '', '', '', 1);
                break;
                
            case 2:
                buildmenu($row['pg_title'] . '', $row['pg_class'] . '', $row['pg_href'] . '');
                break;
                
            case 3:
                buildmenu($row['pg_title'] . '', $row['pg_class'] . '', '', 0, 1);
                break;
                
            case 4:
                buildmenu($row['pg_title'] . '', $row['pg_class'] . '', $row['pg_href'] . '');
                break;
                
            case 0:
                buildmenu('', '', '', 0, 0, 1);
                break;
        }
    }
    
    function getquery($type = 0)
    {
        $usertable  = 'page s, grp_page p';
        $yourfield  = 's.pg_id, s.pg_title, s.pg_href, s.pg_class, s.pg_order';
        $wherefield = ' WHERE s.pg_id = p.gpx_pg_id AND s.pg_backoffice = 1 AND s.pg_ishidden=0 AND p.gpx_gr_id = ' . $_SESSION['gr_id'];
        
        if (0 == $type) {
            $wherefield = $wherefield . ' AND s.pg_pg_id IS NULL ';
        } else {
            $wherefield = $wherefield . ' AND s.pg_pg_id IN (' . $type . ') ';
        }
        
        $wherefield1    = ' AND ((NOT EXISTS(SELECT 1 FROM page ss WHERE ss.pg_pg_id = s.pg_id  AND ss.pg_ishidden=0)) ';
        $wherefield1    .= ' OR EXISTS(SELECT 1 FROM page ss, grp_page pp WHERE ss.pg_pg_id = s.pg_id ';
        $wherefield1    .= ' AND ss.pg_id = pp.gpx_pg_id AND ss.pg_backoffice = 1  AND ss.pg_ishidden=0 AND pp.gpx_gr_id = p.gpx_gr_id))';
        
        $orderfield = 'ORDER BY s.pg_order ASC';
        
        $query  = 'SELECT ' . $yourfield . ' FROM ' . $usertable . $wherefield . $wherefield1 . $orderfield;
        
        return $query;
    }
    
    function getusermenu()
    {
    	global $otmp_user;
    	//$otmp_user = new tmp_user();
    	$otmp_user->Update(array('us_menu'=>$otmp_user->GetSqlColValue('us_menu','')),array('us_id'=>$_SESSION['us_id']),false);
                
        
        //global $omenu;
        
        //$result = $omenu->ExecuteStatement('UPDATE tmp_user SET us_menu = \'\' WHERE us_id = ' . $_SESSION['us_id'], false, null, null, false);

        //buildmenu('Site', '', '', 1);
        //buildmenu('Control Panel', 'icon-16-cpanel', 'module.php');
        //buildmenu('Home', 'icon-16-lock', 'main.php');
        //buildmenu('', '', '', 0, 0, 1);
        //buildmenu('Change Password', 'icon-16-lock', 'chgPassForm.php');
        //buildmenu('', '', '', 0, 0, 1);
        //buildmenu('Logout', 'icon-16-logout', 'login.php?cAction=Logout');
        
        closemenu(1);
        
        $result = new page();

        $result = getCursorFromDB($result, getquery(),false);
       	$rows=$result->RecordsArray(MYSQL_ASSOC);       		
       		
        if ($rows) {        	
        	foreach ($rows as $row) {            	
                buildmenudb($row,1);
                $result1 = getCursorFromDB($result, getquery($row['pg_id']),false);
                $rows1 = $result1->RecordsArray(MYSQL_ASSOC);
                
                foreach ($rows1 as $row1) { 
                	$result2 = getCursorFromDB($result, getquery($row1['pg_id']),false);
                	$rows2 = $result2->RecordsArray(MYSQL_ASSOC);
                    if ($rows2) {
                        buildmenudb($row1, 3);
                    } else {
                        buildmenudb($row1, 2);
                    }
                    
                    if ($rows2) {
                        foreach ($rows2 as $row2) {
                        	//$row2 = $result2->RowArray(null, MYSQL_ASSOC);
                            buildmenudb($row2, 4);
                        }
                        closemenu(3);
                        
                    } else {
                        closemenu(2);
                        
                    } 
                   
                }
                closemenu(1);
                
            }
            buildmenu('', '', '', 0, 0, 0, 0, 0, 1);
            
        }   	
    }
        
    if (isset($_SESSION["us_id"]))
	{
	    getusermenu();
		goToURL('main.php');
	}else{
		goToURL('index.php');
	}
    /*
    $otmp_user1 = new tmp_user();
    $otmp_user1 -> SelectAll();
    
    while (!$otmp_user1->EOF()){
    	$row5=$otmp_user1->Row();
    	echo $row5->us_menu;
    }
    */
    ob_flush();
?>
