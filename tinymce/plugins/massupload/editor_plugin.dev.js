(function() {
	tinymce.create('tinymce.plugins.WizzMassUploadPlugin', {
		init : function(ed, url) {
			ed.addCommand('mceDownloadInsert', function() {
				ed.execCommand('mceInsertContent', 0, insertDownload('visual', ''));
			});
			ed.addButton('massupload',  { 
            title : 'Mass Upload', 
            image : '../wp-content/plugins/image-mass-upload-wizz/tinymce/plugins/massupload/img/download.gif', 
            onclick : function() {  
                tinyMCE.activeEditor.windowManager.open({
                    url : '../wp-content/plugins/image-mass-upload-wizz/uploadify/uploadify.php',
                    title : 'Popup Window',
                    inline : 'yes',
                    width :510,
                    height : 450                
                });
            } 
        }); 
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('massupload', n.nodeName == 'IMG');
			});
		},

		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname : 'Mass Upload Wizz',
				author : 'Moiceanu Marius',
				authorurl : 'marius81@gmail.com',
				infourl : 'http://www.wpwizz.com',
				version : "1.00"
			};
		}
	});
	tinymce.PluginManager.add('massupload', tinymce.plugins.WizzMassUploadPlugin);
})();