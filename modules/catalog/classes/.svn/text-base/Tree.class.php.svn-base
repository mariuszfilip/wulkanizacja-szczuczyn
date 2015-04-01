<?php
/**
 * Obiekt bazodanowy odpowiadający węzłowi drzewa
 *
 * @package smartsystem.catalog
 */

class Tree {

	private $treeStructure = array();
	private $data = array();
	public function __construct() {
		//$this->treeStructure = $this->getTree();
	}

	/**
	 * Przesuwa węzeł o jeden w górę w danej gałęzi
	 * @param unknown_type $id
	 */
	public function nodeMoveUp($id) {
		$node =  new Node($id);
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
	 * @param unknown_type $id
	 */
	public function nodeMoveDown($id) {

		$node =  new Node($id);
		//aktualna / poprzednia pozycja węzła w gałęzi.
		$actualPosition 	= $node->getPosition();
		$nextNode = $node->getNextSibling();
		if($nextNode) {
			$nextPosition = $nextNode->getPosition();
			// ustawienie pozycji poprzedniego na aktualny
			$nextNode->setPosition($actualPosition);
			//ustawienie pozycji tego węzła na poprzedni
			$node->setPosition($nextPosition);
			$node->save();
			$nextNode->save();
		}
	}


	/**
	 * Usunięcie węzła z drzewa
	 * @param int $id
	 */
	public function deleteNode($id) {
		//usuniecie z bazy i zmiana pozycji
		$node = new Node($id);
		if($node->getNextSibling()) {
			$position = $node->getNextSibling()->getPosition();
			$list = $node->getAllNodesUnder();

			foreach ($list as $k => $v) {
				$list[$k]->getPosition() - 1;
				$list[$k]->setPosition($list[$k]->getPosition() - 1);
				$list[$k]->save();
			}

		}
		$r = $node->delete();
		return $r;

	}

	public function addNode($id, $name) {
		$r = 0;
		$node = new Node($id);
		$r = $node->appendChild($name);
		return $r;
	}

	/**
	 * Dodaje nowy element o rodzicu 0
	 */
	public function addRootNode($name) {

  	$node = new Node();
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
			return Node::getAll();
		}

		/**
		 * Ustawia strukture drzewa dla jednego
		 * węzła z rodzicem 0
		 * @param int $parent
		 * @param array $nodeList
		 * @return array
		 */
		private function rebuildNodes($parent,$nodesList) {
			$r = array();
			if(!empty($nodesList[$parent])) {
				foreach ($nodesList[$parent] as $v) {
					$currentNode = $v;
					$children = $this->rebuildNodes($currentNode['id_catalog'], $nodesList);
					if(!empty($children)) {
						$currentNode['children'] = $children;
					}
					$r[] = $currentNode;
				}
			}
			return $r;
		}

}
?>