<?php
/**
 * SmartSystem v.5
 *
 * @package smartsystem.operator
 */


/**
 * Kolekcja operatorów systemu
 *
 * @package smartsystem.operator
 */
class OperatorsSimpleCollection extends DBObjectsSimpleCollection {

  protected function load() {
  	$sql = 'SELECT *
  	        FROM `operator`
  	        WHERE `deleted`=\'0\'
  	        ORDER BY `operator_id` ASC';
  	$stmt = $this->DB->query($sql);
  	if($stmt) {
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