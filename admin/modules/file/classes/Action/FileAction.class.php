<?php
/**
 * SmartSystem v.4
 *
 * @package smartsystem.exhibit
 */


/**
 * Obsłga modułu zarządzania exhibitami.
 *
 * @package smartsystem.exhibit
 */
class FileAction extends Action {


  public function init() {
  	define('DOCS_DIR', ADMIN_DIR . '../files/docs/');
  }

  public function doAction($param) {
  	    ini_set('post_max_size','4M');

    $param = strip_tags($param);
    switch($param) {
      case 'edit':
        $this->edit();
        break;
      case 'popup':
        $this->popup();
        break;
      case 'add':
        $this->add();
        break;
      case 'del':
        $this->delete();
        break;
      case 'list':
      default:
        $this->getAll();
        break;
    }


    $menuTopL = array ( ) ;
    $menuTopA = array ( ) ;
    $menuTopR = array ( ) ;

    if ( $param =='edit' ) {

      $menuTopL[] = array ( 'title' => 'Lista plików' ,
      											'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=file' ) ;
      $menuTopA = array ( 'title' => 'Edycja danych pliku' ,
      										'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=file&amp;act=edit&amp;id='.$_GET['id'] );
    } elseif ( $param =='popup' ) {
      $menuTopA = array ( 'title' => 'Edycja danych pliku');
    } elseif ( $param =='add' ) {
			 $menuTopL[] = array ( 'title' => 'Lista plików' ,
      											'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=file' ) ;
      $menuTopA = array ( 'title' => 'Dodawanie pliku');
    } else {
      $menuTopA = array ( 'title' => 'Lista plików' ,
      										'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=file' );

    }

    $this->response->addParameter('menuTopL', $menuTopL);
    $this->response->addParameter('menuTopA', $menuTopA);
    $this->response->addParameter('menuTopR', $menuTopR);

  }

  protected function add() {

    $file = new File();
    $realFileName = '';
    $file->fromArray($this->request->getParameter('data'));
    if( $this->request->getParameter('confirm') ) {
		//echo $_FILES['source_name']['type'];
    //$mimeTypes = array('image/jpeg', 'image/pjpeg', 'image/pjpg', 'image/png','application/msword', 'application/pdf', 'application/x-flash-video', 'application/octet-stream' );

  	$uploadFile = new FileFullUpload(DOCS_DIR,'source_name');
		if($uploadFile) { // jesli zuploadowano plik na serwer
			if($uploadFile->move()) {
				$realFileName = $uploadFile->getFileName();
			}
		}


		$fileTypes = new FileTypesSimpleCollection();
		$fileTypes = $fileTypes->getAll();

		if(count($fileTypes > 0)) {
			$type_id = false;
			
			foreach ($fileTypes as $v) {
				if($v['extension'] == substr($_FILES['source_name']['name'], -3)){
					$file->setType($v['id_file_type']);
					$type_id = $v['id_file_type'];
					break;
				}
			}
			if(!$type_id){
				foreach ($fileTypes as $v) {
					if($v['mime'] == $_FILES['source_name']['type']) {
						$file->setType($v['id_file_type']);
						break;
					}
				}				
			}
			
		}

			//przekazuje nazwe pliku do objektu DBObject
			$file->setFileName($realFileName);
			$file->setSize($uploadFile->getSize());
			$file_extension =  substr($realFileName, (strlen($realFileName)-3),strlen($realFileName) );
			if($file_extension == 'doc') $file->setType(4);
			elseif($file_extension == 'flv') $file->setType(2);
      if($file->save()) {
        $this->getAll();
      } else {
        $this->response->addParameter('data', $file);
        $this->response->addParameter('moduletpl', 'file/templates/add.tpl');
      }
    } else {
      $this->response->addParameter('moduletpl', 'file/templates/add.tpl');
    }
  }

  protected function getAll() {
		
		$menuTopA = array ( 'title' => 'Lista plików' ,
      										'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=file' );
		$this->response->addParameter('menuTopL', $menuTopL);
		
		
    $s = Session::getInstance();
    $sort_arr = array(
					'added'		=> 'data dodania &nbsp;',
					'name'		=> 'nazwa',
				  'size'		=> 'rozmiar',
				  'active'	=> 'aktywny'
		);
    $sort = new Sort();
    $sort -> setSort( $sort_arr );
    if( $s->is_set( 'sort_file' ) ) {
      if( $this->request->getParameter('sort_change') ) {
        $sort->setSortParam( $this->request->getParameter('sort') );
      } else {
        $sort->setSortParam( $s->getAttribute('sort_file') );
      }
    } else {
      $sort -> setSortParam( array( 'sort' => 'added', 'sortdir' => 'ASC' ) );
    }
    $s->setAttribute( 'sort_file',$sort->getSortParam() );
    $this->response->addParameter('sort', $sort->getSort() );

    // sprawdzamy czy wyszukiwanie ...
    // ... jesli tak to przypisujemy wyszukiwane arguemty do sesji
    if( $this->request->getParameter( 'search_file' ) ) {
      $s->setAttribute('s_file', $this->request->getParameter( 's_file' ) );
      $s->setAttribute('page_file', 1);
    }
    // sprawdzamy czy jest ustawiona sesja dla s_exhibit ...
    // ... jesli tak to przypisujemy do tablicy ktora wypiszemy w wyszukiwarce
    if( $s->is_set( 's_file' ) ) {
      $this->response->addParameter('s_file', $s->getAttribute('s_file') );
    }
    if( isset($_GET['page']) && (int)$_GET['page'] > 0) {
      $s->setAttribute('page_file',(int)$_GET['page']);
    }
    $collection = new FilesCollection( $s->getAttribute('page_file'),$s->getAttribute('sort_file') );
    $this->response->addParameter('collection', $collection);
    $this->response->addParameter('moduletpl', 'file/templates/list.tpl');
  }

  protected function edit() {

    $file = new File($_GET['id']);
    if($this->request->getParameter('confirm')) {
      $file->fromArray($this->request->getParameter('data'));
      $file->save();
			$file = new File($_GET['id']);
    }

     	$delete_file = $this->request->getParameter('delete_file');
      if( ( int )$delete_file == 1 ) {
        $file->setPhoto('');
        $file->save();
      }

    //jesli zaznaczony checkbox Usun plik
    if($this->request->getParameter('delete')) {
			$file->setFileName('');
			$file->modify();
    }
	$file_name = $file->getName();
	$file_extension =  substr($file_name, (strlen($file_name)-3),strlen($file_name) );
	$this->response->addParameter('file_extension',$file_extension);
    if( ($file->getType() == '2') || ( $file_extension == 'flv') ) {
    	$this->response->addParameter('video','');
    	$allowed_ext = array('jpg', 'jpeg', 'gif', 'png','bmp' );
    	$photo = new FileFullUpload('../files/flv/','file', $allowed_ext);
      	if( $photo->move() ) {
      	  $file->setPhoto($photo->getFileName());
      	  $file->save();
     		}
    }
    $this->response->addParameter('data', $file);
    $this->response->addParameter('moduletpl', 'file/templates/edit.tpl');
  }

  protected function popup() {
    $file = new File($_GET['id']);
    if($this->request->getParameter('confirm')) {
      $file->fromArray($this->request->getParameter('data'));
      $file->save();
    }
    //jesli zaznaczony checkbox Usun plik
    if($this->request->getParameter('delete')) {
			$file->setFileName('');
			$file->modify();
    }
    $this->response->addParameter('data', $file);
    $this->response->addParameter('moduletpl', 'file/templates/popup-edit.tpl');
  }

  protected function delete() {
    $file = new File($_GET['id']);
    $file->delete();
		$this->getAll();
  }

}
?>