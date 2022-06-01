<?php
//file: controller/PostController.php

require_once(__DIR__."/../model/Comment.php");
require_once(__DIR__."/../model/Calendario.php");
require_once(__DIR__."/../model/CalendarioMapper.php");
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
class CalendarioController extends BaseController {

	/**
	* Reference to the PostMapper to interact
	* with the database
	*
	* @var PostMapper
	*/
	private $calendarioMapper;

	public function __construct() {
		parent::__construct();

		$this->calendarioMapper = new CalendarioMapper();
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
		$calendario = $this->calendarioMapper->findAll();
		// put the array containing Post object to the view
		
		$events=array();
		foreach ($calendario as $calendar ) {
			$events[]=[
				'id' => $calendar->getId(),
				'title' => $calendar->getTitulo(),
				'start' => $calendar->getInicio(),
				'end' => $calendar->getFin(),
				'color' => $calendar->getColor(),

			];
		}
		$this->view->setVariable("events", $events);
		
		// render the view (/view/noticias/index.php)
		$this->view->render("calendario", "showall");
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
		try{
			if (!isset($_SESSION['rol']) || $_SESSION['rol']!="administrador"){
				$this->view->setFlashF(i18n("Añadir eventos requiere ser administrador del sistema"));
				throw new Exception();
			}

		$evento= new Calendario();
		if (!isset($_POST["title"])) {
			$this->view->setFlashF(i18n("No se encuentra el título"));
			throw new Exception();
		}
		
		if (isset($_POST['title'])) { // reaching via HTTP Post...
			
			// populate the Post object with data form the form
			$evento->setTitulo($_POST['title']);
			$evento->setColor($_POST['color']);
			$evento->setInicio($_POST['start_date']." ".$_POST['start_hour']);
			$evento->setFin($_POST['end_date']." ".$_POST['end_hour']);

			// The user of the Post is the currentUser (user in session)
			

			try {
				
				if(strlen($evento->getTitulo())<1   ){
					$this->view->setFlashF(i18n("Formato incorrecto del título"));
					throw new Exception();
				}
				if( $evento->getColor() == NULL  ){
					$this->view->setFlashF(i18n("Color vacío"));
					throw new Exception();
					
				}
				if( $evento->getInicio() == NULL  ){
					$this->view->setFlashF(i18n("La fecha de inicio es incorrecta"));
					throw new Exception();
					
				}
				if( $evento->getFin() == NULL  ){
					$this->view->setFlashF(i18n("La fecha de inicio es incorrecta"));
					throw new Exception();
					
				}
				// save the Post object into the database
				$this->calendarioMapper->save($evento);

				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash("La inserción se realizó correctamente");

				// perform the redirection. More or less:
				// header("Location: index.php?controller=posts&action=index")
				// die();
				$this->view->redirect("calendario", "showall");

			}catch(Exception $ex) {
				// Get the errors array inside the exepction...
				$this->view->popFlashF();
				header("Location: index.php?controller=calendario&action=showall");
			}
		}}

		catch(Exception $ex){
			$this->view->popFlashF();
			header("Location: index.php?controller=calendario&action=showall");
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
			if (!isset($_SESSION['rol']) || $_SESSION['rol']!="administrador"){
				$this->view->setFlashF(i18n("Modificar eventos requiere ser administrador del sistema"));
				throw new Exception();
			}
	
			
		// Get the Post object from the database
		$eventoid = $_POST["ided"];
		if (!isset($_POST["ided"])) {
			$this->view->setFlashF(i18n("No se encuentra la id"));
			throw new Exception();
		}
		$evento = $this->calendarioMapper->findById($eventoid);

		// Does the post exist?
		if ($evento == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el evento"));
			throw new Exception();
		}

	

		if (isset($_POST["titleed"])) { // reaching via HTTP Post...

			$evento->setTitulo($_POST['titleed']);
			$evento->setColor($_POST['colored']);
			$evento->setInicio($_POST['start_dateed']." ".$_POST['start_houred']);
			$evento->setFin($_POST['end_dateed']." ".$_POST['end_houred']);
			if(strlen($evento->getTitulo())<1   ){
				$this->view->setFlashF(i18n("Formato incorrecto del título"));
				throw new Exception();
			}
			if( $evento->getColor() == NULL  ){
				$this->view->setFlashF(i18n("Color vacío"));
				throw new Exception();
				
			}
			if( $evento->getInicio() == NULL  ){
				$this->view->setFlashF(i18n("La fecha de inicio es incorrecta"));
				throw new Exception();
				
			}
			if( $evento->getFin() == NULL  ){
				$this->view->setFlashF(i18n("La fecha de inicio es incorrecta"));
				throw new Exception();
				
			}
			
			try {
				

				// update the Post object in the database
				$this->calendarioMapper->update($evento);

				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash("Evento editado correctamente");

				// perform the redirection. More or less:
				// header("Location: index.php?controller=posts&action=index")
				// die();
				

			}catch(Exception $ex) {
				// Get the errors array inside the exepction...
				
				// And put it to the view as "errors" variable
				$this->view->popFlashF();
				header("Location: index.php?controller=calendario&action=showall");
			}
		}
		$this->view->redirect("calendario", "showall");}

		catch(Exception $ex){
			$this->view->popFlashF();
			header("Location: index.php?controller=calendario&action=showall");
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
			if (!isset($_SESSION['rol']) || $_SESSION['rol']!="administrador"){
				$this->view->setFlashF(i18n("Eliminar eventos requiere ser administrador del sistema"));
				throw new Exception();
			}
			if (!isset($_GET["id"])) {
				$this->view->setFlashF(i18n("No se encuentra la id"));
				throw new Exception();
			}
		
		
		/// Get the Post object from the database
		$eventoid = $_GET["id"];
		$evento = $this->calendarioMapper->findById($eventoid);

		// Existe el evento?	
		if ($evento == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el evento"));
			throw new Exception();
		}

		// Delete the Post object from the database
		$this->calendarioMapper->delete($evento);

		// POST-REDIRECT-GET
		// Everything OK, we will redirect the user to the list of posts
		// We want to see a message after redirection, so we establish
		// a "flash" message (which is simply a Session variable) to be
		// get in the view after redirection.
		$this->view->setFlash("Evento borrado correctamente");

		// perform the redirection. More or less:
		// header("Location: index.php?controller=posts&action=index")
		// die();
		$this->view->redirect("calendario", "showall");
	}

	catch(Exception $ex){
		$this->view->popFlashF();
		header("Location: index.php?controller=calendario&action=showall");
	}

	}
}
