<?php
/**
 * SmartSystem v.4
 *
 * @package smartsystem
 */


/**
 * Żądanie HTTP.
 *
 * Zawiera parametry $_POST i $_GET.
 *
 * @package smartsystem
 */
class Request {

  /**
   * Parametry żądania.
   *
   * @var array
   */
  private $parameters  = array();


  /**
   * Konstruktor.
   *
   * Łączy tablice $_GET i $_POST.
   */
  public function __construct() {
    $this->parameters = array_merge($_POST, $_GET);
  }

  /**
   * Pobiera parametr z żądania.
   *
   * Jeśli parametr nie istnieje to zostanie zwrócona wartośc null.
   *
   * @param string $name - nazwa parametru żądania
   * @return string - parametr żądania
   */
  public function getParameter($name) {
  	if(array_key_exists($name, $this->parameters)) {
  	  return $this->parameters[$name];
  	} else {
  	  return null;
  	}
  }

  /**
   * Dodaje parametr do żądania.
   *
   * Jeśli istnieje już parametr o podanej nazwie to zostanie nadpisany.
   *
   * @param string $name - nazwa parametru
   * @param string $value - wartość parametru
   */
  public function addParameter($name, $value) {
    $this->parameters[$name] = $value;
  }

}


?>