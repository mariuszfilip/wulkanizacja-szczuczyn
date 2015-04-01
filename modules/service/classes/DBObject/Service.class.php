<?php
class Service extends DBObject {

	protected $id_service = 0;
	protected $id_catalog = 0;
	protected $name = '';
	protected $short_content = '';
	protected $content = '';
	protected $picture = '';
	protected $price = 0;
	protected $added = 0;
	protected $modified = 0;
	protected $deleted = 0;
	protected $active = 0;
	protected $DB = null;

	public function __construct($id=0) {
		$this->id = $id;
		$this->id_service = $id;
		$this->DB = DB::getInstance();
		$this->load();
	}

	private function load() {
		if($this->id > 0) {
			$sql = 'SELECT * FROM `service` WHERE `deleted`=\'N\' AND id_service='.$this->id;
			$stmt = $this->DB->query($sql);
			if($stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$this->id = $rs['id_service'];
				$this->id_service = $rs['id_service'];
				$this->id_catalog = $rs['id_catalog'];
				$this->name = $rs['name'];
				$this->short_content = $rs['short_content'];
				$this->content = $rs['content'];
				$this->picture = $rs['picture'];
				$this->price = $rs['price'];
				$this->added = $rs['added'];
				$this->modified = $rs['modified'];
				$this->deleted = $rs['deleted'];
				$this->active = $rs['active'];
			}
		}
	}
	
	  public function getAll($id_catalog) {
    $r = array();
    $DB = DB::getInstance();
   	$sql = 'SELECT * FROM `service` WHERE `deleted`=\'N\' AND id_catalog='.$id_catalog;
    $stmt = $DB->query($sql);
    if($stmt) {
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
      foreach ($result as $rs) {
      		 	$r[$rs['id_service']]['id'] = $rs['id_service'];
				$r[$rs['id_service']]['id_service'] = $rs['id_service'];
				$r[$rs['id_service']]['id_catalog'] = $rs['id_catalog'];
				$r[$rs['id_service']]['name'] = $rs['name'];
				$r[$rs['id_service']]['short_content'] = $rs['short_content'];
				$r[$rs['id_service']]['content'] = $rs['content'];
				$r[$rs['id_service']]['picture'] = $rs['picture'];
				$r[$rs['id_service']]['price'] = $rs['price'];
				$r[$rs['id_service']]['producer'] = $rs['producer'];
				$r[$rs['id_service']]['cap'] = $rs['cap'];
				$r[$rs['id_service']]['season'] = $rs['season'];
				$r[$rs['id_service']]['size'] = $rs['size'];
				$r[$rs['id_service']]['destination'] = $rs['destination'];
				$r[$rs['id_service']]['speed_index'] = $rs['speed_index'];
				$r[$rs['id_service']]['agricultural'] = $rs['agricultural'];
				$r[$rs['id_service']]['pr'] = $rs['pr'];
				$r[$rs['id_service']]['id_category_type'] = $rs['id_category_type'];
				$r[$rs['id_service']]['warranty'] = $rs['warranty'];
				$r[$rs['id_service']]['tension'] = $rs['tension'];
				$r[$rs['id_service']]['capacity'] = $rs['capacity'];
				$r[$rs['id_service']]['power_starter'] = $rs['power_starter'];
				$r[$rs['id_service']]['diameter_wheel'] = $rs['diameter_wheel'];
				$r[$rs['id_service']]['width_wheel'] = $rs['width_wheel'];
				$r[$rs['id_service']]['spacing_screw'] = $rs['spacing_screw'];
				$r[$rs['id_service']]['seating'] = $rs['seating'];

      }
    }
    return $r;
  }
  
  public function getAllPagination($id_catalog,$start_row) {
  	$r = array();
  	$DB = DB::getInstance();
  	$sql = 'SELECT * FROM `service` WHERE `deleted`=\'N\' AND id_catalog='.$id_catalog.' limit '.$start_row.',5';
  	$stmt = $DB->query($sql);
  	if($stmt) {
  		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  		$stmt->closeCursor();
  		foreach ($result as $rs) {
  			$r[$rs['id_service']]['id'] = $rs['id_service'];
  			$r[$rs['id_service']]['id_service'] = $rs['id_service'];
  			$r[$rs['id_service']]['id_catalog'] = $rs['id_catalog'];
  			$r[$rs['id_service']]['name'] = $rs['name'];
  			$r[$rs['id_service']]['short_content'] = $rs['short_content'];
  			$r[$rs['id_service']]['content'] = $rs['content'];
  			$r[$rs['id_service']]['picture'] = $rs['picture'];
  			$r[$rs['id_service']]['price'] = $rs['price'];
  			$r[$rs['id_service']]['producer'] = $rs['producer'];
  			$r[$rs['id_service']]['cap'] = $rs['cap'];
  			$r[$rs['id_service']]['maxload'] = $rs['maxload'];
  			$r[$rs['id_service']]['season'] = $rs['season'];
  			$r[$rs['id_service']]['size'] = $rs['size'];
  			$r[$rs['id_service']]['destination'] = $rs['destination'];
  			$r[$rs['id_service']]['speed_index'] = $rs['speed_index'];
  			$r[$rs['id_service']]['agricultural'] = $rs['agricultural'];
  			$r[$rs['id_service']]['pr'] = $rs['pr'];
  
  		}
  	}
  	return $r;
  }
	
  public function getCountAll($id_catalog) {
  	$r = array();
  	$DB = DB::getInstance();
  	$sql = 'SELECT count(id_service) as ile FROM `service` WHERE `deleted`=\'N\' AND id_catalog='.$id_catalog;
  	$stmt = $DB->query($sql);
  
  	if($stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$count = $rs['ile'];
	}
  	return 	$count;
  }
	public function add() {
		/*$sql = 'INSERT INTO service SET
				`id_catalog`=\''.$this->id_catalog.'\',
				`name`=\''.$this->name.'\',
				`short_content`=\''.$this->short_content.'\',
				`content`=\''.$this->content.'\',
				`price`=\''.$this->price.'\',
				`added`=NOW(),
				`active`=\''.$this->active.'\'';
		$result = $this->DB->exec($sql);
		if($result) {
			$_SESSION['message'] = 'Dane zostały dodane';
		}
		$this->id = $this->DB->lastInsertId();
		return $result;*/
	}

	public function modify() {
		/*$sql = 'UPDATE service SET
				`id_catalog`=\''.$this->id_catalog.'\',
				`name`=\''.$this->name.'\',
				`short_content`=\''.$this->short_content.'\',
				`content`=\''.$this->content.'\',
				`price`=\''.$this->price.'\',
				`active`=\''.$this->active.'\'
			WHERE id_service=\'' . $this->id . '\'';
		$result = $this->DB->exec($sql);
		if($result) {
			$_SESSION['message'] = 'Dane zostały zaktualizowane';
		}
		return $result;*/
	}

	public function validate() {
		$errors = array();
		return $errors;
	}

	public function save() {
		/*$errors = $this->validate();
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
		return $result;*/
	}

	public function delete() {
		/*$sql = 'UPDATE service SET
				deleted=\'Y\'
			WHERE id_service=\'' . $this->id . '\'';
		$result = $this->DB->exec($sql);
		if($result) {
			$_SESSION['message'] = 'Dane zostały zaktualizowane';
		}
		return $result;*/
	}
	
	public function getNames(){
		return $this->name;
		
	}
	public function getShortContent(){
		return $this->short_content;
		
	}
	public function getContent(){
		return $this->content;
		
	}
	
	

}
?>