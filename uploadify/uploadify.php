<?php
$path_root = $_SERVER["REQUEST_URI"];
$exp = explode("wp-content",$path_root);
$relative_path = $exp[0];
$url = "http://".$_SERVER["HTTP_HOST"].$relative_path;
$upload_path = $url."wp-content/uploads/massupload";
$rand = rand(100,999999);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Wizz mass upload</title>
<link href="css/default.css" rel="stylesheet" type="text/css" />
<link href="css/uploadify.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="scripts/swfobject.js"></script>
<script type="text/javascript" src="scripts/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript" src="<?php echo $url;?>wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script type="text/javascript">
$(document).ready(function() {
		randPict = '<?php echo $rand ?>';
	$("#uploadify").uploadify({
		'uploader'       : 'scripts/uploadify.swf',
		'script'         : 'scripts/uploadify.php',
		'scriptData'     : {'rand': '<?php echo $rand ?>'},
		'cancelImg'      : 'cancel.png',
		'folder'         : '<?php echo $upload_path ?>',
		'queueID'        : 'fileQueue',
		'simUploadLimit' : 1,
		'auto'           : false,
		'multi'          : true,
		'onComplete': function(event, queueID, fileObj, reposnse, data) {
		namePict = '<?php echo  $rand ?>'+fileObj.name+'';
	 fileNameP = fileObj.filePath.replace(fileObj.name,namePict);
	 tinyMCE.execCommand('mceInsertContent',false,'<br><img src="'+fileNameP+'">');  return false;
	 },
	    'onError': function (event, queueID ,fileObj, errorObj) {
                    var msg;
                    if (errorObj.status == 404) {
                       alert('Could not find upload script. Use a path relative to: '+'<?= getcwd() ?>');
                       msg = 'Could not find upload script.';
                    } else if (errorObj.type === "HTTP")
                       msg = errorObj.type+": "+errorObj.status;
                    else if (errorObj.type ==="File Size")
                       msg = fileObj.name+'<br>'+errorObj.type+' Limit: '+Math.round(errorObj.sizeLimit/1024)+'KB';
                    else
                       msg = errorObj.type+": "+errorObj.text;
                    alert(msg);
                    $("#fileUpload" + queueID).fadeOut(250, function() { $("#fileUpload" + queueID).remove()});
                    return false;
                    }
						});
	
	
});
</script>
</head>

<body>
<div id="fileQueue" style="width:493px;"></div>
<input type="file" name="uploadify" id="uploadify" /><br> 
<p><a href="javascript:jQuery('#uploadify').uploadifyClearQueue()"><img src="cancel_upload.png"></a>
 <a href="javascript:jQuery('#uploadify').uploadifyUpload()"><img src="insert.png"></a> 
<a href="" onClick="tinyMCEPopup.close();"><img src="close.png"></a>
</p>

</body>
</html>
