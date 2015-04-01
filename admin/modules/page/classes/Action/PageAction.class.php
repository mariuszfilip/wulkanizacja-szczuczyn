<?php
/**
 * SmartSystem v.5
 *
 * @package smartsystem.page
 */


/**
 * Obsłga modułu zarządzania stronami.
 *
 * @package smartsystem.page
 */
class PageAction extends Action {
	public function init() {
	 	define('PICT_DIR', '../files/pages/');
	}

	public function doAction($param) {
		$param = strip_tags($param);

		$menuTopL = array();
		$menuTopA = array();
		$menuTopR = array();

		switch ($param) {
			case 'edit' :
				$this->edit();
				break;
			case 'del' :
				$this->delete();
				break;
      		case 'files' :
				$this->getAllFiles();
				break;
      		case 'gallerys' :
				$this->getAllGallerys();
				break;
				
			case 'articles' :
				$this->getAllArticles();
				break;

			case 'list' :
				break;
				
			case 'drag_drop' :
				$this->dragDrop();
				break;
				
			case 'drag_drop_add' :
				$this->dragDropAdd();
				break;
				
			case 'drag_drop_move' :
				$this->dragDropMove();
				break;
				
			case 'drag_drop_delete' :
				$this->dragDropDelete();
				break;
				
			case 'drag_drop_rename' :
				$this->dragDropRename();
				break;
				
			case 'drag_drop_status' :
				$this->dragDropStatus();
				break;
				
			case 'order_galery' :
				$this->orderGalery();
				break;
				
			case 'order_file' :
				$this->orderFile();
				break;

			default:
				$this->dragDrop();
				break;
		}

		$menuTopL = array();
		$menuTopA = array();
		$menuTopR = array();

    if( $param == '') {
      $menuTopA = array ( 'title' => 'Drzewko stron' ,
      										'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=page' );
      $menuTopR[] = array ( 'title' => 'Inne treści' ,
      										'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=otherpage' );
    } elseif ( $param =='edit' ) {
      $menuTopL[] = array ( 'title' => 'Drzewko stron' ,
      											'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=page' ) ;
      $menuTopA = array ( 'title' => 'Edycja strony' ,
      										'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=page&amp;act=edit&amp;id='.$_GET['id'] );
      $menuTopR[] = array ( 'title' => 'Inne treści' ,
      										'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=otherpage' );
    } elseif ( $param =='files' ) {
      $menuTopL[] = array ( 'title' => 'Drzewko stron' ,
      											'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=page' ) ;
      $menuTopL[] = array ( 'title' => 'Edycja strony' ,
      										'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=page&amp;act=edit&amp;id='.$_GET['id'] );
      $menuTopA = array ( 'title' => 'Lista plików' );
      $menuTopR[] = array ( 'title' => 'Inne treści' ,
      										'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=otherpage' );
    } elseif ( $param =='gallerys' ) {

      $menuTopL[] = array ( 'title' => 'Drzewko stron' ,
      											'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=page' ) ;
      $menuTopL[] = array ( 'title' => 'Edycja strony' ,
      										'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=page&amp;act=edit&amp;id='.$_GET['id'] );
      $menuTopA = array ( 'title' => 'Lista gallerii' );
      $menuTopR[] = array ( 'title' => 'Inne treści' ,
      										'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=otherpage' );
    } elseif ( $param =='articles' ) {

      $menuTopL[] = array ( 'title' => 'Drzewko stron' ,
      											'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=page' ) ;
      $menuTopL[] = array ( 'title' => 'Edycja strony' ,
      										'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=page&amp;act=edit&amp;id='.$_GET['id'] );
      $menuTopA = array ( 'title' => 'Lista artykułów' );
      $menuTopR[] = array ( 'title' => 'Inne treści' ,
      										'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=otherpage' );
    } else {
		$menuTopA = array ( 'title' => 'Lista gallerii' );
      	$menuTopR[] = array ( 'title' => 'Inne treści' ,
      										'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=otherpage' );
	}

    $this->response->addParameter('menuTopL', $menuTopL);
    $this->response->addParameter('menuTopA', $menuTopA);
    $this->response->addParameter('menuTopR', $menuTopR);
	}

  protected function treeList() {
    $tree = new PageTree();

	  if($this->request->getParameter('edit')) {

			if($this->request->getParameter('id_page')) {
				$node =  new PageNode($this->request->getParameter('id_page'));
				$node->setName($this->request->getParameter('name'));
				$node->save();
			}
		// zmiana nazwy elementu drzewka (w templacie wyswietlic nazwe w inpucie)
	  } else if($this->request->getParameter('del')) {
	  		$this->request->getParameter('id_page');

	  	if($this->request->getParameter('id_page')) {
				$tree->deleteNode($this->request->getParameter('id_page'));
	  	}
		// usuniecie węzła
	  } else if($this->request->getParameter('moveup')) {

	  	$tree->nodeMoveUp($this->request->getParameter('id_page'));

		// przesuniecie węzła o jeden w góre
	  } else if($this->request->getParameter('movedown')) {

	  	$tree->nodeMoveDown($this->request->getParameter('id_page'));
		// przesuniecie węzła o jeden w dół
	  } else if($this->request->getParameter('addto')) {

	  } else if($this->request->getParameter('status')) {

	  		if($this->request->getParameter('id_page')) {
	  			$node =  new PageNode($this->request->getParameter('id_page'));
	  			$node->setActive($this->request->getParameter('active'));
	  			$node->save();
	  		}
		// dodawnie nowego węzła w danym węzle
	  } else  if($this->request->getParameter('add')) {

	  	$tree->addRootNode($this->request->getParameter('name'));

	  } else if($this->request->getParameter('addsub')) {

			$tree->addNode($this->request->getParameter('id_page'),$this->request->getParameter('name'));
	  }

	  $treeList = $tree->getTree();
	  /*echo "<pre>";
	  print_r( $treeList );
	  echo "</pre>";*/
    $this->response->addParameter('tree', $treeList);
    $this->response->addParameter('moduletpl', 'page/templates/list.tpl');
  }

  protected function edit() {
    $id = $this->request->getParameter("id");
    $page_file = new PageFile( $id );
    $page_gallery = new PageGallery( $id );
	//$page_article = new PageArticles( $_GET['id'] );
    $page = new Page($id);
    $realFileName = '';
		$modules= new ModuleSimpleCollection();
		$this->response->addParameter('modules', $modules->toArray());
    $mimeTypes = array('image/jpeg', 'image/png','image/gif', 'image/bmp');
  	$uploadFile = new FileUpload(PICT_DIR,'source_name',$mimeTypes);
	if($uploadFile) { // jesli zuploadowano plik na serwer
		if($uploadFile->move()) {
			$realFileName = $uploadFile->getFileName();
			$page->setPicture($realFileName);
			$page->setPictureSize($uploadFile->getSize());	
			//ustawiam width i height po przeniesieniu pliku
			$sizeArray = getimagesize(PICT_DIR.$realFileName);
			$page->setPictureWidth($sizeArray[0]);
			$page->setPictureHeight($sizeArray[1]);
		}
	}

    if($this->request->getParameter('confirmed')) {
	  	if($this->request->getParameter('delete')) {
			@unlink(PICT_DIR.$page->getPicture());
			$page->setPicture('');
	  	}
		$request_array = $this->request->getParameter('data');
		if(!$request_array['bottom_menu']) $request_array['bottom_menu'] = 'N';
		$page->fromArray($request_array);
      	$page->save();
		$page = new Page($id);
   /*echo '<script type=\'text/javascript\'>location.href=\'index.php?mod=page&act=edit&id='.(int)$_GET['id'].'\'</script>';*/
    }
    $this->response->addParameter('meta_last_modified',date('M d Y H:i:s')); // terazniejsza data
    $this->response->addParameter('meta_robots','index, follow, all');
    $this->response->addParameter('data', $page->toArray());
    $this->response->addParameter('addedFiles', $page_file->getFiles());
    $this->response->addParameter('gallerys', $page_gallery->getGallerys());
    //$this->response->addParameter('articles', $page_article->getGallerys());
    $this->response->addParameter('moduletpl', 'page/templates/edit.tpl');
  }

  protected function delete() {
    $page = new Page($_GET['id']);
    $page->delete();
    //$this->dragDrop();
	echo '<script type=\'text/javascript\'>location.href=\'?mod=page\'</script>';
  }

  protected function getAllFiles() {
    $id_page = (int)$_GET['id'];
    $page_file = new PageFile( $id_page );
    if($this->request->getParameter('ascribe_files') && $this->request->getParameter('hidden') ) {
      $page_file->ascribeFiles( $this->request->getParameter('ascribe'),$this->request->getParameter('hidden') );
    }
    $s = Session::getInstance();
    $sort_arr = array(
					'name'		=> 'nazwa',
					'active' 	=> 'aktywny'
	);
    $sort = new Sort();
    $sort -> setSort( $sort_arr );
    if( $s->is_set( 'sort_files' ) ) {
      if( $this->request->getParameter('sort_change') ) {
        $sort->setSortParam( $this->request->getParameter('sort') );
      } else {
        $sort->setSortParam( $s->getAttribute('sort_files') );
      }
    } else {
      $sort -> setSortParam( array( 'sort' => 'name', 'sortdir' => 'ASC' ) );
    }
    $s->setAttribute( 'sort_files',$sort->getSortParam() );

    $this->response->addParameter('sort', $sort->getSort() );

    // sprawdzamy czy wyszukiwanie ...
    // ... jesli tak to przypisujemy wyszukiwane arguemty do sesji
    if( $this->request->getParameter( 'search_file' ) ) {
      $s->setAttribute('s_file', $this->request->getParameter( 's_file' ) );
      $s->setAttribute('page_file', 1);
    }
    // sprawdzamy czy jest ustawiona sesja dla page ...
    // ... jesli tak to przypisujemy do tablicy ktora wypiszemy w wyszukiwarce
    if( $s->is_set( 's_file' ) ) {
      $this->response->addParameter('s_file', $s->getAttribute('s_file') );
    }
    if( isset($_GET['page']) && (int)$_GET['page'] > 0) {
      $s->setAttribute('page_file',(int)$_GET['page']);
    }
    $files = $page_file->getFiles();
    $this->response->addParameter('files', $files);
    $collection = new FilesCollection( $s->getAttribute('page_file'),$s->getAttribute('sort_files') );
    $this->response->addParameter('collection', $collection);
    $this->response->addParameter('moduletpl', 'page/templates/list-files.tpl');
    $this->response->addParameter('id_page', $id_page);
  }

  protected function getAllGallerys() {
    $id_page = $this->request->getParameter('id');
    $page_gallery = new PageGallery($id_page);
    if($this->request->getParameter('ascribe_gallerys') && $this->request->getParameter('hidden') ) {
      $page_gallery->ascribeGallerys( $this->request->getParameter('ascribe'),$this->request->getParameter('hidden') );
    }
    $s = Session::getInstance();
    $sort_arr = array(  'name' => 'nazwa',
              'active' => 'aktywny' );
    $sort = new Sort();
    $sort -> setSort( $sort_arr );
    if( $s->is_set( 'sort_gallery' ) ) {
      if( $this->request->getParameter('sort_change') ) {
        $sort->setSortParam( $this->request->getParameter('sort') );
      } else {
        $sort->setSortParam( $s->getAttribute('sort_gallery') );
      }
    } else {
      $sort -> setSortParam( array( 'sort' => 'name', 'sortdir' => 'ASC' ) );
    }
    $s->setAttribute( 'sort_gallery',$sort->getSortParam() );
    $this->response->addParameter('sort', $sort->getSort() );

    // sprawdzamy czy wyszukiwanie ...
    // ... jesli tak to przypisujemy wyszukiwane arguemty do sesji
    if( $this->request->getParameter( 'search_gallery' ) ) {
      $s->setAttribute('s_gallery', $this->request->getParameter( 's_gallery' ) );
      $s->setAttribute('page_gallery', 1);
    }
    // sprawdzamy czy jest ustawiona sesja dla s_gallery ...
    // ... jesli tak to przypisujemy do tablicy ktora wypiszemy w wyszukiwarce
    if( $s->is_set( 's_gallery' ) ) {
      $this->response->addParameter('s_gallery', $s->getAttribute('s_gallery') );
    }
    if( isset($_GET['page']) && (int)$_GET['page'] > 0) {
      $s->setAttribute('page_gallery',(int)$_GET['page']);
    }
    $gallerys = $page_gallery->getGallerys();
    $this->response->addParameter('gallerys', $gallerys);
    $collection = new GallerysCollection( $s->getAttribute('page_gallery'),$s->getAttribute('sort_gallery') );
    $this->response->addParameter('collection', $collection);
    $this->response->addParameter('moduletpl', 'page/templates/list-gallerys.tpl');
    $this->response->addParameter('id_page', $id_page);
  }
  
  
  protected function getAllArticles() {
  
    $id_page = $this->request->getParameter('id');
    $page_article = new PageArticles($id_page);
    if($this->request->getParameter('hidden') ) { 
      $page_article->ascribeGallerys( $this->request->getParameter('ascribe'),$this->request->getParameter('hidden') );
    }
    $s = Session::getInstance();
    $sort_arr = array(  'name' => 'nazwa',
              'active' => 'aktywny' );
    $sort = new Sort();
    $sort -> setSort( $sort_arr );
    if( $s->is_set( 'sort_article' ) ) {
      if( $this->request->getParameter('sort_change') ) {
        $sort->setSortParam( $this->request->getParameter('sort') );
      } else {
        $sort->setSortParam( $s->getAttribute('sort_article') );
      }
    } else {
      $sort -> setSortParam( array( 'sort' => 'name', 'sortdir' => 'ASC' ) );
    }
    $s->setAttribute( 'sort_article',$sort->getSortParam() );
    $this->response->addParameter('sort', $sort->getSort() );

    // sprawdzamy czy wyszukiwanie ...
    // ... jesli tak to przypisujemy wyszukiwane arguemty do sesji
    if( $this->request->getParameter( 'search_gallery' ) ) {
      $s->setAttribute('s_article', $this->request->getParameter( 's_article' ) );
      $s->setAttribute('page_article', 1);
    }
    // sprawdzamy czy jest ustawiona sesja dla s_article ...
    // ... jesli tak to przypisujemy do tablicy ktora wypiszemy w wyszukiwarce
    if( $s->is_set( 's_article' ) ) {
      $this->response->addParameter('s_article', $s->getAttribute('s_article') );
    }
    if( isset($_GET['page']) && (int)$_GET['page'] > 0) {
      $s->setAttribute('page_article',(int)$_GET['page']);
    }
    $articles = $page_article->getGallerys();
    $this->response->addParameter('articles', $articles);
    $collection = new ArticlesCollection( $s->getAttribute('page_article'),$s->getAttribute('sort_article') );
    $this->response->addParameter('collection', $collection);
    $this->response->addParameter('moduletpl', 'page/templates/list-articles.tpl');
    $this->response->addParameter('id_page', $id_page);
  }
  
  
  protected function dragDrop() {
    $tree = new PageTree();

	  if($this->request->getParameter('edit')) {

			if($this->request->getParameter('id_page')) {
				$node =  new PageNode($this->request->getParameter('id_page'));
				$node->setName($this->request->getParameter('name'));
				$node->save();
			}
			//zmiana nazwy elementu drzewka (w templacie wyswietlic nazwe w inpucie)
	  } else if($this->request->getParameter('del')) {
	  		$this->request->getParameter('id_page');

	  	if($this->request->getParameter('id_page')) {
				$tree->deleteNode($this->request->getParameter('id_page'));
	  	}
			//usuniecie węzła
	  } else if($this->request->getParameter('moveup')) {

	  	$tree->nodeMoveUp($this->request->getParameter('id_page'));

			// przesuniecie węzła o jeden w góre
	  } else if($this->request->getParameter('movedown')) {
	  	$tree->nodeMoveDown($this->request->getParameter('id_page'));
		// przesuniecie węzła o jeden w dół
	  } /*else if($this->request->getParameter('addto')) {
	  } */else if($this->request->getParameter('status')) {
	  		if($this->request->getParameter('id_page')) {
	  			$node =  new PageNode($this->request->getParameter('id_page'));
	  			$node->setActive($this->request->getParameter('active'));
	  			$node->save();
	  		}
		// dodawnie nowego węzła w danym węzle
	  } else  if($this->request->getParameter('add')) {
	  	$tree->addRootNode($this->request->getParameter('name'));
	  } else if($this->request->getParameter('addsub')) {
			$tree->addNode($this->request->getParameter('id_page'),$this->request->getParameter('name'));
	  }
	  $treeList = $tree->getTree();
    $this->response->addParameter('tree', $treeList);
    $this->response->addParameter('moduletpl', 'page/templates/drag_drop.tpl');
		$this->response->addParameter('page_tree_drag_and_drop', true);
  }
  
  
  protected function dragDropMove() {	 
		$Page_tree = new PageTree();	 
		$Page_tree->moveNodes($_POST['src'], $_POST['dst'], $_POST['prv']);
		unset($_SESSION['message']);
  }
  
  protected function dragDropRename() {
		if($_POST['id'] && $_POST['name']){
			$node= new PageNode($_POST['id']);
			$node->setName($_POST['name']);
			$node->modify();
			unset($_SESSION['message']);
		}
  }
  
  protected function dragDropStatus() {	 
		$node= new PageNode($_POST['id']);
		$node->setActive($_POST['status']);
		$node->modify();
		unset($_SESSION['message']);
  }
  
  protected function dragDropDelete() {	
  	if($_POST['id']){
			$Page_tree = new PageTree();	 
			$Page_tree->deleteNode($_POST['id']);
			unset($_SESSION['message']);
		}
  }
  
  protected function dragDropAdd() {
			if($_POST['name']){		
			$Page_tree = new PageTree();
			$newPage = $Page_tree->addNode($this->request->getParameter('id'),$this->request->getParameter('name'));
			echo $newPage->getId();		
			unset($_SESSION['message']);
		}
  }
	
	protected function orderGalery(){
		if( $this->request->getParameter('id') > 0 && $order = $this->request->getParameter('order')){
			$order = explode('|',$order);
			$saved = false;
			foreach($order as $position=>$id_gallery){
				$pg = new PageGallery($this->request->getParameter('id'));
				if($pg->setPosition($id_gallery, $position)) $saved = true;
			}
			if($saved) echo 1; else echo 0;
		}else{
			echo 0;
		}
	}
	
	protected function orderFile(){
		if( $this->request->getParameter('id') > 0 && $order = $this->request->getParameter('order')){
			$order = explode('|',$order);
			$saved = false;
			foreach($order as $position=>$id_gallery){
				$pf = new PageFile($this->request->getParameter('id'));
				if($pf->setPosition($id_gallery, $position)) $saved = true;
			}
			if($saved) echo 1; else echo 0;
		}else{
			echo 0;
		}
	}
    
}
?>