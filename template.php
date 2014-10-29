<?php

/**
 * @file
 * template.php
 */


function survey_theme() {
    $items = array();
    
    $items['surveydate_form'] = array(
        'render element' => 'form',
        'template' => 'surveydate',
        'path' => drupal_get_path('theme', 'survey') . '/templates',
    );

    return $items;

}