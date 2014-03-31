jQuery(document).ready(
	function(){
	// SET MINIMUM HEIGHT TO SIDEBAR HEIGHT
		var height = jQuery('#sidebar_nav>.region>.block>.sidebar.nav').height();
		console.log(height);
		jQuery('.main-container').css('min-height',height+100);
	
	// SEARCHBAR, REMOVE CSE IMAGE
	jQuery('#edit-search-block-form--2').removeAttr('style');
	
	}
);
