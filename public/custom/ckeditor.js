 
 var  editor =  CKEDITOR.replace('aryaeditor', {
      height: 400,contentsCss : 'body{background:url(/path/to/image.gif);}',
      baseFloatZIndex: 10005,
    });
CKEDITOR.editorConfig = function(config){
    CKEDITOR.config.font_names = 'Hindi/kruti_dev_070regular;' + config.font_names;
    config.extraPlugins = 'ckawesome';
}

editor.ui.addButton('SuperButton', { 
    label: "Manage Files",
    command: 'mySimpleCommand',
    toolbar: 'insert',
    icon: 'https://avatars1.githubusercontent.com/u/200?v=10&s=40'
});
editor.addCommand("mySimpleCommand", { 
    exec: function(edt) {
        manage_gallery();
    }
});
