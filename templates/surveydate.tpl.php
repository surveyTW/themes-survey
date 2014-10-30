<?php

   drupal_add_library('system', 'ui.datepicker');
   drupal_add_js('https://maps.google.com/maps/api/js?v=3.exp&sensor=false&libraries=places');
   drupal_add_js(drupal_get_path('theme', 'survey') . '/js/MultiDatesPicker/jquery-ui.multidatespicker.js'); 
   drupal_add_js(drupal_get_path('theme', 'survey') . '/js/BootstrapTimepicker/bootstrap-timepicker.min.js');    
   drupal_add_js(drupal_get_path('theme', 'survey') . '/js/surveydate.js');
   
   drupal_add_css(drupal_get_path('theme', 'survey') . '/css/bootstrap-timepicker.min.css', array('group' => CSS_THEME, 'type' => 'file'));   

?>

<div id="first-step" class="show">
<?php print render($form['title']); ?>
<?php print render($form['description']); ?>
<h3>選擇聚會日期區間</h3>
<div class="row">
   <div id="selectdate" class="col-md-6"></div>
</div>
<span id="1st-Next" type="button" class="btn btn-primary">Next</span>
</div>
<div id="second-step" class="hidden">
<div class="row">
   <div id="selecttime" class="col-md-6"></div>
</div>
<button id="2nd-Prev" type="button" class="btn btn-primary">Prev</button>
<button id="2nd-Next" type="button" class="btn btn-primary">Next</button>
</div>
<div id="third-step" class="hidden">
<?php print render($form['location']); ?>
<div id="surveymap" class="col-md-12"></div>
<button id="3rd-Prev" type="button" class="btn btn-primary">Prev</button>
<button id="3rd-Next" type="button" class="btn btn-primary">Next</button>
</div>

<div id="forth-step" class="hidden">
<?php print render($form['name']); ?>
<?php print render($form['email']); ?>
<button id="4th-Prev" type="button" class="btn btn-primary">Prev</button>
<?php print render($form['submit']); ?>
</div>

<?php print render($form['date']); ?>

<?php print drupal_render_children($form); ?>
