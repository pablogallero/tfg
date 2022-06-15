<?php
//file: controller/PostController.php
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
 
require 'PHPMailer/Exception.php'; 
require 'PHPMailer/PHPMailer.php'; 
require 'PHPMailer/SMTP.php'; 
require_once(__DIR__."/../model/Comment.php");
require_once(__DIR__."/../model/Contacto.php");
require_once(__DIR__."/../model/ContactoMapper.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Estructura.php");
require_once(__DIR__."/../model/EstructuraMapper.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
* Class PostsController
*
* Controller to make a CRUDL of Posts entities
*
* @author lipido <lipido@gmail.com>
*/
class ContactosController extends BaseController {

	/**
	* Reference to the PostMapper to interact
	* with the database
	*
	* @var PostMapper
	*/
	private $contactoMapper;
	private $estructuraMapper;

	public function __construct() {
		parent::__construct();

		$this->contactoMapper = new ContactoMapper();
		$this->estructuraMapper = new EstructuraMapper();
		
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

	public function showAll() {
	
		// obtain the data from the database
		$contactos = $this->contactoMapper->findAll();
		
		// put the array containing Post object to the view
		$estructuras = $this->estructuraMapper->findAll();
		// put the array containing Post object to the view
		
		$this->view->setVariable("estructuras", $estructuras);
		
		$this->view->setVariable("contactos", $contactos);
		
		// render the view (/view/noticias/index.php)
		$this->view->render("contactos", "showall");

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
	public function showcurrent(){
		if (!isset($_GET["id"])) {
			throw new Exception("id is mandatory");
		}

		$videotutoid = $_GET["id"];

		// find the Post object in the database
		$videotutorial= $this->videotutorialMapper->findById($videotutoid);

		if ($videotutorial == NULL) {
			throw new Exception("No existe ningún videotutorial con esa id: ".$videotutoid);
		}

		// put the Post object to the view
		$this->view->setVariable("videotutorial", $videotutorial);

		

		// render the view (/view/posts/view.php)
		$this->view->render("videotutoriales", "showcurrent");

	}

	public function contacto(){
		$contactosadmin=$this->contactoMapper->findAllCargo();
		if(!isset($_POST["asunto"])){
		$cargo="Admin";
		
		$this->view->setVariable("contactosadmin", $contactosadmin);
		$this->view->render("contactos", "contacto");}
		else{

			$mail = new PHPMailer; 
 
$mail->isSMTP();                      // Set mailer to use SMTP 
$mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers 
$mail->SMTPAuth = true;               // Enable SMTP authentication 
$mail->Username = 'contactogrena@gmail.com';   // SMTP username 
$mail->Password = 'pzdthazjctbrwcjc';   // SMTP password real pass is "Contactogrena23"
$mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted 
$mail->Port = 587;                    // TCP port to connect to 
 
// Sender info 
$mail->setFrom('contactogrena@gmail.com', 'Grena'); 
$mail->addReplyTo($_POST["email"], $_POST["nombre"]); 
// Add a recipient 
$mail->addAddress($contactosadmin[0]->getEmail()); 
// Set email format to HTML 
$mail->isHTML(true); 
 
// Mail subject 
$mail->Subject = $_POST["asunto"]; 

$mail->Body = $_POST["mensaje"]; 

// Send email 
if(!$mail->send()) { 
	
    $this->view->setFlashF("El email no se puedo enviar.");
} else { 
    $this->view->setFlash("El email se envió correctamente.");
} 
$this->view->redirect("contactos", "showall");
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
				$this->view->setFlashF(i18n("No se puede añadir sin ser administrador"));
						throw new Exception();
				
			}
	
		$contacto = new Contacto();

		if (isset($_POST["nombre"]) && isset($_POST["apellidos"]) && isset($_POST["email"]) && isset($_POST["cargo"]) && isset($_POST["telefono"]) && isset($_FILES["rutafoto"]["name"]) && isset($_POST["rutatwitter"])) { // reaching via HTTP Post...
			
		
			$name=$_FILES['rutafoto']['name'];
			
			$tmp_name=$_FILES['rutafoto']['tmp_name'];
			$upload_folder="images/";

			$movefile=move_uploaded_file($tmp_name,$upload_folder.$name);
			// populate the Post object with data form the form
			$contacto->setNombre($_POST["nombre"]);
			$contacto->setApellidos($_POST["apellidos"]);
			$contacto->setEmail($_POST["email"]);
			$contacto->setCargo($_POST["cargo"]);
			$contacto->setTelefono($_POST["telefono"]);
			$contacto->setRutafoto($_FILES["rutafoto"]["name"]);
			$contacto->setRutatwitter($_POST["rutatwitter"]);
			// The user of the Post is the currentUser (user in session)
				

			try {

				if( !preg_match('/^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/',$contacto->getApellidos()) ){
					$this->view->setFlashF(i18n("Formato de apellidos inválido"));
					throw new Exception();
					
				}
				if(!preg_match('/^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/',$contacto->getEmail())  ){
					$this->view->setFlashF(i18n("Formato incorrecto del email"));
					throw new Exception();
				}
				if( !preg_match('/^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/',$contacto->getNombre()) ){
					$this->view->setFlashF(i18n("Formato de nombre inválido"));
					throw new Exception();
					
				}
				
				if( !preg_match('/^(\+34|34)?[\s|\-|\.]?[6|7|9][\s|\-|\.]?([0-9][\s|\-|\.]?){8}$/',$contacto->getTelefono()) ){
					$this->view->setFlashF(i18n("Formato de teléfono inválido"));
					throw new Exception();
					
				}
				if( strlen($contacto->getRutatwitter()) < 1  ){
					$this->view->setFlashF(i18n("La ruta no puede estar vacía"));
					throw new Exception();
					
				}
				// validate Post object
				

				// save the Post object into the database
				$this->contactoMapper->save($contacto);

				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash(sprintf(i18n("El contacto \"%s\" se agregó correctamente."),$contacto->getNombre()));

				// perform the redirection. More or less:
				header("Location: index.php?controller=contactos&action=showall");
				// die();
				

			} catch(Exception $ex) {
				$this->view->popFlashF();
			header("Location: index.php?controller=contactos&action=add");
			}
		}

		// Put the Post object visible to the view
		$this->view->setVariable("contacto", $contacto);

		// render the view (/view/posts/add.php)
		$this->view->render("contactos", "add");
	} catch(Exception $ex) {
		$this->view->popFlashF();
	header("Location: index.php?controller=contactos&action=showall");
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
		$contactoid = $_GET["id"];
		$contacto= $this->contactoMapper->findById($contactoid);

		// Does the post exist?
		if ($contacto == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el contacto"));
						throw new Exception();
		}

		

		if (isset($_POST["nombre"]) && isset($_POST["apellidos"]) && isset($_POST["email"]) && isset($_POST["cargo"]) && isset($_POST["telefono"]) && isset($_FILES["rutafoto"]["name"]) && isset($_POST["rutatwitter"])) { // reaching via HTTP Post...
			if($_FILES['rutafoto']['name']!=""){
			$name=$_FILES['rutafoto']['name'];
			
			$tmp_name=$_FILES['rutafoto']['tmp_name'];
			$upload_folder="images/";

			$movefile=move_uploaded_file($tmp_name,$upload_folder.$name);
			$contacto->setRutafoto($_FILES["rutafoto"]["name"]);}
			// populate the Post object with data form the form
			$contacto->setNombre($_POST["nombre"]);
			$contacto->setApellidos($_POST["apellidos"]);
			$contacto->setEmail($_POST["email"]);
			$contacto->setCargo($_POST["cargo"]);
			$contacto->setTelefono($_POST["telefono"]);
			
			$contacto->setRutatwitter($_POST["rutatwitter"]);
			try {
				if( !preg_match('/^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/',$contacto->getApellidos()) ){
					$this->view->setFlashF(i18n("Formato de apellidos inválido"));
					throw new Exception();
					
				}
				if(!preg_match('/^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/',$contacto->getEmail())  ){
					$this->view->setFlashF(i18n("Formato incorrecto del email"));
					throw new Exception();
				}
				if( !preg_match('/^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/',$contacto->getNombre()) ){
					$this->view->setFlashF(i18n("Formato de nombre inválido"));
					throw new Exception();
					
				}
				
				if( !preg_match('/^(\+34|34)?[\s|\-|\.]?[6|7|9][\s|\-|\.]?([0-9][\s|\-|\.]?){8}$/',$contacto->getTelefono()) ){
					$this->view->setFlashF(i18n("Formato de teléfono inválido"));
					throw new Exception();
					
				}
				if( strlen($contacto->getRutatwitter()) < 1  ){
					$this->view->setFlashF(i18n("La ruta no puede estar vacía"));
					throw new Exception();
					
				}

				// update the Post object in the database
				$this->contactoMapper->update($contacto);

				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash(sprintf(i18n("El contacto \"%s\" se editó correctamente."),$contacto->getNombre()));

				// perform the redirection. More or less:
				// header("Location: index.php?controller=posts&action=index")
				// die();
				header("Location: index.php?controller=contactos&action=showall");

			} catch(Exception $ex) {
				$this->view->popFlashF();
			header("Location: index.php?controller=contactos&action=edit&id=$contactoid");
			}
		}

	// Put the Post object visible to the view
	$this->view->setVariable("contacto", $contacto);

	// render the view (/view/posts/edit.php)
	
	$this->view->render("contactos", "edit");
} catch(Exception $ex) {
	$this->view->popFlashF();
header("Location: index.php?controller=contactos&action=showall");
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
		$contactoid = $_GET["id"];
		$contacto= $this->contactoMapper->findById($contactoid);

		if ($contacto == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el contacto"));
						throw new Exception();
		}
		
		// Delete the Post object from the database
		$this->contactoMapper->delete($contacto);

		// POST-REDIRECT-GET
		// Everything OK, we will redirect the user to the list of posts
		// We want to see a message after redirection, so we establish
		// a "flash" message (which is simply a Session variable) to be
		// get in the view after redirection.
		$this->view->setFlash(sprintf(i18n("El contacto \"%s\" se borró correctamente."),$contacto->getNombre()));

		// perform the redirection. More or less:
		// header("Location: index.php?controller=posts&action=index")
		// die();
		header("Location: index.php?controller=contactos&action=showall");
	} catch(Exception $ex) {
		$this->view->popFlashF();
	header("Location: index.php?controller=contactos&action=showall");
	}
	}
}
