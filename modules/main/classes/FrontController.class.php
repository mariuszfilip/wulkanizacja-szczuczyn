<?php
class FrontController {

  protected $request    = null;
  protected $response   = null;
  protected $tpl        = null;

  public function __construct(Request $request, Response $response, IPresentation $presenter) {
  	$this->request  = $request;
  	$this->response = $response;
  	$this->tpl      = $presenter;
  }

  public function doService($mainParameter) {
  	
  	 $_SESSION['show_debug'] = false;
    //setlocale(LC_TIME,'PL_pl');
    $s = Session::getInstance();
      $lang = $this->request->getParameter('lang');
      $s = Session::getInstance();
      if( !empty( $lang )) {
        $s->setAttribute('lang',strtolower($lang));
      } else {
        if( !$s->is_set('lang') ){
          $s->setAttribute('lang',strtolower(DEFAULT_LANG_FRONT));
        }
      }
		
		define('MYSQL_PASSWORD_METHOD',(USE_OLD_PASSWORD)?'OLD_PASSWORD':'PASSWORD');
		$param = $this->request->getParameter($mainParameter);
    	
    
	
		if($param == '' || !$param) {
     	 $param = 'general';
	 	 $this->request->addParameter('mod', 'general');
		}
		
		if($param == 'user'):
		 $email = $this->request->getParameter('email');
		 $tel = $this->request->getParameter('tel');
		 if($this->validate_email($email) == 1):
		 	$user = new User();
			 $user->setEmail($email);
			 $user->setPhone($tel);
			 $save=0;
			if($user->check() == 0):
		 		$user->save();
		 		$save=1;
			else:
				$save=2;
			endif;
		else:
			$save=3;
		endif;
		 
		 $this->response->addParameter('save', $save);
		 
		 $param = 'general';
	 	 $this->request->addParameter('mod', 'general');
		endif;

   		 $this->response->addParameter('mainParameterName', $mainParameter);
		$this->response->addParameter('mainParameterValue', $param);

	
		$page = new Map();
		//$this->response->addParameter('menuLevelRoot',$page->getAllChildren(0));
		$this->response->addParameter('menuLevelRoot',$page->getTree());
		
	

		$catalogues = new Tree();

		$this->response->addParameter('catalogues',$catalogues->getTree());

	
		$catalogues = new Tree();
		$this->response->addParameter('catalogues',$catalogues->getTree());
		
		$otherpages = new OtherPagesCollection();
		$this->response->addParameter('otherpages',$otherpages->getItems());
		
		$events = new EventsSimpleCollection(2);  // dwie ostatnie aktualnosci
		$this->response->addParameter('last_events', $events->getArr());

    //$act = $this->request->getParameter("act");

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
		
		// meta tagi
		$meta = new Meta($this->request, $this->response);
		$this->response->addParameter('meta',$meta->getMeta());
		
		// debuger
		//if(DEBUG) //$this->response->addParameter('sql_log', DB::getLog());
  }
  
 	 function  validate_email($email) {
  		if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email))
 		 {
   		return 0;
  			} else return 1;
		}

		}
?>