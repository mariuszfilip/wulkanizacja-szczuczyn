<?php
class MapAction extends Action
{
	public function init()
	{

	}


	public function doAction($param)
  {
		$param = strip_tags($param);
		switch($param)
		{
			case 'list':
			default:
			$this->getRoot(INDEX);
			break;
		}
  }


	public function getRoot($pageId)
	{	
		$tree = new Map();
		$treeList = $tree->getTree();
		$this->response->addParameter('map', $treeList);
		$collection = new EventsCollection(1);
    $this->response->addParameter('events', $collection);		
		$this->response->addParameter('moduletpl', 'map/templates/map.tpl');
	}

}
?>