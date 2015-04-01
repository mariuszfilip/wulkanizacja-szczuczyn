<?php
class Smtp_accountAction extends Action {
  public function init() {
  }
  
  public function doAction($param) {  
    $menuTopL = array();
    $menuTopA = array();
    $menuTopR = array();

    if( $param == 'list' || $param == '') {
      $menuTopA = array ( 'title' => 'Lista' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=smtp_account' ) ;
    } elseif ( $param == 'add' ) {
      $menuTopL[] = array ( 'title' => 'Lista' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=smtp_account' ) ;
      $menuTopA = array ( 'title' => 'Dodawanie' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=smtp_account&amp;act=add' ) ;
    } elseif ( $param == 'edit' ) {
      $menuTopL[] = array ( 'title' => 'Lista' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=smtp_account' ) ;
      $menuTopA = array ( 'title' => 'Edycja' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=smtp_account&amp;act=edit&amp;id='.$this->request->getParameter('id') ) ;
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
      case 'ajax_test_mail':
        $this->ajaxTestMail();
        break;
	  	case 'ajax_set_default':
        $this->ajaxSetDefault();
        break;		
      case 'list':
      default:
        $this->getAll();
        break;
    }
  }

  protected function add() {
    $smtp_account = new Smtp_account();
    $smtp_account->fromArray($this->request->getParameter('data'));
    if($this->request->getParameter('confirms')) {
      if($smtp_account->save()) {
        $this->getAll();
      } else {
        $this->response->addParameter('data', $smtp_account);
        $this->response->addParameter('moduletpl', 'smtp_account/templates/add.tpl');
      }
    } else {
      $this->response->addParameter('moduletpl', 'smtp_account/templates/add.tpl');
    }
  }

  protected function getAll() {
    $menuTopL = array();
    $menuTopA = array();
    $menuTopR = array();
    $menuTopA = array( 'title' => 'Lista' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=smtp_account' );

    $this->response->addParameter('menuTopL', $menuTopL);
    $this->response->addParameter('menuTopA', $menuTopA);
    $this->response->addParameter('menuTopR', $menuTopR);    
    $this->response->addParameter('moduletpl', 'smtp_account/templates/list.tpl');
  }

  protected function edit() {
    $id = $this->request->getParameter('id');
    $smtp_account = new Smtp_account( (int)$id );
    if($this->request->getParameter('confirms')) {
      $smtp_account->fromArray($this->request->getParameter('data'));
      $smtp_account->save();
			$smtp_account = new Smtp_account( (int)$id );
    }    
    $this->response->addParameter('data', $smtp_account);
    $this->response->addParameter('moduletpl', 'smtp_account/templates/edit.tpl');
  }

  protected function delete() {
    $id = $this->request->getParameter('id');
    $smtp_account = new Smtp_account($id);
    $smtp_account->delete();
    $this->getAll();
  }
  
  
  protected function ajaxTestMail(){	  
	if($_POST['mail'] && $_POST['host'] && $_POST['user'] && $_POST['pass'] && $_POST['s_to']){		
		$subject = 'E-mail testowy';
		$emailContent = 'To jest wiadomość testowa.<br>Prosimy na nią nie odpowiadać.';		
		if($mailer) unset($mailer);
		$mailer = new SNSMailer();
		$mailer->IsSMTP();
		$mailer->IsHTML(true);
		//$mailer->SetLanguage( 'pl', ROOT_DIR.'lib/phpmailer/language/' );
		//$mailer->Port = 465;
		//$mailer->SMTPSecurity  = 'tls';
		$mailer->CharSet = 'utf-8';
		$mailer->Host = $_POST['host'];
		if($_POST['smtpauth']  == 'true') $mailer->SMTPAuth = true; else $mailer->SMTPAuth = false;
		$mailer->Username = $_POST['user'];
		$mailer->Password = $_POST['pass'];
		$mailer->From = $_POST['mail'];
		$mailer->AddAddress($_POST['s_to']);
		$mailer->AddReplyTo($_POST['mail'], SITE_NAME);
		$mailer->Subject = $subject;
		$mailer->Body = $emailContent;
		if($mailer->Send()) {
			echo '<br \><br \>Wiadomość testowa została wysłana na adres <i>'.$_POST['s_to'].'</i>.';
			return true;
		} else {
			echo "<br /><br /><div style='color:red; margin-bottom:10px;'>" . $mailer->ErrorInfo.'</div>';
			return false;
		}	  
	}
	die;
  }
  
  protected function ajaxSetDefault(){	  
	if( $_GET['id'] ){
		$smtp_account = new Smtp_account( $_GET['id'] );
		$smtp_account->setDefault();
	}
	die;
  }
  
}
?>