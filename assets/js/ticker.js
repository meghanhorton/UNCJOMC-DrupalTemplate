jQuery(document).ready(function(){
	var j = 0;
	var delay = 1000;
	function cycleThru(){
		var jmax = jQuery('.view-latest-news .view-content ul li').length - 1;
		jQuery(".view-latest-news .view-content ul li:eq("+j+")")
			.animate({"opacity" : "1"} ,400)
			.animate({"opacity" : "1"} ,delay)
			.animate({"opacity" : "0"} ,400, function(){
				(j == jmax) ? j=0 : j++;
				cycleThru();
			});
	};		
	cycleThru();
});
