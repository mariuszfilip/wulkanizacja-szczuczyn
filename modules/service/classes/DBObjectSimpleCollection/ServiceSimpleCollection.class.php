<?php
/**
 * SmartSystem v.5
 *
 * @package smartsystem.service
 */

class ServiceSimpleCollection extends DBObjectsSimpleCollection {

  protected $id_catalog = 0;
	
  public function __construct($id_catalog=0) {
		if($id_catalog > 0){
			$this->id_catalog = $id_catalog;
			$this->DB = DB::getInstance();
			$this->load();
		}
  }

  protected function load() {
  	$sql = 'SELECT *
  	        FROM `service`
  	        WHERE `service`.`deleted`=\'N\'
			AND `service`.`active` =\'Y\'
			AND `service`.`id_catalog`=\''.$this->id_catalog.'\'
  	        ORDER BY `service`.`name` ASC';
  	$stmt = $this->DB->query($sql);
  	if($stmt) {
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  	    $service = new Service();
  	    $service->fromArray($row);
  	    $this->items[] = $service;
      }
	  $stmt->closeCursor();
	  return $this->items;
  	}
  }

}
?>