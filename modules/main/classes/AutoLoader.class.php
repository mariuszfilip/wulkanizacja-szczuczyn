<?php
/**
 * SmartSystem v.5
 *
 * @package smartsystem
 */


/**
 * Prosty autoloader
 *
 * Oparty na wzorcu singleton.
 *
 * @package smartsystem
 */
class AutoLoader {

  /**
   * Zakończenie nazw plików z klasami i interfejsami
   *
   * @var string
   */
  protected $fileSufix    = '.class.php';

  /**
   * Nazwa pliku z cache'm
   *
   * @var string
   */
  protected $cacheFile    = 'map_cache.ini.php';

  /**
   * Katalog do zapisywania pliku cache
   *
   * @var string
   */
  protected $cacheFileDir = 'var/cache/';

  /**
   * Scieżki do katalogu z plikami z klasami
   *
   * @var array
   */
  protected $classPaths = array(ROOT_CLASS_PATH);

  /**
   * Mapa klas
   *
   * @var array
   */
  protected $map = array();

  /**
   * Instancja AutoLoader'a
   *
   * @var AutoLoader
   */
  private static $instance = null;


  /**
   * Konstruktor
   */
  protected function __construct() {
  	$this->cacheFileDir = ROOT_DIR . $this->cacheFileDir;
    $this->getMap();
  }

  /**
   * Pobiera instancje klasy AutoLoader (Singleton)
   *
   * @return AutoLoader
   */
  public function getInstance() {
    if(self::$instance == null) {
      self::$instance = new self;
    }
    return self::$instance;
  }

  /**
   * Odczytuje mapę z cache
   *
   */
  protected function getMap() {
    if(file_exists($this->cacheFileDir . $this->cacheFile)) {
      $this->map = parse_ini_file($this->cacheFileDir . $this->cacheFile);
    } else {
      // Jeśli plik nie istnieje to generujemy nową mapę i zapisujemy
      $this->generateMap();
    }
  }

  /**
   * Automatycznie dołącza plik
   *
   * @param string $name
   */
  public function autoLoad($name) {
    if(array_key_exists($name, $this->map) && file_exists($this->map[$name])) {
      require($this->map[$name]);
    } else {
      $this->generateMap();
      if(array_key_exists($name, $this->map) && file_exists($this->map[$name])) {
        require($this->map[$name]);
      } else {
        throw new Exception('AutoLoad failed - file ' . $name . $this->fileSufix . ' not found');
      }
    }
  }

  /**
   * Generuje mapę i zapisuje do pliku
   *
   */
  protected function generateMap() {
    foreach($this->classPaths as $path) {
      $this->readDir($path);
    }
    $this->saveMap();
  }

  /**
   * Rekursyjnie odczytuje zawartość katalogu
   *
   * @param string $path
   */
  protected function readDir($path) {
    $dir = opendir($path);
    if($dir != false) {
      while (($file = readdir($dir)) !== false) {
        if(is_file($path . $file) && strstr($file, $this->fileSufix)) {
          $this->map[str_replace($this->fileSufix, '', $file)] = $path . $file;
        } elseif(is_dir($path . $file) && $file != '.' && $file != '..') {
          $this->readDir($path . $file . DIRECTORY_SEPARATOR);
        }
      }
      closedir($dir);
    } else {
      throw new Exception('Unable to read dir ' . $path);
    }
  }

  /**
   * Zapisuje zawartość mapy do pliku z cache
   *
   */
  protected function saveMap() {
    $str = '';
    $str = ";<?php die('Configuration file - strictly confidential!'); ?>\n";
    foreach($this->map as $key => $val) {
      $str .= $key .' = '. $val . "\n";
    }
    file_put_contents($this->cacheFileDir . $this->cacheFile, $str);
  }

}


/**
 * Automatycznie ładuje potrzebne pliki.
 *
 * Wywoływana jest automatycznie przez PHP.
 *
 * @param string $name
 */
function __autoload($name) {
	$loader = AutoLoader::getInstance();
	$loader->autoLoad($name);
}
?>