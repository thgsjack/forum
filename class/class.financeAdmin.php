<?php 
include('class.finance.php');
class financeAdmin extends finance
{
	static function getNewsCount()
	{
		global $db;
		$d=$db->query_first_assoc('SELECT count(*) FROM news');
		return $d['count(*)'];
	}
	static function getNewsList($page,$npg)
	{
		global $db;
		$d=$db->query_all_assoc('SELECT * FROM news LIMIT '.($npg*($page-1)).','.$npg);
		//避免json格式錯誤
		foreach($d as $key => $value) {
			foreach($value as $key2 => $value2)
				$d[$key][$key2]=addslashes(trim($value2));
		}
		return $d;
	}
	static function delNews($news_id)
	{
		global $db;
		$db->query('DELETE FROM news 
		WHERE news_id='.$news_id);
		return true;
	}
	static function saveModifiedNews($news_id,$content)
	{
		global $db;
		$data['news_content']=addslashes($content);
		$db->UPDATE('news',$data,
		'news_id='.$news_id);
		return true;
	}
	static function getSpecifiedNewsContent($news_id)
	{
		global $db;
		$d=$db->query_first_assoc('SELECT news_content FROM news WHERE news_id="'.$news_id.'"');
		return trim($d['news_content']);
	}
}
?>