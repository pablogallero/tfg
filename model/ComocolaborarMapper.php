<?php

require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Comocolaborar.php");



class ComocolaborarMapper {


	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function findAll() {
		$stmt = $this->db->query("SELECT * FROM COMOCOLABORAR");
		$comocolaborar_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$comocolaborararr = array();
		
		foreach ($comocolaborar_db as $comocolaborar) {
			array_push($comocolaborararr, new Comocolaborar($comocolaborar["ID_COMOCOL"], $comocolaborar["TITULO"],$comocolaborar["DESCRIPCION"]));
		}

		return $comocolaborararr;
	}


	public function findById($comocolaborarid){
		$stmt = $this->db->prepare("SELECT * FROM COMOCOLABORAR WHERE ID_COMOCOL=?");
		$stmt->execute(array($comocolaborarid));
		$comocolaborar = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($comocolaborarid != null) {
			return new Comocolaborar(
			$comocolaborar["ID_COMOCOL"],
			
			$comocolaborar["TITULO"],
			
			$comocolaborar["DESCRIPCION"]);
		} else {
			return NULL;
		}
	}




	
		public function update(Comocolaborar $comocolaborar) {
			$stmt = $this->db->prepare("UPDATE COMOCOLABORAR set TITULO=?, DESCRIPCION=? where ID_COMOCOL=?");
			$stmt->execute(array($comocolaborar->getTitulo(), $comocolaborar->getDescripcion(), $comocolaborar->getId()));
		}

	

	}
