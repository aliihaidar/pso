<?php

class FileManip {

    var $TableCls;
    Var $Files;
    Var $ErrorMsg;
    Var $ErrorMsgs;

    function __construct($TableFiles, $TableClass) {
        $this->TableCls = $TableClass;
        $this->Files = $TableFiles;
        $this->ErrorMsgs = array();
        //$ErrorFields
    }

    function Save($whereArray, $Debug) {
        if (!$this->Validate()) {
            return false;
        }
        $FileName = array_keys($this->TableCls->TableFiles);
        foreach ($FileName as $value) {
            $fl = $this->Files[$value];
            $FileProp = $this->TableCls->TableFiles[$value];

            if ($fl['name']) {
                if ($this->chkFile($value, $FileProp["extension"], $FileProp["maxSize"])) {
                    $this->ErrorMsgs[$value] = $this->ErrorMsg;
                } else {
                    $this->UpdateFile($value, $whereArray, true, $Debug);
                }
            }
        }

        if (count($this->ErrorMsgs) > 0) {
            return false;
        } else {
            return true;
        }
    }

    function GetRowFromSelect($TableColumns, $whereArray, $Debug = false) {
        if ($TableColumns) {
            $this->TableCls->Select($TableColumns, $whereArray, null, 0, 0, $Debug);
            if (!$this->TableCls->EOF()) {
                $row = $this->TableCls->Row();
                return $row;
            }
        }
        return null;
    }

    function DeleteFile($FieldName, $whereArray, $UpdateValue = true, $Debug = false) {
        if (!($FieldName)) {
            return;
        }
        if (is_array($FieldName)) {
            $TableColumns = $FieldName;
        } else {
            $TableColumns = array($FieldName);
        }
        $row = $this->GetRowFromSelect($TableColumns, $whereArray, $Debug);
       
        if ($row) {
            $this->DeleteFileFromRow($TableColumns, $row, $whereArray, $UpdateValue, $Debug);
        }
    }

    function DeleteFileFromRow($TableColumns, $row, $whereArray, $UpdateValue = true, $Debug = false) {
       
        foreach ($TableColumns as $col) {
            $FieldValue = $row->$col;
            $this->DeleteFilePhysically($col, $FieldValue, $whereArray, $UpdateValue, $Debug);
        }
    }

    function DeleteFilePhysically($FieldName, $FieldValue, $whereArray, $UpdateValue = true, $Debug = false) {
       
        if ($FieldValue) {
            $File = $this->TableCls->TableFiles[$FieldName]["path"] . $FieldValue;
            
            //var_dump(is_file($File));
            if (is_file($File)) {
                //LRG
                chmod($File, 0777);
                unlink($File);

                //BIG
                $File =  PROJECT_UPLOAD_BIG_PATH . $FieldValue;
                if (is_file($File)) {
                    chmod($File, 0777);
                    unlink($File);
                }

                //BIG
                $File =  PROJECT_UPLOAD_MED_PATH . $FieldValue;
                if (is_file($File)) {
                    chmod($File, 0777);
                    unlink($File);
                }
                
                //SML
                $File =  PROJECT_UPLOAD_SML_PATH . $FieldValue;
                if (is_file($File)) {
                    chmod($File, 0777);
                    unlink($File);
                }  

                //MEDBIG
                $File =  PROJECT_UPLOAD_MEDBIG_PATH . $FieldValue;
                if (is_file($File)) {
                    chmod($File, 0777);
                    unlink($File);
                }                 
                
            } else {
                $this->ErrorMsgs[$FieldName] = "Could not delete physical file \"$File\" because it is missing.";
            }
            if ($UpdateValue) {
                $valueArray[$FieldName] = MySQL::SQLValue('', MySQL::SQLVALUE_TEXT);
                $this->TableCls->Update($valueArray, $whereArray, $Debug);
            }
        }
    }

    function UpdateFile($FieldName, $whereArray, $UpdateValue = true, $Debug = false) {
        if (!($FieldName)) {
            return;
        }
        if (is_array($FieldName)) {
            $TableColumns = $FieldName;
        } else {
            $TableColumns = array($FieldName);
        }
        $this->DeleteFile($TableColumns, $whereArray, $UpdateValue, $Debug);
        $this->UpdateFilePhysically($TableColumns, $whereArray, $UpdateValue, $Debug);
    }

    function UpdateFilePhysically($TableColumns, $whereArray, $UpdateValue = true, $Debug = false) {
        foreach ($TableColumns as $col) {
            $fl = $this->Files[$col];
            $seq = array_keys($whereArray);
            $File = $this->TableCls->TableFiles[$col];
            $Extention = explode('.', $fl['name']);
            $fileName = $File['prefix'] . '_' . $whereArray[$seq[0]] . '.' . $Extention[1];
            
            if (copy($fl['tmp_name'], $File["path"] . $fileName)) {
                unlink($fl['tmp_name']);
            } else {
                $this->ErrorMsgs[$col] = "Sorry! An error occured while uploading the file \"$col\"";
            }

            if ($UpdateValue) {
                $valueArray[$col] = MySQL::SQLValue($fileName, MySQL::SQLVALUE_TEXT);
                $this->TableCls->Update($valueArray, $whereArray, $Debug);
            }
        }
    }

    function Validate() {
        return true;
    }

    function chkFile($fileNameField, $extension = null, $maxSize = 5120) {
        //  if not sent exit
        if (!$this->Files[$fileNameField]['name']) {
            $this->ErrorMsg = "Sorry! An error occured while uploading the file \"$fileNameField\"";
            return true;
        }
        if (!$this->Files[$fileNameField]['size']) {
            $this->ErrorMsg = "Sorry! An error occured while uploading the file \"$fileNameField\"";
            return true;
        }
        $fileSize = ceil($this->Files[$fileNameField]['size'] / 1024);

        if ($fileSize > $maxSize) {
            $this->ErrorMsg = "You have sent a file with \"$fileSize\" KBytes: the maximum size for \"$fileNameField\" is $maxSize KB";
            return true;
        }

        $fileExtention = explode('.', $this->Files[$fileNameField]['name']);

        if (!eregi(strtolower($fileExtention[1]), $extension)) {
            $this->ErrorMsg = "Sorry! The file \"$fileNameField\" should have $extension as extention";
            return true;
        }
    }


}

?>