<style type="text/css">
	
</style>

<form class="create-add-post" method="POST" enctype="multipart/form-data">
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
					<input type="text" name="title" class="form-control" placeholder="Enter Title">
				</div>
				<div class="form-group">
					<label>Content</label>
					<textarea class="textarea" name="content" id="aryaeditor"></textarea>
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
							<label style="padding-right: 19px"><input type="radio" name="media" class="media-select" checked value="image"> Image</label>
							<label style="padding-right: 19px"><input type="radio" name="media" class="media-select" value="youtube"> Youtube Link</label>					
						</div>			
						<div class="form-group media-div image-div">
							<div id="coba" class="row row-sm"></div>
						</div>	
						<div class="youtube-div media-div" style="display: none"> 
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
   	var cat_list = 0;
   	var maxCount= 1;
</script>
<?
require 'js.php';
?>
