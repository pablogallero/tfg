<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Calendario.php");
require_once(__DIR__."/../model/Comment.php");


class CalendarioMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	/**
	* Retrieves all posts
	*
	* Note: Comments are not added to the Post instances
	*
	* @throws PDOException if a database error occurs
	* @return mixed Array of Post instances (without comments)
	*/
	public function findAll() {
		$stmt = $this->db->query("SELECT * FROM EVENTOS");
		$evento_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$eventos = array();
		
		foreach ($evento_db as $evento) {
			array_push($eventos, new Calendario($evento["ID_EVENTO"], $evento["COLOR"], $evento["INICIO"],$evento["FIN"],$evento["TITULO"]));
		}

		return $eventos;
	}

	/**
	* Loads a Post from the database given its id
	*
	* Note: Comments are not added to the Post
	*
	* @throws PDOException if a database error occurs
	* @return Post The Post instances (without comments). NULL
	* if the Post is not found
	*/
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
			$evento["FIN"],);
		} else {
			return NULL;
		}
	}

	/**
	* Loads a Post from the database given its id
	*
	* It includes all the comments
	*
	* @throws PDOException if a database error occurs
	* @return Post The Post instances (without comments). NULL
	* if the Post is not found
	*/
	public function findByIdWithComments($postid){
		$stmt = $this->db->prepare("SELECT
			P.id as 'post.id',
			P.title as 'post.title',
			P.content as 'post.content',
			P.author as 'post.author',
			C.id as 'comment.id',
			C.content as 'comment.content',
			C.post as 'comment.post',
			C.author as 'comment.author'

			FROM POSTS P LEFT OUTER JOIN COMMENTS C
			ON P.ID = C.POST
			WHERE
			P.id=? ");

			$stmt->execute(array($postid));
			$post_wt_comments= $stmt->fetchAll(PDO::FETCH_ASSOC);

			if (sizeof($post_wt_comments) > 0) {
				$post = new Post($post_wt_comments[0]["post.id"],
				$post_wt_comments[0]["post.title"],
				$post_wt_comments[0]["post.content"],
				new User($post_wt_comments[0]["post.author"]));
				$comments_array = array();
				if ($post_wt_comments[0]["comment.id"]!=null) {
					foreach ($post_wt_comments as $comment){
						$comment = new Comment( $comment["comment.id"],
						$comment["comment.content"],
						new User($comment["comment.author"]),
						$post);
						array_push($comments_array, $comment);
					}
				}
				$post->setComments($comments_array);

				return $post;
			}else {
				return NULL;
			}
		}

		/**
		* Saves a Post into the database
		*
		* @param Post $post The post to be saved
		* @throws PDOException if a database error occurs
		* @return int The mew post id
		*/
		public function save(Calendario $calendario) {
			$stmt = $this->db->prepare("INSERT INTO EVENTOS(TITULO,COLOR,INICIO,FIN) values (?,?,?,?)");
			$stmt->execute(array($calendario->getTitulo(),$calendario->getColor(),$calendario->getInicio(),$calendario->getFin()));
			return $this->db->lastInsertId();
		}

		/**
		* Updates a Post in the database
		*
		* @param Post $post The post to be updated
		* @throws PDOException if a database error occurs
		* @return void
		*/
		public function update(Calendario $evento) {
			$stmt = $this->db->prepare("UPDATE EVENTOS set TITULO=?, COLOR=? , INICIO=? , FIN=? where ID_EVENTO=?");
			$stmt->execute(array($evento->getTitulo(),$evento->getColor(),$evento->getInicio(),$evento->getFin(),$evento->getId()));
		}

		/**
		* Deletes a Post into the database
		*
		* @param Post $post The post to be deleted
		* @throws PDOException if a database error occurs
		* @return void
		*/
		public function delete(Calendario $evento) {
			$stmt = $this->db->prepare("DELETE from EVENTOS WHERE ID_EVENTO=?");
			$stmt->execute(array($evento->getId()));
		}

	}
