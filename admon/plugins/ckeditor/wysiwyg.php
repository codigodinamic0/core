<?php
//tipos de barrade herramienta
$url = "http://".$_SERVER['HTTP_HOST']."/admon/";
$createToolbar="";
switch($toolbar){
    case "basic":
        $createToolbar="[
                        { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
                        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']},
                        { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                        { name: 'insert', items: [ 'Image'] },
                        { name: 'styles', items: [ 'Styles', 'Format'] }
                       ]";
        break;
    case "standar":
        $createToolbar="[
                        { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
                        { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField']},
                        '/',
                        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']},
                        {name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']},
                        { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                        { name: 'insert', items: [ 'Image','Table', 'HorizontalRule', 'SpecialChar' ] },
                        { name: 'styles', items: [ 'Styles', 'Format'] }
                       ]";
        break;
    case "full":
        $createToolbar="[
                        { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-','NewPage', 'Preview', 'Print', '-', 'Templates']},	
                        { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
                        { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']},
                        { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField']},
                        '/',
                        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']},
                        {name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']},
                        { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                        { name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
                        { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                        { name: 'tools', items: ['ShowBlocks']},
                        ]";
        break;
    
}
?>

<script>
                	CKEDITOR.replace( '<?php echo $textarea?>', {
					contentsCss: '<?php echo $url;?>plugins/ckeditor/outputxhtml.css',
                                        toolbar: <?php echo $createToolbar?>,
                                        filebrowserBrowseUrl:"simogeo/index.html",
                                        font_names: 'Comic Sans MS/FontComic;Courier New/FontCourier;Times New Roman/FontTimes'
                                            +'Arial/Arial, Helvetica, sans-serif;' +
				            'Comic Sans MS/Comic Sans MS, cursive;' +
				            'Courier New/Courier New, Courier, monospace;' +
				            'Georgia/Georgia, serif;' +
				            'Lucida Sans Unicode/Lucida Sans Unicode, Lucida Grande, sans-serif;' +
				            'Tahoma/Tahoma, Geneva, sans-serif;' +
				            'Times New Roman/Times New Roman, Times, serif;' +
				            'Trebuchet MS/Trebuchet MS, Helvetica, sans-serif;' +
				            'Calibri/Calibri, Verdana, Geneva, sans-serif;' +
				            'Verdana/Verdana, Geneva, sans-serif',
                                	stylesSet: [
						{ name: 'Strong Emphasis', element: 'strong' },
						{ name: 'Emphasis', element: 'em' },

						{ name: 'Computer Code', element: 'code' },
						{ name: 'Keyboard Phrase', element: 'kbd' },
						{ name: 'Sample Text', element: 'samp' },
						{ name: 'Variable', element: 'var' },

						{ name: 'Deleted Text', element: 'del' },
						{ name: 'Inserted Text', element: 'ins' },

						{ name: 'Cited Work', element: 'cite' },
						{ name: 'Inline Quotation', element: 'q' }
					]
				});

</script>