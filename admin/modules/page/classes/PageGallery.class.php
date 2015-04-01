<?php

class PageGallery {

  protected $id_page;

  public function __construct( $id_page ){
    $this->id_page = $id_page;
  }
  /**
   * Enter description here...
   *
   * @param array $ascribe_arr - tablica zakliknietych
   * @param array $hidden_arr - tablica wszytskich z listy
   */
  public function ascribeGallerys( $ascribe_arr, array $hidden_arr ) {
    $DB = DB::getInstance();
    $assignment_arr = array();
    if( count( $hidden_arr ) > 0 ) {
      foreach($hidden_arr as $key => $value) {
				if( count( $ascribe_arr ) > 0 ){
					if(!$ascribe_arr[$key]){
						$sql = 'DELETE FROM `page_gallery` WHERE `id_page`='.$this->id_page.' AND `id_gallery`='.(int)$key;
						$DB->exec($sql);
					}
				}else{
					$sql = 'DELETE FROM `page_gallery` WHERE `id_page`='.$this->id_page.' AND `id_gallery`='.(int)$key;
					$DB->exec($sql);
				}
      }
    }
    if( count( $ascribe_arr ) > 0 ) {
      foreach($ascribe_arr as $key => $value) {
        $sql = 'INSERT INTO `page_gallery` SET `id_page`='.$this->id_page.', `id_gallery`='.(int)$key.', `position`='.$this->getNextPosition().' ON DUPLICATE KEY UPDATE id_page_gallery=LAST_INSERT_ID(id_page_gallery)';
        $DB->exec($sql);
      }
    }
    $_SESSION['message'] = 'Zmiany zostały zapisane';
  }

  public function getGallerys() {
    $r = array();
    $DB = DB::getInstance();
    $sql = 'SELECT `gallery`.* FROM `page_gallery`, `gallery`
            WHERE `id_page`='.$this->id_page.' AND `gallery`.`id_gallery` = `page_gallery`.`id_gallery` ORDER BY `page_gallery`.`position` ASC';
    $stmt = $DB->query( $sql );
		if($stmt){
				$rs = $stmt->fetchAll();
				$i = 1;
				foreach ( $rs as $k => $v ){
					$r[ $v['id_gallery'] ][ 'added' ] = 1;
					$r[ $v['id_gallery'] ][ 'id' ] = $i++;
					$r[ $v['id_gallery'] ][ 'name' ] = $v['name'];
					$r[ $v['id_gallery'] ][ 'description' ] = $v['description'];
					$r[ $v['id_gallery'] ][ 'id_gallery' ] = $v['id_gallery'];
		
				}
				$stmt->closeCursor();
				return $r;
		}
  }
	
	
	protected function getNextPosition(){
		$DB = DB::getInstance();
		$sql = 'SELECT MAX(`position`) AS `maximum` FROM `page_gallery`
            WHERE `id_page`='.$this->id_page;
    $stmt = $DB->query($sql);
		if($stmt){			
			$rs = $stmt->fetch();
			$stmt->closeCursor();
			if(is_null($rs['maximum']))
				return 0;
			else 
				return $rs['maximum']+1;
		}
		else return 0;
	}
	
	
	public function setPosition($id_gallery, $position){
		if($this->id_page > 0 && $id_gallery > 0){
			$DB = DB::getInstance();
			$sql = 'UPDATE `page_gallery` SET `position`="'.(int)$position.'" WHERE `id_page`='.(int)$this->id_page.' AND `id_gallery`='.(int)$id_gallery.' LIMIT 1;';
			$result = $DB->exec($sql);
	  	if($result)
	  		return true;
			else
				return false;
		}else
				return false;
	}
	
}
?>