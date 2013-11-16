<?php 
if(isset($_POST['u_username'])) {
	include_once('./include/db_setup.php');
	include_once('./include/formMessage.php');
	$_POST['u_password']=hash('ripemd160', $_POST['u_password']);
	$d=$db->query_first_assoc('SELECT u_id,u_name FROM user 
	WHERE u_username="'.$_POST['u_username'].'" 
	AND u_password="'.$_POST['u_password'].'"');
	if($d) {
		session_start();
		$_SESSION['u_id']=$d['u_id'];
		$_SESSION['u_name']=$d['u_name'];
		echo '<script type="text/javascript">
			top.location.href="index.php";
		</script>';
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
	<script type="text/javascript" src="./js/jquery.js"></script>
	<script type="text/javascript" src="./js/jquery.validate.js"></script>
	<script type="text/javascript" src="./js/bootstrap.js"></script>
	<style type="text/css">
		html{
			background-color:white;
		}
	</style>
	<title></title>
	<script type="text/javascript">
		$(function(){
			$('#login_form').validate();
		});
	</script>
</head>
<body>
<div style="width:450px;margin:auto auto;margin-top:75px;">
<form class="form-horizontal" id="login_form" method="POST">
  <table>
  <tr>
  	<td><label class="control-label" for="inputEmail">Email：</label></td>
  	<td><input type="text" id="inputEmail" name="u_username" class="required email" placeholder="test@gmail.com"></td>
  </tr>
  <tr>
  	<td><label class="control-label" for="inputPassword">密碼：</label></td>
  	<td><input type="password" name="u_password" class="required" id="inputPassword" placeholder="Password"></td>
  </tr>
  </table>
  <input type="submit" class="btn" value="登入"/>
</form>
</div>
</body>
</html>