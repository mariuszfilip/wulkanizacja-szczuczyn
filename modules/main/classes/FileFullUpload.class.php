<?php
class FileFullUpload {
protected $file = '';
  protected $file_name = '';
  protected $directory = '';
  protected $size = 0;
  protected $type = '';
  protected $tmp_name;
  protected $error;
  protected $ext_arr = array();
// z DBObject
  protected $id = 0;
  protected $added;
  protected $modified;
  protected $active  = false;
  protected $deleted = false;

  

  public function __construct( $directorty, $file, $ext_arr = array('php','htaccess') ) {
    $this->file = $file;
    $this->directory = $directorty;
    $this->ext_arr = $ext_arr;

    if(is_uploaded_file( $_FILES[$this->file]['tmp_name'] ) && $_FILES[$this->file]['error'] == UPLOAD_ERR_OK)
    {

		$file_name_arr = explode('.', $_FILES[$this->file]['name']);
		if(is_array($file_name_arr))
		{
			$this->type = strtolower( $file_name_arr[count($file_name_arr)-1] );
			
			 if( in_array( $this->type, $this->ext_arr )) {
				 return false;
			 }
		}else{
			return false;
		}		

		$plik_nazwa_1_name = strtolower($file_name_arr[0]);	
		$plik_nazwa_1_name = String::toModerewrite($plik_nazwa_1_name);	
		$plik_nazwa_1 = date("YmdHis").'_'.$plik_nazwa_1_name.'.'.$this->type;
	
		$this->file_name= $plik_nazwa_1;
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
    $this->ext_arr = $type_array;
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
    if( in_array( $this->type, $this->ext_arr )) {
      return 0;//throw new Exception('Przesłany plik nie jest wskazanego typu');
    } else {
      if(is_dir( $this->directory ) ) {
        if( move_uploaded_file( $_FILES[$this->file]['tmp_name'], $this->directory . $this->file_name ) ){
          return 1;
        } else {
          return 0;//throw new Exception('Plik nie został przeniesiony');
        }
      } else {
        return 0;//throw new Exception('Podana ścieżka nie jest katalogiem');
      }
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
  
}
?>