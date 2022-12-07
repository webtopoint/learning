<?php
require_once 'header.php';

$gal  = $this->GalleryModel->getVideoGallery(array('id'=>AJ_DECODE($id)));
$g = $gal->row();
?>

<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-file icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div>List Videos

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
        <div class="main-card mb-3 card">
            <div class="card-header">Update Gallery Layout</div>
            <div class="card-body">
                <div class="form-group">
                    <label><strong>Gallery View Layout</strong><small> (Numbers of Videos to show in single row)</small></label>
                     <select class="form-control" onchange="changeLayout(<?=AJ_DECODE($id)?>,this.value)">
                        <option   value="1"  <?= $g->layout == '1' ? 'selected' : '' ?> >  1  </option>
                        <option   value="2"  <?= $g->layout == '2' ? 'selected' : '' ?> >  2  </option>
                        <option   value="3"  <?= $g->layout == '3' ? 'selected' : '' ?> >  3  </option>
                        <option   value="4"  <?= $g->layout == '4' ? 'selected' : '' ?> >  4  </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
         <div class="main-card mb-3 card">
                <div class="card-header">Add Video</div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="status" value="addVideo">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <select class="form-control select-video-type" name="type"><option value="youtube">Youtube</option><option value="video">Video</option></select>
                        </div>
                        <input type="url" required name="video" class="form-control youtube_video input-style" placeholder="Enter Youtbe Link Here.." style="padding-top:3px">
                    </div>
                    <div class="form-group">
                        <iframe src="" id="url_file_here" style="width: 100%;border:0;height: 0;"></iframe>
                        <!--<input type="url" name="video" class="form-control">-->
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">Save</button>
                    </div>
                    </form>
                </div>
        </div>
    </div>
</div>
<script>
    $('.select-video-type').change(function(){
        let type = this.value,
            input = $('.input-style');
        var video = document.getElementById('url_file_here');
        video.src  ='';
        video.style.height = 0;
        if(type == 'video')
            $(input).attr('type','file').addClass('file_video').removeClass('youtube_video').attr('accept','video/*');
        else
            $(input).attr('type','url').removeClass('file_video').addClass('youtube_video').removeAttr('accept').focus();
    });
    
    
    
    
    
    
    
    
    
    
    
    
    $(document).on('blur','.youtube_video',function(){
        var video = document.getElementById('url_file_here');
        let value = (this.value).replace('watch?v=','embed/');
        if(value){
          video.src = value;
          video.style.height = '351px';
        }
        else
          video.style.height = '0';
    });
    
    
    
$(document).on("change",".file_video",function(evt){
  var video = document.getElementById('url_file_here');
  video.style.height = '0';   
          video.src = window.URL.createObjectURL(this.files[0]);
          video.style.height = '351px';
  
});
</script>
<div class="row">

	<div class="col-md-12">
		<table class="table table-bordered table-striped">

			<thead>

				<tr>

					<th>#</th>

					<th>Video</th>

					<th>Action</th>

				</tr>

			</thead>

			<tbody>

				<?

				$i =1;

				 $vid_list = $this->GalleryModel->getGalleryVideos(array('gallery_id' => AJ_DECODE($id)));

				 foreach ($vid_list->result() as $key => $l) {
                    // echo $l->video;
                    $yid = explode('=', $l->video);
                    
                    $THUMB = $l->type == 'youtube' ? 'https://img.youtube.com/vi/'.$yid[1].'/hqdefault.jpg" width="150' : base_url.'/public/web/video_thumb.jpg';
				 	echo '<tr>

				 			<td>'.$i++.'.</td>

				 			<td><img src="'.$THUMB.'" alt></td>
				 			<td><button class="btn btn-danger" onclick="del(this)" data-id="'.AJ_ENCODE($l->id).'"><i class="fa fa-trash"></i> Delete</button></td>

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
                url:'<?=site_url('Admin/view-videos/ChangeLayout')?>',
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
                url:'<?site_url('Admin/view-videos/delete')?>',
                type:'post',
                data:{status:'delete',vid:id},
                success:function(q)
                {
                    $(el).parent().parent().hide(300);
                    toastr.success("Video Deleted Successfully");
                }
            });
        }
    }
</script>

<script type="text/javascript" src="<?=site_url('public/custom/image-gallery.js')?>"></script>

<?

require_once 'footer.php';

?>