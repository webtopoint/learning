<?
require_once 'header.php';

    $form = $this->FormModel->getFormModel(array('id'=>AJ_DECODE($form_id),'admin_id'=>CLIENT_ID));
    $form = $form->row();
    
    $html = '';
              
    foreach (json_decode($form->fields) as $value)
        $html.=$value;
?>
<style>
        .menu-btn {
            border-radius: 48px;
            border: 0.5px solid lightgrey;
            font-size: 0.9em;
            padding: 2px 10px;
            background-color: white;
        }
        .menu {
            padding-top: 10px;
            z-index: 200;
            margin-top: 4px;
            background-color: white;
            position: absolute;
        }
        #overlay {
            position: absolute;
            top: 0px;
            left: 0px;
            width: 100%;
            height: 100%;
            z-index: 99999999999;
        }
    </style>

<div class="row">
  
  <form class="col-md-12" method="POST" action="">
      
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-justified">
                    <li class="nav-item"><a  href="<?=base_url.'/Admin/form-setting/'.$form_id.'/sms/'?>" class="nav-link show <?=$type=='sms' ? 'active' : '' ?>"><i class="fa fa-comment"></i> SMS</a></li>
                    <li class="nav-item"><a  href="<?=base_url.'/Admin/form-setting/'.$form_id.'/email/'?>" class="nav-link show <?=$type=='email' ? 'active' : '' ?>"><i class="fa fa-envelope"></i> EMAIL</a></li>
                    <li class="nav-item"><a  href="<?=base_url.'/Admin/form-setting/'.$form_id.'/setting/'?>" class="nav-link show <?=$type=='setting' ? 'active' : '' ?>"><i class="fa fa-cog"></i> Setting</a></li>
                </ul>
            </div>
            <div class="card-body" style="min-height:350px">
                <div class="tab-content">
                    
                    <div class="tab-pane show active" role="tabpanel">
                        <div class="row">
                            <?php
                            // echo VIEWPATH;
                            if(_view_exists('admin','sms/'.$type))
                                include  __DIR__.'/sms/'.$type.'.php';
                            else
                                echo '<center><b class="text-danger">Page Not Found.</b></center>';
                            ?>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            
            <div class="card-footer">
                
                <div class="col-md-12 form-group">
                    <button class="btn btn-success">
                        <i class="fa fa-plus"></i> Add
                    </button>
                    <a class="btn btn-primary view-design-js" href="javascript:void(0)" data-href="<?=base_url.'/Admin/form-setting/'.$form_id.'/Preview-and-design/'?>"><i class="fa fa-eye"></i> Preview & Edit Design</a>
                </div>
                
            </div>
        </div>
        
        
  </form>
            <?
                            if(_view_exists(VIEWPATH.'admin','sms/list-'.$type))
                                include __DIR__.'/sms/list-'.$type.'.php';
                            ?>
</div>

<script type="text/javascript">



  $('.view-design-js').click(function(){
      let url = $(this).data('href');
      $.dialog({
          title : 'Form Design',
          icon : 'fa fa-eye',
          content: 'url:'+url,
          columnClass : 'col-md-12',
      });

  });













    $('.Forms').addClass('mm-active');

    $('.add_new_form').addClass('mm-active');

   CKEDITOR.plugins.add( 'tokens',
    {   
   requires : ['richcombo'], 
   init : function( editor )
   {
      var config = editor.config,
         lang = editor.lang.format;

      var tags = []; //new Array();
      <?
      $i = 0;
      if(isset($labels)):
      foreach ($labels as $key => $value){
          ?>
          tags[<?=$i++?>] = ["[<?=$value?>]", "<?=ucwords($value)?>","<?=ucwords($value)?>"];
          <?
      }
      endif;
      ?>

      editor.ui.addRichCombo( 'tokens',
         {
            label : "Your Form Fields",
            title :"Your Form Fields",
            voiceLabel : "Your Form Fields",
            className : 'cke_format',
            multiSelect : false,

            panel :
            {
               css : [ config.contentsCss, CKEDITOR.getUrl( CKEDITOR.skin.getPath('editor') + 'editor.css' ) ],
               voiceLabel : lang.panelVoiceLabel
            },

            init : function()
            {
               this.startGroup( "Form Fields" );
               for (var this_tag in tags){
                  this.add(tags[this_tag][0], tags[this_tag][1], tags[this_tag][2]);
               }
            },

            onClick : function( value )
            {         
               editor.focus();
               editor.fire( 'saveSnapshot' );
               editor.insertHtml(value);
               editor.fire( 'saveSnapshot' );
            }
         });
   }
});
    
    
    CKEDITOR.replace( 'content',{
      toolbar :
      [
         ['tokens','Styles', 'Format', 'Bold', 'Italic'],['Undo','Redo']
      ],
      extraPlugins: 'tokens'
   }   
);
    
    $('.activeOrNot').change(function(){
        let id = $(this).closest('tr').data('id'),
            data = this.checked;
            alert('Working area..');
    });
var Upload = function (file) {
    this.file = file;
};

Upload.prototype.getType = function() {
    return this.file.type;
};
Upload.prototype.getSize = function() {
    return this.file.size;
};
Upload.prototype.getName = function() {
    return this.file.name;
};
Upload.prototype.get = function () {
    var that = this;
    /*var formData = new FormData();*/
    return this;
    /*
    // add assoc key values, this will be posts values
    formData.append("file", this.file, this.getName());
    formData.append("upload_file", true);*/

};


  $(document).on('change keyup ','.inputClass',function(){


      //$( '#iframe' ).attr( 'src', function ( i, val ) { return val; });
      $('.break-loader').slideDown(600);
      var form = new FormData();
      let that = this;
      let   type        =   $(this).closest('.item').data('type'),
            name        =   $(this).attr('name'),
            value       =   (this.value),
            inputType   =   $(this).attr('type'),
            form_id     =   $('#form_id').val();
        
        
        if(name == 'box-shadow'){
            let first = $(that).closest('.widget-content').find('#box-shadow-input-1').val(),
                second = $(that).closest('.widget-content').find('#box-shadow-input-2').val()
                third = $(that).closest('.widget-content').find('#box-shadow-input-3').val(),
                forth = $(that).closest('.widget-content').find('#box-shadow-input-4').val(),
                fivth = $(that).closest('.widget-content').find('#box-shadow-input-5').val(),
                sixth = $(that).closest('.widget-content').find('#box-shadow-input-6').val();
            inputType = 'text';
            value = ( (first) ? first : 0 )+'px '+( (second) ? second : 0 )+'px '+( (third) ? third : 0 )+'px '+( (forth) ? forth : 0 )+'px '+( (fivth) ? fivth : 'black' )+' '+( (sixth) ? sixth : '' );
      
        }
        
        
        form.append('type',type);
        form.append('name',name);
        form.append('value',value);
        form.append('inputType',inputType);
        form.append('form_id',form_id);
        form.append('var','form-setting-css');
        if(inputType == 'file'){
            
            let file = $(this)[0].files[0];
            var upload = new Upload(file);
            
            var data = upload.get();
            
            //   formData.append("file", this.file, this.getName());
      
                form.append('file',data.file, data.getName());
            console.log(data);
        }
        console.log(form);
      $.ajax({
                type: 'POST',
                url  : '<?=base_url?>/Admin/AJAX',
                data : form,
                cache: false,
                async: true,
                contentType: false,
                processData: false,
                timeout: 60000,
                dataType :'json',
                success : function(res){
                  console.log(res);
                  $( '#iframe' ).attr( 'src', function ( i, val ) { return val; });
                  $('.break-loader').slideUp(600);
                },
                error: function(a,b,c){
                  $('.break-loader').slideUp(600);
                  console.log(a.responseText);
                }

      });

/*
      var iframeID = document.getElementById("iframe"); 
        
      $(iframeID).focus(); 
      $(iframeID).contents().find("#form-"+form_id).find('input')[0].focus();
      $(iframeID).contents().find("#form-"+form_id).css('background-color',color).focus(); */
      //setTimeout(function(){focusForm()},3000);

  });
  function focusForm(){

    var iframeID = document.getElementById("iframe"),
        form_id = $('#form_id').val();; 
        
      $(iframeID).focus(); 
      //$(iframeID).contents().find("#form-"+form_id).find('input')[0].focus(); 
      // $(iframeID).contents().find("#form-"+form_id).css('background-color',color).focus();
  }




function setBubble(range, bubble) {
  const val = range.value;
  const min = range.min ? range.min : 0;
  const max = range.max ? range.max : 100;
  const newVal = Number(((val - min) * 100) / (max - min));
  bubble.innerHTML = val;

  bubble.style.left = `calc(${newVal}% + (${8 - newVal * 0.15}px))`;
}


</script>
<?

require_once 'footer.php';

?>