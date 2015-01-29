<?php 

print render($form['name']);
print render($form['pass']);
print render($form['actions']);
global $base_url;
global $domain;
?>

	<a href="<?php print $base_url;?>/<?php print $domain;?>/user/register" type="button" class="btn btn-success" >Create New Account</a>
	<a href="<?php print $base_url;?>/<?php print $domain;?>/user/password" type="button" class="btn btn-warning" >Request New Password</a>
	<a href="<?php print $base_url;?>/<?php print $domain;?>/user/simple-fb-connect" type="button" class="btn btn-primary" >Login with Facebook</a>
