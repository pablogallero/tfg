<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");


class UserMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	/**
	* Saves a User into the database
	*
	* @param User $user The user to be saved
	* @throws PDOException if a database error occurs
	* @return void
	*/
	public function save($user) {
		$stmt = $this->db->prepare("INSERT INTO USUARIO(USERNAME,DNI,TELEFONO,EMAIL,DIRECCION,GENERO,PASSWD,ROL) values (?,?,?,?,?,?,?,?)");
		$stmt->execute(array($user->getUsername(), $user->getDni(), $user->getTelefono(), $user->getEmail(), $user->getDireccion(), $user->getGenero(), $user->getPasswd(), $user->getRol()));
	}

	/**
	* Checks if a given username is already in the database
	*
	* @param string $username the username to check
	* @return boolean true if the username exists, false otherwise
	*/

	public function findById($userid){
		$stmt = $this->db->prepare("SELECT * FROM USUARIO WHERE ID_USUARIO=?");
		$stmt->execute(array($userid));
		$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

		if($usuario != null) {
			return new User(
			$usuario["ID_USUARIO"],
			$usuario["USERNAME"],
			$usuario["DNI"],
			$usuario["TELEFONO"],
			$usuario["EMAIL"],
			$usuario["DIRECCION"],
			$usuario["GENERO"],
			$usuario["PASSWD"],
			$usuario["ROL"],);
		} else {
			return NULL;
		}
	}

	public function findByEmail($emailuser){
		$stmt = $this->db->prepare("SELECT * FROM USUARIO WHERE EMAIL=?");
		$stmt->execute(array($emailuser));
		$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

		if($usuario != null) {
			return new User(
			$usuario["ID_USUARIO"],
			$usuario["USERNAME"],
			$usuario["DNI"],
			$usuario["TELEFONO"],
			$usuario["EMAIL"],
			$usuario["DIRECCION"],
			$usuario["GENERO"],
			$usuario["PASSWD"],
			$usuario["ROL"],);
		} else {
			return NULL;
		}
	}

	


	public function EmailExists($email) {
		$stmt = $this->db->prepare("SELECT count(EMAIL) FROM USUARIO where EMAIL	=?");
		$stmt->execute(array($email));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
		else return false;
	}

	public function DniExists($dni) {
		$stmt = $this->db->prepare("SELECT count(DNI) FROM USUARIO where DNI	=?");
		$stmt->execute(array($dni));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
		else return false;
	}

	public function UsuarioExists($username) {
		$stmt = $this->db->prepare("SELECT count(USERNAME) FROM USUARIO where USERNAME	=?");
		$stmt->execute(array($username));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
		else return false;
	}

	public function RolfromEmail($email) {
		$stmt = $this->db->prepare("SELECT ROL FROM USUARIO where EMAIL	=?");
		$stmt->execute(array($email));
		
		$rolemail = $stmt->fetch(PDO::FETCH_ASSOC);
		
		return $rolemail;

		
	}


	/**
	* Checks if a given pair of username/password exists in the database
	*
	* @param string $username the username
	* @param string $passwd the password
	* @return boolean true the username/passwrod exists, false otherwise.
	*/
	public function isValidUser($email, $passwd) {
		$stmt = $this->db->prepare("SELECT count(EMAIL) FROM USUARIO where EMAIL=? and PASSWD=?");
		$stmt->execute(array($email, $passwd));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}
}
