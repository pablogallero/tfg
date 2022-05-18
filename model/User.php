<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");


class User {

	/**
	* The user name of the user
	* @var string
	*/
	private $email;

	/**
	* The password of the user
	* @var string
	*/
	private $passwd;
	
	/**
	* The user name of the user
	* @var string
	*/
	private $username;

	/**
	* The password of the user
	* @var string
	*/
	private $dni;
	/**
	* The user name of the user
	* @var string
	*/
	private $telefono;

	/**
	* The password of the user
	* @var string
	*/
	private $direccion;

	/**
	* The user name of the user
	* @var string
	*/
	private $genero;

	/**
	* The password of the user
	* @var string
	*/
	private $rol;

	/**
	* The constructor
	*
	* @param string $username The name of the user
	* @param string $passwd The password of the user
	*/
	public function __construct($id=NULL,$username=NULL, $dni=NULL,$telefono=NULL,$email=NULL,$direccion=NULL,$genero=NULL,$passwd=NULL,$rol=NULL) {
		$this->id = $id;
		$this->email = $email;
		$this->passwd = $passwd;
		$this->username = $username;
		$this->dni = $dni;
		$this->telefono = $telefono;
		$this->direccion = $direccion;
		$this->genero = $genero;
		$this->rol = $rol;
	}

	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	/**
	* Gets the username of this user
	*
	* @return string The username of this user
	*/
	public function getEmail() {
		return $this->email;
	}

	/**
	* Sets the username of this user
	*
	* @param string $username The username of this user
	* @return void
	*/
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	* Gets the password of this user
	*
	* @return string The password of this user
	*/
	public function getPasswd() {
		return $this->passwd;
	}
	/**
	* Sets the password of this user
	*
	* @param string $passwd The password of this user
	* @return void
	*/
	public function setPassword($passwd) {
		$this->passwd = $passwd;
	}

	/**
	* Gets the password of this user
	*
	* @return string The password of this user
	*/
	public function getUsername() {
		return $this->username;
	}
	/**
	* Sets the password of this user
	*
	* @param string $passwd The password of this user
	* @return void
	*/
	public function setUsername($username) {
		$this->username = $username;
	}

	/**
	* Gets the password of this user
	*
	* @return string The password of this user
	*/
	public function getDni() {
		return $this->dni;
	}
	/**
	* Sets the password of this user
	*
	* @param string $passwd The password of this user
	* @return void
	*/
	public function setDni($dni) {
		$this->dni = $dni;
	}

	/**
	* Gets the password of this user
	*
	* @return string The password of this user
	*/
	public function getTelefono() {
		return $this->telefono;
	}
	/**
	* Sets the password of this user
	*
	* @param string $passwd The password of this user
	* @return void
	*/
	public function setTelefono($telefono) {
		$this->telefono = $telefono;
	}
	
	/**
	* Gets the password of this user
	*
	* @return string The password of this user
	*/
	public function getDireccion() {
		return $this->direccion;
	}
	/**
	* Sets the password of this user
	*
	* @param string $passwd The password of this user
	* @return void
	*/
	public function setDireccion($direccion) {
		$this->direccion = $direccion;
	}

	/**
	* Gets the password of this user
	*
	* @return string The password of this user
	*/
	public function getGenero() {
		return $this->genero;
	}
	/**
	* Sets the password of this user
	*
	* @param string $passwd The password of this user
	* @return void
	*/
	public function setGenero($genero) {
		$this->genero = $genero;
	}

	/**
	* Gets the password of this user
	*
	* @return string The password of this user
	*/
	public function getRol() {
		return $this->rol;
	}
	/**
	* Sets the password of this user
	*
	* @param string $passwd The password of this user
	* @return void
	*/
	public function setRol($rol) {
		$this->rol = $rol;
	}


	/**
	* Checks if the current user instance is valid
	* for being registered in the database
	*
	* @throws ValidationException if the instance is
	* not valid
	*
	* @return void
	*/
	public function checkIsValidForRegister() {
		$errors = array();
		if (strlen($this->email) < 5) {
			$errors["username"] = "Email must be at least 5 characters length";

		}
		if (strlen($this->passwd) < 5) {
			$errors["passwd"] = "Password must be at least 5 characters length";
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "user is not valid");
		}
	}
}
