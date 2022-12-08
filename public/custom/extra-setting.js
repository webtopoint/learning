$(document).ready(function(){
    var BOX;
    $(document).on('click','.our-page-links',function(){
        
       BOX = $.dialog({
           type : 'green',
           title : 'All Page(s)',
           content : 'url:'+base_url + '/assets/all_pages_links/table/'+$(this).siblings('textarea').attr('id'),
           
       }); 
    });
    $(document).on('click','.extra-set-in-page',function(){
        var that = this,
            full_title = $(that).text(),
            title = $(that).data('title'),
            type = $(that).data('type'),
            type_id = $(that).data('type_id');
            // console.log({type_id,type});
       BOX = $.dialog({
            type : 'green',
            title : full_title,
            theme : 'bootstrap',
            content : function(){
                var self = this;
                return $.ajax({
                            type : 'POST',
                            data : {type_id,type},
                            url  : base_url + '/assets/all_pages_extra_set_in_page',
                            success : function(res){
                                // console.log(res);
                                self.setContent(res);
                            },
                            error: function(a,v,c){
                                console.warn(a.responseText);
                                self.setContent(a.responseText);
                            }
                        });
            }
       });
        
        
    });
    $(document).on('click','.set-exta-in-page',function(){
        var table = $(this).closest('table'),
            type = $(table).data('type'),
            type_id = $(table).data('type_id'),
            page_id = $(this).data('id'),
            that = this;
        $(this).html('<i class="fa fa-spin fa-spinner"></i> Wait...').prop('disabled',true);
        var data = {type,type_id,page_id};
        $.ajax({
            type : 'POST',
            data : data,
            url : base_url + '/settings/set_in_page_submit',
            dataType:'json',
            success:function(res){
                if(res.status)
                    toastr.success(res.message);
                else    
                    toastr.error(res.message);
                $(that).html('Action').prop('disabled',false);
            },
            error:function(a,v,c){
                console.warn(a.responseText);
                $(that).html('Action').prop('disabled',false);
            }
        });
    });

    $(document).on('click','.set-link',function(){
        $('#'+$(this).data('id')).val($(this).data('url'));
        BOX.close();
    })
    
    $('form[action="'+base_url+'settings/v1/submit"]').submit(function(e){
        e.preventDefault();
        $('#load').show();
        var button = $(this).find('.card-footer > button'),
            btnHtml = $(button).html(),
            form_data = new FormData(this),
            that = this;
            
            $(this).find('textarea.aryaeditor').each(function(){
                var id = $(this).attr('id'),
                    name = $(this).attr('name');
                var content = tinyMCE.get(id).getContent();
                form_data.append(name,content);
            });
            
            $(this).find('input,textarea,button,select').prop('disabled',true);
            // });
            
            $(button).html('<i class="fa fa-spin fa-spinner"></i> Please Wait...').prop('disabled',true);
        
        $.ajax({
            type : 'POST',
            url : $(this).attr('action'),
            data : form_data,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType : 'json',
            success : function(res){
                if(res.status)
                    toastr.success(res.message);
                else
                    toastr.success(res.message);
                    $('#load').hide();    
                $(button).html(btnHtml).prop('disabled',false);
                $(that).find('input,textarea,button,select').prop('disabled',false);
            },
            error:function(a,v,c){
                $.confirm({
                    title : 'Error',
                    type : 'red',
                    content : a.responseText
                });
                $('#load').hide(); 
                $(button).html(btnHtml).prop('disabled',false);
                $(that).find('input,textarea,button,select').prop('disabled',false);
            }
        });
        
        // console.log($(this).serialize());
    });
    
    
    
    
});