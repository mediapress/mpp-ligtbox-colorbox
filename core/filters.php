<?php
//plain as it seems, It
function mpp_inject_colorbox( $atts ) {
	
	$media = $atts['media'];
	
	if ( ! $media ) {
		return $atts;
	}

	$atts['data-mpp-large-src'] = mpp_get_media_src('', $media );
	
	return $atts;
}

add_filter( 'mpp_media_html_attributes_pre', 'mpp_inject_colorbox' );