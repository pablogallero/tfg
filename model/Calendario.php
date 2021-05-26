<?php
// file: model/Post.php

require_once(__DIR__."/../core/ValidationException.php");


class Calendario {

	/**
	* The id of this post
	* @var string
	*/
	private $id;

	/**
	* The title of this post
	* @var string
	*/
	private $hora;

	/**
	* The content of this post
	* @var string
	*/
	private $titulo;

	/**
	* The author of this post
	* @var User
	*/
	private $descripcion;

	/**
	* The list of comments of this post
	* @var mixed
	*/
	
	/**
	* The constructor
	*
	* @param string $id The id of the post
	* @param string $title The id of the post
	* @param string $content The content of the post
	* @param User $author The author of the post
	* @param mixed $comments The list of comments
	*/
	public function __construct($id=NULL, $hora=NULL, $descripcion=NULL, $titulo=NULL) {
		$this->id = $id;
		$this->hora= $hora;
		$this->descripcion = $descripcion;
		$this->titulo = $titulo;

	}

	/**
	* Gets the id of this post
	*
	* @return string The id of this post
	*/
	public function getId() {
		return $this->id;
	}

	/**
	* Gets the title of this post
	*
	* @return string The title of this post
	*/
	public function getHora() {
		return $this->hora;
	}

	/**
	* Sets the title of this post
	*
	* @param string $title the title of this post
	* @return void
	*/
	public function getDescripcion() {
		return $this->descripcion;
	}

	/**
	* Gets the content of this post
	*
	* @return string The content of this post
	*/
	public function getTitulo() {
		return $this->titulo;
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
		if (strlen(trim($this->title)) == 0 ) {
			$errors["title"] = "title is mandatory";
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
