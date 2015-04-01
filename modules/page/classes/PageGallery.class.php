<?php
class PageGallery {

  protected $id_page;

  public function __construct( $id_page ){
    $this->id_page = $id_page;
  }

  public function getGallerys() {
    $r = array();
    $DB = DB::getInstance();
   	$sql = 'SELECT `gallery`.* FROM page_gallery,gallery
            WHERE id_page='.$this->id_page.' AND
            			gallery.id_gallery=page_gallery.id_gallery AND
            			gallery.deleted=\'N\' AND
            			gallery.active=\'Y\'
				ORDER BY `page_gallery`.`position` ASC						
		';
    $stmt = $DB->query( $sql );
    $rs = $stmt->fetchAll();
    $i = 1;
    foreach ( $rs as $k => $v ) {
      $r[ $v['id_gallery'] ][ 'added' ] = 1;
      $r[ $v['id_gallery'] ][ 'id' ] = $i++;
      $r[ $v['id_gallery'] ][ 'name' ] = $v['name'];
      $r[ $v['id_gallery'] ][ 'id_gallery' ] = $v['id_gallery'];

      //dołączyłem zdjecia do kolekcji galleri zeby na stronie wyswietalc kolekcje galeri ze zdjeciami.

   		$sql2 = 'SELECT * FROM photo
      				WHERE id_gallery=\''.$v['id_gallery'].'\' AND
      						 deleted=\'N\'
      				ORDER BY position ASC';
      $stmt2 = $DB->query( $sql2 );
      $rs2 = $stmt2->fetchAll();
      $j = 0;
      foreach ($rs2 as $kk => $vv) {
      	$r[ $v['id_gallery'] ][ 'files' ][$j]['id_photo'] = $vv['id_photo'];
      	$r[ $v['id_gallery'] ][ 'files' ][$j]['name'] = $vv['name'];
      	$r[ $v['id_gallery'] ][ 'files' ][$j]['file_name'] = $vv['file_name'];
      	$r[ $v['id_gallery'] ][ 'files' ][$j]['description'] = $vv['description'];
      	$j++;
      }
    }
    return $r;
  }
}
?>