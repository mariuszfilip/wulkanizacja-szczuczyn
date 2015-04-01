<?php

class UploadedFile {

  protected $file;
  protected $name;
  protected $size;
  protected $type;
  protected $tmp_name;
  protected $error;

  public function __construct($file) {
    $this->file = $file;
    echo $this->name;
    if(is_uploaded_file( $_FILES[$this->file]['tmp_name'] ) && $_FILES[$this->file]['error'] == UPLOAD_ERR_OK) {
      $this->name     = $_FILES[$this->file]['name'];
      $this->size     = $_FILES[$this->file]['size'];
      $this->type     = $_FILES[$this->file]['type'];
      $this->tmp_name = $_FILES[$this->file]['tmp_name'];
      $this->error    = $_FILES[$this->file]['error'];
    } else {
      throw new Exception('Plik nie wgrany');
    }
  }

  public function moveTo($path) {
  	return move_uploaded_file( $_FILES[$this->file]['tmp_name'], $path . $this->name );
  }

  public function getName() {
  	return $this->name;
  }
  public function getSize() {
  	return $this->size;
  }
  public function getType() {
  	return $this->type;
  }
}


?>