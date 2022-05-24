<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Categoria.php");



class CategoriaMapper {

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
		$stmt = $this->db->query("SELECT * FROM CATEGORIAS");
		$categoria_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$categorias = array();
		
		foreach ($categoria_db as $categoria) {
			array_push($categorias, new Categoria($categoria["ID_CATEGORIA"], $categoria["COLOR"], $categoria["NOMBRE"]));
		}

		return $categorias;
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
		public function save(Categoria $categoria) {
			$stmt = $this->db->prepare("INSERT INTO CATEGORIAS(NOMBRE,COLOR) values (?,?)");
			$stmt->execute(array($categoria->getNombre(),$categoria->getColor()));
			return $this->db->lastInsertId();
		}

		/**
		* Updates a Post in the database
		*
		* @param Post $post The post to be updated
		* @throws PDOException if a database error occurs
		* @return void
		*/
		public function update(Categoria $categoria) {
			$stmt = $this->db->prepare("UPDATE CATEGORIAS set NOMBRE=?, COLOR=?  where ID_CATEGORIA=?");
			$stmt->execute(array($categoria->getNombre(),$categoria->getColor(),$categoria->getId()));
		}

		/**
		* Deletes a Post into the database
		*
		* @param Post $post The post to be deleted
		* @throws PDOException if a database error occurs
		* @return void
		*/
		public function delete(Categoria $categoria) {
			$stmt = $this->db->prepare("DELETE from PATROCINADORES WHERE CATEGORIA=?");
			$stmt->execute(array($categoria->getId()));
			$stmt = $this->db->prepare("DELETE from CATEGORIAS WHERE ID_CATEGORIA=?");
			$stmt->execute(array($categoria->getId()));
		}

	}
