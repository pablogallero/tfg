<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Contacto.php");
require_once(__DIR__."/../model/Comment.php");


class ContactoMapper {

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
		$stmt = $this->db->query("SELECT * FROM CONTACTOS");
		$contactos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$contactos = array();
		
		foreach ($contactos_db as $contacto) {
			array_push($contactos, new Contacto($contacto["ID_CONTACTO"], $contacto["NOMBRE"], $contacto["APELLIDOS"], $contacto["EMAIL"],$contacto["CARGO"],$contacto["TELEFONO"],$contacto["RUTAFOTO"],$contacto["RUTATWITTER"]));
		}

		return $contactos;
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
	public function findById($contid){
		$stmt = $this->db->prepare("SELECT * FROM contactos WHERE id_contacto=?");
		$stmt->execute(array($contid));
		$cont = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($cont != null) {
			return new Contacto(
			$cont["ID_CONTACTO"],
			$cont["NOMBRE"],
			$cont["APELLIDOS"],
			$cont["EMAIL"],
			$cont["CARGO"],
			$cont["TELEFONO"],
			$cont["RUTAFOTO"],
			$cont["RUTATWITTER"],);
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
	public function save(Contacto $contacto) {
			$stmt = $this->db->prepare("INSERT INTO contactos(nombre,apellidos,email,cargo,telefono,rutafoto,rutatwitter) values (?,?,?,?,?,?,?)");
			
			$stmt->execute(array($contacto->getNombre(), $contacto->getApellidos(),$contacto->getEmail(),$contacto->getCargo(),$contacto->getTelefono(),$contacto->getRutafoto(),$contacto->getRutatwitter()));
			
		}

		/**
		* Updates a Post in the database
		*
		* @param Post $post The post to be updated
		* @throws PDOException if a database error occurs
		* @return void
		*/
		public function update(Contacto $contacto) {
			$stmt = $this->db->prepare("UPDATE contactos set nombre=?, apellidos=? , email=? ,cargo=? , telefono=? ,rutafoto=? , rutatwitter=? where id_contacto=?");
			$stmt->execute(array($contacto->getNombre(), $contacto->getApellidos(),$contacto->getEmail(),$contacto->getCargo(),$contacto->getTelefono(),$contacto->getRutafoto(),$contacto->getRutatwitter(), $contacto->getId()));
		}

		/**
		* Deletes a Post into the database
		*
		* @param Post $post The post to be deleted
		* @throws PDOException if a database error occurs
		* @return void
		*/
		public function delete(Contacto $contacto) {
			$stmt = $this->db->prepare("DELETE from contactos WHERE id_contacto=?");
			$stmt->execute(array($contacto->getId()));
		}

	}
