/* GET INITIAL TAB */
function get_initial_tab(){
        var tab = jQuery("span.tab").first().attr("tab");
        jQuery("span.tab").first().addClass("active");
        return(tab);
}

/* SET AJAX FUNCTION */
function path(tab){
        jQuery.ajax({
                type: "POST",
                url:"'.drupal_get_path('theme','uncjomc').'/templates/specializations/spec_info.php?nid='.$node->nid.'&page="+tab,
                success: function(result){
                        jQuery("#spec_info").html(result);
                }
        });
}

/* ON LOAD, SET INITIAL TAB AND DISPLAY */
jQuery(document).ready(
        function(){
                var tab = get_initial_tab();
                path(tab);
        }
);

/* WHEN TAB IS CLICKED, CHANGE AJAX */
jQuery(document).ready(function(){
        jQuery("span.tab").click(
        function(){
                var tab = jQuery(this).attr("tab");
                jQuery("span.tab").removeClass("active");
                jQuery(this).addClass("active");
                path(tab);      
        })
});
