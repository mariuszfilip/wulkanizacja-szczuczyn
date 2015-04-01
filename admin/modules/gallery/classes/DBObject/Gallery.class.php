<?php

class Gallery extends DBObject {
  protected $id_gallery = 0;
  protected $name         = '';
  protected $description  = '';
  protected $photo = null;

  public function __construct($id = 0) {
  	$this->id         = $id;
  	$this->id_gallery = $id;
    $this->load();
  }

  private function load() {
  	if($this->id > 0) {
    	$sql = 'SELECT *
    	        FROM `gallery`
    	        WHERE `deleted` = \'N\'
    	        AND `id_gallery` = \'' . $this->id . '\'';
      $DB = DB::getInstance();
      $stmt = $DB->query($sql);
      if((int)$stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $this->id           = $rs['id_gallery'];
        $this->id_gallery   = $rs['id_gallery'];
        $this->name         = $rs['name'];
        $this->description  = $rs['description'];
        $this->added        = $rs['added'];
        $this->modified     = $rs['modified'];
        $this->deleted      = $rs['deleted'];
        $this->active       = $rs['active'];
      }
      $stmt->closeCursor();
  	}
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

  public function add() {
    $DB = DB::getInstance();
    $sql = 'INSERT INTO `gallery` SET
                                    `name`=\'' . $this->name . '\',
                                    `added`=CURRENT_TIMESTAMP,
                                    `active`=\'' . $this->active . '\',
                                    `description`=\'' . $this->description. '\'';
    $result = $DB->exec($sql);
    if($result) {
      $_SESSION['message'] = 'Dane zostały dodane';
    }
    $this->id = $DB->lastInsertId();
    return $result;
  }

  public function modify() {
    $DB = DB::getInstance();
    $result = 0;
    $sql = 'UPDATE `gallery` SET
                                `name`=\'' . $this->name . '\',
                                `description`=\'' . $this->description. '\',
                                `active`=\'' . $this->active . '\'
            WHERE `id_gallery`=\'' . $this->id . '\'';
    $result = $DB->exec($sql);
    if($result) {
      $_SESSION['message'] = 'Dane zostały zaktualizowane';
    }
    return $result;
  }

 public function validate() {
    $errors = array();
    if($this->name == '') {
      $errors['name'] = 'Nazwa galerii jest wymagana';
    }
    return $errors;
  }

  public function delete() {
    $sql = 'UPDATE `gallery`
                           SET `deleted`=\'Y\'
            WHERE `id_gallery`=\'' . $this->id . '\'';
    $DB = DB::getInstance();
    $r = $DB->exec($sql);
    if($r) {
      $_SESSION['message'] = 'Dane zostały usunięte';
    }
    return $r;
  }

  public function date_fromArray($array) {
  	parent::date_fromArray($array);
  	$this->id = $this->id_exhibit;
  }
}

?>