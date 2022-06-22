<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Patrocinador.php");
require_once(__DIR__."/../model/PatrocinadorMapper.php");
require_once(__DIR__."/../model/Categoria.php");
require_once(__DIR__."/../model/CategoriaMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class PatrocinadoresController extends BaseController {

	/**
	*
	* @var patrocinadorMapper
	* @var categoriaMapper
	*/
	private $patrocinadorMapper;
    private $categoriaMapper;

	public function __construct() {
		parent::__construct();

		$this->patrocinadorMapper = new PatrocinadorMapper();
        $this->categoriaMapper = new CategoriaMapper();

	
		$this->view->setLayout("default");
	}



	public function showAll() {
		if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== "administrador") {
			$this->view->redirect("noticias", "index");
			
			
			
		}
	
		$patrocinadores = $this->patrocinadorMapper->findAll();
        $categorias = $this->categoriaMapper->findAll();
	
		
		
		$this->view->setVariable("patrocinadores", $patrocinadores);
        $this->view->setVariable("categorias", $categorias);
		
	
		$this->view->render("patrocinadores", "showall");
	}


	public function add() {
		try{
			if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
				$this->view->setFlashF(i18n("No se puede añadir sin ser administrador"));
						throw new Exception();
				
			}
	


		$patrocinador = new Patrocinador();
        
		if (isset($_POST["nombre"]) && isset($_FILES["imagen"]["name"]) && isset($_POST["categoria"])) { 
			$name=$_FILES['imagen']['name'];
			
			$tmp_name=$_FILES['imagen']['tmp_name'];
			$upload_folder="images/";

			$movefile=move_uploaded_file($tmp_name,$upload_folder.$name);
			
			$patrocinador->setNombre($_POST["nombre"]);
			$patrocinador->setImagen($_FILES["imagen"]["name"]);
			$patrocinador->setCategoria($_POST["categoria"]);
			
				
            
			try {
				if(strlen($patrocinador->getNombre())<1   ){
					$this->view->setFlashF(i18n("Nombre demasiado corto"));
					throw new Exception();
				}
				if( strlen($patrocinador->getImagen()) < 1  ){
					$this->view->setFlashF(i18n("Imagen no encontrada"));
					throw new Exception();
					
				}
				if( strlen($patrocinador->getCategoria()) < 1  ){
					$this->view->setFlashF(i18n("Categoría demasiado corta"));
					throw new Exception();
					
				}
				
				
				$this->patrocinadorMapper->save($patrocinador);

				
				$this->view->setFlash(sprintf(i18n("El patrocinador \"%s\" se agregó correctamente."),$patrocinador->getNombre()));

				
				header("Location: index.php?controller=patrocinadores&action=showall");
				
				

			} catch(Exception $ex) {
				$this->view->popFlashF();
	header("Location: index.php?controller=patrocinadores&action=add");
			}
		}
        $categorias= $this->categoriaMapper->findAll();
		
		$this->view->setVariable("categorias", $categorias);

		
		$this->view->render("patrocinadores", "add");
	} catch(Exception $ex) {
		$this->view->popFlashF();
	header("Location: index.php?controller=patrocinadores&action=showall");
	}
	}


    public function addcat() {
		try{
			if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
				$this->view->setFlashF(i18n("No se puede editar sin ser administrador"));
						throw new Exception();
				
			}
	
		$categoria = new Categoria();
        
		if (isset($_POST["nombre"]) && isset($_POST["color"])) { 

			
			$categoria->setNombre($_POST["nombre"]);
			$categoria->setColor($_POST["color"]);
		
			
				
            
			try {

				if(strlen($categoria->getNombre())<1   ){
					$this->view->setFlashF(i18n("Nombre demasiado corto"));
					throw new Exception();
				}
				if( strlen($categoria->getColor()) < 1  ){
					$this->view->setFlashF(i18n("Imagen no encontrada"));
					throw new Exception();
					
				}
				
				$this->categoriaMapper->save($categoria);

				
				$this->view->setFlash(sprintf(i18n("La categoría \"%s\" se agregó correctamente."),$categoria->getNombre()));

				
				header("Location: index.php?controller=patrocinadores&action=showall");
				
				

			} catch(Exception $ex) {
				$this->view->popFlashF();
				header("Location: index.php?controller=patrocinadores&action=addcat");
			}
		}
        
		

		
		$this->view->render("patrocinadores", "addcat");
	} catch(Exception $ex) {
		$this->view->popFlashF();
	header("Location: index.php?controller=patrocinadores&action=showall");
	}
	}


	public function editcat() {
		try{
			if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
				$this->view->setFlashF(i18n("No se puede editar sin ser administrador"));
						throw new Exception();
				
			}
		if (!isset($_GET["id"])) {
			$this->view->setFlashF(i18n("Se necesita una id"));
						throw new Exception();
		}

		
		$categoriaid = $_GET["id"];
		$categoria= $this->categoriaMapper->findById($categoriaid);

		if ($categoria == NULL) {
			$this->view->setFlashF(i18n("No se encuentra la categoría"));
						throw new Exception();
		}
		

		if (isset($_POST["nombre"])&& isset($_POST["color"])) { 
			
			
			$categoria->setNombre($_POST["nombre"]);
			$categoria->setColor($_POST["color"]);
			try {
				if(strlen($categoria->getNombre())<1   ){
					$this->view->setFlashF(i18n("Nombre demasiado corto"));
					throw new Exception();
				}
				if( strlen($categoria->getColor()) < 1  ){
					$this->view->setFlashF(i18n("Imagen no encontrada"));
					throw new Exception();
					
				}
				
				$this->categoriaMapper->update($categoria);

				
				$this->view->setFlash("La categoria se actualizó correctamente");

				
				header("Location: index.php?controller=patrocinadores&action=showall");

			}catch(Exception $ex) {
				$this->view->popFlashF();
				header("Location: index.php?controller=patrocinadores&action=editcat&id=$categoriaid");
				
			}
		}

	

    $this->view->setVariable("categoria", $categoria);
	
	
	$this->view->render("patrocinadores", "editcat");

} catch(Exception $ex) {
	$this->view->popFlashF();
header("Location: index.php?controller=patrocinadores&action=showall");
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

		
		$patrocinadorid = $_GET["id"];
		$patrocinador= $this->patrocinadorMapper->findById($patrocinadorid);

		// Existe el patrocinador?
		if ($patrocinador == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el patrocinador"));
						throw new Exception();
		}
		

		if (isset($_POST["nombre"])&& isset($_FILES["imagen"]["name"]) && isset($_POST["categoria"])) { 
			if($_FILES['imagen']['name']!=""){
			$name=$_FILES['imagen']['name'];
			
			$tmp_name=$_FILES['imagen']['tmp_name'];
			$upload_folder="images/";

			$movefile=move_uploaded_file($tmp_name,$upload_folder.$name);
			$patrocinador->setImagen($_FILES["imagen"]["name"]);}
			
			$patrocinador->setNombre($_POST["nombre"]);
			
			$patrocinador->setCategoria($_POST["categoria"]);
			try {
				if(strlen($patrocinador->getNombre())<1   ){
					$this->view->setFlashF(i18n("Nombre demasiado corto"));
					throw new Exception();
				}
				if( strlen($patrocinador->getImagen()) < 1  ){
					$this->view->setFlashF(i18n("Imagen no encontrada"));
					throw new Exception();
					
				}
				if( strlen($patrocinador->getCategoria()) < 1  ){
					$this->view->setFlashF(i18n("Categoría demasiado corta"));
					throw new Exception();
					
				}
				

				
				$this->patrocinadorMapper->update($patrocinador);

				
				$this->view->setFlash("El patrocinador se actualizó correctamente");

				
				header("Location: index.php?controller=patrocinadores&action=showall");

			}catch(Exception $ex) {
				$this->view->popFlashF();
header("Location: index.php?controller=patrocinadores&action=edit&id=$patrocinadorid");
			}
		}

	
    $categorias= $this->categoriaMapper->findAll();
	$this->view->setVariable("patrocinador", $patrocinador);
    $this->view->setVariable("categorias", $categorias);
	
	
	$this->view->render("patrocinadores", "edit");
} catch(Exception $ex) {
	$this->view->popFlashF();
header("Location: index.php?controller=patrocinadores&action=showall");
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

		
		
		$patrocinadorid = $_GET["id"];
		$patrocinador= $this->patrocinadorMapper->findById($patrocinadorid);

		// Existe el patrocinador?
		if ($patrocinador == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el patrocinador"));
						throw new Exception();
		}
		

		
		
		$this->patrocinadorMapper->delete($patrocinador);

		
		$this->view->setFlash(sprintf(i18n("El patrocinador \"%s\" se borró correctamente."),$patrocinador->getNombre()));

		
		header("Location: index.php?controller=patrocinadores&action=showall");
	}catch(Exception $ex) {
		$this->view->popFlashF();
header("Location: index.php?controller=patrocinadores&action=edit&id=$patrocinadorid");
	}

	}

    public function deletecat() {
		try{
			if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
				$this->view->setFlashF(i18n("No se puede editar sin ser administrador"));
						throw new Exception();
				
			}
		if (!isset($_GET["id"])) {
			$this->view->setFlashF(i18n("Se necesita una id"));
						throw new Exception();
		}

		
		
		$categoriaid = $_GET["id"];
		$categoria= $this->categoriaMapper->findById($categoriaid);

		// Existe la categoría?
		if ($categoria == NULL) {
			$this->view->setFlashF(i18n("No se encuentra la categoría"));
						throw new Exception();
		}
		
		
		$this->categoriaMapper->delete($categoria);

		
		$this->view->setFlash(sprintf(i18n("La categoría \"%s\" se borró correctamente."),$categoria->getNombre()));

		
		header("Location: index.php?controller=patrocinadores&action=showall");
	}catch(Exception $ex) {
		$this->view->popFlashF();
header("Location: index.php?controller=patrocinadores&action=edit&id=$patrocinadorid");
	}
	}


}
