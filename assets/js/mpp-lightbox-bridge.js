jQuery( document ).ready( function(){
	
	var jq = jQuery;
	
	//enable on single gallery page
	
	if( jq.fn.colorbox != undefined ) {
			jq( ".mpp-single-gallery-media-list .mpp-item-thumbnail").colorbox({ rel:'galler', href: function () {
					var url = jq(this).data('mpp-large-src');//.attr('src');

					return url;
			}}) ;
	}
});