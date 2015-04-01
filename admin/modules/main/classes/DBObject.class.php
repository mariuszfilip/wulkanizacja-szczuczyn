<?php
/**
 * SmartSystem v.4
 *
 * @package smartsystem
 */


/**
 * Abstrakcyjny obiekt reprezentujący rekord w bazie danych.
 *
 * @package smartsystem
 */
abstract class DBObject {

  protected $id = 0;
  protected $added;
  protected $modified;
  protected $active  = false;
  protected $deleted = false;


  public function __construct($id = 0) {
    $this->id = $id;
  }

  public function getID() {
    return $this->id;
  }

  public function setID($id) {
    $this->id = $id;
  }

  public function getAdded() {
  	return $this->added;
  }

  public function setAdded($added) {
  	$this->added = $added;
  }

  public function getModified() {
  	return $this->modified;
  }

  public function setModified($modified) {
  	$this->modified = $modified;
  }

  public function getActive() {
  	return $this->active;
  }

  public function setActive($active) {
  	$this->active = $active;
  }

  public function getDeleted() {
  	return $this->deleted;
  }

  public function setDeleted($deleted) {
  	$this->deleted = $deleted;
  }

  public function toArray() {
  	$r = array();
  	$properties = get_object_vars($this);
  	foreach($properties as $key => $value) {
	    $r[$key] = $this->$key;
  	}
  	return $r;
  }

  public function fromArray($array) {
    if(is_array($array)) {
      foreach($array as $key => $value) {
        $this->$key = $value;
      }
    }
  }

  abstract public function save();

  abstract public function delete();

  abstract public function validate();

}


?>