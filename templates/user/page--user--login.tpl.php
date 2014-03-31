<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 */
?>

<!-- INCLUDE MENU HEADER -->
<?php include_once drupal_get_path('theme','uncjomc') . '/templates/includes/menu.inc';?>

<div class="titleblock">
  <div class="container">
    <div class="col-sm-8 col-sm-offset-4 col-md-9 col-md-offset-3">
      <div class="row">
        <!-- MESSAGES -->
        <?php print $messages; ?>

        <!-- BREADCRUMBS -->
        <?php if (!empty($breadcrumb)): print $breadcrumb; endif;?>

        <!-- PAGE TITLE -->
        <?php print render($title_prefix); ?>
        <?php if (!empty($title)): ?>
        <h1 class="page-title"><?php print $title; ?></h1>
        <?php endif; ?>
        <?php print render($title_suffix); ?>
      </div>
    </div>
  </div>
</div>


<div class="main-container container">
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
      <?php print render($page['content']); ?>
    </div>
  </div>
</div>

<!-- INCLUDE FOOTER -->
<?php include_once drupal_get_path('theme','uncjomc') . '/templates/includes/footer.inc';?>

