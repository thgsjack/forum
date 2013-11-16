<?php 
$act=isset($_POST['act'])?$_POST['act']:exit();
include_once('../../include/db_setup.php');
include_once('../../class/class.financeAdmin.php');
if($act=='saveModifiedNews') {
	$news_id=$_POST['news_id'];
	$content=$_POST['news_content'];
	$result=financeAdmin::saveModifiedNews($news_id,$content);
	if($result) {
		echo '1';
	}
}
else if($act=='getSpecifiedNewsContent') {
	$news_id=$_POST['news_id'];
	$content=financeAdmin::getSpecifiedNewsContent($news_id);
	echo $content;
}
?>