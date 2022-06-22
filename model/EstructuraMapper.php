<?php

require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Contacto.php");



class EstructuraMapper {

	
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	
	public function findAll() {
		$stmt = $this->db->query("SELECT * FROM ESTRUCTURA");
		$estructura_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$estructuras = array();
		
		foreach ($estructura_db as $estructura) {
			array_push($estructuras, new Estructura($estructura["ID_ESTRUCTURA"], $estructura["TITULO"], $estructura["DESCRIPCION"], $estructura["ORGANIGRAMA"]));
		}

		return $estructuras;
	}

	

	}
