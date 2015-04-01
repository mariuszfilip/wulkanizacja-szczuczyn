<?php
/**
 * SmartSystem v.4
 *
 * @package smartsystem.otherpage
 */


/**
 * Kolekcja otherpageów systemu
 *
 * @package smartsystem.otherpage
 */
class OtherPagesCollection extends DBObjectsCollection {

  protected $sql = '';
  protected $sql_conditions = '';
  protected $sql_order = '';
  protected $s = null;
  
  protected function setSql( $_sql_conditions = '') {
    // $this->sql = 'SELECT * FROM otherpage  	        WHERE otherpage.deleted=\'N\' ' . $_sql_conditions . '';
    $this->sql = 'SELECT * FROM `otherpage` LEFT JOIN `content_by_language` ON ( `otherpage`.`key_title` = `content_by_language`.`key` )
                  WHERE `otherpage`.`deleted`=\'N\' ' . $_sql_conditions . ' GROUP BY `otherpage`.`id_otherpage` ';
  }
  
  protected function getSql() {
    return $this->sql;
  }

  protected function setSqlConditions( $s_arr ) {
    if( trim( $s_arr['name'] ) != '' ) {
      $this->sql_conditions .= 'AND `name` LIKE \'%' . $s_arr['name'] . '%\'';
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
    if( $s->is_set( 's_otherpage' ) ) {
      $this->setSqlConditions( $s->getAttribute( 's_otherpage' ) );
    }
    $this->setSqlOrder( $s->getAttribute( 'sort_otherpage' ) );
    $this->setSql( $this->getSqlConditions() );
    $this->loadPage( $this->getSql() );
//    echo $this->getSql() . $this->sql_order . ' LIMIT ' . $this->from . ',' . $this->rows_per_view;
  	$stmt = $this->DB->query( $this->getSql() . $this->sql_order . ' LIMIT ' . $this->from . ', ' . $this->rows_per_view );
  	if((int)$stmt) {
      $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
      for( $i=0; $i < count($rs);$i++ ){
        $otherpage = new OtherPage();
  	    $otherpage->fromArrayPlus($rs[$i]);
  	    $this->items[] = $otherpage;
      }
  	}
  }
}
?>