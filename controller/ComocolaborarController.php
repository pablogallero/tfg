<?php
//file: controller/PostController.php

require_once(__DIR__."/../model/Comment.php");
require_once(__DIR__."/../model/Comocolaborar.php");
require_once(__DIR__."/../model/ComocolaborarMapper.php");
require_once(__DIR__."/../model/User.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
* Class PostsController
*
* Controller to make a CRUDL of Posts entities
*
* @author lipido <lipido@gmail.com>
*/
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
	/**
	* Action to view a given post
	*
	* This action should only be called via GET
	*
	* The expected HTTP parameters are:
	* <ul>
	* <li>id: Id of the post (via HTTP GET)</li>
	* </ul>
	*
	* The views are:
	* <ul>
	* <li>posts/view: If post is successfully loaded (via include).	Includes these view variables:</li>
	* <ul>
	*	<li>post: The current Post retrieved</li>
	*	<li>comment: The current Comment instance, empty or
	*	being added (but not validated)</li>
	* </ul>
	* </ul>
	*
	* @throws Exception If no such post of the given id is found
	* @return void
	*
	*/
	
	
	/**
	* Action to add a new post
	*
	* When called via GET, it shows the add form
	* When called via POST, it adds the post to the
	* database
	*
	* The expected HTTP parameters are:
	* <ul>
	* <li>title: Title of the post (via HTTP POST)</li>
	* <li>content: Content of the post (via HTTP POST)</li>
	* </ul>
	*
	* The views are:
	* <ul>
	* <li>posts/add: If this action is reached via HTTP GET (via include)</li>
	* <li>posts/index: If post was successfully added (via redirect)</li>
	* <li>posts/add: If validation fails (via include). Includes these view variables:</li>
	* <ul>
	*	<li>post: The current Post instance, empty or
	*	being added (but not validated)</li>
	*	<li>errors: Array including per-field validation errors</li>
	* </ul>
	* </ul>
	* @throws Exception if no user is in session
	* @return void
	*/
	
	/**
	* Action to edit a post
	*
	* When called via GET, it shows an edit form
	* including the current data of the Post.
	* When called via POST, it modifies the post in the
	* database.
	*
	* The expected HTTP parameters are:
	* <ul>
	* <li>id: Id of the post (via HTTP POST and GET)</li>
	* <li>title: Title of the post (via HTTP POST)</li>
	* <li>content: Content of the post (via HTTP POST)</li>
	* </ul>
	*
	* The views are:
	* <ul>
	* <li>posts/edit: If this action is reached via HTTP GET (via include)</li>
	* <li>posts/index: If post was successfully edited (via redirect)</li>
	* <li>posts/edit: If validation fails (via include). Includes these view variables:</li>
	* <ul>
	*	<li>post: The current Post instance, empty or being added (but not validated)</li>
	*	<li>errors: Array including per-field validation errors</li>
	* </ul>
	* </ul>
	* @throws Exception if no id was provided
	* @throws Exception if no user is in session
	* @throws Exception if there is not any post with the provided id
	* @throws Exception if the current logged user is not the author of the post
	* @return void
	*/
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

	/**
	* Action to delete a post
	*
	* This action should only be called via HTTP POST
	*
	* The expected HTTP parameters are:
	* <ul>
	* <li>id: Id of the post (via HTTP POST)</li>
	* </ul>
	*
	* The views are:
	* <ul>
	* <li>posts/index: If post was successfully deleted (via redirect)</li>
	* </ul>
	* @throws Exception if no id was provided
	* @throws Exception if no user is in session
	* @throws Exception if there is not any post with the provided id
	* @throws Exception if the author of the post to be deleted is not the current user
	* @return void
	*/
	public function delete() {
		if (!isset($_GET["id"])) {
			throw new Exception("id is mandatory");
		}
		if ($_SESSION['rol']!= "administrador") {
			throw new Exception("Borrar videotutoriales requiere rol de administrador");
		}
		
		// Get the Post object from the database
		$videotutorialid = $_GET["id"];
		$videotutorial = $this->videotutorialMapper->findById($videotutorialid);

		// Does the post exist?
		if ($videotutorial== NULL) {
			throw new Exception("No existe dicho ese videotutorial");
		}

		
		// Delete the Post object from the database
		$this->videotutorialMapper->delete($videotutorial);

		// POST-REDIRECT-GET
		// Everything OK, we will redirect the user to the list of posts
		// We want to see a message after redirection, so we establish
		// a "flash" message (which is simply a Session variable) to be
		// get in the view after redirection.
		$this->view->setFlash(sprintf(i18n("El videotutorial \"%s\" se borró correctamente."),$videotutorial->getTitulo()));

		// perform the redirection. More or less:
		// header("Location: index.php?controller=posts&action=index")
		// die();
		header("Location: index.php?controller=videotutoriales&action=showall&pagina=0");

	}
}
