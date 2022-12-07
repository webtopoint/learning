
<div class="row" style="padding: 0;margin:0">
	<div class="col-md-5">

		<form action="" method="POST" class="form-add-category">
			<div class="card">
				<div class="card-header bg-info text-white">
					<strong><i class="fa fa-plus"></i> Add Category</strong>
				</div>
				<div class="card-body">
					<input type="hidden" name="status" value="insertCategory">
					<div class="form-group">
						<label>Enter Name</label>
						<input type="text" class="form-control" required placeholder="Enter Name.." name="name">
					</div>
					<div class="form-group">
						<label>Enter Slug</label>
						<input type="text" class="form-control" placeholder="Enter Slug.." name="slug">
					</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
				</div>
			</div>
		</form>

	</div>
	<div class="col-md-7">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<strong><i class="fa fa-list"></i> List Category(s)</strong>
			</div>
			<div class="card-body md table-print">
				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

    $(document).on('click','.edit-category',function(){
        let btn = $(this);
        $(this).html('<i class="fa fa-spin fa-spinner"></i>').prop('disabled',true);
        let id = $(this).closest('div').data('id');
        
        var tr = $(this).closest('tr');
        $.confirm({
            title : 'Edit Category',
            icon : 'fa fa-edit',
            content : function(){
                let self = this;
                return $.ajax({
                    type : 'post',
                    url : '<?=base_url.'/Admin/news_ajax'?>',
                    data : {cat_id : id,status  : 'edit-category-box'},
                    dataType : 'json',
                    success : function(res){
                        $(btn).html('<i class="fa fa-edit"></i>').prop('disabled',false);
                        self.setContent(res.html);
                    }
                });
            },
            buttons: {
                formSubmit: {
                    text: 'Submit',
                    btnClass: 'btn-blue',
                    action: function () {
                        var name = this.$content.find('.title').val();
                        if(!name){
                            $.alert('provide a valid name');
                            return false;
                            
                        }
                        var data = this.$content.find('form').serialize()+'&status=update-news-category';
                        console.log(data);
                        $.ajax({
                            
                            type : 'POST',
                            url : '<?=base_url.'/Admin/news_ajax'?>',
                            data : data,
                            dataType  : 'json',
                            success : function(res){
                                $.alert('Category Update Successfully..');
                                getCats();
                                console.log(res);
                            },
                            error:function(e,v,cx){
                                console.log(e.responseText);
                            }
                            
                        });
                        
                    }
                },
                cancel: function () {
                    //close
                },
            },
            onContentReady: function () {
                // bind to events
                var jc = this;
                this.$content.find('form').on('submit', function (e) {
                    // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                });
            }
        });
    })

	$('.form-add-category').submit(function(e){
		e.preventDefault();
		$.ajax({
			type : 'POST',
			url : '<?=site_url()?>/Admin/news_ajax',
			data : $(this).serialize(),
			dataType:'json',
			success:function(res){
				console.log(res);
				$('.form-add-category')[0].reset();
				getCats();
			},
			error: function(a,v,c){
				console.log(a.responseText);
			}
		});
	});
	getCats();
	function getCats(){
		$('.table-print').html('<center><strong style="font-size:2em"><i class="fa fa-spin fa-spinner"></i> Please Wait.</strong></center>');
		$.ajax({
			type :'POST',
			url : '<?=site_url('Admin/news_ajax')?>',
			data : {status:'list_category'},
			dataType : 'json',
			success:function(res){
				$('.table-print').html(res.html);
			}
		});
	}
</script>