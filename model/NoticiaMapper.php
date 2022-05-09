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
		$stmt = $this->db->prepare("SELECT * FROM NOTICIA WHERE ID_NOTICIA=?");
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
			N.ID_NOTICIA as 'NOTICIA.ID_NOTICIA',
			N.TITULO as 'NOTICIA.TITULO',
			N.CUERPO_NOTICIA as 'NOTICIA.CUERPO_NOTICIA',
			N.IMAGEN_RUTA as 'NOTICIA.IMAGEN_RUTA',
			N.FECHA as 'NOTICIA.FECHA',
			C.ID_COMENTARIO as 'COMENTARIOS.ID_COMENTARIO',
			C.USUARIOID as 'COMENTARIOS.USUARIOID',
			C.NOTICIAID as 'COMENTARIOS.NOTICIAID',
			C.CUERPO_COMENTARIO as 'COMENTARIOS.CUERPO_COMENTARIO',
			C.FECHA as 'COMENTARIOS.FECHA',
			U.ID_USUARIO as 'USUARIO.ID_USUARIO',
			U.USERNAME as 'USUARIO.USERNAME',
			U.DNI as 'USUARIO.DNI',
			U.TELEFONO as 'USUARIO.TELEFONO',
			U.EMAIL as 'USUARIO.EMAIL',
			U.DIRECCION as 'USUARIO.DIRECCION',
			U.GENERO as 'USUARIO.GENERO',
			U.PASSWD as 'USUARIO.PASSWD',
			U.ROL as 'USUARIO.ROL'
			

			FROM NOTICIA N LEFT OUTER JOIN COMENTARIOS C 
			ON N.ID_NOTICIA = C.NOTICIAID
			LEFT OUTER JOIN USUARIO U 
			ON C.USUARIOID = U.ID_USUARIO
			WHERE
			N.ID_NOTICIA =? ");

			$stmt->execute(array($noticiaid));
			$noticia_wt_comentarios= $stmt->fetchAll(PDO::FETCH_ASSOC);

			if(sizeof($noticia_wt_comentarios) > 0) {
				$noticia = new Noticia($noticia_wt_comentarios[0]["NOTICIA.ID_NOTICIA"],
				$noticia_wt_comentarios[0]["NOTICIA.FECHA"],
				$noticia_wt_comentarios[0]["NOTICIA.IMAGEN_RUTA"],
				$noticia_wt_comentarios[0]["NOTICIA.TITULO"],
				$noticia_wt_comentarios[0]["NOTICIA.CUERPO_NOTICIA"]);
				$usuario = new User($noticia_wt_comentarios[0]["USUARIO.ID_USUARIO"],
				$noticia_wt_comentarios[0]["USUARIO.EMAIL"],
				$noticia_wt_comentarios[0]["USUARIO.PASSWD"],
				$noticia_wt_comentarios[0]["USUARIO.USERNAME"],
				$noticia_wt_comentarios[0]["USUARIO.DNI"],
				$noticia_wt_comentarios[0]["USUARIO.TELEFONO"],
				$noticia_wt_comentarios[0]["USUARIO.DIRECCION"],
				$noticia_wt_comentarios[0]["USUARIO.GENERO"],
				$noticia_wt_comentarios[0]["USUARIO.ROL"]);
				$comentarios_array = array();
				if ($noticia_wt_comentarios[0]["COMENTARIOS.ID_COMENTARIO"]!=null) {
					foreach ($noticia_wt_comentarios as $comentario){
						$comentario = new Comentario( $comentario["COMENTARIOS.ID_COMENTARIO"],
						$comentario["COMENTARIOS.FECHA"],
						$usuario,
						$comentario["COMENTARIOS.CUERPO_COMENTARIO"],
						
						
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
			$stmt = $this->db->prepare("INSERT INTO NOTICIA(FECHA,IMAGEN_RUTA,TITULO,CUERPO_NOTICIA) values (?,?,?,?)");
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
			$stmt = $this->db->prepare("UPDATE NOTICIA set FECHA=?, IMAGEN_RUTA=?, TITULO=?,CUERPO_NOTICIA=? where ID_NOTICIA=?");
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
	
	$stmt = $this->db->prepare("DELETE from COMENTARIOS WHERE NOTICIAID=?");
	$stmt->execute(array($noticia->getId()));
	$stmt = $this->db->prepare("DELETE from NOTICIA WHERE ID_NOTICIA=?");
	$stmt->execute(array($noticia->getId()));
}
	}
