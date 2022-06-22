<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


$errors = $view->getVariable("errors");

$categoria = $view->getVariable("categoria");

?>
<div class="container mb-5"><div class=" text-center mt-5 ">
        <h1>Editar categoría</h1>
    </div>
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form id="contact-form" role="form" action="index.php?controller=patrocinadores&amp;action=editcat&amp;id=<?= $categoria->getId() ?>" onsubmit="return validarformulariocategoria()" method="POST">
                            <div class="controls">
							
                                
									
                                    <div class="col-md-6">
                                    <div class="form-group"> <label for="imagenruta">Nombre</label> <input id="nombre" onblur="validarVacio(this.id)" type="text" name="nombre" value="<?= $categoria->getNombre() ?>" class="form-control" placeholder="Introduzca aquí el nombre" required="required" > </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="imagenruta">Color</label> <input type="color" class="form-control" value="<?= $categoria->getColor() ?>" id="color" onblur="validarVacio(this.id)" name="color"> </div>
                                    </div>
                                   
                                </div>
                                
                                <div class="row">
                                    
                                    <div class="col-md-12"> <button type="submit" class="btn btn-success btn-send pt-2 btn-block w-100" name="submit" value="submit"> Editar </button></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- /.8 -->
        </div> <!-- /.row-->
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