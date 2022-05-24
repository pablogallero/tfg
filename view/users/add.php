<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


$errors = $view->getVariable("errors");



?>
<div class="container mb-5"><div class=" text-center mt-5 ">
        <h1>Añadir usuario</h1>
    </div>
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form id="contact-form" role="form" action="index.php?controller=users&amp;action=add" onsubmit="return validarformularioadduser()" method="POST">
                            <div class="controls">
							
                                <div class="row">
									
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="titulo">Nombre de usuario</label> <input id="username" type="text" onblur="comprobarTexto(this.id,25)" name="username" class="form-control" placeholder="Introduzca aquí el nombre de usuario" required="required" > </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="imagenruta">Email</label> <input id="email" type="text" name="email" onblur="comprobarEmail(this.id)" class="form-control" placeholder="Introduzca aquí el email" required="required" > </div>
                                    </div>
                                </div>
                                <div class="row">
									
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="titulo">DNI</label> <input id="dni" type="text"  name="dni" onblur="comprobarDNI(this.id)" class="form-control" placeholder="Introduzca aquí el DNI" required="required" > </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="imagenruta">Telefono</label> <input id="telefono" type="text" name="telefono"  onblur="comprobarTelf(this.id)" class="form-control" placeholder="Introduzca aquí el telefono" required="required" > </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="imagenruta">Contraseña</label> <input id="passwd" type="password" name="passwd" onblur="comprobarTexto(this.id,25)" class="form-control" placeholder="Introduzca aquí la contraseña" required="required" > </div>
                                    </div>
                                </div>
                                <div class="row">
									
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="titulo">Género</label> <select class="form-control" name="genero" id="genero">
                                         <option value="hombre">Hombre</option>
                                          <option value="mujer">Mujer</option>
      
                                         </select> </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="imagenruta">Dirección</label> <input id="direccion" type="text" name="direccion"  onblur="validarVacio(this.id)" class="form-control" placeholder="Introduzca aquí la direccion" required="required" > </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="titulo">Rol</label> <select class="form-control" name="rol" id="rol">
                                         <option value="administrador">Administrador</option>
                                          <option value="usuario">Usuario</option>
      
                                         </select> </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    
                                    <div class="col-md-12"> <button type="submit" class="btn btn-success btn-send pt-2 btn-block w-100" name="submit"  value="submit"> Añadir  </button></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- /.8 -->
        </div> <!-- /.row-->
    </div>
</div>