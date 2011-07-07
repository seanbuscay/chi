<?php
/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. You can add new regions for block content, modify
 *   or override Drupal's theme functions, intercept or make additional
 *   variables available to your theme, and create custom PHP logic. For more
 *   information, please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/theme-guide
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   The Drupal theme system uses special theme functions to generate HTML
 *   output automatically. Often we wish to customize this HTML output. To do
 *   this, we have to override the theme function. You have to first find the
 *   theme function that generates the output, and then "catch" it and modify it
 *   here. The easiest way to do it is to copy the original function in its
 *   entirety and paste it here, changing the prefix from theme_ to STARTERKIT_.
 *   For example:
 *
 *     original: theme_breadcrumb()
 *     theme override: STARTERKIT_breadcrumb()
 *
 *   where STARTERKIT is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_breadcrumb() function.
 *
 *   If you would like to override any of the theme functions used in Zen core,
 *   you should first look at how Zen core implements those functions:
 *     theme_breadcrumbs()      in zen/template.php
 *     theme_menu_item_link()   in zen/template.php
 *     theme_menu_local_tasks() in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called template suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node-forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and template suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440
 *   and http://drupal.org/node/190815#template-suggestions
 */


/**
 * Implementation of HOOK_theme().
 */
function chi_theme(&$existing, $type, $theme, $path) {
  $hooks = zen_theme($existing, $type, $theme, $path);
  
  // Add your theme hooks like this:
  /*
  $hooks['hook_name_here'] = array( // Details go here );
  */
  // @TODO: Needs detailed comments. Patches welcome!
  return $hooks;
}




/**
 * Preprocess variables for region.tpl.php
 *
 * Prepare the values passed to the theme_region function to be passed into a
 * pluggable template engine.
 *
 * @see region.tpl.php
 */
/* -- Delete this line if you want to use this function

function chi_preprocess_region(&$vars, $hook) {
//dpr ($vars);
//@todo because of a bug in zen preprocessing orders, this logic does't make it to the template
//so for now, it's all done in the page tpl
	
	// Create the $content variable that templates expect.
  $vars['content'] = $vars['elements']['#children'];
  $vars['region'] = $vars['elements']['#region'];

  // Setup the default classes.
  $vars['classes_array'] = array('region', 'region-' . str_replace('_', '-', $vars['region']));

  // Sidebar regions get a couple extra classes.
  if (strpos($vars['region'], 'sidebar_') === 0) {
    $vars['classes_array'][] = 'threecol';    
  }
  
  if (strpos($vars['region'], 'second') !== false) {
    $vars['classes_array'][] = 'last';    
  }
  
}
// */

/**
 * Override or insert variables into all templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered (name of the .tpl.php file.)
 */
/* -- Delete this line if you want to use this function
function chi_preprocess(&$vars, $hook) {
 // dpr ($vars);
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function chi_preprocess_page(&$vars, $hook) {
 //$vars['sample_variable'] = t('Lorem ipsum.');
//dpr($vars);
	_chi_column_classes (&$vars);

  // To remove a class from $classes_array, use array_diff().
  //$vars['classes_array'] = array_diff($vars['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function chi_preprocess_node(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // STARTERKIT_preprocess_node_page() or STARTERKIT_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $vars['node']->type;
  if (function_exists($function)) {
    $function($vars, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function chi_preprocess_comment(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function chi_preprocess_block(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

function _chi_column_classes (&$vars) {
  $vars['content_classes'] = array();
  $vars['sidebar_first_classes'] = array();
  $vars['sidebar_second_classes'] = array();

  $classes = implode(' ', $vars['classes_array']);
  //dpr ($vars['classes']);
	
  if (strpos($classes, 'no-sidebars') !== false) {
	$vars['content_classes'][] = 'twelvecol';    
  }
	
  if (strpos($classes, 'two-sidebars') !== false) {
	$vars['content_classes'][] = 'sixcol'; 
	$vars['content_classes'][] = 'centercol';    
	$vars['sidebar_first_classes'][] = 'threecol';
	$vars['sidebar_first_classes'][] = 'leftcol';
	$vars['sidebar_second_classes'][] = 'threecol';
	$vars['sidebar_second_classes'][] = 'rightcol';
	$vars['sidebar_second_classes'][] = 'last';
  }
  
 if (strpos($classes, 'one-sidebar') !== false) {
	$vars['content_classes'][] = 'ninecol';
	$vars['content_classes'][] = 'centercol';
 
	if (strpos($classes, 'sidebar-first') !== false) {	
	$vars['sidebar_first_classes'][] = 'leftcol';
	$vars['sidebar_first_classes'][] = 'threecol';
	$vars['sidebar_first_classes'][] = 'last';
	$vars['content_classes'][] = 'withleft';
    }
    
 	if (strpos($classes, 'sidebar-second') !== false) {	
	$vars['sidebar_second_classes'][] = 'threecol';
	$vars['sidebar_second_classes'][] = 'rightcol';
	$vars['sidebar_second_classes'][] = 'last';
	$vars['content_classes'][] = 'withright';
    }
 } 
    
  $vars['content_classes'] = implode(' ', $vars['content_classes']);
  $vars['sidebar_first_classes'] = implode(' ', $vars['sidebar_first_classes']);
  $vars['sidebar_second_classes'] = implode(' ', $vars['sidebar_second_classes']);
    
    
}
