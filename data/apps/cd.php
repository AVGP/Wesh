<?php
class cdApplication extends App
{
	function run()
	{
		parent::run();
		if($this->params != '.')
		{
			$path = $this->prepareNewPath();
		}
		else
		{
			$path = $this->environment['path'];
		}
		$this->environment['path'] = $path;
		if(is_dir(getcwd().'/data/'.$path))
		{
			$environmentString = $this->getUpdatedEnvironmentString();
		}
		else 
		{
			$data = $path.' is not a directory.';
			$environmentString = $_GET['environment'];
		}
		$this->outputResults($data,$environmentString);	 
	}
	
	function prepareNewPath()
	{
		$path_tokens = explode('/', rtrim($this->params,'/'));
		$path_new    = array();

		//Relative Paths:
		if($path_tokens[0] == '')
		{
			$path_new = explode('/', rtrim($this->environment['path'],'/'));
		}

		//Build new path from tokens:
		foreach($path_tokens as $dir)
		{
			if($dir != '..')
			{
				$path_new[] = $dir;
			}
			else if($dir != '.')
			{
				array_pop($path_new);
			}
		}

		return '/'.implode('/', $path_new);
	}
	
	function getUpdatedEnvironmentString()
	{
		$env_json_string = '{';
		if(!empty($this->params))
		{
			foreach($this->environment as $key => $value)
			{
				$env_json_string .= '"'.$key.'":"'.$value.'",';
			}
		}
		$env_json_string = rtrim($env_json_string,',').'}';
		return $env_json_string;
	}	
}
?>