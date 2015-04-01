<?php
/**
 * Obiekt bazodanowy odpowiadający węzłowi drzewa
 *
 * @package smartsystem.catalog
 */
	class PageNode extends DBObject {

		private $nodePath = array();
		protected $name 			= '';
		protected $id_node		= 0;
		protected $id_parent  = 0;
		protected $id_module  = 0;
		protected $position  	= 0;
		protected $active 	 	= 'N';
		protected $bottom_menu 	= 'N';
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
								FROM page
								WHERE id_page=\''.$this->id.'\' AND
											language=\''.$lang->getAttribute('lang').'\' AND
											active=\'Y\'';
				$DB = DB::getInstance();

				$stmt = $stmt = $DB->query($sql);
				if((int)$stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$this->id 		 	 = $rs['id_page'];
					$this->id_node   = $rs['id_page'];
					$this->id_parent = $rs['id_parent'];
					$this->id_module = $rs['id_module'];
					$this->position  = $rs['position'];
					$this->bottom_menu  = $rs['bottom_menu'];
					$this->name 		 = $rs['name'];
					$this->active 	 = $rs['active'];

					$stmt->closeCursor();
				}
			}
		}


		public function add() {
			
	  }


	  public function modify() {
	  	
	  }

		/**
		 * Usuwanie węzła
		 *
		 * @return unknown
		 */
	  public function delete() {
	   
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
			$sql = 'SELECT id_page
								FROM page
								WHERE id_parent=\''.$this->id_parent.'\' AND
											position='.$this->position.'-1
											AND language=\''.$lang->getAttribute('lang').'\'';
				$DB = DB::getInstance();
				$stmt = $DB->query($sql);
				if((int)$stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$r = $rs['id_page'];
			  	$stmt->closeCursor();
					$o = new PageNode($r);
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
			$sql = 'SELECT id_page
								FROM page
								WHERE id_parent=\''.$this->id_parent.'\' AND
											position='.$this->position.'+1
											AND language=\''.$lang->getAttribute('lang').'\'';
				$DB = DB::getInstance();
				$stmt = $DB->query($sql);
				if($stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$r = $rs['id_page'];
					$stmt->closeCursor();
					$o = new PageNode($r);
				}
	  	}
			return $o;
	  }

		/**
		 * Pobiera ostatni węzeł z aktualnej gałęzi (parent_id)
		 *
		 * @return PageNode
		 */
	  public function getLastSibling() {
			$lang = Session::getInstance();

	  	$r = 0;
	  	$o = null;
	  	$sql = 'SELECT id_page
	  						FROM page
	  						WHERE id_parent=\''.$this->id_parent.'\'
	  						AND language=\''.$lang->getAttribute('lang').'\'
	  						ORDER BY position DESC LIMIT 1';
	  		$DB = DB::getInstance();
	  		$stmt = $DB->query($sql);
	  		if($stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
			  	$stmt->closeCursor();
	  			$r = $rs['id_page'];
			  	$stmt->closeCursor();
			  	$o = new PageNode($r);
	  	}

			return $o;
	  }

	  /**
		 * Pobiera ostatne dziecko z aktualnej gałęzi (parent_id)
		 *
		 * @return PageNode
		 */
	  public function getLastChild() {
			$lang = Session::getInstance();

	  	$r = 0;
	  	$o = null;
	  	$sql = 'SELECT id_page
	  						FROM page
	  						WHERE id_parent=\''.$this->id.'\' AND
	  									language=\''.$lang->getAttribute('lang').'\' AND
	  									active=\'Y\'
	  						ORDER BY position DESC LIMIT 1';
	  		$DB = DB::getInstance();
	  		$stmt = $DB->query($sql);
	  		if($stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
			  	$stmt->closeCursor();
	  			$r = $rs['id_page'];
			  	$stmt->closeCursor();
			  	$o = new PageNode($r);
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

	  	$newNode = new PageNode();

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
			$newNode = new PageNode();
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
							FROM page
							WHERE position > '.$this->position. ' AND
										id_parent=\''.$this->id_parent.'\' AND
										language=\''.$lang->getAttribute('lang').'\' AND
										active=\'Y\'

							ORDER BY position ASC';
			$DB = DB::getInstance();
			$stmt = $DB->query($sql);
			if($stmt) {
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				foreach($result as $row) {
	      	$newNode = new PageNode($row['id_page']);
	      	$newNode->fromArray($row);
	      	$r[] = $newNode;
	      }

			}
			return $r;
	  }

		/**
		 * PObiera wszystkie dzieci
		 *
		 * @param unknown_type $parent
		 * @return unknown
		 */
	  public function getAllChildren($parent) {
			$lang = Session::getInstance();

			$r = array();
			$sql = 'SELECT *
							FROM page
							WHERE id_parent=\''.$parent.'\' AND
										language=\''.$lang->getAttribute('lang').'\' AND
										active=\'Y\'
							ORDER BY position ASC';
			$DB = DB::getInstance();
			$stmt = $DB->query($sql);
			if($stmt) {
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				foreach($result as $k => $row) {
//	      	$newNode = new Node();
//	      	$newNode->fromArray($row);
	      	$r[$k] = $row;
	      }

			}
			return $r;
	  }

	  public function nodePath($idNode) {

		 $sql = 'SELECT id_parent, name
		        	FROM page WHERE active=\'Y\'
		        	AND id_page="' . $idNode . '"
		        	ORDER BY position ASC';
			$DB = DB::getInstance();
			$stmt = $stmt = $DB->query($sql);
			if((int)$stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {

				$idParent = $rs['id_parent'];
				$name 		= $rs['name'];
				$stmt->closeCursor();

				if($idParent == 0) {
					$this->nodePath[$idNode] = $name;
					return;
				} else {
					$this->nodePath($idParent);
					$this->nodePath[$idNode] = $name;
				}
			}
		}

		public function getNodePath() {
			return $this->nodePath;
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