$('.image_gllery_setting').click(function(){

    console.log($(this).data('id'));

    alert("");

});



$('.gallery_setting').addClass('mm-active');

$('.img_gallery').addClass('mm-active');

//list_image_gallery();

$('.delete-image-gallery').click(function(){

	var num = $(this).data('num');
	var id=$(this).data('id');
	$('#load').show();

	if(num){

		$('#load').hide();

		$.dialog({

			type:'red',

			theme:'supervan',

			title:'Notification',

			icon:'fa fa-bell',

			content:'First delete all the pictures in this gallery, after that this gallery will be deleted.',

		});

		return false;

	}



	$.confirm({

		type:'red',

		title:'Confirmation',

		icon:'fa fa-eye',

		content:'Are You sure for delete this gallery.',

		buttons:{

			ok:{

				text:'<i class="fa fa-trash"></i> Delete',

				btnClass:'btn-danger',

				action:function(){

					$.ajax({

						type:'POST',

						url:base_url+'Admin/AJAX',

						data:{

							var:'delete_image_gallery',

							id:id

						},

						dataType:'json',

						success:function(res){

							$('#load').hide();

							toastr.success('Image Gallery Delete Successfully.');

							setTimeout(function(){location.reload();},500);

						}

					});

				}

			},

			cancel:function(){$('#load').hide();}

		}

	});

});

$('.add_gallery_form').submit(function(event){

	event.preventDefault();

	if($(this).find('input[name=gallery_name]').val().trim()==''){

		return false;

	}

	$('#load').show();

	$.ajax({

		type:'POST',

		url:base_url+'Admin/AJAX',

		data:{var:'add_image_gallery'},

		dataType:'json',

		success:function(q){

			$('#load').hide();

			alert(q.status);

		},

		error:function(a,c,v){

			alert(v);

		}

	});

});

function list_image_gallery(){

	$('#load').show();

	$.ajax({

		type:'POST',

		url:base_url+'Admin/AJAX',

		data:{var:'image_gallery'},

		dataType:'json',

		success:function(r){

			$('#load').hide();

			//alert(r.status);

		},error:function(a,b,c){

			alert(c);

		}



	});

}