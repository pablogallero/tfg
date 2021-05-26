<?php
// file: model/Post.php

require_once(__DIR__."/../core/ValidationException.php");


class Noticia {

	/**
	* The id of this post
	* @var string
	*/
	private $id;

	/**
	* The title of this post
	* @var string
	*/
	private $fecha;

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
	private $cuerponoticia;
	private $comentarios;
	/**
	* The constructor
	*
	* @param string $id The id of the post
	* @param string $title The id of the post
	* @param string $content The content of the post
	* @param User $author The author of the post
	* @param mixed $comments The list of comments
	*/
	public function __construct($id=NULL, $fecha=NULL, $imagenruta=NULL, $titulo=NULL, $cuerponoticia=NULL,$comentarios=NULL) {
		$this->id = $id;
		$this->fecha= $fecha;
		$this->imagenruta = $imagenruta;
		$this->titulo = $titulo;
		$this->cuerponoticia = $cuerponoticia;
		$this->comentarios = $comentarios;

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
	public function getFecha() {
		return $this->fecha;
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

	/**
	* Gets the content of this post
	*
	* @return string The content of this post
	*/
	public function getTitulo() {
		return $this->titulo;
	}

	/**
	* Sets the content of this post
	*
	* @param string $content the content of this post
	* @return void
	*/
	public function getCuerponoticia() {
		return $this->cuerponoticia;
	}
	/**
	* Gets the author of this post
	*
	* @return User The author of this post
	*/
	public function getComentarios() {
		return $this->comentarios;
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
