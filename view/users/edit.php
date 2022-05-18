<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


$errors = $view->getVariable("errors");
$usuario= $view->getVariable("usuario");
$view->setVariable("title", "Edit Post");

?>
<div class="container mb-5"><div class=" text-center mt-5 ">
        <h1>Editar usuario</h1>
    </div>
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form id="contact-form" role="form" action="index.php?controller=users&amp;action=edit&amp;id=<?=$usuario->getId() ?>" method="POST">
                            <div class="controls">
							
                                <div class="row">
									
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="titulo">Nombre de usuario</label> <input id="form_name" type="text" value="<?=$usuario->getUsername() ?>" name="username" class="form-control" placeholder="Introduzca aquí el nombre de usuario" required="required" > </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="imagenruta">Email</label> <input id="form_lastname" type="text" name="email" value="<?=$usuario->getEmail() ?>" class="form-control" placeholder="Introduzca aquí el email" required="required" > </div>
                                    </div>
                                </div>
                                <div class="row">
									
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="titulo">DNI</label> <input id="form_name" type="text" value="<?=$usuario->getDni() ?>" name="dni" class="form-control" placeholder="Introduzca aquí el DNI" required="required" > </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="imagenruta">Telefono</label> <input id="form_lastname" type="text" name="telefono" value="<?=$usuario->getTelefono() ?>" class="form-control" placeholder="Introduzca aquí el telefono" required="required" > </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="imagenruta">Contraseña</label> <input id="form_lastname" type="password" name="passwd" value="<?=$usuario->getPasswd()  ?>" class="form-control" placeholder="Introduzca aquí la contraseña" required="required" > </div>
                                    </div>
                                </div>
                                <div class="row">
									
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="titulo">Género</label> <select class="form-control" name="genero" id="exampleFormControlSelect1">
                                         <option value="hombre">Hombre</option>
                                          <option value="mujer">Mujer</option>
      
                                         </select> </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="imagenruta">Direccion</label> <input id="form_lastname" type="text" name="direccion" value="<?=$usuario->getDireccion() ?>" class="form-control" placeholder="Introduzca aquí la direccion" required="required" > </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="titulo">Rol</label> <select class="form-control" name="rol" id="exampleFormControlSelect1">
                                         <option value="administrador">Administrador</option>
                                          <option value="usuario">Usuario</option>
      
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