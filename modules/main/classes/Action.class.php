<?php
/**
 * SmartSystem v.5
 *
 * @package smartsystem
 */


/**
 * Abstrakcyjny obiekt akcji.
 *
 * Klasa jest przeznaczona do rozszerzania.
 *
 * @package smartsystem
 */

abstract class Action 
{
	protected $request  = null;
	protected $response = null;

	public function __construct(Request $request, Response $response) 
	{
		$this->request   = $request;
		$this->response  = $response;
	}

	abstract public function init();

	abstract public function doAction($param);

}
?>