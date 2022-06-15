<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Patrocinador.php");
require_once(__DIR__."/../model/PatrocinadorMapper.php");
require_once(__DIR__."/../model/Categoria.php");
require_once(__DIR__."/../model/CategoriaMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
* Class UsersController
*
* Controller to login, logout and user registration
*
* @author lipido <lipido@gmail.com>
*/
class PatrocinadoresController extends BaseController {

	/**
	* Reference to the UserMapper to interact
	* with the database
	*
	* @var UserMapper
	*/
	private $patrocinadorMapper;
    private $categoriaMapper;

	public function __construct() {
		parent::__construct();

		$this->patrocinadorMapper = new PatrocinadorMapper();
        $this->categoriaMapper = new CategoriaMapper();

		// Users controller operates in a "welcome" layout
		// different to the "default" layout where the internal
		// menu is displayed
		$this->view->setLayout("default");
	}



	public function showAll() {
		if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== "administrador") {
			$this->view->redirect("noticias", "index");
			
			
			
		}
		// obtain the data from the database
		$patrocinadores = $this->patrocinadorMapper->findAll();
        $categorias = $this->categoriaMapper->findAll();
		// put the array containing Post object to the view
		
		
		$this->view->setVariable("patrocinadores", $patrocinadores);
        $this->view->setVariable("categorias", $categorias);
		
		// render the view (/view/noticias/index.php)
		$this->view->render("patrocinadores", "showall");
	}


	public function add() {
		try{
			if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
				$this->view->setFlashF(i18n("No se puede añadir sin ser administrador"));
						throw new Exception();
				
			}
	


		$patrocinador = new Patrocinador();
        
		if (isset($_POST["nombre"]) && isset($_FILES["imagen"]["name"]) && isset($_POST["categoria"])) { // reaching via HTTP Post...
			$name=$_FILES['imagen']['name'];
			
			$tmp_name=$_FILES['imagen']['tmp_name'];
			$upload_folder="images/";

			$movefile=move_uploaded_file($tmp_name,$upload_folder.$name);
			// populate the Post object with data form the form
			$patrocinador->setNombre($_POST["nombre"]);
			$patrocinador->setImagen($_FILES["imagen"]["name"]);
			$patrocinador->setCategoria($_POST["categoria"]);
			// The user of the Post is the currentUser (user in session)
				
            
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
				
				// save the Post object into the database
				$this->patrocinadorMapper->save($patrocinador);

				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash(sprintf(i18n("El patrocinador \"%s\" se agregó correctamente."),$patrocinador->getNombre()));

				// perform the redirection. More or less:
				header("Location: index.php?controller=patrocinadores&action=showall");
				// die();
				

			} catch(Exception $ex) {
				$this->view->popFlashF();
	header("Location: index.php?controller=patrocinadores&action=add");
			}
		}
        $categorias= $this->categoriaMapper->findAll();
		// Put the Post object visible to the view
		$this->view->setVariable("categorias", $categorias);

		// render the view (/view/posts/add.php)
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
        
		if (isset($_POST["nombre"]) && isset($_POST["color"])) { // reaching via HTTP Post...

			// populate the Post object with data form the form
			$categoria->setNombre($_POST["nombre"]);
			$categoria->setColor($_POST["color"]);
		
			// The user of the Post is the currentUser (user in session)
				
            
			try {

				if(strlen($categoria->getNombre())<1   ){
					$this->view->setFlashF(i18n("Nombre demasiado corto"));
					throw new Exception();
				}
				if( strlen($categoria->getColor()) < 1  ){
					$this->view->setFlashF(i18n("Imagen no encontrada"));
					throw new Exception();
					
				}
				// validate Post object
				//$videotutorial->checkIsValidForCreate(); // if it fails, ValidationException

				// save the Post object into the database
				$this->categoriaMapper->save($categoria);

				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash(sprintf(i18n("La categoría \"%s\" se agregó correctamente."),$categoria->getNombre()));

				// perform the redirection. More or less:
				header("Location: index.php?controller=patrocinadores&action=showall");
				// die();
				

			} catch(Exception $ex) {
				$this->view->popFlashF();
				header("Location: index.php?controller=patrocinadores&action=addcat");
			}
		}
        
		

		// render the view (/view/posts/add.php)
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

		// Get the Post object from the database
		$categoriaid = $_GET["id"];
		$categoria= $this->categoriaMapper->findById($categoriaid);

		if ($categoria == NULL) {
			$this->view->setFlashF(i18n("No se encuentra la categoría"));
						throw new Exception();
		}
		

		if (isset($_POST["nombre"])&& isset($_POST["color"])) { // reaching via HTTP Post...
			
			// populate the Post object with data form the form
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
				// update the Post object in the database
				$this->categoriaMapper->update($categoria);

				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash("La categoria se actualizó correctamente");

				// perform the redirection. More or less:
				// header("Location: index.php?controller=posts&action=index")
				// die();
				header("Location: index.php?controller=patrocinadores&action=showall");

			}catch(Exception $ex) {
				$this->view->popFlashF();
				header("Location: index.php?controller=patrocinadores&action=editcat&id=$categoriaid");
				
			}
		}

	// Put the Post object visible to the view

    $this->view->setVariable("categoria", $categoria);
	// render the view (/view/posts/edit.php)
	
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

		// Get the Post object from the database
		$patrocinadorid = $_GET["id"];
		$patrocinador= $this->patrocinadorMapper->findById($patrocinadorid);

		// Does the post exist?
		if ($patrocinador == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el patrocinador"));
						throw new Exception();
		}
		

		if (isset($_POST["nombre"])&& isset($_FILES["imagen"]["name"]) && isset($_POST["categoria"])) { // reaching via HTTP Post...
			if($_FILES['imagen']['name']!=""){
			$name=$_FILES['imagen']['name'];
			
			$tmp_name=$_FILES['imagen']['tmp_name'];
			$upload_folder="images/";

			$movefile=move_uploaded_file($tmp_name,$upload_folder.$name);
			$patrocinador->setImagen($_FILES["imagen"]["name"]);}
			// populate the Post object with data form the form
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
				

				// update the Post object in the database
				$this->patrocinadorMapper->update($patrocinador);

				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash("El patrocinador se actualizó correctamente");

				// perform the redirection. More or less:
				// header("Location: index.php?controller=posts&action=index")
				// die();
				header("Location: index.php?controller=patrocinadores&action=showall");

			}catch(Exception $ex) {
				$this->view->popFlashF();
header("Location: index.php?controller=patrocinadores&action=edit&id=$patrocinadorid");
			}
		}

	// Put the Post object visible to the view
    $categorias= $this->categoriaMapper->findAll();
	$this->view->setVariable("patrocinador", $patrocinador);
    $this->view->setVariable("categorias", $categorias);
	// render the view (/view/posts/edit.php)
	
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

		
		// Get the Post object from the database
		$patrocinadorid = $_GET["id"];
		$patrocinador= $this->patrocinadorMapper->findById($patrocinadorid);

		// Does the post exist?
		if ($patrocinador == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el patrocinador"));
						throw new Exception();
		}
		

		
		// Delete the Post object from the database
		$this->patrocinadorMapper->delete($patrocinador);

		// POST-REDIRECT-GET
		// Everything OK, we will redirect the user to the list of posts
		// We want to see a message after redirection, so we establish
		// a "flash" message (which is simply a Session variable) to be
		// get in the view after redirection.
		$this->view->setFlash(sprintf(i18n("El patrocinador \"%s\" se borró correctamente."),$patrocinador->getNombre()));

		// perform the redirection. More or less:
		// header("Location: index.php?controller=posts&action=index")
		// die();
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

		
		// Get the Post object from the database
		$categoriaid = $_GET["id"];
		$categoria= $this->categoriaMapper->findById($categoriaid);

		// Does the post exist?
		if ($categoria == NULL) {
			$this->view->setFlashF(i18n("No se encuentra la categoría"));
						throw new Exception();
		}
		
		// Delete the Post object from the database
		$this->categoriaMapper->delete($categoria);

		// POST-REDIRECT-GET
		// Everything OK, we will redirect the user to the list of posts
		// We want to see a message after redirection, so we establish
		// a "flash" message (which is simply a Session variable) to be
		// get in the view after redirection.
		$this->view->setFlash(sprintf(i18n("La categoría \"%s\" se borró correctamente."),$categoria->getNombre()));

		// perform the redirection. More or less:
		// header("Location: index.php?controller=posts&action=index")
		// die();
		header("Location: index.php?controller=patrocinadores&action=showall");
	}catch(Exception $ex) {
		$this->view->popFlashF();
header("Location: index.php?controller=patrocinadores&action=edit&id=$patrocinadorid");
	}
	}


}
