<?php
/**
 * SmartSystem v.5
 *
 * @package smartsystem
 */


/**
 * Klasa reprezentujaca sesję
 *
 * Oparta jest na wzorcu projektowym singleton. Jest nakładką na sesje w PHP.
 *
 * @package smartsystem
 */
class Session {

  /**
   * Instancja klasy Session
   *
   * @var Session
   */
  private static $instance = null;


  /**
   * Konstruktor.
   *
   * Zablokowane, żeby uniemożliwić tworzenie wielu instancji tej klasy.
   */
  private function __construct() {
		session_name(str_replace('.','',ADMIN_DIR));
    session_start();
		if (isset($_SESSION['protected'])) {
			if ($_SESSION['protected']!= md5($_SERVER['REMOTE_ADDR'])) {
				$this->destroy();
				exit('Hack attempt!');
			}
		} else {
			$_SESSION['protected']= md5($_SERVER['REMOTE_ADDR']);
		}
		
  }

  /**
   * Klonowanie
   *
   * Klonuje obiekt - zablokowane.
   */
  private function __clone() {
  }

  /**
   * Zwraca instancję sesji
   *
   * @return Session - sesja
   */
  public static function getInstance() {
    if(self::$instance == null) {
      self::$instance = new self;
    }
    return self::$instance;
  }

  /**
   * Ustawia atrybut w sesji
   *
   * @param string $name
   * @param mixed $value
   */
  public function setAttribute($name, $value) {
  	$_SESSION[$name] = $value;
  }

  /**
   * Usuwa atrybut z sesji
   *
   * @param string $name
   */
  public function unsetAttribute($name) {
    unset($_SESSION[$name]);
  }

  /**
   * Pobiera atrybut z sesji
   *
   * @param string $name
   * @return mixed
   */
  public function getAttribute($name) {
    return $_SESSION[$name];
  }
  
  /**
   * Sprawdza czy dana sesja jest ustawiona
   *
   * @param string $name
   * @return unknown
   */
  public function is_set($name) {
    if( isset($_SESSION[$name]) ) {
      return 1;
    } else {
      return 0;
    }
  }
  
  public function destroy() {
  	if(self::$instance != null) {
		session_unset();
		session_destroy(); 
	}
  }
  
}
?>