<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


$errors = $view->getVariable("errors");

$view->setVariable("title", "Edit Post");

?>
<div class="container mb-5"><div class=" text-center mt-5 ">
        <h1><?= i18n("Añadir noticia")?></h1>
    </div>
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form id="contact-form" role="form" action="index.php?controller=noticias&amp;action=add" onsubmit="return validarformularionoticias()" method="POST" enctype="multipart/form-data" >
                            <div class="controls">
							
                                <div class="row">
									
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="titulo"><?= i18n("Título")?></label> <input id="titulo" onblur="validarVacio(this.id)" type="text" name="titulo" class="form-control" placeholder="<?= i18n("Introduzca aquí el título")?>" > </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="imagenruta"><?= i18n("Imagen")?></label> <input id="imagen"  type="file" name='imagenruta' class="form-control" placeholder="<?= i18n("Introduzca aquí la imagen")?>"  > </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group"> <label for="cuerponoticia"><?= i18n("Cuerpo noticia")?></label> <textarea id="cuerponoticia" onblur="validarVacio(this.id)" name="cuerponoticia" class="form-control" placeholder="<?= i18n("Introduzca aquí el cuerpo de la noticia")?>" rows="4"  ></textarea> </div>
                                    </div>
                                    <div class="col-md-12"> <button type="submit" class="btn btn-success btn-send pt-2 btn-block w-100" name="submit" value="submit"> <?= i18n("Añadir")?> </button></div>
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