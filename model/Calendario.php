<?php




class Calendario {

	
	private $id;

	
	private $color;

	
	private $titulo;


	private $inicio;
	private $fin;

	

	public function __construct($id=NULL, $color=NULL, $inicio=NULL,$fin=NULL, $titulo=NULL) {
		$this->id = $id;
		$this->color= $color;
		$this->inicio = $inicio;
		$this->fin = $fin;
		$this->titulo = $titulo;

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

	public function getInicio() {
		return $this->inicio;
	}

	
	public function setInicio($inicio) {
		$this->inicio = $inicio;
	}

	public function getFin() {
		return $this->fin;
	}


	public function setFin($fin) {
		$this->fin = $fin;
	}
	public function getTitulo() {
		return $this->titulo;
	}


	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}


	

	
}
