<?php 

class page extends Form
{
	//  Constructor
	function __construct($connect = true, $database = null, $server = null, $username = null, $password = null, $charset = null, $port = null)
	{
		parent::__construct($connect, $database, $server, $username, $password, $charset, $port);

		$this->TableName	= "page";
		$this->TableID["pg_id"]	= array("colType" => MySQL::SQLVALUE_NUMBER, "colSort" => 0, "colSortOrder" => 0);

		$Col	= array();

		$Col["pg_title"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["pg_href"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["pg_class"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["pg_order"]	= array("colType" => MySQL::SQLVALUE_NUMBER, "colSort" => 0, "colSortOrder" => 0);
		$Col["pg_pg_id"]	= array("colType" => MySQL::SQLVALUE_NUMBER, "colSort" => 0, "colSortOrder" => 0);
		$Col["pg_ishidden"]	= array("colType" => MySQL::SQLVALUE_NUMBER, "colSort" => 0, "colSortOrder" => 0);
		$Col["pg_backoffice"]	= array("colType" => MySQL::SQLVALUE_NUMBER, "colSort" => 0, "colSortOrder" => 0);
		$Col["pg_cruser"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["pg_crdate"]	= array("colType" => MySQL::SQLVALUE_DATETIME, "colSort" => 0, "colSortOrder" => 0);
		$Col["pg_mduser"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["pg_mddate"]	= array("colType" => MySQL::SQLVALUE_DATETIME, "colSort" => 0, "colSortOrder" => 0);

		$this->TableColumns	= $Col;

		$Col	= array();

 
               $this->TableFiles	= $Col;
	}
}
 
?>