<?php
/**
 * SmartSystem v.4
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
    $this->sql = 'SELECT * FROM `event`
  	        WHERE `deleted`=\'N\' ' . $_sql_conditions . '';
  }
  
  protected function getSql() {
    return $this->sql;
  }

  protected function setSqlConditions( $s_arr = array() ) {
    $s = Session::getInstance();
    $lang = $s->getAttribute('lang');
    $this->sql_conditions .= 'AND `language`=\''. $lang .'\'';
    if( $s_arr[ 'title' ] != '' ) {
      $this->sql_conditions .= 'AND `title` LIKE \'%'. $s_arr[ 'title' ] .'%\'';
    }
    if( $s_arr[ 'active' ] == 'N' || $s_arr[ 'active' ] == 'Y' ) {
      $this->sql_conditions .= 'AND `active`=\''. $s_arr[ 'active' ] .'\'';
    }
    if( $s_arr[ 'always' ] == 'N' ) {
      $this->sql_conditions .= 'AND `always`=\''. $s_arr[ 'always' ] .'\'';
    } elseif( $s_arr[ 'always' ] == 'Y' ) {
      $this->sql_conditions .= 'AND `always`=\''. $s_arr[ 'always' ] .'\'';
    } elseif( $s_arr['always'] == '' ){
      if( $s_arr[ 'date_from' ] != '') {
        $this->sql_conditions .= 'AND `date_from`>=\''. $s_arr[ 'date_from' ] .'\'';
      }
      if( $s_arr[ 'date_to' ] != '') {
        $this->sql_conditions .= 'AND `date_to`<=\''. $s_arr[ 'date_to' ] .'\'';
      }
    }
  }
  
  protected function setSqlOrder( $s_arr ) {
    if( isset( $s_arr['sort'] ) && !empty( $s_arr['sort'] ) ) {
      $this->sql_order = ' ORDER BY `' . $s_arr['sort'].'`';
      if( isset( $s_arr['sortdir'] ) && ! empty( $s_arr['sortdir'] ) ) {
        $this->sql_order .= ' ' . $s_arr['sortdir'];
      }
    }
  }
  
  protected function getSqlConditions() {
    return $this->sql_conditions;
  }

  protected function load() {
    $s = Session::getInstance();
    $this->setSqlConditions( $s->getAttribute( 's_event' ) );
    $this->setSqlOrder( $s->getAttribute( 'sort_event' ) );
    $this->setSql( $this->getSqlConditions() );
    $this->loadPage( $this->getSql() );
  	$stmt = $this->DB->query( $this->getSql() . $this->sql_order . ' LIMIT ' . $this->from . ', ' . $this->rows_per_view );
  	if((int)$stmt) {
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  	    $event = new Event();
  	    $event->fromArray($row);
  	    $this->items[] = $event;
      }
  	}
  	$stmt->closeCursor();
  }
  
}
?>