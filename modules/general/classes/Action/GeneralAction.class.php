<?php
class GeneralAction extends Action 
{

	public function init()
	{
	  }

	public function doAction($param)
	{
		
	$top = new OtherPage(9);
	$this->response->addParameter('top',$top);	
	$bottom = new OtherPage(10);	
	$this->response->addParameter('bottom',$bottom);
	$news = new OtherPage(12);	
	$this->response->addParameter('news',$news);
    $this->response->addParameter('moduletpl', 'general/templates/general.tpl');
	}

}
?>