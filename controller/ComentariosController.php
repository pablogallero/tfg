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
* Class ComentariosController
*
*/
class ComentariosController extends BaseController {

	/**
	*
	* @var comentarioMapper
	*/
	private $comentariomapper;

	private $usermapper;

	/**
	*
	* @var noticiamapper
	*/
	private $noticiamapper;

	public function __construct() {
		parent::__construct();

		$this->comentariomapper = new ComentarioMapper();
		$this->noticiamapper = new NoticiaMapper();
		$this->usermapper = new UserMapper();
	}

	
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
		if (isset($_POST["cuerpocoment"])) { 

			

			
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

				if( $comentario->getUser() == NULL  ){
					$this->view->setFlashF(i18n("Usuario irreconocible"));
					throw new Exception();
					
				}
				if( $comentario->getNoticia() == NULL  ){
					$this->view->setFlashF(i18n("No se reconoce la noticia"));
					throw new Exception();
					
				}
			
				
				$this->comentariomapper->save($comentario);

				
				$this->view->redirect("noticias", "view", "id=".$noticia->getId());
			}catch(Exception $ex) {
				

				
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
			$this->view->setFlashF(i18n("No se encuentra la id"));
			throw new Exception();
			
			
			
			
		}
		if (!isset($_SESSION['rol']) || $_SESSION['rol']!= "administrador") {
			$this->view->setFlashF(i18n("Borrar comentarios requiere rol de administrador"));
			throw new Exception();
			
			
			
		}
		
		
		$comentarioid = $_GET["id"];
		$comentario = $this->comentariomapper->findById($comentarioid);

		// Existe el comentario?
		if ($comentario== NULL) {
			$this->view->setFlashF(i18n("No existe dicho comentario"));
			throw new Exception();
			
			
		}

		
		
		$this->comentariomapper->delete($comentario);

		
		$this->view->setFlash(i18n("El comentario se borró correctamente."));
		
		
		header("Location: index.php?controller=noticias&action=showall&pagina=0");
		}

		catch(Exception $ex){
			$this->view->popFlashF();
			header("Location: index.php?controller=noticias&action=showall&pagina=0");
		}
		
	}
}
