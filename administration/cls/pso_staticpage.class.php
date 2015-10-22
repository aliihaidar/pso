<?php 

class pso_staticpage extends Form
{
	//  Constructor
	function __construct($connect = true, $database = null, $server = null, $username = null, $password = null, $charset = null, $port = null)
	{
		parent::__construct($connect, $database, $server, $username, $password, $charset, $port);

		$this->TableName	= "pso_staticpage";
		$this->TableID["sp_id"]	= array("colType" => MySQL::SQLVALUE_NUMBER, "colSort" => 0, "colSortOrder" => 0);

		$Col	= array();

		$Col["sp_type"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["sp_title"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["sp_desc"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["sp_published"]	= array("colType" => MySQL::SQLVALUE_NUMBER, "colSort" => 0, "colSortOrder" => 0);
		$Col["sp_cruser"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["sp_crdate"]	= array("colType" => MySQL::SQLVALUE_DATE, "colSort" => 0, "colSortOrder" => 0);
		$Col["sp_mduser"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["sp_mddate"]	= array("colType" => MySQL::SQLVALUE_DATE, "colSort" => 0, "colSortOrder" => 0);

		$this->TableColumns	= $Col;

		$Col	= array();

 		$Col["sp_img"]	= array("colType" => MySQL::SQLVALUE_IMG, "extension" => IMG_EXTENSION, "prefix" =>"sp_img", "path"=> PROJECT_UPLOAD_LRG_PATH, "maxSize" => MAX_FILE_SIZE);

               $this->TableFiles	= $Col;
	}
}
 
?>