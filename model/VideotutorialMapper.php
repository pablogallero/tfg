<?php

require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Videotutorial.php");



class VideotutorialMapper {

	
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	
	public function findAll() {
		$stmt = $this->db->query("SELECT * FROM VIDEOTUTORIAL");
		$videotutorial_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$videotutoriales = array();
		
		foreach ($videotutorial_db as $videotutorial) {
			array_push($videotutoriales, new Videotutorial($videotutorial["ID_VIDEOTUTORIAL"], $videotutorial["FECHA"], $videotutorial["TITULO"], $videotutorial["ENLACE"],$videotutorial["DESCRIPCION"],$videotutorial["DESCRIPCION"]));
		}

		return $videotutoriales;
	}


	public function findById($videoid){
		$stmt = $this->db->prepare("SELECT * FROM VIDEOTUTORIAL WHERE ID_VIDEOTUTORIAL=?");
		$stmt->execute(array($videoid));
		$video = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($video != null) {
			return new Videotutorial(
			$video["ID_VIDEOTUTORIAL"],
			$video["FECHA"],
			$video["TITULO"],
			$video["ENLACE"],
			$video["DESCRIPCION"]);
		} else {
			return NULL;
		}
	}


	public function save(Videotutorial $videotutorial) {
			$stmt = $this->db->prepare("INSERT INTO VIDEOTUTORIAL(TITULO,ENLACE,DESCRIPCION, FECHA) values (?,?,?,?)");
			
			$stmt->execute(array($videotutorial->getTitulo(), $videotutorial->getEnlace(), $videotutorial->getDescripcion(),getdate()["year"]."-".getdate()["mon"]."-".getdate()["mday"]));
			
		}

	
		public function update(Videotutorial $videotutorial) {
			$stmt = $this->db->prepare("UPDATE VIDEOTUTORIAL set TITULO=?, ENLACE=? , DESCRIPCION=? WHERE ID_VIDEOTUTORIAL=?");
			$stmt->execute(array($videotutorial->getTitulo(), $videotutorial->getEnlace(),$videotutorial->getDescripcion(), $videotutorial->getId()));
		}

	
		public function delete(Videotutorial $videotutorial) {
			$stmt = $this->db->prepare("DELETE from VIDEOTUTORIAL WHERE ID_VIDEOTUTORIAL=?");
			$stmt->execute(array($videotutorial->getId()));
		}

	}
