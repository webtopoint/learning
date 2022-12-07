	<div class="col-md-12" style="padding: 10px">
		<a href="/Admin/tab/add" class="btn btn-primary">Add Tab</a>
	</div>

	<div class="col-md-12">

		<div class="card">
			<div class="card-header">
				<strong>List Tab(s)</strong>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-bordered table-striped">
						<thead>
							<tr>
								<th>#.</th>
								<th>Tab Name</th>
								<th>Use in Page</th>
								<th>Setting</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?
							$i = 1;
							foreach (  $list    as   $row   ) {
								echo '<tr data-id="'.$row['id'].'">
										<td>'.$i++.'.</td>
										<td>'.$row['title'].'</td>
										<td><button class="btn btn-xs btn-sm btn-primary set-in-page">Set in Page</button></td>
										<td><button class="btn btn-xs btn-sm btn-success setting-tab"><i class="fa fa-cog"></i></button></td>
										<td><button class="delete-tab btn-danger btn btn-xs btn-sm"><i class="fa fa-trash"></i></button></td>
									</tr>';
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>


		


	</div>

	<script type="text/javascript">
	
	    $(document).on('click','.setting-tab',function(){
	        
	        let id = $(this).closest('tr').data('id'),
	            that = this;
	            
	            $(this).html('<i class="fa fa-spin fa-spinner"></i>').prop('disabled',true);
	            
	            $.dialog({

                    theme:'bootstrap',
    
                    closeAnimation: 'rotateYR',
    
                    title:'Tab Setting',
    
                    icon:'fa fa-cog',
    
                    boxHeight:'100%',
    
                    columnClass:'container',
	                content : function(){
	                    let self = this;
	                    return $.ajax({
	                        type : 'POST',
	                        url : base_url + '/Admin/AJAX',
	                        data : {var : 'tab_setting', id : id },
	                        dataType : 'json',
	                        success: function(res){
	                            console.log(res);
	                            self.setContent(res.html)
	                            $(that).html('<i class="fa fa-cog"></i>').prop('disabled',false);
	                        },
	                        error : function(a,v,c){
	                            console.log(a.responseText);
	                            $(that).html('<i class="fa fa-cog"></i>').prop('disabled',false);
	                        }
	                    });
	                }
	            });
	            
	    });
	$(document).on('click','.delete-tab',function(){
	
	     alert(0);
	});
		$(document).on('click','.tab-set-in-page',function(){
			$(this).attr('disabled',true);
			let v = $(this).val(),
				that = this,
				checked = this.checked,
				key_id = $(this).data('tab_id');
				
			$('.loadder-'+v).fadeIn(600);
			$.ajax({
				type :'POST',
				url : base_url+'/Admin/Ajax',
				data : {page_id:v,var:'tab_set_in_page',checked:checked,key_id:key_id},
				dataType : 'json',
				success : function(res){
					toastr.success(res.message);
					$(that).attr('disabled',false);
					$('.loadder-'+v).fadeOut(600);
					console.log(res);
				},
				error : function(a,v,c){
					console.log(a.responseText);
				}
			});

		})
		$(document).on('click','.set-in-page',function(){
			let id = $(this).closest('tr').data('id');
			$.dialog({
				type : 'green',
				theme : 'bootstrap',
				icon :' fa fa-files-o',
				title : 'Set in Page',
				content : function(){
					var self = this;
					return $.ajax({
						type : 'POST',
						url : base_url+'/Admin/AJAX',
						data : {var : 'tab_use_in_page', id : id},
						dataType :'json',
						success : function(r){
							self.setContent(r.html);
						},
						error : function(a,v,c){
							self.setContent(a.responseText);
						}
					});
				}
			});
		})
	</script>