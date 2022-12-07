<?

require_once 'header.php';

?>

<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div>Add Image Gallery

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

	<div class="col-md-4"><form action="<?=site_url('Admin/image-gallery')?>" class="needs-validation" method="post"  novalidate>

		<div class="mb-3 text-center card main-card add-image-gallery">



			<div class="card-header">

				<h5>Add Image Gallery</h5>

			</div>

            <div class="card-body">

                <input type="text" name="gallery_name" placeholder="Enter Gallery Name.." class="form-control" required="">

                <div class="invalid-feedback">

                                                Please provide a valid name.

                </div>

            </div>

            <div class="card-footer	">

            	<button class="btn btn-outline-focus"  style="width: 100%">

					<i class="pe-7s-paper-plane"></i> Publish

				</button>

            </div>

        </div></form>

	</div>

	<div class="col-md-8">

		<div class="card mb-3 main-card " style="padding:10px">

			<div class="card-header">

				<h5>List Of Image Gallery</h5>

			</div>

			<div class="card-body all-div">

				<?

				$imageGal = $this->GalleryModel->image_gallery();

				if($imageGal->num_rows())
                {

					foreach ($imageGal->result() as $key => $img) 
                    {

						$ttl = $this->db->get_where('gallery_images',array('gallery_id'=>$img->id))->num_rows();

						echo '<div class="col-md-12">

                                    <div class="card mb-3 widget-content bg-premium-dark">

                                        <div class="widget-content-wrapper text-white">

                                            <div class="widget-content-left">

                                                <div class="widget-heading">'.ucwords($img->gallery_name).'</div>

                                                <div class="widget-subheading">Total '.$ttl.' Images</div>

                                            </div>

                                            <div class="widget-content-right">

                                                <div class="widget-numbers">

                                                	<a href="'.site_url('Admin/image-gallery/'.AJ_ENCODE($img->id).'/view-images').'" class="btn btn-primary"><i class="fa fa-eye"></i></a>

                                                	<button class="btn btn-danger delete-image-gallery" data-id="'.$img->id.'" data-num="'.$ttl.'"><i class="fa fa-trash"></i></button>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>';

					}

				}

				?>

			</div>

		</div>

	</div>




</div>

<script type="text/javascript" src="<?=site_url('public/custom/image-gallery.js')?>"></script>

<?

require_once 'footer.php';

?>