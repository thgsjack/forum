
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<link rel="stylesheet" href="../css/bootstrap.css"/>
	<style type="text/css">
		.accordion-toggle {
			background-color:#FFE7CD;
		}
    .accordion a {
      display:block;
      width:inherit;
      height:inherit;
    }
	</style>
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<div class="accordion" id="accordion2">
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
        新聞
      </a>
    </div>
    <div id="collapseOne" class="accordion-body collapse in">
      <div class="accordion-inner">
        <a target="main" href="newsPublish.php">新聞發布</a>
      </div>
	  <div class="accordion-inner">
        <a target="main" href="newsManage.php">新聞管理</a>
      </div>
    </div>
  </div>
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
        發文區
      </a>
    </div>
    <div id="collapseTwo" class="accordion-body collapse">
      <div class="accordion-inner">
        <a target="main" href="articleManage.php">發文管理</a>
      </div>
    </div>
  </div>
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThird">
        信件
      </a>
    </div>
    <div id="collapseThird" class="accordion-body collapse">
      <div class="accordion-inner">
        <a target="main" href="./mailEditor.php">信件編輯</a>
      </div>
    </div>
  </div>
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFourth">
        廣告
      </a>
    </div>
    <div id="collapseFourth" class="accordion-body collapse">
      <div class="accordion-inner">
        <a target="main" href="./adEditor.php">廣告編輯</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>