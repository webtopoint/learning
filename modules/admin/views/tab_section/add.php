
<style type="text/css">
	.nav-tabs a input{
		outline: 0;
		border:0!important;		
		background:transparent;
		color:white;
	}
	.nav-tabs a{
		color:black;
	}
	.nav-tabs li{
		border:	1px solid white ;
		padding: 10px;
		border-radius:10px 10px 0 0 ;
		border-bottom: 1px solid #dee2e6!important;
	}
	.nav-tabs {
    /* border-bottom: 1px solid #dee2e6; */border:0!important;		
}
	.nav-tabs li.active{
		border:	1px solid #d2caca ;
		border-bottom:0!important;
		background:white;
	}
	.nav-tabs li.active a input{
		color: black		
	}
	.nav-tabs li.active a.remove-tab-option{
		color: black;
	}
	.tab-title{
		font-weight: 700;
	    color: #bbb6b6;
	    text-shadow: 0 1px 1px black;
	    font-family: cursive;
	    padding-left:20px;
	}
	.nav-pills, .nav-tabs {
		margin-bottom:0!important;
	}
	.tab-section{
		overflow-x: hidden;
		background:#440505
	}
	.tab-pane.active{
		background:white;
	}
	a.remove-tab-option {
	    color:white;
	    text-shadow: 0 1px 1px black;
	    text-decoration: none;
	    text-transform: none;
	}
</style>
<form class="col-md-12 add-tab-form">
	<div class="card card-primary">
		<div class="card-header">
			<i class="fa fa-plus"></i>    Create A New Tab
		</div>
		<div class="card-header">

			<div class="col-md-6">
				<div class="form-group">
					<p class="heading"><input type="text" name="title" autofocus required placeholder="Enter Tab Title"> </p>
				</div>
			</div>
			<div class="col-md-6">
				<button class="btn btn-primary add-tab-option btn-xs" type="button"> <i class="fa fa-plus"></i> Add Option</button>
				<button class="btn btn-success btn-xs" > <i class="fa fa-floppy-o"></i> Save</button>
			</div>

		</div>
		
		<div class="card-body tab-section" >

				<ul class="nav nav-tabs">
				    
				  </ul>

				<div class="tab-content">
				    
				</div>
		</div>
	</div>
</form>



<script type="text/javascript">
	//CKEDITOR.replace('arya');

	let count = 0;
	function updateCkeditor(){
		$('textarea.ckeditor').each(function () {
		   var $textarea = $(this);
		   $textarea.val(CKEDITOR.instances[$textarea.attr('name')].getData());
		});
	}
	$(document).on('click','.nav-tabs li > a',function(){
		
		$('.nav-tabs li').removeClass('active');
		$(this).closest('li').addClass('active');

	});
	
	$(document).on('focus','.input-css,.remove-tab-option',function(){
		$(this).closest('li').find('.tab_a').click();
		$('.tab-section').find('.tab-content').find('.tab-pane').removeClass('show').removeClass('active');
		$('#tab-'+ $(this).closest('li').data('key') ).addClass('show').addClass('active');
	})

	$('.add-tab-option').click(function(){
		var nav_tabs = $('.tab-section');

			$(nav_tabs).find('.nav-tabs li').removeClass('active');

			$(nav_tabs).find('.nav-tabs').append(`

					<li class="active tab-`+count+`" data-key="`+count+`">
						<a data-toggle="tab" href="#tab-`+count+`" class="tab_a">
							<input value="Title `+(count+1)+`" required class="input-css" name="tab[`+count+`]" onkeyup="$('.tab-title-`+count+`').text(this.value)">
						</a> 
						<a href="javascript:void(0)" class="remove-tab-option" data-id="`+count+`"> x</a>
					</li>

				`);
			$(nav_tabs).find('.tab-content').find('.tab-pane').removeClass('show').removeClass('active');

			$(nav_tabs).find('.tab-content').append(`

				<div id="tab-`+count+`" class="tab-pane in active show">
						<h3 class="tab-title tab-title-`+count+`">Title `+(count+1)+`</h3>
				      	<textarea  class="ckeditor" name="arya_`+count+`">`+(count+1)+`</textarea>
				</div>

			`);
			CKEDITOR.replace('arya_'+count);
			count++;

	});

	$(document).on('click','.remove-tab-option',function(){
		
		let id = $(this).data('id');
		$.confirm({
			type :'red',
			title :' Confirmation!',
			icon : 'fa fa-bell',
			content : 'Are you sure for remove it.',
			buttons : {
				ok : {
					text : 'Remove',
					btnClass : 'btn-danger',
					action : function(){
						$('.tab-'+id).remove();
						$('#tab-'+id).remove();
					}
				},
				cancel:function(){}
			}
		});
	});


	$(document).on('submit','.add-tab-form',function(event) {
		event.preventDefault();
		if(!count){

			$.confirm({
				type : 'red',
				icon : 'fa fa-bell',
				title : 'Notify.',
				closeIcon : true,
				content : 'First Add option is Requried..',
				buttons  : {
					ok : {
						text : 'Try Again',
						btnClass : 'btn-success',
						action : function(){}
					}
				}
			});
			return false;
		}

		updateCkeditor();
		$.ajax({
			type : 'POST',
			url : base_url + '/Admin/ajax',
			data : $(this).serialize()+'&var=add_tab',
			dataType : 'json',
			beforeSend : function(){
				$('#load').show();
			},
			success : function(res){
				//$('#load').hide();
				$('.add-tab-form').html('<center><h3><i class="fa fa-spin fa-spinner"></i> Please Wait..</h3></center>');
				location.href=base_url+'/Admin/tab';
			},
			error : function(a,v,c){
				console.log(a.responseText);
			}
		});

	})


</script>



