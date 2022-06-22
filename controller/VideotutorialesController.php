<?php

require_once(__DIR__."/../model/Videotutorial.php");
require_once(__DIR__."/../model/VideotutorialMapper.php");
require_once(__DIR__."/../model/User.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");


class VideotutorialesController extends BaseController {

	/**
	
	*
	* @var videotutorialMapper
	*/
	private $videotutorialMapper;

	public function __construct() {
		parent::__construct();

		$this->videotutorialMapper = new VideotutorialMapper();
		
	}



	public function showAll() {
		
		
		$videotutoriales = $this->videotutorialMapper->findAll();
		
		
		$videotutorialesr=array_reverse($videotutoriales);
		$this->view->setVariable("videotutoriales", $videotutorialesr);
		
		
		$this->view->render("videotutoriales", "showall");
	}

	public function showcurrent(){
		if (!isset($_GET["id"])) {
			$this->view->setFlashF(i18n("No se encuentra la id"));
					throw new Exception();
		}
	


		$videotutoid = $_GET["id"];

	
		$videotutorial= $this->videotutorialMapper->findById($videotutoid);

		if ($videotutorial == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el videotutorial"));
					throw new Exception();
		}

		
		$this->view->setVariable("videotutorial", $videotutorial);

		

	
		$this->view->render("videotutoriales", "showcurrent");

	}




	public function add() {
		try{
			
			if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
				$this->view->setFlashF(i18n("Se requiere ser administrador"));
						throw new Exception();
			}
	
		$videotutorial = new Videotutorial();

		if (isset($_POST["titulo"]) && isset($_POST["enlace"]) && isset($_POST["descripcion"])) {

			
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

				
				$this->videotutorialMapper->save($videotutorial);

			
				$this->view->setFlash(sprintf(i18n("El videotutorial \"%s\" se agregó correctamente."),$videotutorial->getTitulo()));

			
				header("Location: index.php?controller=videotutoriales&action=showall&pagina=0");
				
				

			} catch(Exception $ex) {
				$this->view->popFlashF();
			header("Location: index.php?controller=videotutoriales&action=add");
			}
		}

		
		$this->view->setVariable("videotutorial", $videotutorial);

		
		$this->view->render("videotutoriales", "add");
	} catch(Exception $ex) {
		$this->view->popFlashF();
		header("Location: index.php?controller=videotutoriales&action=showall&pagina=0");
	}
	}

	
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


		
		$videotutorialid = $_GET["id"];
		$videotutorial= $this->videotutorialMapper->findById($videotutorialid);

		// Existe el videotutorial?
		if ($videotutorial == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el videotutorial"));
					throw new Exception();
		}

		

		if (isset($_POST["titulo"])) { 

			
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

				
				$this->videotutorialMapper->update($videotutorial);

				
				$this->view->setFlash(sprintf(i18n("El videotutorial \"%s\" se editó correctamente."),$videotutorial->getTitulo()));

				
				header("Location: index.php?controller=videotutoriales&action=showall&pagina=0");

			}catch(Exception $ex) {
				$this->view->popFlashF();
			header("Location: index.php?controller=videotutoriales&action=edit&id=$videotutorialid");
			}
		}

	
	$this->view->setVariable("videotutorial", $videotutorial);

	
	$this->view->render("videotutoriales", "edit");
		} catch(Exception $ex) {
			$this->view->popFlashF();
			header("Location: index.php?controller=videotutoriales&action=showall&pagina=0");
		}
	}

	
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

		
		$videotutorialid = $_GET["id"];
		$videotutorial = $this->videotutorialMapper->findById($videotutorialid);

		// Existe el videotutorial?
		if ($videotutorial== NULL) {
			$this->view->setFlashF(i18n("No se encuentra el videotutorial"));
					throw new Exception();
		}

		
		
		$this->videotutorialMapper->delete($videotutorial);

		
		$this->view->setFlash(sprintf(i18n("El videotutorial \"%s\" se borró correctamente."),$videotutorial->getTitulo()));

		
		header("Location: index.php?controller=videotutoriales&action=showall&pagina=0");

	} catch(Exception $ex) {
		$this->view->popFlashF();
		header("Location: index.php?controller=videotutoriales&action=showall&pagina=0");
	}

	}
}
