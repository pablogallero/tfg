<?php

require_once(__DIR__."/../model/Noticia.php");
require_once(__DIR__."/../model/NoticiaMapper.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Patrocinador.php");
require_once(__DIR__."/../model/PatrocinadorMapper.php");
require_once(__DIR__."/../model/Categoria.php");
require_once(__DIR__."/../model/CategoriaMapper.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");


class NoticiasController extends BaseController {

	/**

	* @var noticiaMapper
	* @var patrocinadorMapper
	* @var categoriaMapper
	*/
	private $noticiaMapper;
	private $patrocinadorMapper;
	private $categoriaMapper;

	public function __construct() {
		parent::__construct();
		$this->patrocinadorMapper = new PatrocinadorMapper();
		$this->noticiaMapper = new NoticiaMapper();
		$this->categoriaMapper = new CategoriaMapper();
	}


	public function index() {
		$noticiastres=array();
		$y=0;
		$num=0;

		$noticias = $this->noticiaMapper->findAll();

		
		$categorias = $this->categoriaMapper->findAll();
		
		while($num < count($categorias)){
			
			$patrocinadores[$num]= $this->patrocinadorMapper->findCategoriaPatrocinador($categorias[$num]->getId());
			
			$num=$num+1;

		}
		
		$noticiasr=array_reverse($noticias);
		for($x=0;$x<=2;$x=$x+1){
			$noticiastres[$y]=$noticiasr[$x];
			$y=$y+1;
		}
		
		$this->view->setVariable("noticias", $noticiastres);
		$this->view->setVariable("patrocinadores", $patrocinadores);
		$this->view->setVariable("categorias", $categorias);
	
		$this->view->render("noticias", "index");
	}

	
	public function showAll() {
		
	
		$noticias = $this->noticiaMapper->findAll();
	
		
		$noticiasr=array_reverse($noticias);
		$this->view->setVariable("noticiasall", $noticiasr);
		
	
		$this->view->render("noticias", "showall");
	}
	
	public function view(){
		try{
			
			if (!isset($_GET["id"])) {
				$this->view->setFlashF(i18n("Se necesita una id"));
							throw new Exception();
			}
		$noticiaid = $_GET["id"];

	
		$noticia = $this->noticiaMapper->findByIdWithComments($noticiaid);
		if ($noticia == NULL) {
			$this->view->setFlashF(i18n("No se encuentra la noticia"));
						throw new Exception();
		}

	
		$this->view->setVariable("noticia", $noticia);

	
		$comentario = $this->view->getVariable("comentario");
		$this->view->setVariable("comentario", ($comentario==NULL)?new Comentario():$comentario);

	
		$this->view->render("noticias", "view");
	}catch(Exception $ex) {
		$this->view->popFlashF();
header("Location: index.php?controller=noticias&action=showall&pagina=0");
	}
	}

	
	
	public function add() {
		try{
			if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
				$this->view->setFlashF(i18n("No se puede editar sin ser administrador"));
						throw new Exception();
				
			}
	
		$noticia = new Noticia();

		if (isset($_POST["titulo"]) && isset($_POST["cuerponoticia"]) && isset($_FILES["imagenruta"]["name"])) { 
			
			$name=$_FILES['imagenruta']['name'];
			
			$tmp_name=$_FILES['imagenruta']['tmp_name'];
			$upload_folder="images/";

			$movefile=move_uploaded_file($tmp_name,$upload_folder.$name);
			
			$noticia->setTitulo($_POST["titulo"]);
			$noticia->setCuerponoticia($_POST["cuerponoticia"]);
			$noticia->setImagenruta($_FILES["imagenruta"]["name"]);
			
				

			try {
				if(strlen($noticia->getTitulo())<1   ){
					$this->view->setFlashF(i18n("Titulo demasiado corto"));
					throw new Exception();
				}
				if( strlen($noticia->getCuerponoticia()) < 1  ){
					$this->view->setFlashF(i18n("Cuerpo de noticia no encontrado"));
					throw new Exception();
					
				}
				if( strlen($noticia->getImagenruta()) < 1  ){
					$this->view->setFlashF(i18n("Tamaño incorrecto de imagen"));
					throw new Exception();
					
				}

				
				$this->noticiaMapper->save($noticia);

				
				$this->view->setFlash(sprintf(i18n("La noticia \"%s\" se agregó correctamente."),$noticia->getTitulo()));

				
				header("Location: index.php?controller=noticias&action=showall&pagina=0");
				
				

			} catch(Exception $ex) {
				$this->view->popFlashF();
header("Location: index.php?controller=noticias&action=add");
			}
		}

		
		$this->view->setVariable("noticia", $noticia);

		
		$this->view->render("noticias", "add");

	}catch(Exception $ex) {
		$this->view->popFlashF();
header("Location: index.php?controller=noticias&action=showall&pagina=0");
	}

	}

	
	public function edit() {
		try{
			if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
				$this->view->setFlashF(i18n("No se puede añadir sin ser administrador"));
						throw new Exception();
				
			}
		if (!isset($_GET["id"])) {
			$this->view->setFlashF(i18n("Se necesita una id"));
						throw new Exception();
		}

		
		$noticiaid = $_GET["id"];
		$noticia = $this->noticiaMapper->findById($noticiaid);

		// Existe la noticia?
		if ($noticia == NULL) {
			$this->view->setFlashF(i18n("No se puede encuentrar la noticia"));
						throw new Exception();
		}

		if (isset($_POST["titulo"]) && isset($_POST["cuerponoticia"]) && isset($_FILES["imagenruta"]["name"])) { 
			if($_FILES['imagenruta']['name']!=""){
			$name=$_FILES['imagenruta']['name'];
			
			$tmp_name=$_FILES['imagenruta']['tmp_name'];
			$upload_folder="images/";

			$movefile=move_uploaded_file($tmp_name,$upload_folder.$name);
			$noticia->setImagenruta($_FILES["imagenruta"]["name"]);
			}
			
			$noticia->setTitulo($_POST["titulo"]);
			$noticia->setCuerponoticia($_POST["cuerponoticia"]);
			

			try {
				
				if(strlen($noticia->getTitulo())<5   ){
					$this->view->setFlashF(i18n("Titulo demasiado corto"));
					throw new Exception();
				}
				if( strlen($noticia->getCuerponoticia()) < 1  ){
					$this->view->setFlashF(i18n("Cuerpo de noticia no encontrado"));
					throw new Exception();
					
				}
				if( strlen($noticia->getImagenruta()) < 1  ){
					$this->view->setFlashF(i18n("Tamaño incorrecto de imagen"));
					throw new Exception();
					
				}


				
				$this->noticiaMapper->update($noticia);

				
				$this->view->setFlash(sprintf(i18n("La noticia \"%s\" se modificó correctamente."),$noticia ->getTitulo()));

				
				header(sprintf("Location: index.php?controller=noticias&action=view&id=%s",$noticia ->getId()));

			}catch(Exception $ex) {
				$this->view->popFlashF();
		header("Location: index.php?controller=noticias&action=edit&id=$noticiaid");
			}
		
		}

		
		$this->view->setVariable("noticia", $noticia);

		
		$this->view->render("noticias", "edit");

	}catch(Exception $ex) {
		$this->view->popFlashF();
header("Location: index.php?controller=noticias&action=showall&pagina=0");
	}

	}

	
	public function delete() {
		try{
			if (!(isset($_SESSION['rol'])&& $_SESSION['rol']=="administrador")) {
				$this->view->setFlashF(i18n("No se puede añadir sin ser administrador"));
						throw new Exception();
				
			}
		if (!isset($_GET["id"])) {
			$this->view->setFlashF(i18n("Se necesita una id"));
						throw new Exception();
		}
		
		
		$noticiaid = $_GET["id"];
		$noticia = $this->noticiaMapper->findById($noticiaid);

		// Existe la noticia?
		if ($noticia == NULL) {
			$this->view->setFlashF(i18n("No se puede encuentrar la noticia"));
						throw new Exception();
		}
		
		
		$this->noticiaMapper->delete($noticia);

		
		$this->view->setFlash(sprintf(i18n("La noticia \"%s\" se borró correctamente."),$noticia->getTitulo()));

		
		header("Location: index.php?controller=noticias&action=showall&pagina=0");
	}catch(Exception $ex) {
		$this->view->popFlashF();
	header("Location: index.php?controller=noticias&action=showall&pagina=0");
	}
	}


}
