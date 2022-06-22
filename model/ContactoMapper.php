<?php

require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Contacto.php");



class ContactoMapper {


	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}


	public function findAll() {
		$stmt = $this->db->query("SELECT * FROM CONTACTOS");
		$contactos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$contactos = array();
		
		foreach ($contactos_db as $contacto) {
			array_push($contactos, new Contacto($contacto["ID_CONTACTO"], $contacto["NOMBRE"], $contacto["APELLIDOS"], $contacto["EMAIL"],$contacto["CARGO"],$contacto["TELEFONO"],$contacto["RUTAFOTO"],$contacto["RUTATWITTER"]));
		}

		return $contactos;
	}

	public function findAllCargo() {
		$stmt = $this->db->query("SELECT * FROM CONTACTOS WHERE CARGO='Admin'");
		
		$contactos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$contactos = array();
		
		foreach ($contactos_db as $contacto) {
			array_push($contactos, new Contacto($contacto["ID_CONTACTO"], $contacto["NOMBRE"], $contacto["APELLIDOS"], $contacto["EMAIL"],$contacto["CARGO"],$contacto["TELEFONO"],$contacto["RUTAFOTO"],$contacto["RUTATWITTER"]));
		}

		return $contactos;
	}


	public function findById($contid){
		$stmt = $this->db->prepare("SELECT * FROM CONTACTOS WHERE ID_CONTACTO=?");
		$stmt->execute(array($contid));
		$cont = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($cont != null) {
			return new Contacto(
			$cont["ID_CONTACTO"],
			$cont["NOMBRE"],
			$cont["APELLIDOS"],
			$cont["EMAIL"],
			$cont["CARGO"],
			$cont["TELEFONO"],
			$cont["RUTAFOTO"],
			$cont["RUTATWITTER"],);
		} else {
			return NULL;
		}
	}


	public function save(Contacto $contacto) {
			$stmt = $this->db->prepare("INSERT INTO CONTACTOS(NOMBRE,APELLIDOS,EMAIL,CARGO,TELEFONO,RUTAFOTO,RUTATWITTER) values (?,?,?,?,?,?,?)");
			
			$stmt->execute(array($contacto->getNombre(), $contacto->getApellidos(),$contacto->getEmail(),$contacto->getCargo(),$contacto->getTelefono(),$contacto->getRutafoto(),$contacto->getRutatwitter()));
			
		}

	
		public function update(Contacto $contacto) {
			$stmt = $this->db->prepare("UPDATE CONTACTOS set NOMBRE=?, APELLIDOS=? , EMAIL=? ,CARGO=? , TELEFONO=? ,RUTAFOTO=? , RUTATWITTER=? where ID_CONTACTO=?");
			$stmt->execute(array($contacto->getNombre(), $contacto->getApellidos(),$contacto->getEmail(),$contacto->getCargo(),$contacto->getTelefono(),$contacto->getRutafoto(),$contacto->getRutatwitter(), $contacto->getId()));
		}

	
		public function delete(Contacto $contacto) {
			$stmt = $this->db->prepare("DELETE from CONTACTOS WHERE ID_CONTACTO=?");
			$stmt->execute(array($contacto->getId()));
		}

	}
