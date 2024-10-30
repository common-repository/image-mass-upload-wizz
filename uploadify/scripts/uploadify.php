

<?php
$random_wizz = $_REQUEST['rand'];
if(!empty($random_wizz)) {
$path_root = $_SERVER["REQUEST_URI"];
$exp_wizz = explode("wp-content",$path_root);
$relative_path = $exp_wizz[0];
$url_wizz = $_SERVER["DOCUMENT_ROOT"].$relative_path;
require($url_wizz.'wp-blog-header.php');
echo "<script type=\"text/javascript\" src='".$url_wizz."/wp-includes/js/tinymce/tiny_mce_popup.js'></script>";


$http_url = get_bloginfo('wpurl');

$date = date('Y-m-d G:i:s');
if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $url_wizz."/wp-content/uploads/massupload/";
	$targetFile =  str_replace('//','/',$targetPath) . $random_wizz . $_FILES['Filedata']['name'];
	
		$filename_wizz_01 = $random_wizz.$_FILES['Filedata']['name'];
		
		if (move_uploaded_file($tempFile,$targetFile)){


		$add = $url_wizz."/wp-content/uploads/massupload/".$filename_wizz_01;
		$name_wizz_01 = explode(".",$_FILES['Filedata']['name']);
		$wpdb ->query("INSERT INTO `wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES('', '1', '".$date."', '".$date."', '', '".$name_wizz_01[0]."', '', 'inherit', 'open', 'open', '', '".$name_wizz_01[0]."', '', '', '".$date."', '".$date."', '', 0, '".$http_url."/wp-content/uploads/massupload/".$filename_wizz_01."', 0, 'attachment', 'image/jpeg', 0)");
					$id_value = $wpdb ->get_results("SELECT ID FROM wp_posts ORDER BY ID DESC LIMIT 0,1");
					foreach ($id_value as $value_id) {
					$id = $value_id->ID;
					}
					list($width_w, $height_w, $type_w, $attr_w) = getimagesize($add);
			
					$un = array (
					'width'=>$width_w,
					'height'=>$height_w,
					'file'=>'massupload/'.$filename_wizz_01
					);
					$wpdb ->query("INSERT INTO `wp_postmeta` (`meta_id`,`post_id`,`meta_key`,`meta_value`) VALUES('','".$id."','_wp_attached_file','massupload/".$filename_wizz_01."')");
					$wpdb ->query("INSERT INTO `wp_postmeta` (`meta_id`,`post_id`,`meta_key`,`meta_value`) VALUES('','".$id."','_wp_attachment_metadata','".serialize($un)."')");
					
					chmod($add,0777);
					
				}
					
		

		
		echo "1";
//unset($url_wizz,$http_url,$filename_wizz_01,$add,$random_wizz_01);
}
}		
?>