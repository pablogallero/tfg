<?php
//file: controller/PostController.php

require_once(__DIR__."/../model/Comment.php");
require_once(__DIR__."/../model/Videotutorial.php");
require_once(__DIR__."/../model/VideotutorialMapper.php");
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
class VideotutorialesController extends BaseController {

	/**
	* Reference to the PostMapper to interact
	* with the database
	*
	* @var PostMapper
	*/
	private $videotutorialMapper;

	public function __construct() {
		parent::__construct();

		$this->videotutorialMapper = new VideotutorialMapper();
		
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
		
		// obtain the data from the database
		$videotutoriales = $this->videotutorialMapper->findAll();
		// put the array containing Post object to the view
		
		$videotutorialesr=array_reverse($videotutoriales);
		$this->view->setVariable("videotutoriales", $videotutorialesr);
		
		// render the view (/view/noticias/index.php)
		$this->view->render("videotutoriales", "showall");
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
	public function showcurrent(){
		if (!isset($_GET["id"])) {
			$this->view->setFlashF(i18n("No se encuentra la id"));
					throw new Exception();
		}
	


		$videotutoid = $_GET["id"];

		// find the Post object in the database
		$videotutorial= $this->videotutorialMapper->findById($videotutoid);

		if ($videotutorial == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el videotutorial"));
					throw new Exception();
		}

		// put the Post object to the view
		$this->view->setVariable("videotutorial", $videotutorial);

		

		// render the view (/view/posts/view.php)
		$this->view->render("videotutoriales", "showcurrent");

	}



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
	public function add() {
		try{
			
			if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
				$this->view->setFlashF(i18n("Se requiere ser administrador"));
						throw new Exception();
			}
	
		$videotutorial = new Videotutorial();

		if (isset($_POST["titulo"]) && isset($_POST["enlace"]) && isset($_POST["descripcion"])) { // reaching via HTTP Post...

			// populate the Post object with data form the form
			$videotutorial->setTitulo($_POST["titulo"]);
			$videotutorial->setEnlace($_POST["enlace"]);
			$videotutorial->setDescripcion($_POST["descripcion"]);
			// The user of the Post is the currentUser (user in session)
				

			try {
				// validate Post object
				if(strlen($videotutorial->getTitulo())<1   ){
					$this->view->setFlashF(i18n("Título demasiado corto"));
					throw new Exception();
				}
				if( strlen($videotutorial->getEnlace()) < 5  ){
					$this->view->setFlashF(i18n("Enlace demasiado corto"));
					throw new Exception();
					
				}
				if( strlen($videotutorial->getDescripcion()) < 1  ){
					$this->view->setFlashF(i18n("Descripción demasiado corta"));
					throw new Exception();
					
				}

				// save the Post object into the database
				$this->videotutorialMapper->save($videotutorial);

				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash(sprintf(i18n("El videotutorial \"%s\" se agregó correctamente."),$videotutorial->getTitulo()));

				// perform the redirection. More or less:
				header("Location: index.php?controller=videotutoriales&action=showall&pagina=0");
				// die();
				

			} catch(Exception $ex) {
				$this->view->popFlashF();
			header("Location: index.php?controller=videotutoriales&action=add");
			}
		}

		// Put the Post object visible to the view
		$this->view->setVariable("videotutorial", $videotutorial);

		// render the view (/view/posts/add.php)
		$this->view->render("videotutoriales", "add");
	} catch(Exception $ex) {
		$this->view->popFlashF();
		header("Location: index.php?controller=videotutoriales&action=showall&pagina=0");
	}
	}

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
				$this->view->setFlashF(i18n("No se encuentra la id"));
						throw new Exception();
			}
			if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
				$this->view->setFlashF(i18n("Se requiere ser administrador"));
						throw new Exception();
			}


		// Get the Post object from the database
		$videotutorialid = $_GET["id"];
		$videotutorial= $this->videotutorialMapper->findById($videotutorialid);

		// Does the post exist?
		if ($videotutorial == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el videotutorial"));
					throw new Exception();
		}

		

		if (isset($_POST["titulo"])) { // reaching via HTTP Post...

			// populate the Post object with data form the form
			$videotutorial->setTitulo($_POST["titulo"]);
			$videotutorial->setEnlace($_POST["enlace"]);
			$videotutorial->setDescripcion($_POST["descripcion"]);
			try {
				if(strlen($videotutorial->getTitulo())<1   ){
					$this->view->setFlashF(i18n("Título demasiado corto"));
					throw new Exception();
				}
				if( strlen($videotutorial->getEnlace()) < 5  ){
					$this->view->setFlashF(i18n("Enlace demasiado corto"));
					throw new Exception();
					
				}
				if( strlen($videotutorial->getDescripcion()) < 1  ){
					$this->view->setFlashF(i18n("Descripción demasiado corta"));
					throw new Exception();
					
				}

				// update the Post object in the database
				$this->videotutorialMapper->update($videotutorial);

				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash(sprintf(i18n("El videotutorial \"%s\" se editó correctamente."),$videotutorial->getTitulo()));

				// perform the redirection. More or less:
				// header("Location: index.php?controller=posts&action=index")
				// die();
				header("Location: index.php?controller=videotutoriales&action=showall&pagina=0");

			}catch(Exception $ex) {
				$this->view->popFlashF();
			header("Location: index.php?controller=videotutoriales&action=edit&id=$videotutorialid");
			}
		}

	// Put the Post object visible to the view
	$this->view->setVariable("videotutorial", $videotutorial);

	// render the view (/view/posts/edit.php)
	
	$this->view->render("videotutoriales", "edit");
		} catch(Exception $ex) {
			$this->view->popFlashF();
			header("Location: index.php?controller=videotutoriales&action=showall&pagina=0");
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
		try{
			if (!isset($_GET["id"])) {
				$this->view->setFlashF(i18n("No se encuentra la id"));
						throw new Exception();
			}
			if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
				$this->view->setFlashF(i18n("Se requiere ser administrador"));
						throw new Exception();
			}

		// Get the Post object from the database
		$videotutorialid = $_GET["id"];
		$videotutorial = $this->videotutorialMapper->findById($videotutorialid);

		// Does the post exist?
		if ($videotutorial== NULL) {
			$this->view->setFlashF(i18n("No se encuentra el videotutorial"));
					throw new Exception();
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

	} catch(Exception $ex) {
		$this->view->popFlashF();
		header("Location: index.php?controller=videotutoriales&action=showall&pagina=0");
	}

	}
}
