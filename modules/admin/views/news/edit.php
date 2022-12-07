<style type="text/css">
	
</style>
<?
$post = $this->NewsModel->get(['id'=>AJ_DECODE($id)]);
if($post->num_rows()):
    $post = $post->row();
?>

<form class="edit-post" method="POST" enctype="multipart/form-data">
	<div class="card">

		<div class="card-header bg-primary text-white">
			<div><i class="fa fa-plus"></i> Add Post</div>
			<div class="btn-actions-pane-right">
                <div role="group" class="btn-group-sm btn-group">
                    <button class="btn-outline-9x text-white  btn-success btn btn-outline-focus"><i class="fa fa-plus"></i> Publish</button>
                </div>
            </div>
		</div>

		<div class="card-body md row">
			<div class="col-md-8">
				<div class="form-group">
					<label>Enter Title</label>
					<input type="text" name="title" class="form-control" placeholder="Enter Title" value="<?=$post->title?>">
				</div>
				<div class="form-group">
					<label>Content</label>
					<textarea class="textarea" name="content" id="aryaeditor"><?=$post->content?></textarea>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header bg-info text-white">
						<div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="fa fa-list"></i> Category(s)</div>
						<div class="btn-actions-pane-right text-capitalize">
                            <button type="button" class="btn btn-info list-cats" onclick="this.innerHTML = '<i class=\'fa fa-refresh fa-spin\'></i>';list_cats()"><i class="fa fa-refresh"></i></button>
                        </div>
					</div>
					<div class="card-body md table-print">
						
					</div>
					<div class="card-footer" style="padding: 0;">
						<div class="" style="text-align: center;width: 100%;padding: 10px;font-size: 1.4em;">
							<a id="category-add-toggle" href="javascript:void(0)" onclick="$('#category-add').toggle(200);$('#category-add').find('input').focus()" class="hide-if-no-js taxonomy-add-new">
								+ Add New Category				
							</a>
						</div>
					</div>
					<div id="category-add" class="card-footer" style="display: none">
						<div class="form-group" style="width: 100%">
							<label class="screen-reader-text" for="newcategory">Add New Category</label>
							<div class="input-group">
	                            <input type="text" class="form-control">
	                            <div class="input-group-append">
	                                <button type="button" class="btn btn-secondary save-category"><i class="fa fa-plus"></i></button>
	                            </div>
	                        </div>
						</div>
					</div>
				</div>


				<div class="card">

					<div class="card-header bg-primary text-white">
						<strong>News / Post Banner</strong>
					</div>
					
					<div class="card-body">
						<div class="form-group">
							<label style="padding-right: 19px"><input type="radio" name="media" class="media-select" <?=($post->banner_type == 'image') ? 'checked' : ''?> value="image"> Image</label>
							<label style="padding-right: 19px"><input type="radio" name="media" class="media-select" <?=($post->banner_type == 'youtube') ? 'checked' : ''?> value="youtube"> Youtube Link</label>					
						</div>			
						<div class="form-group media-div image-div" style="display:<?=($post->banner_type == 'image') ? 'block' : 'none'?>">
							<div id="coba" class="row row-sm">
							    <?
							    if($post->banner_type == 'image'){
							        $img = base_url.'/public/temp/'.CLIENT_ID.'/'.$post->banner_value;
							 echo '<div class="col-md-12 spartan_item_wrapper" data-spartanindexrow="0" style="margin-bottom : 20px; ">
                			        <div style="position: relative;">
                			            <div class="spartan_item_loader" data-spartanindexloader="0" style=" position: absolute; width: 100%; height: 200px; background: rgba(255,255,255, 0.7); z-index: 22; text-align: center; align-items: center; margin: auto; justify-content: center; flex-direction: column; display : none; font-size : 1.7em; color: #CECECE">
                			            <i class="fas fa-sync fa-spin"></i>
                			            </div>
                			            <label class="file_upload" style="width: 100%; height: 200px; border: 2px dashed #ddd; border-radius: 3px; cursor: pointer; text-align: center; overflow: hidden; padding: 5px; margin-top: 5px; margin-bottom : 5px; position : relative; display: flex; align-items: center; margin: auto; justify-content: center; flex-direction: column;">
                			               <a href="javascript:void(0)" data-spartanindexremove="0" style="right: 3px; top: 3px; background: rgb(237, 60, 32); border-radius: 3px; width: 30px; height: 30px; line-height: 30px; text-align: center; text-decoration: none; color: rgb(255, 255, 255); position: absolute !important;" class="spartan_remove_row">
                			                <i class="fas fa-times"></i>
                			                </a>
                			                <img style="width: 100%; margin: 0px auto; vertical-align: middle; display: none;" data-spartanindexi="0" src="'.base_url.'/public/placeholder.png" class="spartan_image_placeholder"> 
                			                <p data-spartanlbldropfile="0" style="color : #5FAAE1; display: none; width : auto; ">Drop Here</p>
                			                <img style="width: 100%; vertical-align: middle;" class="img_" data-spartanindeximage="0" src="'.$img.'">
                			                <input class="form-control spartan_image_input" accept="image/*" data-spartanindexinput="0" style="display : none" name="imgs[]" type="text" value="'.$img.'">
                			                </label> 
                			             </div>
                			     </div>';
							    }
							    ?>
							    
							</div>
						</div>	
						<div class="youtube-div media-div" style="display: <?=($post->banner_type == 'youtube') ? 'block' : 'none'?>"> 
							<div class="form-group">
								<label>Video Link</label>
								<input type="url"  name="youtubeurl" placeholder="https://www.youtube.com/watch?v=Z7XiKx_rj2I" class="form-control youtubeurl">
								<iframe src="" style="width:100%;border:0;height:0"></iframe>
							</div>
						</div>		
					</div>

				</div>



			</div>
		</div>


	</div>

</form>
 <script>
     var cat_list  = <?=$post->id?>;
     var maxCount = 1;
 </script>
<?
require 'js.php';
else:
    
    echo '<div class="alert alert-danger">Something Went Wrong Try Again..</div>';
    
endif;

?>
