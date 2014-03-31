<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 */
?>

<!-- INCLUDE MENU HEADER -->
<?php include_once drupal_get_path('theme','uncjomc') . '/templates/includes/menu.inc';?>
<?php drupal_add_css(path_to_theme() . '/css/specialization.css', array('group'=> CSS_THEME));

?>
<?php
if( isset($node->nid) ){
        $use = node_load($node->nid);
        $image = field_get_items('node',$use,'field_featured_image');
        if( isset($image[0]['uri']) ){
                $bg_url = file_create_url($image[0]['uri']);
                $bg_url = 'style="background-image: url(\''.$bg_url.'\');"';
        }
}
elseif( arg(0) == 'taxonomy' && arg(1) == 'term' ){
        $term = taxonomy_term_load( arg(2) );
        $bg_url = $term->field_featured_image;
        if( isset( $bg_url['und'][0]['uri'] ) ){
                $bg_url = file_create_url( $bg_url['und'][0]['uri'] );
                $bg_url = 'style="background-image: url(\''.$bg_url.'\');"';}
        else{ unset($bg_url); }
}

?>

<div class="titleblock" <?php if(isset($bg_url)){ echo $bg_url;}?>>  
  <div class="container">
    <div class="col-sm-8 col-sm-offset-4 col-md-9 col-md-offset-3">
      <div class="row">
        <!-- MESSAGES -->
        <?php print $messages; ?>

        <!-- BREADCRUMBS -->
        <?php if (!empty($breadcrumb)): print $breadcrumb; endif;?>
      </div>
    </div>
  </div>
</div>


<div class="main-container">
<div class="container">
  <!-- TOP ROW, DISPLAY ONLY IF TABS AND LINKS EXIST -->
  <?php if(!empty($tabs) || !empty($action_links)):?>
  <div class="col-xs-12">
    <div class="row">
      <?php 
      if (!empty($tabs)): 
        print render($tabs);
      endif;

      if (!empty($action_links)): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul><?php 
      endif; ?>
    </div>
  </div>
  <?php endif;?>

  <!-- SIDEBAR COLUMN -->
  <nav class="navbar sidebar-nav col-sm-4 col-md-3">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#sidebar_nav">
      <i class="glyphicon glyphicon-chevron-down"></i>
    </button>
    <div class="collapse navbar-collapse" id="sidebar_nav">
    <?php print render($page['sidebar_first']); ?>
    </div>
  </nav>

  <!-- MAIN CONTENT -->
  <div class="col-sm-8 col-md-9">
    <div class="row">
    <a id="main-content"></a>
        <!-- PAGE TITLE -->
        <?php print render($title_prefix); ?>
        <?php if (!empty($title)): ?>
        <h1 class="page-title"><?php print $title; ?></h1>
        <?php endif; ?>
        <?php print render($title_suffix); ?>
    	
	<?php print render($page['content']); ?>
    </div>
  </div>
</div>
</div>

<!-- INCLUDE FOOTER -->
<?php include_once drupal_get_path('theme','uncjomc') . '/templates/includes/footer.inc';?>

<?php 
drupal_add_js('
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
','inline');


 ?>
