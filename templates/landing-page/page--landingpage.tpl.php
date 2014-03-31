<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 */
?>

<!-- INCLUDE MENU HEADER -->
<?php include_once drupal_get_path('theme','uncjomc') . '/templates/includes/menu.inc';?>
<?php drupal_add_css(drupal_get_path('theme','uncjomc').'/css/landing.css');?>
<!-- MESSAGES -->
<?php print $messages; ?>



  <!-- TOP ROW, DISPLAY ONLY IF TABS AND LINKS EXIST -->
  <?php if(!empty($tabs) || !empty($action_links)):?>
      <?php 
      if (!empty($tabs)): 
        print render($tabs);
      endif;

      if (!empty($action_links)): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul><?php 
      endif; ?>
  <?php endif;?>
  <!-- MAIN CONTENT -->
    <a id="main-content"></a>
    <div id="topbanner" 
    style="background-image: url('<?php echo file_create_url($node->field_featured_image['und'][0]['uri']); ?>')">
	<div class="container">
	<!-- PAGE TITLE -->
	<?php print render($title_prefix); ?>
	<?php if (!empty($title)): ?>
	<h1 class="page-title"><?php print $title; ?></h1>
	<?php endif; ?>
	<?php print render($title_suffix); ?>
    	</div>
    </div>

      <?php print render($page['content']); ?>

<!-- INCLUDE FOOTER -->
<?php include_once drupal_get_path('theme','uncjomc'). '/templates/includes/footer.inc';?>

