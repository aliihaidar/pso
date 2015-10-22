<?php

class backup extends MySQL  
{
    public  $done           = false;
    
    private $output         = '';
    private $constraints    = '';
    
    function __construct()
    {
        $this->output       = '';
        $this->constraints  = '';
    }

    function dumpTableStructure($table)
    {
        $columnName = 'Create Table';
        
        $this->output   .= "-- -------------------------------------------------------- \n\n";
        $this->output   .= "-- \n";
        $this->output   .= "-- Table structure for table `$table` \n";
        $this->output   .= "-- \n\n";
        $this->output   .= "DROP TABLE IF EXISTS `$table`;\n";

        $conn   = new MySQL(true, DBNAME, DBHOST, DBUSER, DBPASS, "", true);
        
        $strTables  = "SHOW CREATE TABLE $table";
        
        $conn->Query($strTables);
        
        $cntTables  = $conn->RowCount();
        
        if ($cntTables) {
            $conn->MoveFirst();
            
            while (!$conn->EndOfSeek()) {
                $rsTable    = $conn->Row();
     
                $tabStructure   = $rsTable->$columnName . ";\n\n";
    
                $constraintPos  = strpos($tabStructure, 'CONSTRAINT');
                $enginePos      = strpos($tabStructure, 'ENGINE');
                $constraint     = substr($tabStructure, $constraintPos - 2, $enginePos - 1 - $constraintPos);
    
                $this->output   .= str_replace(",\n\n", "\n", str_replace($constraint, '', $tabStructure));
    
                if (str_replace("\n\n", "", $constraint)) {
                    $this->constraints  .= "-- \n";
                    $this->constraints  .= "-- Constraints for table `$table` \n";
                    $this->constraints  .= "-- \n";
                    $this->constraints  .= "ALTER TABLE `$table` \n";
                    $this->constraints  .= str_replace("  ", "  ADD ", $constraint).";\n";
                    $this->constraints  .= "\n";
                }
            }
        }
    }

    function dumpTableData($table)
    {
        $conn   = new MySQL(true, DBNAME, DBHOST, DBUSER, DBPASS, "", true);
        
        $strTables  = "SELECT * FROM `$table`";
        
        $conn->QueryArray($strTables);
        
        $cntTables  = $conn->RowCount();
        
        if ($cntTables) {
            $num_fields = $conn->GetColumnCount($table);

            $this->output   .= "\n\n";
            $this->output   .= "-- \n";
            $this->output   .= "-- Dumping data for table `$table` \n";
            $this->output   .= "-- \n\n";

            $fields     = '';
            $field_type = array();

            $i  = 0;
            
            while ($i < $num_fields) {
                if (!$fields) {
                    $fields =   "`" . $conn->GetColumnName($i, $table) . "`";
                } else {
                    $fields .=  ", ". "`" . $conn->GetColumnName($i, $table) . "`";
                }

//                array_push($field_type, $conn->GetColumnDataType($i, $table));

                $i++;
            }

            $conn->MoveFirst();
            
            while (!$conn->EndOfSeek()) {
                $rsTable    = $conn->RowArray();
                
                $this->output   .= "INSERT INTO `$table` ($fields) VALUES (";

                for ($i = 0; $i < $num_fields; $i++) {
                    if (is_null($rsTable[$i])) {
                        $this->output   .= "null";
                    } else {
                        switch ($field_type[$i]) {
                            case 'int':
                                $this->output   .= $rsTable[$i];
                                break;
                            case 'string':
                            case 'blob' :
                            default:
                                $this->output   .= "'".addslashes($rsTable[$i])."'";
                                break;
                        }
                    }

                    if ($i < $num_fields - 1) {
                        $this->output   .= ", ";
                    }
                }

                $this->output   .= ");\n";
            }
        }
        
        $this->output   .= "\n";
    }

    function dumpToFile($backupFile)
    {
        file_put_contents($backupFile, $this->output);

        if ($this->constraints) {
            file_put_contents($backupFile, $this->constraints, FILE_APPEND);
        }
    }

    function deleteFile($file)
    {
        if (is_file($file)) {
            unlink($file);
        }
    }

    function backupDatabase($dbName, $backupStructure = true, $backupData = true, $backupFile = null)
    {
        $columnName = 'Tables_in_' . $dbName;
        
        $this->done = false;

        $this->output   .= "-- SQL Dump File \n";
        $this->output   .= "-- Generation Time: ".date('M j, Y')." at ".date('h:i:s A')." \n\n";
        $this->output   .= "-- \n";
        $this->output   .= "-- Database: `$dbName` \n";
        $this->output   .= "-- \n\n";

        $conn   = new MySQL(true, DBNAME, DBHOST, DBUSER, DBPASS, "", true);
        
        $strTables  = 'SHOW TABLES';
        
        $conn->Query($strTables);
        
        $cntTables  = $conn->RowCount();
        
        if ($cntTables) {
            $conn->MoveFirst();
            
            while (!$conn->EndOfSeek()) {
                $rsTables   = $conn->Row();
     
                if ($backupStructure) {
                    $this->dumpTableStructure($rsTables->$columnName);
                }

                if ($backupData) {
                    $this->dumpTableData($rsTables->$columnName);
                }
            }
        } else {
            $this->output   .= "-- \n";
            $this->output   .= "-- No tables in $dbName \n";
            $this->output   .= "-- \n";
        }

        if (!is_null($backupFile)) {
            $this->dumpToFile($backupFile);
        } 

        $this->done = true;
    }
}

?>