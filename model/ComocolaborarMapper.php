<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Comocolaborar.php");
require_once(__DIR__."/../model/Comment.php");


class ComocolaborarMapper {

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
		$stmt = $this->db->query("SELECT * FROM COMOCOLABORAR");
		$comocolaborar_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$comocolaborararr = array();
		
		foreach ($comocolaborar_db as $comocolaborar) {
			array_push($comocolaborararr, new Comocolaborar($comocolaborar["ID_COMOCOL"], $comocolaborar["TITULO"],$comocolaborar["DESCRIPCION"]));
		}

		return $comocolaborararr;
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

	/**
	* Loads a Post from the database given its id
	*
	* It includes all the comments
	*
	* @throws PDOException if a database error occurs
	* @return Post The Post instances (without comments). NULL
	* if the Post is not found
	*/
/*	public function findByIdWithComments($postid){
		$stmt = $this->db->prepare("SELECT
			P.id as 'post.id',
			P.title as 'post.title',
			P.content as 'post.content',
			P.author as 'post.author',
			C.id as 'comment.id',
			C.content as 'comment.content',
			C.post as 'comment.post',
			C.author as 'comment.author'

			FROM posts P LEFT OUTER JOIN comments C
			ON P.id = C.post
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
	public function save(Videotutorial $videotutorial) {
			$stmt = $this->db->prepare("INSERT INTO VIDEOTUTORIAL(TITULO,ENLACE,DESCRIPCION, FECHA) values (?,?,?,?)");
			
			$stmt->execute(array($videotutorial->getTitulo(), $videotutorial->getEnlace(), $videotutorial->getDescripcion(),getdate()["year"]."-".getdate()["mon"]."-".getdate()["mday"]));
			
		}

		/**
		* Updates a Post in the database
		*
		* @param Post $post The post to be updated
		* @throws PDOException if a database error occurs
		* @return void
		*/
		public function update(Comocolaborar $comocolaborar) {
			$stmt = $this->db->prepare("UPDATE COMOCOLABORAR set TITULO=?, DESCRIPCION=? where ID_COMOCOL=?");
			$stmt->execute(array($comocolaborar->getTitulo(), $comocolaborar->getDescripcion(), $comocolaborar->getId()));
		}

		/**
		* Deletes a Post into the database
		*
		* @param Post $post The post to be deleted
		* @throws PDOException if a database error occurs
		* @return void
		*/
		public function delete(Videotutorial $videotutorial) {
			$stmt = $this->db->prepare("DELETE from VIDEOTUTORIAL WHERE ID_VIDEOTUTORIAL=?");
			$stmt->execute(array($videotutorial->getId()));
		}

	}
