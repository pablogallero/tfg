<?php

require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Calendario.php");



class CalendarioMapper {

	
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}


	public function findAll() {
		$stmt = $this->db->query("SELECT * FROM EVENTOS");
		$evento_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$eventos = array();
		
		foreach ($evento_db as $evento) {
			array_push($eventos, new Calendario($evento["ID_EVENTO"], $evento["COLOR"], $evento["INICIO"],$evento["FIN"],$evento["TITULO"]));
		}

		return $eventos;
	}

	
	public function findById($eventoid){
		$stmt = $this->db->prepare("SELECT * FROM EVENTOS WHERE ID_EVENTO=?");
		$stmt->execute(array($eventoid));
		$evento = $stmt->fetch(PDO::FETCH_ASSOC);

		if($evento != null) {
			return new Calendario(
			$evento["ID_EVENTO"],
			$evento["COLOR"],
			$evento["TITULO"],
			$evento["INICIO"],
			$evento["FIN"]);
		} else {
			return NULL;
		}
	}

		
		public function save(Calendario $calendario) {
			$stmt = $this->db->prepare("INSERT INTO EVENTOS(TITULO,COLOR,INICIO,FIN) values (?,?,?,?)");
			$stmt->execute(array($calendario->getTitulo(),$calendario->getColor(),$calendario->getInicio(),$calendario->getFin()));
			return $this->db->lastInsertId();
		}

	
		public function update(Calendario $evento) {
			$stmt = $this->db->prepare("UPDATE EVENTOS set TITULO=?, COLOR=? , INICIO=? , FIN=? where ID_EVENTO=?");
			$stmt->execute(array($evento->getTitulo(),$evento->getColor(),$evento->getInicio(),$evento->getFin(),$evento->getId()));
		}

		
		public function delete(Calendario $evento) {
			$stmt = $this->db->prepare("DELETE from EVENTOS WHERE ID_EVENTO=?");
			$stmt->execute(array($evento->getId()));
		}

	}
