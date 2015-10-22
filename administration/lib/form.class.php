<?php
class Form extends MySQL
{
    var $TableColumns       = null;
    var $TableID            = null;
    var $TableName          = null;
    var $TableFiles        = null;
    Var $ErrorMsgs;
    //  Constructor
    function __construct($connect=true, $database= null, $server= null, $username= null, $password= null, $charset= "utf8", $port = null){
        parent::__construct($connect, $database, $server, $username, $password, $charset, $port);
        if (parent::Error()) parent::Kill();
        $this->ErrorMsgs=array();
    }

    function execute($sql, $Debug = false){
        $cnt=0;
        $ex=$this->ThrowExceptions;
        $this->ThrowExceptions = true;
        try {
            //Execute query/queries
            if ($Debug){
                echo $sql;
            }
        	$cnt=$this->Query($sql);
        	
        } catch(Exception $e) {
        	$this->errorhandle($this->Error());   
        	$cnt= -1;
        }
    
        $this->ThrowExceptions =$ex;
        return $cnt;
    }
    
    function errorhandle($msg){
        die($msg);  
    }
    
    function SelectQuery($sql, $Debug = false){
    	if ($Debug){
    		echo $sql;
    	}
        $this->execute($sql);
        if (!$this->EOF()){
            $this->MoveFirst();
            return true;
        }else{
            return false;
        }
    }
    
    function GetRowCount(){
        if (!($this->RowCount())){
            return 0;
        }else{
            return $this->RowCount();
        }
    }
    
    function EOF(){
        if ($this->EndOfSeek()){
            return true;
        }else{
            return false;
        }
    }
    
    function SelectAll($whereArray = '',$Page=0,$PageSize=1, $Debug = false){
        $TableColumns = array_merge($this->TableID, $this->TableColumns);
        $TableColumns = array_merge($TableColumns, $this->TableFiles);
        
        foreach ($TableColumns as $key => $value) {
            $colName[$key]=$key;
            if ($value['colSort']==1){
                $colSort[$key]=$key;
                if ($value['colSortOrder']==1){    
                    $colSortOrder[$key]='DESC';
                }else{
                    $colSortOrder[$key]='ASC';
                }
            }
        }
        
        if (!($Page)||!($PageSize)){
            $Limit=null;
        }elseif ($Page==0){
            $Limit=null;
        }else{
            $Limit= ($Page-1)*$PageSize.','. $PageSize;
        }
        $sql=mysql::BuildSQLSelect($this->TableName,$whereArray,$colName,$colSort,$colSortOrder,$Limit);
        if ($Debug){
            echo $sql.'</br>';
        }
        return $this->selectQuery($sql);  
        
    }
    
   function SelectExt($Extension='', $Page=0, $PageSize=1, $Debug = false){
        $TableColumns = array_merge($this->TableID,$this->TableColumns);
        $TableColumns = array_merge($TableColumns, $this->TableFiles);
                
        $colName=array_keys($TableColumns);
        
        if (!($Page)||!($PageSize)){
            $Limit=null;
        }elseif ($Page==0){
            $Limit=null;
        }else{
            $Limit= ($Page-1)*$PageSize.','. $PageSize;
        }
        
        if ($Extension){
            $Extension = ' '. $Extension;
        }
        
        $sql=mysql::BuildSQLSelect($this->TableName,$whereArray,$colName,$colSort,$colSortOrder,null) .$Extension;
        
        if ($Limit){
            $sql.= ' LIMIT '.$Limit;
        }
        
        if ($Debug){
            echo $sql.'</br>';
        }
        
        return $this->selectQuery($sql);        
    }
    
   function CheckIfExists($whereArray = '', $Debug = false){ 
   		$TableColumns = array_keys($this->TableID);
   		return $this->Select($TableColumns, $whereArray, null, 0, 1, $Debug);
   }
   /**
    * Enter description here...
    *
    * @param string $fieldArray
    * @param  string $whereArray
    * @param integer $resultType (Optional) The type of array
	 *                Values can be: MYSQL_ASSOC, MYSQL_NUM, MYSQL_BOTH
    * @param boolean $Debug
    * @return array
    */
   function SelectRecord($fieldArray='', $whereArray = '', $resultType = MYSQL_BOTH, $Debug = false){ 
   		$SelectResult = false;
   		if (is_array($whereArray)){
	   		if ($fieldArray){
	   			$SelectResult=$this->Select($fieldArray, $whereArray, null, 0, 1, $Debug);	
	   		} else {
	   			$SelectResult=$this->SelectAll($whereArray, 0, 1, $Debug);	
	   		}	
   		} else {
   			if ($fieldArray){
	   			$SelectResult=$this->Select($fieldArray, null, $whereArray, 0, 1, $Debug);	
	   		} else {
	   			$SelectResult=$this->SelectExt($whereArray, 0, 1, $Debug);	
	   		}
   		}
   		
   		if ($SelectResult){
   			if ($this->RowCount() == 1){
   				$result = $this->RecordsArray($resultType);
   				return $result[0];
   			} else {
   				return null;
   			}
   		} else {
   			return null;
   		}
   } 
   
   function Select($fieldArray = '', $whereArray = '', $Extension = null, $Page = 0, $PageSize=1, $Debug = false){ 
   		return $this->SelectWithTable($this->TableName,$fieldArray,$whereArray,$Extension,$Page,$PageSize,$Debug);
   } 
   
   function SelectWithTable($TableName,$fieldArray='',$whereArray = '',$Extension=null,$Page=0,$PageSize=1, $Debug = false){ 
        if (!($Page)||!($PageSize)){
            $Limit=null;
        }elseif ($Page==0){
            $Limit=null;
        }else{
            $Limit= ($Page-1)*$PageSize.','. $PageSize;
        }
        $sql=mysql::BuildSQLSelect($TableName,$whereArray,$fieldArray,null,null,null);
        
        if ($Extension){
            $sql .= ' '. $Extension;
        }
        
        if ($Limit){
            $sql .= ' LIMIT '.$Limit;
        }
        
        if ($Debug){
            echo $sql.'</br>';
        }
        
        return $this->selectQuery($sql); 
   }
   
   function Update($valueArray = '',$whereArray = '', $Debug = false){
        $sql=mysql::BuildSQLUpdate($this->TableName,$valueArray,$whereArray);
        if ($Debug){
            echo $sql.'</br>';
        }
        return $this->Query($sql);  
    }
    
   function UpdateExt($Extension, $Debug = false){
        $sql=mysql::BuildSQLUpdate($this->TableName,null,null).$Extension;
        if ($Debug){
            echo $sql.'</br>';
        }
        
        return $this->Query($sql);  
    }
    
    function UpdateRequest($Debug = false){
        global $_FILES;
        $TableColumns = $this->TableColumns;
        foreach ($TableColumns as $key => $value) {
           if (isset($_REQUEST[$key])){
                $valueArray[$key]=MySQL::SQLValue($_REQUEST[$key], $value['colType']) ;
            } 
        }
        
        $TableColumns = $this->TableID;
        foreach ($TableColumns as $key => $value) {
            $id=MySQL::SQLValue($_REQUEST[$key], $value['colType']) ;
            $whereArray[$key]=$id;
        }
        $exec=$this->Update($valueArray,$whereArray,$Debug);
        
        if ($exec){
            $fl = new FileManip($_FILES,$this);
            $fl->Save($whereArray,$Debug);
            $this->FillErrorFromArray($fl->ErrorMsgs);
        }
        return $exec;
    }
    function DeleteFile($FieldName, $whereArray, $UpdateValue = true, $Debug = false){
        $fl = new FileManip($_FILES,$this);
        $fl->DeleteFile($FieldName,$whereArray,$UpdateValue,$Debug);
        $this->FillErrorFromArray($fl->ErrorMsgs);
    }
    
    function Insert($valueArray = '', $Debug = false){
        $sql=mysql::BuildSQLInsert($this->TableName,$valueArray);
        if ($Debug){
            echo $sql.'</br>';
        }
        $this->Query($sql);  
        return $this->RowCount();
    }
    
    function InsertRequest($Debug = false){
        global $_FILES;        
        $TableColumns = $this->TableColumns;
        foreach ($TableColumns as $key => $value) {
           if (isset($_REQUEST[$key])){
                $valueArray[$key]=MySQL::SQLValue($_REQUEST[$key], $value['colType']) ;
            } 
        }

        $this->Insert($valueArray, $Debug);
        $exec   = $this->GetLastInsertID();
        
        $fl = new FileManip($_FILES,$this);
        $KeyValue=array_keys($this->TableID);
        $whereArray=array($KeyValue[0]=>$this->GetLastInsertID());
        $fl->Save($whereArray,$Debug);
        $this->FillErrorFromArray($fl->ErrorMsgs);
        return $exec;
    }
    
    function Delete($whereArray = '', $Debug = false){
        /**
         * Added DELETE_PHYSICAL condition
         * By Jad Bou Chebl
         * On 2010-06-29 @ 03:37 PM
         */
        if (DELETE_PHYSICAL) {
            $sql    = mysql::BuildSQLDelete($this->TableName, $whereArray);
        } else {
            $sql    = mysql::BuildSQLDeleteLogical($this->TableName, $this->TableID, $whereArray);
        }

        if ($Debug){
            echo $sql.'</br>';
        }
        
        $this->Query($sql);
        return $this->RowCount();
    }
    
    function DeleteRequest($Debug = false){
        global $_FILES;

        $TableColumns = $this->TableID;

        foreach ($TableColumns as $key => $value) {
            $id=MySQL::SQLValue($_REQUEST[$key], $value['colType']) ;
            $whereArray[$key]=$id;
        }
        
        $fl = new FileManip($_FILES,$this);
        $tblFiles=array_keys($this->TableFiles);
        $row=$fl->GetRowFromSelect($tblFiles, $whereArray, $Debug);

        /**
         * Added DELETE_PHYSICAL condition
         * By Jad Bou Chebl
         * On 2010-06-29 @ 03:37 PM
         */
        if (DELETE_PHYSICAL) {
            $sql    = mysql::BuildSQLDelete($this->TableName, $whereArray);
        } else {
            $sql    = mysql::BuildSQLDeleteLogical($this->TableName, $this->TableID, $whereArray);
        }

        if ($Debug){
            echo $sql.'</br>';
        }
        
        $cnt=$this->Query($sql);
        if (($cnt>0) && ($row)){
            $fl->DeleteFileFromRow($tblFiles, $row, $whereArray, false, $Debug);
        }
        
        $this->FillErrorFromArray($fl->ErrorMsgs);
        return $cnt;
    }
    
    function DeleteSpecificFile($FieldName, $whereArray, $Debug = false){
        $fl = new FileManip($_FILES,$this);
        $fl->DeleteFile($FieldName, $whereArray, true, $Debug);
    }
    function FillErrorFromArray($Values){
        foreach($Values as $key => $value){
           $this->ErrorMsgs[$key]=$value;
        }
        
    }
    
    static public function GetSelectRowCount($FromSql, $Debug = false){
    	$db= new form();
    	$sql="select count(1) as cnt from $FromSql";
    	
    	if ($Debug){
            echo $sql.'</br>';
        }
    	if ($db->selectQuery($sql)){
    		$row = $db->Row();
    		return $row->cnt;
    	}else{
    		return 0;
    	}
    }
    
    static public function GetTableRowCount($Table, $whereArray, $Debug = false){
    	$db= new form();
    	if (is_array($whereArray)) {
			$sql = MYSQL::BuildSQLWhereClause($whereArray);
		} else {
			$sql = $whereArray;
		}
		
		return Form::GetSelectRowCount($Table.' '.$sql, $Debug);
    }
    
    public function GetColumnDataType($ColName) {
    	$col   = null;
    	
    	$TableColumns  = array_merge($this->TableID, $this->TableColumns);
    	$TableColumns  = array_merge($TableColumns, $TableColumns = $this->TableFiles);
    	return $TableColumns[$ColName]["colType"];
    }
    
    public function GetSqlColValue($ColName, $ColValue){
    	$colType = $this->GetColumnDataType($ColName);
    	if ($colType == null){
    		return null;
    	}
    	
    	return MYSQL::SQLValue($ColValue, $colType);
    }
}
?>