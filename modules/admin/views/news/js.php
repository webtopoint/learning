
<script type="text/javascript" src="<?=base_url?>/public/spartan-multi-image-picker.js"></script>
<script type="text/javascript" src="<?=site_url('public/custom/ckeditor.js')?>"> </script>
<script type="text/javascript">
$('.youtubeurl').on('change',function(){
	var iframe = $(this).parent().find('iframe');
	if(isUrlValid(this.value)){
		$(iframe).attr('src',this.value.replace('watch?v=','embed/'));
		$(iframe).height('180');
	}
	else
		$(iframe).height('0');
})

function isUrlValid(url) {
    return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
}
$('.media-select').click(function(){
	$('.media-div').slideUp(500);
	$('.'+this.value+'-div').slideDown(500);
});


		$(function(){

			$("#coba").spartanMultiImagePicker({
				fieldName:        'imgs[]',
				maxCount:         0,
				rowHeight:        '200px',
				groupClassName:   'col-md-12',
				maxFileSize   :      '',
				placeholderImage: {
				    image: '<?=base_url?>/public/placeholder.png',
                	width : '100%'
				},
				dropFileLabel : "Drop Here",
				onAddRow:       function(index){
					console.log(index);
					console.log('add new row');
				},
				onRenderedPreview : function(index){
					console.log(index);
					console.log('preview rendered');
				},
				onRemoveRow : function(index){
					console.log(index);
				},
				onExtensionErr : function(index, file){
					console.log(index, file,  'extension err');
					alert('Please only input png or jpg type file')
				},
				onSizeErr : function(index, file){
					console.log(index, file,  'file size too big');
					alert('File size too big');
				}
			});
		});


   	list_cats();
   //	alert(cat_list);
	function list_cats(){
		$('.table-print').html('<center><strong style="font-size:1em"><i class="fa fa-spin fa-spinner"></i> Please Wait.</strong></center>');
		$.ajax({
			type :'POST',
			url : '<?=site_url('Admin/news_ajax')?>',
			data : {status:'list_category-for_post',id:cat_list},
			dataType : 'json',
			success:function(res){
			    console.log(res);
				$('.table-print').html(res.html);
				$('.list-cats').html('<i class="fa fa-refresh"></i>');
			}
		});
	}

	$('.save-category').click(function(){
		let input = $(this).closest('#category-add').find('input');
		let value = $(input).val();

		if(value){
			$.ajax({
				type : 'POST',
				url : '<?=site_url()?>/Admin/news_ajax',
				data : { status : 'insertCategory', name : value, slug : '' },
				dataType:'json',
				success:function(res){
					$(input).val('');
					list_cats();
				},
				error: function(a,v,c){
					console.log(a.responseText);
				}
			});
		}
		else
		    $.alert('Please Enter Category Name..');
	});


</script>