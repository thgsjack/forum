<?php 
if(isset($_POST['u_username'])) {
	include_once('./class/class.phpmailer.php');
	include_once('./include/sysPara.php');
	include_once('./include/mailConfig.php');
	include_once('./include/db_setup.php');
	$d=$db->query_first_assoc('SELECT u_id FROM user 
	WHERE u_username="'.$_POST['u_username'].'"');
	if($d) {
		exit();
	}
	$d=$db->query_first_assoc('SELECT * FROM mailTemplate 
	WHERE mailTemplate_id="'.USER_REG_MAIL.'"');
	$mailTitle=$d['mailTemplate_title'];
	$mailContent=$d['mailTemplate_content'];
	$tmp=preg_split('/\@/',$_POST['u_username']);
	$reg_data['u_name']=$tmp[0];
	$reg_data['u_username']=$_POST['u_username'];
	$reg_data['u_password']=hash('ripemd160', $_POST['u_password']);
	$reg_data['reg_time']=time();
	$url_para=md5($reg_data['u_username'].$reg_data['reg_time']);
	$url_para=$domainName.'/auth.php?id='.$_POST['u_username'].'&code='.$url_para;
	$mailContent=preg_replace('/\%url_para\%/',$url_para,$mailContent);
	
	$mail= new PHPMailer();
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = "ssl";
	$mail->Host = "smtp.gmail.com";
	$mail->Port = "465";
	$mail->CharSet = "utf8";
	$mail->Username = $mailConfig['username'];
	$mail->Password = $mailConfig['password'];
	$mail->From = $mailConfig['from'];
	$mail->FromName = $mailConfig['fromName']; 
	$mail->Subject=$mailTitle;
	$mail->MsgHTML($mailContent);
	
	$mail->AddAddress($_POST['u_username'],"");
	if(!$mail->Send())
		echo '<script type="text/javascript">
			alert("Mailer Error: "'.$mail->ErrorInfo.'");
			</script>';
	else {
		include_once('./include/formMessage.php');
		$db->INSERT('user',$reg_data);
		formMessage(REG_SUCCESS);
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
			$.validator.addMethod(
				"PWDregex",
				function(value, element) {
					return this.optional(element) || (/[a-zA-Z0-9]/.test(value) && value.length<16 && value.length>7);
				},
				'<br/><span style="color:red;">密碼需為8~15碼英、數字組合，不含特殊字元。</span>'
			);
			$('#reg_form').validate({
				rules:{
					u_password: "required PWDregex",
					u_password2:{ equalTo:'#inputPassword'}
				}
			});
			$('#reg_btn').click(function(event){
				act='checkEmail';
				mail=$('input[name="u_username"]').val();
				flag=1;
				$.post('./ajax/memberReg_ajax.php',{act:act,mail:mail},function(data){
					if(data=='0') {
						alert('此mail已經重複');
						flag=0;
					}
				});
				if(flag==0) {
					return false;
				}
			});
		});
	</script>
</head>
<body>
<div style="width:450px;margin:auto auto;margin-top:75px;">
<form class="form-horizontal" id="reg_form" method="POST">
  <table>
  <tr>
  	<td><label class="control-label" for="inputEmail">Email：</label></td>
  	<td><input type="text" id="inputEmail" name="u_username" class="required email" placeholder="test@gmail.com"></td>
  </tr>
  <tr>
  	<td><label class="control-label" for="inputPassword">密碼(8~15英數組合)：</label></td>
  	<td><input type="password" name="u_password" class="required" id="inputPassword" placeholder="Password"></td>
  </tr>
  <tr>
  	<td><label class="control-label" for="inputPassword2">確認密碼：</label></td>
  	<td><input type="password" name="u_password2" id="inputPassword2" class="required" placeholder="Password"></td>
  </tr>
  </table>
  <button type="submit" id="reg_btn" class="btn">註冊</button>
</form>
</div>
</body>
</html>
<!--<input type="button" class="btn btn-success" value="檢查重複" id="checkMail_btn"/> -->