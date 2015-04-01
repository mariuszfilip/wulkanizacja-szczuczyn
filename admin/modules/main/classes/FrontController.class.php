<?php
require_once( "modules/authentication/classes/Authetication.class.php" );
/**
 * SmartSystem v.5
 *
 * @package smartsystem
 */


/**
 * Główny kontroler systemu.
 *
 * Kontroler wyszukuje akcji na podstawie parametru podanego do metody doService().
 *
 * @package smartsystem
 */
class FrontController {

  /**
   * Żądanie HTTP
   *
   * @var Request
   */
  protected $request    = null;

  /**
   * Odpowiedź HTTP
   *
   * @var Response
   */
  protected $response   = null;

  /**
   * Warstwa prezentacyjna
   *
   * @var Presentation
   */
  protected $tpl        = null;


  /**
   * Konstruktor
   *
   * @param Request $request
   * @param Response $response
   * @param IPresentation $presenter
   */
  public function __construct(Request $request, Response $response, IPresentation $presenter) {
  	$this->request  = $request;
  	$this->response = $response;
  	$this->tpl      = $presenter;
  }

  /**
   * Poszukuje pliku akcji na podstawie podanego parametru.
   *
   * Przy poszukiwaniu wykorzystuje mapowanie klas na parametry a ActionMapping.
   *
   * @param string $mainParameter
   */
  public function doService($mainParameter) {
    $lang = $this->request->getParameter('lang');
		$s = Session::getInstance();
		if( !empty( $lang )) {
			$s->setAttribute('lang',strtolower($lang));
			$langObj = new Language();
			$langObj->setCollation();
		} else {
			if( !$s->is_set('lang') ){
				$s->setAttribute('lang',strtolower(DEFAULT_LANG_ADMIN));
				$langObj = new Language();
				$langObj->setCollation();
			}
		}
		
		define('MYSQL_PASSWORD_METHOD',(USE_OLD_PASSWORD)?'OLD_PASSWORD':'PASSWORD');
		
	  if(isset($_GET['debug']) && ALLOW_DEBUG){
		  if($_GET['debug']=='false' || $_GET['debug']=='none' || $_GET['debug']=='null' || $_GET['debug']=='off' || $_GET['debug']=='0') {
			  unset($_SESSION['sns_debug']);
			  unset($_SESSION['ajax_debug_array']);
		  }
		  else  $_SESSION['sns_debug'] = 1;
	  }	  
	  if($_SESSION['sns_debug'] && ALLOW_DEBUG) define('DEBUG', 1); else define('DEBUG', 0);
      
    $login_confirm = $this->request->getParameter("login_confirm");
    if( $login_confirm ) {
      $a = new Authentication();
      $success = $a->login( $this->request->getParameter("login"),$this->request->getParameter("password") );
      if( $success == false ) {
        $s->setAttribute('login_error','Błąd logowania');
      }
    }

    $logout_confirm = $this->request->getParameter("logout_confirm");
    if( $logout_confirm ) {
      $a = new Authentication();
      $a->logout();
    }
    
    $param = $this->request->getParameter($mainParameter);
    $user = $s->getAttribute('user');
    
    if( count( $user ) > 0 && ( int )$user[ 'id_operator' ] > 0 ) {
      if($param == '') {
        $param = 'general';
      }
    } else {
	  if($param=='page' && $_POST['drag_drop']) {
		echo '<script>document.location.href=\'index.php\';</script>';
		die;
	  }
      $param = 'authentication';
    }
    
    // Dodajemy do odpowiedzi nazwę i wartość głównego parametru
    $this->response->addParameter('mainParameterName', $mainParameter);
    $this->response->addParameter('mainParameterValue', $param);
    
    if($param != null) {
      $actionClass = ActionMapping::find($param);
      if(class_exists($actionClass)) {
        // Inicjujemy obiekt i każemy mu działać :-)
        $action = new $actionClass($this->request, $this->response);
        $action->init();
        $action->doAction($this->request->getParameter('act'));
      } else {
        throw new Exception('Class not found');
      }
    } else {
    	throw new Exception('Empty parameter');
    }
		if(defined('LANGUAGES')) $this->response->addParameter('const_languages', explode('|', LANGUAGES));
		if(DEBUG) $this->response->addParameter('sql_log', DB::getLog());
		if(SQL_SAVE_LOG) DB::SaveLog();
  }

}
?>