<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Proyecto.php");



class ProyectoMapper {

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
		$stmt = $this->db->query("SELECT * FROM PROYECTO");
		$proyecto_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$proyectos = array();
		
		foreach ($proyecto_db as $proyecto) {
			array_push($proyectos, new Proyecto($proyecto["ID_PROYECTO"],$proyecto["IMAGEN"], $proyecto["INTRODUCCION"],$proyecto["OBJETIVOS"],$proyecto["TITULO"],$proyecto["METODOLOGIA"],$proyecto["CONCLUSIONES"]));
		}

		return $proyectos;
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
	public function findById($proyectoid){
		$stmt = $this->db->prepare("SELECT * FROM PROYECTO WHERE ID_PROYECTO=?");
		$stmt->execute(array($proyectoid));
		$proyecto = $stmt->fetch(PDO::FETCH_ASSOC);

		if($proyecto != null) {
			return new Proyecto(
				$proyecto["ID_PROYECTO"],$proyecto["IMAGEN"], $proyecto["INTRODUCCION"],$proyecto["OBJETIVOS"],$proyecto["TITULO"],$proyecto["METODOLOGIA"],$proyecto["CONCLUSIONES"]);
		} else {
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
	
		/**
		* Updates a Post in the database
		*
		* @param Post $post The post to be updated
		* @throws PDOException if a database error occurs
		* @return void
		*/
	public function update(Proyecto $proyecto) {
			$stmt = $this->db->prepare("UPDATE PROYECTO set IMAGEN=?, TITULO=?, INTRODUCCION=?,OBJETIVOS=?,METODOLOGIA=?,CONCLUSIONES=? where ID_PROYECTO=?");
			$stmt->execute(array($proyecto->getImagen(),$proyecto->getTitulo(),$proyecto->getIntroduccion(),$proyecto->getObjetivos(),$proyecto->getMetodologia(),$proyecto->getConclusiones(),$proyecto->getId()));
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
public function delete(Proyecto $proyecto) {
	$stmt = $this->db->prepare("DELETE from PROYECTO WHERE ID_PROYECTO=?");
	$stmt->execute(array($proyecto->getId()));
	
}

public function save(Proyecto $proyecto) {
	$stmt = $this->db->prepare("INSERT INTO PROYECTO(IMAGEN,TITULO,INTRODUCCION,OBJETIVOS,METODOLOGIA,CONCLUSIONES) values (?,?,?,?,?,?)");
	$stmt->execute(array($proyecto->getImagen(),$proyecto->getTitulo(),$proyecto->getIntroduccion(),$proyecto->getObjetivos(),$proyecto->getMetodologia(),$proyecto->getConclusiones()));

}
	}
