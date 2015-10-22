<?php

/**
 * Returns the difference between 2 dates (full date, days only or seconds only)
 *
 * @author Jad Bou Chebl
 * @copyright 27-09-2007
 * @param date $str_start (Y-m-d H:i:s format)
 * @param date $str_end (Y-m-d H:i:s format)
 * @param string[optional] $returnType (FULL_DATE / ONLY_DAYS / ONLY_SECOND)
 * @return full date or number of days / seconds
 */
function in2_date_diff($str_start, $str_end, $returnType = 'FULL_DATE') {
    switch ($returnType) {
        case 'ONLY_DAYS':
            $returnDays = 1;
            break;

        case 'ONLY_HOURS':
            $returnHr = 1;
            break;

        case 'ONLY_SECOND':
            $returnSec = 1;
            break;
    }

    $str_start = strtotime($str_start);        // The start date becomes a timestamp
    $str_end = strtotime($str_end);          // The end date becomes a timestamp

    $nSeconds = $str_end - $str_start;        // Number of seconds between the two dates

    if ($returnSec) {
        return $nSeconds;
    }

    $nDays = round($nSeconds / 86400);     // One day has 86400 seconds

    if ($returnDays) {
        return $nDays;
    }

    $totHours = floor($nSeconds / 3600);      // Overall hours

    $nSeconds = $nSeconds % 86400;            // The remainder from the operation
    $nHours = floor($nSeconds / 3600);      // One hour has 3600 seconds
    $nSeconds = $nSeconds % 3600;
    $nMinutes = floor($nSeconds / 60);        // One minute has 60 seconds
    $nseconds = $nSeconds % 60;

    if ($returnHr) {
        return "$totHours Hr(s)., $nMinutes Min., $nseconds Sec.";
    }

    return "$nDays Day(s), $nHours Hr(s)., $nMinutes Min., $nseconds Sec.";
}

function globalizeArray($array) {
    foreach ($array as $key => $value) {
        global $$key;

        $$key = $value;
    }
}

function globalizePost() {
    global $_POST;

    if ($_POST) {
        globalizeArray($_POST);
    }
}

function globalizeGet() {
    global $_GET;

    if ($_GET) {
        globalizeArray($_GET);
    }
}

//function gotoURL($location)
//{
//    header("location:$location");
//    exit;
//}

function goToURL($location) {
    header("location:$location");
    exit;
}

function getMenu($otmp_user) {
    //$otmp_user = new tmp_user();
    $result = $otmp_user->SelectRecord(array('us_menu'), array('us_id' => $_SESSION['us_id']), MYSQL_ASSOC, false);

    if ($result) {
        return $result['us_menu'];
    } else {
        return "";
    }
}

function authenticate($oLog, $isDebug = false) {
    global $_REQUEST, $_SESSION, $_POST;
    global $cAction;
    global $us_id, $us_fname, $us_lname, $us_email, $us_username, $us_active;
    global $logUpdDte, $logStatus;
	
    //$oLog   = new app_log();
    session_destroy();
    session_start();

    if ((!$_SESSION['us_id']) && ($cAction == 'LoginDone')) {
        $stmt = " SELECT u.us_id, u.us_fname, u.us_lname,
					u.us_email, u.us_username, u.us_img, g.gr_id
					FROM usr u, grp g
					WHERE u.us_isactive = 1 
                                        AND u.us_gr_id = g.gr_id
					AND lower(us_username) = lower(" . MySQL::SQLValue($_POST['us_username'], mysql::SQLVALUE_TEXT) . ")
					AND us_password = md5(" . MySQL::SQLValue($_POST['us_password'], mysql::SQLVALUE_TEXT) . ")";
        
        $oLog->SelectQuery($stmt);
		
        if (!$oLog->EOF()) {
            $usrrow = $oLog->Row();
			
            if ($usrrow->us_id) {
                $stmt = " SELECT DISTINCT us_id, log_upddte, log_outdte, log_islogged
                            FROM app_log
                            WHERE us_id = {$usrrow->us_id}
                            AND (log_islogged = 0 OR (log_islogged = 1 AND log_outdte IS NULL))
                            ORDER BY log_islogged DESC";
                $oLog->selectQuery($stmt);
				
                $logrow = $oLog->Row();
                if ((!$oLog->EOF()) || ($logrow->log_islogged == 0) || (($logrow->log_islogged == 1) && (in2_date_diff($logrow->log_upddte, date('Y-m-d H:i:s'), 'ONLY_SECOND') > MAX_LOG_SESSION))) {
                    $_SESSION['us_id'] = $usrrow->us_id;
                    $_SESSION['us_fname'] = $usrrow->us_fname;
                    $_SESSION['us_lname'] = $usrrow->us_lname;
                    $_SESSION['us_email'] = $usrrow->us_email;
					$_SESSION['us_img'] = $usrrow->us_img;
                    $_SESSION['us_username'] = $usrrow->us_username;
                    $_SESSION['gr_id'] = $usrrow->gr_id;

                    $_SESSION['logUpdDte'] = date('Y-m-d H:i:s');
                    $_SESSION['lang'] = 'en';
                    if ($logrow->log_islogged == 1) {
                        $stmt = " UPDATE app_log SET log_outdte = NOW(), log_islogged = 0
							        WHERE us_id = {$_SESSION['us_id']}";

                        $oLog->execute($stmt, $isDebug);
                    }
                    $stmt = " INSERT INTO app_log (log_sessid, us_id, log_indte, log_upddte, log_ip, log_islogged)
				 			VALUES ('{$_REQUEST['PHPSESSID']}', {$_SESSION['us_id']}, NOW(), NOW(), '{$_SERVER['REMOTE_ADDR']}', 1);";

                    $oLog->execute($stmt, $isDebug);
                } else {
                	
                    $_SESSION['logStatus'] = 'AlreadyLoggedIn';
                }
            }
        }
    }
}

function splitvalue($value) {
    $getvalue = $value;
    if (strpos($getvalue, '?') > -1) {
        $getvalue = substr($getvalue, 0, strpos($getvalue, '?'));
    }
    if (strrpos($getvalue, '/') > -1) {
        $getvalue = substr($getvalue, strrpos($getvalue, '/') + 1);
    }
    $getvalue = str_replace('.remote.', '.', $getvalue);
    $getvalue = str_replace('.form.', '.', $getvalue);

    /**
     * Added by JBC on 2010-07-14 @ 6:45 PM
     */
    $getvalue = str_replace('.report.', '.', $getvalue);

    /**
     * Added by JBC on 2011-02-16 @ 1:45 PM
     */
    $getvalue = str_replace('.listing_report.', '.', $getvalue);

    return $getvalue;
}

function UserIsVerify($getcurrentform, $isDebug = false) {
    if ($_SESSION['us_id']) {
        /*
          if ($_SESSION['logUpdDte']) {
          if (in2_date_diff($_SESSION['logUpdDte'], date('Y-m-d H:i:s'), 'ONLY_SECOND') > MAX_LOG_SESSION) {
          $Statement = "  UPDATE sys_log SET log_upddte = NOW(), log_outdte = NOW(), log_islogged = 0
          WHERE log_sessid = '".$_REQUEST['PHPSESSID']."'
          AND log_outdte IS NULL";

          $oUser->ExecuteStatement($Statement, $isDebug, null, null, $ReturnData = false);

          session_destroy();

          $_SESSION = array();

          gotoURL("index.php");
          } else {
          $_SESSION['logUpdDte'] = date('Y-m-d H:i:s');

          $Statement = "  UPDATE sys_log SET log_upddte = NOW()
          WHERE log_sessid = '".$_REQUEST['PHPSESSID']."'
          AND log_outdte IS NULL;";

          $oUser->ExecuteStatement($Statement, $isDebug, null, null, $ReturnData = false);
          }
          }
         */
    } else {
        session_destroy();

        $_SESSION = array();

        gotoURL("index.php");
    }

    $verCurrentForm = $getcurrentform;
    //$verForm=strtolower($this->splitvalue($verForm));
    $verCurrentForm = strtolower(splitvalue($getcurrentform));

//                var_dump($verCurrentForm); exit;

    if ($_REQUEST["frmParam"]) {
        $verCurrentForm .= '?frmParam=' . $_REQUEST["frmParam"];
    }

    if ($verCurrentForm != 'main.php' && $verCurrentForm != 'chgpassform.php') {
        $oFrm = new form();
        $stmt = "	SELECT 1 FROM page p, grp_page g
                                        WHERE g.gpx_pg_id = p.pg_id AND g.gpx_gr_id=" . $_SESSION['gr_id'] . "
                                        AND lower(trim(pg_href))=lower(trim('{$verCurrentForm}'))";
        //AND lower(left(pg_href,length('{$verCurrentForm}')))='{$verCurrentForm}'";
        //var_dump($_SESSION['gr_id']);
        $oFrm->execute($stmt, false);
//                        exit;
        if ($oFrm->EOF()) {
            gotoURL("index.php");
        }
    }
}

function genTableList($listName, $className, $stmt = null, $valueField, $labelField, $isDebug = true, $valueNull = true, $labelNull = '--- Select ---', $selectedVal = null, $listClass = null, $listStyle = null, $onChange = null, $additional = null, $where = null, $nullValue = null) {
    global $_SESSION, $arrLang;
    global $obj;

    $ConIsImported = false;

    if ($obj) {
        $objGenTableList = new $className(false);

        if ($obj->IsConnected()) {
            $objGenTableList->importConnection($obj);
            $ConIsImported = true;
        } else {
            $objGenTableList->Open();
        }
    } else {
        $objGenTableList = new $className();
    }

    if (!$stmt) {
        $stmt = " SELECT $valueField, $labelField
                    FROM $className
                    $where";
    }

    if (!strpos(strtoupper($stmt), 'ORDER BY')) {
        $stmt .= "
                ORDER BY $labelField";
    }
    $objGenTableList->selectQuery($stmt, $isDebug);
    $cnt = $objGenTableList->RowCount();

    if (!$cnt) {
        return "<input type=\"hidden\" name=\"$listName\" id=\"$listName\" />Table must be populated first.";
    }

    /**
     * Build the list
     */
    $sel = '<select id="' . $listName . '" name="' . $listName . '" ' . 'onChange="' . $onChange . '" class="' . $listClass . '" style="' . $listStyle . '" ' . $additional . '>';

    if ($valueNull) {
        //if ($nullValue != null){
        //   $sel  .= '<option value="'.$nullValue.'">' . $labelNull . '</option>'; 
        //}else{
        $sel .= '<option value="' . $nullValue . '">' . $labelNull . '</option>';
        //}
    }


    while (!$objGenTableList->EOF()) {
        $objGenTableListRow = $objGenTableList->Row();

        if ($selectedVal == $objGenTableListRow->$valueField) {
            $selected = 'SELECTED';
        } else {
            $selected = '';
        }

        $sel .= '<option value="' . $objGenTableListRow->$valueField . '" ' . $selected . '>' . $objGenTableListRow->$labelField . '</option>';
    }

    $sel .= '</select>';

    if ($ConIsImported) {
        $objGenTableList->clearObjectProperties();
    }
    return $sel;
}

/**
 * Generate Banner Section
 *
 * @param connection $object
 * @param integer $position
 * @param integer $interval
 * @return string
 */
function getBanner($object, $position, $interval = 2000) {
    if (!$object) {
        $object = new banner();
    }

    $object->Select(array('bn_title', 'bn_photo_img', 'bn_href', 'bn_company'), '', " WHERE bn_position = $position", null, null, false);

    $cntRows = $object->RowCount();

    switch ($position) {
        case 1:
            $wImg = 186;
            $hImg = 199;

            break;

        case 2:
            $wImg = 187;
            $hImg = 153;

            break;

        case 3:
        case 4:
            $wImg = 187;
            $hImg = 70;

            break;

        case 5:
            $wImg = 209;
            $hImg = 176;

            break;
    }

    if ($cntRows) {
        if (1 == $cntRows) {
            $row = $object->Row();

            if ($row->bn_href) {
                $href = "href=\"{$row->bn_href}\" target=\"_blank\"";
            }

            $banner = "<a id=\"banner{$position}_a\" $href ><img src=\"" . PROJECT_UPLOAD_URL . $row->bn_photo_img . "\" title=\"{$row->bn_title}\" alt=\"{$row->bn_title}\" width=\"$wImg\" height=\"$hImg\" id=\"banner{$position}\" border=\"0\" /></a>";
        } else {
            while (!$object->EOF()) {
                $row = $object->Row();

                if (!$banner) {
                    $i = 0;

                    $banner = "
<a id=\"banner{$position}_a\" target=\"_blank\" ><img src=\"" . PROJECT_UPLOAD_URL . $row->bn_photo_img . "\" title=\"{$row->bn_title}\" alt=\"{$row->bn_title}\" width=\"$wImg\" height=\"$hImg\" id=\"banner$position\" border=\"0\" /></a>
<script type=\"text/javascript\">
    var banner{$position}Arr    = new Array();
    var banner{$position}HRef   = new Array();
    var banner{$position}Title  = new Array();
	";
                } else {
                    ++$i;
                }

                $banner .= "
    banner{$position}Arr[$i]    = '" . PROJECT_UPLOAD_URL . $row->bn_photo_img . "';
    banner{$position}HRef[$i]   = '" . $row->bn_href . "';
    banner{$position}Title[$i]  = '" . $row->bn_title . "';";

                $imgArrLoad[] = "'" . PROJECT_UPLOAD_URL . $row->bn_photo_img . "'";
            }

            $banner .= "
            
    slideAdIni('banner$position', $interval);
    
    jQuery().ready(function() {
        MM_preloadImages(" . implode(', ', $imgArrLoad) . ");
    });
</script>";
        }
    } else {
        $banner = "<img src=\"img/img_banner$position.jpg\" width=\"$wImg\" height=\"$hImg\" id=\"banner$position\" />";
    }

    return $banner;
}

function getTitleFromMenuCaption($title) {
    return $title;
}

/**
 * Generate list box from array
 *
 * @author Elie haddad
 * @copyright 06-01-2009
 * @param string $listName
 * @param string $listArray
 * @param boolean $valueNull
 * @param string $labelNull
 * @param string $selectedVal
 * @param string $listClass
 * @param string $listStyle
 * @param string $onChange
 * @return string
 */
function genArrayList($listId, $listArray, $valueNull = true, $labelNull = '--- Select ---', $selectedVal = null, $listClass = null, $listStyle = null, $onChange = null, $additional = null, $listName = null) {
    global $arrLang;

    /**
     * Build the list
     */
    if (!$listName) {
        $listName = $listId;
    }
    $sel = '<select id="' . $listId . '" name="' . $listName . '" ' . 'onChange="' . $onChange . '" class="' . $listClass . '" style="' . $listStyle . '" ' . $additional . '>';

    if ($valueNull) {
        $sel .= '<option value="">' . $labelNull . '</option>';
    }

    $lenArray = count($listArray);

    foreach ($listArray as $key => $value) {
        if ($selectedVal == strval($key)) {
            $selected = 'SELECTED';
        } else {
            $selected = '';
        }

        $sel .= '
            <option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
    }

    $sel .= '
	</select>';

    return $sel;
}

/**
 * Return Chapters Menu and Submenus
 *
 * @param connection $object
 * @return string
 */
function getChapters($object) {
    if (!$object) {
        $object = new chapter();
    }

    $object->Select(array('ch_id', 'ch_title'), '', null, 1, null, false);

    $cntRows = $object->RowCount();

    if (!$cntRows) {
        $chapters = '<div class="menuitem" id="chapters"><a href="chapters.php">Chapters</a></div>';
    } else {
        $chapters = '
        <div class="menuitem" id="chapters"><a href="javascript:revelerCacherSousNav(\'chapters\')">Chapters</a></div>
        <div id="chapters_sub" style="display: none">
            <div class="hiddendiv">';

        while (!$object->EOF()) {
            $row = $object->Row();

            $chapters .= '
                    <div class="linksstyle"><a href="chapters.php?ch_id=' . $row->ch_id . '" id="chapters_sub_' . $row->ch_id . '">' . $row->ch_title . '</a></div>
                    <br style="line-height:2px;" />';
        }

        $chapters .= '
            </div> 
            <div class="bordertop1pxblue"></div>
        </div>';
    }

    return $chapters;
}

/**
 * Show Template
 *
 * @author Jad Bou Chebl
 * @version 2009-01-10
 * @param string $template
 */
function showTpl($template) {
    global $_SESSION;
    global $cssIncludes, $jsIncludes, $id1, $id2, $jsOnReady, $title, $content;

    $tpl = file_get_contents(PROJECT_TPL_PATH . $template);

    $tpl = str_replace("\$projectName", PROJECT_NAME, $tpl);

    /**
     * Manage user variables
     */
    ($cssIncludes ? $tpl = str_replace("\$cssIncludes", $cssIncludes, $tpl) : $tpl = str_replace("\$cssIncludes", "", $tpl));
    ($jsIncludes ? $tpl = str_replace("\$jsIncludes", $jsIncludes, $tpl) : $tpl = str_replace("\$jsIncludes", "", $tpl));
    ($id1 ? $tpl = str_replace("\$id1", $id1, $tpl) : $tpl = str_replace("\$id1", "", $tpl));
    ($id2 ? $tpl = str_replace("\$id2", $id2, $tpl) : $tpl = str_replace("\$id2", "", $tpl));
    ($jsOnReady ? $tpl = str_replace("\$jsOnReady", $jsOnReady, $tpl) : $tpl = str_replace("\$jsOnReady", "", $tpl));
    ($title ? $tpl = str_replace("\$title", $title, $tpl) : $tpl = str_replace("\$title", "", $tpl));
    ($content ? $tpl = str_replace("\$content", $content, $tpl) : $tpl = str_replace("\$content", "", $tpl));

    /**
     * Manage common includes
     */
    $tpl = str_replace("\$left_menu", file_get_contents(PROJECT_PATH . 'ssi/left_menu.html'), $tpl);
    $tpl = str_replace("\$chapters", getChapters(null), $tpl);
    $tpl = str_replace("\$banner1", getBanner(null, 1), $tpl);
    $tpl = str_replace("\$under_banner_left", file_get_contents(PROJECT_PATH . 'ssi/under_banner_left.html'), $tpl);
    $tpl = str_replace("\$login", include ($_SESSION['fe_us_id'] ? 'ssi/logout.php' : 'ssi/login.php'), $tpl);
    $tpl = str_replace("\$right_links", include 'ssi/right_links.php', $tpl);
    $tpl = str_replace("\$under_right_links", include 'ssi/under_right_links.php', $tpl);
    $tpl = str_replace("\$banner5", getBanner(null, 5), $tpl);
    $tpl = str_replace("\$footer", file_get_contents(PROJECT_PATH . 'ssi/footer.html'), $tpl);

    print $tpl;

    exit;
}

/**
 * Send mail
 *
 * @param string $subject
 * @param string $body
 * @param string $fromEmail
 * @param string $toEmail
 * @param string $ccEmail
 * @param string $bccEmail
 * @param string $attachement
 * @param string $bodyEncoding
 * @param integer $priority
 */
function sendMail($subject, $body, $fromEmail, $toEmail, $ccEmail = null, $bccEmail = null, $attachement = null, $bodyEncoding = 'utf-8', $priority = 1) {
    $oMail = new email();

    $oMail->From($fromEmail);
    $oMail->To($toEmail);

    if ($ccEmail) {
        $oMail->Cc($ccEmail);
    }

    if ($bccEmail) {
        $oMail->Bcc($bccEmail);
    }

    $oMail->Subject($subject);
    $oMail->Body($body, $bodyEncoding, "text/html");
    $oMail->Priority($priority);

    if ($attachement) {
        $oMail->Attach($attachement, "application/x-unknown-content-type", "attachment");
    }

    $oMail->Send();
}

/**
 * GetBarOfPages_2($iPageSize, $iCurrPage, $Number, $Lan)
 *
 * @param INTEGER	$iPageSize
 * @param INTEGER	$iCurrPage
 * @param INTEGER	$Number 
 * @param STRING	$Lan		(Default = 'EN')
 */
function GetBarOfPages_2($iPageSize, $iCurrPage, $Number) {
    $total = "<b>Total ($Number)</b> ";
    $maxPage = ceil($Number / $iPageSize);
    $nav = ' - Page ';

    for ($page = 1; $page <= $maxPage; $page++) {
        if ($page == $iCurrPage)
            $nav .= $page;   // no need to create a link to current page 
        else
            $nav .= " <a href=\"javascript:document.Bar.iCurrPage.value='$page';document.Bar.submit();\" >$page</a> ";
    }

    /**
     * Creating Previous and Next Links
     * plus the First and Last Links.
     */
    if ($iCurrPage > 1) {
        $page = $iCurrPage - 1;

        $prev = " [<a href=\"javascript:document.Bar.iCurrPage.value=" . $page . ";document.Bar.submit();\" >Prev</a>] ";
        $first = " [<a href=\"javascript:document.Bar.iCurrPage.value=1;document.Bar.submit();\" >First</a>] ";
    } else {
        $prev = '&nbsp;'; // we're on page one, don't print previous link 
        $first = '&nbsp;'; // nor the first page link 
    }

    if ($iCurrPage < $maxPage) {
        $page = $iCurrPage + 1;

        $next = " [<a href=javascript:document.Bar.iCurrPage.value=" . $page . ";document.Bar.submit(); >Next</a>] ";
        $last = " [<a href=javascript:document.Bar.iCurrPage.value=" . $maxPage . ";document.Bar.submit(); >Last</a>] ";
    } else {
        $next = '&nbsp;'; // we're on the last page, don't print next link 
        $last = '&nbsp;'; // nor the last page link 
    }

    $PagesBar .= '<table  border="0" cellspacing="0" cellpadding="0" align=' . $Dir . ' ><tr><td class="txt">' . $first . $prev . $total . $nav . $next . $last . '</td></tr></table>';

    return $PagesBar;
}

function pagingBar($rowCnt, $pageCurrent, $pageSize = MAX_PAGE_RECORDS) {
    $maxPage = ceil($rowCnt / $pageSize);
    $nav = "Page <span class=\"currentPage\">$pageCurrent</span> of $maxPage";

    if ($pageCurrent > 1) {
        $page = $pageCurrent - 1;

        $prev = " <a href=\"javascript:goPage(" . $page . ");\" >Prev</a> ";
        $first = " <a href=\"javascript:goPage(1);\" >First</a>";
    } else {
        $prev = '&nbsp;'; // we're on page one, don't print previous link 
        $first = '&nbsp;'; // nor the first page link 
    }

    if ($pageCurrent < $maxPage) {
        $page = $pageCurrent + 1;

        $next = " <a href=\"javascript:goPage(" . $page . ");\" >Next</a> ";
        $last = " <a href=\"javascript:goPage(" . $maxPage . ");\" >Last</a> ";
    } else {
        $next = '&nbsp;'; // we're on the last page, don't print next link 
        $last = '&nbsp;'; // nor the last page link 
    }

    return '<div class="pagingDiv">' . $first . $prev . $nav . $next . $last . '</div>
            <script type="text/javascript">
                function goPage(pageNbr) {
                    var oFrm    = document.getElementById(\'pagingFrm\');
                    
                    oFrm.pageCurrent.value  = pageNbr;
                    
                    oFrm.submit();
                }
            </script>';
}

/**
 * Format Form Fields Errors
 *
 * @param array $errors
 * @return string
 */
function formatFormErrors($errors) {
    global $arrLang, $_SESSION;

    foreach ($errors as $key => $error) {
        $notification .= str_replace($key, $arrLang[$_SESSION['lang']][$key . 'Lbl'], (($notification ? '<br />' : '') . '- ' . $error));
    }

    return $notification;
}

/**
 * Print formatted array content
 */
function printArr($array, $color = null, $return = false) {
    if ($return) {
        return '<pre><font color="' . $color . '">' . print_r($array, true) . '</font></pre>';
    } else {
        print '<pre><font color="' . $color . '">' . print_r($array, true) . '</font></pre>';
    }
}

/**
 * Checks if the value of $FieldName exists in $tableName for a certain condition $Where
 *
 * @author Jad Bou Chebl
 * @copyright 28-09-2007
 * @param STRING $object
 * @param STRING $tableName
 * @param STRING $fieldName
 * @param STRING $where
 * @return null OR $fieldName Value
 */
function chkIfExist($object, $fieldName, $chkConstraint, $isDebug) {
    if ($chkConstraint) {
        $chkConstraint = "AND $chkConstraint";
    }

    $object->Select(array($fieldName), '', " WHERE 1 = 1 $chkConstraint", null, null, $isDebug);

    $cntRows = $object->RowCount();

    $row = $object->Row();

    if ($cntRows) {
        return $row->$fieldName;
    } else {
        return null;
    }
}

/**
 * Check if user is signed in
 *
 */
function chkFePage() {
    global $_SESSION;
    global $pagePriv;

    if (!$_SESSION['fe_security']) {
        gotoURL("index.php?NotAuthorized=1");
    }

    if (!$pagePriv) {
        return null;
    }

    $find = array_search($_SESSION['fe_security'], $pagePriv);

    if (!is_bool($find)) {
        if ($find == 0) {
            $find = true;
        }
    }

    if ($find == false) {
        gotoURL("index.php?NotAuthorized=1");
    }

    if (!$_SESSION['fe_us_id']) {
        gotoURL("index.php?NotAuthorized=1");
    }
}

/**
 * Get directory listing
 *
 * @param string $folder
 * @param string $type
 * @param boolean $returnFirst
 * @return string
 */
function listDirContent($folder, $type = null, $returnFirst = false, $wExt = true) {
    if ($handle = opendir($folder)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != "..") {
                if ($wExt) {
                    $label = $file;
                } else {
                    $extension = split("\.", $file);
                    $label = $extension[0];
                }

                switch ($type) {
                    case 'select':
                        if ($returnFirst) {
                            return PROJECT_UPLOAD_URL . "$folder/$file";
                        } else {
                            //$list	.= "<option value=\"".PROJECT_UPLOAD_URL."$folder/$file\">$file</option>";
                            $list .= "<option value=\"" . PROJECT_UPLOAD_URL . "$folder/$file\">$label</option>";
                        }

                        break;

                    default:
                        if ($returnFirst) {
                            return $file;
                        } else {
                            //$list	.= "$file\n";
                            $list .= "$label\n";
                        }

                        break;
                }
            }
        }

        closedir($handle);
    }

    return $list;
}

/**
 * Build MySQL (NESTED) IF statement from ARRAY
 *
 * @param array $array
 * @param string $fieldName
 * @return string
 */
function buildMySQLIfFromArray($array, $fieldName) {
    $cnt = count($array);

    if ($cnt < 2) {
        return null;
    }

    $i = 1;

    foreach ($array as $key => $value) {
        if ($i == $cnt) {
            $ifStmt .= "'$value'";
        } else {
            $ifStmt .= "IF($fieldName = '$key', '$value', ";

            $ifStmtEnd .= ")";
        }

        $i++;
    }

    return $ifStmt . $ifStmtEnd;
}

function AddDate($p_date, $p_number, $p_interval, $p_dateFormat = PHPDATEFORMAT) {
    $newdate = strtotime("$p_number $p_interval", strtotime($p_date));

    $newdate = date($p_dateFormat, $newdate);

    return $newdate;
}

function number_to_words($number) {
    if ($number > 999999999) {
//        throw new Exception("Number is out of range");
        $result = "Number is out of range";
    }

    $Gn = floor($number / 1000000);  /* Millions (giga) */
    $number -= $Gn * 1000000;
    $kn = floor($number / 1000);     /* Thousands (kilo) */
    $number -= $kn * 1000;
    $Hn = floor($number / 100);      /* Hundreds (hecto) */
    $number -= $Hn * 100;
    $Dn = floor($number / 10);       /* Tens (deca) */
    $n = $number % 10;               /* Ones */
    $cn = round(($number - floor($number)) * 100); /* Cents */
    $result = "";

    if ($Gn) {
        $result .= number_to_words($Gn) . " Million";
    }

    if ($kn) {
        $result .= (empty($result) ? "" : " ") . number_to_words($kn) . " Thousand";
    }

    if ($Hn) {
        $result .= (empty($result) ? "" : " ") . number_to_words($Hn) . " Hundred";
    }

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six",
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen",
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen",
        "Nineteen");
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty",
        "Seventy", "Eigthy", "Ninety");

    if ($Dn || $n) {
        if (!empty($result)) {
            $result .= " and ";
        }

        if ($Dn < 2) {
            $result .= $ones[$Dn * 10 + $n];
        } else {
            $result .= $tens[$Dn];
            if ($n) {
                $result .= "-" . $ones[$n];
            }
        }

    }
    
    if ($cn) {
        if (!empty($result)) {
            $result .= ' and ';
        }
        $title = $cn == 1 ? 'cent ' : 'cents';
        $result .= strtolower(number_to_words($cn)) . ' ' . $title;
    }

    if (empty($result)) {
        $result = "zero";
    }

    return $result;
}

?>