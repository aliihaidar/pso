<?php 

class pso_portfolio extends Form
{
	//  Constructor
	function __construct($connect = true, $database = null, $server = null, $username = null, $password = null, $charset = null, $port = null)
	{
		parent::__construct($connect, $database, $server, $username, $password, $charset, $port);

		$this->TableName	= "pso_portfolio";
		$this->TableID["po_id"]	= array("colType" => MySQL::SQLVALUE_NUMBER, "colSort" => 0, "colSortOrder" => 0);

		$Col	= array();

		$Col["po_pocat_id"]	= array("colType" => MySQL::SQLVALUE_NUMBER, "colSort" => 0, "colSortOrder" => 0);
		$Col["po_title"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["po_desc"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["po_link"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["po_published"]	= array("colType" => MySQL::SQLVALUE_NUMBER, "colSort" => 0, "colSortOrder" => 0);
		$Col["po_cruser"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["po_crdate"]	= array("colType" => MySQL::SQLVALUE_DATE, "colSort" => 0, "colSortOrder" => 0);
		$Col["po_mduser"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["po_mddate"]	= array("colType" => MySQL::SQLVALUE_DATE, "colSort" => 0, "colSortOrder" => 0);

		$this->TableColumns	= $Col;

		$Col	= array();

 		$Col["po_img"]	= array("colType" => MySQL::SQLVALUE_IMG, "extension" => IMG_EXTENSION, "prefix" =>"po_img", "path"=> PROJECT_UPLOAD_LRG_PATH, "maxSize" => MAX_FILE_SIZE);

               $this->TableFiles	= $Col;
	}
}
 
?>