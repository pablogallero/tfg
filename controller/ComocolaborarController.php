<?php
//file: controller/PostController.php


require_once(__DIR__."/../model/Comocolaborar.php");
require_once(__DIR__."/../model/ComocolaborarMapper.php");
require_once(__DIR__."/../model/User.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");


class ComocolaborarController extends BaseController {

	/**

	*
	* @var comocolaborarMapper
	*/
	private $comocolaborarMapper;

	public function __construct() {
		parent::__construct();

		$this->comocolaborarMapper = new ComocolaborarMapper();
		
	}



	public function showAll() {
		try{
		
		$comocolaborar = $this->comocolaborarMapper->findAll();
		if ($comocolaborar== NULL) {
			$this->view->setFlashF(i18n("La sección está vacía"));
			throw new Exception();
			
			
		}
	
		
		$comocolaborarr=array_reverse($comocolaborar);
		
		$this->view->setVariable("comocolaborar", $comocolaborarr);
		
		
		$this->view->render("colaborar", "comocolaborar");
	}

	catch(Exception $ex){
		$this->view->popFlashF();
		header("Location: index.php?controller=noticias&action=index");
	}
	}
	public function edit() {
		try{
		if (!isset($_GET["id"])) {
			$this->view->setFlashF(i18n("Es necesaria una id"));
			throw new Exception();
			
			
			
			
		}

		if (!isset($_SESSION['rol']) || $_SESSION['rol']!="administrador"){
			$this->view->setFlashF(i18n("No se puede acceder sin ser administrador del sistema"));
			throw new Exception();
		}

		
		$comocolaborarid = $_GET["id"];
		$comocolaborar= $this->comocolaborarMapper->findById($comocolaborarid);

		// Existe el como colaborar?
		if ($comocolaborar == NULL) {
			throw new Exception("No existe la id");
		}

		

		if (isset($_POST["titulo"])) { 
			
			$comocolaborar->setTitulo($_POST["titulo"]);
			$comocolaborar->setDescripcion($_POST["descripcion"]);
			try {
				
				if(strlen($comocolaborar->getTitulo())<1   ){
					$this->view->setFlashF(i18n("Titulo demasiado corto"));
					throw new Exception();
				}
				if( strlen($comocolaborar->getDescripcion()) < 1  ){
					$this->view->setFlashF(i18n("Cuerpo de noticia no encontrado"));
					throw new Exception();
					
				}
				

				
				$this->comocolaborarMapper->update($comocolaborar);

				
				$this->view->setFlash("Se editó correctamente");

				
				header("Location: index.php?controller=comocolaborar&action=showall");

			}catch(Exception $ex) {
				$this->view->popFlashF();
				header("Location: index.php?controller=comocolaborar&action=showall");
			}
		}

	
	$this->view->setVariable("comocolaborar", $comocolaborar);


	
	$this->view->render("colaborar", "edit");
}

catch(Exception $ex){
	$this->view->popFlashF();
	header("Location: index.php?controller=comocolaborar&action=showall");
}
	}


}
