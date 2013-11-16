<?php 
session_start();
include_once('./sessionCheck.php');
if(isset($_POST['title_name'])) {
	foreach($_POST as $key => $value) {
		if($value=='') {
			exit();
		}
		$_POST[$key]=addslashes($value);
	}
	$articel_data=array();
	$title_data=array();
	
	include('./include/db_setup.php');
	include('./include/formMessage.php');
	$publish_time=date('Y/m/d H:i');
	$title_data['u_id']=$_SESSION['u_id'];
	$title_data['title_name']=$_POST['title_name'];
	$title_data['publish_time']=$publish_time;
	$db->INSERT('forum_title',$title_data);
	$title_id=$db->insert_id();
	
	$article_data['u_id']=$_SESSION['u_id'];
	$article_data['article_content']=$_POST['article_content'];
	$article_data['publish_time']=$publish_time;
	$article_data['title_id']=$title_id;
	$db->INSERT('forum_article',$article_data);
	$article_id=$db->insert_id();
	$db->query('UPDATE forum_title SET article_id="'.$article_id.'" 
	WHERE title_id="'.$title_id.'"');
	formMessage(PUBLISH_SUCCESS,'forum.php');
}

$output=<<<EOF
<form method="post">
	標題:<input type="text" name="title_name" id=""/>
	<textarea name="article_content" class="editor" id="" cols="30" rows="10"></textarea>
	<input type="button" id="publish_btn" value="發表"/>
</form>
EOF;
$jsFile[]='./js/ckeditor/ckeditor.js';
$jsFile[]='./js/ckeditor/adapters/jquery.js';
$jsFile[]='./js/ckeditor/ckeditorConfig.js';
$jsFile[]='./js/editor.js';
include('./mainFrame.php');
?>