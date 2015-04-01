<?php
class PageFile {

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
  public function ascribeFiles( $ascribe_arr, array $hidden_arr ) {
    $DB = DB::getInstance();
    $assignment_arr = array();
    if( count( $hidden_arr ) > 0 ) {
      foreach($hidden_arr as $key => $value) {
				if(!$ascribe_arr[$key]){
					$sql = 'DELETE FROM `page_files` WHERE `id_page`='.$this->id_page.' AND `id_file`='.(int)$key;
					$DB->exec($sql);
				}
      }
    }
    if( count( $ascribe_arr ) > 0 ) {
      foreach($ascribe_arr as $key => $value) {
        $sql = 'INSERT INTO `page_files` SET `id_page`='.$this->id_page.', `id_file`='.(int)$key.'				
				, `position`='.$this->getNextPosition().' ON DUPLICATE KEY UPDATE id_page_files=LAST_INSERT_ID(id_page_files)';
        $DB->exec($sql);
      }
    }
    $_SESSION['message'] = 'Zmiany zostały zapisane';
  }

  public function getFiles() {
    $r = array();
    $DB = DB::getInstance();
    $sql = 'SELECT `file`.* FROM `page_files`, `file`
            WHERE `id_page`='.$this->id_page.' AND `file`.`id_file`=`page_files`.`id_file`
						ORDER BY `page_files`.`position` ASC';
    $stmt = $DB->query( $sql );
    $rs = $stmt->fetchAll();
    $i = 1;
    foreach ( $rs as $k => $v ){
      $r[ $v['id_file'] ][ 'added' ] 		= 1;
      $r[ $v['id_file'] ][ 'id' ] 			= $i++;
      $r[ $v['id_file'] ][ 'name' ] 		= $v['name'];
      $r[ $v['id_file'] ][ 'sizek' ] 		= $v['size']/1024;
      $r[ $v['id_file'] ][ 'file_name' ] = $v['file_name'];
      $r[ $v['id_file'] ][ 'id_file' ] 	 = $v['id_file'];
    }
    return $r;
  }
	
	
	protected function getNextPosition(){
		$DB = DB::getInstance();
		$sql = 'SELECT MAX(`position`) AS `maximum` FROM `page_files`
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
	
	
	public function setPosition($id_file, $position){
		if($this->id_page > 0 && $id_file > 0){
			$DB = DB::getInstance();
			$sql = 'UPDATE `page_files` SET `position`="'.(int)$position.'" WHERE `id_page`='.(int)$this->id_page.' AND `id_file`='.(int)$id_file.' LIMIT 1;';
			$result = $DB->exec($sql);
	  	if($result)
	  		return true;
			else
				return false;
		}else
				return false;
	}	
	
	
}