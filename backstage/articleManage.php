<?php 
// session_start();
// if(!isset($_SESSION['admin']) || !$_SESSION['admin']) {
// 	exit();
// }
if(isset($_POST['title_id']) || isset($_POST['article_id'])) {
	include_once('../include/db_setup.php');
	include_once('../include/formMessage.php');
	// 刪除整篇文章
	if(isset($_POST['title_id'])) {
		$db->query('DELETE FROM forum_title 
		WHERE title_id="'.$_POST['title_id'].'"');
	}
	else {
	//刪除文章
		$db->query('DELETE FROM forum_article 
		WHERE article_id="'.$_POST['article_id'].'"');
	}
	formMessage(DEL_SUCCESS);
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../css/backstage_main.css"/>
	<link rel="stylesheet" href="../css/bootstrap.min.css"/>
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript">
		$(function(){
			$('.del_btn').click(function(){
				if(confirm('確定刪除?')) {
					if($(this).closest('form').find('input:text').val()!='') {
						$(this).closest('form').submit();
					}
					else {
						alert('不能為空白!');
					}
				}
			});
		});
	</script>
</head>
<body>
	<form method="post">
	請輸入文章編號: <input type="text" name="article_id" id=""><input type="button" class="del_btn btn" value="刪除">
	</form>
	<form method="post">
	請輸入討論編號: <input type="text" name="title_id" id=""><input type="button" class="del_btn btn" value="刪除">
	</form>
</body>
</html>