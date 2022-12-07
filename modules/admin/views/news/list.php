<div class="card">
	<div class="card-header bg-primary text-white">
		<strong><i class="fa fa-list"></i> List Post(s)</strong>
	</div>
	<div class="card-body">
		<table id='post' class="table table-bordered">
			<thead>
			<tr>
				<th>#</th>
				<th>Title</th>
				<th>Create Time</th>
				<th>Update Time</th>
				<th>Category</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
		<div id='pagination'></div>
	</div>
</div>


<script type='text/javascript'>
$(document).ready(function() {
	createPagination(0);
	$('#pagination').on('click','a',function(e){
		e.preventDefault(); 
		var pageNum = $(this).attr('data-ci-pagination-page');
		createPagination(pageNum);
	});
	function createPagination(pageNum){
	
		$('#post tbody').html(`<tr>
							<td colspan="6">
								<div style="width: 100%;font-size:2em;text-align: center;padding: 2em;">
									<i class="fa fa-spin fa-spinner"></i> Loading Posts
								</div>
							</td>					
						</tr>`);
		$.ajax({
			url: '<?=base_url?>/Admin/news/ajax-list/'+pageNum,
			type: 'get',
			dataType: 'json',
			success: function(responseData){
				
				$('#pagination').html(responseData.pagination);
				$('#post tbody').empty();
				$('#post tbody').append(responseData.postData);	
			},
			error : function(e,c,x){
				console.log(e.responseText);
			}
		});
	}
});
</script>