<?php
/**
 * SmartSystem v.5
 *
 * @package smartsystem.otherpage
 */


/**
 * Obiekt bazodanowy odpowiadający otherpageowi
 *
 * @package smartsystem.otherpage
 */
class OtherPage extends DBObject {


  public $id_otherpage = 0;
  public $name         = '';
  public $key_title    = '';
  public $key_content  = '';
  public $title    = '';
  public $content  = '';

  public function __construct($id = 0) {
  	$this->id            = $id;
  	$this->id_otherpage  = $id;
    $this->load();
  }

  private function load() {
  	if($this->id > 0) {
    	$sql = 'SELECT *
    	        FROM `otherpage`
    	        WHERE `deleted` = \'N\'
    	        AND `id_otherpage` = \'' . $this->id . '\'';
      $DB = DB::getInstance();
      $stmt = $DB->query($sql);
      if((int)$stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $this->id           = $rs['id_otherpage'];
        $this->id_otherpage = $rs['id_otherpage'];
        $this->name         = $rs['name'];
        $this->key_title    = $rs['key_title'];
        $this->key_content  = $rs['key_content'];
        $this->added        = $rs['added'];
        $this->modified     = $rs['modified'];
        $this->deleted      = (boolean) $rs['deleted'];
        $this->active       = (boolean) $rs['active'];
        $stmt->closeCursor();
      }
  	}
  	$l = new Language();
  	if( $this->key_content != '' ){
  	  $l->setKey( $this->key_content );
  	  $l->load();
      $this->content = $l->getContent();
  	}
  	if( $this->key_title != '' ){
  	  $l->setKey( $this->key_title );
  	  $l->load();
      $this->title = $l->getContent();
  	}
  }

  public function getName() {
  	return $this->name;
  }

  public function setName($name) {
  	$this->name = $name;
  }

   public function getContent() {
  	return $this->content;
  }

  public function setContent($content) {
  	$this->content = $content;
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

  function setKeyTitle( $id ) {
    $this->key_title = md5( 'otherpagetitle'.$id );
  }

  function setKeyContent( $id ) {
    $this->key_content = md5( 'otherpagecontent'.$id );
  }

  public function add() {
    
  }

  public function modify() {
    
  }

  public function validate() {

  }

  public function delete() {
   
  }

  public function date_fromArray($array) {
  	parent::date_fromArray($array);
  	$this->id = $this->id_otherpage;
  }
  /**
   * Ta funkcja jest po to aby pobrac dane do kolekcji
   *
   * @param unknown_type $array
   */
  public function fromArrayPlus( $array ) {
    parent::fromArray( $array );
    $l = new Language();
  	if( $this->key_content != '' ){
  	  $l->setKey( $this->key_content );
  	  $l->load();
      $this->content = $l->getContent();
  	}
  	if( $this->key_title != '' ){
  	  $l->setKey( $this->key_title );
  	  $l->load();
      $this->title = $l->getContent();
  	}
  }
}
?>