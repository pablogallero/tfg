<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


$errors = $view->getVariable("errors");
$contenido= $view->getVariable("comocolaborar");


?>
<div class="container my-5 w-75 ">
<h1 class="display-3 titulovideos "><?= $contenido[0]->getTitulo() ?></h1>
<div class="row d-flex  align-items-center  ">

          
          <div class="col-md-12  align-items-center mt-5">
          <p class="lead textovideos"><?=nl2br( $contenido[0]->getDescripcion()) ?></p>
          <?php if( isset($_SESSION['rol']) && $_SESSION['rol']== "administrador"){ ?>
          <div class="  align-items-center mt-5">
            <button type="button" class="btn btn-warning" onclick="window.location.href='index.php?controller=comocolaborar&amp;action=edit&amp;id=<?= $contenido[0]->getId() ;?>'"><?= i18n("Modificar")?></button>
            
          </div>
        
         
              
   
          <?php } ?> 
        </div>
          
          </div>
</div>
 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalComprobacion"><?= i18n("Error de validación")?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="parrafovalidacion"> </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><?= i18n("Cerrar")?></button>
        
      </div>
    </div>
  </div>
</div>

