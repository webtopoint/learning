<div class="row">
    <div class="container">
        <?
        foreach($result_view as $k):
        ?>
        <input type="hidden" class="top-img" value="<?=$k['top_image']?>">
        <input type="hidden" class="back-img" value="<?=$k['back_image']?>">
        <input type="hidden" class="bottom-img" value="<?=$k['bottom_image']?>">
        <?
        endforeach;
        ?>
       
      <?
      echo form_open('',array(
            'enctype' => 'multipart/form-data',
            'method'    => 'POST'
          ));
      ?>
        <div class=" card main-card">
            <div class="card-header">Result Setting</div>
            <div class="card-body row">
               <style>
                   .buttons{
                       top:50%;
                       left:40%;
                       position:absolute;
                   }
               </style>
               <div class="col-md-12 top-image" id="top_image" style="height:250px;border:2px dotted gray">
                   <div class="buttons">
                       <div class="d-flex justify-content-center">
                          <label for="select_input" class="btn btn-success btn-file btn-rounded float-left">
                            <span>Choose file</span>
                            <input type="file" class="btn-file" id="select_input" name="top_img" onchange="previewFile(this,'top_image')" style="z-index:-1;position:absolute">
                          </label>
                          <label class="btn btn-danger top_image remove-image"  data-id="top_image" style="display:none;margin-left:10px">
                              <smal><i class="fa fa-remove"></i> Remove</smal>
                          </label>
                        </div>
                   </div>
               </div>
               <div class="col-md-12" id="back_image" style="height:450px;border:2px dotted gray">
                   <div class="buttons">
                       <div class="d-flex justify-content-center">
                          <label for="select_input1" class="btn btn-success btn-file btn-rounded float-left">
                            <span>Choose file</span>
                            <input type="file" class="btn-file" id="select_input1" name="back_img" onchange="previewFile(this,'back_image')" style="z-index:-1;position:absolute">
                          </label>
                          <label class="btn btn-danger back_image remove-image"  data-id="back_image" style="display:none;margin-left:10px">
                              <smal><i class="fa fa-remove"></i> Remove</smal>
                          </label>
                        </div>
                   </div>
               </div>
               
               <div class="col-md-12" id="bottom_image" style="height:250px;border:2px dotted gray">
                   
                   <div class="buttons">
                       <div class="d-flex justify-content-center">
                          <label for="select_input2" class="btn btn-success btn-file btn-rounded float-left">
                            <span>Choose file</span>
                            <input type="file" class="btn-file" id="select_input2" name="bottom_img" onchange="previewFile(this,'bottom_image')" style="z-index:-1;position:absolute">
                          </label>
                          <label class="btn btn-danger bottom_image remove-image" data-id="bottom_image" style="display:none;margin-left:10px">
                              <smal><i class="fa fa-remove"></i> Remove</smal>
                          </label>
                        </div>
                   </div>
                   
               </div>
               
            </div>
            
            <div class="card-footer">
                <button class="btn btn-success">
                    Save
                </button>
            </div>
        </div>
        <?
      echo form_close();
      ?>
        
    </div>
</div>
 <script>
            let topImg = $('.top-img').val(),
                backImg = $('.back-img').val(),
                bottomImg = $('.bottom-img').val(),
                ImgUrl = base_url+'/public/temp/<?=CLIENT_ID?>';
                
                if(topImg!='')
                    $('#top_image').css({"background":'url('+ImgUrl+'/'+topImg+')','background-size':'100% 100%','background-repeat':'no-repeat'}).append('<input type="hidden" name="top_image" value="1">').find('.remove-image').show();
                if(backImg!='')
                    $('#back_image').css({"background":'url('+ImgUrl+'/'+backImg+')','background-size':'100% 100%','background-repeat':'no-repeat'}).append('<input type="hidden" name="back_image" value="1">').find('.remove-image').show();
                if(bottomImg!='')
                    $('#bottom_image').css({"background":'url('+ImgUrl+'/'+bottomImg+')','background-size':'100% 100%','background-repeat':'no-repeat'}).append('<input type="hidden" name="bottom_image" value="1">').find('.remove-image').show();
              


    $('.remove-image').click(function(){
        var styleObject = $('#'+$(this).data('id')).prop('style'); 
            styleObject.removeProperty('background');
        $(this).hide();
        $('#'+$(this).data('id')).find('input').val('').clone(true);
        $('input[name='+$(this).data('id')+']').remove();
    });
    function previewFile(input,div){
        var file = $(input).get(0).files[0];

        if(file){
            var reader = new FileReader();
            console.log(reader);
            reader.onload = function(){
                $('#'+div).css({"background":'url('+reader.result+')','background-size':'100% 100%','background-repeat':'no-repeat'}).append('<input type="hidden" name="'+div+'" value="1">');
                $('.'+div).show();
            }
            reader.readAsDataURL(file);
        }
    }
</script>
