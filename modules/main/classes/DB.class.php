<?php
/**
 * SmartSystem v.5
 *
 * @package smartsystem
 */


/**
 * Klasa reprezentujaca połączenie z baza danych. Oparta jest na wzorcu
 * projektowym singleton.
 *
 * @package smartsystem
 */
class DB extends MyPDO {

  /**
   * Atrybut trzymający instancje obiekty klasy DB.
   *
   * @var DB
   * @access private
   */
  private static $instance = null;

  /**
   * Trzyma liczbę zapytań
   *
   * @var integer
   */
  private static $count = 0;


  /**
   * Konstruktor.
   *
   * Zablokowane, żeby uniemożliwić tworzenie wielu instancji tej klasy.
   */
  public function __construct() {
  }

  /**
   * Klonuje obiekt - zablokowane
   */
  private function __clone() {}

  /**
	 * Zwraca połączenie z bazą danych.
   * @return DB - połączenie z bazą danych
   */
  public static function getInstance() {
    if(self::$instance == null) {
      $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
      if(DEBUG) {
        $atrr = array(
											MyPDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                      //MyPDO::ATTR_ERRMODE => MyPDO::ERRMODE_EXCEPTION,
                      MyPDO::MYSQL_ATTR_DIRECT_QUERY => true
                      );
      } else {
        $atrr = array(
											MyPDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
											MyPDO::MYSQL_ATTR_DIRECT_QUERY => true
											);
      }
      self::$instance = new MyPDO($dsn, DB_USER, DB_PASSWORD, $atrr);
    }
    return self::$instance;
 }

  public function query() {
    self::$count++;
    $args = func_get_args();
    return call_user_func_array(array($this, 'query'), $args);
  }

  public function exec() {
    self::$count++;
    $args = func_get_args();
    return call_user_func_array(array($this, 'exec'), $args);
  }

  public function getCount() {
  	return self::$count;
  }

}
?>