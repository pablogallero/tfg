<?php





class Patrocinador {

	
	private $id;


	private $nombre;


	private $imagen;

	
	private $categoria;
	


	public function __construct($id=NULL, $nombre=NULL, $imagen=NULL,$categoria=NULL) {
		$this->id = $id;
		$this->nombre= $nombre;
		$this->imagen = $imagen;
		$this->categoria = $categoria;
		

	}


	public function getId() {
		return $this->id;
	}




	public function getNombre() {
		return $this->nombre;
	}


	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	public function getImagen() {
		return $this->imagen;
	}


	public function setImagen($imagen) {
		$this->imagen = $imagen;
	}

	public function getCategoria() {
		return $this->categoria;
	}


	public function setCategoria($categoria) {
		$this->categoria = $categoria;
	}



	

	
	
}
