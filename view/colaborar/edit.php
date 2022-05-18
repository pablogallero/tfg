<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


$errors = $view->getVariable("errors");
$contenido= $view->getVariable("comocolaborar");


?>
<div class="container mb-5"><div class=" text-center mt-5 ">
        <h1>Editar cómo colaborar</h1>
    </div>
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form id="contact-form" role="form" action="index.php?controller=comocolaborar&amp;action=edit&amp;id=<?=$contenido->getId() ?>" method="POST">
                            <div class="controls">
							
                                <div class="row">
									
                                    <div class="col-md-12">
                                        <div class="form-group"> <label for="titulo">Título</label> <input id="form_name" type="text" name="titulo" class="form-control" value="<?= $contenido->getTitulo() ?>" placeholder="Introduzca aquí el título" required="required" > </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group"> <label for="descripcion">Descripción</label>  <textarea rows="15" name="descripcion" id="mytextarea"><?=nl2br( $contenido->getDescripcion()) ?></textarea> </div>
                                    </div>
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


    <script type="text/javascript">
      tinymce.init({
        selector: '#mytextarea'
      });
    </script>