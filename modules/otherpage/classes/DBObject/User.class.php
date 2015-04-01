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
class User extends DBObject {


  public $id = 0;
  public $email = '';
  public $phone = '';

  public function __construct($id = 0) {
  	$this->id            = $id;
    $this->load();
  }

  private function load() {
  	if($this->id > 0) {
    	$sql = 'SELECT *
    	        FROM `users`
    	        WHERE 
    	        AND `id` = \'' . $this->id . '\'';
      $DB = DB::getInstance();
      $stmt = $DB->query($sql);
      if((int)$stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $this->id           = $rs['id'];
        $this->added        = $rs['added'];
        $stmt->closeCursor();
      }
  	} 
  }

  public function getName() {
  	return $this->name;
  }

  public function setEmail($email) {
  	$this->email = $email;
  }
   public function setPhone($phone) {
  	$this->phone = $phone;
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

  public function add() {
  	$DB = DB::getInstance();
    $sql = 'INSERT INTO `users` SET
                                    `email`=\'' . $this->email . '\',
                                    `added`=CURRENT_TIMESTAMP,
                                    `phone`=\'' . $this->phone. '\'';
    $result = $DB->exec($sql);
    if($result) {
      $_SESSION['message'] = 'Dane zostały dodane';
    }
    $this->id = $DB->lastInsertId();
    return $result;
    
  }
   public function check() {
 	 $sql = 'SELECT id
    	        FROM `users`
    	        WHERE  `email` = \'' . $this->email . '\'';
      $DB = DB::getInstance();
      $stmt = $DB->query($sql);
   	  $rs = $stmt->fetch(PDO::FETCH_ASSOC);

		if($rs == false):
			return 0;
		else:
			return 1;
		endif;

    	
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