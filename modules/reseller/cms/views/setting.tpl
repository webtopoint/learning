<div class="row row-sm">
    <div class="col-md-4">
    <?php
    echo form_open_multipart(current_url().'/logo','',['type' => 'logo']);
    ?>
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white"> Title & Logo</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Enter Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Title.">
                </div>
                <div class="imageWrapper">
                    <img class="image" src="http://via.placeholder.com/700x500">
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="file-upload btn btn-primary">            
                    <input type="file" name="logo" required class="file-input">Choose File
                </button>

                <button class="btn btn-success pull-right mt-3">
                    <i class="fa fa-save"></i> Save
                </button>
            </div>
        </div>
    <?php
    echo form_close();
    ?>
    </div>
</div>

<style>
.imageWrapper{
    width: 100%;
    height:200px;
}
.imageWrapper img{
    width:100%;
    height: 100%;
}

.file-upload {
  position: relative;
  overflow: hidden;
  margin: 10px; }

.file-upload {
  position: relative;
  overflow: hidden;
  margin: 10px;
  width:100%;
  max-width:150px;
  text-align:center;
  padding: .85em 1em;
  display:inline;
  -ms-transition: all 0.2s ease;
  -webkit-transition: all 0.2s ease;
  transition: all 0.2s ease;
}


.file-upload input.file-input {
  position: absolute;
  top: 0;
  right: 0;
  margin: 0;
  padding: 0;
  font-size: 20px;
  cursor: pointer;
  opacity: 0;
  filter: alpha(opacity=0);
  height:100%;
  z-index:99999999
}
</style>
<script>
 $('.file-input').change(function(){
    var file = this.files[0];
    if (file){
        let reader = new FileReader();
        reader.onload = function(event){
            $('.image').attr('src', event.target.result);
        }
        reader.readAsDataURL(file);
    }
});
</script>