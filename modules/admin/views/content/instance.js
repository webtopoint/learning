
    $(document).on('click','.delete-content-area',function(){
        let id = $(this).data('id'),
            that = $(this).closest('tr');
        $.confirm({
            type : 'red',
            title : 'Confirmation!',
            icon  : 'fa fa-bell',
            theme : 'bootstrap',
            content : 'Are you sure for delete this Content??',
            buttons : {
                ok : {
                  text : ' <i class="fa fa-trash"></i> Delete ',
                  btnClass : 'btn-danger',
                  action : function(){
                      $.ajax({
                          type : 'POST',
                          url : base_url+'Admin/AJAX',
                          data : { var : 'removeContentArea' , id : id },
                          dataType : 'json',
                          success : function(status){
                              console.log(status);
                              $(that).remove();
                          },
                          error:function(a,v,c){
                              console.log(a.responseText);
                          }
                      });
                  }
                },
                cancel:function(){}
            }
        });
    });


 
    $('.select-event').click(function(){
        //$(this).prop('disabled',true).html('<i class="fa fa-spin fa-spinner"></i> Please Wait...');
        let that = this;
        let index_val = $(this).parent().parent().find('.index-val').val();
       
                if(true){
                    
                    $.confirm({
                        title : 'Select Event (s)',
                        icon : 'fa fa-plus',
                        type : 'red',
                        theme : 'dark',
                        content : '<form class="temp-form" >\
                                        <ul class="list-group">\
                                            <li class="list-group-item"><label><input type="checkbox" data-html="Content" value="content" data-des="Content Data"> Content</label></li>\
                                            <li class="list-group-item"><label><input type="checkbox" data-html="Form" value="form" data-des="Simple Form"> Form</label></li>\
                                            <li class="list-group-item"><label><input type="checkbox" data-html="Title News List" value="titleNewsList" data-des="Title News List"> List News </label></li>\
                                            <li class="list-group-item"><label><input type="checkbox" data-html="Thumbnail News List" value="thumbnailNewsList" data-des="Thumbnail News List">  List News Thumbnail</label></li>\
                                            <li class="list-group-item"><label><input type="checkbox" data-html="News Slider" value="newsSlider" data-des="News Slider"> News Slider</label></li>\
                                            <li class="list-group-item"><label><input type="checkbox" data-html="Transaction Form" value="tform" data-des="Transaction Form"> Transaction Form</label></li>\
                                            <!--- li class="list-group-item"><label><input type="checkbox" data-html="Carousel" value="carousel" data-des="Carousel"> Carousel</label></li>\
                                            <li class="list-group-item"><label><input type="checkbox" data-html="Marquee" value="marquee" data-des="Marquee"> Marquee</label></li --->\
                                        </ul>\
                                </form>',
                        buttons : {
                            ok : {
                                
                                text : '<i class="fa fa-plus"></i> Add',
                                btnClass : 'btn-success',
                                action : function(){
                                    
                                    let $form       =   this.$content.find('.temp-form'),
                                        inputs      =   $form.find('input:checked'),
                                        html        =   '';
                                    $(inputs).each(function(i , e){
                                    $('.div-'+index_val).append('<div class="col-md-12 process-div">\
                                                    <div class="card mb-1 widget-content bg-midnight-bloom">\
                                                        <div class="widget-content-wrapper text-white">\
                                                            <div class="widget-content-left">\
                                                                <div class="widget-heading"><i class="fa fa-spin fa-spinner"></i> Please Wait..</div>\
                                                            </div>\
                                                        </div>\
                                                    </div>\
                                                </div>');
                                    });
                                    
                                    
                                    //console.log(inputs);
                                    setTimeout(function(){
                                        $(inputs).each(function(i , e){
                                            
                                            html += '<div class="col-md-12">\
                                                        <input type=hidden name="type['+index_val+'][]" value="'+e.value+'">\
                                                        <div class="card mb-1 widget-content bg-midnight-bloom" id="proccess-'+( $k++) +'">\
                                                            <div class="widget-content-wrapper text-white">\
                                                                <div class="widget-content-left">\
                                                                    <div class="widget-heading" id="title">'+$(e).data('html')+'</div>\
                                                                    <div class="widget-subheading">'+$(e).data('des')+'</div>\
                                                                </div>\
                                                                <div class="">\
                                                                    <input type="hidden" class="title" name="title['+index_val+'][]" value="'+$(e).data('html')+'">\
                                                                    <input type="hidden" class="content" name="content['+index_val+'][]" value="">\
                                                                </div>\
                                                                <div class="widget-content-right">\
                                                                    <div class="widget-numbers text-warning">\
                                                                            <a href="javascript:void(0)" data-type="'+e.value+'" data-c="'+$k+'" data-id="'+index_val+'" class="mb-2 mr-2 btn-transition btn btn-outline-dark add-event-data" style="color:white"><i class="fa fa-cog"></i></a>\
                                                                            <a href="javascript:void(0)" class="mb-2 mr-2 btn-transition btn btn-outline-danger remove-event-data" style="color:white"><i class="fa fa-times"></i></a>\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                        </div>\
                                                    </div>';
                                                    $k++;
                                        });
                                        $('.div-'+index_val).append(html).sortable().disableSelection().find('.process-div').remove();
                                    },700);
                                    //$('.div-'+index_val)
                                }
                                
                            },
                            cancel : function(){
                                
                            }
                        }
                        
                    });
                    
                }
               
    });
    
    
$(document).on('click','.add-event-data',function(){
    let id = $(this).data('id'),
        type = $(this).data('type'),
        that = this,
        $parentDiv = $(this).closest('.col-md-12'),
        title = $parentDiv.find('.title').val(),
        content = $parentDiv.find('.content').val();
        NProgress.configure({ parent: '#'+$($parentDiv).find('.card').attr('id') });
        NProgress.start();
        
    $(this).prop('disabled',true).html('<i class="fa fa-spin fa-spinner"></i>');
    $.ajax({
        type : 'POST',
        url : base_url+'/Admin/AJAX',
        data : { id : id , type : type , content : content, title : title, var : 'contentEventData' },
        dataType : 'json',
        success:function(res){
            NProgress.done();
            $.confirm({
                type : 'green',
                title : 'Setting',
                icon :' fa fa-cog',
                bgOpacity: 0.9,
                columnClass:'col-md-12',
                closeIcon:true,
                content : res.html,
                buttons : {
                    save : {
                        text : '<i class="fa fa-plus"></i> save',
                        btnClass : 'btn-success',
                        action : function(){
                            
                            let all = this.$content,
                            
                                title = all.find('#title').val();
                                $parentDiv.find('.title').val(title);
                                $parentDiv.find('#title').html(title),
                                msg = all.find('.message'),
                                content = $parentDiv.find('.content');
                                
                            switch(type){
                                
                                case 'content':
                                    for(var instanceName in CKEDITOR.instances)
                                        CKEDITOR.instances[instanceName].updateElement();
                                    content.val(all.find('.arya-editor').val());
                                break;
                                
                                case 'form': case 'tform':
                                    if(all.find('#form_id').val() == 0){
                                        msg.html('<div class="col-md-12 alert alert-danger">Please Select A Form..</div>');
                                        return false;
                                    }
                                    content.val(all.find('#form_id').val());
                                break;
                                
                                case 'newsSlider': case 'titleNewsList': case 'thumbnailNewsList':
                                    msg.html('');
                                    if( ! all.find('#cat_ids option:selected').length ){
                                        msg.html('<div class="col-md-12 alert alert-danger">Please Select Category..</div>');
                                        return false;
                                    }
                                    if(!  parseInt(all.find('#number_of_post').val() ) ){
                                        msg.html('<div class="col-md-12 alert alert-danger">Please Select Category..</div>');
                                        return false;
                                    }
                                    let cats= [];
                                    all.find('#cat_ids option:selected').each(function(i,v){
                                        cats[i] = v.value;
                                    });
                                    content.val(JSON.stringify({
                                        'category' : cats,
                                        'number_of_post' : all.find('#number_of_post').val()
                                    }));
                                break;
                                
                            }
                            $(that).prop('disabled',false).html('<i class="fa fa-cog"></i>');
                        },
                    },
                    cancel:function(){ $(that).prop('disabled',false).html('<i class="fa fa-cog"></i>');}
                }
            });
        },
        complete:function(){
          NProgress.remove();  
        },
        error :  function(a , c , f){
          NProgress.remove();  
            console.log(a.responseText);
            $(that).prop('disabled',false).html('<i class="fa fa-cog"></i>');
        }
    });
});



$(document).on('click','.remove-event-data',function(){
    let that = this;
    $.confirm({
        type : 'red',
        title : 'Confirmation!',
        icon :' fa fa-bell',
        theme : 'bootstrap',
        content : 'Are you sure for remove this Event.',
        buttons  : {
                ok : {
                    text : '<i class="fa fa-times"></i> Remove',
                    btnClass: 'btn-danger',
                    action : function(){
                        $(that).closest('.col-md-12').remove();
                    }
                },
                cancel:function(){}
        }
    });
})
    
    $(document).on('click','.radioForm',function(){
        $('.message').html('');
        $('#form_id').val($(this).data('id') );
        $('.radioForm').removeClass('checked');
        $(this).addClass('checked');
        $('.title-input').val( $(this).text() );
    });