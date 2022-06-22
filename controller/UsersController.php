<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class UsersController extends BaseController {

	/**

	*
	* @var UserMapper
	*/
	private $userMapper;

	public function __construct() {
		parent::__construct();

		$this->userMapper = new UserMapper();

		
		$this->view->setLayout("default");
	}


	public function login() {
		try{
		
		if (isset($_POST["email"]) && isset($_POST["passwd"])){ 
			
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
				
				
				$this->view->redirect("noticias", "index");
				
			}else{
				$this->view->setFlashF(i18n("El usuario no existe en la base de datos"));
					throw new Exception();
			}
		}

		
		$this->view->render("users", "login");
	}catch(Exception $ex){
		$this->view->popFlashF();
	header("Location: index.php?controller=users&action=login");
	}

	}

	
	public function register() {

		$user = new User();

		if (isset($_POST["email"]) && isset($_POST["passwd"]) && isset($_POST["username"]) &&  isset($_POST["dni"]) &&  isset($_POST["telefono"]) &&  isset($_POST["direccion"]) &&  isset($_POST["genero"])){ // reaching via HTTP Post...

			
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
				
				
				if (!($this->userMapper->EmailExists($_POST["email"]) || $this->userMapper->DniExists($_POST["dni"]) || $this->userMapper->UsernameExists($_POST["username"])|| $this->userMapper->TelefonoExists($_POST["telefono"]))){
					

					
					
					$this->userMapper->save($user);

					
					$this->view->setFlash("Email ".$user->getEmail()." successfully added. Please login now");

					
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

		
		$this->view->setVariable("user", $user);

		
		$this->view->render("users", "register");

	}

	public function showAll() {
		if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== "administrador") {
			$this->view->redirect("noticias", "index");
			
			
			
		}
		
		$usuarios = $this->userMapper->findAll();
		
		
		
		$this->view->setVariable("usuarios", $usuarios);
		
		
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

			
			$usuario->setEmail($_POST["email"]);
			$usuario->setPassword($_POST["passwd"]);
			$usuario->setUsername($_POST["username"]);
			$usuario->setDni($_POST["dni"]);
			$usuario->setTelefono($_POST["telefono"]);
			$usuario->setDireccion($_POST["direccion"]);
			$usuario->setGenero($_POST["genero"]);
			$usuario->setRol($_POST["rol"]);
			
				

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
				
				
				if (!($this->userMapper->EmailExists($_POST["email"]) || $this->userMapper->DniExists($_POST["dni"]) || $this->userMapper->UsernameExists($_POST["username"])|| $this->userMapper->TelefonoExists($_POST["telefono"]))){
				
				$this->userMapper->save($usuario);

				
				$this->view->setFlash(sprintf(i18n("El usuario \"%s\" se agregó correctamente."),$usuario->getEmail()));

				
				header("Location: index.php?controller=users&action=showall");
				
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

		

		
		$this->view->render("users", "add");

	} catch(Exception $ex) {
		$this->view->popFlashF();
	header("Location: index.php?controller=users&action=showall");
	}

	}

	public function desconectar() {
		if(isset($_SESSION["rol"])){
		session_destroy();}

		
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


		
		$usuarioid = $_GET["id"];
		$usuario= $this->userMapper->findById($usuarioid);

		// Existe el usuario?
		if ($usuario == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el usuario"));
					throw new Exception();
		}

		

		if (isset($_POST["email"]) && isset($_POST["passwd"]) && isset($_POST["username"]) &&  isset($_POST["dni"]) &&  isset($_POST["telefono"]) &&  isset($_POST["direccion"]) &&  isset($_POST["genero"]) &&  isset($_POST["rol"])) { // reaching via HTTP Post...

		
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
				
			
				$this->userMapper->update($usuario);

				
				$this->view->setFlash("El usuario se actualizó correctamente");

				
				header("Location: index.php?controller=users&action=showall");

			} catch(Exception $ex) {
				$this->view->popFlashF();
			header("Location: index.php?controller=users&action=showall");
			}
		}

	
	$this->view->setVariable("usuario", $usuario);

	
	
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

		
		
		$usuarioid = $_GET["id"];
		$usuario= $this->userMapper->findById($usuarioid);

		// Existe el usuario?
		if ($usuario == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el usuario"));
					throw new Exception();
		}
		
		
		$this->userMapper->delete($usuario);

		
		$this->view->setFlash(sprintf(i18n("El usuario \"%s\" se borró correctamente."),$usuario->getEmail()));

		
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

		
		$user= $this->userMapper->findById($userid);

		if ($user == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el usuario"));
					throw new Exception();
		}
		
		$this->view->setVariable("usuario", $user);

		

		
		$this->view->render("users", "view");

	} catch(Exception $ex) {
		$this->view->popFlashF();
	header("Location: index.php?controller=users&action=showall");
	}

}
}