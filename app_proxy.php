<?php
if(is_file(getcwd().'/data/apps/'.basename($_GET['app']).'.php'))
{
	include getcwd().'/app.class.php';
	include getcwd().'/data/apps/'.basename($_GET['app']).'.php';
	$class = basename($_GET['app']).'Application';
	$app = new $class;
	$app->run();
}
else 
{
	echo '{"status":"Error","data":"Unknown command '.$_GET['app'].'\n","environment":'.$_GET['environment'].'}';
}
?>