<?php

require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Patrocinador.php");



class PatrocinadorMapper {

	
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	
	public function findAll() {
		$stmt = $this->db->query("SELECT * FROM PATROCINADORES");
		$patrocinador_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$patrocinadores = array();
		
		foreach ($patrocinador_db as $patrocinador) {
			array_push($patrocinadores, new Patrocinador($patrocinador["ID_PATROCINADOR"], $patrocinador["NOMBRE"], $patrocinador["IMAGEN"],$patrocinador["CATEGORIA"]));
		}

		return $patrocinadores;
	}
	public function findCategoriaPatrocinador($categoriaid){
		$stmt = $this->db->prepare("SELECT
			P.ID_PATROCINADOR as 'PATROCINADORES.ID_PATROCINADOR',
			P.NOMBRE as 'PATROCINADORES.NOMBRE',
            P.IMAGEN as 'PATROCINADORES.IMAGEN',
            P.CATEGORIA as 'PATROCINADORES.CATEGORIA'
			

			FROM PATROCINADORES P LEFT OUTER JOIN CATEGORIAS C 
			ON P.CATEGORIA = C.ID_CATEGORIA			
			WHERE
			P.CATEGORIA=? ");
		$stmt->execute(array($categoriaid));
        

$patrocinador_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
$patrocinadores = array();
$patrocinadoresarr = array();

foreach ($patrocinador_db as $patrocinador) {
    
    
        
    array_push($patrocinadores, new Patrocinador($patrocinador["PATROCINADORES.ID_PATROCINADOR"], $patrocinador["PATROCINADORES.NOMBRE"], $patrocinador["PATROCINADORES.IMAGEN"],$patrocinador["PATROCINADORES.CATEGORIA"]));
}

return $patrocinadores;
    }
	
	public function findById($patrocinadorid){
		$stmt = $this->db->prepare("SELECT * FROM PATROCINADORES WHERE ID_PATROCINADOR=?");
		$stmt->execute(array($patrocinadorid));
		$patrocinador= $stmt->fetch(PDO::FETCH_ASSOC);

		if($patrocinador != null) {
			return new Patrocinador(
			$patrocinador["ID_PATROCINADOR"],
			$patrocinador["NOMBRE"],
			$patrocinador["IMAGEN"],
			$patrocinador["CATEGORIA"]);
		} else {
			return NULL;
		}
	}

	
		public function save(Patrocinador $patrocinador) {
			$stmt = $this->db->prepare("INSERT INTO PATROCINADORES(NOMBRE,IMAGEN,CATEGORIA) values (?,?,?)");
			$stmt->execute(array($patrocinador->getNombre(),$patrocinador->getImagen(),$patrocinador->getCategoria()));
			return $this->db->lastInsertId();
		}

	
		public function update(Patrocinador $patrocinador) {
			$stmt = $this->db->prepare("UPDATE PATROCINADORES set NOMBRE=?, IMAGEN=? , CATEGORIA=? where ID_PATROCINADOR=?");
			$stmt->execute(array($patrocinador->getNombre(),$patrocinador->getImagen(),$patrocinador->getCategoria(),$patrocinador->getId()));
		}

		
		public function delete(Patrocinador $patrocinador) {
			$stmt = $this->db->prepare("DELETE from PATROCINADORES WHERE ID_PATROCINADOR=?");
			$stmt->execute(array($patrocinador->getId()));
		}

	}
