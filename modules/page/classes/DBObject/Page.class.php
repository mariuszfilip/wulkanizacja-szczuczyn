<?php
/**
 * SmartSystem v.5
 *
 * @package smartsystem.page
 */


/**
 * Obiekt bazodanowy odpowiadający stronie
 *
 * @package smartsystem.page
 */
class Page extends DBObject {

  protected $id_page      		= 0;
  protected $position		  		= '';
  protected $id_parent	  		= 0;
	protected $id_module  			= 0;
  protected $picture_height		= 0;
  protected $picture_width		= 0;
  protected $picture_size	  	= 0;
  protected $name         		= '';
  protected $introduction 		= '';
  protected $content		  		= '';
  protected $picture		  		= '';
  protected $active			  		= '';
  protected $added			  		= '';
  protected $modified		  		= '';
  protected $language		  		= '';
  protected $bottom_menu	  	= 'N';
  protected $meta_title		  	= '';
  protected $meta_description = '';
  protected $meta_keywords 		= '';
  protected $meta_robots			= '';
  protected $meta_last_modified = '';

  protected $addedFiles = array();


  public function __construct($id = 0) {
    $s = Session::getInstance();
		$this->language = $s->getAttribute('lang');
  	$this->id      = $id;
  	$this->id_page = $id;
    $this->load();
  }

  private function load() {
  	if($this->id > 0) {
   	$sql = 'SELECT *
    	        FROM `page`
    	        WHERE `id_page` = \'' . $this->id . '\'';
      $DB = DB::getInstance();
      $stmt = $DB->query($sql);
      if((int)$stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $this->id           				= $rs['id_page'];
        $this->id_page 							= $rs['id_page'];
        $this->id_parent						= $rs['id_parent'];
				$this->id_module						= $rs['id_module'];
        $this->name         				= $rs['name'];
				$this->introduction 				= $rs['introduction'];
				$this->content 							= $rs['content'];
				$this->picture 							= $rs['picture'];
				$this->picture_size 				= $rs['picture_size'];
				$this->picture_height				= $rs['picture_height'];
				$this->picture_width 				= $rs['picture_width'];
        $this->modified     				= $rs['modified'];
        $this->active       				= $rs['active'];
        $this->added        				= $rs['added'];
				$this->bottom_menu 					= $rs['bottom_menu'];
        $this->meta_title		 				= $rs['meta_title'];
				$this->meta_description 		= $rs['meta_description'];
        $this->meta_keywords	  		= $rs['meta_keywords'];
        $this->meta_last_modified	  = $rs['meta_last_modified'];
        $this->meta_robots	  			= $rs['meta_robots'];
        $stmt->closeCursor();
      }
  	
	if($this->id_parent>0){
		$parent_node = new PageNode($this->id_parent);
		$this->parent_parent_id = $parent_node->getIdParent();
	}
	
	}
  }


  public function getAddedFiles() {

  	$addedFiles = array();
  	//pobieram listę plików
		$sql = 'SELECT * FROM `page_files`
							WHERE `id_page`=\''.$this->id.'\'';
		$DB = DB::getInstance();
		$stmt = $DB->query($sql);
		if($stmt) {
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row) {
      	$file = new File($row['id_file']);
  	    $addedFiles[] = $file->toArray();
      }
			$stmt->closeCursor();
		}
		return $addedFiles;
  }

  public function getId() {
  	return (int)$this->id;
  }
	
	public function getName() {
  	return $this->name;
  }

  public function setName($name) {
  	$this->name = $name;
  }

  public function getPicture() {
  	return $this->picture;
  }

  public function setPicture($picture) {
  	$this->picture = $picture;
  }

  public function getPictureWidth() {
  	return $this->picture_width;
  }

  public function setPictureWidth($picture) {
  	$this->picture_width = $picture;
  }

  public function getPictureHeight() {
  	return $this->picture_height;
  }

  public function setPictureHeight($picture) {
  	$this->picture_height = $picture;
  }

  public function getPictureSize() {
  	return $this->picture_size;
  }

  public function setPictureSize($picture) {
  	$this->picture_size = $picture;
  }

  public function save() {

  }

  public function add() {

  }

  public function modify() {
  
  }

  public function validate() {
    $errors = array();
    if($this->name == '') {
      $errors['name'] = 'Brak nazwy';
    }
    return $errors;
  }

  public function delete() {

  }

//  public function getAddedFiles() {
//
//  	$addedFiles = array();
//  	//pobieram listę plików
//		$sql = 'SELECT * FROM
//					page_files
//					WHERE id_page=\''.$this->id.'\'';
//
//		$DB = DB::getInstance();
//		$stmt = $DB->query($sql);
//		if($stmt) {
//      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//      foreach ($result as $row) {
//      	$file = new File($row['id_file']);
//  	    $addedFiles[] = $file->toArray();
//      }
//		}
//		return $addedFiles;
//  }

	public function toArray() {
		$r = parent::toArray();
//		$r['addedFiles'] = $this->getAddedFiles();
		$r['picture_sizek'] = $this->getPictureSize()/1024;
		return $r;
	}
	
	
	public function getByModule($action) {
			$s = Session::getInstance();
			$sql = 'SELECT `page`.`id_page`
    	        FROM `module`
							LEFT JOIN `page` USING (`id_module`)
    	        WHERE `module`.`action` = \'' . $action. '\'
							AND `page`.`language`=\''.$s->getAttribute('lang').'\'
							LIMIT 1;';
      $DB = DB::getInstance();
      $stmt = $DB->query($sql);
      if((int)$stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$stmt->closeCursor();
				$id = $rs['id_page'];
				$this->id      = $id;
				$this->id_page = $id;
				$this->load();				
			}
	}

}

?>