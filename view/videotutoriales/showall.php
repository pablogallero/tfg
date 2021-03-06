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

<div class="modal fade" id="showImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <img class>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><?= i18n("Salir")?></button>
        <button type="submit" id="saveBtn" class="btn btn-warning"><?= i18n("Borrar")?></button>
      </div>

    </div>
  </div>
</div>

<section class="container my-5 py-5">
  <h3 class="text-uppercase text-center mb-4"><?= i18n("VIDEOTUTORIALES")?></h3>
  <p class="lead text-center mb-5"><?= i18n("Algunos vídeos en los que encontrarás útiles consejos.")?></p>
  
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
          <button type="button" class="btn btn-success btnreadmore" onclick="window.location.href='index.php?controller=videotutoriales&amp;action=showcurrent&amp;id=<?=$videotutoriales[$x+3*$pagina]->getId();?>'"><?= i18n("Leer más")?> >></button>
          <?php if( isset($_SESSION['rol']) && $_SESSION['rol']== "administrador"){ ?>
          <button type="button" class="btn btn-warning" onclick="window.location.href='index.php?controller=videotutoriales&amp;action=edit&amp;id=<?=$videotutoriales[$x+3*$pagina]->getId() ;?>'"><?= i18n("Modificar")?></button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteVideotutorial<?=$videotutoriales[$x+3*$pagina]->getId() ;?>"><?= i18n("Eliminar")?></button>
          </div>
          
        </div>
      
       
            
        <!-- MODAL ELIMINAR Videotutorial-->
<div class=" modal fade" id="modalDeleteVideotutorial<?=$videotutoriales[$x+3*$pagina]->getId() ;?>" tabindex="-1" role="dialog" aria-labelledby="titleModalDelete" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="col-9 px-0 mx-auto modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModalDelete"><?= i18n("Eliminar")?> videotutorial</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                  
                <div>
                    <div class="mx-auto px-0 cuerpoModal modal-body ">
                        <p class="p-5"><?= i18n("¿Estás seguro de querer borrar")?> "<?=$videotutoriales[$x+3*$pagina]->getTitulo() ;?>"?</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="window.location.href='index.php?controller=videotutoriales&action=delete&id=<?= $videotutoriales[$x+3*$pagina]->getId()?>'"><?= i18n("Eliminar")?></button>
                        <button type="button" class="btn btn-light " data-dismiss="modal"><?= i18n("Cerrar")?></button>
                        
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
      <a href="index.php?controller=videotutoriales&amp;action=showall&amp;pagina=<?=$paginaanterior?>"> <i class=" mt-1   material-icons ">arrow_back</i> </a>
      <?php }
      if($pagina<$numpaginas-1){
        $paginasiguiente=$pagina+1;
        ?>
      <a href="index.php?controller=videotutoriales&amp;action=showall&amp;pagina=<?=$paginasiguiente?>"> <i class=" mt-1   material-icons ">arrow_forward</i> </a>
      <?php } ?>



 
