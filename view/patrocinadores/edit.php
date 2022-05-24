<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


$errors = $view->getVariable("errors");
$categorias = $view->getVariable("categorias");
$patrocinador = $view->getVariable("patrocinador");
$x=0;
?>
<div class="container mb-5"><div class=" text-center mt-5 ">
        <h1>Editar patrocinador</h1>
    </div>
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form id="contact-form" role="form" action="index.php?controller=patrocinadores&amp;action=edit&amp;id=<?= $patrocinador->getId() ?>" onsubmit="return validarformulariopatrocinador()" method="POST">
                            <div class="controls">
							
                                
									
                                    <div class="col-md-4">
                                    <div class="form-group"> <label for="imagenruta">Nombre</label> <input id="nombre" type="text" value="<?= $patrocinador->getNombre() ?>" name="nombre"  onblur="comprobarAlfabetico(this.id,50)" class="form-control" placeholder="Introduzca aquí el nombre" required="required" > </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="imagenruta">Imagen</label> <input id="imagen" type="text" name="imagen" value="<?= $patrocinador->getImagen() ?>"  class="form-control" onblur="validarVacio(this.id)"  required="required" > </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="titulo">Categoria</label> <select class="form-control" name="categoria" id="exampleFormControlSelect1">
                                         <?php while($x < count($categorias)) {?>
                                            <option value="<?= $categorias[$x]->getId(); ?>" <?php if($patrocinador->getCategoria()==$categorias[$x]->getId()){?> selected <?php } ?> ><?= $categorias[$x]->getNombre() ?></option>
                                            
                                        <?php $x=$x+1; } ?>
                                         </select> </div>
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