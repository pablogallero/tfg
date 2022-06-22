<?php





class Videotutorial {


	private $id;


	private $fecha;


	private $titulo;


	private $enlace;


	private $descripcion;

	public function __construct($id=NULL, $fecha=NULL, $titulo=NULL, $enlace=NULL, $descripcion=NULL) {
		$this->id = $id;
		$this->fecha= $fecha;
		$this->titulo = $titulo;
		$this->enlace = $enlace;
		$this->descripcion = $descripcion;

	}


	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}

	public function getFecha() {
		return $this->fecha;
	}
	public function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	public function getEnlace() {
		return $this->enlace;
	}

	public function setEnlace($enlace) {
		$this->enlace = $enlace;
	}

	public function getTitulo() {
		return $this->titulo;
	}

	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}
	

	public function getDescripcion() {
		return $this->descripcion;
	}
	
	public function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
	}
	



	
}
