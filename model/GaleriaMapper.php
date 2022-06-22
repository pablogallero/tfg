<?php

require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Galeria.php");



class GaleriaMapper {

	
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	
	public function findAll() {
		$stmt = $this->db->query("SELECT * FROM GALERIA");
		$galeria_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$fotos = array();
		
		foreach ($galeria_db as $galeria) {
			array_push($fotos, new Galeria($galeria["ID_IMAGEN"], $galeria["FECHA"], $galeria["TITULO"],$galeria["RUTA"]));
		}

		return $fotos;
	}


	public function findByImagen($imagenid){
		$stmt = $this->db->prepare("SELECT * FROM GALERIA WHERE RUTA=?");
		$stmt->execute(array($imagenid));
		$imagen = $stmt->fetch(PDO::FETCH_ASSOC);

		if($imagen != null) {
			return new Galeria(
			$imagen["ID_IMAGEN"],
			$imagen["FECHA"],
			$imagen["TITULO"],
			$imagen["RUTA"]);
		} else {
			return NULL;
		}
	}


		public function save(Galeria $galeria) {
			$stmt = $this->db->prepare("INSERT INTO GALERIA(TITULO, RUTA, FECHA) values (?,?,?)");
			$stmt->execute(array($galeria->getTitulo(), $galeria->getRuta(),getdate()["year"]."-".getdate()["mon"]."-".getdate()["mday"] ));
			return $this->db->lastInsertId();
		}

	
	public function delete(Galeria $galeria) {
			$stmt = $this->db->prepare("DELETE from GALERIA WHERE ID_IMAGEN=?");
			$stmt->execute(array($galeria->getId()));
		}

	}
