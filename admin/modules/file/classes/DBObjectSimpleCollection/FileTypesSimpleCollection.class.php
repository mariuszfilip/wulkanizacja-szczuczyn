<?php
/**
 * SmartSystem v.4
 *
 * @package smartsystem.file
 */


/**
 * Kolekcja typów plików
 *
 * @package smartsystem.banner
 */
class FileTypesSimpleCollection extends DBObjectsSimpleCollection {

  protected function getSql() {
    return $this->sql;
  }

  protected function load() {

 	  $sql = 'SELECT * FROM `file_types`
  	        ORDER BY `name` ASC';

  	$stmt = $this->DB->query( $sql );
  	if((int)$stmt) {
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  	    $fileType = new FileType();
  	    $fileType->fromArray($row);
  	    $this->items[] = $fileType;
      }
  	}
  }
  public function getAll() {
    $types_arr = array();
  	$sql = 'SELECT *
  	        FROM `file_types`
  	        ORDER BY `name` ASC';
  	$stmt = $this->DB->query($sql);
  	if( (int)$stmt && $row = $stmt->fetchAll(PDO::FETCH_ASSOC) ) {
      foreach ( $row as $r => $v ) {
        $types_arr[ $v['id_file_type'] ]['name'] = $v['name'];
        $types_arr[ $v['id_file_type'] ]['id_file_type'] = $v['id_file_type'];
				$types_arr[ $v['id_file_type'] ]['extension'] = $v['extension'];
        $types_arr[ $v['id_file_type'] ]['mime'] = $v['mime'];
      }
  	}
  	return $types_arr;
  }
}
?>