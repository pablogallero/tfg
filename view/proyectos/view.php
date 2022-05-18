<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$proyecto = $view->getVariable("proyecto");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Mostrar proyecto");

$x=0;
?>
<div class="container my-5 w-75 ">
<h1 class="display-3 titulovideos"><?= $proyecto->getTitulo() ?></h1> </a>

<div class="row d-flex  align-items-center  ">
<img class=" img-fluid mx-auto w-50 h-50 mb-5 "   src="images/<?= $proyecto->getImagen() ?>" alt="Generic placeholder image"> 
          
          <div class="col-md-12  align-items-center mt-5">
          <h3 class="display-3 titulovideos">¿Qué es?</h3>  
          <p class="lead textovideos"><?= nl2br($proyecto->getIntroduccion())?></p></div>
          <div class="col-md-12  align-items-center mt-5">
          <h3 class="display-3 titulovideos">Objetivos</h3>  
          <p class="lead textovideos"><?= nl2br($proyecto->getObjetivos())?></p></div>
          <div class="col-md-12  align-items-center mt-5">
          <h3 class="display-3 titulovideos">Metodología</h3>  
          <p class="lead textovideos"><?= nl2br($proyecto->getMetodologia())?></p></div>
          <div class="col-md-12  align-items-center mt-5">
          <h3 class="display-3 titulovideos">Conclusiones</h3>  
          <p class="lead textovideos"><?= nl2br($proyecto->getConclusiones())?></p></div>
          <?php if( isset($_SESSION['rol']) && $_SESSION['rol']== "administrador"){ ?>
            <button type="button" class="btn btn-warning" onclick="window.location.href='index.php?controller=proyectos&amp;action=edit&amp;id=<?=$proyecto->getId() ;?>'">Modificar</button>
        <button type="button" class="btn text-center btn-danger " data-toggle="modal" data-target="#modalDeleteProyecto<?=$proyecto->getId() ;?>">Eliminar</button>
          

          
         
            
        <!-- MODAL ELIMINAR COMENTARIO-->
<div class=" modal fade" id="modalDeleteProyecto<?=$proyecto->getId() ;?>" tabindex="-1" role="dialog" aria-labelledby="titleModalDelete" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="col-9 px-0 mx-auto modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModalDelete">Eliminar proyecto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                  
                <div>
                    <div class="mx-auto px-0 cuerpoModal modal-body ">
                        <p class="p-5">¿Estás seguro de querer borrar este proyecto?</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="window.location.href='index.php?controller=proyectos&action=delete&id=<?= $proyecto->getId()?>'">Eliminar</button>
                        <button type="button" class="btn btn-light " data-dismiss="modal">Cerrar</button>
                        
                    </div>
                </div>

            </div>
        </div>
</div>
          
        <?php 
          } ?>