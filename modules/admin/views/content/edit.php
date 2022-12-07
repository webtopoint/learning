<?
if(!$id)
    redirect(base_url.'/Admin/content/add');
    
$id = AJ_DECODE($id);
?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div>Edit Content Category

                                        <div class="page-title-subheading">

                                        </div>

                                    </div>

                                </div>  

                            </div>

</div> 

<style>
    .heading input {
    font-weight: bold;
    font-size: 22px;
    padding: 5px;
    width: 100%;
    border: 0px;
    outline: 0px;
}
.card .row{
    padding:0;
    margin:0;
}
.box-design{
    border:1px dotted red;
    min-height:100px
}
.box-design .card-body{
    overflow-x:hidden;
    padding-top:10px;
}
.list-group-item{
    background-color: #000!important;
    border: 1px solid rgb(68 68 68)!important;
    padding: .5rem 1.25rem!important;
}


</style>
<?
$k = 1;
$rt     =   $this->db->get_where('content',['id'=>$id])->row();

$data   =   (array) json_decode( $rt->data , true );
/*
echo '<pre>';

print_r($data);

echo '</pre>';

*/
$des = ['form' => 'Simple Form','content' => 'Content Data','tform'=>'Transaction Form'];
?>
<form class="container" method="post">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    
                    <h4><i class="fa fa-edit"></i> Edit Custom Content</h4>
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm nav btn-group">
                            <button  class="btn btn-outline-focus"><i class="pe-7s-paper-plane"></i> Update</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="heading"><input type="text" name="content_title"  required placeholder="Enter Form Title" value="<?=$rt->content_title?>"> </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card box-design">
                                <input type="hidden" name="index[]" class="index-val" value="0">
                                <input type="hidden" name="class[0]" value="col-md-6"> 
                                <input type="hidden" name="setting[0]" value=""> 
                                
                                <div class="card-header">
                                    <h4>Box</h4>
                                </div>
                                <div class="card-body box-div div-0 row">
                                    <?
                                    
                                    foreach($data['type'][0] as $index => $val){
                                        
                                            
                                            echo '<div class="col-md-12">
                                                        <input type=hidden name="type[0][]" value="'.$val.'">
                                                        <div class="card mb-1 widget-content bg-midnight-bloom" id="proccess-'.$k.'">
                                                            <div class="widget-content-wrapper text-white">
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading" id="title">'.$data['title'][0][$index].'</div>
                                                                    <div class="widget-subheading">'.$des[$val].'</div>
                                                                </div>
                                                                <div class="">
                                                                    <input type="hidden" class="title" name="title[0][]" value="'.$data['title'][0][$index].'">';
                                                              echo "<input type=hidden class=content name=content[0][] value='".($data['content'][0][$index])."'>";
                                                             echo '</div>
                                                                <div class="widget-content-right">
                                                                    <div class="widget-numbers text-warning">
                                                                            <a href="javascript:void(0)" data-type="'.$val.'" data-c="'.$k.'" data-id="0" class="mb-2 mr-2 btn-transition btn btn-outline-dark add-event-data" style="color:white"><i class="fa fa-cog"></i></a>
                                                                            <a href="javascript:void(0)" class="mb-2 mr-2 btn-transition btn btn-outline-danger remove-event-data" style="color:white"><i class="fa fa-times"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';
                                                    $k++;
                                    }
                                    ?>
                                </div>
                                <div class="card-footer">
                                    <button type="button" data-page="0" class="btn btn-primary select-event">
                                        <i class="fa fa-plus"></i> Add Event (s)
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card box-design">
                                <input type="hidden" name="index[]" class="index-val" value="1">
                                <input type="hidden" name="class[1]" value="col-md-6"> 
                                <input type="hidden" name="setting[1]" value=""> 
                                
                                <div class="card-header">
                                    <h4>Box</h4>
                                </div>
                                <div class="card-body box-div div-1 row">
                                    <?
                                    foreach($data['type'][1] as $index => $val){
                                        
                                            
                                            echo '<div class="col-md-12">
                                                        <input type=hidden name="type[1][]" value="'.$val.'">
                                                        <div class="card mb-1 widget-content bg-midnight-bloom" id="proccess-'.$k.'">
                                                            <div class="widget-content-wrapper text-white">
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading" id="title">'.$data['title'][1][$index].'</div>
                                                                    <div class="widget-subheading">'.$des[$val].'</div>
                                                                </div>
                                                                <div class="">
                                                                    <input type="hidden" class="title" name="title[1][]" value="'.$data['title'][1][$index].'">';
                                                                    echo "<input type=hidden class=content name=content[1][] value='".($data['content'][1][$index])."'>";
                                                         echo ' </div>
                                                                <div class="widget-content-right">
                                                                    <div class="widget-numbers text-warning">
                                                                            <a href="javascript:void(0)" data-type="'.$val.'" data-c="'.$k.'" data-id="0" class="mb-2 mr-2 btn-transition btn btn-outline-dark add-event-data" style="color:white"><i class="fa fa-cog"></i></a>
                                                                            <a href="javascript:void(0)" class="mb-2 mr-2 btn-transition btn btn-outline-danger remove-event-data" style="color:white"><i class="fa fa-times"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';
                                                    $k++;
                                    }
                                    ?>
                                </div>
                                <div class="card-footer">
                                    <button type="button" data-page="1" class="btn btn-primary select-event">
                                        <i class="fa fa-plus"></i> Add Event (s)
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
    
    
</form>
<script>
    
    $k = <?=$k?>;
    $('.box-div').sortable().disableSelection();
    <?
    require 'instance.js';
    ?>
    /*
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
                                                        <div class="card mb-1 widget-content bg-midnight-bloom">\
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
        
        
    $(this).prop('disabled',true).html('<i class="fa fa-spin fa-spinner"></i>');
    $.ajax({
        type : 'POST',
        url : base_url+'Admin/AJAX',
        data : { id : id , type : type , content : content, title : title, var : 'contentEventData' },
        dataType : 'json',
        success:function(res){
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
                                $parentDiv.find('#title').html(title);
                                console.log(all);
                            switch(type){
                                
                                case 'content':
                                    for(var instanceName in CKEDITOR.instances)
                                        CKEDITOR.instances[instanceName].updateElement();
                                    $parentDiv.find('.content').val(all.find('.arya-editor').val());
                                break;
                                
                                case 'form': case 'tform':
                                    if(all.find('#form_id').val() == 0){
                                        all.find('.message').html('<div class="col-md-12 alert alert-danger">Please Select A Form..</div>');
                                        return false;
                                    }
                                    $parentDiv.find('.content').val(all.find('#form_id').val());
                                break;
                                
                            }
                            $(that).prop('disabled',false).html('<i class="fa fa-cog"></i>');
                        },
                    },
                    cancel:function(){ $(that).prop('disabled',false).html('<i class="fa fa-cog"></i>');}
                }
            });
        },
        error :  function(a , c , f){
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
    });*/
</script>