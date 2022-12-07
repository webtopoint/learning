<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<textarea id="aryaeditor"></textarea>
<script type="text/javascript">
                document.domain = '<?=FRESH_DOMAIN?>';
                
               
                    var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    //powerpaste casechange tinydrive advcode mediaembed checklist
                    tinymce.init({
                      selector: 'textarea#aryaeditor',
                      menubar: false,
                      plugins: 'link',
                      toolbar: 'link'
                    });
</script>
                     