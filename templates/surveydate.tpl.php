<?php
   drupal_add_library('system', 'ui.datepicker');
   drupal_add_js('https://maps.google.com/maps/api/js?v=3.exp&sensor=false&libraries=places');
   drupal_add_js(drupal_get_path('theme', 'survey') . '/js/MultiDatesPicker/jquery-ui.multidatespicker.js');
   drupal_add_js(drupal_get_path('theme', 'survey') . '/js/surveydate.js');
?>

<h3>輸入聚會主題</h3>
<?php print render($form['title']); ?>

<h3>選擇聚會日期區間</h3>
<div id="selectdate"></div>
<?php print render($form['submit']); ?>
<?php print drupal_render_children($form); ?>

