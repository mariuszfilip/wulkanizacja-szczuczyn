<?php
class PaymentAction extends Action {
  public function init() {  
  }
  
  public function doAction($param) {  
    $menuTopL = array();
    $menuTopA = array();
    $menuTopR = array();

    if( $param == 'list' || $param == '') {
      $menuTopA = array ( 'title' => 'Lista' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=payment' ) ;
    } elseif ( $param == 'add' ) {
      $menuTopL[] = array ( 'title' => 'Lista' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=payment' ) ;
      $menuTopA = array ( 'title' => 'Dodawanie' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=payment&amp;act=add' ) ;
    } elseif ( $param == 'edit' ) {
      $menuTopL[] = array ( 'title' => 'Lista' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=payment' ) ;
      $menuTopA = array ( 'title' => 'Edycja' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=payment&amp;act=edit&amp;id='.$this->request->getParameter('id') ) ;
    }

    $this->response->addParameter('menuTopL', $menuTopL);
    $this->response->addParameter('menuTopA', $menuTopA);
    $this->response->addParameter('menuTopR', $menuTopR);
  
    $param = strip_tags($param);
    switch($param) {
      case 'edit':
        $this->edit();
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
  }

  protected function add() {
    $payment = new Payment();
    $payment->fromArray($this->request->getParameter('data'));
    if($this->request->getParameter('confirms')) {
      if($payment->save()) {
        $this->getAll();
      } else {
        $this->response->addParameter('data', $payment);
        $this->response->addParameter('moduletpl', 'payment/templates/add.tpl');
      }
    } else {
      $this->response->addParameter('moduletpl', 'payment/templates/add.tpl');
    }
  }

  protected function getAll() {
    $menuTopL = array();
    $menuTopA = array();
    $menuTopR = array();
    $menuTopA = array( 'title' => 'Lista' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=payment' );

    $this->response->addParameter('menuTopL', $menuTopL);
    $this->response->addParameter('menuTopA', $menuTopA);
    $this->response->addParameter('menuTopR', $menuTopR);
	
	$s = Session::getInstance();
	if( $this->request->getParameter( 'search_payment' ) )
	{
		$s->setAttribute('s_payment', $this->request->getParameter( 's_payment' ) );
		$_SESSION['paging'][$this->request->getParameter( 'mod' )]=0;
	}

	if( $s->is_set( 's_payment' ) )
	{
		$this->response->addParameter('s_payment', $s->getAttribute('s_payment') );
    }
    
    $this->response->addParameter('moduletpl', 'payment/templates/list.tpl');
  }

  protected function edit() {
    $id = $this->request->getParameter('id');
    $payment = new Payment( ( int )$id );
    if($this->request->getParameter('confirms')) {
      $payment->fromArray($this->request->getParameter('data'));
      $payment->save();
			$payment = new Payment( (int)$id );
    }
    $this->response->addParameter('data', $payment);
    $this->response->addParameter('moduletpl', 'payment/templates/edit.tpl');
  }

  protected function delete() {
    $id = $this->request->getParameter('id');
    $payment = new Payment($id);
    $payment->delete();
    $this->getAll();
  }
  
}
?>