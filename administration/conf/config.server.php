<?php
/**
 * Headers section for multi-language support and caching control
 */
header("Expires: Mon, 1 Jan 2007 00:00:01 GMT");                // Date in the past

header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");  // Always modified

header("Content-Type: text/html; charset=utf-8;");

header("Cache-Control: no-store, no-cache, must-revalidate");   // HTTP 1.1
header("Cache-Control: post-check=0, pre-check=0", false);

header("Pragma: no-cache");                                     // HTTP 1.0

ini_set('display_errors', 'Off');
error_reporting(0);

/**
 * Database credentials
 */
define('DBTYPE',    'mysql');

//offline credentials
define('DBHOST',    'localhost');
define('DBUSER',    'root');
define('DBPASS',    '');
define('DBNAME',    'pso_db');

//define('DBHOST',    'localhost');
//define('DBUSER',    'intwohos_energy');
//define('DBPASS',    'xTL-FH}%E&TU');
//define('DBNAME',    'intwohos_energyone');
define('DBPORT', '3306');

/**
 * Project's related constants
 */
define('REGISTRATION_EMAIL',         'info@pso.com',      true);
define('PROJECT_EMAIL',         'registration@pso.com',      true);
define('PROJECT_URL',           'http://localhost/pso/',      true);
define('PROJECT_PATH',          'C:/wamp/www/pso/',                true);


//online credentials
//define('PROJECT_URL',           'http://solutions.in2host.net/energyone/',      true);
//define('PROJECT_PATH',          '/home1/intwohos/public_html/solutions/energyone/', true);


/**
 * Project's related constants
 */
define('PROJECT_NAME',          'E1 Holding',                        true);

define('RESET_PASSWORD_TO',     'e1Holding');

define('BO_PATH',               PROJECT_PATH    . 'administration/',               true);
define('BO_URL',                PROJECT_URL     . 'administration/',               true);
define('CONFIG_PATH',           BO_PATH         . 'conf/',          true);
define('LIBRARY_PATH',          BO_PATH         . 'lib/',           true);
define('CLASS_PATH',            BO_PATH         . 'cls/',           true);
define('PROJECT_TPL_PATH',      PROJECT_PATH    . 'tpl/',           true);
define('BACKUP_PATH',           BO_PATH         . 'bkp/',           true);
define('REPORTS_PATH',          BO_PATH         . 'reports/',       true);

define('PROJECT_UPLOAD_PATH',       BO_PATH        . 'upl/',       true);
define('PROJECT_UPLOAD_URL',        BO_URL         . 'upl/',       true);
define('PROJECT_UPLOAD_LRG_PATH',   PROJECT_UPLOAD_PATH . 'large/',       true);
define('PROJECT_UPLOAD_LRG_URL',    PROJECT_UPLOAD_URL  . 'large/',       true);
define('PROJECT_UPLOAD_BIG_PATH',   PROJECT_UPLOAD_PATH . 'big/',       true);
define('PROJECT_UPLOAD_BIG_URL',    PROJECT_UPLOAD_URL  . 'big/',       true);
define('PROJECT_UPLOAD_MEDBIG_PATH',   PROJECT_UPLOAD_PATH . 'mediumbig/',    true);
define('PROJECT_UPLOAD_MEDBIG_URL',    PROJECT_UPLOAD_URL  . 'mediumbig/',    true);
define('PROJECT_UPLOAD_MED_PATH',   PROJECT_UPLOAD_PATH . 'medium/',    true);
define('PROJECT_UPLOAD_MED_URL',    PROJECT_UPLOAD_URL  . 'medium/',    true);
define('PROJECT_UPLOAD_SML_PATH',   PROJECT_UPLOAD_PATH . 'small/',     true);
define('PROJECT_UPLOAD_SML_URL',    PROJECT_UPLOAD_URL  . 'small/',     true);
define('PROJECT_UPLOAD_BO_PATH',   PROJECT_UPLOAD_PATH . 'bo/',     true);
define('PROJECT_UPLOAD_BO_URL',    PROJECT_UPLOAD_URL  . 'bo/',     true);


/* story section photo sizes */
define('FEATURED_PHOTO_BO',    '100x100',     true);
define('FEATURED_PHOTO_SML',    '',     true);
define('FEATURED_PHOTO_MED',    '',     true);
define('FEATURED_PHOTO_BIG',    '1200x800',     true);
define('FEATURED_PHOTO_MEDBIG', '',     true);
define('FEATURED_PHOTO_LRG',    '',     true);

/* residence section photo sizes */
define('NEWS_PHOTO_BO',    '100x100',     true);
define('NEWS_PHOTO_SML',    '200x200',     true);
define('NEWS_PHOTO_MED',    '250x150',     true);
define('NEWS_PHOTO_BIG',    '750x450',     true);
define('NEWS_PHOTO_MEDBIG', '',     true);
define('NEWS_PHOTO_LRG',    '',     true);

/* residence section photo sizes */
define('NEWS_IMG_PHOTO_BO',    '100x100',     true);
define('NEWS_IMG_PHOTO_SML',    '200x200',     true);
define('NEWS_IMG_PHOTO_MED',    '600x600',     true);
define('NEWS_IMG_PHOTO_BIG',    '750x450',     true);
define('NEWS_IMG_PHOTO_MEDBIG', '',     true);
define('NEWS_IMG_PHOTO_LRG',    '',     true);

/* residence section photo sizes */
define('PROJECTS_CAT_PHOTO_BO',    '100x100',     true);
define('PROJECTS_CAT_PHOTO_SML',    '70x70',     true);
define('PROJECTS_CAT_PHOTO_MED',    '',     true);
define('PROJECTS_CAT_PHOTO_BIG',    '',     true);
define('PROJECTS_CAT_PHOTO_MEDBIG', '',     true);
define('PROJECTS_CAT_PHOTO_LRG',    '',     true);


/* residence section photo sizes */
define('PROJECTS_PHOTO_BO',    '100x100',     true);
define('PROJECTS_PHOTO_SML',    '200x120',     true);
define('PROJECTS_PHOTO_MED',    '360x360',     true);
define('PROJECTS_PHOTO_BIG',    '765x570',     true);
define('PROJECTS_PHOTO_MEDBIG', '',     true);
define('PROJECTS_PHOTO_LRG',    '',     true);


/* residence section photo sizes */
define('STATICPAGE_PHOTO_BO',    '100x100',     true);
define('STATICPAGE_PHOTO_SML',    '',     true);
define('STATICPAGE_PHOTO_MED',    '',     true);
define('STATICPAGE_PHOTO_BIG',    '750x450',     true);
define('STATICPAGE_PHOTO_MEDBIG', '',     true);
define('STATICPAGE_PHOTO_LRG',    '',     true);

/* residence section photo sizes */
define('SLIDEHOME_PHOTO_BO',    '100x100',     true);
define('SLIDEHOME_PHOTO_SML',    '',     true);
define('SLIDEHOME_PHOTO_MED',    '',     true);
define('SLIDEHOME_PHOTO_BIG',    '1343x806',     true);
define('SLIDEHOME_PHOTO_MEDBIG', '',     true);
define('SLIDEHOME_PHOTO_LRG',    '',     true);

define('IMG_MAX_SIZE',          10240,                              true);  // KBytes
define('MAX_FILE_SIZE',         10240,                               true);  // KBytes
define('MAX_PAGE_RECORDS',      15,                                 true);  // KBytes
define('IMG_EXTENSION',         'jpg|jpeg|gif|png',                 true);
define('DOC_EXTENSION',         'doc|docx|xls|xlsx|pdf|txt|zip',    true);
define('VID_EXTENSION',         'mpg|mpeg|wmv',    true);
define('MAX_LOG_SESSION',       3000);
define('DATEFORMAT',            'dd/mm/yyyy');

define('DECIMAL_NUMBER',        '6');
define('DECIMAL_SEPERATOR',     ',');
define('THOUSAND_SEPERATOR',    '.');

define('DELETE_PHYSICAL',       true);
define('DELETE_FIELD_NAME',     '_deleted');

include_once LIBRARY_PATH   . 'mysql.class.php';
include_once LIBRARY_PATH   . 'form.class.php';
//include_once LIBRARY_PATH   . 'resize-class.php';
include_once LIBRARY_PATH   . 'php_image_magician.php';
include_once LIBRARY_PATH   . 'file.class.php';
include_once LIBRARY_PATH   . 'file2.class.php';
include_once LIBRARY_PATH   . 'functions.php';
include_once LIBRARY_PATH   . 'email.class.php';

include_once LIBRARY_PATH   . 'FPDF/class.fpdf.php';
include_once LIBRARY_PATH   . 'FPDF/class.fpdi.php';
include_once LIBRARY_PATH   . 'FPDF/class.fpdf_protection.php';
include_once LIBRARY_PATH   . 'FPDF/class.pdf_mc_table.php';

include_once CLASS_PATH     . 'tmp_user.class.php';

include_once 'arrays.php';

/**
 * Start session
 */
session_start();

ini_set('max_execution_time', 300); //300 seconds = 5 minutes

?>