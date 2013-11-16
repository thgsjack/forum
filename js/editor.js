$(function(){
	$('.editor').ckeditor(config);
	$('#publish_btn').click(function(){
		if(confirm("確定發表?")) {
			if( $('input[name="article_title"]').val()=='' 
			|| $('textarea[name="article_content"]').val()=='' ) {
				alert('標題和內容不能為空白');
			}
			else {
				$(this).closest('form').submit();
			}
		}
	});
});