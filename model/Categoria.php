<?php



class Categoria {

	
	private $id;

	
	private $color;

	
	private $nombre;


	
	public function __construct($id=NULL, $color=NULL, $nombre=NULL) {
		$this->id = $id;
		$this->color= $color;
		$this->nombre = $nombre;
	

	}

	
	public function getId() {
		return $this->id;
	}



	public function getColor() {
		return $this->color;
	}

	
	public function setColor($color) {
		$this->color = $color;
	}
	
	public function getNombre() {
		return $this->nombre;
	}

	
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}
	
	
	
}
