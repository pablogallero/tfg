<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$videotutorial = $view->getVariable("videotutorial");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Mostrar videotutorial");
$fecha=date_parse($videotutorial->getFecha());
$fechavideo=$fecha["day"]."/".$fecha["month"]."/".$fecha["year"];
?>
<div class="container my-5 w-75">
<h1 class="display-3 titulovideos"><?= $videotutorial->getTitulo() ?></h1> </a>
<div class="row d-flex  align-items-center my-5 py-5 ">
    
          <div class="col-md-6">
           
            <div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<?= $videotutorial->getEnlace() ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  
</div>
          </div>
          <div class="col-md-6">
          <p class="lead textovideos"><?= nl2br($videotutorial->getDescripcion()) ?></p>
          <p class="lead textovideos"><?= $fechavideo ?></p>
          <?php if( isset($_SESSION['rol']) && $_SESSION['rol']== "administrador"){ ?>
            <button type="button" class="btn btn-warning" onclick="window.location.href='index.php?controller=videotutoriales&amp;action=edit&amp;id=<?=$videotutorial->getId() ;?>'"><?= i18n("Modificar")?></button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteVideotutorial<?=$videotutorial->getId() ;?>"><?= i18n("Eliminar")?></button>
          </div>

         
            
        <!-- MODAL ELIMINAR Videotutorial-->
<div class=" modal fade" id="modalDeleteVideotutorial<?=$videotutorial->getId() ;?>" tabindex="-1" role="dialog" aria-labelledby="titleModalDelete" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="col-9 px-0 mx-auto modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModalDelete"><?= i18n("Eliminar")?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                  
                <div>
                    <div class="mx-auto px-0 cuerpoModal modal-body ">
                        <p><?= i18n("¿Estás seguro de querer borrar")?> "<?=$videotutorial->getTitulo() ;?>"?</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger mt-3" onclick="window.location.href='index.php?controller=videotutoriales&action=delete&id=<?= $videotutorial->getId()?>'"><?= i18n("Eliminar")?></button>
                        <button type="button" class="btn btn-light " data-dismiss="modal"><?= i18n("Cerrar")?></button>
                        
                    </div>
                </div>

            </div>
        </div>
</div>
</div>
        <?php } ?>
          
        </div>
        
       
