<?php

class Module extends DBObject {

  protected $action     = '';
  protected $name      	= '';
  protected $order     	= '';
  protected $id_module  = 0;
	protected $protected  = 'Y';

  public function __construct($id = 0) {
  	$this->id					= $id;
  	$this->id_module 	= $id;
    $this->load();
  }

  private function load() {
  	if($this->id > 0) {
    	$sql = 'SELECT *
    	        FROM `id_module`
    	        WHERE `id_module` = \'' . $this->id . '\'';
      $DB = DB::getInstance();
      $stmt = $DB->query($sql, true);
      if($stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $this->id           = $rs['id_module'];
        $this->id_module  	= $rs['id_module'];
        $this->action       = $rs['action'];
        $this->name      		= $rs['name'];
				$this->order      	= $rs['order'];
				$this->protected   	= $rs['protected'];
      }
  	}
  }

  public function getName() {
  	return $this->name;
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
    
  }

  public function modify() {

  }

  public function validate() {
    $errors = array();
    return $errors;
  }

  public function delete() {
   
  }

  public function fromArray($array) {
  	parent::fromArray($array);
  	$this->id = $this->id_module;
  }
  

}
?>