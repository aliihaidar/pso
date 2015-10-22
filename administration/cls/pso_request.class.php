<?php 

class pso_request extends Form
{
	//  Constructor
	function __construct($connect = true, $database = null, $server = null, $username = null, $password = null, $charset = null, $port = null)
	{
		parent::__construct($connect, $database, $server, $username, $password, $charset, $port);

		$this->TableName	= "pso_request";
		$this->TableID["re_id"]	= array("colType" => MySQL::SQLVALUE_NUMBER, "colSort" => 0, "colSortOrder" => 0);

		$Col	= array();

		$Col["re_type"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["re_name"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["re_company"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["re_email"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["re_phone"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["re_desc"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["re_published"]	= array("colType" => MySQL::SQLVALUE_NUMBER, "colSort" => 0, "colSortOrder" => 0);
		$Col["re_cruser"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["re_crdate"]	= array("colType" => MySQL::SQLVALUE_DATE, "colSort" => 0, "colSortOrder" => 0);
		$Col["re_mduser"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["re_mddate"]	= array("colType" => MySQL::SQLVALUE_DATE, "colSort" => 0, "colSortOrder" => 0);

		$this->TableColumns	= $Col;

		$Col	= array();

               $this->TableFiles	= $Col;
	}
}
 
?>