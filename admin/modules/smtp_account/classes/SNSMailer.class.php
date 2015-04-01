<?php
/**
 * SmartSystem v.5
 *
 * @package smartsystem
 */


/**
 * Klasa reprezentujaca wysyłanie maili za pomocą SMTP. Jest to klasa
 * rozszerzająca klasę PHPMailer.
 *
 * @package smartsystem
 */
class SNSMailer extends PHPMailer {

  public function __construct( $id_smtp_account = 0 ) {
	if( $id_smtp_account == 'default' ){
	  $Smtp_account = new Smtp_account();
	  $Smtp_account->getDefault();
	  $Smtp_account = $Smtp_account->toArray();
	  //print_r($Smtp_account);	
	  $this->Host 		= $Smtp_account['host'];
	  $this->Username 	= $Smtp_account['user'];
	  $this->Password 	= $Smtp_account['pass'];
	  $this->From	 	= $Smtp_account['mail'];	
	  $this->SMTPAuth 	= true;
	}elseif( (int)$id_smtp_account > 0 ){
	  $Smtp_account = new Smtp_account( (int)$id_smtp_account );
	  $Smtp_account = $Smtp_account->toArray();
	  //print_r($Smtp_account);	
	  $this->Host 		= $Smtp_account['host'];
	  $this->Username 	= $Smtp_account['user'];
	  $this->Password 	= $Smtp_account['pass'];
	  $this->From	 	= $Smtp_account['mail'];	
	  $this->SMTPAuth 	= true;
	 }else{
		
		if(SMTP_HOST){
			$this->Host = SMTP_HOST;
		}
		
		if(SMTP_USER){
			$this->Username = SMTP_USER;
		}
		
		if(SMTP_PASS){
			$this->Password = SMTP_PASS;
		}
		
		if(SMTP_AUTH){
			$this->SMTPAuth = SMTP_AUTH;
		}
		
		if(SMTP_MAIL){
			$this->From = SMTP_MAIL;
		}
		
	 }
	 
	 $this->IsSMTP();
	 $this->IsHTML(true);
	 $this->CharSet = 'utf-8';
	 
	 if(SITE_NAME){
		$this->FromName = SITE_NAME;
	 }
	  
	 if( $_SESSION['lang'] ) {
	   $this->SetLanguage( $_SESSION['lang'], ROOT_DIR.'lib/phpmailer/language/' );
	 }

  }  
  
  
  public function IsHTML($bool) {
    if($bool == true) {
      $this->ContentType = 'text/html';
			$mailer->AltBody = ($_SESSION['lang']=='pl') ? "Ta wiadomość została wysłana jako HTML. Aby wyświetlić jej treść podejrzyj załączony plik HTML." : "This is the body in plain text for non-HTML mail clients.";
    } else {
      $this->ContentType = 'text/plain';	  
    }
  }
  
  public function assign($variable, $value) {
		if(!$this->emailPresentation) {
				$this->emailPresentation = new Presentation();
				$this->emailPresentation->caching = false;
		}
		$this->emailPresentation->assign($variable, $value);
  }
  
  public function setTpl($tpl) {
		if(!$this->emailPresentation) {
				$this->emailPresentation = new Presentation();
				$this->emailPresentation->caching = false;
		}
		$this->Body = $this->emailPresentation->fetch($tpl);
  }


}
?>