<?php





class User {

	private $id;

	private $email;

	
	private $passwd;
	
	
	private $username;


	private $dni;

	private $telefono;


	private $direccion;


	private $genero;


	private $rol;


	public function __construct($id=NULL,$username=NULL, $dni=NULL,$telefono=NULL,$email=NULL,$direccion=NULL,$genero=NULL,$passwd=NULL,$rol=NULL) {
		$this->id = $id;
		$this->email = $email;
		$this->passwd = $passwd;
		$this->username = $username;
		$this->dni = $dni;
		$this->telefono = $telefono;
		$this->direccion = $direccion;
		$this->genero = $genero;
		$this->rol = $rol;
	}

	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}

	public function getEmail() {
		return $this->email;
	}


	public function setEmail($email) {
		$this->email = $email;
	}

	public function getPasswd() {
		return $this->passwd;
	}

	public function setPassword($passwd) {
		$this->passwd = $passwd;
	}


	public function getUsername() {
		return $this->username;
	}

	public function setUsername($username) {
		$this->username = $username;
	}


	public function getDni() {
		return $this->dni;
	}

	public function setDni($dni) {
		$this->dni = $dni;
	}


	public function getTelefono() {
		return $this->telefono;
	}

	public function setTelefono($telefono) {
		$this->telefono = $telefono;
	}
	

	public function getDireccion() {
		return $this->direccion;
	}

	public function setDireccion($direccion) {
		$this->direccion = $direccion;
	}


	public function getGenero() {
		return $this->genero;
	}

	public function setGenero($genero) {
		$this->genero = $genero;
	}


	public function getRol() {
		return $this->rol;
	}

	public function setRol($rol) {
		$this->rol = $rol;
	}


	
}
