// JavaScript Document
/**
 * Open ThickBox window
 */
function openThickBox(recordId, height, width, addOnVars) {
    var hrefThickBox    = jQuery('#hiddenThickBox').html();

    hrefThickBox    += '?recordId=';

    if (recordId) {
        hrefThickBox    += recordId;
    }

    if (addOnVars) {
        hrefThickBox    += addOnVars;
    }
    
    //	frmParam
    if (document.getElementById('frmParam')) {
    	hrefThickBox    += '&frmParam=' + document.getElementById('frmParam').value;
    }

    if (!height) {
//        height  = 400;
        height  = 550;
//        height  = jQuery(document).height() - 100;
    }

    if (!width) {
//        width   = 775;
        width   = 950;
//        width   = jQuery(document).width() - 100;
    }

    hrefThickBox    += '&KeepThis=true&TB_iframe=true&height=' + height + '&width=' + width + '&modal=true';
    
    jQuery('#hiddenThickBox').attr('href', hrefThickBox);
    
    jQuery('#hiddenThickBox').click();
}

/**
 * Close ThickBox window
 */
function closeThickBox()
{
    if (typeof preCloseThickBox == 'function') {
        if (!preCloseThickBox()) {
            return;
        }
    }
    
    self.parent.tb_remove();
    
    if (typeof postCloseThickBox == 'function') {
        postCloseThickBox();
    }
}

/**
 * Delete Ingrid Record
 */
function deleteRecord(fieldName, recordId)
{
    if (window.confirm('Are you sure you want to delete record?')) {
        jQuery('#' + fieldName).val(recordId);
        
        //jQuery('#frmSearch').submit();
		jQuery('#frmMain').submit();
    }
}

/**
 * Delete Ingrid Backup Record
 */
function deleteBackup(fileName)
{
    if (window.confirm('Are you sure you want to delete record?')) {
        jQuery('#fileName').val(fileName);
        jQuery('#in2Action').val('delete');
        
        jQuery('#frmSearch').submit();
    }
}

/**
 * Delete Ingrid Backup Records
 */
function deleteRecords(fieldName)
{
    jQuery('[name=chkRecord]').each(function(){
        if (this.checked) {
            if (jQuery('#' + fieldName).val()) {
                jQuery('#' + fieldName).val(jQuery('#' + fieldName).val() + '__' + this.value);
            } else {
                jQuery('#' + fieldName).val(this.value);
            }
        }
    });
    
    if (jQuery('#' + fieldName).val()) {
        if (window.confirm('Are you sure you want to delete record(s)?')) {   
            jQuery('#in2Action').val('delete');
            
            jQuery('#frmMain').submit();
        }
    } else {
        alert('No record(s) selected!');
    }
}

/**
 * Delete Form Record
 */
function deleteFrmRecord(fieldName, recordId)
{
    if (window.confirm('Are you sure you want to delete record?')) {
        jQuery('#in2Action').val('delete');
        
        jQuery('#frmManip').submit();
    }
}

/**
 * Delete Form Record Physically
 */
function deletePhysicalFrmRecord()
{
    if (window.confirm('Are you sure you want to delete record?')) {
        jQuery('#in2Action').val('deletePhysical');

        jQuery('#frmManip').submit();
    }
}

/**
 * Update password
 */
function Updatepassword()
{        
    if (window.confirm('Are you sure you want to reset password?')) {
		jQuery('#in2Action').val('editpassword');
		jQuery('#frmAction').val('editpassword');
		
        jQuery('#frmManip').submit();
    }    
}

/**
 * Delete Record File
 */
function deleteFile(fieldName, type)
{
    if (type == 'img') {
        confirmQuest    = 'Are you sure you want to delete image?';
    } else {
        confirmQuest    = 'Are you sure you want to delete file?';
    }
    
    if (window.confirm(confirmQuest)) {
        jQuery('#in2Action').val('deleteFile');
        jQuery('#fileFieldName').val(fieldName);
        
        jQuery('#frmManip').submit();
    }
}

/**
 * (Un)Check all checkboxes in ingrid
 */
function chkAll()
{
    if (rowSelectionVal) {
        if (jQuery('#chkIngrid').attr('checked')) {
            jQuery('[name=chkRecordRow]').each(function() {
                if (jQuery(this).attr('_selected') != 'true') {
                    jQuery(this).click();
                }
            });
        } else {
            jQuery('[name=chkRecordRow]').each(function() {
                if (jQuery(this).attr('_selected') != 'false') {
                    jQuery(this).click();
                }
            });
        }
    } else {
        if (jQuery('#chkIngrid').attr('checked')) {
            jQuery('[name=chkRecord]').each(function(){
                this.checked    = true;
            });
        } else {
            jQuery('[name=chkRecord]').each(function(){
                this.checked    = false;
            });
        }
    }
}

/**
 * (Un)Check CHECK ALL checkbox
 */
function chkChkAll()
{
    var chkAll  = true;
    
    jQuery('[name=chkRecord]').each(function(){
        if (!this.checked) {
            chkAll  = false;
        }
    });
        
    jQuery('#chkIngrid').attr('checked', chkAll);
}

/**
 * (Un)Check all checkboxes in ingrid - USE ONLY in Group Privileges
 */
function privAll()
{
    if (jQuery('.chkRecordAll').attr('checked')) {
        jQuery('.chkRecord').each(function(){
            this.checked    = true;
        });
    } else {
        jQuery('.chkRecord').each(function(){
            this.checked    = false;
        });
    }
}

/**
 * (Un)Check CHECK ALL checkbox - USE ONLY in Group Privileges
 */
function chkPrivAll()
{
    var chkAll  = true;
    
    jQuery('.chkRecord').each(function(){
        if (!this.checked) {
            chkAll  = false;
        }
    });
        
    jQuery('.chkRecordAll').attr('checked', chkAll);
}

/**
 * Reset Form
 */
function resetFrmValidation(frmId)
{
    jQuery('.error').each(function(){
        if (this.id) {
            jQuery(this).removeClass('error');
        } else {
            jQuery(this).remove();
        }
    });
    
    document.getElementById(frmId).reset();
}

/**
 * Check the keys pressed 
 * used specially for dates to prevent any key except the backspace and the tab
 */
function checkKeys(evnt, elementId)
{
    // detect a special case of "web browser"
    is_ie = ( (navigator.userAgent.toLowerCase().indexOf("msie") != -1) && (navigator.userAgent.toLowerCase().indexOf("opera") == -1) );

    if (evnt.keyCode == 8) {
        document.getElementById(elementId).value  = '';
        return true;
    } else {
        if (evnt.keyCode != 9) {
            if (is_ie) {
                window.event.cancelBubble = true;
                window.event.returnValue = false;
            } else {
                evnt.preventDefault();
                evnt.stopPropagation();
            }
        } else {
            return true;
        }
    }
}

/**
 * Function to submit any form
 */
function submitFrm(frmID, in2Action, confirmMsg, funct, doSubmit)
{
    if (in2Action) {
		document.getElementById('in2Action').value = in2Action;

        if (funct) {
            if (!eval(funct)) {
                return;
            }
        }
    }

    if (confirmMsg) {
        if (!window.confirm(confirmMsg)) {
            return;
        }
    }

    if (doSubmit) {
        document.getElementById(frmID).submit();
    }
}

function formFunction(fileName, myAction)
{
    document.getElementById('fileName').value = fileName;
    document.getElementById('in2Action').value = myAction;

    document.getElementById('frmSearch').submit();
}

/**
 * Function to print search form's results
 * Added by JBC on 2010-07-12 @ 11:38 PM
 */
function printResults(formName, newFormAction, newFormTarget, in2action) {
    if (!in2action) {
        in2action = 'in2action';
    }

    var formObject      = jQuery("#" + formName);

    var oldFormAction   = formObject.attr("action");
    var oldFormTarget   = formObject.attr("target");

    var oldIn2action    = jQuery("#" + in2action).val();

    formObject.attr("action", newFormAction);
    formObject.attr("target", newFormTarget);

    jQuery("#" + in2action).val('genReport');

    formObject.submit();

    formObject.attr("action", oldFormAction);
    formObject.attr("target", oldFormTarget);

    jQuery("#" + in2action).val(oldIn2action);
}