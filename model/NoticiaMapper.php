<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Noticia.php");
require_once(__DIR__."/../model/Comentario.php");


class NoticiaMapper {

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
		$stmt = $this->db->query("SELECT * FROM NOTICIA");
		$noticia_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$noticias = array();
		
		foreach ($noticia_db as $noticia) {
			array_push($noticias, new Noticia($noticia["ID_NOTICIA"], $noticia["FECHA"], $noticia["IMAGEN_RUTA"], $noticia["TITULO"],$noticia["CUERPO_NOTICIA"]));
		}

		return $noticias;
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
	public function findById($noticiaid){
		$stmt = $this->db->prepare("SELECT * FROM noticia WHERE id_noticia=?");
		$stmt->execute(array($noticiaid));
		$noticia = $stmt->fetch(PDO::FETCH_ASSOC);

		if($noticia != null) {
			return new Noticia(
			$noticia["ID_NOTICIA"],
			$noticia["FECHA"],
			$noticia["IMAGEN_RUTA"],
			$noticia["TITULO"],
			$noticia["CUERPO_NOTICIA"]);
		} else {
			return NULL;
		}
	}

	public function findByIdWithComments($noticiaid){
		$stmt = $this->db->prepare("SELECT
			N.id_noticia as 'noticia.id_noticia',
			N.titulo as 'noticia.titulo',
			N.cuerpo_noticia as 'noticia.cuerpo_noticia',
			N.imagen_ruta as 'noticia.imagen_ruta',
			N.fecha as 'noticia.fecha',
			C.id_comentario as 'comentarios.id_comentario',
			C.usuarioid as 'comentarios.usuarioid',
			C.noticiaid as 'comentarios.noticiaid',
			C.cuerpo_comentario as 'comentarios.cuerpo_comentario',
			C.fecha as 'comentarios.fecha',
			U.id_usuario as 'usuario.id_usuario',
			U.username as 'usuario.username',
			U.dni as 'usuario.dni',
			U.telefono as 'usuario.telefono',
			U.email as 'usuario.email',
			U.direccion as 'usuario.direccion',
			U.genero as 'usuario.genero',
			U.passwd as 'usuario.passwd',
			U.rol as 'usuario.rol'
			

			FROM noticia N LEFT OUTER JOIN comentarios C 
			ON N.id_noticia = C.noticiaid
			LEFT OUTER JOIN usuario U 
			ON C.usuarioid = U.id_usuario
			WHERE
			N.id_noticia =? ");

			$stmt->execute(array($noticiaid));
			$noticia_wt_comentarios= $stmt->fetchAll(PDO::FETCH_ASSOC);

			if(sizeof($noticia_wt_comentarios) > 0) {
				$noticia = new Noticia($noticia_wt_comentarios[0]["noticia.id_noticia"],
				$noticia_wt_comentarios[0]["noticia.fecha"],
				$noticia_wt_comentarios[0]["noticia.imagen_ruta"],
				$noticia_wt_comentarios[0]["noticia.titulo"],
				$noticia_wt_comentarios[0]["noticia.cuerpo_noticia"]);
				$usuario = new User($noticia_wt_comentarios[0]["usuario.id_usuario"],
				$noticia_wt_comentarios[0]["usuario.email"],
				$noticia_wt_comentarios[0]["usuario.passwd"],
				$noticia_wt_comentarios[0]["usuario.username"],
				$noticia_wt_comentarios[0]["usuario.dni"],
				$noticia_wt_comentarios[0]["usuario.telefono"],
				$noticia_wt_comentarios[0]["usuario.direccion"],
				$noticia_wt_comentarios[0]["usuario.genero"],
				$noticia_wt_comentarios[0]["usuario.rol"]);
				$comentarios_array = array();
				if ($noticia_wt_comentarios[0]["comentarios.id_comentario"]!=null) {
					foreach ($noticia_wt_comentarios as $comentario){
						$comentario = new Comentario( $comentario["comentarios.id_comentario"],
						$comentario["comentarios.fecha"],
						$usuario,
						$comentario["comentarios.cuerpo_comentario"],
						
						
						$noticia);	
						array_push($comentarios_array, $comentario);
					}
				}
				$noticia->setComentarios($comentarios_array);

				return $noticia;
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
		public function save(Noticia $noticia) {
			$stmt = $this->db->prepare("INSERT INTO noticia(fecha,imagen_ruta,titulo,cuerpo_noticia) values (?,?,?,?)");
			$stmt->execute(array(getdate()["year"]."-".getdate()["mon"]."-".getdate()["mday"],$noticia->getImagenruta(),$noticia->getTitulo(),$noticia->getCuerponoticia()));
	
		}

		/**
		* Updates a Post in the database
		*
		* @param Post $post The post to be updated
		* @throws PDOException if a database error occurs
		* @return void
		*/
	public function update(Noticia $noticia) {
			$stmt = $this->db->prepare("UPDATE noticias set fecha=?, imagen_ruta=?, titulo=?,cuerpo_noticia=? where id_noticia=?");
			$stmt->execute(array(getdate()["year"]."-".getdate()["mon"]."-".getdate()["mday"], $noticia->getImagenruta(),$noticia->getTitulo(),$noticia->getCuerponoticia(),$noticia->getId()));
		}

		/**
		* Deletes a Post into the database
		*
		* @param Post $post The post to be deleted
		* @throws PDOException if a database error occurs
		* @return void
		*/
	/*	public function delete(Post $post) {
			$stmt = $this->db->prepare("DELETE from posts WHERE id=?");
			$stmt->execute(array($post->getId()));
		}
*/
public function delete(Noticia $noticia) {
	$stmt = $this->db->prepare("DELETE from noticia WHERE id_noticia=?");
	$stmt->execute(array($noticia->getId()));
	$stmt = $this->db->prepare("DELETE from comentarios WHERE noticiaid=?");
	$stmt->execute(array($noticia->getId()));
}
	}
