<?

require_once 'header.php';

$gal  = $this->GalleryModel->image_gallery(AJ_DECODE($id));
$g = $gal->row();
?>

<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-file icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div>List Images

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
    <div class="col-md-5">
        <div class="form-group">
            <label><strong>Gallery View Layout</strong><small> (Numbers of pictures to show in single row)</small></label>
             <select class="form-control" onchange="changeLayout(<?=AJ_DECODE($id)?>,this.value)">
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

		<form class="form-inline" method="post" enctype="multipart/form-data">            

            <div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group">

            	<label for="examplePassword22" class="mr-sm-2">Image</label>

            	<input name="file" required id="examplePassword22" type="file" class="form-control">

            </div>

            <button class="btn btn-primary">Save</button>

        </form>

		<table class="table table-bordered table-striped">

			<thead>

				<tr>

					<th>#</th>

					<th>Image</th>

					<th>Action</th>

				</tr>

			</thead>

			<tbody>

				<?

				$i =1;

				 $img_list = $this->GalleryModel->list_galllery_images(array( 'gallery_id' => AJ_DECODE($id),'admin_id' => CLIENT_ID ));

				 foreach ($img_list->result() as $key => $l) {

				 	echo '<tr>

				 			<td>'.$i++.'.</td>

				 			<td><img src="'.site_url('public/temp/'.CLIENT_ID.'/'.$l->image).'" width="50" alt></td>

				 			<td><button class="btn btn-danger" onclick="del(this)" data-id="'.AJ_ENCODE($l->id).'"><i class="fa fa-trash"></i> Delete </button></td>

				 		  </tr>';

				 }

				?>

			</tbody>

		</table>

	</div>

</div>


<script type="text/javascript">
    function changeLayout(galid,lay)
    {
            $("#load").show();
            $.ajax({
                url:'<?=site_url('Admin/view_images')?>',
                type:'POST',
                data:'galid='+galid+'&lay='+lay+'&status=changeLayout',
                success:function(q)
                {
                    $("#load").hide();
                    toastr.success("Layout Updated");
                }
            });
    }

    function del(e)
    {   var el = e;
        if(confirm("Are you Sure to Delete?"))
        {   var id  = $(e).data('id');
            $.ajax({
                url:'<?site_url('Admin/view_images')?>',
                type:'post',
                data:{status:'delete',id:id},
                success:function(q)
                {  if(q=='1')
                    {
                         $(el).parent().parent().hide(300);
                         toastr.success("Image Deleted Successfully");
                    }
                    else
                         toastr.error("Error while deleting Image");
                },
                error:function(u,v,w)
                {
                    alert(w);
                }
            });
        }
    }
</script>

<script type="text/javascript" src="<?=site_url('public/custom/image-gallery.js')?>"></script>

<?

require_once 'footer.php';

?>