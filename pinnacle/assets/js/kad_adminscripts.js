jQuery(document).ready(function($) {

	$('#post-formats-select input').change(checkFormat);
	function checkFormat(){
  		var format = $('#post-formats-select input:checked').attr('value');
		
		if(typeof format != 'undefined'){
			
				if(format == 'gallery'){
					$('#gallery_post_metabox').stop(true,true).fadeIn(500);
				}
				else {
					$('#gallery_post_metabox').stop(true,true).fadeOut(500);
				}
				if(format == '0'){
					$('#standard_post_metabox').stop(true,true).fadeIn(500);
				}
				else {
					$('#standard_post_metabox').stop(true,true).fadeOut(500);
				}
				if(format == 'image'){
					$('#image_post_metabox').stop(true,true).fadeIn(500);
				}
				else {
					$('#image_post_metabox').stop(true,true).fadeOut(500);
				}
				if(format == 'video'){
					$('#video_post_metabox').stop(true,true).fadeIn(500);
				}
				else {
					$('#video_post_metabox').stop(true,true).fadeOut(500);
				}
				
			}
		}
	$(window).on( 'load', function(){
		checkFormat();
	})
});