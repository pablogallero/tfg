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
		

		if (isset($_POST["cuerpocoment"])) { // reaching via HTTP Post...

			

			// Create and populate the Comment object
			$comentario = new Comentario();
			$autor= $this->usermapper->findbyEmail($_SESSION['currentuser']);
			$noticia= $this->noticiamapper->findbyId($_GET['id']);
			$comentario->setCuerpo($_POST["cuerpocoment"]);
			$comentario->setUser($autor);
			$comentario->setNoticia($noticia);

			try {

				// validate Comment object
				$comentario->checkIsValidForCreate(); // if it fails, ValidationException

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
			}catch(ValidationException $ex) {
				$errors = $ex->getErrors();

				// Go back to the form to show errors.
				// However, the form is not in a single page (comments/add)
				// It is in the View Post page.
				// We will save errors as a "flash" variable (third parameter true)
				// and redirect the user to the referring page
				// (the View post page)
				$this->view->setVariable("comment", $comment, true);
				$this->view->setVariable("errors", $errors, true);

				$this->view->redirect("noticias", "view", "id=".$noticia->getId());
			}
		} else {
			throw new Exception("No such post id");
		}
	}
}
