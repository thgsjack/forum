<?php 
if(isset($_POST['u_useranme'])) {
	include('../include/db_setup.php');
	include('../include/formMessage.php');
	$u_password=hash('ripemd160', $_POST['u_password']);
	$d=$db->query_first_assoc('SELECT * FROM admin WHERE u_username="'.$u_useranme.'" AND u_password="'.$u_password.'"');
	if($d) {
		session_start();
		$_SESSION['admin']=true;
		$_SESSION['u_id']=$d['u_id'];
		header('Location: admin.php');
	}
	else {
		formMessage(USERNAME_PASSWORD_ERROR);
	}
}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/bootstrap.css"/>
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(function(){
			$('#login_btn').click(function(){
				if($('input[name="u_useranme"]').val()=='' || $('input[name="u_password"]').val()=='') {
					alert('帳號密碼為空白');
					return false;
				}
				else {
					$(this).closest('form').submit();
				}
			});
			$('window').keydown(function(e){
				if(e.keyCode==13) {
					e.preventDefault();
					return false;
				}
			});
		});
	</script>
	<title></title>
</head>
<body>
	<div style="background-color:black;padding:10px;color:white;"><h2>後台登入</h2></div>
	<div style="width:500px;height:350px; margin:auto auto;margin-top:25px;">
	<form method="post">
	  <fieldset>
		<legend>管理者登入</legend>
		<label>帳號</label>
		<input type="text" name="u_useranme" class="formElement" placeholder="test@gmail.com">
		<label>密碼</label>
		<input type="password" name="u_password" class="formElement" placeholder="">
		<span class="help-block"></span>
		<button type="button" id="login_btn" class="btn">登入</button>
	  </fieldset>
	</form>
	</div>
</body>
</html>