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
		if (isset($_POST["email"])){ // reaching via HTTP Post...
			//process login form
			if ($this->userMapper->isValidUser($_POST["email"], $_POST["passwd"])) {
				
				$_SESSION["currentuser"]=$_POST["email"];
				$userrol= $this->userMapper->RolfromEmail($_POST["email"]);
				
				
				$_SESSION["rol"]= $userrol["ROL"];
				
				// send user to the restricted area (HTTP 302 code)
				$this->view->redirect("noticias", "index");
				
			}else{
				$errors = array();
				$errors["general"] = "Username is not valid";
				$this->view->setVariable("errors", $errors);
			}
		}

		// render the view (/view/users/login.php)
		$this->view->render("users", "login");
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

		if (isset($_POST["email"])){ // reaching via HTTP Post...

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
				$user->checkIsValidForRegister(); // if it fails, ValidationException

				// check if user exists in the database
				if (!($this->userMapper->EmailExists($_POST["email"]) || $this->userMapper->DniExists($_POST["dni"]) || $this->userMapper->UsuarioExists($_POST["username"]))){
					
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
					$errors = array();
					$errors["email"] = "Email ya existe";
					$this->view->setVariable("errors", $errors);
					if ($this->userMapper->EmailExists($_POST["email"])){
					$this->view->setFlashF("Este correo electrónico ya se encuentra en la base de datos");
					}
					if ($this->userMapper->DniExists($_POST["dni"])){
						$this->view->setFlashF("Este dni ya se encuentra en la base de datos");
						}
					if ($this->userMapper->UsuarioExists($_POST["username"])){
					$this->view->setFlashF("Este nombre de usuario ya se encuentra en la base de datos");
					}
				}
			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
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
	public function add() {
		if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
			throw new Exception("No se puede editar sin ser administrador");
		}

		$videotutorial = new Videotutorial();

		if (isset($_POST["titulo"])) { // reaching via HTTP Post...

			// populate the Post object with data form the form
			$videotutorial->setTitulo($_POST["titulo"]);
			$videotutorial->setEnlace($_POST["enlace"]);
			$videotutorial->setDescripcion($_POST["descripcion"]);
			// The user of the Post is the currentUser (user in session)
				

			try {
				// validate Post object
				$videotutorial->checkIsValidForCreate(); // if it fails, ValidationException

				// save the Post object into the database
				$this->videotutorialMapper->save($videotutorial);

				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash(sprintf(i18n("El videotutorial \"%s\" se agregó correctamente."),$videotutorial->getTitulo()));

				// perform the redirection. More or less:
				header("Location: index.php?controller=videotutoriales&action=showall&pagina=0");
				// die();
				

			} catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}

		// Put the Post object visible to the view
		$this->view->setVariable("videotutorial", $videotutorial);

		// render the view (/view/posts/add.php)
		$this->view->render("videotutoriales", "add");

	}

	public function edit() {
		if (!isset($_GET["id"])) {
			throw new Exception("No se encuentra el usuario");
		}
		if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
			throw new Exception("No se puede editar sin ser administrador");
		}


		// Get the Post object from the database
		$usuarioid = $_GET["id"];
		$usuario= $this->userMapper->findById($usuarioid);

		// Does the post exist?
		if ($usuario == NULL) {
			throw new Exception("No existe dicho usuario");
		}

		

		if (isset($_POST["email"])) { // reaching via HTTP Post...

			// populate the Post object with data form the form
			$usuario->setEmail($_POST["email"]);
			$usuario->setPassword($_POST["passwd"]);
			$usuario->setUsername($_POST["username"]);
			$usuario->setDni($_POST["dni"]);
			$usuario->setTelefono($_POST["telefono"]);
			$usuario->setDireccion($_POST["direccion"]);
			$usuario->setGenero($_POST["genero"]);
			$usuario->setRol($_POST["rol"]);
			try {
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

			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}

	// Put the Post object visible to the view
	$this->view->setVariable("usuario", $usuario);

	// render the view (/view/posts/edit.php)
	
	$this->view->render("users", "edit");
	}


	public function delete() {
		if (!isset($_GET["id"])) {
			throw new Exception("La id es obligatoria");
		}
		if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
			throw new Exception("No se puede borrar sin ser administrador");
		}

		
		// Get the Post object from the database
		$usuarioid = $_GET["id"];
		$usuario= $this->userMapper->findById($usuarioid);

		// Does the post exist?
		if ($usuario== NULL) {
			throw new Exception("No existe ese usuario");
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

	}

	public function view(){
		if (!isset($_GET["id"])) {
			throw new Exception("La id es obligatoria");
		}

		$userid = $_GET["id"];

		// find the Post object in the database
		$user= $this->userMapper->findById($userid);

		if ($user == NULL) {
			throw new Exception("No existe ningún usuario con esa id: ".$userid);
		}

		// put the Post object to the view
		$this->view->setVariable("usuario", $user);

		

		// render the view (/view/posts/view.php)
		$this->view->render("users", "view");

	}

}
