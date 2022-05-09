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
	private $fechainicio;

	/**
	* The content of this post
	* @var string
	*/
	private $imagenruta;

	/**
	* The author of this post
	* @var User
	*/
	private $titulo;

	/**
	* The list of comments of this post
	* @var mixed
	*/
	private $cuerpoproyecto;

	private $fotosalternativas;
	
	/**
	* The constructor
	*
	* @param string $id The id of the post
	* @param string $title The id of the post
	* @param string $content The content of the post
	* @param User $author The author of the post
	* @param mixed $comments The list of comments
	*/
	public function __construct($id=NULL, $fechainicio=NULL, $imagenruta=NULL, $titulo=NULL, $cuerpoproyecto=NULL,$fotosalternativas=NULL) {
		$this->id = $id;
		$this->fechainicio= $fecha;
		$this->imagenruta = $imagenruta;
		$this->titulo = $titulo;
		$this->cuerpoproyecto = $cuerpoproyecto;
		$this->fotosalternativas = $fotosalternativas;

		

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
	public function getFechainicio() {
		return $this->fechainicio;
	}

	public function setFechainicio($fechainicio) {
		$this->fechainicio = $fechainicio;
	}
	/**
	* Sets the title of this post
	*
	* @param string $title the title of this post
	* @return void
	*/
	public function getImagenruta() {
		return $this->imagenruta;
	}

	public function setImagenruta($imagenruta) {
		$this->imagenruta = $imagenruta;
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
	public function getCuerpoproyecto() {
		return $this->cuerpoproyecto;
	}
	public function setCuerpoproyecto($cuerpoproyecto) {
		$this->cuerpoproyecto = $cuerpoproyecto;
	}

	public function getFotosalternativas() {
		return $this->fotosalternativas;
	}
	public function setFotosalternativas($fotosalternativas) {
		$this->fotosalternativas = $fotosalternativas;
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
