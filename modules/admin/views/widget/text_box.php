
<style>
    .txt-widget-box .card-body{
        overflow:hidden;
    }
</style>



<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css.map">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css">
<script type="text/javascript" src="<?=base_url.'/public/icons.js'?>"></script>


<div class="card txt-widget-box " style="border:1px solid black">
    <input type="hidden" name="input-type" class="input-type" value="text_box">
    <div class="card-header-tab card-header">
        <div class="card-header-title">
            <i class="header-icon lnr-bicycle icon-gradient bg-love-kiss"> </i>
            Write Info
        </div>
        <ul class="nav">
            <li class="nav-item"><a data-toggle="tab" href="#text_box" class="nav-link active show">Text</a></li>
            <li class="nav-item"><a data-toggle="tab" href="#text_with_icon" class="nav-link show">Text With Icon</a></li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane active show" id="text_box" role="tabpanel">
                <textarea id="aryaeditor" name="info"><?=$meta->info?></textarea>
            </div>
            <div class="tab-pane" id="text_with_icon" role="tabpanel">
                
                <div class="row">
                    <div class="my-sticky">
                    <button class="btn btn-danger  add-text-field btn-xs btn-sm" type="button"><i class="fa fa-plus"></i> Field</button>
                        
                    </div>
                    
                    <div class="col-md-12 msg"></div>
                    
                    <div class="col-sm-12 box-text" style="padding:10px">
                        
                        
                    </div>
                              
                    
                </div>
                
                
                
                
            </div>
            
        </div>
    </div>
</div>

<script>
let $box = '';
$(document).on('click','.select-icon',function(){
    let html = '<style>.jconfirm-content-pane{height:482px!important;}</style>',
        that = this;
    var i=0, color = '';
    for(i=0;i<iconList.length;i++){
        color = $(that).text() == iconList[i] ? 'red' : 'white';
        let chk = $(that).text() == iconList[i]  ? 'checked' : '';
        html += ('<label style="padding:6px; display:inline-block; color:black; font-size:22px; text-align:center; line-height:50px; border:1px solid white;" data-class=""><input class="check-input" '+chk+' style=" position: absolute;z-index: -1;" type="radio" name="icon-input-radio" value="'+iconList[i]+'"><i class="fa '+iconList[i]+'"></i></label>');
    }
  $box = $.confirm({
            type:'green',
            title:'Choose Icon',
            bootstrapClasses: {
                container: 'container',
                containerFluid: 'container-fluid',
                row: 'row',
            },
            smoothContent:true,
            content:html,
            buttons:{
                ok:{
                    text : '<i class="fa fa-plus"></i> Add',
                    btnClass:'btn-primary',
                    action:function(){
                        let icon = $('.check-input:checked');
                        console.log($(icon).val());
                        if($(icon).val() != undefined){
                            $('.icon-'+$(that).data('id')).val($(icon).val());
                            $(that).html('<i class="fa '+$(icon).val()+' "></i>');
                            $box.close();
                            return true;
                        }
                        
                        $.alert('Please Select Icon..');
                        return false;
                    }
                },
                cancel:function(){
                    $(that).html('Select Icon');
                }
            }
        });
});

$(document).on('change','.check-input',function(){
    $('label').css('border-color','white');
    let color = !(this.checked) ? 'white' : 'red';
    $(this).parent().css({'border':'1px solid '+color});
});

    $('.txt-widget-box .nav-link').click(function(){
        $('.txt-widget-box').find('.tab-pane').removeClass('show active');
        let id = $('.txt-widget-box').find( $(this).attr('href') ).addClass('show active').attr('id');
        $('.input-type').val( id );
    });
    $(document).on('click','.remove-txt-field',function(){
        let that = this;
        $.confirm({
            type : 'red',
            title:'Confirmation!',
            icon:'fa fa-bell',
            content:'Are you sure for remove it.',
            buttons:{
                
                ok:{
                    text : '<i class="fa fa-trash"></i> Remove',
                    btnClass:'btn-danger',
                    action:function(){
                        $(that).parent().parent().remove();
                    }
                },
                cancel:function(){}
                
                
            }
        });
    })
    $('.add-text-field').click(function(){
        let btn = $(this).html(),that = this;
        $('.msg').html('');
        $(this).prop('disabled',true).html('<i class="fa fa-spin fa-spinner"></i> wait..');
        $.ajax({
            type:'POST',
            url : base_url+'Admin/AJAX',
            data: {var:'GetTextwithIconWidgetAField'},
            dataType:'json',
            success:function(res){
                console.log(res);
                 $(that).prop('disabled',false).html(btn);
                 $('.box-text').append(res.html);
                 
            },
            error:function(a,v,c){
                console.log(a.responseText);
                $(that).prop('disabled',false).html(btn);
                $('.msg').html('<div class="alert alert-danger">Something Went Wrong. Please Try Again..</div>');
            }
        });
    });
</script>