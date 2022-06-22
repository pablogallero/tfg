<?php

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
 
require 'PHPMailer/Exception.php'; 
require 'PHPMailer/PHPMailer.php'; 
require 'PHPMailer/SMTP.php'; 

require_once(__DIR__."/../model/Contacto.php");
require_once(__DIR__."/../model/ContactoMapper.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Estructura.php");
require_once(__DIR__."/../model/EstructuraMapper.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");


class ContactosController extends BaseController {

	/**

	*
	* @var contactoMapper
	* @var estructuraMapper
	*/
	private $contactoMapper;
	private $estructuraMapper;

	public function __construct() {
		parent::__construct();

		$this->contactoMapper = new ContactoMapper();
		$this->estructuraMapper = new EstructuraMapper();
		
	}



	public function showAll() {
	

		$contactos = $this->contactoMapper->findAll();
		
	
		$estructuras = $this->estructuraMapper->findAll();

		
		$this->view->setVariable("estructuras", $estructuras);
		
		$this->view->setVariable("contactos", $contactos);
		

		$this->view->render("contactos", "showall");

	}

	
	

	public function contacto(){
		try{
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
	} catch(Exception $ex) {
		$this->view->popFlashF();
	header("Location: index.php?controller=contactos&action=contacto");
	}
	}

	
	
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
			
			$contacto->setNombre($_POST["nombre"]);
			$contacto->setApellidos($_POST["apellidos"]);
			$contacto->setEmail($_POST["email"]);
			$contacto->setCargo($_POST["cargo"]);
			$contacto->setTelefono($_POST["telefono"]);
			$contacto->setRutafoto($_FILES["rutafoto"]["name"]);
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
				
				$this->contactoMapper->save($contacto);

				
				$this->view->setFlash(sprintf(i18n("El contacto \"%s\" se agregó correctamente."),$contacto->getNombre()));

				
				header("Location: index.php?controller=contactos&action=showall");
			
				

			} catch(Exception $ex) {
				$this->view->popFlashF();
			header("Location: index.php?controller=contactos&action=add");
			}
		}

	
		$this->view->setVariable("contacto", $contacto);

	
		$this->view->render("contactos", "add");
	} catch(Exception $ex) {
		$this->view->popFlashF();
	header("Location: index.php?controller=contactos&action=showall");
	}
	}

	
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

	
		$contactoid = $_GET["id"];
		$contacto= $this->contactoMapper->findById($contactoid);

		// Existe el contacto?
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

			
				$this->contactoMapper->update($contacto);

				
				$this->view->setFlash(sprintf(i18n("El contacto \"%s\" se editó correctamente."),$contacto->getNombre()));

				
				header("Location: index.php?controller=contactos&action=showall");

			} catch(Exception $ex) {
				$this->view->popFlashF();
			header("Location: index.php?controller=contactos&action=edit&id=$contactoid");
			}
		}

	
	$this->view->setVariable("contacto", $contacto);

	
	
	$this->view->render("contactos", "edit");
} catch(Exception $ex) {
	$this->view->popFlashF();
header("Location: index.php?controller=contactos&action=showall");
}
	}


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

		
		
		$contactoid = $_GET["id"];
		$contacto= $this->contactoMapper->findById($contactoid);

		if ($contacto == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el contacto"));
						throw new Exception();
		}
		
		
		$this->contactoMapper->delete($contacto);

		
		$this->view->setFlash(sprintf(i18n("El contacto \"%s\" se borró correctamente."),$contacto->getNombre()));

		
		header("Location: index.php?controller=contactos&action=showall");
	} catch(Exception $ex) {
		$this->view->popFlashF();
	header("Location: index.php?controller=contactos&action=showall");
	}
	}
}
