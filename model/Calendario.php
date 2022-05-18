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
	private $color;

	/**
	* The content of this post
	* @var string
	*/
	private $titulo;

	/**
	* The author of this post
	* @var User
	*/
	private $inicio;
	private $fin;

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
	public function __construct($id=NULL, $color=NULL, $inicio=NULL,$fin=NULL, $titulo=NULL) {
		$this->id = $id;
		$this->color= $color;
		$this->inicio = $inicio;
		$this->fin = $fin;
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
	public function getColor() {
		return $this->color;
	}

	/**
	* Sets the content of the Comment
	*
	* @param string $content the content of this comment
	* @return void
	*/
	public function setColor($color) {
		$this->color = $color;
	}
	/**
	* Sets the title of this post
	*
	* @param string $title the title of this post
	* @return void
	*/
	public function getInicio() {
		return $this->inicio;
	}

	/**
	* Sets the content of the Comment
	*
	* @param string $content the content of this comment
	* @return void
	*/
	public function setInicio($inicio) {
		$this->inicio = $inicio;
	}
	/**
	* Gets the content of this post
	*
	* @return string The content of this post
	*/
	public function getFin() {
		return $this->fin;
	}

	/**
	* Sets the content of the Comment
	*
	* @param string $content the content of this comment
	* @return void
	*/
	public function setFin($fin) {
		$this->fin = $fin;
	}
	public function getTitulo() {
		return $this->titulo;
	}

	/**
	* Sets the content of the Comment
	*
	* @param string $content the content of this comment
	* @return void
	*/
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
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
