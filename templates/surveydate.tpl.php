<?php
drupal_add_library('system', 'ui.datepicker');

drupal_add_js('http://maps.googleapis.com/maps/api/js?key=AIzaSyDeEOpZjMXl2yzxcYS-UbHaSO6PdnBblVE&sensor=false&libraries=places', 'external');
drupal_add_js(drupal_get_path('theme', 'survey') . '/js/MultiDatesPicker/jquery-ui.multidatespicker.js');
drupal_add_js(drupal_get_path('theme', 'survey') . '/js/BootstrapTimepicker/bootstrap-timepicker.min.js');
drupal_add_js(drupal_get_path('theme', 'survey') . '/js/surveydate.js');
drupal_add_js(drupal_get_path('theme', 'survey') . '/js/zclip/jquery.zclip.js');

//  drupal_add_css(drupal_get_path('theme', 'survey') . '/css/bootstrap-timepicker.min.css', array('group' => CSS_THEME, 'type' => 'file'));
?>

<div id="survey-body">
  <div id="first-step" class="show">
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
              <?php print render($form['title']); ?>
            </div>
          </div>
          <div class="col-md-6 form-group">
            <div class="input-group">
              <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
              <?php print render($form['name']); ?>
            </div>
          </div>
          <div class="col-md-6 form-group">
            <div class="input-group">
              <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
              <?php print render($form['email']); ?>
            </div>
          </div>
          <div class="col-md-6 form-group">
            <label>聚會細節</label>
            <?php print render($form['description']); ?>
          </div>
          <div class="col-md-6 form-group">
            <label for="exampleInputName2">聚會日期</label>
            <div id="selectdate" class=""></div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="second-step" class="hidden">
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
  <div id="third-step" class="hidden">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="btn-group pull-right">
          <a href="#" id="3rd-Prev" type="button" class="btn btn-success">Prev</a>
          <?php print render($form['submit']); ?>
        </div>
        <h4>3.聚會地點</h4>
      </div>
      <div class="panel-body">
        <div class="col-md-12 form-group">
          <div class="input-group">
            <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></div>
            <?php print render($form['location']); ?>
          </div>
          <div id="surveymap" class="col-md-12 form-group"></div>
        </div>
      </div>
    </div>

  </div>
</div>
<div id="survey-end">
  <div class="jumbotron">
    <div class="alert alert-danger" role="alert">恭喜你 你已完成問卷!</div>
    <form class="form-horizontal">
      <div class="form-group">
        <label class="col-xs-2 control-label">問卷網址</label>
        <div class="col-xs-8">
          <input type="text" class="form-control" id="survey_url" value="<?php print $form['survey_path']['#value'] ?>" data-toggle="tooltip" data-placement="bottom" title="請複製網址">
        </div>
      </div>
    </form>
  </div>
</div>

<?php print render($form['date']); ?>

<div class="hidden">
  <?php print drupal_render_children($form); ?>
</div>
