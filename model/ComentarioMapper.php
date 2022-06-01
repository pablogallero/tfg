<?php
// file: model/CommentMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/Comment.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Noticia.php");
class ComentarioMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	/**
	* Saves a comment
	*
	* @param Comment $comment The comment to save
	* @throws PDOException if a database error occurs
	* @return int The new comment id
	*/
	public function save(Comentario $comentario) {
		$stmt = $this->db->prepare("INSERT INTO COMENTARIOS(FECHA, USUARIOID,CUERPO_COMENTARIO,NOTICIAID) values (?,?,?,?)");
		$stmt->execute(array(getdate()["year"]."-".getdate()["mon"]."-".getdate()["mday"] , $comentario->getUser()->getId() , $comentario->getCuerpo(), $comentario->getNoticia()->getId()));
		
	}
	public function delete(Comentario $comentario) {
		$stmt = $this->db->prepare("DELETE from COMENTARIOS WHERE ID_COMENTARIO=?");
		$stmt->execute(array($comentario->getId()));
		
	}

	public function findById($comentarioid){
		$stmt = $this->db->prepare("SELECT * FROM COMENTARIOS WHERE ID_COMENTARIO=?");
		$stmt->execute(array($comentarioid));
		$comentario = $stmt->fetch(PDO::FETCH_ASSOC);
		$user = new User($comentario["USUARIOID"]);
		$noticia = new Noticia($comentario["NOTICIAID"]);
		if($comentario != null) {
			return new Comentario(
			$comentario["ID_COMENTARIO"],
			$comentario["FECHA"],
			$user,
			$comentario["CUERPO_COMENTARIO"],
			$noticia);
		} else {
			return NULL;
		}
	}

}
