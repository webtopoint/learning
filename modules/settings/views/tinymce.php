<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<!--<script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/5/tinymce.min.js"></script>-->
<script type="text/javascript">
              <?php
if(@$_SERVER['HTTP_HOST'] != 'localhost'){
  ?>
    document.domain = '<?=FRESH_DOMAIN?>';
  <?php
}


$templates = isset($custom_templates) ? $custom_templates : $this->ThemeModel->get_theme_templates();

?>
                
                
                    function myFileBrowser (field_name, url, type, win) {

                        var cmsURL = window.location.pathname;     // your URL could look like "/scripts/my_file_browser.php"
                        var searchString = window.location.search; // possible parameters
                        if (searchString.length < 1) {
                            // add "?" to the URL to include parameters (in other words: create a search string because there wasn't one before)
                            searchString = "?";
                        }

                        // newer writing style of the TinyMCE developers for tinyMCE.openWindow

                        tinyMCE.openWindow({
                            file : cmsURL + searchString + "&type=" + type, // PHP session ID is now included if there is one at all
                            title : "File Browser",
                            width : 420,  // Your dimensions may differ - toy around with them!
                            height : 400,
                            close_previous : "no"
                        }, {
                            window : win,
                            input : field_name,
                            resizable : "yes",
                            inline : "yes",  // This parameter only has an effect if you use the inlinepopups plugin!
                            editor_id : tinyMCE.selectedInstance.editorId
                        });
                        return false;
                      }
  
                    var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    //powerpaste casechange tinydrive advcode mediaembed checklist
                    tinymce.init({
                        
                      extended_valid_elements: 'i[class],thewidget[id|class]',
                      element_format : 'html',
                      file_browser_callback : 'myFileBrowser',
                      selector: 'textarea#aryaeditor,textarea.aryaeditor',
                       images_upload_handler: function (blobInfo, success, failure) {
                        var xhr, formData;
                    
                        xhr = new XMLHttpRequest();
                        xhr.withCredentials = false;
                        xhr.open('POST', '<?=site_url('Admin/upload_editor_file')?>');
                    
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
                      plugins: 'noneditable tinydrive importcss print preview   importcss  searchreplace autolink autosave save directionality  visualblocks visualchars fullscreen image link media  template codesample table charmap hr pagebreak nonbreaking anchor insertdatetime advlist lists  wordcount  textpattern noneditable help    charmap   quickbars  emoticons  ',
                    //   tinydrive_token_provider: 'URL_TO_YOUR_TOKEN_PROVIDER',
                    //   tinydrive_dropbox_app_key: 'YOUR_DROPBOX_APP_KEY',
                    //   tinydrive_google_drive_key: 'YOUR_GOOGLE_DRIVE_KEY',
                    //   tinydrive_google_drive_client_id: 'YOUR_GOOGLE_DRIVE_CLIENT_ID',
                      mobile: {
                        plugins: 'noneditable print preview   importcss  searchreplace autolink autosave save directionality  visualblocks visualchars fullscreen image link media  template codesample table charmap hr pagebreak nonbreaking anchor insertdatetime advlist lists  wordcount   textpattern noneditable help   charmap  quickbars  emoticons '
                      },
                      content_css : [<?=getContentCss()?>],
                      menu: {
                        custom : {
                            title : 'Theme Features',
                            items : 'ThemeFeatures'
                        },
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
                     
                      visualblocks_default_state: <?=isset($_GET['visualblocks']) ? 'true' : 'false'?>,
                      end_container_on_empty_block: true,
                      
                      menubar: 'edit view insert format tools table ', 
                      toolbar1: 'undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify| fontselect fontsizeselect formatselect  | outdent indent |  numlist bullist checklist | pagebreak | charmap emoticons | fullscreen  preview save print ',
                      toolbar2 : ' forecolor backcolor casechange  formatpainter removeformat | insertfile image media  template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment  | ThemeFeatures ',
                      autosave_ask_before_unload: true,
                      autosave_interval: '30s',
                      autosave_prefix: '{path}{query}-{id}-',
                      autosave_restore_when_empty: false,
                      autosave_retention: '2m',
                      image_advtab: true,
                    //   document_base_url : "https://test.bizknowindia.org.in/public/temp/1670/",
                      link_list: <?=Modules :: run('assets/all_pages_links')?>,
                      image_list: <?=Modules :: run('assets/all_files')?>,
                      image_class_list: [
                        { title: 'None', value: '' },
                        { title: 'Mobile View Image', value: 'mobile-img' }
                      ],
                      importcss_append: true,
                      templates: <?=$templates?>  ,
                      template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
                      template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
                      height: 600,
                      image_caption: true,
                      quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
                      noneditable_noneditable_class: 'mceNonEditable',
                      toolbar_mode: 'sliding',
                      spellchecker_ignore_list: ['Ephox', 'Moxiecode'],
                      tinycomments_mode: 'embedded',
                      contextmenu: 'link image table configurepermanentpen',
                      a11y_advanced_options: true,
                      skin: useDarkMode ? 'oxide-dark' : 'oxide',
                      
                      noneditable_noneditable_class : 'is-locked',
                      <?php
                      $content_css = 'thewidget{background:yellow;}thewidget:after{color:red;content:"  Widget";font-size:9px}';
                      if(isset($content_style)){
                          $content_css .= $content_style;
                      }
                      
                          echo "content_style:'$content_css',";
                      ?>
                      
                      init_instance_callback: function (editor) {
                        editor.on('click', function (e) {
                            var node = e.target.nodeName.toLowerCase();
                            // console.log(node);
                            if(node  == 'thewidget'){
                                console.log(this);
                                var that = this;
                                $.confirm({
                                    title : 'Remove Widget',
                                    icon : 'fa fa-times',
                                    type :'red',
                                    content : 'Are you sure for remove this widget form editor.',
                                    buttons : {
                                        ok : {
                                            text : 'OK',
                                            btnClass :'btn-success',
                                            action:function(){
                                                var a = editor.selection.getNode();
                                                var txt = editor.selection.getContent();
                                                var newT = document.createTextNode(txt);
                                                a.parentNode.replaceChild(newT, a);
                                            }
                                        },
                                        cancel:function(){}
                                    }
                                });
                            }
                        });
                      },
                      
                      setup: function (editor) {
                        /* Menu items are recreated when the menu is closed and opened, so we need
                           a variable to store the toggle menu item state. */
                        var toggleState = false;
                    
                        /* example, adding a toolbar menu button */
                        editor.ui.registry.addMenuButton('ThemeFeatures', {
                          text: 'Theme Features',
                          icon : 'wordpress',
                          fetch: function (callback) {
                            var items = [
                              {
                                type: 'menuitem',
                                text: 'Menu item 1',
                                onAction: function () {
                                  editor.insertContent('<thewidget id="thewidget">You clicked menu item 1!</thewidget>');
                                }
                              },
                              {
                                type: 'nestedmenuitem',
                                text: 'All Widgets',
                                icon: 'user',
                                getSubmenuItems: function () {
                                  return [<?=Modules :: run('settings/all_widgtes')?>];
                                }
                              }
                              /*,
                              {
                                type: 'togglemenuitem',
                                text: 'Toggle menu item',
                                onAction: function () {
                                  toggleState = !toggleState;
                                  editor.insertContent('&nbsp;<em>You toggled a menuitem ' + (toggleState ? 'on' : 'off') + '</em>');
                                },
                                onSetup: function (api) {
                                  api.setActive(toggleState);
                                  return function() {};
                                }
                              }
                              */
                            ];
                            callback(items);
                          }
                        });
                    
                      },
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
                   
</script>