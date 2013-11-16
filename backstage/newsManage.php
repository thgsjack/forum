<?php 
include_once('../include/db_setup.php');
include_once('../class/class.financeAdmin.php');
if(isset($_POST['news_id'])) {
	include_once('../include/formMessage.php');
	$news_id=$_POST['news_id'];
	$result=financeAdmin::delNews($news_id);
	if($result) {
		formMessage(DEL_SUCCESS);
	}
	else {
		formMessage(DEL_FAIL);
	}
}

include_once('../include/page.php');
$count=financeAdmin::getNewsCount();
$newsList=financeAdmin::getNewsList($curPage,$npg);
$newsList=json_encode($newsList);
$pageBar='<div style="float:left;">'.makePage($count,$npg,$link,$curPage).'</div>';
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/backstage_main.css"/>
	<link rel="stylesheet" type="text/css" href="../css/jquery-ui.css"/>
	<link rel="stylesheet" href="../css/bootstrap.css"/>
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="../js/ckeditor/adapters/jquery.js"></script>
	<script type="text/javascript" src="../js/ckeditor/ckeditorConfig.js"></script>
	<script type="text/javascript" src="../js/jquery-ui.js"></script>
	<script type="text/javascript">
		$(function(){
			newsList=$.parseJSON('<?php echo $newsList;?>');
			output='';
			counter=1;
			$.each(newsList,function(index,value){
				output+='<tr ref="'+value['news_id']+'"><td>'+(counter++)+'</td><td>'+value['news_time']+'</td><td class="newsTitle_td">'+value['news_title']+'</td><td><input type="button" class="modify_btn btn btn-primary btn-small" value="修改"></td><td><input type="button" class="del_btn btn btn-primary btn-small" value="刪除"/></td></tr>';
			});
			$('#list_tbody').html(output);
			$('.modify_btn').on('click',function(){
				news_id=$(this).closest('tr').attr('ref');
				act="getSpecifiedNewsContent";
				title=$(this).closest('tr').find('.newsTitle_td').text();
				$.post('./ajax/newsManage_ajax.php',{act:act,news_id:news_id},function(data){
					instance=CKEDITOR.instances['newsContent_textarea'];
					if(instance) {
						CKEDITOR.remove(instance);
					}
					$('#modify_div').remove();
					$('body').append('<div id="modify_div"><input type="hidden" name="modiyingNewsId" value="'+news_id+'"/><textarea class="editor" id="newsContent_textarea" cols="50" rows="80"></textarea></div>');
					$('#modify_div').dialog({title:title,height:400,minHeight:175,minWidth:580,buttons:{
						"取消":function(){
							$(this).dialog("close");
					},"儲存":function(){
							if(confirm('確定儲存?')) {
								act='saveModifiedNews';
								news_id=$('input[name="modiyingNewsId"]').val();
								news_content=$('#newsContent_textarea').val();
								$.post('./ajax/newsManage_ajax.php',{act:act,news_id:news_id,news_content:news_content},function(data){
									if(data=='1') {
										alert('儲存成功!');
										$(this).dialog("close");
									}
								});
							}
					}}});
					$('#newsContent_textarea').val(data);
					$('.editor').ckeditor(config);
				});
				$('#newsContent_textarea').ckeditor(config);
			});
			$('.del_btn').on('click',function(){
				if(confirm('確定刪除?')) {
					$('input[name="news_id"]').val($(this).closest('tr').attr('ref'));
					$(this).closest('form').submit();
				}
			});
			
			// $('#saveNews_btn').on('click',function(){
				// if(confirm('確定修改?')) {
					// act='saveModifiedNews';
					// news_id=$('input["name="modiyingNewsId"]').val();
					// newsContent=$('#newsContent_textarea').val();
					// $.post('./ajax/newsManage_ajax.php',{act:act,news_id:news_id,news_content:news_content},function(data){
						// if(data=='1') {
							// alert('修改成功!');
						// }
					// });
				// }
			// });
		});
	</script>
	<title></title>
</head>
<body style="padding:15px;">
<form method="post">
	<table class="table table-hover" style="width:850px;">
		<thead style="background-color:#FFFFEB;">
			<tr>
				<td width="60px">編號</td>
				<td width="200px">日期</td>
				<td width="450px">標題</td>
				<td width="70px"></td>
				<td width="70px"></td>
			</tr>
		</thead>
		<tbody id="list_tbody">
		</tbody>
	</table>
	<input type="hidden" name="news_id"/>
</form>
<?php 
echo $pageBar;
?>
</body>
</html>