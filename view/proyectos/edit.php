<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


$errors = $view->getVariable("errors");
$proyecto= $view->getVariable("proyecto");


?>
<div class="container mb-5"><div class=" text-center mt-5 ">
        <h1><?= i18n("Editar proyecto")?> <?=$proyecto->getTitulo() ?></h1>
    </div>
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form id="contact-form" role="form" action="index.php?controller=proyectos&amp;action=edit&amp;id=<?=$proyecto->getId() ?>" onsubmit="return validarformularioproyecto()"  method="POST" enctype="multipart/form-data">
                            <div class="controls">
							
                                <div class="row">
									
                                    <div class="col-md-12">
                                        <div class="form-group"> <label for="titulo"><?= i18n("Título")?></label> <input id="titulo" onblur="validarVacio(this.id)" type="text" name="titulo" class="form-control" value="<?= $proyecto->getTitulo() ?>" placeholder="<?= i18n("Introduzca aquí el título")?>" required="required" > </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
									
                                    <div class="col-md-12">
                                        <div class="form-group"> <label for="titulo"><?= i18n("Imagen")?></label> <input id="imagen" type="file" name='imagen' class="form-control" value="<?= $proyecto->getImagen() ?>"  required="required" > </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                    <h3 class="display-3 titulovideos"><?= i18n("¿Qué es?")?></h3> 
                                        <div class="form-group">   <textarea rows="15" name="introduccion" onblur="validarVacio(this.id)" id="mytextarea"><?=nl2br( $proyecto->getIntroduccion()) ?></textarea> </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                    <h3 class="display-3 titulovideos"><?= i18n("Objetivos")?></h3> 
                                        <div class="form-group">   <textarea rows="15" name="objetivos" onblur="validarVacio(this.id)" id="mytextarea1"><?=nl2br( $proyecto->getObjetivos()) ?></textarea> </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                    <h3 class="display-3 titulovideos"><?= i18n("Metodología")?></h3> 
                                        <div class="form-group">   <textarea rows="15" name="metodologia" onblur="validarVacio(this.id)" id="mytextarea2"><?=nl2br( $proyecto->getMetodologia()) ?></textarea> </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                    <h3 class="display-3 titulovideos"><?= i18n("Conclusiones")?></h3> 
                                        <div class="form-group">   <textarea rows="15" name="conclusiones" onblur="validarVacio(this.id)" id="mytextarea3"><?=nl2br( $proyecto->getConclusiones()) ?></textarea> </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12"> <button type="submit" class="btn btn-success btn-send pt-2 btn-block w-100" name="submit" value="submit"> <?= i18n("Editar")?> </button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- /.8 -->
        </div> <!-- /.row-->
    </div>
</div>


    <script type="text/javascript">
      tinymce.init({
        selector: '#mytextarea'
      });
      tinymce.init({
        selector: '#mytextarea1'
      });
      tinymce.init({
        selector: '#mytextarea2'
      });
      tinymce.init({
        selector: '#mytextarea3'
      });
    </script>

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