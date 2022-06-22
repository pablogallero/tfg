<?php
//file: controller/BaseController.php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/User.php");

/**
 * Class BaseController
 *
 * Implementa un supercontroller para los demás controladores
 */
class BaseController {

	/**
	 * Se instancia el View Manager
	 * @var ViewManager
	 */
	protected $view;

	
	protected $currentUser;

	public function __construct() {

		$this->view = ViewManager::getInstance();

		
		if (session_status() == PHP_SESSION_NONE ) {
			session_start();
		}

		if(isset($_SESSION["currentuser"])) {

			$this->currentUser = new User($_SESSION["currentuser"]);
			
			
			$this->view->setVariable("currentusername",
					$this->currentUser->getEmail());
		}
	}
}
