<?php
/**
 * SmartSystem v.5
 *
 * @package smartsystem
 */


/**
 * Abstrakcyjna kolekcja obiektów bazodanowych. Jest to kolekcja bez stronicowania.
 *
 * @package smartsystem
 */
abstract class DBObjectsSimpleCollection {

  protected $items = array();
  protected $DB    = null;

  public function __construct() {
    $this->DB = DB::getInstance();
    $this->load();
  }
  
  public function toArray() {
    $r = array();
  	for($i=0, $j=count($this->items); $i<$j; $i++) {
  	  if ($this->items[$i] instanceof DBObject) {
  	  	$r[$i] = $this->items[$i]->toArray();
  	  }
  	}
  	return $r;
  }

  abstract protected function load();

}
?>