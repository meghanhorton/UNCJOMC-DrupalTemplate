jQuery(document).ready(function(){
  if(jQuery(window).width() > 768){
  var eHeight = jQuery('.region-highlighted').height();
  console.log(eHeight);

  jQuery('.region-highlighted').find('.content').outerHeight(eHeight+20);
  }
})
