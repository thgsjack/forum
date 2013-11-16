<?php 
if(!isset($_SESSION['u_id'])) {
	echo '
	<meta charset="UTF-8">
	<script type="text/javascript">
		alert("請先登入");
		window.history.back();
	</script>';
	exit();
}
?>