<?php 
define('USERNAME_PASSWORD_ERROR','帳號密碼錯誤');
define('PUBLISH_SUCCESS','發佈成功');
define('PUBLISH_ERROR','發佈失敗');
define('DEL_SUCCESS','刪除成功');
define('DEL_FAIL','刪除失敗');
define('REPLY_SUCCESS','回覆成功');
define('MODIFY_SUCCESS','修改成功');
define('LOGOUT_SUCCESS','登出成功');
define('REG_SUCCESS','註冊成功，請至信箱收信認證');
define('REG_AUTH_SUCCESS','認證成功，可以登入此系統');
function formMessage($msg,$location='')
{
	if($location=='') {
		$location=basename($_SERVER['SCRIPT_NAME']);
	}
	$output='
	<meta charset="UTF-8">
	<script type="text/javascript">
		alert("'.$msg.'");
		window.location="'.$location.'";
	</script>';
	echo $output;
}
?>