<?php 
include('./include/db_setup.php');
$title_id=$_GET['title_id'];
$output='';
$title_info=$db->query_first_assoc('SELECT * FROM forum_title 
WHERE title_id="'.$title_id.'"');
$output.='<div><span style="font-size:25px;">'.$title_info['title_name'].'</span><div style="float:right;"><input type="button" class="btn btn-info" onclick="window.location=\'titleReply.php?title_id='.$title_id.'\'" value="回覆"/></div></div><hr/>';
$query=$db->query('SELECT * FROM forum_article AS a 
LEFT JOIN user AS b ON a.u_id=b.u_id 
WHERE title_id="'.$title_id.'" 
ORDER BY publish_time ASC');
while($d=$db->fetch_assoc($query)) {
	$output.='
	<div>
		<div>'.$d['publish_time'].' <span class="discussNumber">發文編號:'.$d['article_id'].'</span></div>
		<div>'.$d['u_name'].' 說:</div>
		<div>'.$d['article_content'].'</div>
	</div><hr/>
	';
}
$cssFile[]='./css/discuss.css';
include('./mainFrame.php');
?>