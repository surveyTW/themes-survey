<?php

   drupal_add_library('system', 'ui.datepicker');
   drupal_add_js('https://maps.google.com/maps/api/js?v=3.exp&sensor=false&libraries=places');
   drupal_add_js(drupal_get_path('theme', 'survey') . '/js/MultiDatesPicker/jquery-ui.multidatespicker.js'); 
   drupal_add_js(drupal_get_path('theme', 'survey') . '/js/BootstrapTimepicker/bootstrap-timepicker.min.js');    
   drupal_add_js(drupal_get_path('theme', 'survey') . '/js/surveydate.js');
   
   drupal_add_css(drupal_get_path('theme', 'survey') . '/css/bootstrap-timepicker.min.css', array('group' => CSS_THEME, 'type' => 'file'));   

?>

<?php print render($form['title']); ?>
<?php print render($form['description']); ?>
<?php print render($form['name']); ?>
<?php print render($form['email']); ?>
<?php print render($form['location']); ?>
<div id="surveymap" class="col-md-12"></div>

<h3>選擇聚會日期區間</h3>
<div class="row">
   <div id="selectdate" class="col-md-6"></div>
   <div id="selecttime" class="col-md-6"></div>
</div>
<?php print render($form['date']); ?>
<?php print render($form['submit']); ?>

<?php print drupal_render_children($form); ?>