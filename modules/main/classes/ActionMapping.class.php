<?php
/**
 * SmartSystem v.5
 *
 * @package smartsystem
 */


/**
 * Prosty mapper, który na podstawie głównego parametru żądania HTTP określa
 * która akcja ma zostać wywołana.
 *
 * Klasa korzysta z pliku core/mapping.inc.php w którym zapisane są powiązania
 * akcji z parametrem żądania.
 *
 * @package smartsystem
 */
class ActionMapping {

  static public $DEFAULT_ACTION = 'DefaultAction';


  public static function find($name) {
    include_once(ROOT_DIR . 'core/mapping.inc.php');
    $action = self::$DEFAULT_ACTION;
    if($name != '') {
      if(isset($mapping[$name])) {
        $action = $mapping[$name];
      }
    }
    return $action;
  }

}
?>