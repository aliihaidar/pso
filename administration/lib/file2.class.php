<?php

class file2 extends imageLib {

    private $fileName;
    private $fileSize;
    private $fileTemp;
    private $fileType;
    private $extension;
    private $fileNameNew;
    private $errMsg = null;

    public function __construct($fileRequest) {
        $this->fileName = $fileRequest['name'];
        $this->fileSize = $fileRequest['size'];
        $this->fileTemp = $fileRequest['tmp_name'];
        $this->fileType = $fileRequest['type'];

        $this->extension = $this->getFileExtension($this->fileName);

        $this->fileNameNew = $fileRequest['filename'];
//        $this->fileNameNew  = $this->genNewFileName();
    }

    public function getName() {
        return $this->fileName;
    }

    public function getSize() {
        return $this->fileSize;
    }

    public function getTemp() {
        return $this->fileTemp;
    }

    public function getType() {
        return $this->fileType;
    }

    public function getExtension() {
        return $this->extension;
    }

    public function getNameNew() {
        return $this->fileNameNew;
    }

    public function getErrMsg() {
        return $this->errMsg;
    }

    private function genNewFileName() {
        $newFileName = $_SESSION['us_id'] .
                '-' . abs(crc32($this->fileName)) .
                '-' . abs(crc32($this->fileSize)) .
                '-' . abs(crc32(date('Y-m-d H:i:s'))) .
                '.' . $this->extension;

        return $newFileName;
    }

    public function getFileExtension($fileName = null) {
        $fileName = $fileName ? $fileName : $this->fileName;

        $fileNameChunks = split("\.", $fileName);
        $fileExtension = $fileNameChunks[count($fileNameChunks) - 1];

        return $fileExtension;
    }

    public function uploadPhysical($destPath, $fileName = null, $srcPath = null, $fileTemp = null) {
		//var_dump($srcPath. $fileTemp);
        If (is_file($srcPath . $fileTemp)) {
            return true;
        } else {
            $this->errMsgs = "Sorry! An error occured while uploading file \"$fileSrc" . "$fileSrcName\"";

            return false;
        }
//        $fileTemp   = $srcPath . ($fileTemp ?   $fileTemp   : $this->fileTemp);
//        $fileName   = $fileName ?   $fileName   : $this->getNameNew();
//
////        if (move_uploaded_file($fileTemp, $destPath . $fileName)) {
//         if (copy($fileTemp, $destPath . $fileName)) {
//           // unlink($fileTemp);
//            
//            /**
//             * Render image to get its dimensions
//             */
////            if (eregi(strtolower($this->extension), IMG_EXTENSION)) {
////                $this->render($destPath . $fileName);
////            }
//            
//            return true;
//        } else {
//            $this->errMsgs  = "Sorry! An error occured while uploading file \"$fileSrc"."$fileSrcName\"";
//            
//            return false;
//        }
    }

    public function deletePhysical($fileName, $filePath) {
        if (is_file($filePath . $fileName)) {
            chmod($filePath . $fileName, 0777);
            unlink($filePath . $fileName);
        } else {
            $this->errMsg = "Could not delete physical file \"$filePath" . "$fileName\": file is missing.";
        }
    }

    public function resizeImage($srcImg, $dest, $fileName = null, $newWidth = null, $newHeight = null, $quality = 100, $exact = false) {
        $fileName = $fileName ? $fileName : $this->getNameNew();

        /**
         * Render the image
         */
        $this->render($srcImg);

        /**
         * Resize the image proportionately.
         * Else use:
         * $mrthumb->constrain($width, $height);
         */
        if ($newWidth && $newHeight) {
            if ($exact) {
                $this->contrain($newWidth, $newHeight);
            } else {
                $this->proportion($newWidth, $newHeight);
            }
        } elseif ($newWidth) {
            $this->proportion($newWidth);
        } else {
            $this->proportion($newHeight);
        }

        /**
         * Save the image to the new destination
         */
        $this->saveto($dest, $fileName, $quality, false);
    }

    public function populateImgDbTables($tableName, $tableIdVal, $sDim = '', $mDim = '', $bDim = '', $isDebug = false, $mbDim = '', $lDim = ''/* , $isDefault = 0 */) {
        global $_SESSION;
        global $classCon;

        $objPhoto = new sc_photos(false);
        $objPhoto->importConnection($classCon);

        /**
         * Insert into sc_photos DB table
         */
        $_REQUEST = array();

        $_REQUEST['ph_name'] = $this->getNameNew();
        $_REQUEST['ph_filesize'] = $this->getSize();
        $_REQUEST['ph_mimetype'] = $this->getType();

        $_REQUEST['ph_dimension_s'] = $sDim;
        $_REQUEST['ph_dimension_m'] = $mDim;
        $_REQUEST['ph_dimension_mb'] = $mbDim;
        $_REQUEST['ph_dimension_b'] = $bDim;
        $_REQUEST['ph_dimension_l'] = $lDim;


        $_REQUEST['ph_deleted'] = 0;

        $_REQUEST['ph_cruser'] = $_SESSION['us_id'];
        $_REQUEST['ph_crdate'] = date('Y-m-d H:i:s');
        $_REQUEST['ph_mduser'] = $_SESSION['us_id'];
        $_REQUEST['ph_mddate'] = date('Y-m-d H:i:s');

        $ph_id = $objPhoto->InsertRequest($isDebug);

        /**
         * Insert into DB - table $tableName
         */
        $_REQUEST = array();

        $objPhotoTable = new $tableName(false);
        $objPhotoTable->importConnection($classCon);

        switch ($tableName) {
            case 'sc_user_photos':
                $tablePrefix = 'up';
                $tableId = 'us_id';

                break;

            case 'sc_forsale_photos':
                $tablePrefix = 'fp';
                $tableId = 'fr_id';

                break;

            case 'sc_jobs_photos':
                $tablePrefix = 'jp';
                $tableId = 'jb_id';

                break;

            case 'sc_housing_photos':
                $tablePrefix = 'hp';
                $tableId = 'hs_id';

                /* $_REQUEST[$tablePrefix . '_default']	= $isDefault; */

                break;

            case 'sc_professors_photos':
                $tablePrefix = 'pp';
                $tableId = 'pr_id';

                break;

            case 'sc_profile_photos':
                $tablePrefix = 'pt';
                $tableId = 'po_id';

                break;
        }

        $_REQUEST[$tableId] = $tableIdVal;
        $_REQUEST['ph_id'] = $ph_id;
        $_REQUEST[$tablePrefix . '_order'] = 1;
        $_REQUEST[$tablePrefix . '_cruser'] = $_SESSION['us_id'];
        $_REQUEST[$tablePrefix . '_crdate'] = date('Y-m-d H:i:s');
        $_REQUEST[$tablePrefix . '_mduser'] = $_SESSION['us_id'];
        $_REQUEST[$tablePrefix . '_mddate'] = date('Y-m-d H:i:s');

        $phTab_id = $objPhotoTable->InsertRequest($isDebug);

        /**
         * Update photo order field
         */
        $updQuery = " UPDATE $tableName
                        SET {$tablePrefix}_order = {$tablePrefix}_order + 1
                        WHERE $tableId = $tableIdVal
                          AND {$tablePrefix}_id <> $phTab_id";

        $objPhotoTable->execute($updQuery, $isDebug);
    }

    public function manipImageUpload($tableName, $tableIdVal, $sDim = '', $mDim = '', $bDim = '', $exact = false, $isDebug = false, $mbDim = '', $lDim = '', $boDim = '', $resizeType = 'crop'/* , $isDefault = 0 */) {
		//var_dump($this->fileNameNew);
        if ($this->validate(IMG_EXTENSION, IMG_MAX_SIZE)) {
            //if ($this->uploadPhysical(PROJECT_UPLOAD_LRG_PATH, $this->fileNameNew, '', $this->fileNameNew)) {
            if ($this->uploadPhysical(PROJECT_UPLOAD_LRG_PATH, $this->fileNameNew, PROJECT_UPLOAD_LRG_PATH, $this->fileNameNew)) {
                $lWidth = $this->image['width'];
                $lHeight = $this->image['height'];
                $lDimensions = $lWidth . 'x' . $lHeight;
				
				// *** 1) Initialise / load image
                $resizeObj = new imageLib(PROJECT_UPLOAD_LRG_PATH . $this->getNameNew());

                /**
                 * Resize copy to PROJECT_UPLOAD_SML_PATH if $sDim passed
                 */
                $sWidth = 0;
                $sHeight = 0;
                $sDimensions = '';

                if ($sDim) {
                    $sDimensions = split('x', $sDim);

                    $sWidth = $sDimensions[0];
                    $sHeight = $sDimensions[1];

                    // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
                    $resizeObj->resizeImage($sWidth, $sHeight, $resizeType);

                    // *** 3) Save image
                    $resizeObj->saveImage(PROJECT_UPLOAD_SML_PATH . $this->getNameNew(), 100);
					
					$resizeObj->reset();
					
                    //$sWidth = round($this->image['widthNew'], 0);
                    //$sHeight = round($this->image['heightNew'], 0);
                    //$sDimensions = $sWidth . 'x' . $sHeight;
                }

                /**
                 * Resize copy to PROJECT_UPLOAD_MED_PATH if $mDim passed
                 */
                $mWidth = 0;
                $mHeight = 0;
                $mDimensions = '';

                if ($mDim) {
                    $mDimensions = split('x', $mDim);

                    $mWidth = $mDimensions[0];
                    $mHeight = $mDimensions[1];

                    //$resizeObj = new imageLib(PROJECT_UPLOAD_LRG_PATH . $this->getNameNew());
                    $resizeObj->resizeImage($mWidth, $mHeight, $resizeType);
                    $resizeObj->saveImage(PROJECT_UPLOAD_MED_PATH . $this->getNameNew(), 100);
					
					$resizeObj->reset();
					
                    //$mWidth = round($this->image['widthNew'], 0);
                    //$mHeight = round($this->image['heightNew'], 0);
                    //$mDimensions = $mWidth . 'x' . $mHeight;
                }

                /**
                 * Resize copy to PROJECT_UPLOAD_MEDBIG_PATH if $mbDim passed
                 */
                $mbWidth = 0;
                $mbHeight = 0;
                $mbDimensions = '';

                if ($mbDim) {
                    $mbDimensions = split('x', $mbDim);

                    $mbWidth = $mbDimensions[0];
                    $mbHeight = $mbDimensions[1];

                    //$resizeObj = new imageLib(PROJECT_UPLOAD_LRG_PATH . $this->getNameNew());
                    $resizeObj->resizeImage($mbWidth, $mbHeight, $resizeType);
                    $resizeObj->saveImage(PROJECT_UPLOAD_MEDBIG_PATH . $this->getNameNew(), 100);

					$resizeObj->reset();
					
                    //$mbWidth = round($this->image['widthNew'], 0);
                    //$mbHeight = round($this->image['heightNew'], 0);
                    //$mbDimensions = $mbWidth . 'x' . $mbHeight;
                }

                /**
                 * Resize copy to PROJECT_UPLOAD_BIG_PATH if $bDim passed
                 */
                if ($bDim) {
                    $bDimensions = split('x', $bDim);

                    $bWidth = $bDimensions[0];
                    $bHeight = $bDimensions[1];

                    //$resizeObj = new imageLib(PROJECT_UPLOAD_LRG_PATH . $this->getNameNew());
                    $resizeObj->resizeImage($bWidth, $bHeight, $resizeType);
                    $resizeObj->saveImage(PROJECT_UPLOAD_BIG_PATH . $this->getNameNew(), 100);
					
					$resizeObj->reset();
					
                    //$bWidth = round($this->image['widthNew'], 0);
                    //$bHeight = round($this->image['heightNew'], 0);
                    //$bDimensions = $bWidth . 'x' . $bHeight;
                }

                /**
                 * Resize copy to PROJECT_UPLOAD_LRG_PATH if $bDim passed
                 */
                if ($lDim) {
                    $lDimensions = split('x', $lDim);

                    $lWidth = $lDimensions[0];
                    $lHeight = $lDimensions[1];

                    //$resizeObj = new imageLib(PROJECT_UPLOAD_LRG_PATH . $this->getNameNew());
                    $resizeObj->resizeImage($lWidth, $lHeight, $resizeType);
                    $resizeObj->saveImage(PROJECT_UPLOAD_LRG_PATH . $this->getNameNew(), 100);
					
					$resizeObj->reset();
					
                    //$lWidth = round($this->image['widthNew'], 0);
                    //$lHeight = round($this->image['heightNew'], 0);
                    //$lDimensions = $lWidth . 'x' . $lHeight;
                }
				
				 if ($boDim) {
                    $boDimensions = split('x', $boDim);

                    $boWidth = $boDimensions[0];
                    $boHeight = $boDimensions[1];

                    //$resizeObj = new imageLib(PROJECT_UPLOAD_LRG_PATH . $this->getNameNew());
                    $resizeObj->resizeImage($boWidth, $boHeight, 'crop');
                    $resizeObj->saveImage(PROJECT_UPLOAD_BO_PATH . $this->getNameNew(), 100);
					
					$resizeObj->reset();
					
                    //$lWidth = round($this->image['widthNew'], 0);
                    //$lHeight = round($this->image['heightNew'], 0);
                    //$lDimensions = $lWidth . 'x' . $lHeight;
                }


                return true;
            } else {
                $_SESSION['errorMsgs'] = "Sorry! An error occured while uploading the file \"{$this->fileName}\"";
                $this->ErrorMsg = "Sorry! An error occured while uploading the file \"{$this->fileName}\"";

                return false;
            }
        } else {
            return false;
        }
    }

    public function populateFileDbTables($tableName, $tableIdVal, $isDebug = false, $continu = true) {
        global $_SESSION;
        global $classCon;

        $objFile = new sc_files(false);
        $objFile->importConnection($classCon);

        /**
         * Insert into sc_photos DB table
         */
        $_REQUEST = array();

        $_REQUEST['fl_name'] = $this->getNameNew();
        $_REQUEST['fl_filesize'] = $this->getSize();
        $_REQUEST['fl_mimetype'] = $this->getType();

        $_REQUEST['fl_deleted'] = 0;

        $_REQUEST['fl_cruser'] = $_SESSION['us_id'];
        $_REQUEST['fl_crdate'] = date('Y-m-d H:i:s');
        $_REQUEST['fl_mduser'] = $_SESSION['us_id'];
        $_REQUEST['fl_mddate'] = date('Y-m-d H:i:s');

        $fl_id = $objFile->InsertRequest($isDebug);

        if ($continu == true) {
            /**
             * Insert into DB - table $tableName
             */
            $_REQUEST = array();

            $objFileTable = new $tableName(false);
            $objFileTable->importConnection($classCon);

            switch ($tableName) {
                case 'sc_classnote_files':
                    $tablePrefix = 'cf';
                    $tableId = 'cl_id';

                    break;
            }

            $_REQUEST[$tableId] = $tableIdVal;
            $_REQUEST['fl_id'] = $fl_id;
            $_REQUEST[$tablePrefix . '_cruser'] = $_SESSION['us_id'];
            $_REQUEST[$tablePrefix . '_crdate'] = date('Y-m-d H:i:s');
            $_REQUEST[$tablePrefix . '_mduser'] = $_SESSION['us_id'];
            $_REQUEST[$tablePrefix . '_mddate'] = date('Y-m-d H:i:s');

            $flTab_id = $objFileTable->InsertRequest($isDebug);
        } else {
            return $fl_id;
        }
    }

    public function manipFileUpload($tableName, $tableIdVal, $filePath, $isDebug = false, $continu = true) {
        if ($this->validate(DOC_EXTENSION, DOC_MAX_SIZE)) {
            if ($this->uploadPhysical($filePath)) {
                /**
                 * Insert in DB
                 */
                $fileId = $this->populateFileDbTables($tableName, $tableIdVal, $isDebug, $continu);

                if ($continu) {
                    return true;
                } else {
                    return $fileId;
                }
            } else {
                $_SESSION['errorMsgs'] = "Sorry! An error occured while uploading the file \"{$this->fileName}\"";
                $this->ErrorMsg = "Sorry! An error occured while uploading the file \"{$this->fileName}\"";

                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * NOT FINISHED YET
     */
    public function validate($extension, $maxSize = 5120) {
        /**
         * Check the uploaded file size
         */
        $fileSize = ceil($this->fileSize / 1024);

        if ($fileSize > $maxSize) {
            $_SESSION['errorMsgs'] = "You have sent a file with \"$fileSize\" KBytes: the maximum size for \"{$this->fileName}\" is $maxSize KB";
            $this->ErrorMsg = "You have sent a file with \"$fileSize\" KBytes: the maximum size for \"{$this->fileName}\" is $maxSize KB";

            return false;
        }

        /**
         * Check the uploaded file extension
         */
        if (!eregi(strtolower($this->extension), $extension)) {
            $_SESSION['errorMsgs'] = "Sorry! The file \"{$this->fileName}\" should have $extension as extention";
            $this->ErrorMsg = "Sorry! The file \"{$this->fileName}\" should have $extension as extention";

            return false;
        }

        return true;
    }

}

?>