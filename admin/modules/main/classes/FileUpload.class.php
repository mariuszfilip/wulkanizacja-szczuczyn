<?php
class FileUpload {
  protected $file = '';
  protected $file_name = '';
  protected $directory = '';
  protected $size = 0;
  protected $type = '';
  protected $tmp_name;
  protected $error;
  protected $type_arr = array();
// z DBObject
  protected $id = 0;
  protected $added;
  protected $modified;
  protected $active  = false;
  protected $deleted = false;

  /**
   * Konstruktor klasy File
   *
   * @param string $directorty
   * @param string nazwa inputa $file
   */
  
  /**
   * Stara wersja do 04.08.2008
   * 
   */

  /*
  public function __construct($directorty, $file, array $type_arr) {
    $this->file = $file;
    $this->directory = $directorty;
    $this->type_arr = $type_arr;

    if(is_uploaded_file( $_FILES[$this->file]['tmp_name'] ) && $_FILES[$this->file]['error'] == UPLOAD_ERR_OK) {
      $this->file_name= time().'_'.$_FILES[$this->file]['name'];

      //usuwam_polskie znaki
			$this->file_name = String::toModerewrite($this->file_name);

      $this->size     = $_FILES[$this->file]['size'];
			$this->type     = $_FILES[$this->file]['type'];
      $this->tmp_name = $_FILES[$this->file]['tmp_name'];
      $this->error    = $_FILES[$this->file]['error'];

      return true;
    } else {
      return false;
    }
  }
  */
  

  public function __construct( $directorty, $file, array $type_arr = array('image/jpeg','image/pjpeg','image/png','image/x-png','image/gif') ) {
    $this->file = $file;
    $this->directory = $directorty;
    $this->type_arr = $type_arr;

    if(is_uploaded_file( $_FILES[$this->file]['tmp_name'] ) && $_FILES[$this->file]['error'] == UPLOAD_ERR_OK)
    {
    	/** 
    	*	poprzedni sposob generowania nazw w sposob losowy 
    	* 	z wykorzystaniem md5() i microtime(), linia 46-48.
    	*/

        //$plik_nazwa = md5(microtime()) . substr($_FILES[$this->file]['name'], strrpos($_FILES[$this->file]['name'], '.'));
    	//$plik_nazwa = substr($plik_nazwa,20,16);
    	//echo $plik_nazwa;

   		/**
   		 * Generowanie nazwy pliku bez kodowania, jedynie bez polskich znakow diaktrycznych i spacji, 
   		 * kropek, przeczinkow, myslnikow. Dodatkowo wielkie litery zamieniane na male.
   		 */

	$plik_nazwa_1_format = substr($_FILES[$this->file]['name'], strrpos($_FILES[$this->file]['name'], '.'));
    $plik_nazwa_1_name = substr($_FILES[$this->file]['name'],0,-4);

    // Zamiana na male litery.
    $plik_nazwa_1_name = strtolower($plik_nazwa_1_name);

    // Usuniecie spacji, przecinkow, myslnikow, kropek.
    $plik_nazwa_1_name = str_replace(" ","_",$plik_nazwa_1_name);
    $plik_nazwa_1_name = str_replace(",","_",$plik_nazwa_1_name);
    $plik_nazwa_1_name = str_replace(".","_",$plik_nazwa_1_name);
    $plik_nazwa_1_name = str_replace("-","_",$plik_nazwa_1_name);


    // Usuniecie polskich znakow diaktrycznych.

    $pl = array('Ę','Ó','Ą','Ś','Ł','Ż','Ź','Ć','Ń','ę','ó','ą','ś','ł','ż','ź','ć','ń');
	$notpl = array('E','O','A','S','L','Z','Z','C','N','e','o','a','s','l','z','z','c','n');

	$plik_nazwa_1_name = str_replace($pl,$notpl,$plik_nazwa_1_name);
    $plik_nazwa_1_format = strtolower($plik_nazwa_1_format);

    $plik_nazwa_1 = date("YmdHis").'_'.$plik_nazwa_1_name.$plik_nazwa_1_format;

    //echo $plik_nazwa_1;



		$this->file_name= $plik_nazwa_1;
//    	$this->file_name= $_FILES[$this->file]['name'];
    	$this->size     = $_FILES[$this->file]['size'];
   		$this->type     = $_FILES[$this->file]['type'];
    	$this->tmp_name = $_FILES[$this->file]['tmp_name'];
    	$this->error    = $_FILES[$this->file]['error'];
      	return true;
    }
    else
    {
    	return false;
    }
  }



  function setTypeArray( array $type_array ) {
    $this->type_arr = $type_array;
  }

  public function getType() {
  	return $this->type;
  }

  /**
   * Przenosi plik to wskazanego w konstruktorze katalogu,
   * jesli podany katalog istnieje i jest typu wskazanego w tablicy $type_arr
   *
   */
  public function move() {

    if( in_array( $this->type, $this->type_arr )) {
      if(is_dir( $this->directory ) ) {
        if( move_uploaded_file( $_FILES[$this->file]['tmp_name'], $this->directory . $this->file_name ) ){
          return 1;
        } else {
          return 0;//throw new Exception('Plik nie został przeniesiony');
        }
      } else {
        return 0;//throw new Exception('Podana ścieżka nie jest katalogiem');
      }
    } else {
      return 0;//throw new Exception('Przesłany plik nie jest wskazanego typu');
    }
  }

  public function setFileName( $file_name ) {
    $this->file_name = $file_name;
  }

  public function getFileName() {
    return $this->file_name;
  }

  public function setDirectory( $directory ) {
    $this->directory = $directory;
  }

  public function getDirectory() {
    return $this->directory;
  }
  public function getSize() {
    return $this->size;
  }

  // z DBObject
  /*
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
  */
/*
  abstract public function save();

  abstract public function delete();

  abstract public function validate();
*/
}
?>