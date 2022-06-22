<?php




class Galeria {

	
	private $id;

	
	private $fecha;


	private $titulo;


	private $ruta;

	
	
	public function __construct($id=NULL, $fecha=NULL, $titulo=NULL, $ruta=NULL) {
		$this->id = $id;
		$this->fecha= $fecha;
		$this->ruta = $ruta;
		$this->titulo = $titulo;

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
	
	public function getRuta() {
		return $this->ruta;
	}
	public function setRuta($ruta) {
		$this->ruta = $ruta;
	}
	
	public function getTitulo() {
		return $this->titulo;
	}

	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}

	


}
