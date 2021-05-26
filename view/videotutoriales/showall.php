<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$videotutoriales = $view->getVariable("videotutoriales");
$numpaginas= intval(count($videotutoriales)/3);
if(count($videotutoriales)%3 != 0){
$numpaginas=$numpaginas+1;
}
$pagina=$_GET["pagina"];
$x=0;
 ?>



<section class="container my-5 py-5">
  <h3 class="text-uppercase text-center mb-4">Videotutoriales</h3>
  <p class="lead text-center mb-5">Algunos vídeos en los que encontrarás útiles consejos.</p>
  </section>
  <!-- fin Cards -->
  <!-- START THE FEATURETTES -->
  <?php while($x<=2 && isset($videotutoriales[$x+3*$pagina])){?>
      <div class="container my-5">
        <hr class="">
        
        <div class="row d-flex align-items-center my-5 py-5">
          <div class="col-md-7">
            <h2 class="display-3 titulovideos"><?= $videotutoriales[$x+3*$pagina]->getTitulo() ?></h2>
            <div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<?= $videotutoriales[$x+3*$pagina]->getEnlace() ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"" allowfullscreen></iframe>
</div>
          </div>
          <div class="col-md-5">
          <p class="lead textovideos"><?= $videotutoriales[$x+3*$pagina]->getDescripcion() ?></p>
          </div>
        </div>
        
      </div>
      
      <?php $x=$x+1; } 
      if($pagina!=0){
        $paginaanterior=$pagina-1;  
       ?>
      <a href="index.php?controller=videotutoriales&amp;action=showall&amp;pagina=<?=$paginaanterior?>"> Página anterior </a>
      <?php }
      if($pagina<$numpaginas-1){
        $paginasiguiente=$pagina+1;
        ?>
      <a href="index.php?controller=videotutoriales&amp;action=showall&amp;pagina=<?=$paginasiguiente?>"> Siguiente página </a>
      <?php } ?>


