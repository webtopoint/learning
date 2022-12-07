<?php
require_once('header.php');
$page  =$this->SiteModel->list_page();
?>


<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-browser icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div> Manage Page Schema
                <div class="page-title-subheading"> Arrenge Content Order on page.
                </div>
            </div>
        </div>
    </div>
</div>



<div class="main-card mb-3 card">
    <div class="card-header">
        Arrenge Elements Order
    </div>
    <div class="card-body">
        <div class="form-group">
            <label>Select Page </label>
            <select class="form-control" name="pid" onchange="loadA()">
                <?php

                    foreach ($page->result() as $p)
                    {
                       echo'<option value="'.$p->id.'">'.$p->page_name.'</option>'; 
                    }
                   // echo'<option value="all">All Page</option>';
                ?>
            </select>
        </div>
    	<ul class="list-group fieldBox">
        </ul>
    </div>
    <div class="card-footer">
    	<button class="btn btn-info" type="button" onclick="saveA()">Save</button>
    </div>
</div>

<script type="text/javascript">
$(function() {
    $( ".fieldBox" ).sortable({
      revert: true,
    });
   
    $( ".fieldBox").disableSelection();
  } );

function saveA()
{   
     var pid = $("select[name=pid]").val();
	var x = $(".fieldBox").sortable('toArray');
	$("#load").show();
	$.ajax({
		url:'<?=site_url('admin/manage-schema')?>',
		type:'post',
		data:{seq:x,pid:pid,status:'save'},
		success:function(q)
		{ //alert(q);
			toastr.success("Schema Saved successfully");
			$("#load").hide();

		}
	})
}
loadA();
function loadA()
{  
    var pid = $("select[name=pid]").val();
    $.ajax({
        url:'<?=site_url('admin/manage-schema')?>',
        type:'post',
        data:{pid:pid,status:'load'},
        beforeSend:function()
        {
             $(".list-group").html('<center><h1><font size="7"><i class="fa fa-spinner fa-spin"></i></font></h1></center>');
        },
        success:function(q)
        {  // alert(q);   
            console.log(q);
            $(".list-group").html(q);


        }
    });
}
</script>


<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<?php
require_once('footer.php');
?>