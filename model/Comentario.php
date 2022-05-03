<?php
// file: model/Comment.php

require_once(__DIR__."/../core/ValidationException.php");

/**
* Class Comment
*
* Represents a Comment in the blog. A Comment is attached
* to a Post and was written by an specific User (author)
*
* @author lipido <lipido@gmail.com>
*/
class Comentario {

	/**
	* The id of the comment
	* @var string
	*/
	private $id;

	/**
	* The content of the comment
	* @var string
	*/
	private $fecha;

	/**
	* The author of the comment
	* @var User
	*/
	private $user;

	/**
	* The post being commented by this comment
	* @var Post
	*/
	private $cuerpo;

    private $noticia;

	

	/**
	* The constructor
	*
	* @param string $id The id of the comment
	* @param string $content The content of the comment
	* @param User $author The author of the comment
	* @param Post $post The parent post
	*/
	public function __construct($id=NULL,$fecha=NULL, User $user=NULL, $cuerpo=NULL, Noticia $noticia=NULL) {
		$this->id = $id;
		$this->fecha = $fecha;
		$this->user = $user;
        $this->cuerpo = $cuerpo;
        $this->noticia = $noticia;
	}

	/**
	* Gets the id of this comment
	*
	* @return string The id of this comment
	*/
	public function getId(){
		return $this->id;
	}

	/**
	* Gets the content of this comment
	*
	* @return string The content of this comment
	*/
	public function getFecha() {
		return $this->fecha;
	}

	/**
	* Sets the content of the Comment
	*
	* @param string $content the content of this comment
	* @return void
	*/
	public function setFecha($fecha) {
		$this->fecha = $fecha;
	}


    public function getCuerpo() {
		return $this->cuerpo;
	}

	/**
	* Sets the content of the Comment
	*
	* @param string $content the content of this comment
	* @return void
	*/
	public function setCuerpo($cuerpo) {
		$this->cuerpo = $cuerpo;
	}
	/**
	* Gets the author of this comment
	*
	* @return User The author of this comment
	*/
	public function getUser() {
		return $this->user;
	}

	/**
	* Sets the author of this comment
	*
	* @param User $author the author of this comment
	* @return void
	*/
	public function setUser(User $user){
		$this->user = $user;
	}

	/**
	* Gets the parent post of this comment
	*
	* @return Post The parent post of this comment
	*/
	public function getNoticia() {
		return $this->noticia;
	}

	/**
	* Sets the parent Post
	*
	* @param Post $post the parent post
	* @return void
	*/
	public function setNoticia(Noticia $noticia) {
		$this->noticia = $noticia;
	}

	/**
	* Checks if the current instance is valid
	* for being inserted in the database.
	*
	* @throws ValidationException if the instance is
	* not valid
	*
	* @return void
	*/
	public function checkIsValidForCreate() {
		$errors = array();

		if (strlen(trim($this->cuerpo)) < 1 ) {
			$errors["cuerpo"] = "El comentario no puede estar vacío";
		}
		if ($this->user == NULL ) {
			$errors["user"] = "El usuario es obligatorio";
		}
		if ($this->noticia == NULL ) {
			$errors["noticia"] = "La noticia es obligatoria";
		}

		if (sizeof($errors) > 0){
			throw new ValidationException($errors, "comment is not valid");
		}
	}
}
