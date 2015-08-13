<?php

/**
 * @file
 * template.php
 */

function survey_preprocess_page(&$vars) {
      $alias_parts = explode('/', drupal_get_path_alias());

      if (count($alias_parts) && $alias_parts[0] == 'front2') {
          $vars['theme_hook_suggestions'][] = 'page__front2';
      }
}

/**
 * Implements hook_theme().
 * krammer pull test
 */
function survey_theme(&$existing, $type, $theme, $path) {
  $hook_theme = array(
    'surveydate_form' => array(
      'render element' => 'form',
      'template' => 'surveydate',
      'path' => drupal_get_path('theme', 'survey') . '/templates',
    ),
    'user_login' => array(
      'render element' => 'form',
      'path' => drupal_get_path('theme', 'survey') . '/templates',
      'template' => 'user-login',
    ),
    // Defines the form ID as a theme hook.
    'contactus_form' => array(
      // Specifies 'form' as a render element.
      'render element' => 'form',
      'template' => 'user-contactus',
      'path' => drupal_get_path('theme', 'survey') . '/templates',
    ),
    'history_form' => array(
      // Specifies 'form' as a render element.
      'render element' => 'form',
      'template' => 'history',
      'path' => drupal_get_path('theme', 'survey') . '/templates',
    ),
  );

  return $hook_theme;
}

/*
function survey_user_login_block($variables) {
  $form = $variables['form'];

  $items = array();
  if (variable_get('user_register', USER_REGISTER_VISITORS_ADMINISTRATIVE_APPROVAL)) {
    $items[] = l(t('Create new account'), 'user/register', array('attributes' => array('title' => t('Create a new user account.'))));
  }
  $items[] = l(t('Request new password'), 'user/password', array('attributes' => array('title' => t('Request new password via e-mail.'))));
  $items[] = l(t('Login with Facebook'), 'user/simple-fb-connect', array('attributes' => array('title' => t('Login with Facebook.'))));
  $form['links'] = array('#markup' => theme('item_list', array('items' => $items)));

  return drupal_render_children($form);
}
 */
