<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
* Class UsersController
*
* Controller to login, logout and user registration
*
* @author lipido <lipido@gmail.com>
*/
class UsersController extends BaseController {

	/**
	* Reference to the UserMapper to interact
	* with the database
	*
	* @var UserMapper
	*/
	private $userMapper;

	public function __construct() {
		parent::__construct();

		$this->userMapper = new UserMapper();

		// Users controller operates in a "welcome" layout
		// different to the "default" layout where the internal
		// menu is displayed
		$this->view->setLayout("default");
	}

	/**
	* Action to login
	*
	* Logins a user checking its creedentials agains
	* the database
	*
	* When called via GET, it shows the login form
	* When called via POST, it tries to login
	*
	* The expected HTTP parameters are:
	* <ul>
	* <li>login: The username (via HTTP POST)</li>
	* <li>passwd: The password (via HTTP POST)</li>
	* </ul>
	*
	* The views are:
	* <ul>
	* <li>posts/login: If this action is reached via HTTP GET (via include)</li>
	* <li>posts/index: If login succeds (via redirect)</li>
	* <li>users/login: If validation fails (via include). Includes these view variables:</li>
	* <ul>
	*	<li>errors: Array including validation errors</li>
	* </ul>
	* </ul>
	*
	* @return void
	*/
	public function login() {
		try{
		
		if (isset($_POST["email"]) && isset($_POST["passwd"])){ // reaching via HTTP Post...
			//process login form
			if ($this->userMapper->isValidUser($_POST["email"], $_POST["passwd"])) {
				if(!preg_match('/^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/',$_POST["email"])  ){
					$this->view->setFlashF(i18n("Formato incorrecto del email"));
					throw new Exception();
				}
				if( !preg_match('/^([^\s\t]+)+$/',$_POST["passwd"]) || strlen($_POST["passwd"]) < 5  ){
					$this->view->setFlashF(i18n("La contraseña no puede tener espacios ni ser menor de 5 caracteres"));
					throw new Exception();
					
				}
				$_SESSION["currentuser"]=$_POST["email"];
				$userrol= $this->userMapper->RolfromEmail($_POST["email"]);
				
				
				$_SESSION["rol"]= $userrol["ROL"];
				
				// send user to the restricted area (HTTP 302 code)
				$this->view->redirect("noticias", "index");
				
			}else{
				$this->view->setFlashF(i18n("El usuario no existe en la base de datos"));
					throw new Exception();
			}
		}

		// render the view (/view/users/login.php)
		$this->view->render("users", "login");
	}catch(Exception $ex){
		$this->view->popFlashF();
	header("Location: index.php?controller=users&action=login");
	}

	}

	/**
	* Action to register
	*
	* When called via GET, it shows the register form.
	* When called via POST, it tries to add the user
	* to the database.
	*
	* The expected HTTP parameters are:
	* <ul>
	* <li>login: The username (via HTTP POST)</li>
	* <li>passwd: The password (via HTTP POST)</li>
	* </ul>
	*
	* The views are:
	* <ul>
	* <li>users/register: If this action is reached via HTTP GET (via include)</li>
	* <li>users/login: If login succeds (via redirect)</li>
	* <li>users/register: If validation fails (via include). Includes these view variables:</li>
	* <ul>
	*	<li>user: The current User instance, empty or being added
	*	(but not validated)</li>
	*	<li>errors: Array including validation errors</li>
	* </ul>
	* </ul>
	*
	* @return void
	*/
	public function register() {

		$user = new User();

		if (isset($_POST["email"]) && isset($_POST["passwd"]) && isset($_POST["username"]) &&  isset($_POST["dni"]) &&  isset($_POST["telefono"]) &&  isset($_POST["direccion"]) &&  isset($_POST["genero"])){ // reaching via HTTP Post...

			// populate the User object with data form the form
			$user->setEmail($_POST["email"]);
			$user->setPassword($_POST["passwd"]);
			$user->setUsername($_POST["username"]);
			$user->setDni($_POST["dni"]);
			$user->setTelefono($_POST["telefono"]);
			$user->setDireccion($_POST["direccion"]);
			$user->setGenero($_POST["genero"]);
			$user->setRol("usuario");

			try{
				if(!preg_match('/^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/',$user->getEmail())  ){
					$this->view->setFlashF(i18n("Formato incorrecto del email"));
					throw new Exception();
				}
				if( !preg_match('/^([^\s\t]+)+$/',$user->getPasswd()) || strlen($user->getPasswd()) < 5  ){
					$this->view->setFlashF(i18n("La contraseña no puede tener espacios ni ser menor de 5 caracteres"));
					throw new Exception();
					
				}
				if( !preg_match('/^([^\s\t]+)+$/',$user->getUsername()) || strlen($user->getUsername()) < 5  ){
					$this->view->setFlashF(i18n("El nombre de usuario no puede tener espacios ni ser menor de 5 caracteres"));
					throw new Exception();
					
				}
				if( !preg_match('/^[0-9]{8}[A-Za-z]{1}$/',$user->getDni()) || strlen($user->getDni()) < 9 || strlen($user->getDni()) > 9 ){
					$this->view->setFlashF(i18n("Formato de DNI inválido"));
					throw new Exception();
					
				}
				if( !preg_match('/^(\+34|34)?[\s|\-|\.]?[6|7|9][\s|\-|\.]?([0-9][\s|\-|\.]?){8}$/',$user->getTelefono()) ){
					$this->view->setFlashF(i18n("Formato de teléfono inválido"));
					throw new Exception();
					
				}
				if( strlen($user->getDireccion()) < 1  ){
					$this->view->setFlashF(i18n("La dirección no puede estar vacía"));
					throw new Exception();
					
				}
				
				// check if user exists in the database
				if (!($this->userMapper->EmailExists($_POST["email"]) || $this->userMapper->DniExists($_POST["dni"]) || $this->userMapper->UsernameExists($_POST["username"])|| $this->userMapper->TelefonoExists($_POST["telefono"]))){
					

					
					// save the User object into the database
					$this->userMapper->save($user);

					// POST-REDIRECT-GET
					// Everything OK, we will redirect the user to the list of posts
					// We want to see a message after redirection, so we establish
					// a "flash" message (which is simply a Session variable) to be
					// get in the view after redirection.
					$this->view->setFlash("Email ".$user->getEmail()." successfully added. Please login now");

					// perform the redirection. More or less:
					// header("Location: index.php?controller=users&action=login")
					// die();
					$this->view->redirect("users", "login");
				} else {
					
					if ($this->userMapper->EmailExists($_POST["email"])){
					$this->view->setFlashF("Este correo electrónico ya se encuentra en la base de datos");
					}
					if ($this->userMapper->DniExists($_POST["dni"])){
						$this->view->setFlashF("Este dni ya se encuentra en la base de datos");
						}
					if ($this->userMapper->UsernameExists($_POST["username"])){
					$this->view->setFlashF("Este nombre de usuario ya se encuentra en la base de datos");
					}
					if ($this->userMapper->TelefonoExists($_POST["telefono"])){
						$this->view->setFlashF("Este telefono ya se encuentra en la base de datos");
						}
				}
			}catch(Exception $ex) {
				$this->view->popFlashF();
			header("Location: index.php?controller=users&action=register");
			}
		}

		// Put the User object visible to the view
		$this->view->setVariable("user", $user);

		// render the view (/view/users/register.php)
		$this->view->render("users", "register");

	}

	public function showAll() {
		if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== "administrador") {
			$this->view->redirect("noticias", "index");
			
			
			
		}
		// obtain the data from the database
		$usuarios = $this->userMapper->findAll();
		// put the array containing Post object to the view
		
		
		$this->view->setVariable("usuarios", $usuarios);
		
		// render the view (/view/noticias/index.php)
		$this->view->render("users", "showall");
	}


	public function add() {
		try{
			if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
				$this->view->setFlashF(i18n("Se requiere ser administrador"));
						throw new Exception();
			}
	

		$usuario = new User();

		if (isset($_POST["email"]) && isset($_POST["passwd"]) && isset($_POST["username"]) &&  isset($_POST["dni"]) &&  isset($_POST["telefono"]) &&  isset($_POST["direccion"]) &&  isset($_POST["genero"]) &&  isset($_POST["rol"])) { // reaching via HTTP Post...

			// populate the Post object with data form the form
			$usuario->setEmail($_POST["email"]);
			$usuario->setPassword($_POST["passwd"]);
			$usuario->setUsername($_POST["username"]);
			$usuario->setDni($_POST["dni"]);
			$usuario->setTelefono($_POST["telefono"]);
			$usuario->setDireccion($_POST["direccion"]);
			$usuario->setGenero($_POST["genero"]);
			$usuario->setRol($_POST["rol"]);
			// The user of the Post is the currentUser (user in session)
				

			try {
				if(!preg_match('/^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/',$usuario->getEmail())  ){
					$this->view->setFlashF(i18n("Formato incorrecto del email"));
					throw new Exception();
				}
				if( !preg_match('/^([^\s\t]+)+$/',$usuario->getPasswd()) || strlen($usuario->getPasswd()) < 5  ){
					$this->view->setFlashF(i18n("La contraseña no puede tener espacios ni ser menor de 5 caracteres"));
					throw new Exception();
					
				}
				if( !preg_match('/^([^\s\t]+)+$/',$usuario->getUsername()) || strlen($usuario->getUsername()) < 5  ){
					$this->view->setFlashF(i18n("El nombre de usuario no puede tener espacios ni ser menor de 5 caracteres"));
					throw new Exception();
					
				}
				if( !preg_match('/^[0-9]{8}[A-Za-z]{1}$/',$usuario->getDni()) || strlen($usuario->getDni()) < 9 || strlen($usuario->getDni()) > 9 ){
					$this->view->setFlashF(i18n("Formato de DNI inválido"));
					throw new Exception();
					
				}
				if( !preg_match('/^(\+34|34)?[\s|\-|\.]?[6|7|9][\s|\-|\.]?([0-9][\s|\-|\.]?){8}$/',$usuario->getTelefono()) ){
					$this->view->setFlashF(i18n("Formato de teléfono inválido"));
					throw new Exception();
					
				}
				if( strlen($usuario->getDireccion()) < 1  ){
					$this->view->setFlashF(i18n("La dirección no puede estar vacía"));
					throw new Exception();
					
				}
				
				// validate Post object
				if (!($this->userMapper->EmailExists($_POST["email"]) || $this->userMapper->DniExists($_POST["dni"]) || $this->userMapper->UsernameExists($_POST["username"])|| $this->userMapper->TelefonoExists($_POST["telefono"]))){
				// save the Post object into the database
				$this->userMapper->save($usuario);

				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash(sprintf(i18n("El usuario \"%s\" se agregó correctamente."),$usuario->getEmail()));

				// perform the redirection. More or less:
				header("Location: index.php?controller=users&action=showall");
				// die();
			} else {
					
				if ($this->userMapper->EmailExists($_POST["email"])){
				$this->view->setFlashF("Este correo electrónico ya se encuentra en la base de datos");
				}
				if ($this->userMapper->DniExists($_POST["dni"])){
					$this->view->setFlashF("Este dni ya se encuentra en la base de datos");
					}
				if ($this->userMapper->UsernameExists($_POST["username"])){
				$this->view->setFlashF("Este nombre de usuario ya se encuentra en la base de datos");
				}
				if ($this->userMapper->TelefonoExists($_POST["telefono"])){
					$this->view->setFlashF("Este telefono ya se encuentra en la base de datos");
					}
			}

			} catch(Exception $ex) {
				$this->view->popFlashF();
			header("Location: index.php?controller=users&action=add");
			}
		}

		

		// render the view (/view/posts/add.php)
		$this->view->render("users", "add");

	} catch(Exception $ex) {
		$this->view->popFlashF();
	header("Location: index.php?controller=users&action=showall");
	}

	}

	public function desconectar() {
		if(isset($_SESSION["rol"])){
		session_destroy();}

		// render the view (/view/users/login.php)
		$this->view->redirect("noticias", "index");
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


		// Get the Post object from the database
		$usuarioid = $_GET["id"];
		$usuario= $this->userMapper->findById($usuarioid);

		// Does the post exist?
		if ($usuario == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el usuario"));
					throw new Exception();
		}

		

		if (isset($_POST["email"]) && isset($_POST["passwd"]) && isset($_POST["username"]) &&  isset($_POST["dni"]) &&  isset($_POST["telefono"]) &&  isset($_POST["direccion"]) &&  isset($_POST["genero"]) &&  isset($_POST["rol"])) { // reaching via HTTP Post...

			// populate the Post object with data form the form
			$usuario->setEmail($_POST["email"]);
			$usuario->setPassword($_POST["passwd"]);
			$usuario->setUsername($_POST["username"]);
			$usuario->setDni($_POST["dni"]);
			$usuario->setTelefono($_POST["telefono"]);
			$usuario->setDireccion($_POST["direccion"]);
			$usuario->setGenero($_POST["genero"]);
			$usuario->setRol($_POST["rol"]);
			if($_POST["passwdnueva"] != "d41d8cd98f00b204e9800998ecf8427e"){
			$usuario->setPassword($_POST["passwdnueva"]);
			}	
			try {
				if(!preg_match('/^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/',$usuario->getEmail())  ){
					$this->view->setFlashF(i18n("Formato incorrecto del email"));
					throw new Exception();
				}
				if( !preg_match('/^([^\s\t]+)+$/',$usuario->getPasswd()) || strlen($usuario->getPasswd()) < 5  ){
					$this->view->setFlashF(i18n("La contraseña no puede tener espacios ni ser menor de 5 caracteres"));
					throw new Exception();
					
				}
				if( !preg_match('/^([^\s\t]+)+$/',$usuario->getUsername()) || strlen($usuario->getUsername()) < 5  ){
					$this->view->setFlashF(i18n("El nombre de usuario no puede tener espacios ni ser menor de 5 caracteres"));
					throw new Exception();
					
				}
				if( !preg_match('/^[0-9]{8}[A-Za-z]{1}$/',$usuario->getDni()) || strlen($usuario->getDni()) < 9 || strlen($usuario->getDni()) > 9 ){
					$this->view->setFlashF(i18n("Formato de DNI inválido"));
					throw new Exception();
					
				}
				if( !preg_match('/^(\+34|34)?[\s|\-|\.]?[6|7|9][\s|\-|\.]?([0-9][\s|\-|\.]?){8}$/',$usuario->getTelefono()) ){
					$this->view->setFlashF(i18n("Formato de teléfono inválido"));
					throw new Exception();
					
				}
				if( strlen($usuario->getDireccion()) < 1  ){
					$this->view->setFlashF(i18n("La dirección no puede estar vacía"));
					throw new Exception();
					
				}
				
				// validate Post object
				//$usuario->checkIsValidForUpdate(); // if it fails, ValidationException
				
				// update the Post object in the database
				$this->userMapper->update($usuario);

				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash("El usuario se actualizó correctamente");

				// perform the redirection. More or less:
				// header("Location: index.php?controller=posts&action=index")
				// die();
				header("Location: index.php?controller=users&action=showall");

			} catch(Exception $ex) {
				$this->view->popFlashF();
			header("Location: index.php?controller=users&action=showall");
			}
		}

	// Put the Post object visible to the view
	$this->view->setVariable("usuario", $usuario);

	// render the view (/view/posts/edit.php)
	
	$this->view->render("users", "edit");

} catch(Exception $ex) {
	$this->view->popFlashF();
header("Location: index.php?controller=users&action=showall");
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

		
		// Get the Post object from the database
		$usuarioid = $_GET["id"];
		$usuario= $this->userMapper->findById($usuarioid);

		// Does the post exist?
		if ($usuario == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el usuario"));
					throw new Exception();
		}
		
		// Delete the Post object from the database
		$this->userMapper->delete($usuario);

		// POST-REDIRECT-GET
		// Everything OK, we will redirect the user to the list of posts
		// We want to see a message after redirection, so we establish
		// a "flash" message (which is simply a Session variable) to be
		// get in the view after redirection.
		$this->view->setFlash(sprintf(i18n("El usuario \"%s\" se borró correctamente."),$usuario->getEmail()));

		// perform the redirection. More or less:
		// header("Location: index.php?controller=posts&action=index")
		// die();
		header("Location: index.php?controller=users&action=showall");
	} catch(Exception $ex) {
		$this->view->popFlashF();
	header("Location: index.php?controller=users&action=showall");
	}

	}

	public function view(){
		try{
			if (!isset($_GET["id"])) {
				$this->view->setFlashF(i18n("No se encuentra la id"));
						throw new Exception();
			}
			if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
				$this->view->setFlashF(i18n("Se requiere ser administrador"));
						throw new Exception();
			}
		$userid = $_GET["id"];

		// find the Post object in the database
		$user= $this->userMapper->findById($userid);

		if ($usuario == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el usuario"));
					throw new Exception();
		}
		// put the Post object to the view
		$this->view->setVariable("usuario", $user);

		

		// render the view (/view/posts/view.php)
		$this->view->render("users", "view");

	} catch(Exception $ex) {
		$this->view->popFlashF();
	header("Location: index.php?controller=users&action=showall");
	}

}
}