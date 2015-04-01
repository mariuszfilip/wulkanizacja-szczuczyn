<?php
/**
 * SmartSystem v.5
 *
 * @package smartsystem.event
 */


/**
 * Kolekcja eventów systemu
 *
 * @package smartsystem.event
 */
class EventsCollection extends DBObjectsCollection {

  protected $sql = '';
  protected $sql_conditions = '';
  protected $sql_order = '';
  protected $s = null;
  
  protected function setSql( $_sql_conditions = '') {
		$s = Session::getInstance();
    $this->sql = $sql = 'SELECT *
  	        FROM `event`
  	        WHERE `deleted`=\'N\' 
						AND `language`=\''.strtolower($s->getAttribute('lang')).'\'
  	        AND	`active`=\'Y\' AND ( `always`=\'Y\' OR ( `date_from` <= NOW() AND `date_to` >= NOW() ) )'.$_sql_conditions;
  }
  
  protected function getSql() {
    return $this->sql;
  }

  protected function setSqlConditions() {
  }
  
  protected function setSqlOrder() {
    $this->sql_order = ' ORDER BY `added` DESC,`title` ASC';
  }
  
  protected function getSqlConditions() {
    return $this->sql_conditions;
  }

  protected function load() {
    $this->setRowsPerView(EVENT_PER_VIEW);
    $s = Session::getInstance();
    $this->setSqlConditions();
    $this->setSqlOrder();
    $this->setSql( $this->getSqlConditions() );
    $this->loadPage( $this->getSql() );
  	$stmt = $this->DB->query( $this->getSql() . $this->sql_order . ' LIMIT ' . $this->from . ',' . $this->rows_per_view );
  	if((int)$stmt) {
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
      foreach ( $rows as $k => $v ) {
        $event = new Event();
  	    $event->fromArray($v);
  	    $this->items[] = $event;
      }
  	}
  }
}
?>