<?php
class Service extends DBObject {

	protected $id_service = 0;
	protected $id_catalog = 0;
	protected $name = '';
	protected $short_content = '';
	protected $content = '';
	protected $picture = 0;
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
			$sql = 'SELECT * FROM service WHERE deleted=\'N\' AND id_service='.$this->id;
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
				$this->producer = $rs['producer'];
				$this->cap = $rs['cap'];
				$this->size = $rs['size'];
				$this->season = $rs['season'];
				$this->maxload = $rs['maxload'];
				$this->destination = $rs['destination'];
				$this->speed_index = $rs['speed_index'];
				$this->agricultural = $rs['agricultural'];
				$this->pr = $rs['pr'];
				$this->id_category_type = $rs['id_category_type'];
				$this->warranty = $rs['warranty'];
				$this->tension = $rs['tension'];
				$this->capacity = $rs['capacity'];
				$this->power_starter = $rs['power_starter'];
				$this->diameter_wheel = $rs['diameter_wheel'];
				$this->width_wheel = $rs['width_wheel'];
				$this->spacing_screw = $rs['spacing_screw'];
				$this->seating = $rs['seating'];
			}
		}
	}

	public function add() {
		$sql = 'INSERT INTO service SET
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
		return $result;
	}

	public function modify() {
		$sql = 'UPDATE service SET
				`id_catalog`=\''.$this->id_catalog.'\',
				`name`=\''.$this->name.'\',
				`short_content`=\''.$this->short_content.'\',
				`content`=\''.$this->content.'\',
				`price`=\''.$this->price.'\',
				`maxload`=\''.$this->maxload.'\',
				`picture`=\''.$this->picture.'\',
				`producer`=\''.$this->producer.'\',
				`cap`=\''.$this->cap.'\',
				`size`=\''.$this->size.'\',
				`season`='.$this->season.',
				`destination`=\''.$this->destination.'\',
				`speed_index`=\''.$this->speed_index.'\',
				`agricultural`=\''.$this->agricultural.'\',
				 `pr`=\''.$this->pr.'\',	
				 `id_category_type`=\''.$this->id_category_type.'\',
				 `warranty`=\''.$this->warranty.'\',
				 `tension`=\''.$this->tension.'\',
				 `capacity`=\''.$this->capacity.'\',
				 `power_starter`=\''.$this->power_starter.'\',
				 `diameter_wheel`=\''.$this->diameter_wheel.'\',
				 `width_wheel`=\''.$this->width_wheel.'\',
				 `spacing_screw`=\''.$this->spacing_screw.'\',
				 `seating`=\''.$this->seating.'\',
				`active`=\''.$this->active.'\'
			WHERE id_service=\'' . $this->id . '\'';
		$result = $this->DB->exec($sql);
		if($result) {
			$_SESSION['message'] = 'Dane zostały zaktualizowane';
		}
		return $result;
	}
	

	public function validate() {
		$errors = array();
		return $errors;
	}

	public function save() {
		$errors = $this->validate();
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

	public function delete() {
		$sql = 'UPDATE service SET
				deleted=\'Y\'
			WHERE id_service=\'' . $this->id . '\'';
		$result = $this->DB->exec($sql);
		if($result) {
			$_SESSION['message'] = 'Dane zostały zaktualizowane';
		}
		return $result;
	}
	
	public function getPicture() {
		return $this->picture;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getPrice() {
		return $this->price;
	}
	
  public function setPicture($picture) {
  	$this->picture = $picture;
  }

  public function getTypeCategory(){
  			$sql = "SELECT * FROM `category_type` WHERE status = 1 ORDER BY `name` ASC ";
			$DB = DB::getInstance();
			$stmt = $DB->query($sql);
			$aResult = array();
			if($result = $stmt->fetchAll(PDO::FETCH_ASSOC))
			{
				foreach ($result as $row)
				{
					$aResult[$row['id']]=$row;
				}
			}
			return $aResult;
  } 
  
}
?>