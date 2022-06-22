<?php





class Comentario {


	private $id;


	private $fecha;

	private $user;

	private $cuerpo;

    private $noticia;

	


	public function __construct($id=NULL,$fecha=NULL, User $user=NULL, $cuerpo=NULL, Noticia $noticia=NULL) {
		$this->id = $id;
		$this->fecha = $fecha;
		$this->user = $user;
        $this->cuerpo = $cuerpo;
        $this->noticia = $noticia;
	}


	public function getId(){
		return $this->id;
	}

	
	public function getFecha() {
		return $this->fecha;
	}

	
	public function setFecha($fecha) {
		$this->fecha = $fecha;
	}


    public function getCuerpo() {
		return $this->cuerpo;
	}

	
	public function setCuerpo($cuerpo) {
		$this->cuerpo = $cuerpo;
	}
	
	public function getUser() {
		return $this->user;
	}

	
	public function setUser(User $user){
		$this->user = $user;
	}

	
	public function getNoticia() {
		return $this->noticia;
	}

	
	public function setNoticia(Noticia $noticia) {
		$this->noticia = $noticia;
	}

	
	
}
