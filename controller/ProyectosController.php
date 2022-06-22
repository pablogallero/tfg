<?php
//file: controller/PostController.php


require_once(__DIR__."/../model/Proyecto.php");
require_once(__DIR__."/../model/ProyectoMapper.php");
require_once(__DIR__."/../model/User.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");


class ProyectosController extends BaseController {

	/**

	*
	* @var proyectoMapper
	*/
	private $proyectoMapper;

	public function __construct() {
		parent::__construct();

		$this->proyectoMapper = new ProyectoMapper();
	}



	public function showAll() {
		
		
		$proyectos = $this->proyectoMapper->findAll();
	
		
		$this->view->setVariable("proyectos", $proyectos);
		
		
		$this->view->render("proyectos", "showall");
	}
	
	public function view(){
		try{
			if (!isset($_GET["id"])) {
				$this->view->setFlashF(i18n("No se encuentra la id"));
						throw new Exception();
			}
	
		$proyectoid = $_GET["id"];

		
		$proyecto = $this->proyectoMapper->findById($proyectoid);

		if ($proyecto == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el proyecto"));
						throw new Exception();
		}

		
		$this->view->setVariable("proyecto", $proyecto);

		
		$this->view->render("proyectos", "view");
	} catch(Exception $ex) {
		$this->view->popFlashF();
		header("Location: index.php?controller=proyectos&action=showall");
	}
	}

	
	
	public function add() {
		try{
		if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
			$this->view->setFlashF(i18n("No se puede añadir sin ser administrador"));
					throw new Exception();
			
		}

		$proyecto = new Proyecto();

		if (isset($_POST["titulo"]) && isset($_FILES["imagen"]["name"]) && isset($_POST["introduccion"]) &&  isset($_POST["objetivos"]) &&  isset($_POST["metodologia"]) &&  isset($_POST["conclusiones"]) ) { // reaching via HTTP Post...
			$name=$_FILES['imagen']['name'];
			
			$tmp_name=$_FILES['imagen']['tmp_name'];
			$upload_folder="images/";

			$movefile=move_uploaded_file($tmp_name,$upload_folder.$name);
			
			$proyecto->setTitulo($_POST["titulo"]);
			$proyecto->setImagen($_FILES["imagen"]["name"]);
			$proyecto->setIntroduccion($_POST["introduccion"]);
			$proyecto->setObjetivos($_POST["objetivos"]);
			$proyecto->setMetodologia($_POST["metodologia"]);

			$proyecto->setConclusiones($_POST["conclusiones"]);
				

			try {
				if(strlen($proyecto->getTitulo())<1  ){
					$this->view->setFlashF(i18n("Título demasiado corto"));
					throw new Exception();
				}
				if( strlen($proyecto->getImagen()) < 1  ){
					$this->view->setFlashF(i18n("Imagen no encontrada"));
					throw new Exception();
					
				}
				if( strlen($proyecto->getIntroduccion()) < 1 ){
					$this->view->setFlashF(i18n("Introducción demasiado corta"));
					throw new Exception();
					
				}
				if( strlen($proyecto->getObjetivos()) < 1 ){
					$this->view->setFlashF(i18n("Objetivos demasiado cortos"));
					throw new Exception();
					
				}
				if( strlen($proyecto->getMetodologia()) < 1  ){
					$this->view->setFlashF(i18n("Metodología demasiado corta"));
					throw new Exception();
					
				}
				if( strlen($proyecto->getConclusiones()) < 1 ){
					$this->view->setFlashF(i18n("Conclusiones demasiado corto"));
					throw new Exception();
					
				}
				
				$this->proyectoMapper->save($proyecto);

				
				$this->view->setFlash(sprintf(i18n("El proyecto \"%s\" se añadió correctamente."),$proyecto ->getTitulo()));

				
				header("Location: index.php?controller=proyectos&action=showall");
				
				

			} catch(Exception $ex) {
				$this->view->popFlashF();
			header("Location: index.php?controller=proyectos&action=showall");
			}
		}


		
		$this->view->render("proyectos", "add");
	} catch(Exception $ex) {
		$this->view->popFlashF();
	header("Location: index.php?controller=proyectos&action=showall");
	}
	}


	public function edit() {
		try{
			if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
				$this->view->setFlashF(i18n("No se puede editar sin ser administrador"));
						throw new Exception();
				
			}
		if (!isset($_GET["id"])) {
			$this->view->setFlashF(i18n("Se necesita una id"));
						throw new Exception();
		}

		

		
		$proyectoid = $_GET["id"];
		$proyecto = $this->proyectoMapper->findById($proyectoid);

		// Existe el proyecto?
		if ($proyecto == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el proyecto"));
						throw new Exception();
		}


		if (isset($_POST["titulo"]) && $_POST["introduccion"] && $_POST["objetivos"] && $_POST["metodologia"] && $_POST["conclusiones"]) { // reaching via HTTP Post...
			if($_FILES['imagen']['name']!=""){
			$name=$_FILES['imagen']['name'];
			
			$tmp_name=$_FILES['imagen']['tmp_name'];
			$upload_folder="images/";

			$movefile=move_uploaded_file($tmp_name,$upload_folder.$name);
			
			
			$proyecto->setImagen($_FILES["imagen"]["name"]);
			}
			
			$proyecto->setTitulo($_POST["titulo"]);
			$proyecto->setIntroduccion($_POST["introduccion"]);
			$proyecto->setObjetivos($_POST["objetivos"]);
			$proyecto->setMetodologia($_POST["metodologia"]);

			$proyecto->setConclusiones($_POST["conclusiones"]);
			
			try {
				if(strlen($proyecto->getTitulo())<5   ){
					$this->view->setFlashF(i18n("Título demasiado corto"));
					throw new Exception();
				}
				
				if( strlen($proyecto->getIntroduccion()) < 5  ){
					$this->view->setFlashF(i18n("Introducción demasiado corta"));
					throw new Exception();
					
				}
				if( strlen($proyecto->getObjetivos()) < 5  ){
					$this->view->setFlashF(i18n("Objetivos demasiado cortos"));
					throw new Exception();
					
				}
				if( strlen($proyecto->getMetodologia()) < 5  ){
					$this->view->setFlashF(i18n("Metodología demasiado corta"));
					throw new Exception();
					
				}
				if( strlen($proyecto->getConclusiones()) < 5  ){
					$this->view->setFlashF(i18n("Conclusiones demasiado cortas"));
					throw new Exception();
					
				}

				
				$this->proyectoMapper->update($proyecto);

				
				$this->view->setFlash(sprintf(i18n("El proyecto \"%s\" se actualizó correctamente."),$proyecto ->getTitulo()));

				
				$this->view->redirect("proyectos", "showall");

			}catch(Exception $ex) {
				$this->view->popFlashF();
			header("Location: index.php?controller=proyectos&action=edit&id=$proyectoid");
			}
		}

		
		$this->view->setVariable("proyecto", $proyecto);

		
		$this->view->render("proyectos", "edit");
	} catch(Exception $ex) {
		$this->view->popFlashF();
	header("Location: index.php?controller=proyectos&action=showall");
	}
	}

	
	public function delete() {
		try{
			if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
				$this->view->setFlashF(i18n("No se puede editar sin ser administrador"));
						throw new Exception();
				
			}
		if (!isset($_GET["id"])) {
			$this->view->setFlashF(i18n("Se necesita una id"));
						throw new Exception();
		}

		
		$proyectoid = $_GET["id"];
		$proyecto = $this->proyectoMapper->findById($proyectoid);

		// Existe el proyecto?
		if ($proyecto == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el proyecto"));
						throw new Exception();
		}
		
	
		$this->proyectoMapper->delete($proyecto);

		
		$this->view->setFlash(sprintf(i18n("El proyecto \"%s\" se borró correctamente."),$proyecto->getTitulo()));

	
		header("Location: index.php?controller=proyectos&action=showall");
	} catch(Exception $ex) {
		$this->view->popFlashF();
	header("Location: index.php?controller=proyectos&action=showall");
	}
	}

}
