<?php
// file: model/Post.php

require_once(__DIR__."/../core/ValidationException.php");


class Contacto {

	/**
	* The id of this post
	* @var string
	*/
	private $id;

	/**
	* The title of this post
	* @var string
	*/
	private $nombre;

	/**
	* The content of this post
	* @var string
	*/
	private $apellidos;

	/**
	* The author of this post
	* @var User
	*/
	private $email;

	/**
	* The list of comments of this post
	* @var mixed
	*/
	private $telefono;

    /**
	* The list of comments of this post
	* @var mixed
	*/
	private $rutafoto;

    /**
	* The list of comments of this post
	* @var mixed
	*/
	private $rutatwitter;
	/**
	* The constructor
	*
	* @param string $id The id of the post
	* @param string $title The id of the post
	* @param string $content The content of the post
	* @param User $author The author of the post
	* @param mixed $comments The list of comments
	*/
	public function __construct($id=NULL, $nombre=NULL,$apellidos=NULL,$email=NULL,$cargo=NULL,$telefono=NULL,$rutafoto=NULL,$rutatwitter=NULL) {
		$this->id = $id;
		$this->nombre= $nombre;
        $this->apellidos= $apellidos;
        $this->email= $email;
		$this->cargo= $cargo;
        $this->telefono= $telefono;
        $this->rutafoto= $rutafoto;
        $this->rutatwitter= $rutatwitter;

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
	public function getNombre() {
		return $this->nombre;
	}
	public function setNombre($nombre) {
		$this->nombre= $nombre;
	}
	/**
	* Sets the title of this post
	*
	* @param string $title the title of this post
	* @return void
	*/
	public function getApellidos() {
		return $this->apellidos;
	}

	public function setApellidos($apellidos) {
		$this->apellidos = $apellidos;
	}
	/**
	* Gets the content of this post
	*
	* @return string The content of this post
	*/
	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}
	
	public function getCargo() {
		return $this->cargo;
	}

	public function setCargo($cargo) {
		$this->cargo = $cargo;
	}
	/**
	* Sets the content of this post
	*
	* @param string $content the content of this post
	* @return void
	*/
	public function getTelefono() {
		return $this->telefono;
	}
	
	public function setTelefono($telefono) {
		$this->telefono = $telefono;
	}
	
    public function getRutafoto() {
		return $this->rutafoto;
	}
	public function setRutafoto($rutafoto) {
		$this->rutafoto = $rutafoto;
	}

    public function getRutatwitter() {
		return $this->rutatwitter;
	}
	public function setRutatwitter($rutatwitter) {
		$this->rutatwitter = $rutatwitter;
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
		if (strlen(trim($this->nombre)) == 0 ) {
			$errors["nombre"] = "El nombre es obligatorio";
		}
		
		if ($this->email == NULL ) {
			$errors["email"] = "El email es obligatorio";
		}

		if (sizeof($errors) > 0){
			throw new ValidationException($errors, "No se pudo agregar el contacto");
		}
	}

	public function checkIsValidForUpdate() {
		$errors = array();
		if (strlen(trim($this->nombre)) == 0 ) {
			$errors["nombre"] = "El nombre es obligatorio";
		}
		
		if ($this->email == NULL ) {
			$errors["email"] = "El email es obligatorio";
		}

		if (sizeof($errors) > 0){
			throw new ValidationException($errors, "No se pudo editar el contacto");
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
