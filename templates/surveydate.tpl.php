<?php

  drupal_add_library('system', 'ui.datepicker');
  drupal_add_js('https://maps.google.com/maps/api/js?v=3.exp&sensor=false&libraries=places');
  drupal_add_js(drupal_get_path('theme', 'survey') . '/js/MultiDatesPicker/jquery-ui.multidatespicker.js');
  drupal_add_js(drupal_get_path('theme', 'survey') . '/js/BootstrapTimepicker/bootstrap-timepicker.min.js');
  drupal_add_js(drupal_get_path('theme', 'survey') . '/js/surveydate.js');
  drupal_add_js(drupal_get_path('theme', 'survey') . '/js/zclip/jquery.zclip.js');

//  drupal_add_css(drupal_get_path('theme', 'survey') . '/css/bootstrap-timepicker.min.css', array('group' => CSS_THEME, 'type' => 'file'));
?>

<div id="survey-body">
  <div id="first-step" class="show">
	<div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    <a href="#" type="button" class="btn btn-success" id="1st-Next">Next</a>
                </div>
                <h4>1.建立聚會基本資料</h4>
            </div>
            <div class="panel-body">
                <form>
                    <div class="col-md-12 form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-bookmark"></span></div>
                            <input type="text" class="form-control" id="edit-title" name="title" placeholder="聚會主題">
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                            <input type="text" class="form-control" id="edit-name" name="name" placeholder="<?php print $form['name']['#value']?>">
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                            <input type="email" class="form-control" id="edit-email" name="email" placeholder="<?php print $form['email']['#value']?>">
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>聚會細節</label>
                        <textarea class="form-control form-textarea" id="edit-description" name="description" cols="60" rows="5"></textarea>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="exampleInputName2">聚會日期</label>
			<div id="selectdate" class=""></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
  <div id="second-step" class="hidden">
	<div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    <a href="#" type="button" id="2nd-Prev" class="btn btn-success">Prev</a>
                    <a href="#" type="button" id="2nd-Next" class="btn btn-success">Next</a>
                </div>
                <h4>2.聚會時間</h4>
            </div>
            <div class="panel-body">
                <button type="button" class="btn btn-warning" id="add-timeslots">
                    <span class="glyphicon glyphicon-plus"></span>新增時間</button>
                <button type="button" class="btn btn-warning" id="copy-from-first-row">
                    <span class="glyphicon glyphicon-file"></span>複製時間</button>
    		<div class="row form-group">
       			<div id="selecttime" class="col-md-6"></div>
    		</div>
            </div>
        </div>
    </div>
  </div>
  <div id="third-step" class="hidden">
    <?php print render($form['location']); ?>
    <div id="surveymap" class="col-md-12 form-group"></div>
    <button id="3rd-Prev" type="button" class="btn btn-primary">Prev</button>
    <?php print render($form['submit']); ?>
  </div>
</div>
<div id="survey-end">
  <p>恭喜你 你已完成一個問卷!</p>
  <p>我們將會在有人填過問卷後 寄送E-mail到你的信箱</p>
  <p>你也可以到你的帳號下 找到曾經發過的問卷喔!!</p>
  <a id="text-to-copy" href="<?php print $form['survey_path']['#value']?>"><?php print $form['survey_path']['#value']?></a>
  <button id="copytext" type="button" class="btn btn-primary">一鍵複製網址</button>
</div>

<?php print render($form['date']); ?>

<div class="hidden">
	<?php print drupal_render_children($form); ?>
</div>
