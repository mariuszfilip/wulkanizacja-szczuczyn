<?php
/**
 * Obiekt bazodanowy odpowiadający węzłowi drzewa
 *
 * @package smartsystem.catalog
 */
class Node extends DBObject {

		protected $name 			= '';
		protected $id_node		= 0;
		protected $id_parent  = 0;
		protected $position  	= 0;
		protected $active 	 	= 'Y';
		protected $new_node = null;

		public function __construct($id = 0) {
			$this->id 		 = $id;
			$this->id_node = $id;
			$this->load();
		}


		public function save() {
			$errors = null;
	    $result = 0;
	    if(empty($errors)) {
	      if($this->id > 0) {
	        $result = $this->modify();
	      } else {
	        $result = $this->add();
	      }
	    } else {
	      $_SESSION['errors'] = $errors;
	    }
	    return $result;
		}

		public function validate() {

		}

		private function load() {
			if($this->id > 0) {

				$lang = Session::getInstance();

				$sql = 'SELECT *
								FROM `catalog`
								WHERE `id_catalog`=\''.$this->id.'\' AND active=\'Y\' AND `lang`=\''.$lang->getAttribute('lang').'\'';
				$DB = DB::getInstance();

				$stmt = $stmt = $DB->query($sql);
				if((int)$stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$this->id 		 	 = $rs['id_catalog'];
					$this->id_node   = $rs['id_catalog'];
					$this->id_parent = $rs['id_parent'];
					$this->position  = $rs['position'];
					$this->name 		 = $rs['name'];
					$this->active 	 = $rs['active'];

					$stmt->closeCursor();
				}
			}
		}


		public function add() {
			$lastPosition = 0;
	    $DB = DB::getInstance();

			$lang = Session::getInstance();


	 		$sql = 'INSERT INTO `catalog` SET
													`name`=\''.$this->name.'\',
													`id_parent`=\''.$this->id_parent.'\',
													`active`=\''.$this->active . '\',
													`position`=\''.$this->position.'\',
													`lang`=\''.$lang->getAttribute('lang').'\'';

	    $result = $DB->exec($sql);
	    if($result) {
	      $_SESSION['message'] = 'Dane zostały dodane';
	    }
	    $this->id = $DB->lastInsertId();
	    return $result;
	  }

	  public function modify() {
	  	$DB = DB::getInstance();
			$lang = Session::getInstance();

	  	$result = 0;
			$sql = 'UPDATE `catalog` SET
										`name`=\''.$this->name.'\',
										`id_parent`=\''.$this->id_parent.'\',
										`active`=\''.$this->active.'\',
										`position`=\''.$this->position.'\'
	  					WHERE `id_catalog`=\''.$this->id.'\' AND `lang`=\''.$lang->getAttribute('lang').'\'';
	  	$result = $DB->exec($sql);
	  	if($result) {
	  		$_SESSION['message'] = 'Dane zostały zaktualizowane';
	  	}
	  	return $result;
	  }

		/**
		 * Usuwanie węzła
		 *
		 * @return unknown
		 */
	  public function delete() {
	    $sql = 'DELETE FROM `catalog`
	            WHERE `id_catalog`=\'' . $this->id . '\'';
	    $DB = DB::getInstance();
	    $r = $DB->exec($sql);
	    if($r) {
	      $_SESSION['message'] = 'Dane zostały usunięte';
	    }
	    return $r;
	  }


		/**
		 * Pobiera poprzedni węzeł względem aktualnego węzła
		 *
		 * @return Node
		 */
	  public function getPreviousSibling() {

	  	$r = 0;
	  	$o = null;

			$lang = Session::getInstance();


	  	if($this->id > 0) {
				$sql = 'SELECT `id_catalog`
								FROM `catalog`
								WHERE `id_parent`=\''.$this->id_parent.'\' AND
											`position`='.$this->position.'-1
											AND `lang`=\''.$lang->getAttribute('lang').'\'';
				$DB = DB::getInstance();
				$stmt = $DB->query($sql);
				if((int)$stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$r = $rs['id_catalog'];
			  	$stmt->closeCursor();
					$o = new Node($r);
				}
	  	}
	  	return $o;
	  }

		/**
		 * Pobiera następny węzeł względem aktualnego węzła
		 *
		 * @return Node
		 */
	 	public function getNextSibling() {
			$lang = Session::getInstance();

	  	$r = 0;
	  	$o = null;
	  	if($this->id > 0) {
			$sql = 'SELECT `id_catalog`
								FROM `catalog`
								WHERE `id_parent`=\''.$this->id_parent.'\' AND
											`position`='.$this->position.'+1
											AND `lang`=\''.$lang->getAttribute('lang').'\'';
				$DB = DB::getInstance();
				$stmt = $DB->query($sql);
				if($stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$r = $rs['id_catalog'];
					$stmt->closeCursor();
					$o = new Node($r);
				}
	  	}
			return $o;
	  }

		/**
		 * Pobiera ostatni węzeł z aktualnej gałęzi (parent_id)
		 *
		 * @return Node
		 */
	  public function getLastSibling() {
			$lang = Session::getInstance();

	  	$r = 0;
	  	$o = null;
	  	$sql = 'SELECT `id_catalog`
	  						FROM `catalog`
	  						WHERE `id_parent`=\''.$this->id_parent.'\'
	  						AND `lang`=\''.$lang->getAttribute('lang').'\'
							 AND active=\'Y\'
	  						ORDER BY `position` DESC LIMIT 1';
	  		$DB = DB::getInstance();
	  		$stmt = $DB->query($sql);
	  		if($stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
			  	$stmt->closeCursor();
	  			$r = $rs['id_catalog'];
			  	$stmt->closeCursor();
			  	$o = new Node($r);
	  	}

			return $o;
	  }

	  /**
		 * Pobiera ostatne dziecko z aktualnej gałęzi (parent_id)
		 *
		 * @return Node
		 */
	  public function getLastChild() {
			$lang = Session::getInstance();

	  	$r = 0;
	  	$o = null;
	  	$sql = 'SELECT `id_catalog`
	  						FROM `catalog`
	  						WHERE `id_parent`=\''.$this->id.'\'
	  						AND `lang`=\''.$lang->getAttribute('lang').'\'
								AND `active`=\'Y\'
	  						ORDER BY `position` DESC LIMIT 1';
	  		$DB = DB::getInstance();
	  		$stmt = $DB->query($sql);
	  		if($stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
			  	$stmt->closeCursor();
	  			$r = $rs['id_catalog'];
			  	$stmt->closeCursor();
			  	$o = new Node($r);
	  	}

			return $o;
	  }


		/**
		 * Dodaje nowy węzeł na końcu aktualnej gałęzi (rodzica)
		 *
		 * @param String $name
		 * @return int (?)
		 */
	  public function appendSibling($name) {

	  	$r = 0;
	  	$lastPosition = $this->getLastSibling()->getPosition() + 1;

	  	$newNode = new Node();

	  	$newNode->setIdParent($this->id_parent);
	  	$newNode->setPosition($lastPosition);
	  	$newNode->setName($name);

	  	$r = 	$newNode->add();
			//retrun $r - kurde nie wiem co zwraca w zasadzie metoda add()???
	  	return $r;
	  }

	  /**
	   * Dodanie nowego węzła do aktualnego węzła
	   *
	   * @param String $name
	   */
	  public function appendChild($name) {
			$r = 0;

			//utworzenie obiektu Node i dodanie
			$newNode = new Node();
			$lastNode = $this->getLastChild();

			if($lastNode) { //jesli jest jakis utworzony węzeł
				$lastPosition = $lastNode->getPosition();
				$lastPosition +=1;
			} else { //  będzie pierwszy węzeł dopiero
				$lastPosition = 0;
			}
			$newNode->setPosition($lastPosition);
			$newNode->setName($name);
			$newNode->setActive('Y');
			$newNode->setIdParent($this->getID());
			$r = $newNode->add();
			$r = $newNode;

			return $r;
	  }

		/**
		 * Pobiera wszystkie węzły poniżej aktualnego
		 *
		 * @return Node array (?)
		 */
	  public function getAllNodesUnder() {
			$lang = Session::getInstance();

			$r = array();
	  	$sql = 'SELECT *
							FROM `catalog`
							WHERE `position` > '.$this->position.' AND
										`id_parent`=\''.$this->id_parent.'\'
								AND `active`=\'Y\'
								AND `lang`=\''.$lang->getAttribute('lang').'\'
							ORDER BY `position` ASC';
			$DB = DB::getInstance();
			$stmt = $DB->query($sql);
			if($stmt) {
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				foreach($result as $row) {
	      	$newNode = new Node($row['id_catalog']);
	      	$newNode->fromArray($row);
	      	$r[] = $newNode;
	      }

			}
			return $r;
	  }
	  /**
	   * Pobiera w formie drzewka wszystkie gałęzie
	   *
	   * @return array
	   */
		public static function getAll() {

			$lang = Session::getInstance();

			$nodesList = array();
			$sql = 'SELECT *
							FROM `catalog`
							WHERE `lang`=\''.$lang->getAttribute('lang').'\'
							 AND active=\'Y\'
							ORDER BY `position` ASC ';
			$DB = DB::getInstance();
			$stmt = $DB->query($sql);

			if((int)$stmt) {
				foreach ($stmt as $rs) {
//					$parent = $rs['id_catalog'];
					$parent = $rs['id_parent'];
					$nodesList[$parent][] = array(
							'id_catalog' 	=> $rs['id_catalog'],
							'id_parent' 	=> $rs['id_parent'],
							'name' 				=> $rs['name'],
							'active' 			=> $rs['active'],
							'position' 		=> $rs['position']);
				}
			}
			return $nodesList;
		}
    /**
     * Zwraca talice kategorii bez struktury - sortowane po id
     * $for_front ==> true jesli dane sa genrowane
     * dla uzytkownika forontowego (active/deleted)
     * @return <array>
     */
    public function getAllNodesFlatOrderedById($for_front = false) {
			$lang = Session::getInstance();

			$nodesList = array();
      if($for_front) {
        $sql_where = ' AND `active`=\'Y\' ';
      } else {
        $sql_where  = '';
      }
			$sql = 'SELECT *
							FROM `catalog`
							WHERE `lang`=\''.$lang->getAttribute('lang').'\''.$sql_where.'
							ORDER BY `position` ASC ';
			$DB = DB::getInstance();
			$stmt = $DB->query($sql);

			if((int)$stmt) {
				foreach ($stmt as $rs) {
					$nodesList[] = array(
							'id_catalog' => $rs['id_catalog'],
							'id_parent' => $rs['id_parent'],
							'name' 			=> $rs['name'],
							'active' 		=> $rs['active'],
							'position' 	=> $rs['position']);
				}
			}
			return $nodesList;
    }
		public function getName() {
			return $this->name;
		}
		public function setName($name) {
			$this->name = $name;
		}

		public function getIdParent() {
			return $this->id_parent;
		}
		public function setIdParent($idParent) {
			$this->id_parent = $idParent;
		}

		public function getActive() {
			return $this->active;
		}
		public function setActive($active) {
			$this->active = $active;
		}

		public function getPosition() {
			return $this->position;
		}
		public function setPosition($position) {
			$this->position = $position;
		}

}
?>