<?php

class Operator extends DBObject {

  protected $name         = '';
  protected $surname      = '';
  protected $email        = '';
  protected $password     = 'XXXXX';
  protected $id_operator  = 0;

  public function __construct($id = 0) {
  	$this->id          = $id;
  	$this->id_operator = $id;
    $this->load();
  }

  private function load() {
  	if($this->id > 0) {
		$this->modules_o = new Modules( ( int )$this->id);
    	$sql = 'SELECT *
    	        FROM `operator`
    	        WHERE `deleted` = \'N\'
    	        AND `id_operator` = \'' . $this->id . '\'';
      $DB = DB::getInstance();
      $stmt = $DB->query($sql, true);
      if($stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $this->id           = $rs['id_operator'];
        $this->id_operator  = $rs['id_operator'];
        $this->name         = $rs['name'];
        $this->surname      = $rs['surname'];
        $this->email        = $rs['email'];
        $this->password     = $rs['password'];
        $this->added        = $rs['added'];
        $this->modified     = $rs['modified'];
        $this->deleted      = $rs['deleted'];
        $this->active       = $rs['active'];
      }
  	}
  }

  public function getName() {
  	return $this->name;
  }

  public function setName($name) {
  	$this->name = $name;
  }

  public function getSurname() {
  	return $this->surname;
  }

  public function setSurname($surname) {
  	$this->surname = $surname;
  }

  public function getEmail() {
  	return $this->email;
  }

  public function setEmail($email) {
  	$this->email = $email;
  }

  public function getPassword() {
  	return $this->password;
  }

  public function setPassword($password) {
  	$this->password = $password;
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
    $sql = 'INSERT INTO `operator` SET
                                    `name`=\'' . $this->name . '\',
                                    `surname`=\'' . $this->surname . '\',
                                    `email`=\'' . $this->email . '\',
                                    `password`='.MYSQL_PASSWORD_METHOD.'(\'' . $this->password . '\'),
                                    `added`=CURRENT_TIMESTAMP,
                                    `active`=\'' . $this->active . '\'';
    $result = $DB->exec($sql);
    if($result) {
      $_SESSION['message'] = 'Operator został dodany';
    }
    $this->id = $DB->lastInsertId();
    return $result;
  }

  public function modify() {
	$this->modules_o = new Modules( ( int )$this->id, $this->m );
    $DB = DB::getInstance();
    $result = 0;
    $sql = 'UPDATE `operator` SET
                               `name`=\'' . $this->name . '\',
                               `surname`=\'' . $this->surname . '\',
                               `email`=\'' . $this->email . '\',
							   `active`=\'' . $this->active . '\',
                               `password`=CASE 
							   		WHEN `password`=\'' . $this->password . '\'
										THEN `password`
										ELSE  '.MYSQL_PASSWORD_METHOD.'(\'' . $this->password . '\')
									END                               
            WHERE `id_operator`=\'' . $this->id . '\'';
    $result = $DB->exec($sql);
    if($result) {
      $_SESSION['message'] = 'Dane zostały zaktualizowane';
    }
    return $result;
  }

  public function validate() {
    $errors = array();
    if($this->email == '') {
      $errors['email'] = 'Brak adresu e-mail';
    } elseif($this->email!='') {
      if( $this->checkByEmail($this->email) > 0 ) {
        $errors['email'] = 'Podany adres e-mail istnieje już w bazie operatorów';
      }
    }
    if($this->password == '') {
      $errors['password'] = 'Nie podano hasła';
    }
    
    return $errors;
  }

  public function delete() {
    $sql = 'UPDATE `operator`
                           SET `deleted`=\'1\'
            WHERE `id_operator`=\'' . $this->id . '\'';
    $DB = DB::getInstance();
    $r = $DB->exec($sql,null,true);
    if($r) {
      $_SESSION['message'] = 'Operator usunięty';
    }
    return $r;
  }

  public function fromArray($array) {
  	parent::fromArray($array);
  	$this->id = $this->id_operator;
  }

  public static function checkByLoginAndPassword($login, $password) {
  	$sql = 'SELECT `id_operator`
  	        FROM `operator`
  	        WHERE `email`=\'' . $login . '\'
  	        AND `password`='.MYSQL_PASSWORD_METHOD.'(\'' . $password . '\') `id_operator`!='.$this->id;
    $DB = DB::getInstance();
    $stmt = $DB->query($sql);
    $id = 0;
    if($stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $id = $rs['id_operator'];
    }
    return $id;
  }
  
  protected function checkByEmail($email) {
  	$sql = 'SELECT `id_operator`
  	        FROM `operator`
  	        WHERE `email`=\'' . $email . '\' AND `id_operator`!='.$this->id;
    $DB = DB::getInstance();
    $stmt = $DB->query($sql);
    $id = 0;
    if($stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $id = $rs['id_operator'];
      $stmt->closeCursor();
    }
    return $id;
  }
}
?>