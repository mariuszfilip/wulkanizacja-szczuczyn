<?php
/**
 * SmartSystem v.5
 *
 * @package smartsystem.event
 */


/**
 * Obiekt bazodanowy odpowiadający eventowi
 *
 * @package smartsystem.event
 */
class Event extends DBObject {

  protected $title    = '';
  protected $intro    = '';
  protected $content  = '';
  protected $picture  = '';
  protected $source   = '';
  protected $date_from  = '';
  protected $date_to    = '';
  protected $always   = '';
  protected $id_event = 0;

  public function __construct($id = 0) {
    $s = Session::getInstance();
  	$this->id       = $id;
  	$this->id_event = $id;
    $this->load();
  }

  private function load() {
  	if($this->id > 0) {
    	$sql = 'SELECT *
    	        FROM event
    	        WHERE deleted = \'N\'
    	        AND id_event = \'' . $this->id . '\'';
      $DB = DB::getInstance();
      $stmt = $DB->query($sql);
      if((int)$stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $this->id       = $rs['id_event'];
        $this->id_event = $rs['id_event'];
        $this->title    = $rs['title'];
        $this->intro    = $rs['intro'];
        $this->content  = $rs['content'];
        $this->picture  = $rs['picture'];
        $this->source   = $rs['source'];
        $this->always   = $rs['always'];
        if( $this->always == 'N' ) {
          $this->date_from     = $rs['date_from'];
          $this->date_to       = $rs['date_to'];
        }
        $this->added        = $rs['added'];
        $this->modified     = $rs['modified'];
        $this->deleted      = (boolean) $rs['deleted'];
        $this->active       = (boolean) $rs['active'];
        $stmt->closeCursor();
      }
  	}
  }

  public function getName() {
  	return $this->name;
  }

  public function setName($name) {
  	$this->name = $name;
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
    $sql = 'INSERT INTO event SET
								title = \'' . $this->title . '\',
								intro = \'' . $this->intro . '\',
								content = \'' . $this->content . '\',
								picture = \'' . $this->picture . '\',
								source = \'' . $this->source . '\',
								date_from = \'' . $this->date_from . '\',
								date_to = \'' . $this->date_to . '\',
								always = \'' . $this->always . '\',
								added=CURRENT_TIMESTAMP,
								active=\'' . $this->active . '\'';
    $result = $DB->exec($sql);
    if($result) {
      $_SESSION['message'] = 'Dane zostały dodane';
    }
    $this->id = $DB->lastInsertId();
    return $result;
  }

  public function modify() {
    echo $this -> id_province;
    $DB = DB::getInstance();
    $result = 0;
    $sql = 'UPDATE event SET
									title = \'' . $this->title . '\',
									intro = \'' . $this->intro . '\',
									content = \'' . $this->content . '\',
									picture = \'' . $this->picture . '\',
									source = \'' . $this->source . '\',
									date_from = \'' . $this->date_from . '\',
									date_to = \'' . $this->date_to . '\',
									always = \'' . $this->always . '\',
									active=\'' . $this->active . '\'
            WHERE id_event=\'' . $this->id . '\'';
    $result = $DB->exec($sql);
    return $result;
  }

  /**
   * @todo wpisac walidacje
   * @return unknown
   */
  public function validate() {
    $errors = array();
    return $errors;
  }

  public function delete() {
    $sql = 'UPDATE event
            SET deleted=\'1\'
            WHERE id_event=\''.(int)$this->id.'\'';
    $DB = DB::getInstance();
    $r = $DB->exec($sql);
    return $r;
  }

  public function fromArray($array) {
  	parent::fromArray($array);
  	$this->id = $this->id_event;
  }

}
?>