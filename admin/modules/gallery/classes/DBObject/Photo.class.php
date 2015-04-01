<?php
/**
 *
 * SmartSystem v.5
 *
 * @package smartsystem.photo
 */


/**
 * Obiekt bazodanowy odpowiadający photo
 *
 * @package smartsystem.photo
 */
class Photo extends DBObject {

  protected $id_photo     = 0;
  protected $id_gallery   = 0;
  protected $size  			  = 0;
  protected $width   			= 0;
  protected $height  			= 0;
  protected $name         = '';
  protected $file_name    = '';
  protected $path         = '';
  protected $description  = '';
  protected $file         = null;


  public function __construct($id = 0) {
  	$this->id         = $id;
  	$this->id_photo = $id;
    $this->load();
  }

  private function load() {
  	if($this->id > 0) {
    	$sql = 'SELECT *
    	        FROM `photo`
    	        WHERE `deleted` = \'N\'
    	        AND `id_photo` = \'' . $this->id . '\'';
      $DB = DB::getInstance();
      $stmt = $DB->query($sql);
      if((int)$stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $this->id           = $rs['id_photo'];
        $this->id_photo     = $rs['id_photo'];
        $this->id_gallery   = $rs['id_gallery'];
        $this->name         = $rs['name'];
        $this->file_name    = $rs['file_name'];
        $this->description  = $rs['description'];
        $this->size  				= $rs['size'];
        $this->width  			= $rs['width'];
        $this->height			  = $rs['height'];
        $this->added        = $rs['added'];
        $this->modified     = $rs['modified'];
        $this->deleted      = $rs['deleted'];
        $this->active       = $rs['active'];
      }
      $stmt->closeCursor();
  	}
  }

  public function getDescription() {
  	return $this->description;
  }
  
  public function getFileName() {
  	return $this->file_name;
  }
  
  
  public function getWidth() {
  	return $this->width;
  }
  
  public function getHeight() {
  	return $this->height;
  }

  public function setDescription($description) {
  	$this->description = $description;
  }

  public function setIdGallery( $id_gallery ) {
    $this->id_gallery = $id_gallery;
  }

  public function getIdGallery() {
    return $this->id_gallery;
  }
  
  public function getId() {
    return $this->id;
  }

  public function save() {
    $errors = $this->validate();
    $result = 0;
    if(empty($errors)) {
      if($this->id > 0) {
        $result = $this->modify();
      } else {
        $result = $this->add();
      }
    } else {
      $_SESSION['errors'] = $errors;
    }
    return $result;
  }

  public function add($path,$files,$ext_array) {
    $this->path = $path;
    $result = 0;
    $file = new FileFullUpload($path,$files,$ext_array);
    $this->file_name = $file->getFileName();
    $this->size = $file->getSize();


    if( $file->move() ) {
      $DB = DB::getInstance();
      //ustawiam width i height po przeniesieniu pliku
      $sizeArray 		= getimagesize($path.$this->file_name);
			$this->width 	= $sizeArray[0];
			$this->height = $sizeArray[1];			
			
	  $sql = 'SELECT MAX( `position` ) AS maksimum
						FROM `photo`
            WHERE `id_gallery`='.$this->id_gallery;
    $stmt = $DB->query( $sql );
	if((int)$stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) 
   		{
       		$this->maksimum = $rs['maksimum']+1;
       		$stmt->closeCursor();
   		}

      $sql = 'INSERT INTO `photo` SET
													`id_gallery`=\'' . $this->id_gallery . '\',
													`name`=\'' . $_POST['name'] . '\',
													`file_name`=\'' . $this->file_name . '\',
													`path`=\'' . $this->path . '\',
													`size`=\'' . $this->size . '\',
													`width`=\'' . $this->width . '\',
													`height`=\'' . $this->height . '\',
													`position`=\'' . $this->maksimum . '\',
													`added`=CURRENT_TIMESTAMP,
													`active`=\'Y\',
													`description`=\'' . $_POST['description']. '\'';
      $result = $DB->exec($sql);
      if($result) {
        $_SESSION['message'] = 'Dane zostały dodane';
      }
      $this->id = $DB->lastInsertId();
    } else {
      $result = 0;
    }
    return $result;
  }

  public function validate() {
    $errors = array();
    if($this->name == '') {
      $errors['name'] = 'Nazwa zdjecia jest wymagana';
    }
    return $errors;
  }

  public function delete() {
   $sql = 'DELETE FROM `photo`
            WHERE `id_photo`=\'' . $this->id . '\'';

    $DB = DB::getInstance();
    $r = $DB->exec($sql);
    if($r) {
    	//trzeba jeszcze przeciez plik z dysku wywalić
    	@unlink('../files/photo/'.$this->file_name);
      $_SESSION['message'] = 'Dane zostały usunięte';
    }
    return $r;
  }
  
  public function update_desc($value) {

    $sql = 'UPDATE `photo`
                           SET `description`=\''.$value.'\'
            WHERE `id_photo`=\'' . $this->id . '\'';

    $DB = DB::getInstance();
    $r = $DB->exec($sql);
    return $r;
  }
  
  public function update_name($value) {

    $sql = 'UPDATE `photo`
                           SET `name`=\''.$value.'\'
            WHERE `id_photo`=\'' . $this->id . '\'';

    $DB = DB::getInstance();
    $r = $DB->exec($sql);
    return $r;
  }

	public function toArray() {
		$r = parent::toArray();
		$r['sizek'] = $this->size/1024;
		return $r;
	}


	public function change_position($value) {
		$sql = 'UPDATE `photo`
            SET `position`=\''.$value.'\'
            WHERE `id_photo`=\'' . $this->id . '\'';
    	$DB = DB::getInstance();
    	$r = $DB->exec($sql);
    	if($r)$_SESSION['message'] = 'Zmiany zostały zachowane';
  }
  

	public function move_it($id_gallery, $dir)
	{
	 	$query = "SELECT * FROM `photo` WHERE `id_gallery` = '".$id_gallery."'  ORDER BY `position` ".$dir."";


		$DB = DB::getInstance();
		$stmt = $DB->query($query);

  		if((int)$stmt && $rs = $stmt->fetchAll(PDO::FETCH_ASSOC)) 
   		{
   			$stmt->closeCursor();

   			foreach($rs as $value)
   			{ 
   				if($last_id && $value['id_photo'] == $this->id)
   				{
   				 	$sql_1 = "UPDATE `photo` SET `position` = '".$value['position']."' WHERE `id_photo` = '".$last_id."'";
   					//echo $sql_1.'<br>';
					$result_1 = $DB->exec($sql_1);

            	 	$sql_2 = "UPDATE `photo` SET `position` = '".$last_sort."' WHERE `id_photo` = '".$value['id_photo']."'";
            		//echo $sql_2;
            		$result_2 = $DB->exec($sql_2);
					break ;
   				}
        		$last_id = $value['id_photo'];
        		$last_sort = $value['position'];
   			}
   		}
	}

}
?>