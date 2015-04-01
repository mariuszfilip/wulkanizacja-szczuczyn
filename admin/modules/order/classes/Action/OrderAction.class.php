<?php
class OrderAction extends Action {
  public function init() {
	
  }
  
  public function doAction($param) {
  
    $menuTopL = array();
    $menuTopA = array();
    $menuTopR = array();

    if( $param == 'list' || $param == '') {
      $menuTopA = array ( 'title' => 'Lista' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=order' ) ;
    } elseif ( $param == 'add' ) {
      $menuTopL[] = array ( 'title' => 'Lista' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=order' ) ;
      $menuTopA = array ( 'title' => 'Dodawanie' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=order&amp;act=add' ) ;
    } elseif ( $param == 'edit' ) {
      $menuTopL[] = array ( 'title' => 'Lista' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=order' ) ;
      $menuTopA = array ( 'title' => 'Edycja' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=order&amp;act=edit&amp;id='.$this->request->getParameter('id') ) ;
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
    $order = new Order();
    $order->fromArray($this->request->getParameter('data'));
    if($this->request->getParameter('confirms')) {
      if($order->save()) {
        $this->getAll();
      } else {
        $this->response->addParameter('data', $order);
        $this->response->addParameter('moduletpl', 'order/templates/add.tpl');
      }
    } else {
      $this->response->addParameter('moduletpl', 'order/templates/add.tpl');
    }
  }

  protected function getAll() {
    $menuTopL = array();
    $menuTopA = array();
    $menuTopR = array();

    $menuTopA = array ( 'title' => 'Lista' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=order' ) ;

    $this->response->addParameter('menuTopL', $menuTopL);
    $this->response->addParameter('menuTopA', $menuTopA);
    $this->response->addParameter('menuTopR', $menuTopR);
	
	
	
	$s = Session::getInstance();
	if( $this->request->getParameter( 'search_order' ) )
	{
		$s->setAttribute('s_order', $this->request->getParameter( 's_order' ) );
		$_SESSION['paging'][$this->request->getParameter( 'mod' )]=0;
	}

	if( $s->is_set( 's_order' ) )
	{
		$this->response->addParameter('s_order', $s->getAttribute('s_order') );
    }		
	
    
    $this->response->addParameter('moduletpl', 'order/templates/list.tpl');
  }

  protected function edit() {
    $id = $this->request->getParameter('id');
    $order = new Order( (int)$id );
	$service = new Service( $order->getIdService() );
	$service = $service->toArray();
	$this->response->addParameter( 'service', $service );
	
    if($this->request->getParameter('confirms')) {
		$order->fromArray($this->request->getParameter('data'));
		$order->save();
		//print_r( $order->toArray() );
		$mailer = new SNSMailer('default');
		$mailer->AddAddress( $order->getEmail() );
		$mailer->Subject = SITE_NAME.' - Payment for your order';
		$mailer->assign( 'order', $order->toArray() );
		$mailer->assign( 'service', $service );
		$code = $this->md5_encrypt($order->getId(),PASSWORD,6);
		$mailer->assign( 'code', urlencode($order->getId().';'.$code) );
		$mailer->setTpl('smtp_account/templates/mail_order.tpl');
		if($mailer->Send()) {
			$order->setActive();
			$order->save();
			$_SESSION['message'] = 'Potwierdzenie zamówienia i link płatności zostały wysłane do klienta.';
			$mailer->ClearAddresses();
			/*$mailer->Subject = SITE_NAME.' - nowe zamówienie';
			$mailer->AddAddress( ADMIN_MAIL );
			$mailer->Send();*/
			unset($mailer);
		}
		$order = new Order( (int)$id );
    }
    
    $this->response->addParameter('data', $order);
    $this->response->addParameter('moduletpl', 'order/templates/edit.tpl');
  }

  protected function delete() {
    $id = $this->request->getParameter('id');
    $order = new Order($id);
    $order->delete();
    $this->getAll();
  }
  
  
  protected function md5_encrypt ( $plain_text, $password = PASSWORD, $iv_len = 16 ) {
    $plain_text .= "\x13";
    $n = strlen ( $plain_text );
    if ( $n % 16 ) $plain_text .= str_repeat ( "\0", 16 - ( $n % 16 ) );
    $i = 0;
    $enc_text = $this->get_rnd_iv ( $iv_len );
    $iv = substr ( $password ^ $enc_text, 0, 512 );
    while ( $i < $n ) {
        $block = substr ( $plain_text, $i, 16 ) ^ pack ( 'H*', md5 ( $iv ) );
        $enc_text .= $block;
        $iv = substr ( $block . $iv, 0, 512 ) ^ $password;
        $i += 16;
    }
    return base64_encode ( $enc_text );
}

/*
:::::::::::::::::::::::::::::::::::::::::::::::::::
::
::	md5_decrypt...
::
*/
protected function md5_decrypt ( $enc_text, $password = PASSWORD, $iv_len = 16 ) {
    $enc_text = base64_decode ( $enc_text );
    $n = strlen ( $enc_text );
    $i = $iv_len;
    $plain_text = '';
    $iv = substr ( $password ^ substr ( $enc_text, 0, $iv_len ), 0, 512 );
    while ( $i < $n ) {
        $block = substr ( $enc_text, $i, 16 );
        $plain_text .= $block ^ pack ( 'H*', md5 ( $iv ) );
        $iv = substr ( $block . $iv, 0, 512 ) ^ $password;
        $i += 16;
    }
    return preg_replace ( '/\\x13\\x00*$/', '', $plain_text );
}

/*
:::::::::::::::::::::::::::::::::::::::::::::::::::
::
::	get_rnd_iv...
::
*/
protected function get_rnd_iv ( $iv_len ) {
    $iv = '';
    while ( $iv_len-- > 0 ) {
        $iv .= chr ( mt_rand ( ) & 0xFF );
    }
    return $iv;
}
  
}
?>