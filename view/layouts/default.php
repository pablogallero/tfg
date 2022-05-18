<?php
//file: view/layouts/default.php

$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");

?><!DOCTYPE html> 
<html>
<head>
<meta charset="UTF-8">
<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-client_id" content="196768996394-8bg1mv223238sqjbl655msrp91m81kpt.apps.googleusercontent.com">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/tinymce.min.js"></script>


 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

  
 
  <script type="text/javascript" src="js/moment.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />

  

   

    </script>
    
    
	
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Grena</title>

  
	<!-- enable ji18n() javascript function to translate inside your scripts -->
</head>
<body>
	<!-- header -->
	<header>
	
		 <!-- menú de navegación -->
		 <nav class="navbar navbar-inverse bg-inverse navbar-toggleable-sm sticky-top barraminheight " >
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="index.html">
    
    </a>
    
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a href="#" class="btn btn-outline-primary mr-2">EN</a>
      <a href="#" class="btn btn-outline-danger mr-2">ES</a>
    <div class="navbar-nav mr-auto ml-auto text-center">
      <div class="dropdown">
        <button type="button" class="btn btn-primary mr-4" data-toggle="dropdown">
          Inicio
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="index.php">Página principal</a>
          <a class="dropdown-item" href="index.php?controller=contactos&amp;action=showall">Estructura</a>
          <a class="dropdown-item" href="index.php?controller=contactos&amp;action=contacto">Contacto</a>
        </div>
      </div>
      <div class="dropdown">
        <button type="button" class="btn btn-primary mr-4" data-toggle="dropdown">
          Contenidos
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="index.php?controller=proyectos&amp;action=showall">Proyectos</a>
          <a class="dropdown-item" href="index.php?controller=calendario&amp;action=showall">Calendario</a>
          
        </div>
      </div>
      <div class="dropdown">
        <button type="button" class="btn btn-primary mr-4 " data-toggle="dropdown">
          Comunidad
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="index.php?controller=noticias&amp;action=showall&amp;pagina=0">Noticias</a>
          <a class="dropdown-item" href="index.php?controller=videotutoriales&amp;action=showall&amp;pagina=0">Videotutoriales</a>
        </div>
      </div>
      <a class="btn nav-item nav-link mr-4" href="index.php?controller=galeria&amp;action=showall&amp;pagina=0">Galería</a>
      <a class="btn nav-item nav-link" href="index.php?controller=comocolaborar&amp;action=showall">¿Cómo colaborar?</a>
      <?php if(isset($_SESSION["rol"]) && $_SESSION["rol"]=="administrador"){ ?> 
        <a class="btn nav-item nav-link" href="index.php?controller=users&amp;action=showall">Gestionar usuarios</a> <?php } ?>
      
    </div>
    <div class="d-flex flex-row justify-content-center mr-3">
      

      <?php if(!isset($_SESSION["currentuser"])) {?>
      <a href="index.php?controller=users&amp;action=login"><i class="ml-2 mt-1  material-icons signup">exit_to_app</i> </a>
      <?php }
      else { ?>
     <div class="dropdown">
        
        <i class="ml-2 mt-1  material-icons signup  btn-primary " data-toggle="dropdown">account_box</i> 
        
        <div class=" dropdown-menu-izq ">
          <a class="dropdown-item" href="#">Info</a>
          <a class="dropdown-item material-icons" href="index.php" onclick="<?php //session_destroy();?>">settings_power</a>
        </div>
      </div>
      <?php } ?>
    </div>
    </div>
  </nav>
  <!-- fin menú de navegación -->
	</header>

	<main>
    
		<div id="flash">
			<?= $view->popFlash()?>
		</div>
    <div id="flashf">
			<?= $view->popFlashF()?>
		</div>

		<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
	</main>

	
	<footer class="container-fluid bg-inverse">
    <div class="row text-white py-4 text-white">
      <div class="col-md-3">
        <img src="images/bootstrap-solid.svg" alt="" width="50px" height="auto" class="float-left mr-3">
        <h4 class="lead">Grena</h4>
        
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
