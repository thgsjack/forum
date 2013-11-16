<?php 
session_start();
include_once('./include/formMessage.php');
session_destroy();
formMessage(LOGOUT_SUCCESS,'index.php');
?>