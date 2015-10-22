<?php 

class pso_client extends Form
{
	//  Constructor
	function __construct($connect = true, $database = null, $server = null, $username = null, $password = null, $charset = null, $port = null)
	{
		parent::__construct($connect, $database, $server, $username, $password, $charset, $port);

		$this->TableName	= "pso_client";
		$this->TableID["cl_id"]	= array("colType" => MySQL::SQLVALUE_NUMBER, "colSort" => 0, "colSortOrder" => 0);

		$Col	= array();

		$Col["cl_title"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["cl_desc"]		= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["cl_published"]= array("colType" => MySQL::SQLVALUE_NUMBER, "colSort" => 0, "colSortOrder" => 0);
		$Col["cl_cruser"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["cl_crdate"]	= array("colType" => MySQL::SQLVALUE_DATE, "colSort" => 0, "colSortOrder" => 0);
		$Col["cl_mduser"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["cl_mddate"]	= array("colType" => MySQL::SQLVALUE_DATE, "colSort" => 0, "colSortOrder" => 0);

		$this->TableColumns	= $Col;

		$Col	= array();

 		$Col["cl_img"]	= array("colType" => MySQL::SQLVALUE_IMG, "extension" => IMG_EXTENSION, "prefix" =>"cl_img", "path"=> PROJECT_UPLOAD_LRG_PATH, "maxSize" => MAX_FILE_SIZE);

               $this->TableFiles	= $Col;
	}
}
 
?>