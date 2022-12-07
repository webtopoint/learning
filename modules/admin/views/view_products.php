<?

require_once 'header.php';

?>

<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-file icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div>List Products

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


<button class="btn btn-primary" onclick="$('.addBox').show(),$(this).hide()">Add Product</button>


<div class="row addBox" style="display: none;">

	<div class="col-md-12">


<div class="mb-3 card">
    <div class="card-header-tab card-header">Add Product</div>
    <div class="card-body">
		<form method="post" enctype="multipart/form-data">            

            <div class="form-group">

            	<label>Product Image</label>

            	<input name="file" required  type="file" class="form-control">

            </div>

             <div class="form-group">

                <label>Title</label>

                <input name="title" required type="input" class="form-control">

            </div>

             <div class="form-group">

                <label>Description</label>

                <textarea  cols="80" id="aryaeditor" name="description" rows="10"></textarea>
                
            </div>

              <div class="form-group">

                <label>Redirect Link (Optional)</label>
                <input type="url" name="link"  class="form-control">
            </div>
            

            <button class="btn btn-primary">Save</button>

        </form>
    </div>
    </div>
</div>
</div>

<div class="mb-3 card" style="margin-top: 15px;">
    <div class="card-header-tab card-header">Product List</div>
    <div class="card-body">
		<table class="table table-bordered table-striped">

			<thead>

				<tr>

					<th>#</th>

					<th>Produc Image</th>
                    <th>Title</th>
                    <th>Description</th>
					<th>Action</th>

				</tr>

			</thead>

			<tbody>

				<?

				$i =1;

				 $img_list = $this->GalleryModel->getGalleryProducts(array('gallery_id'=>AJ_DECODE($id)));

				 foreach ($img_list->result() as $key => $l) {

				 	echo '<tr>

				 			<td>'.$i++.'.</td>

				 			<td><img src="'.site_url('public/temp/'.CLIENT_ID.'/'.$l->image).'" width="50" alt></td>
                            <td>'.$l->title.'</td>
                            <td>'.$l->description.'</td>
				 			<td><div class="dropdown d-inline-block">

                                            <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-focus">Action</button>

                                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 33px, 0px);">

                                               <a href="'.site_url('Admin/product-gallery/'.AJ_ENCODE($l->id).'/edit-product').'"><button type="button" tabindex="0" class="dropdown-item"><i class="fa fa-edit"></i> Edit</button></a>

                                                <button data-proid="'.AJ_ENCODE($l->id).'" data-galid="'.$id.'" type="button" tabindex="0" class="dropdown-item" onclick="deleteProduct(this)"><i class="fa fa-trash"></i> Delete</button>

                                            </div>

                                        </div></td>

				 		  </tr>';

				 }

				?>

			</tbody>

		</table>
    </div>
</div>

</div>
</div>

<script type="text/javascript">
    function deleteProduct(ele)
    {
        if(confirm("Are you sure to delete ?\n1. Product image will be permanently Deleted.\n2. Product query will be permanetly Delete."))
        {
            location.href='<?=site_url('Admin/delete-product/')?>'+ele.dataset.proid+'/'+ele.dataset.galid;
        }
    }

    $(".prd_gallery").addClass(" mm-active");
    $(".gallery_setting").addClass(" mm-active");
</script>

<script type="text/javascript" src="<?=site_url('public/custom/ckeditor.js')?>"> </script>

<?

require_once 'footer.php';

?>