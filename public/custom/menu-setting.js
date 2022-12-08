

$(document).on('submit','.update-menu-data',function(er){
    er.preventDefault();
    
    let menu_id = $('#MENU_ID').val();
    $('.icon-proccess').html('<div class="alert alert-info"><i class="fa fa-spin fa-spinner"></i> Please Wait....</div>');
    $.ajax({
       type : 'POST',
       url : base_url+'/admin/AJAX',
       data : $(this).serialize()+'&var=save_menu_data&menu_id='+menu_id,
       dataType : 'json',
       success:function(res){
           console.log(res);
           toastr.success('Menu update Successfully..');
           $('.icon-proccess').html('<div class="alert alert-success">Menu update Successfully..</div>').css('textTransform', 'capitalize');;
       },
       error:function(r,v,c){
           console.log(r.responseText);
       }
   });
    
})

function SingleMenuSetting(menu_id){
    
    $.dialog({
        
        type:'dark',
        columnClass:'container',
        theme: 'bootstrap',
        icon:'fa fa-cog',
        title:'Menu Setting',
        openAnimation: 'rotateXR',
        closeAnimation: 'rotateXR',
        content: function () {

                        var self = this;

                        return $.ajax({

                                    type:'POST',

                                    url: base_url+'admin/AJAX',

                                    data:{var:'SingleMenuSetting',MenuId:menu_id},

                                    dataType: 'json',

                                    success:function(response){

                                        self.setContent(response.html);

                                    },error:function(a,c,v){

                                        self.setContent(a.responseText);

                                    }

                                });

                    }
    });
}



$(document).on('click','.delete-menu',function(){
    var event       =   $(this).data('event'),
        id          =   $(this).data('id');
        
    if(event){
        $.confirm({
            title : 'Notification!',
            type : 'red',
            theme : 'bootstrap',
            content : 'Are you sure for delete this menu..',
            buttons : {
                ok : {
                    text : 'Delete',
                    btnClass : 'btn-danger',
                    action:function(){
                        $('.print-menu-div').html(`  <center><img style="width:60%" src="https://thumbs.gfycat.com/HugeDeliciousArchaeocete-max-1mb.gif"></center>        `);
                        $.ajax({
                            type : 'POST',
                            url : base_url+'admin/Ajax',
                            data : { var : 'delete-menu-group', id : id},
                            dataType : 'json',
                            success : function(){
                                toastr.success('Menu Deleted Successfully..');
                                $('.menu-header').removeClass('card-header').html('');
                                $('.print-menu-div').html('');
                                $('.print-menu-'+id).remove();
                                $('.footer-menu').removeClass('card-footer').html('');
                                $('.first-footer').removeClass('card-footer').html('');
                            }
                        });
                    }
                },
                Cancel:function(){}
            }
        });
    }
    else{
        $.confirm({
            title : 'Notification!',
            type : 'red',
            theme : 'bootstrap',
            content : 'This menu is default menu , it can not be delete.',
            buttons : {
                ok : {
                    text : 'OK',
                    btnClass : 'btn-success',
                    action:function(){
                    }
                }
            }
        });
    }
})
$(document).on('click','.menu-setting',function(){
    let group_id = $(this).data('id');
    $.dialog({

                type:'dark',

                theme:'bootstrap',

                closeAnimation: 'rotateYR',

                title:'Menu Setting',

                icon:'fa fa-cog',

                boxHeight:'100%',

                columnClass:'container',

                content: function () {

                        var self = this;

                        return $.ajax({

                                    type:'POST',

                                    url: base_url+'admin/AJAX',

                                    data: { var: 'menu_setting' , group_id : group_id },

                                    dataType: 'json',

                                    success:function(response){
                                        console.log(response);
                                        self.setContent(response.html);
                                    },error:function(a,c,v){
                                        console.log(a);
                                        self.setContent(a.responseText);

                                    }

                                });

                    }

    });

});

$('.add-pages-to-menu').submit(function(event){

    event.preventDefault();

    //console.log( $( this ).serialize() );

    $('#load').show();
    var group_name = $('#group_name').val(),
        group_id = $('#group_id').val();
    $.ajax({

        type:$(this).attr('method'),

        url:base_url+'admin/AJAX',

        data:$(this).serialize()+'&var=add_pages_TO_menu&group_name='+group_name+'&group_id='+group_id,

        dataType:'json',

        cache : false,

        success:function(_res){

            $('#load').hide();

            toastr.success(_res.message,'Notification');

            $("#menu-id").prepend(_res.menu);

        },error:function(a,b,c){

            alert(c);

        }



    });

});


$('.add-category-to-menu').submit(function(event){

    event.preventDefault();

    //console.log( $( this ).serialize() );

    $('#load').show();
var group_name = $('#group_name').val(),
        group_id = $('#group_id').val();
    $.ajax({

        type:$(this).attr('method'),

        url:base_url+'admin/AJAX',

        data:$(this).serialize()+'&var=add_cats_TO_menu&group_name='+group_name+'&group_id='+group_id,

        dataType:'json',

        cache : false,

        success:function(_res){

            $('#load').hide();

            toastr.success(_res.message,'Notification');

            $("#menu-id").prepend(_res.menu);

        },error:function(a,b,c){

            alert(c);

        }



    });

});



	$('.ui_setting').addClass('mm-active');

	$('.menu_section').addClass('mm-active');

	$('.create-menu').submit(function(event){

		event.preventDefault();

		var s = this;
        let group_id =  $('#group_id').val();
		if($('input[name=label]').val().trim()==''){

			return false;

		}
		if(group_id == 'add'){
		  $.confirm({
		      type : 'red',
		      theme : 'bootstrap',
		      title : 'Notification.',
		      content : 'Please Create Menu First, then create menu.'
		  });  
		  return false;
		}
		//

		$('#load').show();

		$.ajax({

            type: "POST",

            url: base_url+'admin/add_menu',

            data: $(this).serialize() + '&group_id='+group_id,

            dataType: "json",

            cache : false,

            success: function(data){

              if(data.status){

                 $("#menu-id").append(data.menu);

                 $('.create-menu')[0].reset();

              }else{

              	alert('This is already exists.');

              } 

              $('.create-menu').removeClass('was-validated');

              $("#load").hide();

            } ,error: function(xhr, status, error) {

              alert(error);

            },

        });

	});


$(document).ready(function(){

    $("#load").hide();

    $("#submit").click(function(){

       $("#load").show();



       var dataString = { 

              label : $("#label").val(),

              link : $("#link").val(),

              id : $("#id").val()

            };



        $.ajax({

            type: "POST",

            url: base_url+'admin/add_menu',

            data: dataString,

            dataType: "json",

            cache : false,

            success: function(data){

              if(data.type == 'add'){

                 $("#menu-id").append(data.menu);
                 

              } else if(data.type == 'edit'){

                 $('#label_show'+data.id).html(data.label);

                 $('#link_show'+data.id).html(data.link);

              }

              $('#label').val('');

              $('#link').val('');

              $('#id').val('');

              $("#load").hide();

            } ,error: function(xhr, status, error) {

              alert(error);

            },

        });

    });



    $(document).on('change','.dd', function() {


          var dataString = { 

              data : $("#nestable-output").val(),

            };
console.log($("#nestable-output").val());

/*
        $.ajax({

            type: "POST",

            url: base_url+'Admin/save_menu',

            data: dataString,

            cache : false,

            success: function(data){

              $("#load").hide();

            } ,error: function(xhr, status, error) {

              alert(error);

            },

        });*/

    });



    $(document).on('click',"#save",function(){
  
         $("#load").show();

          var icon = '';
          $('.menu-icon').each(function(i,b){
              icon += 'icon_'+$(b).closest('.dd3-item').data('id')+'|||'+$(b).val()+':::';
          });
      
          var dataString = { 

                            data                :       $("#nestable-output").val(),
                            group_name          :       $('#group_name').val(),
                            group_id            :       $('#group_id').val(),
                            isPrimary           :       $('#isPrimary').is(':checked') ? 1 : 0,
                            isSecondary         :       $('#isSecondary').is(':checked') ? 1 : 0,
                            icon                   :       icon
            };
            console.log(dataString);
            console.log(icon);

        $.ajax({

            type: "POST",

            url: base_url+'admin/save_menu',

            data: dataString,
            dataType : 'json',
            success: function(data){
                
                console.log(data);
                if(data.isGroupAdd){
                    
                    $('#group_id').val(data.group_id);
                    //groups-nav
                    $(document).find( "ul.groups-nav li:nth-last-child(2)" ).append( data.li ).click();
                    
                }
              $("#load").hide();

              toastr.success('Data has been saved.');          

            } ,error: function(xhr, status, error) {

              toastr.error(error);

            },

        });

    });



 

    $(document).on("click",".del-button",function() {

    	 var id = $(this).attr('id');

    	$.alert({

    		type:'red',

    		title:'Confirmation!',

    		icon:'fa fa-eye',

    		typeAnimated:true,

    		content:'Delete This menu',

    		buttons:{

    			delete:{

    				text:'<i class="fa fa-trash"></i> Delete',

    				btnClass:'btn-danger',

    				action:function(){

    					$("#load").show();

			             $.ajax({

			                type: "POST",

			                url: base_url+'admin/delete_menu',

			                data: { id : id },

			                cache : false,

			                success: function(data){

			                  $("#load").hide();

			                  $("li[data-id='" + id +"']").remove();

			                  toastr.success('This menu deleted successfully..');

			                } ,error: function(xhr, status, error) {

			                  alert(error);

			                },

			            });

    				}

    			},

    			cancel:{

    				text:'Cancel',

    				btnClass:'btn-primary',

    				action:function(){}

    			}

    		}

    	});

    });



    $(document).on("click",".edit-button",function() {

        var id = $(this).attr('id');

        var label = $(this).attr('label');

        var link = $(this).attr('link');

        $("#id").val(id);

        $("#label").val(label);

        $("#link").val(link);

    });



    $(document).on("click","#reset",function() {

        $('#label').val('');

        $('#link').val('');

        $('#id').val('');

    });



  });