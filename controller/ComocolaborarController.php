<?php
//file: controller/PostController.php

require_once(__DIR__."/../model/Comment.php");
require_once(__DIR__."/../model/Comocolaborar.php");
require_once(__DIR__."/../model/ComocolaborarMapper.php");
require_once(__DIR__."/../model/User.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");


class ComocolaborarController extends BaseController {

	/**
	* Reference to the PostMapper to interact
	* with the database
	*
	* @var PostMapper
	*/
	private $comocolaborarMapper;

	public function __construct() {
		parent::__construct();

		$this->comocolaborarMapper = new ComocolaborarMapper();
		
	}

	/**
	* Action to list posts
	*
	* Loads all the posts from the database.
	* No HTTP parameters are needed.
	*
	* The views are:
	* <ul>
	* <li>posts/index (via include)</li>
	* </ul>
	*/

	public function showAll() {
		try{
		// obtain the data from the database
		$comocolaborar = $this->comocolaborarMapper->findAll();
		if ($comocolaborar== NULL) {
			$this->view->setFlashF(i18n("La sección está vacía"));
			throw new Exception();
			
			
		}
		// put the array containing Post object to the view
		
		$comocolaborarr=array_reverse($comocolaborar);
		
		$this->view->setVariable("comocolaborar", $comocolaborarr);
		
		// render the view (/view/noticias/index.php)
		$this->view->render("colaborar", "comocolaborar");
	}

	catch(Exception $ex){
		$this->view->popFlashF();
		header("Location: index.php?controller=noticias&action=index");
	}
	}
	public function edit() {
		try{
		if (!isset($_GET["id"])) {
			$this->view->setFlashF(i18n("Es necesaria una id"));
			throw new Exception();
			
			
			
			
		}

		if (!isset($_SESSION['rol']) || $_SESSION['rol']!="administrador"){
			$this->view->setFlashF(i18n("No se puede acceder sin ser administrador del sistema"));
			throw new Exception();
		}

		// Get the Post object from the database
		$comocolaborarid = $_GET["id"];
		$comocolaborar= $this->comocolaborarMapper->findById($comocolaborarid);

		// Does the post exist?
		if ($comocolaborar == NULL) {
			throw new Exception("No existe la id");
		}

		

		if (isset($_POST["titulo"])) { // reaching via HTTP Post...
			// populate the Post object with data form the form
			$comocolaborar->setTitulo($_POST["titulo"]);
			$comocolaborar->setDescripcion($_POST["descripcion"]);
			try {
				// validate Post object
				$comocolaborar->checkIsValidForUpdate(); // if it fails, ValidationException

				// update the Post object in the database
				$this->comocolaborarMapper->update($comocolaborar);

				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash("Se editó correctamente");

				// perform the redirection. More or less:
				// header("Location: index.php?controller=posts&action=index")
				// die();
				header("Location: index.php?controller=comocolaborar&action=showall");

			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}

	// Put the Post object visible to the view
	$this->view->setVariable("comocolaborar", $comocolaborar);

	// render the view (/view/posts/edit.php)
	
	$this->view->render("colaborar", "edit");
}

catch(Exception $ex){
	$this->view->popFlashF();
	header("Location: index.php?controller=comocolaborar&action=showall");
}
	}


}
