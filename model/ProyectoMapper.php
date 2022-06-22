<?php

require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Proyecto.php");



class ProyectoMapper {


	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	
	public function findAll() {
		$stmt = $this->db->query("SELECT * FROM PROYECTO");
		$proyecto_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$proyectos = array();
		
		foreach ($proyecto_db as $proyecto) {
			array_push($proyectos, new Proyecto($proyecto["ID_PROYECTO"],$proyecto["IMAGEN"], $proyecto["INTRODUCCION"],$proyecto["OBJETIVOS"],$proyecto["TITULO"],$proyecto["METODOLOGIA"],$proyecto["CONCLUSIONES"]));
		}

		return $proyectos;
	}


	public function findById($proyectoid){
		$stmt = $this->db->prepare("SELECT * FROM PROYECTO WHERE ID_PROYECTO=?");
		$stmt->execute(array($proyectoid));
		$proyecto = $stmt->fetch(PDO::FETCH_ASSOC);

		if($proyecto != null) {
			return new Proyecto(
				$proyecto["ID_PROYECTO"],$proyecto["IMAGEN"], $proyecto["INTRODUCCION"],$proyecto["OBJETIVOS"],$proyecto["TITULO"],$proyecto["METODOLOGIA"],$proyecto["CONCLUSIONES"]);
		} else {
			return NULL;
		}
	}


	
	public function update(Proyecto $proyecto) {
			$stmt = $this->db->prepare("UPDATE PROYECTO set IMAGEN=?, TITULO=?, INTRODUCCION=?,OBJETIVOS=?,METODOLOGIA=?,CONCLUSIONES=? where ID_PROYECTO=?");
			$stmt->execute(array($proyecto->getImagen(),$proyecto->getTitulo(),$proyecto->getIntroduccion(),$proyecto->getObjetivos(),$proyecto->getMetodologia(),$proyecto->getConclusiones(),$proyecto->getId()));
		}

	
public function delete(Proyecto $proyecto) {
	$stmt = $this->db->prepare("DELETE from PROYECTO WHERE ID_PROYECTO=?");
	$stmt->execute(array($proyecto->getId()));
	
}

public function save(Proyecto $proyecto) {
	$stmt = $this->db->prepare("INSERT INTO PROYECTO(IMAGEN,TITULO,INTRODUCCION,OBJETIVOS,METODOLOGIA,CONCLUSIONES) values (?,?,?,?,?,?)");
	$stmt->execute(array($proyecto->getImagen(),$proyecto->getTitulo(),$proyecto->getIntroduccion(),$proyecto->getObjetivos(),$proyecto->getMetodologia(),$proyecto->getConclusiones()));

}
	}
