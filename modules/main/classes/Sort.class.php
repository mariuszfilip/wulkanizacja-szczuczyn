<?php
/**
 * Klasa dziala z plikiem z sort.tpl
 *
 */
class Sort {

  protected $sort_arr = array();
  protected $sort;
  protected $sortdir;

  function setSort( $_dane ) {
    foreach( $_dane as $k => $v ) {
      $this -> sort_arr[ $k ] = $v;
    }
  }

  function setPath( $val ){
    $this -> path = $val;
  }

  function getSort() {
    $a = array();
    $a[ 'sort' ] = $this -> sort;
    $a[ 'sortdir' ] = $this -> sortdir;
    foreach( $this -> sort_arr as $k => $v ){
      $a[ 'value' ][ $k ] = $v;
    }
    return $a;
  }

  function setSortParam( $_param ){
    $this -> sort = $_param[ 'sort' ];
    $this -> sortdir = $_param[ 'sortdir' ];
  }

  function getSortParam(){
    return array( 'sort' => $this -> sort, 'sortdir' => $this->sortdir  );
  }

}
?>