<?php
//file: view/layouts/default.php

$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");

?><!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/moment.min.js"></script>
  <script type="text/javascript" src="js/fullcalendar.min.js"></script>
  <script>

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('CalendarioWeb');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth'
  });
  calendar.render();
});

</script>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Grena</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/style.css" type="text/css">
  <link rel="stylesheet" href="css/fullcalendar.min.css" type="text/css">
	<!-- enable ji18n() javascript function to translate inside your scripts -->
</head>
<body>
	<!-- header -->
	<header>
	
		 <!-- menú de navegación -->
		 <nav class="navbar navbar-inverse bg-inverse navbar-toggleable-sm sticky-top">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="index.html">
    
    </a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <div class="navbar-nav mr-auto ml-auto text-center">
      <div class="dropdown">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
          Inicio
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="index.php">Página principal</a>
          <a class="dropdown-item" href="#">Estructura</a>
          <a class="dropdown-item" href="#">Contacto</a>
        </div>
      </div>
      <div class="dropdown">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
          Contenidos
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Proyectos</a>
          <a class="dropdown-item" href="index.php?controller=calendario&amp;action=showall">Calendario</a>
          <a class="dropdown-item" href="index.php?controller=videotutoriales&amp;action=showall&amp;pagina=0">Videotutoriales</a>
        </div>
      </div>
      <div class="dropdown">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
          Comunidad
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="index.php?controller=noticias&amp;action=showall&amp;pagina=0">Noticias</a>
          <a class="dropdown-item" href="#">Redes</a>
        </div>
      </div>
      <a class="btn nav-item nav-link" href="index.php?controller=galeria&amp;action=showall&amp;pagina=0">Galería</a>
      <a class="btn nav-item nav-link" href="#">¿Cómo colaborar?</a>
     
      
    </div>
    <div class="d-flex flex-row justify-content-center">
      <a href="#" class="btn btn-outline-primary mr-2">F</a>
      <a href="#" class="btn btn-outline-danger">Y</a>
    </div>
    </div>
  </nav>
  <!-- fin menú de navegación -->
	</header>

	<main>
		<div id="flash">
			<?= $view->popFlash() ?>
		</div>

		<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
	</main>

	
	<footer class="container-fluid bg-inverse">
    <div class="row text-white py-4 text-white">
      <div class="col-md-3">
        <img src="images/bootstrap-solid.svg" alt="" width="50px" height="auto" class="float-left mr-3">
        <h4 class="lead">Bootstrap 4!</h4>
        <footer class="blockquote-footer">Curso gratis por <cite title="Source Title">Bluuweb</cite></footer>
      </div>
      <div class="col-md-3">
        <h4 class="lead">Lorem ipsum</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, fugit?</p>
      </div>
      <div class="col-md-3">
        <h4 class="lead">Lorem ipsum</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum, quidem!</p>
      </div>
      <div class="col-md-3">
        <h4 class="lead">Síguenos</h4>
        <a href="#"><span class="badge badge-primary">Facebook</span></a>
        <a href="#"><span class="badge badge-danger">Youtube</span></a>
      </div>
    </div>
  
		<?php
		include(__DIR__."/language_select_element.php");
		?>
	</footer>

</body>
</html>
