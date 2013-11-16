<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./css/bootstrap.min.css"/>
	<link rel="stylesheet" href="./css/mainFrame.css"/>
	<link rel="stylesheet" href="./js/shadowbox/shadowbox.css"/>
	<meta charset="UTF-8">
	<?php 
	if(isset($cssFile))
		foreach($cssFile as $value) {
			echo '<link rel="stylesheet" href="'.$value.'"/>';
		}
	?>
	<title></title>
	<script type="text/javascript" src="./js/jquery.js"></script>
	<?php 
	if(isset($jsFile))
		foreach($jsFile as $value) {
			echo '<script type="text/javascript" src="'.$value.'"></script>';
	}
	?>
	<script type="text/javascript" src="./js/bootstrap.js"></script>
	<script type="text/javascript" src="./js/shadowbox/shadowbox.js"></script>
	<script type="text/javascript">
		Shadowbox.init();
		$(function(){
			$('#navBar_ul').tab('show');
			$('#memeberReg_btn').bind('click', function(event) {
				event.preventDefault();
				Shadowbox.open({
					content:"./memberReg.php",
					player:"iframe",
					title:"會員註冊",
					height:300,
					width:470
				});
			});
			$('#memberLogin_btn').bind('click', function(event) {
				event.preventDefault();
				Shadowbox.open({
					content:"./memberLogin.php",
					player:"iframe",
					title:"會員登入",
					height:300,
					width:470
				});
			});
		});
	</script>
</head>
<body>
<div id="main_div">
<div id="navBar_div">
	<ul class="nav nav-tabs" id="navBar_ul">
		<li class="active"><a href="page1.php?news_type=1">國際新聞</a></li>
		<li><a href="page1.php?news_type=2">台股新聞</a></li>
		<li><a href="forum.php">發文區</a></li>
	</ul>
	
	<div style="width:360px;float:left; text-align:right;">
		<?php 
			if(!isset($_SESSION['u_id'])) {
				echo '<input type="button" value="會員註冊" class="btn btn-primary btn-mini" id="memeberReg_btn"/>   ';
				echo '<input type="button" value="會員登入" class="btn btn-primary btn-mini" id="memberLogin_btn"/>';
			}
			else {
				echo $_SESSION['u_name'].'您好!  <a href="logout.php">登出</a>';
			}
		?>
	</div>
	
</div>
<div id="headerBar_div" style="text-align:left;">
<h1>鼠來寶
<?php 
echo isset($headerBar)?$headerBar:'';
?>
</h1>
</div>
<div id="content_div">
<?php 
echo isset($output)?$output:'';
?>
</div>
<div id="ad2_div">
<ul class="thumbnails">
<?php 
/*
<li style="width:200px;">
    <a href="#" class="thumbnail">
      <img src="./img/ad.jpg" alt="">
    </a>
  </li>
  <li style="width:200px;">
    <a href="#" class="thumbnail">
      <img src="./img/ad.jpg" alt="">
    </a>
  </li>
  <li style="width:200px;">
    <a href="#" class="thumbnail">
      <img src="./img/ad.jpg" alt="">
    </a>
  </li>
*/
echo isset($adList)?$adList:'';
?>
</ul>
</div>
</div>
</body>
</html>