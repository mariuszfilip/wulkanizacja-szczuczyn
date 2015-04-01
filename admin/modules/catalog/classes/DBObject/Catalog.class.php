<?php
/**
 * *** UTF-8 ***
 *
 * SmartSystem v.4
 *
 * @package smartsystem.page
 */


/**
 * Obiekt bazodanowy odpowiadający katalogowi
 *
 * @package smartsystem.catalog
 */


class Catalog extends DBObject
{
	protected $id_catalog      = 0;
	protected $position		  = '';
	protected $id_parent	  = 0;
	protected $picture_size	  = 0;
	protected $name         = '';
	protected $picture		  = '';
	protected $active			  = '';
	protected $added			  = '';
	protected $modified		  = '';

	protected $meta_title  = '';
	protected $meta_description   = '';
	protected $meta_keywords 		  = '';
	protected $meta_robots			  = '';
	protected $meta_last_modified = '';

	protected $addedFiles = array();


	public function __construct($id = 0)
	{
		$this->id = $id;
		$this->id_catalog = $id;
		$this->load();
	}



	private function load()
	{
		if($this->id > 0)
		{
    	$sql = 'SELECT * FROM `catalog`
    	        WHERE `id_catalog` = \''.$this->id.'\'';

			$DB = DB::getInstance();
			$stmt = $DB->query($sql);
			if((int)$stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->id           		= $rs['id_catalog'];
				$this->id_catalog 			= $rs['id_catalog'];
				$this->id_parent			= $rs['id_parent'];
				$this->name         		= $rs['name'];
				$this->picture 				= $rs['picture'];
				$this->picture_size 		= $rs['picture_size'];
				$this->modified    			= $rs['modified'];
				$this->active      			= (boolean) $rs['active'];
				$this->added        		= $rs['added'];
				$this->meta_title 			= $rs['meta_title'];
				$this->meta_description 	= $rs['meta_description'];
				$this->meta_keywords	  	= $rs['meta_keywords'];
				$this->meta_last_modified	= $rs['meta_last_modified'];
				$this->meta_robots	  		= $rs['meta_robots'];
				$stmt->closeCursor();
			}
		}
	}

  public function getProducts($id_catalog) {
    $r = array();
    $DB = DB::getInstance();
    $sql = 'SELECT * FROM `product_catalog` WHERE `id_catalog`='.(int)$id_catalog;
    $stmt = $DB->query($sql);
    if((int)$stmt) {
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
      foreach ($result as $row) {
        // mozna tutaj wrzuccic instancje klasy Prooudct ale to kolejne zapytanire/
        $r[] = $row['id_product'];
      }
    }
    return $r;
  }
	public function getName()
	{
		return $this->name;
	}



	public function setName($name)
	{
		$this->name = $name;
	}



	public function getPicture()
	{
		return $this->picture;
	}



	public function setPicture($picture)
	{
		$this->picture = $picture;
	}

	public function getPictureSize()
	{
		return $this->picture_size;
	}



	public function setPictureSize($picture)
	{
		$this->picture_size = $picture;
	}



	public function save()
	{
		$errors = $this->validate();
		$result = 0;
		if(empty($errors))
		{
			if($this->id > 0)
			{
				$result = $this->modify();
			}
			else
			{
				$result = $this->add();
			}
		}
		else
		{
			$_SESSION['errors'] = $errors;
		}
		return $result;
	}

	public function add()
	{

		$DB = DB::getInstance();
		$sql = 'INSERT INTO
    				`catalog`
		 				SET
						`name` = \''.$this->name.'\',
						`id_parent` = \''.$this->id_parent.'\',
		        `active` = \''.$this->active.'\',
		        `picture` = \''.$this->picture.'\',
		        `picture_size` = \''.$this->picture_size.'\',
			      `added` = \''.time().'\',
		        `meta_title` = \''.$this->meta_title.'\',
		        `meta_description` = \''.$this->meta_description.'\',
		        `meta_keywords` = \''.$this->meta_keywords.'\',
		        `meta_robots` = \''.$this->meta_robots.'\',
		        `meta_last_modified` = \''.date("Y-m-d H:i:s").'\',
			      `modified` = \''.time().'\',
		        `lang` =  \''.$lang->getAttribute('lang').'\'';

		//$result = $DB->exec($sql);
		if($result)
		{
			$_SESSION['message'] = 'Dane zostały dodane';
		}
		$this->id = $DB->lastInsertId();
		return $result;
	}


	public function modify()
	{
		$DB = DB::getInstance();
		$result = 0;

		$sql = '
				UPDATE
					`catalog`
				SET
					`name` = \''.$this->name.'\',
					`id_parent` = \''.$this->id_parent.'\',
          `active` = \''.$this->active.'\',
          `picture` = \''.$this->picture.'\',
          `picture_size` = \''.$this->picture_size.'\',
          `meta_title` = \''.$this->meta_title.'\',
          `meta_description` = \''.$this->meta_description.'\',
          `meta_keywords` = \''.$this->meta_keywords.'\',
          `meta_robots` = \''.$this->meta_robots.'\',
          `meta_last_modified` = \''.date("Y-m-d H:i:s").'\'
	       WHERE
        	`id_catalog` = \''.$this->id.'\'';

		//echo $sql;
		$result = $DB->exec($sql);
		if($result)
		{
			$_SESSION['message'] = 'Dane zostały zaktualizowane';
			//$this->content = str_replace("files/fck/Image/","../../../files/fck/Image/",$this->content);
		}

		return $result;
	}


	public function validate()
	{
		$errors = array();
		if($this->name == '')
		{
			$errors['name'] = 'Brak nazwy';
		}
		return $errors;
	}



	public function delete()
	{
		$sql = "DELETE FROM
    				`catalog`
    			WHERE
    				`id_catalog` = '".$this->id."' ";

		$DB = DB::getInstance();
		$r = $DB->exec($sql);
		if($r)
		{
			$_SESSION['message'] = 'Dane zostały usunięte';
		}
		return $r;
	}

	public function toArray()
	{
		$r = parent::toArray();
		$r['picture_sizek'] = $this->getPictureSize()/1024;
		return $r;
	}

}



?>