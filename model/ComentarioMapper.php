<?php
// file: model/CommentMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/Comment.php");


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
		$stmt = $this->db->prepare("INSERT INTO comentarios(fecha, usuarioid,cuerpo_comentario,noticiaid) values (?,?,?,?)");
		$stmt->execute(array(getdate()["year"]."-".getdate()["mon"]."-".getdate()["mday"] , $comentario->getUser()->getId() , $comentario->getCuerpo(), $comentario->getNoticia()->getId()));
		
	}
}
