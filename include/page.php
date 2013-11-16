<?php 
$npg=10;
$link=$_SERVER['SCRIPT_NAME'];
$curPage=isset($_GET['page'])?$_GET['page']:1;
function makePage($recordNum,$npg,$link,$curPage,$otherPara='')
{
	$counter=0;
	$para='';
	if($otherPara!='' && is_array($otherPara)) {
		$para=array();
		foreach($otherPara as $key => $value) {
			$para[$counter]=$key.'='.$value;
			$counter++;
		}
		$para='&'.implode('&',$para);
	}
	$output='<div class="pagination pagination-centered"><ul>';
	$totalPage=ceil(($recordNum/$npg));
	if($totalPage==1) {
		$noPre=true;
		$noNext=true;
	}
	else if($curPage>1 && $totalPage>$curPage){
		$noPre=false;
		$noNext=false;
	}
	else if($curPage==$totalPage) {
		$noNext=true;
		$noPre=false;
	}
	if($noPre) {
		$prePage='disabled';
		$preLink='';
	}
	else {
		$prePage='';
		$preLink='href='.$link.'?p='.($curPage-1).$para;
	}
	if($noNext) {
		$nextPage='disabled';
		$nextLink='';
	}
	else {
		$nextPage='';
		$nextLink='href='.$link.'?p='.($curPage+1).$para;
	}
	
	$output.='<li class="'.$prePage.'"><a '.$preLink.'>&laquo;</a></li>';
	for($i=1;$i<=$totalPage;$i++) {
		if($i==$curPage) {
			$pageState='active';
		}
		else {
			$pageState='';
		}
		$output.='<li class="'.$pageState.'"><a href="'.$link.'?p='.$i.$para.'">'.$i.'</a></li>';
	}
	
	$output.='<li class="'.$nextPage.'"><a '.$nextLink.'>&raquo;</a></li>';
	$output.='</ul></div>';
	return $output;
}
?>