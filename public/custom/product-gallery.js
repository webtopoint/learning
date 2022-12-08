$('.gallery_setting').addClass('mm-active');

$('.prd_gallery').addClass('mm-active');

 $(".delete-product-gallery").click(function(){
        var id  = $(this).data('id');
        var num = $(this).data('num');
        if(!num)
        {
                $.confirm({

                    type:'red',

                    title:'Confirmation',

                    icon:'fa fa-eye',

                    content:'Are You sure for delete this Product Gallery.',

                    buttons:{

                        ok:{

                            text:'<i class="fa fa-trash"></i> Delete',

                            btnClass:'btn-danger',
                            action:function(){
                                location.href=base_url+'Admin/delete-product-gallery/'+id;
                            }
                        },
                        cancel:function(){}
                    }

                });
        }
        else
        {
                $.dialog({

                type:'red',

                theme:'supervan',

                title:'Notification',

                icon:'fa fa-bell',

                content:'First delete all the Products from gallery. Only Empty Gallery can be deleted.',

            });
        }
  });