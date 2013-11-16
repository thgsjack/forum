<?php 
include('./include/inputCheck.php');
if(!isset($_GET['news_id'])) {
	exit();
}
include('./include/db_setup.php');
include('./class/class.financeUser.php');
$article=financeUser::getArticle($_GET['news_id']);
$output='';
$output.='<h3>'.stripslashes($article['news_title']).'</h3>';
$output.=stripslashes($article['news_content']);
include('./mainFrame.php');
?>