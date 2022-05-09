<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Contacto.php");
require_once(__DIR__."/../model/Comment.php");


class EstructuraMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	/**
	* Retrieves all posts
	*
	* Note: Comments are not added to the Post instances
	*
	* @throws PDOException if a database error occurs
	* @return mixed Array of Post instances (without comments)
	*/
	public function findAll() {
		$stmt = $this->db->query("SELECT * FROM ESTRUCTURA");
		$estructura_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$estructuras = array();
		
		foreach ($estructura_db as $estructura) {
			array_push($estructuras, new Estructura($estructura["ID_ESTRUCTURA"], $estructura["TITULO"], $estructura["DESCRIPCION"], $estructura["ORGANIGRAMA"]));
		}

		return $estructuras;
	}

	
	public function save(Contacto $contacto) {
			$stmt = $this->db->prepare("INSERT INTO CONTACTOS(NOMBRE,APELLIDOS,EMAIL,CARGO,TELEFONO,RUTAFOTO,RUTATWITTER) values (?,?,?,?,?,?,?)");
			
			$stmt->execute(array($contacto->getNombre(), $contacto->getApellidos(),$contacto->getEmail(),$contacto->getCargo(),$contacto->getTelefono(),$contacto->getRutafoto(),$contacto->getRutatwitter()));
			
		}

		/**
		* Updates a Post in the database
		*
		* @param Post $post The post to be updated
		* @throws PDOException if a database error occurs
		* @return void
		*/
		public function update(Contacto $contacto) {
			$stmt = $this->db->prepare("UPDATE CONTACTOS set NOMBRE=?, APELLIDOS=? , EMAIL=? ,CARGO=? , TELEFONO=? ,RUTAFOTO=? , RUTATWITTER=? where ID_CONTACTO=?");
			$stmt->execute(array($contacto->getNombre(), $contacto->getApellidos(),$contacto->getEmail(),$contacto->getCargo(),$contacto->getTelefono(),$contacto->getRutafoto(),$contacto->getRutatwitter(), $contacto->getId()));
		}

		/**
		* Deletes a Post into the database
		*
		* @param Post $post The post to be deleted
		* @throws PDOException if a database error occurs
		* @return void
		*/
		public function delete(Contacto $contacto) {
			$stmt = $this->db->prepare("DELETE from CONTACTOS WHERE ID_CONTACTO=?");
			$stmt->execute(array($contacto->getId()));
		}

	}
