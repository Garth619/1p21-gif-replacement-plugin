<?php
/*
Plugin Name: 1P21 Gif Replacement
Plugin URI:  http://www.1point21interactive.com
Description: Allows use of muted MP4s on latest OS instead of animated Gifs. After activating the plugin, go to a post or page and look for the 1p21 icon.
Version:     1.0
Author:      Garrett Cullen
Author URI:  http://www.1point21interactive.com
*/ 



if ( ! function_exists( 'mytheme_theme_setup' ) ) {


function gifreplacement($atts, $content = null) {
	extract(shortcode_atts(array(
		"src" => '',
		"width" => '',
		"id" => ''
	), $atts));
	return '<video id="'.$id.'" class="gif_replacement_video" src="'.$src.'" width="'.$width.'" autoplay loop muted playsinline autobuffer></video>';
}

}


add_shortcode('1p21video', 'gifreplacement');



if ( ! function_exists( 'mytheme_theme_setup' ) ) {
    function mytheme_theme_setup() {
 
        add_action( 'init', 'mytheme_buttons' );
 
    }
}
 


add_action( 'after_setup_theme', 'mytheme_theme_setup' );




if ( ! function_exists( 'mytheme_buttons' ) ) {
    function mytheme_buttons() {
        if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
            return;
        }
 
        if ( get_user_option( 'rich_editing' ) !== 'true' ) {
            return;
        }
 
        add_filter( 'mce_external_plugins', 'mytheme_add_buttons' );
        add_filter( 'mce_buttons', 'mytheme_register_buttons' );
    }
}
 


if ( ! function_exists( 'mytheme_add_buttons' ) ) {
    function mytheme_add_buttons( $plugin_array ) {
        $plugin_array['mybutton'] = plugin_dir_url( __FILE__ ) . '/tinymce_buttons.js';
        return $plugin_array;
    }
}
 


if ( ! function_exists( 'mytheme_register_buttons' ) ) {
    function mytheme_register_buttons( $buttons ) {
        array_push( $buttons, 'mybutton' );
        return $buttons;
    }
}
 


if ( !function_exists( 'mytheme_tinymce_extra_vars' ) ) {
	function mytheme_tinymce_extra_vars() { ?>
		
		<script type="text/javascript">
			
			var tinyMCE_object = <?php echo json_encode(
				array(
					'button_name' => esc_html__('1p21 Gif Replacement', 'mythemeslug'),
					'button_title' => esc_html__('1Point21 Gif Replacement', 'mythemeslug'),
					'image_title' => esc_html__('MP4 Video File URL', 'mythemeslug'),
					'image_button_title' => esc_html__('Upload or Select MP4 From Media Library', 'mythemeslug'),
				)
				);
			?>;
			
		</script><?php
	
	}
}


add_action ( 'after_wp_tiny_mce', 'mytheme_tinymce_extra_vars' );



if ( ! function_exists( 'gif_replacement_css' ) ) {

	function gif_replacement_css()

	{
 		
 		echo "<style>#gif_replace_left{float:left;margin-right:30px}#gif_replace_center{display:block;margin-left:auto;margin-right:auto}#gif_replace_right{float:right;margin-left:30px}#gif_replace_noalignment,#gif_replace_left,#gif_replace_center,#gif_replace_right{margin-bottom:10px;max-width:100%;height:auto}@media screen and (max-width: 1000px){#gif_replace_left,#gif_replace_center,#gif_replace_right{margin-bottom:10px;max-width:100%;height:auto;float:none;margin-left:auto;margin-right:auto;display:block}}</style>";

}


add_action('wp_head', 'gif_replacement_css', 100);


}
 

