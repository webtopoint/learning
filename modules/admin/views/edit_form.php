<?php
require_once 'header.php';
$f = $form->row();
// print_r($f->fields);
?>

<div class="app-page-title">

    <div class="page-title-wrapper">

        <div class="page-title-heading">

            <div class="page-title-icon">

                <i class="pe-7s-note2 icon-gradient bg-mean-fruit">

                </i>

            </div>

            <div>Edit Form

                <div class="page-title-subheading">

                </div>

            </div>

        </div>  

    </div>

</div> 

<div class="row createForm">
<div class="container bg-white" style="border:2px dashed #f0f0f0; padding: 15px;">
<p class="heading"><input type="text" value="<?=$f->title?>" name="form_title" placeholder="Enter Form Title"> </p>
    <div class="fieldBox">
    	<?php
    // 	echo json_decode($f->fields);
    	$fields = json_decode($f->fields,true);
    	
    	foreach ( $fields as $val )
    	{
    		echo'<div class="form-group"><i class="fa fa-trash" onclick="removeField(this)"></i>'.$val.'</div>';
    	}
    	?>
    </div>
    <script>
          $( function() {
            $( ".fieldBox" ).sortable({
              revert: true,
            });
           
            $( ".fieldBox").disableSelection();
          } );
    </script>
   	<?php
   	echo $f->btn;
   	?>
</div>
<?php
echo'<input type="hidden" id="countVal" value="'.sizeof($fields).'">';
?>
<div class="container">
    <hr>
    <div class="row">
        <div class="col-md-5"><h4>Button Design</h4></div>
        <div class="col-md-5"><label><input type="checkbox" class="use-theme_btn"> Use Theme Button</label></div>
    </div>
    <div class="row btnDesign">
            <div class="col-lg-2">
                <div class="form-group">
                <label>Text</label>
                <input type="text" value="" class="form-control" onkeyup="$('.submitBtn button').text(this.value)">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                <label>Background</label>
                <input type="color" value="#f1f1f1" class="form-control" onchange="$('.submitBtn button').css('background',this.value)">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                <label>Font Color</label>
                <input type="color" value=""  class="form-control" onchange="$('.submitBtn button').css('color',this.value)">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                <label>Border Size</label>
                <input type="number" value="1"  class="form-control" onkeyup="$('.submitBtn button').css('border-width',this.value+'px')">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                <label>Border Color</label>
                <input type="color" value="#f1f1f1"  class="form-control" onchange="$('.submitBtn button').css('border-color',this.value)">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                <label>Border Style</label>                                                                        
               <select class="form-control" onchange="$('.submitBtn button').css('border-style',this.value)">
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
            <div class="col-lg-2">
                <div class="form-group">
                <label>Padding Left</label>
                <input type="number" value="10"  class="form-control" onkeyup="$('.submitBtn button').css('padding-left',this.value+'px')">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                <label>Pedding Right</label>
                <input type="number" value="10"  class="form-control" onkeyup="$('.submitBtn button').css('padding-right',this.value+'px')">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                <label>Pedding Top</label>
                <input type="number" value="5"  class="form-control" onkeyup="$('.submitBtn button').css('padding-top',this.value+'px')">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                <label>Pedding Bottom</label>
                <input type="number" value="5"  class="form-control" onkeyup="$('.submitBtn button').css('padding-bottom',this.value+'px')">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                <label>Border Radius</label>
                <input type="number" value="0"  class="form-control" onkeyup="$('.submitBtn button').css('border-radius',this.value+'px')">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                <label>Alignment</label>
                 <select class="form-control" onchange="$('.submitBtn').attr('align',this.value)">
                    <option value="left">Left</option>

                    <option value="center">Middle</option>

                    <option value="right">Right</option>
                </select>
                </div>
            </div>

                 <div class="col-lg-4">
                <div class="form-group">
                <label>Font Size</label>
                <div class="input-group">
                  <input type="number" class="form-control" name="Fsize" placeholder="Font Size" value="14" required="" onkeyup="$('.submitBtn button').css('font-size',this.value)">
                  <div class="input-group-append">
                    <span class="input-group-text">px</span>
                  </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                <label>Font Style</label>
                <select id="font-style-select" class="form-control" data-cur="normal" name="Fstyle"  onchange="fontStyle(this)"></select>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                <label>Font Family</label>
               <select id="font-family-select" class="form-control" data-cur="Arial" name="Ffamily" onchange="$('.submitBtn button').css('font-family',this.value)"></select>
                </div>
            </div>
    </div>
    <hr>

<div class="col-lg-12">
	 <div class="row">
        <h4>Form Layout</h4>
    </div>
	<div class="form-group">
		<label>Number of fields in Single row</label>
		<select id="layout" class="form-control">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select>
	</div>
</div>

<div class="col-lg-12">
    <div class="form-group">
        <button class="btn btn-lg btn-info addField">Add Field</button>
        <button class="btn btn-success btn-lg saveForm">Save</button>
    </div>
</div>

</div>
</div>


<script>
var btnClasss = '<?=getFormButtonClass()?>';
$('.use-theme_btn').change(function(){
   $('.submitBtn button').toggleClass(btnClasss);
});




if($('.submitBtn button').hasClass(btnClasss)){
    $('.use-theme_btn').prop('checked',true);
}
function fontStyle(ele)
    {
        if(ele.value=='bold')
        {
            $('.submitBtn button').css('font-weight','bold');
            $('.submitBtn button').css('font-style','');
        }
        else if(ele.value=='normal')
        {
            $('.submitBtn button').css('font-style','');
            $('.submitBtn button').css('font-weight','');
        }
        else
        {
            $('.submitBtn button').css('font-weight','');
            $('.submitBtn button').css('font-style','italic');
        }
    }

    var color = '';
	$(function(){
		var btn  = $('.submitBtn button');
		var ip = $('.btnDesign input');
		var sel  = $('.btnDesign select');
		$(ip[0]).val($(btn).html());

		hexc($(btn).css('background-color'));
		$(ip[1]).val(color);

		hexc($(btn).css('color'));
		$(ip[2]).val(color);
		
		$(ip[3]).val($(btn).css('border-width').replace('px',''));

		hexc($(btn).css('border-color'));
		$(ip[4]).val(color);

		$(ip[5]).val($(btn).css('padding-left').replace('px',''));
		$(ip[6]).val($(btn).css('padding-right').replace('px','') );
		$(ip[7]).val($(btn).css('padding-top').replace('px',''));
		$(ip[8]).val($(btn).css('padding-bottom').replace('px',''));
		$(ip[9]).val($(btn).css('border-radius').replace('px',''));
        $(ip[10]).val($(btn).css('font-size').replace('px',''));
		$(sel[0]).find("option[value="+$(btn).css('border-style')+"]").attr("selected","");
		$(sel[1]).find("option[value="+$(".submitBtn").attr('align')+"]").attr("selected","");
        $(sel[3]).find("option[value="+$(btn).css('font-family')+"]").attr("selected","");
      
     
		$("#layout").find("option[value=<?=$f->layout?>]").attr("selected","");
		
        if($(btn).css('font-style'))
        {
           $(sel[2]).find("option[value=" + $(btn).css('font-style')+"]").attr("selected","");
            //alert($(btn).css('font-weight'));
        }
        else
        {   //alert("pk");
            $(sel[2]).find("option[value=bold]").attr("selected","");
        }
   

	});


    function hexc(colorval) 
    {
      var parts = colorval.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
      delete(parts[0]);
      for (var i = 1; i <= 3; ++i) {
        parts[i] = parseInt(parts[i]).toString(16);
        if (parts[i].length == 1) parts[i] = '0' + parts[i];
      }
      color = '#' + parts.join('');
    }


  </script>


<script type="text/javascript">
    $(".addField").click(function()
    {
        $(".fieldTab").show();
        $(".fieldTab input").val("");
    });


    $(".saveForm").click(function(){
        var ftitle  = $(".heading input[name=form_title]").val();
        var submitBtn =$(".submitBtn")[0].outerHTML;
        var lay = $("#layout").val();
        var form = $(".fieldBox").children();
        var i=0;
        var l;
        
        if(ftitle=='' || submitBtn=='' || form.length==0)
        {
          alert("Fill all the Fields");
        }
        else
        {
                $("#load").show();
                 var data = new Array();
                    for(i=0;i<form.length;i++)
                    {
                        $(form[i]).find('i.fa-trash').remove();

                        l =  $(form[i]).html();

                        data.push(l);  
                    }

                    var Jtext = data;//JSON.stringify(data);
                  
                     $.ajax({
                                url:'<?=site_url('Admin/edit_form/').AJ_ENCODE($f->id)?>',
                                type:'POST',
                                data:{title:ftitle,fields:Jtext,btn:submitBtn,layout:lay},

                                success:function(q)
                                {
                                	//alert(q);
                                   toastr.success("Form Updated Successfully");
                                    $("#load").hide();
                                },
                                error:function(a,b,c)
                                {
                                    alert(c);
                                }
                     });
                
        }
    });

</script>

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
</style>
<?

require_once 'footer.php';

?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<div class="fieldTab">
 <div class="col-lg-12">
    <button class="btn btn-danger" onclick="$(this).parent().parent().hide()"><i class="fa fa-times"></i> Close</button>
    <div class="mb-3 card">
        <div class="card-header">
            <ul class="nav nav-justified">
                <li class="nav-item"><a data-toggle="tab" href="#tab-eg7-0" class="nav-link show active">Input</a></li>
                <li class="nav-item"><a data-toggle="tab" href="#tab-eg7-1" class="nav-link show">Radio</a></li>
                <li class="nav-item"><a data-toggle="tab" href="#tab-eg7-2" class="nav-link show">Selectbox</a></li>
                <li class="nav-item"><a data-toggle="tab" href="#tab-eg7-3" class="nav-link show">Checkbox</a></li>
                <li class="nav-item"><a data-toggle="tab" href="#tab-eg7-4" class="nav-link show">Text Area</a></li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane show active" id="tab-eg7-0" role="tabpanel">
                    <div class="col-lg-6">
                <form class="fieldForm" data-type="input">
                    <div class="form-group">
                        <input type="checkbox" name="iprequire" value="requ"> Make Required Field
                    </div>
                    <div class="form-group">
                        <input type="text" name="iptitle" style="border:0px; outline: 0px; border-bottom:2px solid #f0f0f0; font-size: 18px; padding: 4px; width: 100%" placeholder="Enter Input Title Here" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="ipholder" style="border:0px; outline: 0px; border-bottom:2px solid #f0f0f0; font-size: 18px; padding: 4px; width: 100%" placeholder="Enter Placeholder Here" > 
                    </div>
                    <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" onkeyup="alert('This is Only Example')">
                                <div class="input-group-append">
                                    <select class="form-control" name="iptype" onchange="$(this).parent().parent().find('input').attr('type',this.value).val('')">
                                        <option value="text">Text</option>
                                        <option value="password">Password</option>
                                        <option value="date">Date</option>
                                        <option value="number">Number</option>
                                        <option value="email">Email</option>
                                        <option value="time">Time</option>
                                        <option value="color">Color</option>
                                        <option value="file">Images</option>
                                    </select>
                                </div>
                            </div>
                    </div>
                    
                </form>
                    <div class="form-group footer">
                        <button class="btn btn-success addFieldSubmit" type="button">Add Field</button>
                    </div>
                
                    </div>

                </div>
                <div class="tab-pane show" id="tab-eg7-1" role="tabpanel">
                   
                    <div class="col-lg-6">
                        
                        <form class="fieldForm" data-type="radio">
                    <div class="form-group">
                        <input type="checkbox" name="iprequire" value="requ"> Make Required Field
                    </div>
                    <div class="form-group">
                        <input type="text" name="iptitle" style="border:0px; outline: 0px; border-bottom:2px solid #f0f0f0; font-size: 18px; padding: 4px; width: 100%" placeholder="Enter Radio Title" required>
                    </div>
                    <div class="form-group optionBox"></div>
                </form>
                
                        <div class="form-group">
                            <div class="input-group">
                                 <div class="input-group-prepend">
                                    <button class="btn btn-warning" type="button">Add Option</button>
                                </div>
                                <input type="text" class="form-control" placeholder="Option Name">
                                <div class="input-group-append">
                                    <button class="btn btn-warning addOpt" type="button" data-type="radio"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group footer">
                            <button class="btn btn-success addFieldSubmit">Add Field</button>
                        </div>
                
                    </div>
                    
                </div>
                <div class="tab-pane show" id="tab-eg7-2" role="tabpanel">
                    <div class="col-lg-6">
                        <form class="fieldForm" data-type="selectbox">
                            <div class="form-group">
                                <input type="checkbox" name="iprequire" value="requ"> Make Required Field
                            </div>
                            <div class="form-group">
                                <input type="text" name="iptitle" style="border:0px; outline: 0px; border-bottom:2px solid #f0f0f0; font-size: 18px; padding: 4px; width: 100%" placeholder="Enter Select Title" required>
                            </div><br>
                             <div class="form-group optionBox">
                                <div class="input-group">
                                    <select class="form-control"></select>
                                    <div class="input-group-append">
                                        <button class="btn btn-danger" onclick="$(this).parent().parent().find('select option:selected').remove()" type="button"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="first_selecttion"> Insert a blank item as the first option
                                </label>
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="allow_multiple_selection"> Allow multiple selections
                                </label>
                            </div>
                        </form>
                   
                        <div class="form-group">
                            <div class="input-group">
                                 <div class="input-group-prepend">
                                    <button class="btn btn-warning" type="button">Add Option</button>
                                </div>
                                <input type="text" class="form-control" placeholder="Option Name">
                                <div class="input-group-append">
                                    <button class="btn btn-warning addOpt" type="button" data-type="selectbox"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group footer">
                            <button class="btn btn-success addFieldSubmit">Add Field</button>
                        </div>
                
                    </div>
                    
                </div>
                <div class="tab-pane show" id="tab-eg7-3" role="tabpanel">
                    <div class="col-lg-6">
                <form class="fieldForm" data-type="checkbox">
                    <div class="form-group">
                        <input type="checkbox" name="iprequire" value="requ"> Make Required Field
                    </div>
                    <div class="form-group">
                        <input type="text" name="iptitle" style="border:0px; outline: 0px; border-bottom:2px solid #f0f0f0; font-size: 18px; padding: 4px; width: 100%" placeholder="Enter Checkbox Title" required>
                    </div>
                    <div class="form-group optionBox"></div>
                </form>
                    <div class="form-group">
                        <div class="input-group">
                             <div class="input-group-prepend">
                                <button class="btn btn-warning" type="button">Add Option</button>
                            </div>
                            <input type="text" class="form-control" placeholder="Option Name">
                            <div class="input-group-append">
                                <button class="btn btn-warning addOpt" type="button" data-type="checkbox"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group footer">
                        <button class="btn btn-success addFieldSubmit">Add Field</button>
                    </div>
                
                    </div>
                </div>


                <div class="tab-pane show" id="tab-eg7-4" role="tabpanel">
                    <div class="col-lg-6">
                <form class="fieldForm" data-type="textarea">
                    <div class="form-group">
                        <input type="checkbox" name="iprequire" value="requ"> Make Required Field
                    </div>
                    <div class="form-group">
                        <input type="text" name="iptitle" style="border:0px; outline: 0px; border-bottom:2px solid #f0f0f0; font-size: 18px; padding: 4px; width: 100%" placeholder="Enter Text Area Title Here" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="ipholder" style="border:0px; outline: 0px; border-bottom:2px solid #f0f0f0; font-size: 18px; padding: 4px; width: 100%" placeholder="Enter Placeholder Here" > 
                    </div>
                </form>
                    <div class="form-group footer">
                        <button class="btn btn-success addFieldSubmit" type="button">Add Field</button>
                    </div>
                
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<script type="text/javascript">

var count= ( parseInt($("#countVal").val()) + 1 );


var AllIds = new Array();

$('.fieldBox').find('input,select,textarea').each(function( i , v ){
    AllIds[i] = parseInt( $(this).attr('name').replace('field_','') );
});
   

AllIds.sort(function(a1, b1){
    if(a1== b1) return 0;
    return a1> b1? 1: -1;
});



count = (AllIds[AllIds.length-1] + 1 );


    $(".addFieldSubmit").on("click",function(){
        var form = $(".fieldTab .tab-content .active .fieldForm");
        var  i = 0,flag=1;
        var list = $(form).find('input[name][type=text],select[name]');
        for(i=0;i<list.length;i++)
        {
            if(list[i].value=='')
            {
                flag=0;
                $(list[i]).css("border-bottom","2px solid red");
            }
            else
            {
                $(list[i]).css("border-bottom","1px solid #f0f0f0");
            }
        }

        if(flag)
        {
            $(form).submit();
        }
    });

    $(".fieldForm").on("submit",function(ev){
        ev.preventDefault();
     
        var type = $(this).data('type');
    switch(type)
    {
        case 'input':
        var i=0;
        var l = $(this).find('input[name=iptitle]').val();
        var holder = $(this).find('input[name=ipholder]').val();
        var req = $(this).find('input[name=iprequire]:checked').length>0;
        var re = req?" required":"";
        var lab = req?"<font color=red><i class='fa fa-star fa-1'></i></font>":"";
        l= l+" "+lab;
        var t = $(this).find('select[name=iptype]').val();
        $(".fieldBox").append("<div class='form-group ui-state-default'><label id='label_"+count+"'>"+l+"</label> <i class='fa fa-trash' onclick='removeField(this)'></i><input type='"+t+"' class='form-control' name='field_"+count+"' placeholder='"+holder+"' "+re+"></div>");
        $(".fieldTab").hide();
        count++;
        break;

        case 'radio':
        var l = $(this).find('input[name=iptitle]').val();
        var req = $(this).find('input[name=iprequire]:checked').length>0;
        var re = req?" required":"";
        var lab = req?"<font color=red><i class='fa fa-star fa-1'></i></font>":"";
        l= l+" "+lab;
        var radio = $(this).find('input[type=radio]');

        var str = "<div class='form-group ui-state-default'><label id='label_"+count+"'>"+l+"</label> <i class='fa fa-trash' onclick='removeField(this)'></i><br>";

        for(i=0;i<radio.length;i++)
        {
            str+="<input type='radio' name='"+radio[i].name+"' value='"+radio[i].value+"' "+re+">";
            str+=" "+radio[i].value+" &nbsp; ";
        }

        $(".fieldBox").append(str);
        $(".fieldBox").append("</div>");
        $(".fieldTab").hide();
        count++;
        break;

        case 'selectbox':

        var l = $(this).find('input[name=iptitle]').val();
                    var req = $(this).find('input[name=iprequire]:checked').length>0;
                    var re = req?" required":"";
                    var lab = req?"<font color=red><i class='fa fa-star fa-1'></i></font>":"";
                    l= l+" "+lab;
                    
                    var first_selecttion = $(this).find('input[name=first_selecttion]');
                    
                    let allow_multiple_selection = $(this).find('input[name=allow_multiple_selection]').is(':checked') ? 'multiple' : '';
                    
                    let field_nameIsArray  =  allow_multiple_selection == 'multiple' ? 'field_'+count+'[]' : 'field_'+count;
                    
                    var option = $(this).find('select option');
            
                    var str = "<div class='form-group ui-state-default'><label id='label_"+count+"'>"+l+"</label> <i class='fa fa-trash' onclick='removeField(this)'></i><select class='form-control' "+re+"  name='"+field_nameIsArray+"' "+allow_multiple_selection+">";
                    let valueSelect = '';
                    
                    for(i=0;i<option.length;i++)
                    {
                        valueSelect = ( $(first_selecttion).is(':checked') && i == 0 ) ? '' : option[i].value;
                        str+='<option value="'+valueSelect+'">'+option[i].value+'</option>';
                    }
            
                    $(".fieldBox").append(str);
                    $(".fieldBox").append("</select></div>");
                 
                    $(".fieldTab").hide();
        break;

        case 'checkbox':

        var l = $(this).find('input[name=iptitle]').val();
        var check = $(this).find('.optionBox input[type=checkbox]');
        var req = $(this).find('input[name=iprequire]:checked').length>0;
        var re = req?" required":"";
        var lab = req?"<font color=red><i class='fa fa-star fa-1'></i></font>":"";
        l= l+" "+lab;
        var str = "<div class='form-group ui-state-default'><label id='label_"+count+"'>"+l+"</label> <i class='fa fa-trash' onclick='removeField(this)'></i><br>";

        for(i=0;i<check.length;i++)
        {
            str+="<p><input type='checkbox' name='"+check[i].name+"' value='"+check[i].value+"' "+re+">";
            str+=" "+check[i].value+"</p>";
        }

        $(".fieldBox").append(str);
        $(".fieldBox").append("</div>");
        $(".fieldTab").hide();
        count++;

        break;

        case 'textarea':
        var i=0;
        var l = $(this).find('input[name=iptitle]').val();
        var holder = $(this).find('input[name=ipholder]').val();
        var req = $(this).find('input[name=iprequire]:checked').length>0;
        var re = req?" required":"";
        var lab = req?"<font color=red><i class='fa fa-star fa-1'></i></font>":"";
        l= l+" "+lab;
        $(".fieldBox").append("<div class='form-group ui-state-default'><label id='label_"+count+"'>"+l+"</label> <i class='fa fa-trash' onclick='removeField(this)'></i><textarea class='form-control' name='field_"+count+"' placeholder='"+holder+"' "+re+"></textarea></div>");
        $(".fieldTab").hide();
        count++;
        break;

    }

    });

    function removeField(ele)
    {
        $(ele).parent().remove();
    }

   $(".addOpt").on("click",function(){
    
        var form = $(".fieldTab .tab-content .active .fieldForm");
        var type = $(this).data('type');
        switch(type)
        {
            case 'radio':

               var v = $(this).parent().parent().find('input').val();
               $(this).parent().parent().find('input').val("");
                if(v=='')
                    alert("Please Fill the Option Name")
                else
                {
                    $(form).find('.optionBox').append("<p><input type='radio' name='field_"+count+"' value='"+v+"'>"+v+"<i class='pull-right fa fa-trash' onclick='$(this).parent().remove()'></i></p>");
                }
            break;

            case 'selectbox':

             var v = $(this).parent().parent().find('input').val();
               $(this).parent().parent().find('input').val("");
                if(v=='')
                    alert("Please Fill the Option Name")
                else
                {
                    $(form).find('.optionBox select').append("<option>"+v+"</option>");
                }


            break;

            case 'checkbox':

                var v = $(this).parent().parent().find('input').val();
               $(this).parent().parent().find('input').val("");
                if(v=='')
                    alert("Please Fill the Option Name")
                else
                {
                    $(form).find('.optionBox').append("<p><input type='checkbox' name='field_"+count+"[]' value='"+v+"'>"+v+"<i class='pull-right fa fa-trash' onclick='$(this).parent().remove()'></i></p>");
                }

            break;

        }
    });
    
</script>