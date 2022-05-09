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
  
  <?php if( isset($_SESSION['rol']) && $_SESSION['rol']== "administrador"){ ?>
          <div class ="algright">
      <a  href="index.php?controller=videotutoriales&amp;action=add"><i class="ml-2 mt-1 black  material-icons signup">add_circle</i> </a> </div><?php } ?>
      <hr class="">
  </section>
  <div class="container my-5">
  <!-- fin Cards -->
  <!-- START THE FEATURETTES -->
  <?php while($x<=2 && isset($videotutoriales[$x+3*$pagina])){?>
      <div class="container my-5">
      
        
        <div class="row d-flex align-items-center my-5 py-5">
          <div class="col-md-7">
          <a class="linknegro" href="index.php?controller=videotutoriales&amp;action=showcurrent&amp;id=<?=$videotutoriales[$x+3*$pagina]->getId();?>"><h2 class="display-3 titulovideos"><?= $videotutoriales[$x+3*$pagina]->getTitulo() ?></h2> </a> 
            <div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<?= $videotutoriales[$x+3*$pagina]->getEnlace() ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>
          </div>
          <div class="col-md-5">
          <p class="lead textovideos textoverflowdesc mb-5"><?= $videotutoriales[$x+3*$pagina]->getDescripcion() ?></p>
          <button type="button" class="btn btn-success btnreadmore" onclick="window.location.href='index.php?controller=videotutoriales&amp;action=showcurrent&amp;id=<?=$videotutoriales[$x+3*$pagina]->getId();?>'">Leer más >></button>
          <?php if( isset($_SESSION['rol']) && $_SESSION['rol']== "administrador"){ ?>
          <button type="button" class="btn btn-warning" onclick="window.location.href='index.php?controller=videotutoriales&amp;action=edit&amp;id=<?=$videotutoriales[$x+3*$pagina]->getId() ;?>'">Modificar videotutorial</button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteVideotutorial<?=$videotutoriales[$x+3*$pagina]->getId() ;?>">Eliminar videotutorial</button>
          </div>
          
        </div>
      
       
            
        <!-- MODAL ELIMINAR Videotutorial-->
<div class=" modal fade" id="modalDeleteVideotutorial<?=$videotutoriales[$x+3*$pagina]->getId() ;?>" tabindex="-1" role="dialog" aria-labelledby="titleModalDelete" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="col-9 px-0 mx-auto modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModalDelete">Eliminar videotutorial</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                  
                <div>
                    <div class="mx-auto px-0 cuerpoModal modal-body ">
                        <p class="p-5">¿Estás seguro de querer borrar "<?=$videotutoriales[$x+3*$pagina]->getTitulo() ;?>"?</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="window.location.href='index.php?controller=videotutoriales&action=delete&id=<?= $videotutoriales[$x+3*$pagina]->getId()?>'">Eliminar</button>
                        <button type="button" class="btn btn-light " data-dismiss="modal">Cerrar</button>
                        
                    </div>
                </div>
              
            </div>
        </div>
        <?php } ?> 
          </div>
          </div>
          <hr class="">
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



 
