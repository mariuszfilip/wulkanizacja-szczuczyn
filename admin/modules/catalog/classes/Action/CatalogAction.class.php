<?php
/**
 * SmartSystem v.4
 *
 * @package smartsystem.Catalog
 */


/**
 * Obsłga modułu zarządzania exhibitorami.
 *
 * @package smartsystem.exhibitor
 */
class CatalogAction extends Action {
	public function init() {
	 	define('PICT_DIR', '../files/catalog/');
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
				$this->del();
				break;
			case 'delete' :
				$this->del();
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
			case 'list' :
				break;
			default:
				$this->treeList();
				break;
		}

    $menuTopL = array ( ) ;
    $menuTopA = array ( ) ;
    $menuTopR = array ( ) ;

    if( $param == '') {
      $menuTopA = array ( 'title' => 'Drzewko kategorii' ,
      										'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=catalog' );


    } elseif ( $param =='edit' ) {

      $menuTopL[] = array ( 'title' => 'Drzewko kategorii' ,
      											'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=catalog' ) ;
      $menuTopA = array ( 'title' => 'Edycja kategorii' ,
      										'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=catalog&amp;act=edit&amp;id='.$_GET['id'] );
     
    }

    $this->response->addParameter('menuTopL', $menuTopL);
    $this->response->addParameter('menuTopA', $menuTopA);
    $this->response->addParameter('menuTopR', $menuTopR);

	}

  protected function treeList() {

    $tree = new Tree();
		if($_GET['tree']) $_SESSION['tree'][$_GET['tree']]=1;
		if($_GET['tree_m']) $_SESSION['tree'][$_GET['tree_m']]=0;
	  if($this->request->getParameter('edit')) {

			if($this->request->getParameter('id_catalog')) {
				$node = new Node($this->request->getParameter('id_catalog'));
				$node->setName($this->request->getParameter('name'));
				$node->save();
			}
			//zmiana nazwy elementu drzewka (w templacie wyswietlic nazwe w inpucie)
	  } else if($this->request->getParameter('del')) {
	  		$this->request->getParameter('id_catalog');

	  	if($this->request->getParameter('id_catalog')) {
				$tree->deleteNode($this->request->getParameter('id_catalog'));
	  	}
			//usuniecie węzła
	  } else if($this->request->getParameter('moveup')) {

	  	$tree->nodeMoveUp($this->request->getParameter('id_catalog'));

			// przesuniecie węzła o jeden w góre
	  } else if($this->request->getParameter('movedown')) {

	  	$tree->nodeMoveDown($this->request->getParameter('id_catalog'));

		  // przesuniecie węzła o jeden w dół
	  } else if($this->request->getParameter('addto')) {

	  } else if($this->request->getParameter('status')) {
	  		if($this->request->getParameter('id_catalog')) {

	  			$node = new Node($this->request->getParameter('id_catalog'));
	  			$node->setActive($this->request->getParameter('active'));
	  			$node->save();
	  		}

			// dodawnie nowego węzła w danym węzle
	  } else  if($this->request->getParameter('add')) {

	  	$tree->addRootNode($this->request->getParameter('name'));

	  } else if($this->request->getParameter('addsub')) {

			$tree->addNode($this->request->getParameter('id_catalog'),$this->request->getParameter('name'));
	  }

	  $treeList = $tree->getTree();
	  $this->response->addParameter('tree', $treeList);
    $this->response->addParameter('moduletpl', 'catalog/templates/drag_drop.tpl');
		$this->response->addParameter('catalog_tree_drag_and_drop', true);
  }

  protected function edit() {


    $catalog = new Catalog($_GET['id']);

    $realFileName = '';
    $allowed_extensions = array('jpg', 'jpeg', 'png','gif', 'bmp');
  	$uploadFile = new FileFullUpload(PICT_DIR,'source_name',$allowed_extensions);
		if($uploadFile) { // jesli zuploadowano plik na serwer

			if($uploadFile->move()) {
				$realFileName = $uploadFile->getFileName();
	      $catalog->setPicture($realFileName);
	      $catalog->setPictureSize($uploadFile->getSize());

	      //ustawiam width i height po przeniesieniu pliku
//		      $sizeArray 		= getimagesize(PICT_DIR.$realFileName);
//					$catalog->setPictureWidth($sizeArray[0]);
//					$catalog->setPictureHeight($sizeArray[1]);

			}
		}

    if($this->request->getParameter('confirm')) {

	  	if($this->request->getParameter('delete')) {
				@unlink(PICT_DIR.$catalog->getPicture());
				$catalog->setPicture('');
	  	}

      $catalog->fromArray($this->request->getParameter('data'));
      $catalog->save();
			$catalog = new Catalog($_GET['id']);
/*      echo '<script type=\'text/javascript\'>location.href=\'index.php?mod=catalog&act=edit&id='.(int)$_GET['id'].'\'</script>';*/

    }
    $this->response->addParameter('data', $catalog->toArray());
    $this->response->addParameter('moduletpl', 'catalog/templates/edit.tpl');

  }

  protected function delete() {
    $catalog = new Catalog($_GET['id']);
    $catalog->delete();
    $this->getAll();
  }
  
  
   protected function dragDropMove() {	 
	$Page_tree = new Tree();	 
	$Page_tree->moveNodes($_POST['src'], $_POST['dst'], $_POST['prv']);
	unset($_SESSION['message']);
  }
  
  protected function dragDropRename() {
	if($_POST['id'] && $_POST['name']){
		$node= new Node($_POST['id']);
		$node->setName($_POST['name']);
		$node->modify();
		unset($_SESSION['message']);
	}
  }
  
  protected function dragDropStatus() {	 
	$node= new Node($_POST['id']);
	$node->setActive($_POST['status']);
	$node->modify();
	unset($_SESSION['message']);
  }
  
  protected function dragDropDelete() {	
  	if($_POST['id']){
		$Page_tree = new Tree();	 
		$Page_tree->deleteNode($_POST['id']);
		unset($_SESSION['message']);
	}
  }
  
  protected function dragDropAdd() {
  	if($_POST['name']){		
		$Page_tree = new Tree();
		$newPage = $Page_tree->addNode($this->request->getParameter('id'),$this->request->getParameter('name'));
		echo $newPage->getId();		
		unset($_SESSION['message']);
	}
  }

}

?>