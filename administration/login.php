<?php

include_once "conf/config.server.php";
include_once "cls/app_log.class.php";
include_once CLASS_PATH . 'usr.class.php';

$LoginStatus	= '';

$obj    = new usr();

switch ($_REQUEST['cAction']) {
	
	case 'Logout':
	session_destroy();
	$oLog   = new app_log();
	$stmt   = " UPDATE app_log SET log_upddte = NOW(), log_outdte = NOW(), log_islogged = 0 
	WHERE log_sessid = '{$_REQUEST['PHPSESSID']}'
	AND log_outdte IS NULL";

	$oLog->execute($stmt,$isDebug);

	goToURL("index.php");

	break;

	case 'AlreadyLoggedIn':
	session_destroy();

	goToURL("index.php?AlreadyLoggedIn=1");

	break;

	case 'InvalidCreds':
	session_destroy();
	goToURL("index.php?InvalidCreds=1");

	break;

	case 'RememberMe':


	break;
	
	case 'forgotpassword':
	if ($_REQUEST['us_username'] && !$_REQUEST['us_password']) {

		$obj->Select(array('us_id','us_fname', 'us_lname', 'us_email'),'', 'WHERE us_email = \'' . $_REQUEST['us_username'] . '\' Or us_username = \'' . $_REQUEST['us_username'] .'\'' , 1, null, false);   

		$cntObj = $obj->RowCount();             

		if ($cntObj) {    

			while (!$obj->EOF()) { 
				$rowObj    = $obj->Row() ; 
				$us_id     = $rowObj->us_id; 
				$firstName = $rowObj->us_fname;
				$lastName  = $rowObj->us_lname;
				$email     = $rowObj->us_email;
			}

			$newpass = RESET_PASSWORD_TO . rand(11111,99999);
			$_REQUEST['us_isactive'] = 1;
			$_REQUEST['us_password'] = md5($newpass);
			$_REQUEST['us_id'] = $us_id;

			$obj->UpdateRequest(false);

		        /**
		         * Send email
		         */
		        $content    = '
		        <table border="0" cellpadding="2" cellspacing="2" >
		        <tr>
		        <th align="left" >Name: </th>
		        <td align="left" >'. $firstName .' '. $lastName .'</td>
		        </tr>
		        <tr>
		        <th align="left" >New Password: </th>
		        <td align="left" >'. $newpass .'</td>
		        </tr>
		        </table>';
		        
		        sendMail('Password Reset' , $content, PROJECT_EMAIL, $email);

		        goToURL("index.php?EmailSent=1");
		    } else {
		    	goToURL("index.php?InvalidCreds=1");
		    }
		} else {
			goToURL("index.php?EnterUsername=1");
		}

		break;		

		default:
		$cAction	= 'LoginDone';

		if (!$_SESSION['us_id']) {
			$oLog   = new app_log();
			authenticate($oLog, false);
		}

		if (!$_SESSION['us_id']) {
			if ($_SESSION['logStatus'] == 'AlreadyLoggedIn') {
				goToURL("login.php?cAction=AlreadyLoggedIn");
			} else {
				goToURL("login.php?cAction=InvalidCreds");
			}
		} else {	
			
			goToURL("menubuild.php");

		}

		break;
	}

	?>