<?php

require_once(__DIR__."/../model/Galeria.php");
require_once(__DIR__."/../model/GaleriaMapper.php");
require_once(__DIR__."/../model/User.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");


class GaleriaController extends BaseController {

	/**

	*
	* @var galeriaMapper
	*/
	private $galeriaMapper;

	public function __construct() {
		parent::__construct();

		$this->galeriaMapper = new GaleriaMapper();
	}


	
	
	public function showAll() {
		
	
		$fotos = $this->galeriaMapper->findAll();
		
		
		$fotosr=array_reverse($fotos);
		$this->view->setVariable("fotos", $fotosr);
		
		
		$this->view->render("galeria", "showall");
	}


	public function add() {
		try{
			if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
				$this->view->setFlashF(i18n("No se puede añadir sin ser administrador"));
						throw new Exception();
				
			}

		$galeria = new Galeria();

		if (isset($_POST["titulo"] )&& isset($_FILES["imagen"]["name"])) { 
			
			$name=$_FILES['imagen']['name'];
			
			$tmp_name=$_FILES['imagen']['tmp_name'];
			$upload_folder="galeria/";

			$movefile=move_uploaded_file($tmp_name,$upload_folder.$name);
			
			$galeria->setTitulo($_POST["titulo"]);
			$galeria->setRuta($_FILES["imagen"]["name"]);
		
		
			try {

				if(strlen($galeria->getTitulo())<1   ){
					$this->view->setFlashF(i18n("Titulo demasiado corto"));
					throw new Exception();
				}
				if( strlen($galeria->getRuta()) < 1  ){
					$this->view->setFlashF(i18n("Ruta demasiado corta"));
					throw new Exception();
					
				}	
				
				$this->galeriaMapper->save($galeria);

				
				$this->view->setFlash(sprintf(i18n("La imagen \"%s\" se añadió correctamente."),$galeria ->getTitulo()));

				
				header("Location: index.php?controller=galeria&action=showall&pagina=0");
				
				

			} catch(Exception $ex) {
				$this->view->popFlashF();
			header("Location: index.php?controller=galeria&action=showall&pagina=0");
			}
		}

	

	
		$this->view->render("galeria", "add");
	} catch(Exception $ex) {
		$this->view->popFlashF();
	header("Location: index.php?controller=galeria&action=showall&pagina=0");
	}
	}


	public function delete() {
		try{
			if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
				$this->view->setFlashF(i18n("No se puede editar sin ser administrador"));
						throw new Exception();
				
			}
		if (!isset($_GET["imagen"])) {
			$this->view->setFlashF(i18n("Se necesita una imagen"));
						throw new Exception();
		}




		
		$imagenid = $_GET["imagen"];
		$imagen = $this->galeriaMapper->findByImagen($imagenid);

		// Existe la imagen?
		if ($imagen == NULL) {
			$this->view->setFlashF(i18n("No se encuentra la imagen"));
						throw new Exception();
		}

	
		$this->galeriaMapper->delete($imagen);

		
		$this->view->setFlash(sprintf(i18n("La imagen \"%s\" fue borrada correctamente."),$imagen ->getTitulo()));

	
		header("Location: index.php?controller=galeria&action=showall&pagina=0");
		
		
	} catch(Exception $ex) {
		$this->view->popFlashF();
	header("Location: index.php?controller=galeria&action=showall&pagina=0");
	}
	}
	
}
