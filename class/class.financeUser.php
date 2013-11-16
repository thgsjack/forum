<?php 
include('class.finance.php');
class financeUser extends finance
{
	static function getNewsCount($newsType)
	{
		global $db;
		$count=$db->query_first_assoc('SELECT count(*) FROM news WHERE news_type="'.$newsType.'"');
		return $count['count(*)'];
	}
	static function getNews($npg,$page,$newsType)
	{
		global $db;
		return $db->query_all_assoc('SELECT * FROM news WHERE news_type="'.$newsType.'" 
		ORDER BY news_time DESC
		LIMIT '.($npg*($page-1)).','.$npg);
	}
	static function getArticle($news_id) 
	{
		global $db;
		return $db->query_first_assoc('SELECT * FROM news WHERE news_id="'.$news_id.'"');
	}
}
?>