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

                                    <div>Add Video Gallery

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

    <div class="col-md-4"><form action="<?=site_url('Admin/video-gallery')?>" class="needs-validation" method="post"  novalidate>

        <div class="mb-3 text-center card main-card add-image-gallery">



            <div class="card-header">

                <h5>Add Video Gallery</h5>

            </div>

            <div class="card-body">

                <input type="text" name="vgallery_name" placeholder="Enter Video Gallery Name.." class="form-control" required="">

                <div class="invalid-feedback">

                                                Please provide a valid name.

                </div>

            </div>

            <div class="card-footer ">

                <button class="btn btn-outline-focus"  style="width: 100%">

                    <i class="pe-7s-paper-plane"></i> Publish

                </button>

            </div>

        </div></form>

    </div>





    <div class="col-md-8">

        <div class="card mb-3 main-card " style="padding:10px">

            <div class="card-header">

                <h5>List Of Video Gallery</h5>

            </div>

            <div class="card-body all-div">

                <?

                $videoGal = $this->GalleryModel->getVideoGallery();

                if($videoGal->num_rows())
                {

                    foreach ($videoGal->result() as $key => $vid) 
                    {

                        $ttl = $this->db->get_where('gallery_videos',array('gallery_id'=>$vid->id))->num_rows();

                        echo '<div class="col-md-12">

                                    <div class="card mb-3 widget-content bg-premium-dark">

                                        <div class="widget-content-wrapper text-white">

                                            <div class="widget-content-left">

                                                <div class="widget-heading">'.ucwords($vid->gallery_name).'</div>

                                                <div class="widget-subheading">Total '.$ttl.' Images</div>

                                            </div>

                                            <div class="widget-content-right">

                                                <div class="widget-numbers">

                                                    <a href="'.site_url('Admin/video-gallery/'.AJ_ENCODE($vid->id).'/view-videos').'" class="btn btn-primary"><i class="fa fa-eye"></i></a>

                                                    <button class="btn btn-danger delete-video-gallery" data-id="'.$vid->id.'" data-num="'.$ttl.'"><i class="fa fa-trash"></i></button>

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

<script type="text/javascript">
     $(".delete-video-gallery").click(function(){
        var id  = $(this).data('id');
        var num = $(this).data('num');
        if(!num)
        {
                $.confirm({

                    type:'red',

                    title:'Confirmation',

                    icon:'fa fa-eye',

                    content:'Are You sure for delete this Video Gallery.',

                    buttons:{

                        ok:{

                            text:'<i class="fa fa-trash"></i> Delete',

                            btnClass:'btn-danger',
                            action:function(){
                                location.href=base_url+'Admin/delete-video-gallery/'+id;
                            }
                        },
                        cancel:function(){}
                    }

                });
        }
        else
        {
                $.dialog({

                type:'red',

                theme:'supervan',

                title:'Notification',

                icon:'fa fa-bell',

                content:'First delete all the Products from gallery. Only Empty Gallery can be deleted.',

            });
        }
  });
</script>

<?

require_once 'footer.php';

?>
