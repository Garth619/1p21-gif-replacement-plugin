(function() {
    tinymce.PluginManager.add('mybutton', function( editor, url ) {
        editor.addButton( 'mybutton', {
            title: 'Insert MP4 (Gif Replacement)',
            // autofocus: true,
            image: url + '/1p21.png',
            onclick: function() {
                editor.windowManager.open( {
                    title: tinyMCE_object.button_title,
                    body: [
	                    	{
                            type   : 'container',
                            name   : 'container',
                            label  : 'Gif Replacement',
                            html   : 'Upload your MP4 below'
                        },

                        {
                            type: 'textbox',
                            name: 'myvideolink',
                            label: tinyMCE_object.image_title,
                            value: '',
                            classes: 'my_input_image',
                        },
                        {
                            type: 'button',
                            name: 'my_upload_button',
                            label: 'Upload',
                            text: tinyMCE_object.image_button_title,
                            classes: 'my_upload_button',
                        },
                        {
                            type: 'textbox',
                            name: 'mywidth',
                            label: 'Width in Pixels (NUMBERS ONLY no "px" in input fields). Leave blank for default.',
                            value: '',
                            classes: 'my_input_image_two',
                        },
                        {
                            type   : 'listbox',
                            name   : 'mylistbox',
                            label  : 'Video Alignment',
                            values : [
                                { text: 'No Alignment', value: 'gif_replace_noalignment' },
                                { text: 'Left', value: 'gif_replace_left' },
                                { text: 'Center', value: 'gif_replace_center' },
                                { text: 'Right', value: 'gif_replace_right' }
                            ],
                            value : 'gif_replace_noalignment' // Sets the default
                        }
                                              
                                                       
                    ],
                    onsubmit: function( e ) {
	                    

	                    
                        editor.insertContent( '[1p21video src="' + e.data.myvideolink + '" width="' + e.data.mywidth + '" id="' + e.data.mylistbox + '"]');
                    }
                });
            },
        });
    });
 
})();




jQuery(document).ready(function($){
    $(document).on('click', '.mce-my_upload_button', upload_image_tinymce);
 
    function upload_image_tinymce(e) {
        e.preventDefault();
        var $input_field = $('.mce-my_input_image');
        var custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Add Video',
            button: {
                text: 'Add Video'
            },
            multiple: false
        });
        custom_uploader.on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $input_field.val(attachment.url);
        });
        custom_uploader.open();
    }
});




