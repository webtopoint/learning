<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-browser icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div> Manage Search Form
                <div class="page-title-subheading"> Manage Form & their fields.
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .heading{
        border-bottom: 2px solid #f0f0f0;
    }
    .heading input
    {
         font-weight: bold; 
        font-size: 22px;
        padding: 5px;
        width: 100%;
        border: 0px;
        outline: 0px;
    }
    .fieldBox   
    {
        padding: 10px 0px 10px 0px;
    }
    .fieldBox>div{
        display:inline-block;
    }
    .fieldTab
    {
        position: fixed;
        height: 100%;
        width: 100%;
        top:0;
        
        background:rgba(1,1,1,0.8);
        z-index: 999999;
        padding-top: 5%;
        display: none;
    }
    .fieldBox .form-group .fa-trash
    {
        color:red;
        position: relative;
        float: right;
        font-size: 14px;
    }
    .second .col-md-12{
        display:inline-block;
    }
    .tab-item div{
        display:inline-block;
    }
    .tab-btn{
        border-radius:none;
        border:1px solid black;
    }
    .tab-btn:focus{
        box-shadow:inset 0 0 10px 0 black;
    }
    .second{
        height:105px;
        overflow-x:hidden;
        border:1px solid black;
        padding:10px;
    }
    .form-group .second{
        display:none;
    }
</style>

        <form action="" method="POST" class="search-result-form">
            
            
            <input type="hidden" id="btn_name" name="button_name" value="Search">
            <input type="hidden" id="btn_background" name="button_css[background]" value="white">
            <input type="hidden" id="btn_color" name="button_css[color]" value="black">
            <input type="hidden" id="btn_border" name="button_css[border]" value="1px">
            <input type="hidden" id="btn_border_style" name="button_css[border-style]" value="none">
            <input type="hidden" id="btn_border_color" name="button_css[border-color]" value="white">
            <input type="hidden" id="btn_pd_left" name="button_css[padding-left]" value="10px">
            <input type="hidden" id="btn_pd_right" name="button_css[padding-right]" value="10px">
            <input type="hidden" id="btn_pd_top" name="button_css[padding-top]" value="5px">
            <input type="hidden" id="btn_pd_bottom" name="button_css[padding-bottom]" value="5px">
            <input type="hidden" id="btn_border_radius" name="button_css[border-radius]" value="0">
            <input type="hidden" id="btn_font_size" name="button_css[font-size]" value="14px">
            <input type="hidden" id="btn_font_style" name="button_css[font-style]" value="normal">
            <input type="hidden" id="btn_font_family" name="button_css[font-family]" value="arial">
            
            <div class="main-card mb-3 card">
                <div class="card-header">
                    <h3 class="card-title">Create New Form</h3>
                </div>
                <div class="card-header">
                    <button type="button" class="btn btn-danger btn-xs btn-sm tab-btn" data-class="button-design"> Button Design</button>
                    <button type="button" class="btn btn-danger btn-xs btn-sm form-fields" data-class=""> Select Fields</button>
                    <lable>
                         <select name="layout" class="layout-set">
                                <option value="1">Field Layout - 1</option>
                                <option value="2">Field Layout - 2</option>
                                <option value="3">Field Layout - 3</option>
                                <option value="4">Field Layout - 4</option>
                        </select>
                    </lable>
                </div>
                <div class="card-body" style="background:rgba(0,0,0,.8)">
                    
                    <div class="container bg-white" style="border:2px dashed #f0f0f0; padding: 15px;">
                        <p class="heading"><input type="text" name="form_title" placeholder="Enter Form Title"> </p>
                        <div class="fieldBox ui-sortable">
                        </div>
                        <div class="form-group submitBtn" align="left">
                            <button type="button">Search</button>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                	<button class="btn btn-info" type="submit">Save</button>
                </div>
            </div>
        </form>
        
        
        
        
        <div class="main-card mb-3 card">
            <div class="card-header">
                <h3 class="card-title">Form List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped data-table">
                    <thead>
                        <tr>
                            <th>#.</th>
                            <th>Form Title</th>
                            <th>Form Fields</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        $i = 1;
                        foreach($result_form as $form){
                            $form_title = $form['forms_css']=='' ? '' : json_decode($form['forms_css'])->form_title;
                            $form_title = $form_title=='' ? '<strong style="color:red">UNKNOWN TITLE</label>' : $form_title;
                            echo '<tr>
                                    <td>'.$i++.'.</td>
                                    <td>'.ucwords($form_title).'</td>
                                    <td>';
                                    if(is_object( $fields =json_decode($form['fields'])) ){
                                        $t = 1;
                                        foreach(  $fields as $v => $field){
                                            $name = $field->label==''?'<i>EMPTY</i>':$field->label;
                                            echo '<label style="margin-right:6px" class="badge badge-'.print_random_class().'">'.$name.'</label>';
                                        }     
                                    }
                            echo '  </td>
                                    <td><a href="#" class="btn btn-primary btn-xs btn-sm"><i class="fa fa-edit"></i></a></td>
                                    <td><button class="btn btn-danger btn-xs btn-sm delete-form" onclick="delete_form(this,'.$form['id'].')"><i class="fa fa-trash"></i></button></td>
                                </tr>';
                        }
                        
                        
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
<style>
    .all-fields-div{
        position: fixed;
          left: 0;
          bottom: 0;
          width: 100%;
          background-color: black;
          color: white;
          text-align: center;
          opacity: 0.9;
          height:0;
        box-shadow:inset white 0 0 10px 0;
        border-top:3px solid black;
    }
    .button-design{
        position: fixed;
          right: 0;
          bottom: 0;
          width: 30%;
          background-color: black;
          color: white;
          text-align: center;
          opacity: 0.9;
          height:0;
          overflow-x:hidden;
        box-shadow:inset white 0 0 10px 0;
        border-top:3px solid black;
        border-left:3px solid black;
    }
    .button-design input,.button-design select,.form-group{
        width:100%;
    }
    .button-design::-webkit-scrollbar {
      width: 6px;
    }

.button-design::-webkit-scrollbar-track {
  background: black; 
  opacity:0.9;
}
 
.button-design::-webkit-scrollbar-thumb {
  background: white; 
  border-radius:9px;
}
.button-design::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
    .button-field{
        border-radius:12px;
        background:black;
        color:white;
        font-size:18px;
        font-family:cursive;
        width:200px;
        display:inline-block;
        border:1px solid white;
        box-shadow:inset white 0 0 10px 0;
    }
</style>
        
<div class="all-fields-div">
    <div >
        <h3>Select Fields <i class="fa fa-times" onclick="$(this).parent().parent().parent().animate({height:0},500)" style="margin-left:17px;cursor:pointer"></i></h3>
            <div class="button-field">
                <label><input type="checkbox" class="ceck-input" id="rool_id" onclick="selectInput(this)" name="input[]" value="rool_id">
            Roll No.</label></div>
        
            <div class="button-field">
                <label><input type="checkbox" class="ceck-input" onclick="selectInput(this)" name="input[]" value="student_name" id="student_name">
            Student Name</label></div>
        
       
            <div class="button-field">
                <label><input type="checkbox" class="ceck-input" onclick="selectInput(this)" name="input[]" value="dob" id="dob">
            Date of Brith</label></div>
       
    </div>
</div>      
<div class="tab-item button-design">
                <div class="col-md-12">
                    <div class="form-group">
                    <label>Text</label>
                    <input type="text" value="Submit" class="form-control" onkeyup="$('.submitBtn button').text(this.value);$('#btn_name').val(this.value)">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <label>Background</label>
                    <input type="color" value="#f1f1f1" class="form-control" onchange="$('.submitBtn button').css('background',this.value);$('#btn_background').val(this.value)">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <label>Font Color</label>
                    <input type="color" value=""  class="form-control" onchange="$('.submitBtn button').css('color',this.value);$('#btn_color').val(this.value)">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <label>Border Size</label>
                    <input type="number" value="1"  class="form-control" onkeyup="$('.submitBtn button').css('border-width',this.value+'px');$('#btn_border').val(this.value+'px')">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <label>Border Color</label>
                    <input type="color" value="#f1f1f1"  class="form-control" onchange="$('.submitBtn button').css('border-color',this.value);$('#btn_border_color').val(this.value)">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <label>Border Style</label>                                                                        
                   <select class="form-control" onchange="$('.submitBtn button').css('border-style',this.value);$('#btn_border_style').val(this.value)">
                        <option value="none">None</option>
    
                        <option value="solid">Solid</option>
    
                        <option value="double">Double</option>
    
                        <option value="dashed">Dashed</option>
    
                        <option value="dotted">Dotted</option>
    
                        <option value="groove">Groove</option>
    
                        <option value="ridge">Ridge</option>
    
                        <option value="inset" selected="">Inset</option>
                        
                        <option value="outset">Outset</option>
    
                   </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <label>Padding Left</label>
                    <input type="number" value="10"  class="form-control" onkeyup="$('.submitBtn button').css('padding-left',this.value+'px');$('#btn_pd_left').val(this.value+'px')">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <label>Pedding Right</label>
                    <input type="number" value="10"  class="form-control" onkeyup="$('.submitBtn button').css('padding-right',this.value+'px');$('#btn_pd_right').val(this.value+'px')">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <label>Pedding Top</label>
                    <input type="number" value="5"  class="form-control" onkeyup="$('.submitBtn button').css('padding-top',this.value+'px');$('#btn_pd_top').val(this.value+'px')">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <label>Pedding Bottom</label>
                    <input type="number" value="5"  class="form-control" onkeyup="$('.submitBtn button').css('padding-bottom',this.value+'px');$('#btn_pd_bottom').val(this.value+'px')">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <label>Border Radius</label>
                    <input type="number" value="0"  class="form-control" onkeyup="$('.submitBtn button').css('border-radius',this.value+'px');$('#btn_border_radius').val(this.value+'px')">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <label>Alignment</label>
                     <select class="form-control" onchange="$('.submitBtn').attr('align',this.value)">
                        <option value="left">Left</option>
    
                        <option value="center">Middle</option>
    
                        <option value="right">Right</option>
                    </select>
                    </div>
                </div>
    
                <div class="col-lg-12">
                    <div class="form-group">
                    <label>Font Size</label>
                      <input type="number" class="form-control" name="Fsize" placeholder="Font Size" value="14" required="" onkeyup="$('.submitBtn button').css('font-size',this.value);$('#btn_font_size').val(this.value+'px')">
                      
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                    <label>Font Style</label>
                    <select id="font-style-select" class="form-control" data-cur="normal" name="Fstyle"  onchange="$('.submitBtn button').css('font-style',this.value);$('#btn_font_style').val(this.value)"></select>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                    <label>Font Family</label>
                   <select id="font-family-select" class="form-control" data-cur="Arial" name="Ffamily" onchange="$('.submitBtn button').css('font-family',this.value);$('#btn_font_family').val(this.value)"></select>
                    </div>
                </div>                   
        </div>
        
        
        
        
        
        
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
function delete_form(e,id){
    $.confirm({
        type:'red',
        title:'Confirmation',
        icon:'fa fa-bell',
        content:'Are you sure for Delete it.',
        buttons:{
            ok:{
                text:'Delete',
                btnClass:'btn-danger',
                action:function(){
                    $('#load').show();
                    $.post(base_url+'Admin/result-section-ajax',{status:'delete_search_form',id:id},function(d){
                        d = JSON.parse(d);
                        $('#load').hide();
                        if(d.status){
                            $(e).parent().parent().hide(600);
                            toastr.success('Form Deleted Successfully..');
                        }
                        else
                            toastr.error('Something Went Wrong Try Again.');
                        
                    });
                }
            },
            cancel:function(){}
        }
    });
}
$('.search-result-form').submit(function(e){
    e.preventDefault();
    $('#load').show();
    $.post(document.location,$(this).serialize(),function(d){
        d = JSON.parse(d);
        $('#load').hide();
        if(d.status){
            $('.data-table').append(d.tr);
            toastr.success('Data Saved Successfully..');
        }
        else
            toastr.error('Please Select Form Fields.');
    }).fail(function(){
        toastr.error('Something Went Wrong. Please Try Again..');
    });
});
    
    $('.tab-btn').click(function(){
        var height = $('.button-design').height()?0:'500px';
        $('.all-fields-div').animate({height:0},500);
        $('.button-design').animate({display:'block',height:height},500);
    });
   var layout = 'col-md-12',layout_number = 1;
   $('.layout-set').change(function(){
       layout_number = this.value;
       change_layout(layout_number);
   });
   $( function() {                                    
    $(".fieldBox").sortable().disableSelection();
});
    
    function change_layout(s){
       // alert(s);
       if(s==2)
                layout = 'col-md-6';
       if(s==3)
               layout = 'col-md-4';
       if(s==4)
               layout = 'col-md-3';
       if(s==1)
                layout = 'col-md-12';
       
     $('.fieldBox>div').removeClass('col-md-12').removeClass('col-md-6').removeClass('col-md-4').removeClass('col-md-3').addClass(layout);

    }
    let boxes = {
        rool_id:'<div class="rool_id form-group ui-state-default">\
                        <div class="first">\
                            <label>Roll No</label>\
                            <input type="text" class="form-control" placeholder="Enter Roll No Here.." >\
                            <input type="hidden" name="field_name[]" value="rool_id">\
                        </div>\
                        <div class="second">\
                                <div class="col-md-12">\
                                    <div class="form-group">\
                                        <label>Change Label Title</label>\
                                        <input type="text" class="form-control" onkeyup="changeLabel(this,\'rool_id\')" name="rool_id[label]" value="Roll No">\
                                    </div>\
                                </div>\
                                <div class="col-md-12">\
                                    <div class="form-group">\
                                        <label>Change Placeholder</label>\
                                        <input type="text" class="form-control" onkeyup="changePlaceholder(this,\'rool_id\')" name="rool_id[placeholder]" value="Enter Roll No Here..">\
                                    </div>\
                                </div>\
                        </div>\
                        <div class="third">\
                            <a href="javascript:DropDown(\'rool_id\')" class="down-btn" style="width: 100%;text-align: center;background: black;display: flex;border-radius: 0 0 10px 10px;text-decoration: none;color: white;"><i class="fa fa-angle-down " style="text-align: center;width: 100%;"></i></a>\
                        </div>\
                   </div>',
        student_name:'<div class="student_name form-group ui-state-default">\
                        <div class="first">\
                            <label>Student Name</label>\
                            <input type="number" class="form-control" placeholder="Enter Student Name Here..">\
                            <input type="hidden" name="field_name[]" value="student_name">\
                        </div>\
                        <div class="second">\
                                <div class="col-md-12">\
                                    <div class="form-group">\
                                        <label>Change Label Title</label>\
                                        <input type="text" class="form-control" onkeyup="changeLabel(this,\'student_name\')" name="student_name[label]" value="Student Name">\
                                    </div>\
                                </div>\
                                <div class="col-md-12">\
                                    <div class="form-group">\
                                        <label>Change Placeholder</label>\
                                        <input type="text" class="form-control" onkeyup="changePlaceholder(this,\'student_name\')" name="student_name[placeholder]" value="Enter Student Name Here..">\
                                    </div>\
                                </div>\
                        </div>\
                        <div class="third">\
                            <a href="javascript:DropDown(\'student_name\')" class="down-btn" style="width: 100%;text-align: center;background: black;display: flex;border-radius: 0 0 10px 10px;text-decoration: none;color: white;"><i class="fa fa-angle-down " style="text-align: center;width: 100%;"></i></a>\
                        </div>\
                   </div>',
        dob:'<div class="dob form-group ui-state-default">\
                        <div class="first">\
                            <label>Date of Brith</label>\
                            <input type="date" class="form-control">\
                            <input type="hidden" name="field_name[]" value="dob">\
                        </div>\
                        <div class="second">\
                               <div class="col-md-12">\
                                    <div class="form-group">\
                                        <label>Change Label Title</label>\
                                        <input type="text" class="form-control" onkeyup="changeLabel(this,\'dob\')" name="dob[label]" value="Date of Brith">\
                                    </div>\
                                </div>\
                                <input type="hidden" class="form-control" name="dob[placeholder]" value="">\
                        </div>\
                        <div class="third">\
                            <a href="javascript:DropDown(\'dob\')" class="down-btn" style="width: 100%;text-align: center;background: black;display: flex;border-radius: 0 0 10px 10px;text-decoration: none;color: white;"><i class="fa fa-angle-down " style="text-align: center;width: 100%;"></i></a>\
                        </div>\
                   </div>'
    };

                 function selectInput(s){
                        if($(s).is(':checked')){
                            $('.fieldBox').append(boxes[s.value]);
                        }
                        else{
                            $('.'+s.value).remove();
                        }
                        change_layout(layout_number);
                 }
                 function DropDown(s){
                     $('.'+s).find('.second').toggle();
                 }
    $('.form-fields').click(function(){
        var height = $('.all-fields-div').height()?0:'300px';
        $('.button-design').animate({display:'none',height:0},500);
        $('.all-fields-div').animate({height:height},500);
    });
    function changeLabel(event,class_id){
        $('.'+class_id).find('.first').find('label').text(event.value);
    }
    function changePlaceholder(event,class_id){
       $('.'+class_id).find('.first').find('input').attr('placeholder',event.value); 
    }
</script>