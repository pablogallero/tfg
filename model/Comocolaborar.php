<?php





class Comocolaborar {

	
	private $id;



	
	private $titulo;

	
	private $descripcion;
	
	public function __construct($id=NULL,  $titulo=NULL, $descripcion=NULL) {
		$this->id = $id;
		
		$this->titulo = $titulo;
		
		$this->descripcion = $descripcion;

	}


	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
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
