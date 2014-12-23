<?php

   drupal_add_library('system', 'ui.datepicker');
   drupal_add_js('https://maps.google.com/maps/api/js?v=3.exp&sensor=false&libraries=places');
   drupal_add_js(drupal_get_path('theme', 'survey') . '/js/MultiDatesPicker/jquery-ui.multidatespicker.js');
   drupal_add_js(drupal_get_path('theme', 'survey') . '/js/BootstrapTimepicker/bootstrap-timepicker.min.js');
   drupal_add_js(drupal_get_path('theme', 'survey') . '/js/surveydate.js');

   drupal_add_css(drupal_get_path('theme', 'survey') . '/css/bootstrap-timepicker.min.css', array('group' => CSS_THEME, 'type' => 'file'));

?>

<div id="survey-body">
<div id="first-step" class="show">
<?php print render($form['title']); ?>
<?php print render($form['description']); ?>
<h3>選擇聚會日期(可複選)</h3>
   <div id="selectdate" class="form-group"></div>
<span id="1st-Next" type="button" class="btn btn-primary">Next</span>
</div>
<div id="second-step" class="hidden">
<h3>指定聚會時間(可直接跳過)</h3>
<div class="form-group">
<button id="add-timeslots" type="button" class="btn btn-primary">增加一欄時間</button>
<button id="copy-from-first-row" type="button" class="btn btn-primary">從第一列複製時間</button>
</div>
<div class="row form-group">
   <div id="selecttime" class="col-md-6"></div>
</div>
<button id="2nd-Prev" type="button" class="btn btn-primary">Prev</button>
<button id="2nd-Next" type="button" class="btn btn-primary">Next</button>
</div>
<div id="third-step" class="hidden">
<?php print render($form['location']); ?>
<div id="surveymap" class="col-md-12 form-group"></div>
<button id="3rd-Prev" type="button" class="btn btn-primary">Prev</button>
<button id="3rd-Next" type="button" class="btn btn-primary">Next</button>
</div>

<div id="forth-step" class="hidden">
<?php print render($form['name']); ?>
<?php print render($form['email']); ?>
<button id="4th-Prev" type="button" class="btn btn-primary">Prev</button>
<?php print render($form['submit']); ?>
</div>
</div>
<div id="survey-end">
<p>恭喜你 你已完成一個問卷! </p>
<p>網址是<a href="<?php print $form['survey_path']['#value']?>"><?php print $form['survey_path']['#value']?></a></p>
<p>趕快發送出去吧!</p>
<p>我們將會在有人填過問卷後 寄送E-mail到你的信箱</p>
<p>你也可以到你的帳號下 找到曾經發過的問卷喔!!</p>
</div>

<?php print render($form['date']); ?>

<?php print drupal_render_children($form); ?>
