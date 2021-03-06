﻿<?php
global $base_url;

drupal_add_library('system', 'ui.datepicker');

drupal_add_js('https://maps.googleapis.com/maps/api/js?key=AIzaSyDeEOpZjMXl2yzxcYS-UbHaSO6PdnBblVE&sensor=false&libraries=places', 'external');
drupal_add_js('http://media.line.me/js/line-button.js?v=20140411');
drupal_add_js(drupal_get_path('theme', 'survey') . '/js/MultiDatesPicker/jquery-ui.multidatespicker.js');
//drupal_add_js(drupal_get_path('theme', 'survey') . '/js/MultiDatesPicker/js/jquery.ui.datepicker.js');
drupal_add_js(drupal_get_path('theme', 'survey') . '/js/MultiDatesPicker/js/jquery.ui.datepicker-zh-TW.js');
//drupal_add_js(drupal_get_path('theme', 'survey') . '/js/BootstrapTimepicker/bootstrap-timepicker.min.js');
drupal_add_js(drupal_get_path('theme', 'survey') . '/js/bootstrap-clockpicker.min.js');
drupal_add_js(drupal_get_path('theme', 'survey') . '/js/surveydate.js');
drupal_add_css(drupal_get_path('theme', 'survey') . '/css/bootstrap-clockpicker.min.css', array('group' => CSS_THEME, 'type' => 'file'));

//  drupal_add_css(drupal_get_path('theme', 'survey') . '/css/bootstrap-timepicker.min.css', array('group' => CSS_THEME, 'type' => 'file'));
?>


<div id="survey-date" class="container">
  <div id="survey-body">
    <div id="first-step" class="show">
      <h1 class="text-left">
        <img src="sites/all/themes/survey/img/surveydate.png" alt="建立聚會">&nbsp;&nbsp;聚會資料
      </h1>
      <form>
        <div id="alert" class="alert alert-danger" role="alert"></div>
        <div class="col-md-4 form-group">
          <label for="meet-title">
            <span class="glyphicon glyphicon-bookmark"></span>&nbsp;聚會名稱
          </label>
          <?php print render($form['title']); ?>
        </div>
        <div class="col-md-6 form-group">
          <label for="meet-detail">
            <span class="glyphicon glyphicon-list"></span>&nbsp;備註
          </label>
          <?php print render($form['description']); ?>
        </div>
        <div class="col-md-4 form-group">
          <label for="meet-chairman">
            <span class="glyphicon glyphicon-user"></span>&nbsp;主辦者
          </label>
          <?php print render($form['name']); ?>
        </div>
        <div class="col-md-6 form-group">
          <label for="meet-email">
            <span class="glyphicon glyphicon-envelope"></span>&nbsp;聯絡信箱
          </label>
          <?php print render($form['email']); ?>
        </div>
        <div class="col-md-4 form-group">
          <label for="meet-calendar">
            <span class="glyphicon glyphicon-calendar"></span>日期<span style="color:#B5B5B5;">  [可複選]</span>
          </label>
          <div id="selectdate"></div>
        </div>
        <div class="col-md-6 form-group">
          <label for="meet-time">
            <span class="glyphicon glyphicon-time"></span>&nbsp;時間
          </label>
          <div id="selecttime"></div>
        </div>
        <div class="col-md-12 btn-group ">
          <a href="#" type="button" id="first-Next" class="btn pull-right"></a>
        </div>
      </form>
    </div>
    <div id="second-step" class="hidden">
      <div class="row">
        <div class="col-md-9">
          <div class="form-horizontal">
            <div class="col-md-12 form-group">
              <label for="meet-location" class="col-md-2">
                <span class="glyphicon glyphicon-map-marker"></span>&nbsp;地點
              </label>
              <?php print render($form['location']); ?>
              <div id="surveymap" class="col-md-12 form-group" style="margin-left:0.9em;"></div>
            </div>
          </div>
          <div class="col-md-12 btn-group ">
            <?php print render($form['submit']); ?>
            <a href="#" type="button" id="second-Prev" class="btn pull-right"></a>
          </div>          
        </div>
        <div class="col-md-3">
          <script async="" src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
          <!-- 160x600, 已建立 2010/9/30 -->
          <ins class="adsbygoogle"
               style="display:inline-block;width:160px;height:600px"
               data-ad-client="ca-pub-4355428491296720"
               data-ad-slot="5821892280"></ins>
          <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
          </script>
        </div>
      </div>
    </div>
  </div> 
  <div id="survey-end">
    <div class="container">
	<div class="jumbotron text-center">
      	<h3>問卷製作完成!</h3>
      	<p>
        分享問卷網址 <a id="text-to-copy" href="
          <?php print $form['shorturl']['#value'] ?>" data-toggle="tooltip" data-placement="bottom" title="請複製網址"><?php print $form['shorturl']['#value'] ?>
        </a>
      </p>
      <div class="btn-group"> 
         <a class="btn btn-default" href="https://www.facebook.com/sharer/sharer.php?app_id=<?php print variable_get('simple_fb_connect_appid', 0); ?>&sdk=joey&u=<?php print $form['shorturl']['#value']; ?>&display=popup&ref=plugin&src=share_button" target="_blank"><i class="fa fa-facebook fa-lg fb"></i></a>
         <a class="btn btn-default" href="http://line.naver.jp/R/msg/text/?<?php print $form['shorturl']['#value']; ?>"><img src="http://img1.cna.com.tw/www/images/linebutton_32x32.png" width="18" height="18" alt="LINE分享給好友" title="LINE分享給好友"></a>
      </div>     
    </div>
   </div>	  
 </div>
</div>

<?php print render($form['date']); ?>

<div class="hidden">
  <?php print drupal_render_children($form); ?>
</div>
