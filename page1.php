<?php 
include_once('./include/db_setup.php');
include_once('./class/class.financeUser.php');
include_once('./include/page.php');
if(!isset($_GET['news_type'])) {
	exit();
}
if($_GET['news_type']==financeUser::newsType_national)
	$headerBar='國際新聞';
else 
	$headerBar='台股新聞';
// $output='sggddd
// <div id="myCarousel" class="carousel slide">
  // <ol class="carousel-indicators">
    // <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    // <li data-target="#myCarousel" data-slide-to="1"></li>
    // <li data-target="#myCarousel" data-slide-to="2"></li>
  // </ol>
  // <!-- Carousel items -->
  // <div class="carousel-inner">
    // <div class="active item">
		// <img src="./foreignNews_img/img1.jpg" alt=""/>
	// </div>
    // <div class="item">
		// <img src="./foreignNews_img/img2.jpg" alt=""/>
	// </div>
    // <div class="item">
		// <img src="./foreignNews_img/img3.jpg" alt=""/>
	// </div>
  // </div>
  // <!-- Carousel nav -->
  // <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  // <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
// </div>
// ';
// if($_GET['news_type']==financeUser::newsType_national) {
$recordNum=financeUser::getNewsCount($_GET['news_type']);
$newsList=financeUser::getNews($npg,$curPage,$_GET['news_type']);
$newsContent='';
$counter=0;
// $output['newsList']=$newsList;
$rowStyle=array('listOdd_div','listEven_div');
foreach($newsList as $value) {
	$newsContent.='
		<tr>
			<td>
				<div class="'.$rowStyle[$counter%2].' list_div">
					'.$value['news_time'].'<br>
					<div class="newsContent_div">
					'.$value['news_title'].'
					</div>
					<div class="readmore_div"><a href="./newsRead.php?news_id='.$value['news_id'].'">
					閱讀...</a></div>
				</div>
			</td>
		</tr>
	';
	$counter++;
}
$output.='
<table class="table">
'.$newsContent.'
</table>';
// $output['page']=make
$pagePara['news_type']='1';
$output.=makePage($recordNum,$npg,$link,$curPage,$pagePara);
$cssFile[]='./css/page1.css';
include('./mainFrame.php');
?>

