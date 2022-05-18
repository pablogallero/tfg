<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


$errors = $view->getVariable("errors");
$noticia= $view->getVariable("noticia");
$view->setVariable("title", "Edit Post");

?>
<div class="container mb-5"><div class=" text-center mt-5 ">
        <h1>Editar noticia</h1>
    </div>
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form id="contact-form" role="form" action="index.php?controller=noticias&amp;action=edit&amp;id=<?=$noticia->getId() ?>" method="POST">
                            <div class="controls">
							
                                <div class="row">
									
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="titulo">Título</label> <input id="form_name" type="text" value="<?=$noticia->getTitulo() ?>" name="titulo" class="form-control" placeholder="Introduzca aquí el título del videotutorial" required="required" > </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="imagenruta">Imagen Ruta</label> <input id="form_lastname" type="text" name="imagenruta" value="<?=$noticia->getImagenruta() ?>" class="form-control" placeholder="Introduzca aquí la ruta de la imagen" required="required" > </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group"> <label for="cuerponoticia">Cuerpo noticia</label> <textarea id="form_message"  name="cuerponoticia" class="form-control" placeholder="Escriba aquí el cuerpo de la noticia." rows="12" required="required" > <?= nl2br($noticia->getCuerponoticia())?></textarea> </div>
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