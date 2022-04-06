<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$videotutorial = $view->getVariable("videotutorial");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Edit Post");

?>
<div class="container mb-5"><div class=" text-center mt-5 ">
        <h1>Editar videotutorial</h1>
    </div>
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form id="contact-form" role="form" action="index.php?controller=videotutoriales&amp;action=edit&amp;id=<?=$videotutorial->getId() ?>" method="POST">
                            <div class="controls">
							
                                <div class="row">
									
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="titulo">Título</label> <input id="form_name" type="text" name="titulo" class="form-control" value="<?=$videotutorial->getTitulo() ?>" placeholder="Introduzca aquí el título del videotutorial" required="required" > </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="enlace">Enlace</label> <input id="form_lastname" type="text" name="enlace" class="form-control" value="<?=$videotutorial->getEnlace() ?>" placeholder="Introduzca aquí el link embebido" required="required" > </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group"> <label for="descripcion">Descripción</label> <textarea id="form_message" name="descripcion" class="form-control"   rows="4" required="required" ><?=$videotutorial->getDescripcion() ?></textarea> </div>
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