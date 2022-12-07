<?

require_once 'header.php';

$gal  = $this->GalleryModel->product_gallery(array('id'=>$id));
$g = $gal->row();
$css= json_decode($g->btn_css);
?>

<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div>Edit Product Gallery

                                        <div class="page-title-subheading">

                                        	<?

                                        	if($this->session->flashdata('error')){

                                        		echo $this->session->flashdata('error');

                                        	}

                                        	?>

                                        </div>

                                    </div>

                                </div>  

                            </div>

</div>  



<div class="row">
    <div class="col-md-5">
        <div class="form-group">
            <label><strong>Product Gallery View Layout</strong><small> (Numbers of pictures to show in single row)</small></label>
             <select class="form-control" onchange="changeLayout(<?=$id?>,this.value)">
                <option value="1" <?=$g->layout=='1'?'selected':''?> >1</option>
                <option value="2" <?=$g->layout=='2'?'selected':''?> >2</option>
                <option value="3" <?=$g->layout=='3'?'selected':''?> >3</option>
                <option value="4" <?=$g->layout=='4'?'selected':''?> >4</option>
            </select>
        </div>
    </div>
</div>

<div class="row">

	<div class="col-md-12">
        <form action="" class="needs-validation" method="post"  novalidate>

		<div class="mb-3 text-center card main-card add-product-gallery">



			<div class="card-header">

				<h5>Edit Product Gallery</h5>

			</div>

            <div class="card-body" align="left">
                <div class="row">
                    <div class="col-md-12">
                        <label>Gallery Name</label>
                        <input type="text" name="gallery_name" class="form-control" value="<?=$g->gallery_name?>">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Product Button </h4>
                        Preview : <button class="previewButton" type="button">Text</button>
                    </div>

                </div>
                <br>
                <div class="row">
                     <div class="col-md-4">
                        <label>Button Text</label>
                        <input type="text" name="text" class="form-control" value="<?=$css->text?>">
                    </div>
                     <div class="col-md-2">
                        <label>Text Color</label>
                        <input type="color" name="color" class="form-control" value="<?=$css->color?>">
                    </div>
                     <div class="col-md-2">
                        <label>Text Hover</label>
                        <input type="color" name="textHover" class="form-control" value="<?=$css->textHover?>">
                    </div>
                     <div class="col-md-2">
                        <label>Background Color</label>
                        <input type="color" name="backColor" class="form-control" value="<?=$css->backColor?>">
                    </div>
                     <div class="col-md-2">
                        <label>Background Hover</label>
                        <input type="color" name="backHover" class="form-control" value="<?=$css->backHover?>">
                    </div>
                  
                    
                </div>
                <br>
                <div class="row">
                     <div class="col-md-4">
                        <label>Border Size</label>
                        <input type="number" name="Bsize" class="form-control" value="<?=$css->Bsize?>">
                    </div>
                     <div class="col-md-4">
                        <label>Border Color</label>
                        <input type="color" name="Bcolor" class="form-control" value="<?=$css->Bcolor?>"> 
                    </div>
                     <div class="col-md-4">
                        <label>Button Style</label>
                        <select class="form-control" name="Bstyle">

                                            <option value="none" <?=$css->Bstyle=='none'?'selected':''?>>None</option>

                                            <option value="solid" <?=$css->Bstyle=='solid'?'selected':''?>>Solid</option>

                                            <option value="double" <?=$css->Bstyle=='double'?'selected':''?>>Double</option>

                                            <option value="dashed" <?=$css->Bstyle=='dashed'?'selected':''?>>Dashed</option>

                                            <option value="dotted" <?=$css->Bstyle=='dotted'?'selected':''?>>Dotted</option>

                                            <option value="groove" <?=$css->Bstyle=='groove'?'selected':''?>>Groove</option>

                                            <option value="ridge" <?=$css->Bstyle=='ridge'?'selected':''?>>Ridge</option>

                                            <option value="inset" <?=$css->Bstyle=='inset'?'selected':''?>>Inset</option>
                                            
                                            <option value="outset" <?=$css->Bstyle=='outset'?'selected':''?>>Outset</option>
                                            
                                        </select>
                    </div>
                </div>

                <div class="row">
                     <div class="col-md-3">
                        <label>Padding Left</label>
                        <input type="number" name="padL" class="form-control" value="15">
                    </div>
                     <div class="col-md-3">
                        <label>Padding Right</label>
                        <input type="number" name="padR" class="form-control" value="15">
                    </div>
                     <div class="col-md-3">
                        <label>Padding Top</label>
                        <input type="number" name="padT" class="form-control" value="5">
                    </div>
                     <div class="col-md-3">
                        <label>Padding Bottom</label>
                        <input type="number" name="padB" class="form-control" value="5">
                    </div>
                </div>
                
                
                <div class="row">
                    <div class="col-md-12 mt-3">
                        <div class="card card-primary">
                            <div class="card-header bg-primary text-white">
                                <h3>Set Form Setting</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                <?php
                                    $forms = $this->FormModel->getFormModel();
                                    foreach($forms->result() as $f)
                                    {
                                        echo'<li class="list-group-item" data-id="'.$id.'" data-form_id="'.$f->id.'" data-form_type="form">
                                            <p class="list-group-item-text">';
                                                $chk = $this->FormModel->checkFormUseInProductGallery(array('form_id'=>$f->id,'id'=>$id))?" checked":"";
                                              echo'<div class="custom-checkbox custom-control"><input type="checkbox" id="id'.$f->id.'_'.$id.'" class="custom-control-input set-form-in-product-gallery" '.$chk.'>
                                                <label class="custom-control-label" for="id'.$f->id.'_'.$id.'">'.$f->title.'</label>
                                                </div>';
                                            echo'</p>
                                          </li>';
                                    }
                                ?>

                                </ul>
                                
                                
                                <div class="alert alert-success">
                                    <strong>Notice:</strong><br>
                                    This section is  working now, Please Use it..
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                

            </div>

            <div class="card-footer	">

            	<button class="btn btn-outline-focus"  style="width: 100%">

					<i class="pe-7s-paper-plane"></i> Publish

				</button>

            </div>

        </div></form>

	</div>
</div>

<style type="text/css" id="styleBox">
    
</style>

<script type="text/javascript">
    function changeLayout(galid,lay)
    {
            $("#load").show();
            $.ajax({
                url:'<?=site_url('admin/view_products')?>',
                type:'POST',
                data:'galid='+galid+'&lay='+lay+'&status=changeLayout',
                success:function(q)
                {
                    $("#load").hide();
                    toastr.success("Layout Updated");
                }
            });
    }

makePreview();
$(".card-body input").on("keyup",function(){makePreview()});
$(".card-body input,select").on("change",function(){makePreview()});

$(document).on('change','.set-form-in-product-gallery',function(){
    var li = $(this).closest('li'),
        id = $(li).data('id'),
        form_id = $(li).data('form_id'),
        form_type = $(li).data('form_type');
        
        $('#load').show();
        $.ajax({
                url:'<?=site_url('admin/update_product_gallery_setting')?>',
                type:'POST',
                data:{id,form_id,form_type},
                dataType:'json',
                success:function(q)
                {
                    console.log(q);
                    $("#load").hide();
                    toastr.success("Form Updated");
                },
                error:function(r,v,c){
                    console.warn(r.responseText);
                }
            });
    
});




function  makePreview()
{
    var text = $("input[name=text]").val();
    var backColor = $("input[name=backColor]").val();
    var backHover = $("input[name=backHover]").val();
    var color = $("input[name=color]").val();
    var textHover = $("input[name=textHover]").val();
    var Bsize = $("input[name=Bsize]").val();
    var Bcolor = $("input[name=Bcolor]").val();
    var Bstyle = $("select[name=Bstyle]").val();
    var L = $("input[name=padL]").val()+"px";
    var R = $("input[name=padR]").val()+"px";
    var T = $("input[name=padT]").val()+"px";
    var B = $("input[name=padB]").val()+"px";
    var padd =  T+" "+R+" "+B+" "+L;
    $(".previewButton").html(text);
    $("#styleBox").text(".previewButton{background:"+backColor+"; color:"+color+"; border:"+Bsize+"px "+Bstyle+" "+Bcolor+"; padding:"+padd+"; } .previewButton:hover{ background:"+backHover+"; color:"+textHover+"; }");
}
</script>

<?

require_once 'footer.php';

?>