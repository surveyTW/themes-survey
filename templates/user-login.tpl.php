<?php 

print render($form['name']);
print render($form['pass']);
print render($form['actions']);

?>

	<a href="../user/register" type="button" class="btn btn-success" >Create New Account</a>
	<a href="../user/password" type="button" class="btn btn-warning" >Request New Password</a>
	<a href="../user/simple-fb-connect" type="button" class="btn btn-primary" >Login with Facebook</a>
