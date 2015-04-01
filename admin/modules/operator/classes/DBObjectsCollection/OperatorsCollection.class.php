<?php
class OperatorsCollection extends DBObjectsCollection {

  protected $sql = '';
  protected $sql_conditions = '';
  protected $sql_order = '';
  protected $s = null;
  
  protected function setSql( $_sql_conditions = '') {
    $this->sql = 'SELECT * FROM `operator`
  	        WHERE `deleted`=\'N\' ' . $_sql_conditions . '';
  }
  
  protected function getSql() {
    return $this->sql;
  }

  protected function setSqlConditions( $s_arr ) {

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
    if( $s->is_set( 's_operator' ) ) {
      $this->setSqlConditions( $s->getAttribute( 's_operator' ) );
    }
    $this->setSqlOrder( $s->getAttribute( 'sort_operator' ) );
    $this->setSql( $this->getSqlConditions() );
    $this->loadPage( $this->getSql() );
//    echo $this->getSql() . $this->sql_order . ' LIMIT ' . $this->from . ',' . $this->rows_per_view;
  	$stmt = $this->DB->query( $this->getSql() . $this->sql_order . ' LIMIT ' . $this->from . ', ' . $this->rows_per_view );
  	if((int)$stmt) {
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  	    $operator = new Operator();
  	    $operator->fromArray($row);
  	    $this->items[] = $operator;
      }
	  $stmt->closeCursor();
  	}
  }
  
}
?>