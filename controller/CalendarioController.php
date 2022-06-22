<?php



require_once(__DIR__."/../model/Calendario.php");
require_once(__DIR__."/../model/CalendarioMapper.php");
require_once(__DIR__."/../model/User.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
* Class CalendarioController
*
* Controller para manejar los eventos

*/
class CalendarioController extends BaseController {

	/**
	* 
	*
	* @var calendarioMapper
	*/
	private $calendarioMapper;

	public function __construct() {
		parent::__construct();

		$this->calendarioMapper = new CalendarioMapper();
	}


	
	public function showAll() {
		
		
		$calendario = $this->calendarioMapper->findAll();
		
		
		$events=array();
		foreach ($calendario as $calendar ) {
			$events[]=[
				'id' => $calendar->getId(),
				'title' => $calendar->getTitulo(),
				'start' => $calendar->getInicio(),
				'end' => $calendar->getFin(),
				'color' => $calendar->getColor(),

			];
		}
		$this->view->setVariable("events", $events);
		
		
		$this->view->render("calendario", "showall");
	}
	

	public function add() {
		try{
			if (!isset($_SESSION['rol']) || $_SESSION['rol']!="administrador"){
				$this->view->setFlashF(i18n("Añadir eventos requiere ser administrador del sistema"));
				throw new Exception();
			}

		$evento= new Calendario();
		if (!isset($_POST["title"])) {
			$this->view->setFlashF(i18n("No se encuentra el título"));
			throw new Exception();
		}
		
		if (isset($_POST['title'])) { 
			$evento->setTitulo($_POST['title']);
			$evento->setColor($_POST['color']);
			$evento->setInicio($_POST['start_date']." ".$_POST['start_hour']);
			$evento->setFin($_POST['end_date']." ".$_POST['end_hour']);

			
			

			try {
				
				if(strlen($evento->getTitulo())<1   ){
					$this->view->setFlashF(i18n("Formato incorrecto del título"));
					throw new Exception();
				}
				if( $evento->getColor() == NULL  ){
					$this->view->setFlashF(i18n("Color vacío"));
					throw new Exception();
					
				}
				if( $evento->getInicio() == NULL  ){
					$this->view->setFlashF(i18n("La fecha de inicio es incorrecta"));
					throw new Exception();
					
				}
				if( $evento->getFin() == NULL  ){
					$this->view->setFlashF(i18n("La fecha de finalización es incorrecta"));
					throw new Exception();
					
				}
				if($evento->getInicio() >= $evento->getFin()){
					$this->view->setFlashF(i18n("La fecha de inicio no puede ser mayor que la fecha de finalización"));
					throw new Exception();
				}
				
				$this->calendarioMapper->save($evento);

				
				$this->view->setFlash("La inserción se realizó correctamente");

			
				$this->view->redirect("calendario", "showall");

			}catch(Exception $ex) {
				// Exception
				$this->view->popFlashF();
				header("Location: index.php?controller=calendario&action=showall");
			}
		}}

		catch(Exception $ex){
			$this->view->popFlashF();
			header("Location: index.php?controller=calendario&action=showall");
		}

	}


	public function edit() {
		try{
			if (!isset($_SESSION['rol']) || $_SESSION['rol']!="administrador"){
				$this->view->setFlashF(i18n("Modificar eventos requiere ser administrador del sistema"));
				throw new Exception();
			}
	
			
		
		$eventoid = $_POST["ided"];
		if (!isset($_POST["ided"])) {
			$this->view->setFlashF(i18n("No se encuentra la id"));
			throw new Exception();
		}
		$evento = $this->calendarioMapper->findById($eventoid);

		// Existe el evento?
		if ($evento == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el evento"));
			throw new Exception();
		}

	

		if (isset($_POST["titleed"])) { 

			$evento->setTitulo($_POST['titleed']);
			$evento->setColor($_POST['colored']);
			$evento->setInicio($_POST['start_dateed']." ".$_POST['start_houred']);
			$evento->setFin($_POST['end_dateed']." ".$_POST['end_houred']);
			if(strlen($evento->getTitulo())<1   ){
				$this->view->setFlashF(i18n("Formato incorrecto del título"));
				throw new Exception();
			}
			if( $evento->getColor() == NULL  ){
				$this->view->setFlashF(i18n("Color vacío"));
				throw new Exception();
				
			}
			if( $evento->getInicio() == NULL  ){
				$this->view->setFlashF(i18n("La fecha de inicio es incorrecta"));
				throw new Exception();
				
			}
			if( $evento->getFin() == NULL  ){
				$this->view->setFlashF(i18n("La fecha de finalización es incorrecta"));
				throw new Exception();
				
			}
			if($evento->getInicio() >= $evento->getFin()){
				$this->view->setFlashF(i18n("La fecha de inicio no puede ser mayor que la fecha de finalización"));
				throw new Exception();
			}
			
			
			try {
				

				
				$this->calendarioMapper->update($evento);

				
				$this->view->setFlash("Evento editado correctamente");

				

			}catch(Exception $ex) {
				
				$this->view->popFlashF();
				header("Location: index.php?controller=calendario&action=showall");
			}
		}
		$this->view->redirect("calendario", "showall");}

		catch(Exception $ex){
			$this->view->popFlashF();
			header("Location: index.php?controller=calendario&action=showall");
		}
	
	}

	public function delete() {
		try{
			if (!isset($_SESSION['rol']) || $_SESSION['rol']!="administrador"){
				$this->view->setFlashF(i18n("Eliminar eventos requiere ser administrador del sistema"));
				throw new Exception();
			}
			if (!isset($_GET["id"])) {
				$this->view->setFlashF(i18n("No se encuentra la id"));
				throw new Exception();
			}
		
		
		
		$eventoid = $_GET["id"];
		$evento = $this->calendarioMapper->findById($eventoid);

		// Existe el evento?	
		if ($evento == NULL) {
			$this->view->setFlashF(i18n("No se encuentra el evento"));
			throw new Exception();
		}

		// Delete the Post object from the database
		$this->calendarioMapper->delete($evento);

	
		$this->view->setFlash("Evento eliminado correctamente");

		
		$this->view->redirect("calendario", "showall");
	}

	catch(Exception $ex){
		$this->view->popFlashF();
		header("Location: index.php?controller=calendario&action=showall");
	}

	}
}
