<?php
/**
 * SmartSystem v.5
 *
 * @package smartsystem.module
 */


/**
 * Kolekcja modułów
 *
 * @package smartsystem.module
 */
class ModuleSimpleCollection extends DBObjectsSimpleCollection {

  protected function load() {
  	$sql = 'SELECT *
  	        FROM `module`
						WHERE `admin_only` <> \'Y\'
  	        ORDER BY `order` ASC';
  	$stmt = $this->DB->query($sql);
  	if($stmt) {
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  	    $module = new Module();
  	    $module->fromArray($row);
  	    $this->items[] = $module;
      }
	  $stmt->closeCursor();
  	}
  }

}

?>