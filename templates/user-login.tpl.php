<?php 

print render($form['name']);
print render($form['pass']);
print render($form['actions']);
global $base_url;
?>

	<a href="<?php print $base_url;?>/user/register" type="button" class="btn btn-success" >Create New Account</a>
	<a href="<?php print $base_url;?>/user/password" type="button" class="btn btn-warning" >Request New Password</a>
	<a href="<?php print $base_url;?>/user/simple-fb-connect" type="button" class="btn btn-primary" >Login with Facebook</a>
