<?php

class File extends DBObject {

	protected $name 		= '';
	protected $id_file 		= 0;
	protected $file_name	= '';
	protected $photo		= '';
	protected $description 	= '';
	protected $size 		= 0;
	protected $type 		= 1;
	protected $active 		= 'N';
	protected $headline		= '';
	public $video			= false;

	public function __construct($id = 0) {
		$this->id = $id;
		$this->id_file = $id;
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
		if($this->id >0){
			$sql = 'SELECT `file`.*, `file_types`.`name` AS `type_name`, `file_types`.`mime`
						FROM `file` 
						LEFT JOIN `file_types` ON(`file_types`.`id_file_type` = `file`.`type`)
						WHERE `file`.`id_file`=\''.$this->id.'\'';
			$DB = DB::getInstance();
			$stmt = $DB->query($sql);
      		if((int)$stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$this->id 			= $rs['id_file'];
				$this->id_file 		= $rs['id_file'];
				$this->name 		= $rs['name'];
				$this->headline 	= $rs['headline'];
				$this->photo 	 	= $rs['photo'];
				$this->file_name 	= $rs['file_name'];
				$this->description 	= $rs['description'];
				$this->size 		= $rs['size'];
				$this->type 		= $rs['type'];
				$this->mime 		= $rs['mime'];
				$this->type_name	= $rs['type_name'];
				$this->active		= $rs['active'];

			$stmt->closeCursor();
			}
		}
	}

	public function add() {
		$lastPosition = 0;
    $DB = DB::getInstance();
 		$sql = 'INSERT INTO `file` SET
                                    `name`=\'' . $this->name . '\',
                                    `file_name`=\'' . $this->file_name . '\',
                                    `description`=\'' . $this->description . '\',
                                    `size`=\'' . $this->size . '\',
                                    `type`=\'' . $this->type . '\',
                                    `added`=NOW(),
                                    `modified`=NOW(),
                                    `active`=\'' . $this->active . '\'';

    $result = $DB->exec($sql);
	  if($result) {
	    $_SESSION['message'] = 'Dane zostały dodane';
	  }
	  $this->id 		 = $DB->lastInsertId();
	  $this->id_file = $DB->lastInsertId();
	  return $result;
	}

  public function modify() {
  	$DB = DB::getInstance();
  	$result = 0;
		$sql = 'UPDATE `file` SET
  							`name`=\'' . $this->name . '\',
                            `file_name`=\'' . $this->file_name . '\',
                            `description`=\'' . $this->description . '\',
                            `size`=\'' . $this->size . '\',
                            `type`=\'' . $this->type . '\',
                            `photo`=\'' . $this->photo . '\',
                            `headline`=\'' . $this->headline . '\',
                            `added`=\'' . $this->added . '\',
                            `modified`=NOW(),
                            `active`=\'' . $this->active . '\'
  					WHERE `id_file`=\''.$this->id.'\'';
  	$result = $DB->exec($sql);
  	if($result) {
  		$_SESSION['message'] = 'Dane zostały zaktualizowane';
  	}
  	return $result;
  }

  public function delete() {

  	$sql = 'DELETE FROM `file` WHERE `id_file`=\''.$this->id.'\'';
  	$DB = DB::getInstance();
  	$result = $DB->exec($sql);

  	if($result &&  @unlink(DOCS_DIR.$this->file_name) ) {
  		$_SESSION['message'] = 'Plik został usunięty';
  	}

  }

	public function validate() {
		$errors = array();
		if($this->name == '') {
		  $errors['name'] = 'Nazwa pliku jest wymagana';
		}
		if($this->file_name == '') {
		  $errors['name'] = 'Plik musi być wybrany';
		}
		return $errors;
	}

	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
	}
	public function getFileName() {
		return $this->file_name;
	}
	public function setFileName($fileName) {
		$this->file_name = $fileName;
	}
	public function getSize() {
		return $this->size;
	}
	public function setSize($size) {
		$this->size = $size;
	}
	public function getType() {
		return $this->type;
	}
	public function setType($type) {
		$this->type = $type;
	}
	public function getPhoto() {
		return $this->photo;
	}
	public function setPhoto($photo) {
		$this->photo = $photo;
	}
	public function getHeadline() {
		return $this->headline;
	}
	public function setHeadline($headline) {
		$this->headline = $headline;
	}

	public function getDescription() {
		return $this->description;
	}
	public function setDescription($desc) {
		$this->description = $desc;
	}

	public function getActive() {
		return $this->active;
	}
	public function setActive($active) {
		$this->active = $active;
	}

	public function getSizeInKiB() {
		return $this->size/1024;
	}
	public function getSizeInMiB() {
		return $this->getSizeInKiB()/1024;
	}
	
	public function getSizeInGiB() {
		return$this->getSizeInMiB()/1024;
	}
	
	public function setVideo() {
		$this->file_extension =  substr($this->file_name, (strlen($this->file_name)-3),strlen($this->file_name) );
    	if( ($this->type == '2') || ( $this->file_extension == 'flv') ) $this->video=true;
	}

	public function toArray()	{
		$r = parent::toArray();
		$r['sizek'] = $this->getSizeInKiB();		
		
		$this->file_extension =  substr($this->file_name, (strlen($this->file_name)-3),strlen($this->file_name) );
    	if( ($this->type == '2' || $this->type == '3') &&( $this->file_extension == 'flv') ) $this->video=true;
		
		return $r;
	}
}

?>