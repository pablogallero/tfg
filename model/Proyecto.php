<?php





class Proyecto {


	private $id;

	
	private $titulo;

	
	private $introduccion;


	private $objetivos;

	
	private $metodologia;

	private $conclusiones;
	

	public function __construct($id=NULL,$imagen=NULL, $introduccion=NULL, $objetivos=NULL, $titulo=NULL, $metodologia=NULL,$conclusiones=NULL) {
		$this->id = $id;
		$this->imagen= $imagen;
		$this->introduccion= $introduccion;
		$this->objetivos = $objetivos;
		$this->titulo = $titulo;
		$this->metodologia = $metodologia;
		$this->conclusiones = $conclusiones;

		

	}


	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	

	public function getImagen() {
		return $this->imagen;
	}

	public function setImagen($imagen) {
		$this->imagen = $imagen;
	}



	public function getIntroduccion() {
		return $this->introduccion;
	}

	public function setIntroduccion($introduccion) {
		$this->introduccion = $introduccion;
	}

	public function getObjetivos() {
		return $this->objetivos;
	}

	public function setObjetivos($objetivos) {
		$this->objetivos = $objetivos;
	}
	
	public function getTitulo() {
		return $this->titulo;
	}

	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}
	
	public function getMetodologia() {
		return $this->metodologia;
	}
	public function setMetodologia($metodologia) {
		$this->metodologia = $metodologia;
	}

	public function getConclusiones() {
		return $this->conclusiones;
	}
	public function setConclusiones($conclusiones) {
		$this->conclusiones = $conclusiones;
	}


	
	
}
