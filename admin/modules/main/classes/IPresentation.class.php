<?php
/**
 * SmartSystem v.4
 *
 * @package smartsystem
 */


/**
 * Interfejs do warstwy prezentacyjnej.
 *
 * Jeśli chcesz zbudować nową warstwę prezentacyjną to musisz zaimplementować
 * ten interfejs.
 *
 * @package smartsystem
 */
interface IPresentation {

  public function assignResponse(Response $response);

}

?>