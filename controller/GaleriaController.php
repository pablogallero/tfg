<?php
//file: controller/PostController.php

require_once(__DIR__."/../model/Comment.php");
require_once(__DIR__."/../model/Galeria.php");
require_once(__DIR__."/../model/GaleriaMapper.php");
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
class GaleriaController extends BaseController {

	/**
	* Reference to the PostMapper to interact
	* with the database
	*
	* @var PostMapper
	*/
	private $galeriaMapper;

	public function __construct() {
		parent::__construct();

		$this->galeriaMapper = new GaleriaMapper();
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
		$fotos = $this->galeriaMapper->findAll();
		// put the array containing Post object to the view
		
		$fotosr=array_reverse($fotos);
		$this->view->setVariable("fotos", $fotosr);
		
		// render the view (/view/noticias/index.php)
		$this->view->render("galeria", "showall");
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
			throw new Exception("id is mandatory");
		}

		$postid = $_GET["id"];

		// find the Post object in the database
		$post = $this->postMapper->findByIdWithComments($postid);

		if ($post == NULL) {
			throw new Exception("no such post with id: ".$postid);
		}

		// put the Post object to the view
		$this->view->setVariable("post", $post);

		// check if comment is already on the view (for example as flash variable)
		// if not, put an empty Comment for the view
		$comment = $this->view->getVariable("comment");
		$this->view->setVariable("comment", ($comment==NULL)?new Comment():$comment);

		// render the view (/view/posts/view.php)
		$this->view->render("posts", "view");

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
		if ($_SESSION['rol']!= "administrador") {
			throw new Exception("Añadir imágenes requiere rol de administrador");
		}

		$galeria = new Galeria();

		if (isset($_POST["titulo"] )&& isset($_FILES["imagen"])) { // reaching via HTTP Post...
			
			$name=$_FILES['imagen']['name'];
			
			$tmp_name=$_FILES['imagen']['tmp_name'];
			$upload_folder="galeria/";

			$movefile=move_uploaded_file($tmp_name,$upload_folder.$name);
			// populate the Post object with data form the form
			$galeria->setTitulo($_POST["titulo"]);
			$galeria->setRuta($_FILES["imagen"]["name"]);
		
		
			try {
				// validate Post object
				//$post->checkIsValidForCreate(); // if it fails, ValidationException

				// save the Post object into the database
				$this->galeriaMapper->save($galeria);

				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash(sprintf(i18n("La imagen \"%s\" se añadió correctamente."),$galeria ->getTitulo()));

				// perform the redirection. More or less:
				//header("Location: index.php?controller=galeria&action=showall&pagina=0");
				// die();
				

			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}

	

		// render the view (/view/posts/add.php)
		$this->view->render("galeria", "add");

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
		if (!isset($_REQUEST["id"])) {
			throw new Exception("A post id is mandatory");
		}

		if ($_SESSION['rol']!= "administrador") {
			throw new Exception("Borrar imágenes requiere rol de administrador");
		}


		// Get the Post object from the database
		$imagenid = $_GET["id"];
		$imagen = $this->galeriaMapper->findById($imagenid);

		// Does the post exist?
		if ($imagen == NULL) {
			throw new Exception("No existe una imagen con esa id: ".$imagenid);
		}

		if (isset($_POST["titulo"])) { // reaching via HTTP Post...

			// populate the Post object with data form the form
			$post->setTitle($_POST["title"]);
			$post->setContent($_POST["content"]);

			try {
				// validate Post object
				$post->checkIsValidForUpdate(); // if it fails, ValidationException

				// update the Post object in the database
				$this->postMapper->update($post);

				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash(sprintf(i18n("Post \"%s\" successfully updated."),$post ->getTitle()));

				// perform the redirection. More or less:
				// header("Location: index.php?controller=posts&action=index")
				// die();
				$this->view->redirect("posts", "index");

			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}

		// Put the Post object visible to the view
		$this->view->setVariable("post", $post);

		// render the view (/view/posts/add.php)
		$this->view->render("posts", "edit");
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
		if (!isset($_GET["imagen"])) {
			throw new Exception("La imagen es necesaria");
		}
		if ($_SESSION['rol']!= "administrador") {
			throw new Exception("Borrar imágenes requiere rol de administrador");
		}


		// Get the Post object from the database
		$imagenid = $_GET["imagen"];
		$imagen = $this->galeriaMapper->findByImagen($imagenid);

		// Does the post exist?
		if ($imagen == NULL) {
			throw new Exception("No existe una imagen con esa id: ".$imagenid);
		}


		// Delete the Post object from the database
		$this->galeriaMapper->delete($imagen);

		// POST-REDIRECT-GET
		// Everything OK, we will redirect the user to the list of posts
		// We want to see a message after redirection, so we establish
		// a "flash" message (which is simply a Session variable) to be
		// get in the view after redirection.
		$this->view->setFlash(sprintf(i18n("La imagen \"%s\" fue borrada correctamente."),$imagen ->getTitulo()));

		// perform the redirection. More or less:
		header("Location: index.php?controller=galeria&action=showall&pagina=0");
		// die();
		

	}
}
