<?php 
session_start();
$output='';
// if(isset($_SESSION['u_id'])) {
	$output.='<div style="text-align:right;"><input type="button" class="btn btn-success" onclick="window.location=\'editor.php\'" id="edit_btn" value="發文"/></div>';
// }
$headerBar='發文區';
include('./include/db_setup.php');
include('./include/page.php');
$d=$db->query_first_assoc('SELECT count(*) FROM forum_title AS a LEFT JOIN forum_article AS b 
ON a.article_id=b.article_id');
$recordNum=$d['count(*)'];

$query=$db->query('SELECT a.title_id,a.publish_time,title_name,SUBSTR(article_content,1,20) AS article_content FROM forum_title AS a LEFT JOIN forum_article AS b 
ON a.article_id=b.article_id 
ORDER BY a.publish_time 
LIMIT '.(($curPage-1)*$npg).','.$npg);
$output.='<div style="width:100%;height:1000px;">';
while($d=$db->fetch_assoc($query)) {
	$d2=$db->query_first_assoc('SELECT count(*) FROM forum_article 
	WHERE title_id="'.$d['title_id'].'"');
	$output.='
		<div class="well" style="float:left;width:230px;">
		<p>'.$d['publish_time'].'  回應人數:'.($d2['count(*)']-1).'人<span class="titleNumber">討論編號:'.$d['title_id'].'</span></p>
		  <h2>'.$d['title_name'].'</h2>
		  <p>'.strip_tags($d['article_content']).'...</p>
		  <p>
			<a class="btn btn-primary btn-large" href="discuss.php?title_id='.$d['title_id'].'">
			  參與討論
			</a>
		  </p>
		</div>
	';
}
$output.='</div>';
$pageBar=makePage($recordNum,$npg,'forum.php',$curPage);
$output.='<div>'.$pageBar.'</div>';
$cssFile[]='./css/page1.css';
$jsFile[]='./js/edit.js';
include('./mainFrame.php');
?>