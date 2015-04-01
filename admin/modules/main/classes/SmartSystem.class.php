<?php
/**
 * SmartSystem v.4
 *
 * @package smartsystem
 */


/**
 * System
 *
 * Bazowa klasa systemu.
 *
 * @package smartsystem
 */
class SmartSystem {

  protected $request         = null;
  protected $response        = null;
  protected $tpl             = null;
  protected $frontController = null;
  protected $timer           = null;


  public function __construct(Request $request, Response $response, IPresentation $presenter) {
    // Start odliczania czasu
    $this->timer = new Timer();
    $this->timer->start();
    // Uruchamiamy sesję
    Session::getInstance();
  	$this->response = $response;
  	$this->request  = $request;
  	$this->tpl      = $presenter;
    $this->frontController = new FrontController($this->request, $this->response, $this->tpl);
  }

  public function run() {
    try {
      $this->frontController->doService('mod');
    } catch (PDOException $ex) {
    	$message['info']    = 'Błąd połączenie z bazą';
    	$message['message'] = $ex->getMessage();
    	$message['line']    = $ex->getLine();
    	$message['file']    = $ex->getFile();
    } catch (Exception $ex) {
      $message['info']    = 'Błąd';
    	$message['message'] = $ex->getMessage();
    	$message['line']    = $ex->getLine();
    	$message['file']    = $ex->getFile();
    }
    // Koniec odliczania czasu
    $this->timer->stop();
    // Jeśli włączony tryb debugowania, to dołączamy do odpowiedzi wartości
    if(DEBUG == 1) {
      $this->response->addParameter('debug', true);
      $this->response->addParameter('debug_query_no', DB::getCount());
      $this->response->addParameter('debug_time', $this->timer->getTime());
      $this->response->addParameter('debug_exception', $message);
    }
    // Przekazujemy odpowiedź HTTP do warstwy prezentującej
    $this->tpl->assignResponse($this->response);
    // Filtrujemy zawartość
    $this->tpl->load_filter('output','trimwhitespace');
    // Nakazujemy warstwie prezentacyjnej wyświetlenie danych
    $this->tpl->display();
  }

}

?>