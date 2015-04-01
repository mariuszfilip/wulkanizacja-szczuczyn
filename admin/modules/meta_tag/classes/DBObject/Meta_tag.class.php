<?php
class Meta_tag extends DBObject {

	protected $id_meta_tag = 0;
	protected $meta_title = '';
	protected $meta_title_overwrite = 0;
	protected $meta_keywords = '';
	protected $meta_keywords_overwrite = 0;
	protected $meta_description = '';
	protected $meta_description_overwrite = 0;
	protected $meta_last_modified = 0;
	protected $meta_robots = '';
	protected $meta_robots_overwrite = 0;
	protected $active = 'N';
	protected $added = 0;
	protected $modified = 0;
	protected $deleted = 'N';
	protected $DB = null;

	public function __construct($id=0) {
		$this->session = Session::getInstance();
		$this->id = $id;
		$this->id_meta_tag = $id;
		$this->DB = DB::getInstance();
		$this->load();
	}

	private function load() {
		$sql = 'SELECT * FROM `meta_tag` WHERE `language`=\''.$this->session->getAttribute('lang').'\'';
		$stmt = $this->DB->query($sql);
		if($stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$this->id = $this->id_meta_tag = $rs['id_meta_tag'];
			$this->meta_title = $rs['meta_title'];
			$this->meta_title_overwrite = $rs['meta_title_overwrite'];
			$this->meta_keywords = $rs['meta_keywords'];
			$this->meta_keywords_overwrite = $rs['meta_keywords_overwrite'];
			$this->meta_description = $rs['meta_description'];
			$this->meta_description_overwrite = $rs['meta_description_overwrite'];
			$this->meta_last_modified = $rs['meta_last_modified'];
			$this->meta_robots = $rs['meta_robots'];
			$this->meta_robots_overwrite = $rs['meta_robots_overwrite'];
		}
	}

	public function add() {
		$sql = 'INSERT INTO `meta_tag` SET
				`meta_title`=\''.$this->meta_title.'\',
				`meta_title_overwrite`=\''.$this->meta_title_overwrite.'\',
				`meta_keywords`=\''.$this->meta_keywords.'\',
				`meta_keywords_overwrite`=\''.$this->meta_keywords_overwrite.'\',
				`meta_description`=\''.$this->meta_description.'\',
				`meta_description_overwrite`=\''.$this->meta_description_overwrite.'\',
				`meta_robots`=\''.$this->meta_robots.'\',
				`meta_robots_overwrite`=\''.$this->meta_robots_overwrite.'\',
				`language`=\''.$this->session->getAttribute('lang').'\',
				`active`=\''.$this->active.'\',
				`added`=NOW()';
		$result = $this->DB->exec($sql);
		if($result) {
			$_SESSION['message'] = 'Dane zostały dodane';
		}
		$this->id = $this->DB->lastInsertId();
		return $result;
	}

	public function modify() {
  	$sql = 'UPDATE `meta_tag` SET
				`meta_title`=\''.$this->meta_title.'\',
				`meta_title_overwrite`=\''.$this->meta_title_overwrite.'\',
				`meta_keywords`=\''.$this->meta_keywords.'\',
				`meta_keywords_overwrite`=\''.$this->meta_keywords_overwrite.'\',
				`meta_description`=\''.$this->meta_description.'\',
				`meta_description_overwrite`=\''.$this->meta_description_overwrite.'\',
				`meta_robots`=\''.$this->meta_robots.'\',
				`meta_robots_overwrite`=\''.$this->meta_robots_overwrite.'\',
				`active`=\''.$this->active.'\'
			WHERE `language`=\''.$this->session->getAttribute('lang').'\'';
		$result = $this->DB->exec($sql);
		if($result) {
			$_SESSION['message'] = 'Dane zostały zaktualizowane';
		}
		return $result;
	}
	
	
	public function modifyAllLanguages($array) {
		if(is_array($array)){
			$sql = 'UPDATE `meta_tag` SET ';
			foreach($array as $k=>$v){
				$sql .= '`'.$k.'`=\''.$this->$k.'\', ';
				$over_val = $k.'_overwrite';
				if($this->$over_val)					
					$sql .= '`'.$k.'_overwrite`=\''.$this->$over_val.'\', ';
			}
			
			$sql .= '`active`=\''.$this->active.'\' WHERE 1';
			$result = $this->DB->exec($sql);
			if($result) {
				$_SESSION['message'] = 'Dane zostały zaktualizowane';
			}
			return $result;
		}
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
	
	public function fromArray($array) {
		parent::fromArray($array);		
		if(!in_array('meta_title_overwrite', array_keys($array)))
			$this->meta_title_overwrite = 0;
		if(!in_array('meta_keywords_overwrite', array_keys($array)))
			$this->meta_keywords_overwrite = 0;
		if(!in_array('meta_description_overwrite', array_keys($array)))
			$this->meta_description_overwrite = 0;
		if(!in_array('meta_robots_overwrite', array_keys($array)))
			$this->meta_robots_overwrite = 0;
  }

	public function delete() {
		$sql = 'UPDATE `meta_tag` SET
				`deleted`=\'Y\'
			WHERE `language`=\''.$this->session->getAttribute('lang').'\'';
		$result = $this->DB->exec($sql);
		if($result) {
			$_SESSION['message'] = 'Dane zostały zaktualizowane';
		}
		return $result;
	}

}
?>