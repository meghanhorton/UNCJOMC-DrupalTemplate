<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 */
?>

<!-- INCLUDE MENU HEADER -->
<?php include_once dirname(__FILE__) . '../../includes/menu.inc';?>
<?php drupal_add_css(drupal_get_path('theme','uncjomc').'/css/home.css');?>
<!-- MESSAGES -->
<?php print $messages; ?>

<!-- BREADCRUMBS -->
<?php if (!empty($breadcrumb)): print $breadcrumb; endif;?>

<!-- PAGE TITLE -->
<?php if (!empty($title)): ?>
<div class="titleblock">
  <div class="container">
    <div class="col-sm-8 col-sm-offset-4 col-md-9 col-md-offset-3">
      <div class="row">
        <?php print render($title_prefix); ?>
        <h1 class="page-title"><?php print $title; ?></h1>
        <?php print render($title_suffix); ?>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<div class="homepagebg">
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


  <!-- MAIN CONTENT -->
    <!-- BEGIN $page['slider']; -->
    <?php print render($page['slider']); ?>
    <!-- END $page['slider']; -->
  <div class="col-sm-12">
    <div class="row">
    <a id="main-content"></a>
      <!-- BEGIN $page['highlighted'];-->
      <?php print render($page['highlighted']); ?>
      <!-- END $page['highlighted'];-->
    </div>
    <div class="row">
    	<div class="container">
	<div class="col-sm-3"><?php print render($page['home-narrow-l']);?></div>
	<div class="col-sm-6"><?php print render($page['home-wide']);?></div>
	<div class="col-sm-3"><?php print render($page['home-narrow']);?></div>
    	</div>
     </div>
  </div>
</div>

<!-- INCLUDE FOOTER -->
<?php include_once dirname(__FILE__) . '../../includes/footer.inc';?>
<?php drupal_add_js("jQuery('.carousel').carousel()", array('type' => 'inline', 'scope' => 'footer', 'weight' => 300)); ?>
