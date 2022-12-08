 var st = 0,base_url = $('#base_url').val();


 (function() {
                                        'use strict';
                                        window.addEventListener('load', function() {
                                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                            var forms = document.getElementsByClassName('needs-validation');
                                            // Loop over them and prevent submission
                                            var validation = Array.prototype.filter.call(forms, function(form) {
                                                form.addEventListener('submit', function(event) {
                                                    if (form.checkValidity() === false) {
                                                        event.preventDefault();
                                                        event.stopPropagation();
                                                    }

                                                    form.classList.add('was-validated');
                                                }, false);
                                            });
                                        }, false);
                                    })();
                                    
                                    
$googleAnylis = '';
    function Google_Analytics(){
        // alert('Hii FaceBook');
        
        
    $googleAnylis =    $.dialog({
            title : 'Manage Google Analytics',
            icon : 'fa fa-google',
            type :'green',
            containerFluid: false,useBootstrap: true,
            bootstrapClasses: {
                container: 'container',
                containerFluid: 'container-fluid',
                row: 'row',
            },bgOpacity: null,
            columnClass : 'col-md-12',
            offsetTop: 0,
            content : function(){
                var self = this;
                return $.ajax({
                    type : 'POST',
                    url  : base_url+'Admin/AJAX',
                    data : {
                        var : 'manage_Google_Analytics'
                    },
                    dataType : 'json',
                    success : function(res){
                        console.log(res);
                        self.setContent(res.html);
                    },
                    error:function(a,b,c){
                        self.setContent(a.responseText);
                    }
                });
            }
        });
        
    }    
    $(document).on('click','.remove-google-pixel',function(){
        let id = $(this).closest('tr').data('pixel');
        $.confirm({
            type : 'red',
            title : 'Confirmation!',
            icon :' fa fa-bell',
            content : 'Are you sure for delete this <b> Google Analytics Id : '+id+' </b>',
            buttons : {
                    ok : {
                        text : '<i class="fa fa-trash"></i> Delete',
                        btnClass : 'btn-danger',
                        action : function(){
                            $.ajax({
                                type : 'POST',
                                url : base_url+'Admin/AJAX',
                                data : {
                                    id : id,
                                    var : 'remove_Google_Analytics'
                                },
                                dataType : 'json',
                                success :  function(res){
                                    if(res.status){
                                        toastr.success('Google Analytics Deleted Successfully.'); 
                                        get_Google_Analytics();
                                    }
                                },
                                error : function(a,v,c){
                                    console.log(a.responseText);
                                }
                            });
                        }
                    },
                    cancel: function(){
                        
                    }
            }
        });
    });
    $(document).on('submit','.add-google-pixel', function(e){
        e.preventDefault();
        let that = this;
        $.ajax({
            type : 'POST',
            url : base_url+'Admin/AJAX',
            data : $(this).serialize()+'&var=add_Google_Analytics',
            dataType : 'json',
            success : function(res){
                console.log(res);
                
                        toastr.success('Google Analytics Added Successfully.'); $(that)[0].reset();
                get_Google_Analytics();
                
            }
        });
        get_Google_Analytics();
    })
                                    
$faceBook_PixelBox = '';
    function manage_facebook_Pixel(){
        // alert('Hii FaceBook');
        
        
    $faceBook_PixelBox =    $.dialog({
            title : 'Manage Facebook Pixel',
            icon : 'fa fa-facebook',
            type :'green',
            containerFluid: false,useBootstrap: true,
            bootstrapClasses: {
                container: 'container',
                containerFluid: 'container-fluid',
                row: 'row',
            },bgOpacity: null,
            columnClass : 'col-md-12',
            offsetTop: 0,
            content : function(){
                var self = this;
                return $.ajax({
                    type : 'POST',
                    url  : base_url+'Admin/AJAX',
                    data : {
                        var : 'manage_facebook_Pixel'
                    },
                    dataType : 'json',
                    success : function(res){
                        console.log(res);
                        self.setContent(res.html);
                    },
                    error:function(a,b,c){
                        self.setContent(a.responseText);
                    }
                });
            }
        });
        
    }
    $(document).on('click','.remove-facebook-pixel',function(){
        let id = $(this).closest('tr').data('pixel');
        $.confirm({
            type : 'red',
            title : 'Confirmation!',
            icon :' fa fa-bell',
            content : 'Are you sure for delete this <b> Facebook pixel Id : '+id+' </b>',
            buttons : {
                    ok : {
                        text : '<i class="fa fa-trash"></i> Delete',
                        btnClass : 'btn-danger',
                        action : function(){
                            $.ajax({
                                type : 'POST',
                                url : base_url+'Admin/AJAX',
                                data : {
                                    id : id,
                                    var : 'remove_facebook_pixel'
                                },
                                dataType : 'json',
                                success :  function(res){
                                    if(res.status){
                                        toastr.success('Facebook Pixel Deleted Successfully.'); 
                                        get_facebook_pixels();
                                    }
                                },
                                error : function(a,v,c){
                                    console.log(a.responseText);
                                }
                            });
                        }
                    },
                    cancel: function(){
                        
                    }
            }
        });
    });
    $(document).on('submit','.add-facebook-pixel', function(e){
        e.preventDefault();
        let that = this;
        $.ajax({
            type : 'POST',
            url : base_url+'Admin/AJAX',
            data : $(this).serialize()+'&var=add_facebook_pixel',
            dataType : 'json',
            success : function(res){
                console.log(res);
                
                        toastr.success('Facebook Pixel Added Successfully.'); $(that)[0].reset();
                get_facebook_pixels();
                
            }
        });
        get_facebook_pixels();
    })
    
    function copy_link(e){
     var aux = document.createElement("input");
        aux.setAttribute("value", $(e).attr('src'));
        document.body.appendChild(aux);
        aux.select();
        document.execCommand("copy");
        document.body.removeChild(aux);
        st.close();
        toastr.success(' Link Copied Successfully.');
    }
    function delete__manage(id,e){
        $.confirm({
            type:'red',
            title:'Confirmation!',
            icon:'fa fa-bell',
            theme:'bootstrap',
            content:'Are you sure for delete this image.',
            buttons:{
                ok:{
                    text:'<i class="fa fa-trash"></i> Delete',
                    btnClass:'btn-danger',
                    action:function(){
                        $(e).html('<i class="fa fa-spin fa-spinner"></i>').prop('disabled',true);
                        $.ajax({
                            type:'POST',
                            url:base_url+'Admin/AJAX',
                            data:{
                                var:'delete__manage_file',id:id
                            },
                            dataType:'json',
                            success:function(_rees){
                                $(e).html('<i class="fa fa-trash"></i>').prop('disabled',false);
                                st.close();
                                toastr.success(' Deleted Successfully.'); 
                                manage_gallery();
                            },error:function(a,d,c){
                                alert(c);
                            }
                        });
                    }
                },
                cancel:function(){}
            }
        });
        
    }
    $('.slider-box-class div').click(function(){
        $('#load').show();
        $.ajax({
            type:'POST',
            url:base_url+'admin/Ajax',
            data:{var:'chnage_sidebar',slider:$(this).data('class')},
            dataType:'json',
            success:function(a){
                $('#load').hide();
                toastr.success('Slider Set Successfully.'); 
            }
        });
    });
    $('.header-set div').click(function(){
        $('#load').show();
        $.ajax({
            type:'POST',
            url:base_url+'admin/Ajax',
            data:{var:'chnage_header',header:$(this).data('class')},
            dataType:'json',
            success:function(a){
                $('#load').hide();
                toastr.success('Header Set Successfully.'); 
            }
        });
    });
    $('.manage-images').click(function(){
        var e = this,btn = $(e).html();
        $(e).html('<i class="fa fa-spin fa-refresh"></i> Please Wait..').prop('disabled',true);
        $('#load').show();
        $.ajax({
            type:'POST',
            url:base_url+'admin/AJAX',
            data:{var:'manage_files'},
            dataType:'json',
            success:function(a){
                $(e).html(btn).prop('disabled',false);
            st =   $.dialog({
                    type:'orange',
                    theme: 'bootstrap',
                    closeAnimation: 'scale',
                    backgroundDismiss: true,
                    typeAnimated:true,
                    title:'Manage Images!',
                    closeIcon:true,
                    animation:'rotate',
                    icon:'fa fa-picture',
                    columnClass:'col-md-12',
                    content:a.content
                });
            }
        });
        $('#load').hide();
    });
    function manage_gallery(){
      //  $('#load').show();
        st =    $.dialog({
                    type:'orange',
                    theme: 'bootstrap',
                    closeAnimation: 'scale',
                    backgroundDismiss: true,
                    typeAnimated:true,
                    title:'Manage Images!',
                    closeIcon:true,
                    animation:'scale',
                    icon:'fa fa-picture',
                    columnClass:'col-md-12',
                    content: function(){
                        var self = this;
                      return $.ajax({
                                type:'POST',
                                url:base_url+'admin/AJAX',
                                data:{var:'manage_files'},
                                dataType:'json',
                                success:function(a){
                                    //$('#load').hide();
                                    self.setContent(a.content);
                                },error:function(a,b,c){
                                   // $('#load').hide();
                                    self.setContent(a.responseText);
                                }
                            });
                    }
                });
       
    }
    $('#load').hide();
    
    
CKEDITOR.on('instanceReady',function () { CKEDITOR.document.appendStyleSheet(CKEDITOR.plugins.getPath('ckawesome') + 'resources/select2/select2.full.min.css');   });
CKEDITOR.on('instanceReady',function () { CKEDITOR.document.appendStyleSheet(CKEDITOR.plugins.getPath('ckawesome') + 'dialogs/ckawesome.css');   });
CKEDITOR.scriptLoader.load(CKEDITOR.plugins.getPath('ckawesome') + 'resources/select2/select2.full.min.js');
console.log(CKEDITOR.dtd.$removeEmpty.span);
//CKEDITOR.dtd.$removeEmpty.span = 0;

CKEDITOR.plugins.add('ckawesome', {
    requires: 'colordialog',
    icons: 'ckawesome',
    
    init: function(editor) {
    	var config = editor.config;
    	editor.fontawesomePath = config.fontawesomePath ? config.fontawesomePath : '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css';

    	CKEDITOR.document.appendStyleSheet(editor.fontawesomePath);
    	if( editor.addContentsCss ) {
			editor.addContentsCss(editor.fontawesomePath);
		}
    	
        CKEDITOR.dialog.add('ckawesomeDialog', this.path + 'dialogs/ckawesome.js');
        editor.addCommand( 'ckawesome', new CKEDITOR.dialogCommand( 'ckawesomeDialog', { allowedContent: 'span[class,style]{color,font-size}(*);' }));
        editor.ui.addButton( 'ckawesome', {
              label: 'Insert CKAwesome',
              command: 'ckawesome',
              toolbar: 'insert',
              icon: 'https://www.drupal.org/files/styles/grid-3-2x/public/project-images/font_awesome_logo.png?itok=26GjxSRO'
        });
    }
});

