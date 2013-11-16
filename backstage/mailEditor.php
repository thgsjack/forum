<?php 
include_once('../include/db_setup.php');
if(isset($_POST['mailTemplate_title'])) {
	foreach($_POST as $key => $value) {
		if($value=='') {
			exit();
		}
		$_POST[$key]=addslashes($value);
	}
	include_once('../include/formMessage.php');
	$db->query('UPDATE mailTemplate SET mailTemplate_title="'.$_POST['mailTemplate_title'].'", 
	mailTemplate_content="'.$_POST['mailTemplate_content'].'" 
	WHERE mailTemplate_id="'.$_POST['mailTemplate_id'].'"');
	formMessage(MODIFY_SUCCESS);
}
$query=$db->query('SELECT mailTemplate_id,mailTemplate_name FROM mailTemplate');
$mailTemplate='';
while($d=$db->fetch_assoc($query)) {
	$mailTemplate.='<option value="'.$d['mailTemplate_id'].'">'.$d['mailTemplate_name'].'</option>';
}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/backstage_main.css"/>
	<link rel="stylesheet" type="text/css" href="../css/jquery-ui.css"/>
	<link rel="stylesheet" href="../css/bootstrap.css"/>
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="../js/ckeditor/adapters/jquery.js"></script>
	<script type="text/javascript" src="../js/ckeditor/ckeditorConfig.js"></script>
	<script type="text/javascript" src="../js/jquery-ui.js"></script>
	<title></title>
	<script type="text/javascript">
		$(function(){
			$('.editor').ckeditor(config);
			$('#mailTemplate_id_select').change(function(){
				mailTemplate_id=$(this).val();
				act='loadMailTemplate';
				$.post('./ajax/mailEditor_ajax.php',{act:act,mailTemplate_id:mailTemplate_id},function(data){
					if(data) {
						data=$.parseJSON(data);
						$('input[name="mailTemplate_title"]').val(data.mailTemplate_title);
						$('textarea[name="mailTemplate_content"]').val(data.mailTemplate_content);
					}
					else {
						alert('發生錯誤');
					}
				});
			});
			$('#send_btn').click(function(){
				if(confirm('確定修改?')) {
					$(this).closest('form').submit();
				}
			});
		});
	</script>
</head>
<body>
	<form method="post">
	<select name="mailTemplate_id" id="mailTemplate_id_select">
		<option value=""></option>
		<?php 
		echo $mailTemplate;
		?>
	</select>
	<div>
		<input type="text" name="mailTemplate_title" id=""/>
		<textarea name="mailTemplate_content" class="editor" id="" cols="30" rows="10"></textarea>
		<input type="button" id="send_btn" value="修改"/>
	</div>
	</form>
</body>
</html>