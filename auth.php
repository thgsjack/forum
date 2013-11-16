<?php 
include_once('./include/db_setup.php');
include_once('./include/formMessage.php');

$id=$_GET['id'];
$d=$db->query_first_assoc('SELECT reg_time,u_username FROM user 
WHERE u_username="'.$id.'"');
$vCode=$_GET['code'];
if($vCode==md5($d['u_username'].$d['reg_time'])) {
	$db->query('UPDATE user SET state="1" WHERE u_username="'.$id.'"');
	formMessage(REG_AUTH_SUCCESS,'index.php');
}
else {
	exit();
}
?>