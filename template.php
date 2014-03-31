<?php

/**
 * @file
 * template.php
 */


/**
 * Overrides theme_preprocess_html()
 */

function uncjomc_preprocess_html(&$variables){
    // ADD FONT AWESOME
    drupal_add_css('http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css', array('type' => 'external'));
}

/**
 * Overrides theme_preprocess_page()
 */
  function uncjomc_preprocess_page(&$vars, $hook) {

    // IF THERE IS A REDIRECT URL, USE JAVASCRIPT TO OPEN A NEW WINDOW
    if( isset($vars['node']->field_redirect_url['und'][0]['url']) ){
      $url = '"'.$vars['node']->field_redirect_url['und'][0]['url'].'"';
      drupal_add_js('setTimeout(openURL,5000); function openURL(){window.open('.$url.')}',array('type' => 'inline', 'scope' => 'footer', 'weight' => 5));
    }



    if (isset($vars['node'])) {
    // If the node type is "blog" the template suggestion will be "page--blog.tpl.php".
     $vars['theme_hook_suggestions'][] = 'page__'. $vars['node']->type;
    }

    // PROCESS MAIN MENU TO BE EXPANDED

    // Add the rendered output to the $main_menu_expanded variable
    $main_menu_tree                           = menu_tree_all_data(  variable_get('menu_main_links_source', 'main-menu')  );
    $vars['primary_nav']                      = FALSE;
    $vars['primary_nav']                      = menu_tree_output($main_menu_tree);
    $vars['primary_nav']['#theme_wrappers']   = array('menu_tree__primary');
  
    if(arg(0) == "taxonomy" && arg(1) == "term") {
	if ( isset($vars['page']['content']['system_main']['term_heading']['term']['#term']->field_hide_show_list['und']) ):
	     if($vars['page']['content']['system_main']['term_heading']['term']['#term']->field_hide_show_list['und'][0]['value'] === 'hide' ):
		$vars['page']['content']['system_main']['nodes'] = null;
    		unset($vars['page']['content']['system_main']['pager']);
    	     endif;
	endif;
     }

  }

function uncjomc_preprocess_node(&$variables) {
  $node = $variables['node'];
  $variables['date'] = format_date($node->created, 'custom', 'M. j, Y');
  
  if ( $node->type == 'article' ) {
    $variables['display_submitted'] = TRUE;
    $variables['submitted'] = t('!datetime', array('!username' => $variables['name'], '!datetime' => $variables['date']));
    $variables['user_picture'] = theme_get_setting('toggle_node_user_picture') ? theme('user_picture', array('account' => $node)) : '';
  }
  else {
    $variables['display_submitted'] = FALSE;
    $variables['submitted'] = '';
    $variables['user_picture'] = '';
  }
  
  if($variables['view_mode'] == 'image_and_title'){
	$variables['theme_hook_suggestions'][] = 'node__image_and_title';
	$variables['display_submitted'] = FALSE;
    	$variables['submitted'] = '';  
  }
  elseif($variables['view_mode'] == 'slider'){
	$variables['theme_hook_suggestions'][] = 'node__slider';
	$variables['display_submitted'] = FALSE;
    	$variables['submitted'] = '';  
  }
}

function uncjomc_preprocess_block(&$variables){
	if($variables['block']->delta == 'front-page-stories'){
		$variables['classes_array'][] = 'col-sm-9';
	}
	elseif($variables['block']->delta == 'tweets-front_twitter'){
		$variables['classes_array'][] = 'col-sm-3';
	}
}

/**
 * Overrides theme_menu_link().
 */
function uncjomc_menu_link__main_menu(&$variables) {
   $element = $variables['element'];
   $sub_menu = '';

   if($element['#original_link']['depth'] == 1){
      $element['#attributes']['class'][] = 'top-level';

   }

  if ($element['#below']) {
    if ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] >= 1)) {
      unset($element['#below']['#theme_wrappers']);
      $sub_menu = '<ul class="submenu">' . drupal_render($element['#below']) . '</ul>';
    }
    }

    $output = l($element['#title'], $element['#href'], $element['#localized_options']);
    return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

function uncjomc_preprocess_field(&$vars, $hook){
	if($vars['element']['#field_name'] == 'field_column'){
		$vars['theme_hook_suggestions'][] = 'field__column_landing';
		$field_array = array('field_number_of_columns','field_background_color','field_css_class');
		rows_from_field_collection($vars,'field_column',$field_array);	
	} elseif($vars['element']['#field_name'] == 'field_row'){
		$vars['theme_hook_suggestions'][] = 'field__row_landing';
		$field_array = array('field_background_color','field_css_class');
		rows_from_field_collection($vars,'field_row',$field_array);
		
	}
}

/*
function uncjomc_file_link($variables){
  $file = $variables['file'];
  $icon_directory = $variables['icon_directory'];

  $url = file_create_url($file->uri);
  $icon = theme('file_icon', array('file' => $file, 'icon_directory' => $icon_directory));

  // Set options as per anchor format described at
  // http://microformats.org/wiki/file-format-examples
  $options = array(
    'attributes' => array(
      'type' => $file->filemime . '; length=' . $file->filesize,
    ),
  );

  // Use the description as the link text if available.
  if (empty($file->description)) {
    $link_text = $file->filename;
  }
  else {
    $link_text = $file->description;
    $options['attributes']['title'] = check_plain($file->filename);
  }

  return '<btn class="btn btn-primary btn-lg">' . $icon . ' ' . l($link_text, $url, $options) . '</button>';
}*/

/**
 * Bootstrap theme wrapper function for the secondary menu links.
 */
function uncjomc_menu_tree__main_menu(&$variables) {
  return '<ul class="sidebar nav">' . $variables['tree'] . '</ul>';
}

// FIELD COLLECTIONS

function rows_from_field_collection(&$vars, $field_name, $field_array) {
  $vars['rows'] = array();
  foreach($vars['element']['#items'] as $key => $item) {
    $entity_id = $item['value'];
    $entity = field_collection_item_load($entity_id);
    $wrapper = entity_metadata_wrapper('field_collection_item', $entity);
    $row = array();
    foreach($field_array as $field){
    $row[$field] = $wrapper->$field->value();
    }
    $vars['rows'][] = $row;
  }
}

function uncjomc_file_link($variables) {
  $file = $variables['file'];
  $icon_directory = $variables['icon_directory'];

  $url = file_create_url($file->uri);
  $icon = theme('file_icon', array('file' => $file, 'icon_directory' => $icon_directory));

  // Set options as per anchor format described at
  // http://microformats.org/wiki/file-format-examples
  $options = array(
    'attributes' => array(
      'type' => $file->filemime . '; length=' . $file->filesize,
    ),
  );

  // Use the description as the link text if available.
  if (empty($file->description)) {
    $link_text = $file->filename;
  }
  else {
    $link_text = $file->description;
    $options['attributes']['title'] = check_plain($file->filename);
  }
  if ( $file->filemime == 'application/pdf' ){
  return '<button class="btn btn-lg btn-download">Download ' . l($link_text, $url, $options) . '</button>';
  }
}

// TEMPLATE
bootstrap_include('uncjomc', 'functions/alter.inc');
