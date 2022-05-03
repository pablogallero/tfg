<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


$errors = $view->getVariable("errors");

$view->setVariable("title", "Edit Post");

?>
<div class="container mb-5"><div class=" text-center mt-5 ">
        <h1>Añadir Contacto</h1>
    </div>
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form id="contact-form" role="form" action="index.php?controller=contactos&amp;action=add" method="POST">
                            <div class="controls">
							
                                <div class="row">
									
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="nombre">Nombre</label> <input id="form_name" type="text" name="nombre" class="form-control" placeholder="Introduzca aquí el nombre" required="required" > </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="apellidos">Apellidos</label> <input id="form_lastname" type="text" name="apellidos" class="form-control" placeholder="Introduzca aquí los apellidos" required="required" > </div>
                                    </div>
                                </div>

                                <div class="row">
									
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="email">Email</label> <input id="form_name" type="text" name="email" class="form-control" placeholder="Introduzca aquí el email" required="required" > </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="telefono">Teléfono</label> <input id="form_lastname" type="text" name="telefono" class="form-control" placeholder="Introduzca aquí el teléfono" required="required" > </div>
                                    </div>
                                </div>
                                
                                <div class="row">
									
                                    <div class="col-md-3">
                                        <div class="form-group"> <label for="rutafoto">Foto de perfil</label> <input id="form_name" type="file" accept="image/png, image/jpeg" name="rutafoto" class="form-control"  required="required" > </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group"> <label for="form_need">Cargo</label> <select id="form_need" name="cargo" class="form-control" required="required" data-error="Indica el cargo, por favor.">
                                                <option value="" selected disabled>Selecciona un cargo</option>
                                                <option>Administrador</option>
                                                <option>Jefe</option>
                                                <option>Directivo</option>
                                                
                                            </select> </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="rutatwitter"> Nombre en Twitter</label> <input id="form_name" type="text" name="rutatwitter" class="form-control" placeholder="Su @ en Twitter" required="required" > </div>
                                    </div>
                                    <div class="col-md-12"> <button type="submit" class="btn btn-success btn-send pt-2 btn-block w-100" name="submit" value="submit"> Añadir </button></div>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- /.8 -->
        </div> <!-- /.row-->
    </div>
</div>