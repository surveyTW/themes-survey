<?php
drupal_add_css(drupal_get_path('theme', 'survey') . '/css/font-awesome.min.css', array('group' => CSS_THEME, 'type' => 'file'));
?>
<div class="col-xs-12 col-md-6 col-md-offset-3">
<div class="container-fluid">
<?php 
global $base_url;
global $domain;
print render($form['name']);
print render($form['pass']);
?>
<div class="form-group">
	<a href="<?php print $base_url;?>/<?php print $domain;?>/user/password">忘記密碼?</br></a>
</div>
<?php
print render($form['actions']['submit']);
?>
	<a href="<?php print $base_url;?>/<?php print $domain;?>/user/simple-fb-connect" type="button" class="btn btn-primary" ><i class="fa fa-facebook-official"></i> FB一鍵登入</a>
	<a href="<?php print $base_url;?>/<?php print $domain;?>/user/register" type="button" class="btn btn-success" >註冊</a>
</div>
</div>
<div class="hidden">
  <?php print drupal_render_children($form); ?>
</div>
