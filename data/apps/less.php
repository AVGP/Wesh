<?php
class lessApplication extends App
{
	function run()
	{
		parent::run();
		$file = $this->params;
		$data = '';
		if(is_file(getcwd().'/data/'.trim($this->environment['path'],'/').'/'.$file))
		{
			$content = file_get_contents(getcwd().'/data/'.trim($this->environment['path'],'/').'/'.$file);
			$data = $content;
		}
		else
		{
			$data = 'This is not a file!';
		}
		$this->outputResults($data,$_GET['environment']);
	}
}
?>