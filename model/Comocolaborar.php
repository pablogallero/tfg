<?php
// file: model/Post.php

require_once(__DIR__."/../core/ValidationException.php");


class Comocolaborar {

	/**
	* The id of this post
	* @var string
	*/
	private $id;



	/**
	* The content of this post
	* @var string
	*/
	private $titulo;

	/**
	* The list of comments of this post
	* @var mixed
	*/
	private $descripcion;
	/**
	* The constructor
	*
	* @param string $id The id of the post
	* @param string $title The id of the post
	* @param string $content The content of the post
	* @param User $author The author of the post
	* @param mixed $comments The list of comments
	*/
	public function __construct($id=NULL,  $titulo=NULL, $descripcion=NULL) {
		$this->id = $id;
		
		$this->titulo = $titulo;
		
		$this->descripcion = $descripcion;

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

	/**
	* Sets the title of this post
	*
	* @param string $title the title of this post
	* @return void
	*/

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
	public function getDescripcion() {
		return $this->descripcion;
	}
	
	public function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
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
	public function checkIsValidForCreate() {
		$errors = array();
		if (strlen(trim($this->titulo)) == 0 ) {
			$errors["titulo"] = "El titulo es obligatorio";
		}
		
		if ($this->enlace == NULL ) {
			$errors["enlace"] = "El enlace al video es obligatorio";
		}

		if (sizeof($errors) > 0){
			throw new ValidationException($errors, "No se pudo agregar el videotutorial");
		}
	}

	public function checkIsValidForUpdate() {
		$errors = array();
		if (strlen(trim($this->titulo)) == 0 ) {
			$errors["titulo"] = "El titulo es obligatorio";
		}
		
		

		if (sizeof($errors) > 0){
			throw new ValidationException($errors, "No se pudo editar el videotutorial");
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
