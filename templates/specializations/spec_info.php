<?php
// LOAD ALL DRUPAL FUNCTIONS
/* SET LOCATION OF DRUPAL'S MAIN DIRECTORY */
$drupal_dir = "../../../../../../";

/* CHANGE THE MAIN DIRECTORY TO THE CURRENT DIRECTORY */
chdir($drupal_dir);

/* DEFINE DRUPAL_ROOT, SO THE FUNCTIONS WILL WORK */
define("DRUPAL_ROOT", getcwd());

/* INCLUDE THE DRUPAL BOOTSTRAP */
require_once 'includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

// GET PASSED VARIABLES FROM AJAX
$nid = $_REQUEST['nid'];
$page = $_REQUEST['page'];

// DO YO THANG

echo views_embed_view('specialization_information','specialization_applicable_courses',$nid,$page);

?>
