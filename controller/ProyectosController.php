<?php
//file: controller/PostController.php

require_once(__DIR__."/../model/Comment.php");
require_once(__DIR__."/../model/Proyecto.php");
require_once(__DIR__."/../model/ProyectoMapper.php");
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
class ProyectosController extends BaseController {

	/**
	* Reference to the PostMapper to interact
	* with the database
	*
	* @var PostMapper
	*/
	private $proyectoMapper;

	public function __construct() {
		parent::__construct();

		$this->proyectoMapper = new ProyectoMapper();
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
	public function index() {
		$noticiastres=array();
		$y=0;
		// obtain the data from the database
		$noticias = $this->noticiaMapper->findAll();
		// put the array containing Post object to the view
		
		$noticiasr=array_reverse($noticias);
		for($x=0;$x<=2;$x=$x+1){
			$noticiastres[$y]=$noticiasr[$x];
			$y=$y+1;
		}
		$this->view->setVariable("noticias", $noticiastres);
		
		// render the view (/view/noticias/index.php)
		$this->view->render("noticias", "index");
	}

	
	public function showAll() {
		
		// obtain the data from the database
		$proyectos = $this->proyectoMapper->findAll();
		// put the array containing Post object to the view
		
		$this->view->setVariable("proyectos", $proyectos);
		
		// render the view (/view/noticias/index.php)
		$this->view->render("proyectos", "showall");
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
	public function view(){
		if (!isset($_GET["id"])) {
			throw new Exception("Se necesita una id de proyecto");
		}

		$proyectoid = $_GET["id"];

		// find the Post object in the database
		$proyecto = $this->proyectoMapper->findById($proyectoid);

		if ($proyecto == NULL) {
			throw new Exception("No existe un proyecto con esa id: ".$proyectoid);
		}

		// put the Post object to the view
		$this->view->setVariable("proyecto", $proyecto);

		// check if comment is already on the view (for example as flash variable)
		// if not, put an empty Comment for the view

		// render the view (/view/posts/view.php)
		$this->view->render("proyectos", "view");

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
		if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
			throw new Exception("No se puede añadir sin ser administrador");
		}

		$proyecto = new Proyecto();

		if (isset($_POST["titulo"])) { // reaching via HTTP Post...
			$name=$_FILES['imagen']['name'];
			
			$tmp_name=$_FILES['imagen']['tmp_name'];
			$upload_folder="images/";

			$movefile=move_uploaded_file($tmp_name,$upload_folder.$name);
			// populate the Post object with data form the form
			$proyecto->setTitulo($_POST["titulo"]);
			$proyecto->setImagen($_FILES["imagen"]["name"]);
			$proyecto->setIntroduccion($_POST["introduccion"]);
			$proyecto->setObjetivos($_POST["objetivos"]);
			$proyecto->setMetodologia($_POST["metodologia"]);

			$proyecto->setConclusiones($_POST["conclusiones"]);
				

			try {
				// validate Post object
				//	$noticia->checkIsValidForCreate(); // if it fails, ValidationException

				// save the Post object into the database
				$this->proyectoMapper->save($proyecto);

				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash(sprintf(i18n("El proyecto \"%s\" se añadió correctamente."),$proyecto ->getTitulo()));

				// perform the redirection. More or less:
				header("Location: index.php?controller=proyectos&action=showall");
				// die();
				

			} catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}


		// render the view (/view/posts/add.php)
		$this->view->render("proyectos", "add");

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
		if (!isset($_GET["id"])) {
			throw new Exception("Se necesita una id de proyecto");
		}

		if ($_SESSION['rol']!= "administrador") {
			throw new Exception("Editar proyectos requiere rol de administrador");
		}

		// Get the Post object from the database
		$proyectoid = $_GET["id"];
		$proyecto = $this->proyectoMapper->findById($proyectoid);

		// Does the post exist?
		if ($proyecto == NULL) {
			throw new Exception("no such post with id: ".$postid);
		}

		if (isset($_POST["titulo"])) { // reaching via HTTP Post...
			
			$name=$_FILES['imagen']['name'];
			
			$tmp_name=$_FILES['imagen']['tmp_name'];
			$upload_folder="images/";

			$movefile=move_uploaded_file($tmp_name,$upload_folder.$name);
			// populate the Post object with data form the form
			$proyecto->setTitulo($_POST["titulo"]);
			$proyecto->setImagen($_FILES["imagen"]["name"]);
			$proyecto->setIntroduccion($_POST["introduccion"]);
			$proyecto->setObjetivos($_POST["objetivos"]);
			$proyecto->setMetodologia($_POST["metodologia"]);

			$proyecto->setConclusiones($_POST["conclusiones"]);

			try {
				// validate Post object
				//$post->checkIsValidForUpdate(); // if it fails, ValidationException

				// update the Post object in the database
				$this->proyectoMapper->update($proyecto);

				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash(sprintf(i18n("El proyecto \"%s\" se actualizó correctamente."),$proyecto ->getTitulo()));

				// perform the redirection. More or less:
				// header("Location: index.php?controller=posts&action=index")
				// die();
				//$this->view->redirect("proyectos", "showall");

			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}

		// Put the Post object visible to the view
		$this->view->setVariable("proyecto", $proyecto);

		// render the view (/view/posts/add.php)
		$this->view->render("proyectos", "edit");
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
			throw new Exception("Borrar proyectos requiere rol de administrador");
		}
		
		// Get the Post object from the database
		$proyectoid = $_GET["id"];
		$proyecto = $this->proyectoMapper->findById($proyectoid);

		// Does the post exist?
		if ($proyecto== NULL) {
			throw new Exception("No existe ese proyecto");
		}

		
		// Delete the Post object from the database
		$this->proyectoMapper->delete($proyecto);

		// POST-REDIRECT-GET
		// Everything OK, we will redirect the user to the list of posts
		// We want to see a message after redirection, so we establish
		// a "flash" message (which is simply a Session variable) to be
		// get in the view after redirection.
		$this->view->setFlash(sprintf(i18n("El proyecto \"%s\" se borró correctamente."),$proyecto->getTitulo()));

		// perform the redirection. More or less:
		// header("Location: index.php?controller=posts&action=index")
		// die();
		header("Location: index.php?controller=proyectos&action=showall");

	}
}
