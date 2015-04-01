<?php
class EventsSimpleCollection extends DBObjectsSimpleCollection {

	private $limit;
	private $arr = array();
	
	public function __construct($limit = 0) {
		$this->limit = $limit;
		parent::__construct();
	}

  protected function load() {
  	$limitQuery = '';
  	if($this->limit) {
  		$limitQuery = ' LIMIT '.$this->limit;
  	}
		
		$s = Session::getInstance();

  	$sql = 'SELECT * FROM `event`
  	        WHERE `deleted`=\'N\' 
						AND `active`=\'Y\' 
						AND `language`=\''.strtolower($s->getAttribute('lang')).'\'
						AND (
								`always`=\'Y\' OR (
										`date_from` <= NOW() AND
										`date_to` >= NOW()
										)
							)
  	        ORDER BY `added` DESC,`title` ASC'.$limitQuery;

  	$stmt = $this->DB->query($sql);
  	if( (int)$stmt ) {
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
      foreach ( $rows as $k => $v ){
  	    $this->arr[] = $v;
      }
  	}
  }
  
  public function getArr() {
    return $this->arr;
  }

}
?>