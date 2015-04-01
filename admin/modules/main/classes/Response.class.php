<?php
/**
 * SmartSystem v.4
 *
 * @package smartsystem
 */


/**
 * Odpowiedź HTTP.
 *
 * Zawiera parametry przekazywane w odpowiedzi na żądanie HTTP.
 *
 * @package smartsystem
 */
class Response {

  /**
   * Parametry
   *
   * @var array
   */
  protected $parameters  = array();


  /**
   * Konstruktor.
   *
   */
  public function __construct() {
  }

  /**
   * Pobiera parametr z odpowiedzi.
   *
   * Jeśli parametr nie istnieje to zostanie zwrócona wartośc null.
   *
   * @param string $name - nazwa parametru odpowiedzi
   * @return string - parametr odpowiedzi
   */
  public function getParameter($name) {
  	if(array_key_exists($name, $this->parameters)) {
  	  return $this->parameters[$name];
  	} else {
  	  return null;
  	}
  }

  /**
   * Dodaje parametr do odpowiedzi
   *
   * Jeśli istnieje już parametr o podanej nazwie to zostanie nadpisany.
   *
   * @param string $name - nazwa parametru
   * @param string $value - wartość parametru
   */
  public function addParameter($name, $value) {
    $this->parameters[$name] = $value;
  }

  /**
   * Zwraca parametry odpowiedzi jako tablice
   *
   * @return array
   */
  public function toArray() {
    return $this->parameters;
  }

}

?>