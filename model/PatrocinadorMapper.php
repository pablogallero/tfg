<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Patrocinador.php");
require_once(__DIR__."/../model/Comment.php");


class PatrocinadorMapper {

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
	/**
	* Loads a Post from the database given its id
	*
	* Note: Comments are not added to the Post
	*
	* @throws PDOException if a database error occurs
	* @return Post The Post instances (without comments). NULL
	* if the Post is not found
	*/
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
		public function save(Patrocinador $patrocinador) {
			$stmt = $this->db->prepare("INSERT INTO PATROCINADORES(NOMBRE,IMAGEN,CATEGORIA) values (?,?,?)");
			$stmt->execute(array($patrocinador->getNombre(),$patrocinador->getImagen(),$patrocinador->getCategoria()));
			return $this->db->lastInsertId();
		}

		/**
		* Updates a Post in the database
		*
		* @param Post $post The post to be updated
		* @throws PDOException if a database error occurs
		* @return void
		*/
		public function update(Patrocinador $patrocinador) {
			$stmt = $this->db->prepare("UPDATE PATROCINADORES set NOMBRE=?, IMAGEN=? , CATEGORIA=? where ID_PATROCINADOR=?");
			$stmt->execute(array($patrocinador->getNombre(),$patrocinador->getImagen(),$patrocinador->getCategoria(),$patrocinador->getId()));
		}

		/**
		* Deletes a Post into the database
		*
		* @param Post $post The post to be deleted
		* @throws PDOException if a database error occurs
		* @return void
		*/
		public function delete(Patrocinador $patrocinador) {
			$stmt = $this->db->prepare("DELETE from PATROCINADORES WHERE ID_PATROCINADOR=?");
			$stmt->execute(array($patrocinador->getId()));
		}

	}
