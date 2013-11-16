<?php 
$act=isset($_POST['act'])?$_POST['act']:exit();
if($act=='loadMailTemplate') {
	include_once('../../include/db_setup.php');
	$d=$db->query_first_assoc('SELECT mailTemplate_title,mailTemplate_content FROM mailTemplate 
	WHERE mailTemplate_id="'.$_POST['mailTemplate_id'].'"');
	echo json_encode($d);
}
?>