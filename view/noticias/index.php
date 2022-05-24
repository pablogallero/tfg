<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$y=0;
$z=0;
$noticias = $view->getVariable("noticias");
$patrocinadores = $view->getVariable("patrocinadores");
$categorias = $view->getVariable("categorias");
$currentuser = $view->getVariable("currentusername");
?>
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
  
  <h3 class="text-uppercase text-center mb-4"><?= i18n("BIENVENIDOS A GRENA")?> </h3>
 
  <p class="lead text-center mb-5"><?= i18n("Grena es una plataforma desde la cual buscamos fomentar la realización de actividades sostenibles mediante actividades que favorezcan esta conexión.")?></p>
  <hr class="lineasep">
  <h3 class="text-uppercase text-center mb-4 lastnews"><a class="sinsubr" href="index.php?controller=noticias&amp;action=showall&amp;pagina=0"><?= i18n("ÚLTIMAS NOTICIAS")?></a></h3>
  <div class="card-deck">
    <div class="card">
      <img class="card-img-top img-fluid" src="images/<?= $noticias[0]->getImagenruta() ?>" alt="Card image cap">
      <div class="card-block">
        <h4 class="card-title textoverflowl"><?= $noticias[0]->getTitulo() ?></h4>
        <p class="card-text textoverflowl"><?= $noticias[0]->getCuerponoticia() ?></p>
        
      </div>
      <a class="btn btn-primary link" href="index.php?controller=noticias&amp;action=view&amp;id=<?= $noticias[0]->getId() ?>" role="button"><?= i18n("Acceder")?></a>
    </div>
    <div class="card">
      <img class="card-img-top img-fluid" src="images/<?= $noticias[1]->getImagenruta() ?>" alt="Card image cap">
      <div class="card-block">
        <h4 class="card-title textoverflowl"><?= $noticias[1]->getTitulo() ?></h4>
        <p class="card-text textoverflowl"><?= $noticias[1]->getCuerponoticia() ?></p>
        
      </div>
      <a class="btn btn-primary link" href="index.php?controller=noticias&amp;action=view&amp;id=<?= $noticias[1]->getId() ?>" role="button"><?= i18n("Acceder")?></a>
    </div>
    <div class="card">
      <img class="card-img-top img-fluid" src="images/<?= $noticias[2]->getImagenruta()?>" alt="Card image cap">
      <div class="card-block">
        <h4 class="card-title textoverflowl "><?= $noticias[2]->getTitulo() ?> </h4>
        <p class="card-text textoverflowl"><?= $noticias[2]->getCuerponoticia() ?></p>
        
      </div>
      <a class="btn btn-primary link" href="index.php?controller=noticias&amp;action=view&amp;id=<?= $noticias[2]->getId() ?>" role="button"><?= i18n("Acceder")?></a>
    </div>
  </div>
  </section>
  <!-- fin Cards -->
  <!-- START THE FEATURETTES -->

      <div class="container my-5">
        <hr class="lineasep">
        
        <div class="row d-flex align-items-center my-5 py-5">
          <div class="col-md-7">
            <a class="sinsubr linknegro" href="index.php?controller=proyectos&amp;action=showall" ><h2 class="display-3"><?= i18n("Nuestros proyectos")?></h2></a>
            
          </div>
          <div class="col-md-5">
            <img class=" img-fluid mx-auto" src="images/cards1.png" alt="Generic placeholder image">
          </div>
        </div>
        
        <hr class="">
        
        <div class="row d-flex align-items-center my-5 py-5">
          <div class="col-md-7 push-md-5">
          <a class="sinsubr linknegro" href="index.php?controller=galeria&action=showall&pagina=0"><h2 class="display-3"><?= i18n("La galería")?></h2></a>
          </div>
          <div class="col-md-5 pull-md-7">
            <img class=" img-fluid mx-auto" src="images/galeria.webp" alt="Generic placeholder image">
          </div>
        </div>
        
        <hr class="">
        
        <div class="row d-flex align-items-center my-5 py-5">
          <div class="col-md-7">
          <a class="sinsubr linknegro" href="index.php?controller=videotutoriales&amp;action=showall&amp;pagina=0"><h2 class="display-3"><?= i18n("Videotutoriales")?></h2></a>
          </div>
          <div class="col-md-5">
            <img class=" img-fluid mx-auto" src="images/videotutorialesagricolas.jpg" alt="Generic placeholder image">
          </div>
        </div>
        <hr class="">

        <div class="row d-flex align-items-center my-5 py-5 mb-5">
        <?php while($y < count($patrocinadores)) {
        $z=0;?>
        <div class="card-block">
          <h2 class="display-3 mb-4" style="color:<?= $categorias[$y]->getColor() ?>"><?= i18n("Patrocinadores")?> <?= $categorias[$y]->getNombre() ?></h2>
        
          <?php 
          
          while($z < count($patrocinadores[$y])) {?>
            <img  width="200" height="200" class="rounded-circle shadow mb-3 ml-2" src="images/<?= $patrocinadores[$y][$z]->getImagen(); ?>" alt="Generic placeholder image">
            <?php $z=$z+1; } $y=$y+1; } ?>
        </div>
        </div>
        <hr class="">
        
        
      </div>
      

      <!-- /END THE FEATURETTES -->

  
  
  
