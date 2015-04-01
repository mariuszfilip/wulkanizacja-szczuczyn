<?php
/**
 * SmartSystem v.4
 *
 * @package smartsystem.operator
 */


/**
 * Kolekcja operatorów systemu
 *
 * @package smartsystem.operator
 */
class PhotosSimpleCollection extends DBObjectsSimpleCollection {
  protected $id_gallery;
  
  public function __construct( $id_gallery ) {
    $this->id_gallery = $id_gallery;
    parent::__construct();
  }
  
  protected function load() {
  	$sql = 'SELECT *
  	        FROM `photo`
  	        WHERE `deleted`=\'N\' AND `id_gallery`='.$this->id_gallery.'
  	        ORDER BY `position`';
			
  	$stmt = $this->DB->query($sql);
  	if($stmt) {
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  	    $photo = new Photo();
  	    $photo->fromArray($row);
  	    $this->items[] = $photo;
      }
      $stmt->closeCursor();
	  //print_r($this->items);
  	}
  }
}
?>