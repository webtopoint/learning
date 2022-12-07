<?php
$get = $this->db->get_where('page_content',['id' => $content_id]);
if($get->num_rows()){
    
    $row = $get->row();
    $page = $this->db->where('id',$row->page_id)->get('pages')->row();
    $title = !empty($row->title) ? $row->title : $page->title ;
?>

<style>
    .card-title .title{
        font-weight:700;
        margin-left:10px;
        border-bottom:1px dotted white;
    }
</style>

<div class="content-wrapper">
        <section class="content">
          <div class="row">
              
            <?php
            echo form_open();    
            if($x = $this->session->flashdata('msg'))
                echo $x;
            ?>
              
                <div class="col-md-12">
                  <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">  Page Content  of   <strong class="title">  <?= $page->title?></strong></h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Enter Title</label>
                            <input type="text" class="form-control" value="<?=$title?>" name="title" placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                            <label>Enter Content</label>
                            <textarea class="form-control" id="aryaeditor1" name="content"><?=$row->content?></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </div>
                  </div>
                </div>
            
             <?php
            echo form_close();    
            ?>
            
            
          </div>
        </section>
    </div>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>            <script type="text/javascript">
                
                
               
                    var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    //powerpaste casechange tinydrive advcode mediaembed checklist
                    tinymce.init({
                        extended_valid_elements: 'i[class]',
                      selector: 'textarea#aryaeditor1',
                       images_upload_handler: function (blobInfo, success, failure) {
                        var xhr, formData;
                    
                        xhr = new XMLHttpRequest();
                        xhr.withCredentials = false;
                        xhr.open('POST', hostUrl+'/Admin/upload_editor_file');
                    
                        xhr.onload = function() {
                          var json;
                    
                          if (xhr.status != 200) {
                            failure('HTTP Error: ' + xhr.status);
                            return;
                          }
                    
                          json = JSON.parse(xhr.responseText);
                        console.log(json);
                          if (!json || typeof json.location != 'string') {
                            failure('Invalid JSON: ' + xhr.responseText);
                            return;
                          }
                       // alert(json.location);
                          success(json.location);
                        };
                    
                        formData = new FormData();
                        formData.append('file', blobInfo.blob(), blobInfo.filename());
                    
                        xhr.send(formData);
                      },
                      branding:false,
                      
                      plugins: ' importcss print preview   importcss  searchreplace autolink autosave save directionality  visualblocks visualchars fullscreen image link media  template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists  wordcount   imagetools textpattern noneditable help    charmap   quickbars  emoticons  ',
                      tinydrive_token_provider: 'URL_TO_YOUR_TOKEN_PROVIDER',
                      tinydrive_dropbox_app_key: 'YOUR_DROPBOX_APP_KEY',
                      tinydrive_google_drive_key: 'YOUR_GOOGLE_DRIVE_KEY',
                      tinydrive_google_drive_client_id: 'YOUR_GOOGLE_DRIVE_CLIENT_ID',
                      mobile: {
                        plugins: 'print preview   importcss  searchreplace autolink autosave save directionality  visualblocks visualchars fullscreen image link media  template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists  wordcount   textpattern noneditable help   charmap  quickbars  emoticons '
                      },
                      content_css : ["<?=implode('","',css_theme())?>"],
                      menu: {
                        tc: {
                          title: 'Comments',
                          items: 'addcomment showcomments deleteallconversations'
                        }
                      },
                      
                      style_formats: [
                            { title: 'Headers', items: [
                              { title: 'h1', block: 'h1' },
                              { title: 'h2', block: 'h2' },
                              { title: 'h3', block: 'h3' },
                              { title: 'h4', block: 'h4' },
                              { title: 'h5', block: 'h5' },
                              { title: 'h6', block: 'h6' }
                            ] },
                        
                            { title: 'Blocks', items: [
                              { title: 'p', block: 'p' },
                              { title: 'div', block: 'div' },
                              { title: 'pre', block: 'pre' }
                            ] },
                        
                            { title: 'Containers', items: [
                              { title: 'section', block: 'section', wrapper: true, merge_siblings: false },
                              { title: 'article', block: 'article', wrapper: true, merge_siblings: false },
                              { title: 'blockquote', block: 'blockquote', wrapper: true },
                              { title: 'hgroup', block: 'hgroup', wrapper: true },
                              { title: 'aside', block: 'aside', wrapper: true },
                              { title: 'figure', block: 'figure', wrapper: true }
                            ] }
                          ],
                     
                      visualblocks_default_state: true,
                      end_container_on_empty_block: true,
                      
                      menubar: 'edit view insert format tools table ', 
                      toolbar: 'undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify| fontselect fontsizeselect formatselect  | outdent indent |  numlist bullist checklist | forecolor backcolor casechange  formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media  template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
                      autosave_ask_before_unload: true,
                      autosave_interval: '30s',
                      autosave_prefix: '{path}{query}-{id}-',
                      autosave_restore_when_empty: false,
                      autosave_retention: '2m',
                      image_advtab: true,
                      
                      link_list: [
                        { title: 'My Link', value: 'https://cleanzcare.com' },
                      ],
                      image_list: [ 
                        { title: 'My page 1', value: 'https://www.tiny.cloud' },
                        { title: 'My page 2', value: 'http://www.moxiecode.com' }
                      ],
                      image_class_list: [
                        { title: 'None', value: '' },
                        { title: 'Some class', value: 'class-name' }
                      ],
                      importcss_append: true,
                      templates: [{
                                      title : 'About Us',
                                      description : 'About Us Description.',
                                      content : `<?=$this->load->view(DIR_THEMS.'/content/about_us')?>`
                                  },{
                                      title : 'Feature Section 1',
                                      description : 'Feature Section 1',
                                      content : `<?=$this->load->view(DIR_THEMS.'/content/feature-section-1')?>`
                                  },{
                                      title : 'terms-condition',
                                      description : 'terms-condition',
                                      content : `<?=$this->load->view(DIR_THEMS.'/content/terms-condition')?>`
                                  },
                                  {
                                      title : 'feature-section',
                                      description : 'feature-section',
                                      content : `<?=$this->load->view(DIR_THEMS.'/content/feature-section')?>`
                                  },
                                  {
                                      title : 'call-to-action-start',
                                      description : 'call-to-action-start',
                                      content : `<?=$this->load->view(DIR_THEMS.'/content/call-to-action-start')?>`
                                  }
                                  ,
                                  {
                                      title : 'Our Tools section',
                                      description : 'Our Tools section',
                                      content : `<?=$this->load->view(DIR_THEMS.'/content/Our Tools section')?>`
                                  }
                                  
                                  ]  ,
                                  //call-to-action-start
                      template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
                      template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
                      height: 600,
                      image_caption: true,
                      quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
                      noneditable_noneditable_class: 'mceNonEditable',
                      toolbar_mode: 'sliding',
                      spellchecker_ignore_list: ['Ephox', 'Moxiecode'],
                      tinycomments_mode: 'embedded',
                      contextmenu: 'link image imagetools table configurepermanentpen',
                      a11y_advanced_options: true,
                      skin: useDarkMode ? 'oxide-dark' : 'oxide',
                      /*
                      The following settings require more configuration than shown here.
                      For information on configuring the mentions plugin, see:
                      https://www.tiny.cloud/docs/plugins/premium/mentions/.
                      
                      mentions_selector: '.mymention',
                      mentions_fetch: mentions_fetch,
                      mentions_menu_hover: mentions_menu_hover,
                      mentions_menu_complete: mentions_menu_complete,
                      mentions_select: mentions_select,
                      mentions_item_type: 'profile'*/
                    });
            
            
               
               
                $("#keywords").tagsInput({
                   'height':'100px',
                   'width':'100%',
                   'interactive':true,
                   'defaultText':'Add',
                   'delimiter': [','],   // Or a string with a single delimiter. Ex: ';'
                   'removeWithBackspace' : true,
                   'placeholderColor' : '#666666'
                });
                 	
                </script>
<?php
}
else{
    echo '<div class="alert alert-danger">Page Not found for content..</div>';
}

?>