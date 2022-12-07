<?php
require_once 'header.php';
$CI=&get_instance();
$pages = $this->SiteModel->list_page();

$list = $this->SiteModel->getSecondaryMenu();

$li = array();

$css;
if($list->num_rows())
{
        $data = $list->row();
        
        $li = $data->secondary_menu==''?array():(array)json_decode($data->secondary_menu);

        if(isJson($data->css))
        {
            $css = json_decode($data->css);
        }
}

// print_r($css); exit();


?>




<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-browser icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Secondary Menu
                <div class="page-title-subheading">
                </div>
            </div>
        </div>
        <div class="page-title-actions">
	        <!--button class="btn btn-success manage-images">Manage Images</button-->
                                   
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <form class="menuStyle">
        <div class="mb-3 card text-primary bg-white">
            <div class="card-header">Secondary Menu Design</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2 form-group">
                        <label>Text Color</label>
                        <input type="color" name="textColor" class="form-control" value="<?=isset($css->textColor)?$css->textColor:''?>">
                    </div>
                    <div class="col-lg-2 form-group">
                        <label>Text Hover Color</label>
                        <input type="color" name="textHover"  class="form-control" value="<?=isset($css->textHover)?$css->textHover:''?>">
                    </div>
                    <div class="col-lg-2 form-group">
                        <label>Font Size</label>
                        <div class="input-group">
                        <input type="number" name="Fsize"  class="form-control" value="<?=isset($css->Fsize)?$css->Fsize:'14'?>">
                            <div class="input-group-append"><span class="input-group-text">px</span></div>
                         </div>
                    </div>
                    <div class="col-lg-3 form-group">
                        <label>Font Style</label>
                        <select id="font-style-select" class="form-control" data-cur="<?=isset($css->Fstyle)?$css->Fstyle:''?>" name="Fstyle"  onchange="fontStyle(this)"></select>
                    </div>
                    <div class="col-lg-3 form-group">
                        <label>Font Family</label>
                        <select id="font-family-select" class="form-control" data-cur="<?=isset($css->Ffamily)?$css->Ffamily:''?>" name="Ffamily" onchange="$('.submitBtn button').css('font-family',this.value)"></select>
                    </div>                
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
    </div>
</div>



<div class="row">
    <div class="col-md-3">
        <div class="mb-3 card text-primary bg-white">
            <div class="card-header">All Pages</div>
            <div class="card-body">
                <table class="table table-bordered" id="pageList">
                    <tr><th></th><th>Page Name</th></tr>
                    <?php
                        foreach ($pages->result() as $val)
                        {
                          $index =   array_search($val->id,$li);
                            $chk = $index===false?'':' checked';

                            echo '<tr><td><input type="checkbox" data-id="'.$val->id.'" data-name="'.ucwords($val->page_name).'" data-sequence="'.$index.'" '.$chk.'></td><td>'.$val->page_name.'</td></tr>';
                        }
                    
                    ?>

                </table>
            </div>
        </div>
    </div>

     <div class="col-md-9">
        <div class="mb-3 card text-primary bg-white">
            <div class="card-header">Secondary Menu</div>
            <div class="card-body">
                <ul class="list-group fieldBox">
                   <?php
                    foreach ($li as $id) 
                    {
                        $pages = $this->SiteModel->list_page($id);
                        $name = 'undefine';
                        if($pages->num_rows())
                        {
                            $row = $pages->row();
                            $name = $row->page_name;
                        }
                        echo'<li class="list-group-item" id="'.$id.'"><i class="fa fa-th"></i> &nbsp; '.$name.'  </li>';
                    }
                   ?>
                </ul>
            </div>
            <div class="card-footer">
                <button class="btn btn-success saveOrder">Save</button>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
$( function() {
    $( ".fieldBox" ).sortable({
      revert: true,
    });
   
    $( ".fieldBox").disableSelection();

  } );

// function gen()
// {   //alert("f");
//     var list = $('#pageList').find('input[type=checkbox]:checked');
//     var i=0;
//     var data = new Array();
//     $(".fieldBox").html('');
//     for(i=0;i<list.length;i++)
//     {   
//         data['id'] = $(list[i]).data('id');
//         data['name'] = $(list[i]).data('name'); 
//         data['seq'] =  $(list[i]).data('sequence');

//         $(".fieldBox").append('<li class="list-group-item" id="'+data['id']+'"><i class="fa fa-th"></i> &nbsp; '+data['name']+'  </li>');
//     }
//     //   alert("c");

// }
$("#pageList input").on('click',function(){

    var name = $(this).data('name');
    var id = $(this).data('id');
    if(this.checked==true)
   $(".fieldBox").append('<li class="list-group-item" id="'+id+'"><i class="fa fa-th"></i> &nbsp; '+name+'</li>');
    else
        $("#"+id).remove();
});


$(".saveOrder").on('click',function(){
$("#load").show();

var x = $( ".fieldBox" ).sortable( "toArray" );

    $.ajax({
            url:'<?=site_url('Admin/secondary-menu')?>',
            type:'post',
            data:{order:x,status:'change-order'},
            success:function(q)
            {
               
                toastr.success("Saved Successfully");
                $("#load").hide();
            },
            error:function(u,v,w)
            {
                alert(w);
            }

        }); 



});


$(".menuStyle").on('submit',function(e){
e.preventDefault();
        $.ajax({
            url:'<?=site_url('Admin/secondary-menu')?>',
            type:'post',
            data:{css:$(this).serialize(),status:'change-style'},
            success:function(q)
            {
               //alert(q);
                toastr.success("Saved Successfully");
                $("#load").hide();
            },
            error:function(u,v,w)
            {
                alert(w);
            }

        }); 


});

</script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php
require_once 'footer.php';
?>