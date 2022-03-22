<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$noticias = $view->getVariable("noticias");
$currentuser = $view->getVariable("currentusername");?>
 <style>
      .slider{
        background: url("images/sostenible2.jpg");
        height: 100vh;
        background-size: cover;
        background-position: center; 
      }
    </style>
<section class="container-fluid slider d-flex justify-content-center align-items-center">
    <h1 class="display-4">
    </h1>
  </section>
  
  <!-- fin imagen principal -->
 

  <!--  card -->
  <section class="container my-5 py-5">
  <h3 class="text-uppercase text-center mb-4">Bienvenidos a Grena </h3>
  <p class="lead text-center mb-5">Grena es una plataforma desde la cual buscamos fomentar la realización de actividades sostenibles mediante actividades que favorezcan esta conexión.</p>
  <hr class="lineasep">
  <h3 class="text-uppercase text-center mb-4 lastnews"><a class="sinsubr" href="index.php?controller=noticias&amp;action=showall&amp;pagina=0">Últimas noticias</a></h3>
  <div class="card-deck">
    <div class="card">
      <img class="card-img-top img-fluid" src="images/<?= $noticias[0]->getImagenruta() ?>" alt="Card image cap">
      <div class="card-block">
        <h4 class="card-title"><?= $noticias[0]->getTitulo() ?></h4>
        <p class="card-text"><?= $noticias[0]->getCuerponoticia() ?></p>
        
      </div>
      <a class="btn btn-primary link" href="#" role="button">Acceder</a>
    </div>
    <div class="card">
      <img class="card-img-top img-fluid" src="images/<?= $noticias[1]->getImagenruta() ?>" alt="Card image cap">
      <div class="card-block">
        <h4 class="card-title"><?= $noticias[1]->getTitulo() ?></h4>
        <p class="card-text"><?= $noticias[1]->getCuerponoticia() ?></p>
        
      </div>
      <a class="btn btn-primary link" href="#" role="button">Acceder</a>
    </div>
    <div class="card">
      <img class="card-img-top img-fluid" src="images/<?= $noticias[2]->getImagenruta()?>" alt="Card image cap">
      <div class="card-block">
        <h4 class="card-title"><?= $noticias[2]->getTitulo() ?> </h4>
        <p class="card-text"><?= $noticias[2]->getCuerponoticia() ?></p>
        
      </div>
      <a class="btn btn-primary link" href="#" role="button">Acceder</a>
    </div>
  </div>
  </section>
  <!-- fin Cards -->
  <!-- START THE FEATURETTES -->

      <div class="container my-5">
        <hr class="lineasep">
        
        <div class="row d-flex align-items-center my-5 py-5">
          <div class="col-md-7">
            <a class="sinsubr" href="#"><h2 class="display-3">Nuestros proyectos</h2></a>
            
          </div>
          <div class="col-md-5">
            <img class=" img-fluid mx-auto" src="images/cards1.png" alt="Generic placeholder image">
          </div>
        </div>
        
        <hr class="">
        
        <div class="row d-flex align-items-center my-5 py-5">
          <div class="col-md-7 push-md-5">
          <a class="sinsubr" href="#"><h2 class="display-3">La galería</h2></a>
          </div>
          <div class="col-md-5 pull-md-7">
            <img class=" img-fluid mx-auto" src="images/cards2.png" alt="Generic placeholder image">
          </div>
        </div>
        
        <hr class="">
        
        <div class="row d-flex align-items-center my-5 py-5">
          <div class="col-md-7">
          <a class="sinsubr" href="index.php?controller=videotutoriales&amp;action=showall&amp;pagina=0"><h2 class="display-3">Videotutoriales</h2></a>
          </div>
          <div class="col-md-5">
            <img class=" img-fluid mx-auto" src="images/cards3.png" alt="Generic placeholder image">
          </div>
        </div>
        
        
      </div>

      <!-- /END THE FEATURETTES -->

  
  
  
