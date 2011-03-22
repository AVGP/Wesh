<?php
class App
{
	protected $params = null;
	protected $environment = null;
	
	function run()
	{
		$this->params 		= trim($_GET['params']);
		$this->environment 	= json_decode($_GET['environment'],true); 
	}
	
	function outputResults($result,$environment)
	{
		echo '{"status":"OK","data":'.json_encode(nl2br($result)."\n").',"environment":'.$environment.'}';
	}
}
?>