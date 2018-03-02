<?php
/***
 * Automatically rezise a thumbnail and insert as post attachment
 * developed by kiaonline - dialogo.digital
 */
if(!function_exists("auto_image_size")){
	function auto_image_size($post_id = null, $name = "post-thumbnail", $width = 100,$height = 100,$crop = true){

		$width 	= ($width)? $width : get_option('thumbnail_size_w');
		$height = ($height)? $height : get_option('thumbnail_size_h');


		if($post_id == null){
			global $post;
			$post_id = $post->ID;
		}
		
		//get post thumbnail, get sizes and check if the image size exist
		$post_thumbnail_id 	= get_post_thumbnail_id( $post_id );
		//check meta for sent thumbnail
		$image_meta 		= get_post_meta( $post_thumbnail_id, '_wp_attachment_metadata', true );
		if(!$image_meta) return false;
		$sizes 				= array_keys($image_meta['sizes']);
		
		//if sizes exists return imagem url
		if(in_array($name,$sizes)){
			return wp_get_attachment_image_url( $post_thumbnail_id, $name);
		}
		
		$fullsizepath = get_attached_file( $post_thumbnail_id);
		
		if ( ! function_exists( 'wp_crop_image' ) ) {
			include( ABSPATH . 'wp-admin/includes/image.php' );
		}
		
		add_image_size( $name, $width, $height, $crop );

		$metadata = wp_generate_attachment_metadata( $post_thumbnail_id, $fullsizepath );
		wp_update_attachment_metadata( $post_thumbnail_id, $metadata );
		return wp_get_attachment_image_url( $post_thumbnail_id, $name);
	}
}