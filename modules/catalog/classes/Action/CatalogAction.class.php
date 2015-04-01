<?php
/**
 * SmartSystem v.5
 *
 * @package smartsystem.Catalog
 */


/**
 * Obsłga modułu zarządzania exhibitorami.
 *
 * @package smartsystem.exhibitor
 */
class CatalogAction extends Action {
	
	protected $passed = false;
	
	public function init() {
		$this->captcha = new Captcha();
		$this->rnd = $this->captcha->rnd_string();
		$this->uid = urlencode	( $this->captcha->md5_encrypt ( $this->rnd ) );
		$this->response->addParameter( 'uid', $this->uid );
		$this->cid = $this->captcha->md5_encrypt	( $this->rnd );
		$this->response->addParameter( 'cid', $this->cid );
	}

	public function doAction($param) {

		$param = strip_tags($param);

		switch ($param) {			
			case 'service' :
				$this->getService();
				break;
			case 'otherpage' :
				$this->getOtherPage();
				break;
			default:
				$this->getAll();
				break;
		}

	}

	protected function getOtherPage(){
		  $otherpage = new OtherPage((int)$_GET['id']);
	  	  $this->response->addParameter('page', $otherpage);
		  $this->response->addParameter('moduletpl', 'catalog/templates/otherpage.tpl');
	}

  protected function getAll() {
	  $catalog = new Catalog((int)$_GET['id']);
	  $this->response->addParameter('curent_tatalog', $catalog->toArray());
	  
	  $service_list = new ServiceSimpleCollection((int)$_GET['id']);
	  $this->response->addParameter('service_list', $service_list);
    $this->response->addParameter('moduletpl', 'catalog/templates/list.tpl');
  }
  
   protected function getService() {
	  $catalog = new Catalog((int)$_GET['id']);
	  $this->response->addParameter('curent_tatalog', $catalog->toArray());
	  
	  $service = new Service((int)$_GET['id_service']);
	  $this->response->addParameter('service', $service->toArray());
    $this->response->addParameter('moduletpl', 'catalog/templates/service.tpl');
	
	
		if(strlen($this->request->getParameter('cid'))>0)
		{
			$cid = $this->captcha->md5_decrypt ( $this->request->getParameter('cid') );
			if ( $cid == strtoupper($this->request->getParameter('uid')) ) 
			{
				$this->passed = true;
			}
			else {
				$this->passed = false;
			}

		}
		
		
		if( $this->passed && $this->request->getParameter('data') )
		{
			$order = new Order();
			$order->fromArray( $this->request->getParameter('data') );
			$service = $this->request->getParameter('id_service');
			$order->setIdService( $service );
			if( $order->save() ){
				$this->response->addParameter('sended', true);				
				
				$service = new Service( $service );
				$service = $service->toArray();
				
				$mailer = new SNSMailer('default');
				$mailer->AddAddress( $order->getEmail() );
				$mailer->Subject = SITE_NAME.' - Your order';
				$mailer->assign( 'order', $order->toArray() );
				$mailer->assign( 'service', $service );
				$mailer->setTpl('smtp_account/templates/mail_order.tpl');
				if( $mailer->Send() ) {
					$mailer->ClearAddresses();
					$mailer->Subject = SITE_NAME.' - nowe zamówienie';
					$mailer->AddAddress( ADMIN_MAIL );
					$mailer->Send();
					unset($mailer);
				}				
				
			}
		}

  }

  protected function edit() {
  }

  protected function delete() {
  }


  protected function ajaxCaptcha() {
			$passed = false;
			if(strlen($_POST['cid'])>0)
			{
				$cid = $this->captcha->md5_decrypt ( $_POST['cid'] );
				if ( $cid == strtoupper($_POST['uid']) ) 
				{
					$passed = true;
				}
				else {
					$passed = false;
				}
			}elseif(strlen($_GET['cid'])>0)
			{
				$cid = $this->captcha->md5_decrypt ( $_GET['cid'] );
				if ( $cid == strtoupper($_GET['uid']) ) 
				{
					$passed = true;
				}
				else {
					$passed = false;
				}
			}
			echo json_encode($passed);
			die; 
  }
	
}
?>