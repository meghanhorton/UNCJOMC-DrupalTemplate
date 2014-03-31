<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 */
?>

<!-- INCLUDE MENU HEADER -->
<?php include_once dirname(__FILE__) . '/../includes/menu.inc';?>

<!-- INCLUDE EDIT TABS & ACTION LINKS -->
<?php if (!empty($tabs)): ?>
  <?php print render($tabs); ?>
<?php endif; ?>
<?php if (!empty($action_links)): ?>
  <ul class="action-links"><?php print render($action_links); ?></ul>
<?php endif; ?>

<!-- GET TO MAIN CONTENT -->
<?php 

// GET NODE INFORMATION: NID, LOAD IT, GET EVENT TYPE
  $nid = arg(1); $node = node_load($nid); $event_type = $node->field_event_type['und'][0]['value'];

// COMPLEX EVENT
if($event_type == 'complex'):
  print views_embed_view('main_events_page','detailed', arg(1) );

// BASIC EVENT
else:
  echo '<div class="titleblock"><div class="container">';

  // DISPLAY BREADCRUMBS
  if (!empty($breadcrumb)): print $breadcrumb; endif;

  // DISPLAY TITLE
  print render($title_prefix);
  if (!empty($title)):
  echo '<h1 class="page-title">'. $title . '</h1>';
  endif;
  print render($title_suffix);

  echo '</div></div>';

  // DISPLAY VIEW
  print views_embed_view('main_events_page','basic', arg(1) );
endif;


?>

<!-- INCLUDE MENU HEADER -->
<?php include_once dirname(__FILE__) . '/../includes/footer.inc';?>

