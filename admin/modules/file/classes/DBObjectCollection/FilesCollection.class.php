<?php
/**
 * SmartSystem v.4
 *
 * @package smartsystem.file
 */


/**
 * Kolekcja plików systemu
 *
 * @package smartsystem.file
 */
class FilesCollection extends DBObjectsCollection {

  protected $sql = '';
  protected $sql_conditions = '';
  protected $sql_order = '';
  protected $s = null;

  protected function setSql( $_sql_conditions = '') {
    $this->sql = 'SELECT * FROM `file`
  	        WHERE 1 ' . $_sql_conditions . '';
  }

  protected function getSql() {
    return $this->sql;
  }

  protected function setSqlConditions( $s_arr ) {
    if( trim( $s_arr['name'] ) != '' ) {
      $this->sql_conditions .= ' AND `name` LIKE \'%'.$s_arr['name'].'%\'';
    }
    if( trim( $s_arr['file_name'] ) != '' ) {
      $this->sql_conditions .= ' AND `file_name` LIKE \'%'.$s_arr['file_name'].'%\'';
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
    if( $s->is_set( 's_file' ) ) {
      $this->setSqlConditions( $s->getAttribute( 's_file' ) );
    }
    $this->setSqlOrder( $s->getAttribute( 'sort_file' ) );
    $this->setSql( $this->getSqlConditions() );
    $this->loadPage( $this->getSql() );
  	$stmt = $this->DB->query( $this->getSql() . $this->sql_order . ' LIMIT ' . $this->from . ', ' . $this->rows_per_view );
  	if((int)$stmt) {
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $row) {
      	$file = new File();
  	    $file->fromArray($row);
		$file->setVideo();
  	    $this->items[] = $file;
      }
//	   	$stmt->closeCursor();

  	}
  }

}
?>