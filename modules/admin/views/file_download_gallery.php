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

                                    <div>Add File Download Gallery
                                         <small><?
                                           if($tab)
                                              echo '<label style="color:red">[ Files ]</style>';
                                         ?></small>

                                        <div class="page-title-subheading">
                                        	<?
                                        	if($this->session->flashdata('msg'))
                                        		echo $this->session->flashdata('msg');
                                        	?>

                                        </div>

                                    </div>

                                </div>  

                            </div>

</div>  



<div class="row">

    <?
    if($tab):
      ?>
      <div class="col-md-4">

          <form action="<?=base_url?>/Admin/add_files_in_file_gallery/<?=$p1?>" method="POST" enctype="multipart/form-data">
              <div class="mb-3 text-center card main-card">
                  <div class="card-header">
                      <h5>Add Files</h5>
                  </div>
                  <div class="card-body">
                      <input type="text" name="file_name" class="form-control" placeholder="Enter File Name.." required>
                      <br>
                      <input type="file" name="files" class="form-control" required>
                      <b class="text-success text-left">Max File Size : 50 MB</b>

                  </div>
                  <div class="card-footer">
                     <button class="btn btn-outline-focus"  style="width: 100%">

    					<i class="pe-7s-paper-plane"></i> Publish
    
    				</button>
                  </div>
              </div>
          </form>
      </div>
      <div class="col-md-8">
          <div class="card mb-3 main-card " style="padding:10px">

			<div class="card-header">

				<h5>List Of Files Download Gallery</h5>

			</div>

			<div class="card-body ">
			    <?
			    $files = $this->db->get_where('files_download_gallery', ['file_download_gallery_id' => AJ_DECODE($p1) ]);
			    if($files->num_rows() ){
			        ?>
			        <table class="table table-bordered table-striped">
			            <thead>
			                <tr>
			                    <th>#.</th>
			                    <th>File Name</th>
			                    <th>View</th>
			                    <th>Remove</th>
			                </tr>
			            </thead>
			            <tbody>
			                <? $i = 1;
			                foreach($files->result() as $key => $file){
			                    echo '<tr>
			                            <td>'.$i++.'.</td>
			                            <td>'.$file->file_name.'</td>
			                            <td><a href="'.base_url.'/public/temp/'.CLIENT_ID.'/'.$file->link.'" target="_blank" class="btn btn-success btn-sm btn-xs"><i class="fa fa-eye"></i></a></td>
			                            <td><a data-id="'.AJ_ENCODE($file->gallery_file_id).'" href="javascript:void(0)" class="btn btn-danger btn-xs btn-sm delete-file"><i class="fa fa-trash"></i></a></td>
			                          </tr>';
			                }
			                ?>
			            </tbody>
			        </table>
			        <script>
			           $('.delete-file').click(function(){
			               var id = $(this).data('id');
			               $.alert({
			                   type:'red',
			                   title:'Confirmation!',
			                   icon:'fa fa-bell',
			                   closeIcon: true,
			                   content:'Are you sure for delete this file.',
			                   buttons:{
			                       ok:{
			                           text:'<i class="fa fa-trash"></i> Delete',
			                           btnClass:'btn-danger',
			                           action:function(){
			                               location.href="<?=base_url?>/Admin/file-download-gallery/"+id+"/delete-file";
			                           }
			                       },
			                       cancel:function(){}
			                   }
			               });
			           });
			        </script>
			        <?
			    }
			    else
			      echo '<div class="alert alert-danger">Files are not available in this Gallery.</div>';
			    
			    ?>
			</div>
		</div>
      </div>
      <?
        
    else:
    ?>
	<div class="col-md-4"><form action="" class="needs-validation" method="post"  novalidate>

		<div class="mb-3 text-center card main-card add-image-gallery">

			<div class="card-header">
				<h5>Add File Download Gallery</h5>
			</div>
            <div class="card-body">

                <input type="text" name="gallery_name" placeholder="Enter File Download Gallery Name.." class="form-control" required="">

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

				<h5>List Of File Download Gallery</h5>

			</div>

			<div class="card-body all-div">

				<?

				$file_download_Gallery = $this->GalleryModel->file_download_gallery();

				if($file_download_Gallery->num_rows())
                {

					foreach ($file_download_Gallery->result() as $key => $file) 
                    {

						$ttl = $this->db->get_where('files_download_gallery',array('file_download_gallery_id'=>$file->file_download_gallery_id))->num_rows();

						echo '<div class="col-md-12">

                                    <div class="card mb-3 widget-content bg-premium-dark">

                                        <div class="widget-content-wrapper text-white">

                                            <div class="widget-content-left">

                                                <div class="widget-heading">'.ucwords($file->gallery_name).'</div>

                                                <div class="widget-subheading">Total '.$ttl.' Images</div>

                                            </div>

                                            <div class="widget-content-right">

                                                <div class="widget-numbers">

                                                	<a href="'.site_url('Admin/file-download-gallery/'.AJ_ENCODE($file->file_download_gallery_id).'/view-files').'" class="btn btn-primary"><i class="fa fa-eye"></i></a>

                                                	<button class="btn btn-danger delete-download-file-gallery" data-id="'.$file->file_download_gallery_id.'" data-num="'.$ttl.'"><i class="fa fa-trash"></i></button>

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

    <?
    endif;
    ?>

</div>

<script type="text/javascript" src="<?=site_url('public/custom/file-download-gallery.js')?>">
    
    
    
</script>
<script>
    $('.delete-download-file-gallery').click(function(){

	var num = $(this).data('num');
	var id  = $(this).data('id');
	$('#load').show();
   // return false;
    
	if(num){

		$('#load').hide();

		$.dialog({

			type:'red',

			theme:'supervan',

			title:'Notification',

			icon:'fa fa-bell',
			
			columnClass:'col-md-8 col-md-offset-4',

			content:'First delete all the Files in this gallery, after that this gallery will be deleted.',

		});

		return false;

	}



	$.confirm({

		type:'red',

		title:'Confirmation',

		icon:'fa fa-eye',

		content:'Are You sure for delete this gallery.',

		buttons:{

			ok:{

				text:'<i class="fa fa-trash"></i> Delete',

				btnClass:'btn-danger',

				action:function(){

					$.ajax({

						type:'POST',

						url:base_url+'Admin/AJAX',

						data:{

							var:'delete_file_gallery',

							id:id

						},

						dataType:'json',

						success:function(res){

							$('#load').hide();

							toastr.success('File Gallery Delete Successfully.');

							setTimeout(function(){location.reload();},500);

						}

					});

				}

			},

			cancel:function(){$('#load').hide();}

		}

	});

});
</script>
<?

require_once 'footer.php';

?>