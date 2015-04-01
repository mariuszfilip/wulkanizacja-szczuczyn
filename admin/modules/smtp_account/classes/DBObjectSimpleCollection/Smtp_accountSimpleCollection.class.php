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
class Smtp_accountSimpleCollection extends DBObjectsSimpleCollection {

  protected function load() {
  	$sql = 'SELECT *
  	        FROM `smtp_account`
  	        WHERE `deleted`=\'N\'
  	        ORDER BY `id_smtp_account` ASC';
  	$stmt = $this->DB->query($sql);
  	if($stmt) {
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  	    $smtp_account = new Smtp_account();
  	    $smtp_account->fromArray($row);
  	    $this->items[] = $smtp_account;
      }
	  $stmt->closeCursor();
	  return $this->items;
  	}
  }

}

?>