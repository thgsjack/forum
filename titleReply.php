<?php 
session_start();
include_once('./sessionCheck.php');
if(isset($_POST['article_content'])) {
	include('./include/formMessage.php');
	include('./include/db_setup.php');
	$article_data['article_content']=addslashes($_POST['article_content']);
	$article_data['u_id']=$_SESSION['u_id'];
	$article_data['publish_time']=date('Y/m/d H:i');
	$article_data['title_id']=$_POST['title_id'];
	$db->INSERT('forum_article',$article_data);
	formMessage(REPLY_SUCCESS,'discuss.php?title_id='.$_POST['title_id']);
}
include('./include/db_setup.php');
$title_id=$_GET['title_id'];
$d=$db->query_first_assoc('SELECT * FROM forum_title AS a 
LEFT JOIN forum_article AS b ON a.article_id=b.article_id 
WHERE a.title_id="'.$title_id.'"');
$output=<<<EOF
<div style="text-align:center;">
	<div style="text-align:left;font-size:25px;">RE:{$d['title_name']}
	{$d['article_content']}
	</div>
	<br/>
	<form method="POST">
	<textarea name="article_content" class="editor" cols="30" rows="10"></textarea>
	<br/>
	<input type="hidden" name="title_id" value="{$d['title_id']}"/>
	<input type="button" id="reply_btn" class="btn btn-success" value="回覆"/>
	</form>
</div>
EOF;
$jsFile[]='./js/ckeditor/ckeditor.js';
$jsFile[]='./js/ckeditor/adapters/jquery.js';
$jsFile[]='./js/ckeditor/ckeditorConfig.js';
$jsFile[]='./js/titleReply.js';
include('./mainFrame.php');
?>