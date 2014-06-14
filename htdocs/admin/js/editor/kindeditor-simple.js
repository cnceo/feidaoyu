KindEditor.ready(function(K) {
     editor = K.create('textarea[class="mceEditor"]', {
        cssPath : 'js/editor/plugins/code/prettify.css',
        uploadJson : '../ajax/xupload_json.php',
        fileManagerJson : '../ajax/xfile_manager_json.php',
        allowFileManager : true,
        filterMode : false,
        afterCreate : function() {
         this.sync();
        },
        afterBlur:function(){
            this.sync();
        },
        items : [
     			'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
     			'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
     			'insertunorderedlist', '|', 'emoticons', 'image', 'link']
    });
 });
