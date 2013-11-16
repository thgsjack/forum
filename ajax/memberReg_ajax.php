<?php 
include_once('../include/db_setup.php');
$act=isset($_POST['act'])?$_POST['act']:exit();
if($act=='checkEmail') {
	$d=$db->query_first_assoc('SELECT u_id FROM user 
	WHERE u_username="'.$_POST['mail'].'"');
	if($d) {
		$output='0';
	}
	else {
		$output='1';
	}
}
echo $output;
?>