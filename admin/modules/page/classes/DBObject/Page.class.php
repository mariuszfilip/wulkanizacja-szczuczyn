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

  protected $id_page						= 0;
  protected $position						= '';
  protected $id_parent					= 0;
	protected $id_module					= 0;
  protected $picture_height			= 0;
  protected $picture_width			= 0;
  protected $picture_size				= 0;
  protected $name								= '';
  protected $title							= '';
  protected $introduction				= '';
  protected $content						= '';
  protected $picture						= '';
  protected $active							= '';
  protected $added			  			= '';
  protected $modified		  			= '';
  protected $meta_title					= '';
  protected $meta_description   = '';
  protected $meta_keywords			= '';
  protected $meta_robots				= '';
  protected $bottom_menu				= 'N';
  protected $meta_last_modified	= '';  
  protected $addable						= '';
  protected $deletable					= '';
  protected $statusable					= '';
  protected $renameable					= '';
  protected $editable						= '';
  protected $dragable						= '';
  protected $addedFiles					= array();

  public function __construct($id = 0) {
  	$this->id      = $id;
  	$this->id_page = $id;
		$this->session = Session::getInstance();
    $this->load();
  }

  private function load() {
  	if($this->id > 0) {
   	$sql = 'SELECT *
    	        FROM `page`
    	        WHERE `id_page` = \'' . $this->id . '\' AND `language`=\''.$this->session->getAttribute('lang').'\';';
      $DB = DB::getInstance();
      $stmt = $DB->query($sql);
      if((int)$stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $this->id									= $rs['id_page'];
        $this->id_page 						= $rs['id_page'];
        $this->id_parent					= $rs['id_parent'];
				$this->id_module					= $rs['id_module'];
        $this->name         			= $rs['name'];
        $this->title        			= $rs['title'];
				$this->introduction 			= $rs['introduction'];
				$this->content 						= $rs['content'];
				$this->picture 						= $rs['picture'];
				$this->picture_size 			= $rs['picture_size'];
				$this->picture_height			= $rs['picture_height'];
				$this->picture_width 			= $rs['picture_width'];
        $this->modified     			= $rs['modified'];
        $this->active       			= $rs['active'];
        $this->added        			= $rs['added'];
        $this->meta_title 		    = $rs['meta_title'];
        $this->meta_description 	= $rs['meta_description'];
        $this->meta_keywords	  	= $rs['meta_keywords'];
        $this->meta_last_modified	= $rs['meta_last_modified'];
        $this->meta_robots	  		= $rs['meta_robots'];
				$this->bottom_menu	  		= $rs['bottom_menu'];
				$this->addable	  				= $rs['addable'];
				$this->deletable	  			= $rs['deletable'];
				$this->statusable	  			= $rs['statusable'];
				$this->renameable					= $rs['renameable'];
				$this->editable	  				= $rs['editable'];
				$this->dragable	  				= $rs['dragable'];
				$this->language	  				= $rs['language'];
        $stmt->closeCursor();
      }else{
				echo '<script type=\'text/javascript\'>location.href=\'?mod=page\'</script>';
				die;
			}
  	}
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

  public function add() {
    $DB = DB::getInstance();
    $sql = 'INSERT INTO `page` SET
						`name`=\'' . $this->name . '\',
						`id_parent`=\''.$this->id_parent.'\',
						`introduction`=\''.$this->introduction.'\',
						`content`=\''.$this->content.'\',
						`added`=CURRENT_TIMESTAMP,
						`active`=\'' . $this->active . '\',
						`picture`=\'' . $this->picture . '\',
						`picture_size`=\'' . $this->picture_size . '\',
						`picture_width`=\'' . $this->picture_width . '\',
						`picture_height`=\'' . $this->picture_height . '\',
						`meta_title`=\'' . $this->meta_title . '\',
						`meta_description`=\'' . $this->meta_description . '\',
						`meta_keywords`=\'' . $this->meta_keywords . '\',
						`meta_robots`=\'' . $this->meta_robots . '\',
						`bottom_menu`=\'' . $this->bottom_menu . '\',
						`meta_last_modified`=\'' . $this->meta_last_modified . '\',
						`language`=\''.$this->session->getAttribute('lang').'\';';
    $result = $DB->exec($sql);
    if($result) {
      $_SESSION['message'] = 'Dane zostały dodane';
    }
    $this->id = $DB->lastInsertId();
    return $result;
  }

  public function modify() {
    $DB = DB::getInstance();
    $result = 0;
		$sql = 'UPDATE `page` SET
						`name`=\'' . $this->name . '\',
						`id_parent`=\''.$this->id_parent.'\',
						`id_module`=\''.$this->id_module.'\',
						`introduction`=\''.$this->introduction.'\',
						`content`=\''.$this->content.'\',
						`added`=CURRENT_TIMESTAMP,
						`active`=\'' . $this->active . '\',
						`picture`=\'' . $this->picture . '\',
						`picture_size`=\'' . $this->picture_size . '\',
						`picture_width`=\'' . $this->picture_width . '\',
						`picture_height`=\'' . $this->picture_height . '\',
						`meta_title`=\'' . $this->meta_title . '\',
						`meta_description`=\'' . $this->meta_description . '\',
						`meta_keywords`=\'' . $this->meta_keywords . '\',
						`meta_robots`=\'' . $this->meta_robots . '\',
						`bottom_menu`=\'' . $this->bottom_menu . '\',
						`meta_last_modified`=\'' . $this->meta_last_modified . '\'
            WHERE `id_page`=\'' . $this->id . '\'';
						
						
		/*$sql = 'UPDATE `page` SET
						`name`=:name,
						`id_parent`=:id_parent,
						`introduction`=:introduction,
						`content`=:content,
						`added`=CURRENT_TIMESTAMP,
						`active`=:active,
						`picture`=:picture,
						`picture_size`=:picture_size,
						`picture_width`=:picture_width,
						`picture_height`=:picture_height,
						`meta_title`=:meta_title,
						`meta_description`=:meta_description,
						`meta_keywords`=:meta_keywords,
						`meta_robots`=:meta_robots,
						`bottom_menu`=:bottom_menu,
						`meta_last_modified`=:meta_last_modified
            WHERE `id_page`=:id_page';
						
						
		$stmt = $DB->prepare($sql);
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':id_parent', $this->id_parent);
		$stmt->bindParam(':introduction', $this->introduction);
		$stmt->bindParam(':content', $this->content);
		$stmt->bindParam(':active', $this->active);
		$stmt->bindParam(':picture', $this->picture);
		$stmt->bindParam(':picture_size', $this->picture_size);
		$stmt->bindParam(':picture_width', $this->picture_width);
		$stmt->bindParam(':picture_height', $this->picture_height);
		$stmt->bindParam(':meta_title', $this->meta_title);
		$stmt->bindParam(':meta_description', $this->meta_description);
		$stmt->bindParam(':meta_keywords', $this->meta_keywords);
		$stmt->bindParam(':meta_robots', $this->meta_robots);
		$stmt->bindParam(':bottom_menu', $this->bottom_menu);
		$stmt->bindParam(':meta_last_modified', $this->meta_last_modified);
		$stmt->bindParam(':id_page', $this->id);
						
    $result = $stmt->exec();*/
		
		
		$result = $DB->exec($sql);
    if($result) {
      $_SESSION['message'] = 'Dane zostały zaktualizowane';
    }
    return $result;
  }

  public function validate() {
    $errors = array();
    if($this->name == '') {
      $errors['name'] = 'Brak nazwy';
    }
    return $errors;
  }

  public function delete() {
    $sql = 'DELETE FROM `page`
    				WHERE `id_page`=\'' . $this->id . '\'';
    $DB = DB::getInstance();
    $r = $DB->exec($sql);
    if($r) {
      $_SESSION['message'] = 'Dane zostały usunięte';
    }
    return $r;
  }

  public function getAddedFiles() {
  	$addedFiles = array();
	$sql = 'SELECT * FROM
				`page_files`
				WHERE `id_page`=\''.$this->id.'\'';
	$DB = DB::getInstance();
	$stmt = $DB->query($sql);
	if($stmt) {
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row) {
      	$file = new File($row['id_file']);
  	    $addedFiles[] = $file->toArray();
      }
	}
		return $addedFiles;
  }

	public function toArray() {
		$r = parent::toArray();
		$r['addedFiles'] = $this->getAddedFiles();
		$r['picture_sizek'] = $this->getPictureSize()/1024;
		return $r;
	}

}
?>