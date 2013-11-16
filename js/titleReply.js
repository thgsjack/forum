$(function(){
	$('.editor').ckeditor(config);
	$('#reply_btn').click(function(){
		if(confirm('確定送出?')) {
			if($('textarea[name="aritcle_content"]').val()=='') {
				alert('內容為空白');
			}
			else 
				$(this).closest('form').submit();
		}
	});
});