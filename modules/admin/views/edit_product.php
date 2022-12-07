<?

require_once 'header.php';
$pro = $this->GalleryModel->getGalleryProducts(array('id'=>AJ_DECODE($id)));
$pro = $pro->row();

?>

<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-file icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div>Edit Product

                                        <div class="page-title-subheading">

                                        	<?

                                        	if($this->session->flashdata('error'))

                                        		echo $this->session->flashdata('error');

                                        	if($this->session->flashdata('success'))

                                        		echo $this->session->flashdata('success');

                                        	?>

                                        </div>

                                    </div>

                                </div>   

                            </div>

</div>  

<div class="row">

	<div class="col-md-12">


<div class="mb-3 card">
    <div class="card-header-tab card-header">Edit Product</div>
    <div class="card-body">
		<form method="post" enctype="multipart/form-data">            

            <div class="form-group">

            	<label>Product Image</label><br>

                <img src="<?=base_url('public/temp/'.CLIENT_ID.'/'.$pro->image)?>" style="height: 250px; width: 200px;">
                <br>
            	
                <br>
                <div class="chngIMG">
                <button class="btn btn-success" type="button">Change Image</button>
                </div>

            </div>

             <div class="form-group">

                <label>Title</label>

                <input name="title" required type="input" class="form-control" value="<?=$pro->title?>">

            </div>

             <div class="form-group">

                <label>Description</label>

                <textarea  cols="80" id="aryaeditor" name="description" rows="10"><?=$pro->description?></textarea>
                
            </div>

            <div class="form-group">

                <label>Redirect Link (Optional)</label>
                <input type="url" name="link" class="form-control" value="<?=$pro->product_link?>">
            </div>
            

            <button class="btn btn-primary">Save</button>

        </form>
    </div>
    </div>
</div>
</div>

<script type="text/javascript">
    $(".chngIMG button").click(function(){
        $(".chngIMG").html('<input name="file" required  type="file" class="form-control">');
    });


    $(".prd_gallery").addClass(" mm-active");
    $(".gallery_setting").addClass(" mm-active");

</script>

<script type="text/javascript" src="<?=site_url('public/custom/ckeditor.js')?>"> </script>


<?

require_once 'footer.php';

?>