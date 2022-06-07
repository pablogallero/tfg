<?php
//file: controller/PostController.php

require_once(__DIR__."/../model/Comment.php");
require_once(__DIR__."/../model/Noticia.php");
require_once(__DIR__."/../model/NoticiaMapper.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Patrocinador.php");
require_once(__DIR__."/../model/PatrocinadorMapper.php");
require_once(__DIR__."/../model/Categoria.php");
require_once(__DIR__."/../model/CategoriaMapper.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
* Class PostsController
*
* Controller to make a CRUDL of Posts entities
*
* @author lipido <lipido@gmail.com>
*/
class NoticiasController extends BaseController {

	/**
	* Reference to the PostMapper to interact
	* with the database
	*
	* @var PostMapper
	*/
	private $noticiaMapper;
	private $patrocinadorMapper;
	private $categoriaMapper;

	public function __construct() {
		parent::__construct();
		$this->patrocinadorMapper = new PatrocinadorMapper();
		$this->noticiaMapper = new NoticiaMapper();
		$this->categoriaMapper = new CategoriaMapper();
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
		$num=0;
		// obtain the data from the database
		$noticias = $this->noticiaMapper->findAll();
		// put the array containing Post object to the view
		
		$categorias = $this->categoriaMapper->findAll();
		
		while($num < count($categorias)){
			
			$patrocinadores[$num]= $this->patrocinadorMapper->findCategoriaPatrocinador($categorias[$num]->getId());
			
			$num=$num+1;

		}
		
		$noticiasr=array_reverse($noticias);
		for($x=0;$x<=2;$x=$x+1){
			$noticiastres[$y]=$noticiasr[$x];
			$y=$y+1;
		}
		
		$this->view->setVariable("noticias", $noticiastres);
		$this->view->setVariable("patrocinadores", $patrocinadores);
		$this->view->setVariable("categorias", $categorias);
		// render the view (/view/noticias/index.php)
		$this->view->render("noticias", "index");
	}

	
	public function showAll() {
		
		// obtain the data from the database
		$noticias = $this->noticiaMapper->findAll();
		// put the array containing Post object to the view
		
		$noticiasr=array_reverse($noticias);
		$this->view->setVariable("noticiasall", $noticiasr);
		
		// render the view (/view/noticias/index.php)
		$this->view->render("noticias", "showall");
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
		try{
			
			if (!isset($_GET["id"])) {
				$this->view->setFlashF(i18n("Se necesita una id"));
							throw new Exception();
			}
		$noticiaid = $_GET["id"];

		// find the Post object in the database
		$noticia = $this->noticiaMapper->findByIdWithComments($noticiaid);
		if ($noticia == NULL) {
			$this->view->setFlashF(i18n("No se encuentra la categoría"));
						throw new Exception();
		}

		// put the Post object to the view
		$this->view->setVariable("noticia", $noticia);

		// check if comment is already on the view (for example as flash variable)
		// if not, put an empty Comment for the view
		$comentario = $this->view->getVariable("comentario");
		$this->view->setVariable("comentario", ($comentario==NULL)?new Comentario():$comentario);

		// render the view (/view/posts/view.php)
		$this->view->render("noticias", "view");
	}catch(Exception $ex) {
		$this->view->popFlashF();
header("Location: index.php?controller=noticias&action=showall&pagina=0");
	}
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
				$this->view->setFlashF(i18n("No se puede editar sin ser administrador"));
						throw new Exception();
				
			}
	
		$noticia = new Noticia();

		if (isset($_POST["titulo"]) && isset($_POST["cuerponoticia"]) && isset($_FILES["imagenruta"]["name"])) { // reaching via HTTP Post...
			
			$name=$_FILES['imagenruta']['name'];
			
			$tmp_name=$_FILES['imagenruta']['tmp_name'];
			$upload_folder="images/";

			$movefile=move_uploaded_file($tmp_name,$upload_folder.$name);
			// populate the Post object with data form the form
			$noticia->setTitulo($_POST["titulo"]);
			$noticia->setCuerponoticia($_POST["cuerponoticia"]);
			$noticia->setImagenruta($_FILES["imagenruta"]["name"]);
			// The user of the Post is the currentUser (user in session)
				

			try {
				if(strlen($noticia->getTitulo())<1   ){
					$this->view->setFlashF(i18n("Titulo demasiado corto"));
					throw new Exception();
				}
				if( strlen($noticia->getCuerponoticia()) < 1  ){
					$this->view->setFlashF(i18n("Cuerpo de noticia no encontrado"));
					throw new Exception();
					
				}
				if( strlen($noticia->getImagenruta()) < 1  ){
					$this->view->setFlashF(i18n("Tamaño incorrecto"));
					throw new Exception();
					
				}

				// save the Post object into the database
				$this->noticiaMapper->save($noticia);

				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash(sprintf(i18n("La noticia \"%s\" se agregó correctamente."),$noticia->getTitulo()));

				// perform the redirection. More or less:
				header("Location: index.php?controller=noticias&action=showall&pagina=0");
				// die();
				

			} catch(Exception $ex) {
				$this->view->popFlashF();
header("Location: index.php?controller=noticias&action=add");
			}
		}

		// Put the Post object visible to the view
		$this->view->setVariable("noticia", $noticia);

		// render the view (/view/posts/add.php)
		$this->view->render("noticias", "add");

	}catch(Exception $ex) {
		$this->view->popFlashF();
header("Location: index.php?controller=noticias&action=showall&pagina=0");
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
			if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
				$this->view->setFlashF(i18n("No se puede añadir sin ser administrador"));
						throw new Exception();
				
			}
		if (!isset($_GET["id"])) {
			$this->view->setFlashF(i18n("Se necesita una id"));
						throw new Exception();
		}

		// Get the Post object from the database
		$noticiaid = $_GET["id"];
		$noticia = $this->noticiaMapper->findById($noticiaid);

		// Does the post exist?
		if ($noticia == NULL) {
			$this->view->setFlashF(i18n("No se puede encuentrar la noticia"));
						throw new Exception();
		}

		if (isset($_POST["titulo"]) && isset($_POST["cuerponoticia"]) && isset($_FILES["imagenruta"]["name"])) { // reaching via HTTP Post...
			$name=$_FILES['imagenruta']['name'];
			
			$tmp_name=$_FILES['imagenruta']['tmp_name'];
			$upload_folder="images/";

			$movefile=move_uploaded_file($tmp_name,$upload_folder.$name);
			// populate the Post object with data form the form
			$noticia->setTitulo($_POST["titulo"]);
			$noticia->setCuerponoticia($_POST["cuerponoticia"]);
			$noticia->setImagenruta($_FILES["imagenruta"]["name"]);

			try {
				
				if(strlen($noticia->getTitulo())<5   ){
					$this->view->setFlashF(i18n("Titulo demasiado corto"));
					throw new Exception();
				}
				if( strlen($noticia->getCuerponoticia()) < 1  ){
					$this->view->setFlashF(i18n("Cuerpo de noticia no encontrado"));
					throw new Exception();
					
				}
				if( strlen($noticia->getImagenruta()) < 1  ){
					$this->view->setFlashF(i18n("Tamaño incorrecto"));
					throw new Exception();
					
				}


				// update the Post object in the database
				$this->noticiaMapper->update($noticia);

				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash(sprintf(i18n("La noticia \"%s\" se modificó correctamente."),$noticia ->getTitulo()));

				// perform the redirection. More or less:
				// header("Location: index.php?controller=posts&action=index")
				// die();
				header(sprintf("Location: index.php?controller=noticias&action=view&id=%s",$noticia ->getId()));

			}catch(Exception $ex) {
				$this->view->popFlashF();
		header("Location: index.php?controller=noticias&action=edit&id=$noticiaid");
			}
		
		}

		// Put the Post object visible to the view
		$this->view->setVariable("noticia", $noticia);

		// render the view (/view/posts/add.php)
		$this->view->render("noticias", "edit");

	}catch(Exception $ex) {
		$this->view->popFlashF();
header("Location: index.php?controller=noticias&action=showall&pagina=0");
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
			if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
				$this->view->setFlashF(i18n("No se puede añadir sin ser administrador"));
						throw new Exception();
				
			}
		if (!isset($_GET["id"])) {
			$this->view->setFlashF(i18n("Se necesita una id"));
						throw new Exception();
		}
		
		// Get the Post object from the database
		$noticiaid = $_GET["id"];
		$noticia = $this->noticiaMapper->findById($noticiaid);

		// Does the post exist?
		if ($noticia == NULL) {
			$this->view->setFlashF(i18n("No se puede encuentrar la noticia"));
						throw new Exception();
		}
		
		// Delete the Post object from the database
		$this->noticiaMapper->delete($noticia);

		// POST-REDIRECT-GET
		// Everything OK, we will redirect the user to the list of posts
		// We want to see a message after redirection, so we establish
		// a "flash" message (which is simply a Session variable) to be
		// get in the view after redirection.
		$this->view->setFlash(sprintf(i18n("El videotutorial \"%s\" se borró correctamente."),$noticia->getTitulo()));

		// perform the redirection. More or less:
		// header("Location: index.php?controller=posts&action=index")
		// die();
		header("Location: index.php?controller=noticias&action=showall&pagina=0");
	}catch(Exception $ex) {
		$this->view->popFlashF();
	header("Location: index.php?controller=noticias&action=showall&pagina=0");
	}
	}


}
