<?php

require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Categoria.php");



class CategoriaMapper {

	
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	
	public function findAll() {
		$stmt = $this->db->query("SELECT * FROM CATEGORIAS");
		$categoria_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$categorias = array();
		
		foreach ($categoria_db as $categoria) {
			array_push($categorias, new Categoria($categoria["ID_CATEGORIA"], $categoria["COLOR"], $categoria["NOMBRE"]));
		}

		return $categorias;
	}

	
	public function findById($categoriaid){
		$stmt = $this->db->prepare("SELECT * FROM CATEGORIAS WHERE ID_CATEGORIA=?");
		$stmt->execute(array($categoriaid));
		$categoria = $stmt->fetch(PDO::FETCH_ASSOC);

		if($categoria != null) {
			return new Categoria(
			$categoria["ID_CATEGORIA"],
			$categoria["COLOR"],
			$categoria["NOMBRE"]);
		} else {
			return NULL;
		}
	}

	
		
		public function save(Categoria $categoria) {
			$stmt = $this->db->prepare("INSERT INTO CATEGORIAS(NOMBRE,COLOR) values (?,?)");
			$stmt->execute(array($categoria->getNombre(),$categoria->getColor()));
			return $this->db->lastInsertId();
		}

		
		public function update(Categoria $categoria) {
			$stmt = $this->db->prepare("UPDATE CATEGORIAS set NOMBRE=?, COLOR=?  where ID_CATEGORIA=?");
			$stmt->execute(array($categoria->getNombre(),$categoria->getColor(),$categoria->getId()));
		}

		
		public function delete(Categoria $categoria) {
			$stmt = $this->db->prepare("DELETE from PATROCINADORES WHERE CATEGORIA=?");
			$stmt->execute(array($categoria->getId()));
			$stmt = $this->db->prepare("DELETE from CATEGORIAS WHERE ID_CATEGORIA=?");
			$stmt->execute(array($categoria->getId()));
		}

	}
