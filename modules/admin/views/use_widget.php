<?php
require_once 'header.php';
?>
<div class="hData" style="display: none;">
</div>

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-browser icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Use Widgets
                <div class="page-title-subheading">Modify Widget using this section.
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    div.sticky {
  position: -webkit-sticky; /* Safari */
  position: sticky;
  top: 63px;
  z-index:1;padding: 10px;
    margin: 0;
    background: rgb(0 0 0 / 67%)
}
.sticky .card{
    overflow:hidden;
}
</style>
<div class="row sticky">

		<?php
			foreach ($allWidget->result() as $wid)
			{
				echo'<div id="wid_'.$wid->id.'" class="card-shadow-warning border card card-body border-warning" draggable="true" ondragstart="pickup(event)" ondragover="override(event)" style="width:auto!important; max-width:200px;">
						<h5 class="card-title">'.$wid->widget_title.'</h5>
						<div class="mb-2 mr-2 badge badge-danger">'.strtoupper($wid->widget_type).'</div>
					</div>';
				
			}
		?>
	
</div>


<div class="row">
	<div class="col-md-12">
		<div class="mb-3 card text-white bg-info">
			<div class="card-header">Select Page <br>
				<select class="form-control text-blue pageid" onchange="arrenge_sidebar(this.value)">
					<option value="all">All Pages</option>
					<option value="postpage">Post Page</option>
					<?php
						foreach ($allPage->result() as $page)
						{
							echo'<option value="'.$page->id.'">'.$page->page_name.'</option>';
						}
					?>
				</select>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-sm-3" id="sideleft" ondragover="allowDrop(event)" ondrop="setdrop(event)" style="min-height: 300px; border: 1px solid blue;">

					</div>
					<div class="col-sm-6" style="padding-top: 100px;" align="center">
						<i class="fa fa-trash trashbox" id="middle" ondragover="allowDrop(event)" ondrop="setdrop(event)" style="font-size: 72px"></i>
					</div>
					<div class="col-sm-3" id="sideright" ondragover="allowDrop(event)" ondrop="setdrop(event)" style="min-height: 300px; border: 1px solid blue;" >
					</div>
				</div>
			</div>
			<div class="card-footer">
				<button class="btn btn-success save" type="submit"><i class="fa fa-floppy-o"></i> Save</button>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="mb-3 card text-white bg-info">
			<div class="card-header">Footer
				<!--<select class="form-control text-blue pageid">-->
				<!--	<option value="all">All Pages</option>-->
				<!--</select>-->
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12" id="sidefooter" ondragover="allowDrop(event)" ondrop="setdrop(event)" style="min-height: 200px; border: 1px solid blue;" align="center">

					</div>
				</div>
			</div>
			<div class="card-footer">
				<button class="btn btn-success saveFooter" type="submit"><i class="fa fa-floppy-o"></i> Save Footer</button>
			</div>
		</div>
	</div>

</div>
<?php

?>

<script type="text/javascript">
	var left=0;
	var right=0;
	var footer=0;
	var LEFT = new Array();
	var RIGHT= new Array();
	var FOOTER=new Array();
	function pickup(ev) 
	{
		//ev.preventDefault();
		ev.dataTransfer.setData("text",ev.target.id);

		if(ev.target.id.charAt(0)=='L' || ev.target.id.charAt(0)=='R' || ev.target.id.charAt(0)=='F')
		{
			$(".trashbox").show();
		}
	}


	function allowDrop(ev)
	{
		ev.preventDefault();
	}
	function setdrop(ev)
	{
		ev.preventDefault();

		var data = ev.dataTransfer.getData("text");

		if(data.charAt(0)=='w' && ev.target.id.charAt(0)=='s')
		{
			var nodeCopy = document.getElementById(data).cloneNode(true);

			if(ev.target.id=='sideleft')
			{
				
				nodeCopy.id  = "L_"+left+"_"+data;
				LEFT.push(nodeCopy.id);
				left++;
			}
			else if(ev.target.id=='sideright')
			{
				
				nodeCopy.id  = "R_"+right+"_"+data;
				RIGHT.push(nodeCopy.id);
				right++;
			}
			else if(ev.target.id=='sidefooter')
			{
				
					nodeCopy.id  = "F_"+footer+"_"+data;
					FOOTER.push(nodeCopy.id);
					footer++;
				
			}

	  		ev.target.appendChild(nodeCopy);
			
		}
		else if(data.charAt(0)=='L' && ev.target.id=='middle')
		{		var x = data.split("_");
				LEFT[x[1]]="NULL";
				
				$("#"+data).remove();
		}
		else if(data.charAt(0)=='R' && ev.target.id=='middle')
		{	var x = data.split("_");
				//alert(x[1]);
			RIGHT[x[1]]="NULL";
			$("#"+data).remove();
		}
		else if(data.charAt(0)=='F' && ev.target.id=='middle')
		{
			var x = data.split("_");
				//alert(x[1]);
			FOOTER[x[1]]="NULL";
			$("#"+data).remove();
		}
		$(".trashbox").hide();
	}

$(".save").on("click",function(){
	$("#load").show();

	var str="page_id="+$(".pageid").val()+"&l="+LEFT.toString()+"&r="+RIGHT.toString()+"&status=usewidget";
	//alert(str);

	 $.ajax({
	 	url:base_url+'admin/use_widget',
	 	type:'POST',
	 	data:str,
	 	success:function(q)
	 	{
	 		toastr.success("Sidebar Updated");
	 		$("#load").hide();
	 	}
	 });
});

$(".saveFooter").on("click",function(){
	 $("#load").show();
	 var str="page_id=all&f="+FOOTER.toString()+"&status=usefooter";
	
	 $.ajax({
	 	url:base_url+'admin/use_widget',
	 	type:'POST',
	 	data:str,
	 	success:function(q)
	 	{
	 		toastr.success("Footer Updated");
	 		$("#load").hide();
	 	}
	 });
});
arrenge_sidebar('all');
function arrenge_sidebar(pid)
{
	$.ajax({
		url:'<?=site_url("admin/arrenge_sidebar_widget")?>',
		data:{pid:pid},
		type:'post',
		beforeSend:function(){
			$("#load").show();
		},
		success:function(q)
		{	//alert(q);
			q= JSON.parse(q);

				left = q.ALCount;
				right = q.ARCount;
				if(q.aLEFT!='')
				{
					LEFT = q.aLEFT.split(',');
					$("#sideleft").html(q.Lwid);
				}
				else
				{
					LEFT = Array();
					$("#sideleft").html('');
				}

				if(q.aRIGHT!='')
				{
					RIGHT = q.aRIGHT.split(',');
					$("#sideright").html(q.Rwid);
				}
				else
				{
					RIGHT = Array();
					$("#sideright").html('');
				}
				//alert(q.Lwid);
				//alert(left);
				$("#load").hide();
		},
		error:function(u,v,w)
		{
			alert(w);
		}
	});
}
arrenge_footer();
function arrenge_footer()
{
	$.ajax({
		url:'<?=site_url("admin/arrenge_footer_widget")?>',
		data:{pid:'all'},
		type:'post',
		beforeSend:function(){
			$("#load").show();
		},
		success:function(q)
		{	//alert(q);
			q= JSON.parse(q);

				footer = q.fcount;

				if(q.FOOTER!='')
				{
					FOOTER = q.FOOTER.split(',');
					$("#sidefooter").html(q.Fwid);
				}
				else
				{
					FOOTER = Array();
					$("#sidefooter").html('');
				}

				$("#load").hide();
		},
		error:function(u,v,w)
		{
			alert(w);
		}
	});
}

</script>
<style type="text/css">
	.trashbox{display: none; color:red;}
	#sidefooter .card-shadow-warning{
		width: 220px;
    display:inline-block;
    margin:5px;
	}
	
</style>
<?php
require_once 'footer.php';
?>