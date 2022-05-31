<?php
//file: /controller/CommentsController.php

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Noticia.php");
require_once(__DIR__."/../model/Comentario.php");

require_once(__DIR__."/../model/NoticiaMapper.php");
require_once(__DIR__."/../model/ComentarioMapper.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
* Class CommentsController
*
* Controller for comments related use cases.
*
* @author lipido <lipido@gmail.com>
*/
class ComentariosController extends BaseController {

	/**
	* Reference to the CommentMapper to interact
	* with the database
	*
	* @var CommentMapper
	*/
	private $comentariomapper;

	private $usermapper;

	/**
	* Reference to the PostMapper to interact
	* with the database
	*
	* @var PostMapper
	*/
	private $noticiamapper;

	public function __construct() {
		parent::__construct();

		$this->comentariomapper = new ComentarioMapper();
		$this->noticiamapper = new NoticiaMapper();
		$this->usermapper = new UserMapper();
	}

	/**
	* Action to adds a comment to a post
	*
	* This method should only be called via HTTP POST.
	*
	* The user of the comment is taken from the {@link BaseController::currentUser}
	* property.
	* The expected HTTP parameters are:
	* <ul>
	* <li>id: Id of the post (via HTTP POST)</li>
	* <li>content: Content of the comment (via HTTP POST)</li>
	* </ul>
	*
	* The views are:
	* <ul>
	* <li>posts/view?id=post: If comment was successfully added of,
	* or if it was not validated (via redirect). Includes these view variables:</li>
	* <ul>
	*	<li>errors (flash): Array including per-field validation errors</li>
	*	<li>comment (flash): The current Comment instance, empty or being added</li>
	* </ul>
	* </ul>
	*
	* @return void
	*/
	public function add() {
		try{
		if (!isset($_SESSION['rol'])){
			$this->view->setFlashF(i18n("Añadir comentarios requiere estar identificado en el sistema"));
			throw new Exception();
		}

		if (!isset($_POST['cuerpocoment'])){
			$this->view->setFlashF(i18n("El comentario no puede estar vacío"));
			throw new Exception();
		}
		if (isset($_POST["cuerpocoment"])) { // reaching via HTTP Post...

			

			// Create and populate the Comment object
			$comentario = new Comentario();
			$autor= $this->usermapper->findbyEmail($_SESSION['currentuser']);
			if ($autor== NULL) {
				$this->view->setFlashF(i18n("No existe dicho autor"));
				throw new Exception();
				
				
			}
			$noticia= $this->noticiamapper->findbyId($_GET['id']);
			if ($noticia== NULL) {
				$this->view->setFlashF(i18n("No existe dicha noticia"));
				throw new Exception();
				
				
			}
			$comentario->setCuerpo($_POST["cuerpocoment"]);
			$comentario->setUser($autor);
			$comentario->setNoticia($noticia);

			try {

				// validate Comment object
				if(strlen($comentario->getCuerpo())<1   ){
					$this->view->setFlashF(i18n("Formato incorrecto de contenido de comentario"));
					throw new Exception();
					
				}
				if( $comentario->getUser() == NULL  ){
					$this->view->setFlashF(i18n("Usuario irreconocible"));
					throw new Exception();
					
				}
				if( $comentario->getNoticia() == NULL  ){
					$this->view->setFlashF(i18n("No se reconoce la noticia"));
					throw new Exception();
					
				}
			
				// save the Comment object into the database
				$this->comentariomapper->save($comentario);

				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				

				// perform the redirection. More or less:
				// header("Location: index.php?controller=posts&action=view&id=$postid")
				// die();
				$this->view->redirect("noticias", "view", "id=".$noticia->getId());
			}catch(Exception $ex) {
				

				// Go back to the form to show errors.
				// However, the form is not in a single page (comments/add)
				// It is in the View Post page.
				// We will save errors as a "flash" variable (third parameter true)
				// and redirect the user to the referring page
				// (the View post page)
				$this->view->popFlashF();
				

				$this->view->redirect("noticias", "view", "id=".$noticia->getId());
			}
		} 
		
	}
catch(Exception $ex){
	$this->view->popFlashF();
	header("Location: index.php?controller=noticias&action=showall&pagina=0");
}
}

	public function delete() {
		try{
		if (!isset($_GET["id"])) {
			$this->view->setFlashF(i18n("Es necesaria una id"));
			throw new Exception();
			
			
			
			
		}
		if (!isset($_SESSION['rol']) || $_SESSION['rol']!= "administrador") {
			$this->view->setFlashF(i18n("Borrar comentarios requiere rol de administrador"));
			throw new Exception();
			
			
			
		}
		
		// Get the Post object from the database
		$comentarioid = $_GET["id"];
		$comentario = $this->comentariomapper->findById($comentarioid);

		// Does the post exist?
		if ($comentario== NULL) {
			$this->view->setFlashF(i18n("No existe dicho comentario"));
			throw new Exception();
			
			
		}

		
		// Delete the Post object from the database
		$this->comentariomapper->delete($comentario);

		// POST-REDIRECT-GET
		// Everything OK, we will redirect the user to the list of posts
		// We want to see a message after redirection, so we establish
		// a "flash" message (which is simply a Session variable) to be
		// get in the view after redirection.
		$this->view->setFlash(i18n("El comentario se borró correctamente."));
		
		// perform the redirection. More or less:
		// header("Location: index.php?controller=posts&action=index")
		// die();
		header("Location: index.php?controller=noticias&action=showall&pagina=0");
		}

		catch(Exception $ex){
			$this->view->popFlashF();
			header("Location: index.php?controller=noticias&action=showall&pagina=0");
		}
		
	}
}
