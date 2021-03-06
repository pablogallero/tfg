<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


$errors = $view->getVariable("errors");
$usuario= $view->getVariable("usuario");
$view->setVariable("title", "Edit Post");

?>
<div class="container mb-5"><div class=" text-center mt-5 ">
        <h1><?= i18n("Editar usuario")?></h1>
    </div>
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form id="contact-form" role="form" action="index.php?controller=users&amp;action=edit&amp;id=<?=$usuario->getId() ?>" onsubmit="return encryptpass() & validarformularioedituser()" method="POST">
                            <div class="controls">
							
                                <div class="row">
									
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="titulo"><?= i18n("Nombre de usuario")?></label> <input id="username" type="text" value="<?=$usuario->getUsername() ?>" onblur="comprobarTexto(this.id,25)" name="username" class="form-control" placeholder="Introduzca aquí el nombre de usuario" required="required" > </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="imagenruta">Email</label> <input id="email" type="text" name="email" value="<?=$usuario->getEmail() ?>" onblur="comprobarEmail(this.id)" class="form-control" placeholder="Introduzca aquí el email" required="required" > </div>
                                    </div>
                                </div>
                                <div class="row">
									
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="titulo"><?= i18n("DNI")?></label> <input id="dni" type="text" value="<?=$usuario->getDni() ?>" onblur="comprobarDNI(this.id)"  name="dni" class="form-control" placeholder="Introduzca aquí el DNI" required="required" > </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="imagenruta"><?= i18n("Teléfono")?></label> <input id="telefono" type="text" name="telefono" onblur="comprobarTelf(this.id)" value="<?=$usuario->getTelefono() ?>" class="form-control" placeholder="Introduzca aquí el telefono" required="required" > </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="imagenruta"><?= i18n("Contraseña")?></label> <input id="passwd" type="password" readonly name="passwd" onblur="comprobarTexto(this.id,50)" value="<?=$usuario->getPasswd()  ?>" class="form-control" placeholder="Introduzca aquí la contraseña" required="required" > </div>
                                        
                                    </div>
                                    <div class="col-md-12">
                                   
                            <div class="form-group"> <label for="imagenruta"><?= i18n("Nueva Contraseña")?></label> <input id="passwdnueva" type="password" name="passwdnueva" onblur="comprobarNuevaPass(this.id)"  class="form-control" placeholder="Si no desea cambiar la contraseña, deje el campo vacío"  > </div>
                            </div>    
                        </div>
                                <div class="row">
									
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="titulo"><?= i18n("Género")?></label> <select class="form-control" name="genero" id="genero">
                                         <option value="hombre" <?php if($usuario->getGenero()=="hombre"){?> selected <?php } ?>  ><?= i18n("Hombre")?></option>
                                          <option value="mujer" <?php if($usuario->getGenero()=="mujer"){?> selected <?php } ?> ><?= i18n("Mujer")?></option>
      
                                         </select> </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="imagenruta"><?= i18n("Dirección de vivienda")?></label> <input id="direccion" type="text" name="direccion" onblur="validarVacio(this.id)" value="<?=$usuario->getDireccion() ?>" class="form-control" placeholder="Introduzca aquí la direccion" required="required" > </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="titulo">Rol</label> <select class="form-control" name="rol" id="rol">
                                         <option value="administrador" <?php if($usuario->getRol()=="administrador"){?> selected <?php } ?>><?= i18n("Administrador")?></option>
                                          <option value="usuario" <?php if($usuario->getRol()=="usuario"){?> selected <?php } ?>><?= i18n("Usuario")?></option>
      
                                         </select> </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    
                                    <div class="col-md-12"> <button type="submit" class="btn btn-success btn-send pt-2 btn-block w-100" name="submit" value="submit"> <?= i18n("Editar")?> </button></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- /.8 -->
        </div> <!-- /.row-->
    </div>
</div>
<script>
function encryptpass(){

  document.getElementById("passwdnueva").value= md5(document.getElementById("passwdnueva").value);

  return true;
}
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