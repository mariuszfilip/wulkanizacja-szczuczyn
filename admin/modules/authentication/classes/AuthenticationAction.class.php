<?php
/**
 * SmartSystem v.5
 *
 * @package smartsystem.authentication
 */


/**
 * Uwierzytelnianie użytkowników
 *
 * @package smartsystem.authentication
 */
class AuthenticationAction extends Action {

  public function init() {
  }

  public function doAction( $param ) {
    switch($param) {
      
      case 'login':
        if($this->request->getParameter('login') && $this->request->getParameter('password')) {
          if($this->login()) {
            $action = new OperatorAction($this->request, $this->response);
            $action->init();
            $action->doAction('list');
          } else {
            $this->response->addParameter('moduletpl', 'authentication/templates/login.tpl');
          }
        } else {
          $this->response->addParameter('moduletpl', 'authentication/templates/login.tpl');
        }
        break;
      case 'logout':
        $this->logout();
        break;
      default:
        $this->out();
        break;
    }

  }

  protected function out() {
  	$this->response->addParameter('moduletpl', 'authentication/templates/login.tpl');
  }

}

?>