<?php 

class log extends Form
{
	//  Constructor
	function __construct($connect = true, $database = null, $server = null, $username = null, $password = null, $charset = null, $port = null)
	{
		parent::__construct($connect, $database, $server, $username, $password, $charset, $port);

		$this->TableName	= "log";
		$this->TableID["log_id"]	= array("colType" => MySQL::SQLVALUE_NUMBER, "colSort" => 0, "colSortOrder" => 0);

		$Col	= array();

		$Col["us_id"]	= array("colType" => MySQL::SQLVALUE_NUMBER, "colSort" => 0, "colSortOrder" => 0);
		$Col["log_sessid"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["log_indte"]	= array("colType" => MySQL::SQLVALUE_DATETIME, "colSort" => 0, "colSortOrder" => 0);
		$Col["log_upddte"]	= array("colType" => MySQL::SQLVALUE_DATETIME, "colSort" => 0, "colSortOrder" => 0);
		$Col["log_outdte"]	= array("colType" => MySQL::SQLVALUE_DATETIME, "colSort" => 0, "colSortOrder" => 0);
		$Col["log_ip"]	= array("colType" => MySQL::SQLVALUE_TEXT, "colSort" => 0, "colSortOrder" => 0);
		$Col["log_islogged"]	= array("colType" => MySQL::SQLVALUE_NUMBER, "colSort" => 0, "colSortOrder" => 0);

		$this->TableColumns	= $Col;

		$Col	= array();

 
               $this->TableFiles	= $Col;
	}
}
 
?>