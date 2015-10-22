<?php 

class pso_slider extends Form
{
	//  Constructor
	function __construct($connect = true, $database = null, $server = null, $username = null, $password = null, $charset = null, $port = null)
	{
		parent::__construct($connect, $database, $server, $username, $password, $charset, $port);

		$this->TableName	= "pso_slider";
		$this->TableID["sl_id"]	= array("colType" => MySQL::SQLVALUE_NUMBER, "colSort" => 0, "colSortOrder" => 0);

		$Col	= array();

		$Col["sl_title"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["sl_desc"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["sl_order"]	= array("colType" => MySQL::SQLVALUE_NUMBER, "colSort" => 0, "colSortOrder" => 0);
		$Col["sl_link"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["sl_published"]	= array("colType" => MySQL::SQLVALUE_NUMBER, "colSort" => 0, "colSortOrder" => 0);
		$Col["sl_cruser"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["sl_crdate"]	= array("colType" => MySQL::SQLVALUE_DATE, "colSort" => 0, "colSortOrder" => 0);
		$Col["sl_mduser"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["sl_mddate"]	= array("colType" => MySQL::SQLVALUE_DATE, "colSort" => 0, "colSortOrder" => 0);

		$this->TableColumns	= $Col;

		$Col	= array();

 		$Col["sl_img"]	= array("colType" => MySQL::SQLVALUE_IMG, "extension" => IMG_EXTENSION, "prefix" =>"sl_img", "path"=> PROJECT_UPLOAD_LRG_PATH, "maxSize" => MAX_FILE_SIZE);

               $this->TableFiles	= $Col;
	}
}
 
?>