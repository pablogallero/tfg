<?php





class Estructura {

	
	private $id;

	
	private $titulo;

	
	private $descripcion;

	
	private $organigrama;

	

	public function __construct($id=NULL, $titulo=NULL,$descripcion=NULL,$organigrama=NULL) {
		$this->id = $id;
		$this->titulo= $titulo;
        $this->descripcion= $descripcion;
        $this->organigrama= $organigrama;
		
	}


	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}

	public function GetTitulo() {
		return $this->titulo;
	}
	public function setTitulo($titulo) {
		$this->titulo= $titulo;
	}

	public function getDescripcion() {
		return $this->descripcion;
	}

	public function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
	}
	
	public function getOrganigrama() {
		return $this->organigrama;
	}

	public function setOrganigrama($organigrama) {
		$this->organigrama = $organigrama;
	}
	



	
}
