<?php
/**
 * 
 *
 */
class Language {
  
  private static $instance = null;
  protected $language = '';
  protected $key = '';
  protected $content = '';
  private $is_exist = false;
  
  /**
   * Enter description here...
   *
   * @param string z sesji $language
   */
  public function __construct() {
    $this->session = Session::getInstance();
    $this->language = strtolower( $this->session->getAttribute('lang') );
  }
  
  public function load() {
  	if($this->language != '' && $this->key != '') {
    	$sql1 = 'SELECT * FROM `content_by_language` WHERE `key`=\''.$this->key.'\' AND `language`=\''.$this->language.'\'';
      $DB1 = DB::getInstance();
      $stmt2 = $DB1->query($sql1);
      if((int)$stmt2 && $rs = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        $this->content = $rs['content'];
        $this->is_exist = true;
        $stmt2->closeCursor();
      }
  	}
  }
  
  public function setKey( $key ) {
    $this->key = $key;
  }
  
  public function getKey() {
    return $this->key;
  }
  
  public function setContent( $content ) {
    $this->content = $content;
  }
  
  public function getContent() {
    return $this->content;
  }
  
  public function save( $content ) {
    $result = 0;
    $DB1 = DB::getInstance();
    $this->load();
    if( $this->is_exist == true ){
      $sql = 'UPDATE `content_by_language` SET
                                `content`=\'' . $content . '\'
            WHERE `key`=\'' . $this->key . '\' AND `language`=\'' . $this->language . '\'';
    } else {
      $sql = 'INSERT INTO `content_by_language` SET
                                `content`=\'' . $content . '\',
                                `key`=\'' . $this->key . '\',
                                `language`=\'' . $this->language . '\'';
    }
    $this->content = '';
    $result = $DB1->exec($sql);
    return $result;
  }


	public function setCollation() {
			$sql = 'SELECT `collation`
    	        FROM `language`
    	        WHERE `deleted` = \'N\'
							AND `active` = \'Y\'
    	        AND `name` = \''.$this->language.'\';';
      $DB = DB::getInstance();
      $stmt = $DB->query($sql);
			if((int)$stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $stmt->closeCursor();
				$collation = $rs['collation'];
				if($collation && $collation != '')
					$this->session->setAttribute('collation', $collation);
      }else
				$this->session->setAttribute('collation', 'utf8_general_ci');
	}
	
}
?>