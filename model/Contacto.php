<?php





class Contacto {

	
	private $id;

	
	private $nombre;


	private $apellidos;


	private $email;


	private $telefono;


	private $rutafoto;

   
	private $rutatwitter;

	public function __construct($id=NULL, $nombre=NULL,$apellidos=NULL,$email=NULL,$cargo=NULL,$telefono=NULL,$rutafoto=NULL,$rutatwitter=NULL) {
		$this->id = $id;
		$this->nombre= $nombre;
        $this->apellidos= $apellidos;
        $this->email= $email;
		$this->cargo= $cargo;
        $this->telefono= $telefono;
        $this->rutafoto= $rutafoto;
        $this->rutatwitter= $rutatwitter;

	}


	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}

	public function getNombre() {
		return $this->nombre;
	}
	public function setNombre($nombre) {
		$this->nombre= $nombre;
	}

	public function getApellidos() {
		return $this->apellidos;
	}

	public function setApellidos($apellidos) {
		$this->apellidos = $apellidos;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}
	
	public function getCargo() {
		return $this->cargo;
	}

	public function setCargo($cargo) {
		$this->cargo = $cargo;
	}

	public function getTelefono() {
		return $this->telefono;
	}
	
	public function setTelefono($telefono) {
		$this->telefono = $telefono;
	}
	
    public function getRutafoto() {
		return $this->rutafoto;
	}
	public function setRutafoto($rutafoto) {
		$this->rutafoto = $rutafoto;
	}

    public function getRutatwitter() {
		return $this->rutatwitter;
	}
	public function setRutatwitter($rutatwitter) {
		$this->rutatwitter = $rutatwitter;
	}



}
