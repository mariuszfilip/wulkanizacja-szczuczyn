<?php

class FileType extends DBObject {

	protected $name 				= '';
	protected $id_file_type	= 0;

	public function __construct($id = 0) {
		$this->id = $id;
		$this->id_file_type = $id;
		$this->load();
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

	private function load() {
		$sql = 'SELECT *
						FROM `file_types` WHERE `id_file_type`=\''.$this->id.'\'';
		$DB = DB::getInstance();
		$stmt = $DB->query($sql);
      if((int)$stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$this->id 				 = $rs['id_file_type'];
				$this->extension	 = $rs['extension'];
				$this->name 			 = $rs['name'];

			$stmt->closeCursor();
		}
	}

	public function add() {
		$lastPosition = 0;
    $DB = DB::getInstance();
 		$sql = 'INSERT INTO `file_types` SET
                 `name`=\'' . $this->name . '\'';

    $result = $DB->exec($sql);
	  if($result) {
	    $_SESSION['message'] = 'Dane zostały dodane';
	  }
	  $this->id 		 = $DB->lastInsertId();
	  $this->id_file_type = $DB->lastInsertId();
	  return $result;
	}

  public function modify() {
  	$DB = DB::getInstance();
  	$result = 0;
		$sql = 'UPDATE `file_types` SET
  								`name`=\'' . $this->name . '\',
   					WHERE `id_file_type`=\''.$this->id.'\'';
  	$result = $DB->exec($sql);
  	if($result) {
  		$_SESSION['message'] = 'Dane zostały zaktualizowane';
  	}
  	return $result;
  }

  public function delete() {

  	$sql = 'DELETE FROM `file_types` WHERE `id_file_type`=\''.$this->id.'\'';
  	$DB = DB::getInstance();
  	$result = $DB->exec($sql);

  }

	public function validate() {
		$errors = array();
		if($this->name == '') {
		  $errors['name'] = 'Nazwa typu pliku jest wymagana';
		}

		return $errors;
	}

	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
	}

	public function toArray()	{
		$r = parent::toArray();
		return $r;
	}
}

?>