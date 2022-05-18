<?php
// file: model/Post.php

require_once(__DIR__."/../core/ValidationException.php");


class Proyecto {

	/**
	* The id of this post
	* @var string
	*/
	private $id;

	/**
	* The title of this post
	* @var string
	*/
	private $titulo;

	/**
	* The content of this post
	* @var string
	*/
	private $introduccion;

	/**
	* The author of this post
	* @var User
	*/
	private $objetivos;

	/**
	* The list of comments of this post
	* @var mixed
	*/
	private $metodologia;

	private $conclusiones;
	
	/**
	* The constructor
	*
	* @param string $id The id of the post
	* @param string $title The id of the post
	* @param string $content The content of the post
	* @param User $author The author of the post
	* @param mixed $comments The list of comments
	*/
	public function __construct($id=NULL,$imagen=NULL, $introduccion=NULL, $objetivos=NULL, $titulo=NULL, $metodologia=NULL,$conclusiones=NULL) {
		$this->id = $id;
		$this->imagen= $imagen;
		$this->introduccion= $introduccion;
		$this->objetivos = $objetivos;
		$this->titulo = $titulo;
		$this->metodologia = $metodologia;
		$this->conclusiones = $conclusiones;

		

	}

	/**
	* Gets the id of this post
	*
	* @return string The id of this post
	*/
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}
	/**
	* Gets the title of this post
	*
	* @return string The title of this post
	*/
	

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
	/**
	* Sets the title of this post
	*
	* @param string $title the title of this post
	* @return void
	*/
	public function getObjetivos() {
		return $this->objetivos;
	}

	public function setObjetivos($objetivos) {
		$this->objetivos = $objetivos;
	}
	/**
	* Gets the content of this post
	*
	* @return string The content of this post
	*/
	public function getTitulo() {
		return $this->titulo;
	}

	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}
	/**
	* Sets the content of this post
	*
	* @param string $content the content of this post
	* @return void
	*/
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

	/**
	* Gets the author of this post
	*
	* @return User The author of this post
	*/
	
	/**
	* Checks if the current instance is valid
	* for being updated in the database.
	*
	* @throws ValidationException if the instance is
	* not valid
	*
	* @return void
	*/
	public function checkIsValidForCreate() {
		$errors = array();
		if (strlen(trim($this->titulo)) == 0 ) {
			$errors["titulo"] = "title is mandatory";
		}
		if (strlen(trim($this->cuerponoticia)) == 0 ) {
			$errors["cuerponoticia"] = "content is mandatory";
		}
		if ($this->imagenruta == NULL ) {
			$errors["imagenruta"] = "image is mandatory";
		}

		if (sizeof($errors) > 0){
			throw new ValidationException($errors, "new is not valid");
		}
	}

	/**
	* Checks if the current instance is valid
	* for being updated in the database.
	*
	* @throws ValidationException if the instance is
	* not valid
	*
	* @return void
	*/
	
}
