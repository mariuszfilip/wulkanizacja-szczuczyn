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


  protected $id_otherpage = 0;
  protected $name         = '';
  protected $key_title    = '';
  protected $key_content  = '';
  protected $title    = '';
  protected $content  = '';

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
    $this->key_title = md5('otherpagetitle'.$id);
  }

  function setKeyContent( $id ) {
    $this->key_content = md5('otherpagecontent'.$id);
  }

  public function add() {
    $DB = DB::getInstance();
    $sql = 'INSERT INTO `otherpage` SET
												`name`=\''.$this->name.'\',
												`added`=CURRENT_TIMESTAMP,
												`active`=\''.$this->active.'\'';
    $result = $DB->exec($sql);
    if($result) {
      $result = 0;
      // jesli insert udany, pobieramy id
      $this->id = $DB->lastInsertId();
      if( $this->id > 0 ) {
        $this->setKeyContent( $this->id );
        $this->setKeyTitle( $this->id );
        $sql = 'UPDATE `otherpage` SET
											`key_title`=\'' . $this->key_title . '\',
											`key_content`=\'' . $this->key_content . '\'
            WHERE `id_otherpage`=\'' . $this->id . '\'';
        $result = $DB->exec($sql);
      } else {
        $result = 0;
      }
    }
    if($result) {
      $_SESSION['message'] = 'Dane zostały dodane';
    }
    return $result;
  }

  public function modify() {
    $result = 0;
    $l = new Language();
    $l->setKey($this->key_title);
    $m1 = $l->save($this->title);
    $l->setKey($this->key_content);
    $m2 = $l->save($this->content);
    if( $m1 && $m2 ) {
      $result = 1;
    }
    return $result;
  }

  public function validate() {
    $errors = array();
    if($this->name == '') {
      $errors['name'] = 'Nazwa klucz jest wymagana';
    }
    return $errors;
  }

  public function delete() {
    $sql = 'UPDATE `otherpage`
               SET `deleted`=\'1\'
            WHERE `id_otherpage`=\''.$this->id.'\'';
    $DB = DB::getInstance();
    $r = $DB->exec($sql);
    if($r) {
      $sql = 'UPDATE `exhibit` SET 
                `id_information`=0,
                `information`=0
              WHERE `id_information`=\''.$this->id.'\'';
      $r1 = $DB->exec($sql);
      $sql = 'UPDATE `exhibit` SET 
                `id_description`=0,
                `description`=0
              WHERE `id_description`=\''.$this->id.'\'';
      $r2 = $DB->exec($sql);
      $_SESSION['message'] = 'Dane zostały usunięte';
    } else {
      $_SESSION['message'] = 'Dane zostały usunięte';
    }
    return $r;
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