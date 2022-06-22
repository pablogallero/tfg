<?php




class Noticia {

	
	private $id;

	
	private $fecha;

	
	private $imagenruta;

	
	private $titulo;

	
	private $cuerponoticia;

	private $comentarios;
	

	public function __construct($id=NULL, $fecha=NULL, $imagenruta=NULL, $titulo=NULL, $cuerponoticia=NULL,$comentarios=NULL) {
		$this->id = $id;
		$this->fecha= $fecha;
		$this->imagenruta = $imagenruta;
		$this->titulo = $titulo;
		$this->cuerponoticia = $cuerponoticia;
		$this->comentarios = $comentarios;

		

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
	
	public function getImagenruta() {
		return $this->imagenruta;
	}

	public function setImagenruta($imagenruta) {
		$this->imagenruta = $imagenruta;
	}
	
	public function getTitulo() {
		return $this->titulo;
	}

	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}
	
	public function getCuerponoticia() {
		return $this->cuerponoticia;
	}
	public function setCuerponoticia($cuerponoticia) {
		$this->cuerponoticia = $cuerponoticia;
	}

	public function getComentarios() {
		return $this->comentarios;
	}
	public function setComentarios($comentarios) {
		$this->comentarios = $comentarios;
	}

	
	
	
}
