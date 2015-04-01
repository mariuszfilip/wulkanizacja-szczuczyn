<?php
/**
 * Obiekt bazodanowy odpowiadający węzłowi drzewa
 *
 * @package smartsystem.catalog
 */

class PageTree {

	private $treeStructure = array();
	private $data = array();
	public function __construct() {
	// ???
//		$this->treeStructure = $this->getTree();

	}

	/**
	 * Przesuwa węzeł o jeden w górę w danej gałęzi.
	 *
	 * @param unknown_type $id
	 */
	public function nodeMoveUp($id) {
		$node =  new PageNode($id);

		//aktualna / poprzednia pozycja węzła w gałęzi.
		$actualPosition 	= $node->getPosition();
		$prevNode = $node->getPreviousSibling();

		if($prevNode) {
			$previousPosition = $prevNode->getPosition();
			// ustawienie pozycji poprzedniego na aktualny
			$prevNode->setPosition($actualPosition);
			//ustawienie pozycji tego węzła na poprzedni
			$node->setPosition($previousPosition);
			$node->save();
			$prevNode->save();
		}
	}

		/**
	 * Przesuwa węzeł o jeden w górę w danej gałęzi.
	 *
	 * @param unknown_type $id
	 */
	public function nodeMoveDown($id) {

		$node =  new PageNode($id);

		//aktualna / poprzednia pozycja węzła w gałęzi.
		$actualPosition 	= $node->getPosition();
		$nextNode = $node->getNextSibling();
		if($nextNode) {
			$nextPosition = $nextNode->getPosition();
			// ustawienie pozycji poprzedniego na aktualny
			$nextNode->setPosition($actualPosition);
			//ustawienie pozycji tego węzła na poprzedni
			$node->setPosition($nextPosition);
			/*var_dump($node);
			echo '
			';
			var_dump($nextNode);*/
			$node->save();
			$nextNode->save();
		}
	}



	/**
	 * Usunięcie węzła z drzewa
	 *
	 * @param int $id
	 */
	public function deleteNode($id) {

		//usuniecie z bazy i zmiana pozycji

		$node = new PageNode($id);
		if($node->getNextSibling()) {
			$position = $node->getNextSibling()->getPosition();
			$list = $node->getAllNodesUnder();

			foreach ($list as $k => $v) {
				$list[$k]->getPosition() - 1;
				$list[$k]->setPosition($list[$k]->getPosition() - 1);
//				$list[$]
				$list[$k]->save();
			}

		}
		$r = $node->delete();
		return $r;

	}

	public function addNode($id, $name) {
		$r = 0;
		$node = new PageNode($id);
		$r = $node->appendChild($name);
		return $r;
	}

	/**
	 * Dodaje nowy element o rodzicu 0
	 *
	 */
	public function addRootNode($name) {

  	$node = new PageNode();
  	$node->setIdParent(0);
 		if($node->getLastSibling()) { // jesli zwrocono objekt
	 		$lastPosition = $node->getLastSibling()->getPosition();
	 		$lastPosition += 1;
 		} else { // jesli nie ma ostaniego elementu
 			$lastPosition = 0;
 		}

		$node->setPosition($lastPosition); // ustaiwam pozycje elementu na +1
  	$node->setName($name);
  	$node->save();
	}

	/**
	 * Pobiera całe drzewko do tablicy
	 * wywołuje rekurencyjnie metodę rebulildNodes
	 *
	 */

		public function getTree() {
			$this->data = $this->getAllNodes();
			return $this->rebuildNodes(0,$this->data);
		}

		/**
		 * Pobiera z bazy wszysykie rekordy do drzewa
		 *
		 */
		private function getAllNodes() {

			$lang = Session::getInstance();


			$nodesList = array();
			$sql = 'SELECT *
							FROM `page`
							WHERE `language`=\''.$lang->getAttribute('lang').'\'
							ORDER BY `id_parent`,`position` ASC ';
			$DB = DB::getInstance();
			$stmt = $DB->query($sql);

			if((int)$stmt) {
				foreach ($stmt as $rs) {
					$parent = $rs['id_parent'];
					$nodesList[$parent][] = array(	'id_page' 		=> $rs['id_page'],
													'id_parent' 	=> $rs['id_parent'],
													'name' 			=> $rs['name'],
													'active' 		=> $rs['active'],
													'position' 		=> $rs['position'],
													'addable'	  	=> $rs['addable'],
													'deletable'		=> $rs['deletable'],
													'statusable'	=> $rs['statusable'],
													'renameable'	=> $rs['renameable'],
													'editable'	  	=> $rs['editable'],
													'dragable'		=> $rs['dragable'] );
				}
			}

			return $nodesList;
		}

    /**
     * Pobiera wszystkie rekordy z drzewa
     * @return <array>
     */
   public function getFlatTree() {
			$lang = Session::getInstance();
			$nodesList = array();
			$sql = 'SELECT *
							FROM `page`
							WHERE `language`=\''.$lang->getAttribute('lang').'\' AND `active`=\'Y\' AND `deleted`=\'N\' 
							ORDER BY `id_parent`,`position` ASC ';
			$DB = DB::getInstance();
			$stmt = $DB->query($sql);

			if((int)$stmt) {
				foreach ($stmt as $rs) {

					$nodesList[] = array('id_page' 		  => $rs['id_page'],
                               'id_parent' 	  => $rs['id_parent'],
                               'name' 				=> $rs['name'],
                               'active' 			=> $rs['active'],
                               'position' 		=> $rs['position']);
				}
			}

			return $nodesList;
   }
		/**
		 * Ustawia strukture drzewa dla jednego
		 * węzła z rodzicem 0
		 *
		 * @param int $parent
		 * @param array $nodeList
		 * @return array
		 */
		private function rebuildNodes($parent,$nodesList) {
			$r = array();
			if(!empty($nodesList[$parent])) {
				foreach ($nodesList[$parent] as $v) {
					$currentNode = $v;
					$children = $this->rebuildNodes($currentNode['id_page'], $nodesList);
					if(!empty($children)) {
						$currentNode['children'] = $children;
					}
					$r[] = $currentNode;
				}
			}

			return $r;
		}
		
		public function moveNodes($src, $dst=0, $prv=0) {			
			
			if(!$src) die;			
			if(!$dst) $dst=0;
			if(!$prv) $prv=0;
			
			$lang = Session::getInstance();
			
			$src_node = new PageNode($src);			
			$dst_node = new PageNode($dst);
			$prv_node = new PageNode($prv);
			
			$src_id_parent = $src_node->getIdParent();
			$dst_id_parent = $dst_node->getIdParent();
			$prv_id_parent = $prv_node->getIdParent();
			
			//echo $src_node->getIdParent() .' : '. $dst.'<br>';			
			$src_node->setIdParent(99999999);
			$src_node->modify();
			
			$DB = DB::getInstance();				
			$sql_1 = 'UPDATE `page` t, (select @rownum:=@rownum+1 position2, p.`id_page`, p.`position` from page p, (SELECT 
					@rownum:=0) r WHERE `id_parent`='.$dst.' AND `language`=\''.$lang->getAttribute('lang').'\' ORDER by p.`position`
					) r
					SET t.`position` = r.position2-1
					WHERE (t.id_page = r.id_page)			
			';
			
			$sql_2 = 'UPDATE `page` t, (select @rownum:=@rownum+1 position2, p.`id_page`, p.`position` from `page` p, (SELECT 
					@rownum:=0) r WHERE `id_parent`='.$src_id_parent.' AND `language`=\''.$lang->getAttribute('lang').'\' ORDER by p.position
					) r
					SET t.position = r.position2-1
					WHERE (t.id_page = r.id_page)			
			';
			
			$sql_3='UPDATE `page` SET `position`=(position+1) WHERE `id_parent`='.$dst.' AND `position` > '.$prv_node->getPosition().'  AND `language`=\''.$lang->getAttribute('lang').'\'
			;';
			
			$DB->query($sql_1);
			$DB->query($sql_2);
			$DB->query($sql_3);
			
			$dst_node = new PageNode($dst);
			$prv_node = new PageNode($prv);			
			
			$src_node->setIdParent($dst);
			$src_node->setPosition(($prv_node->getPosition()+1));
			$src_node->modify();
			//echo 'Strona została pomyślnie przeniesiona.';
			
		}

}