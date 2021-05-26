<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$noticias = $view->getVariable("noticiasall");
$numpaginas= intval(count($noticias)/3);
if(count($noticias)%3 != 0){
$numpaginas=$numpaginas+1;
}
$pagina=$_GET["pagina"];
$x=0;
 ?>



<section class="container my-5 py-5">
  <h3 class="text-uppercase text-center mb-4">NOTICIAS</h3>
  <p class="lead text-center mb-5">Aquí encontrarás las noticias relacionadas con la organización.</p>
  </section>
  <!-- fin Cards -->
  <!-- START THE FEATURETTES -->
  <?php while($x<=2 && isset($noticias[$x+3*$pagina])){?>
      <div class="container my-5">
        <hr class="">
        
        <div class="row d-flex align-items-center my-5 py-5">
          <div class="col-md-7">
            <h2 class="display-3"><?= $noticias[$x+3*$pagina]->getTitulo() ?></h2>
            <p class="lead"><?= $noticias[$x+3*$pagina]->getCuerponoticia() ?></p>
          </div>
          <div class="col-md-5
        ">
            <img class=" img-fluid mx-auto" src="images/<?= $noticias[$x+3*$pagina]->getImagenruta() ?>" alt="Generic placeholder image">
          </div>
        </div>
        
      </div>
      <?php $x=$x+1; } 
      if($pagina!=0){
        $paginaanterior=$pagina-1;  
       ?>
      <a href="index.php?controller=noticias&amp;action=showall&amp;pagina=<?=$paginaanterior?>"> Página anterior </a>
      <?php }
      if($pagina<$numpaginas-1){
        $paginasiguiente=$pagina+1;
        ?>
      <a href="index.php?controller=noticias&amp;action=showall&amp;pagina=<?=$paginasiguiente?>"> Siguiente página </a>
      <?php } ?>


