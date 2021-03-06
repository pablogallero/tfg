<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


$errors = $view->getVariable("errors");



?>
<div class="container mb-5"><div class=" text-center mt-5 ">
        <h1><?= i18n("Añadir usuario")?></h1>
    </div>
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form id="contact-form" role="form" action="index.php?controller=users&amp;action=add" onsubmit="return encryptpass() & validarformularioadduser()" method="POST">
                            <div class="controls">
							
                                <div class="row">
									
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="titulo"><?= i18n("Nombre de usuario")?></label> <input id="username" type="text" onblur="comprobarTexto(this.id,25)" name="username" class="form-control"  required="required" > </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="imagenruta">Email</label> <input id="email" type="text" name="email" onblur="comprobarEmail(this.id)" class="form-control"  required="required" > </div>
                                    </div>
                                </div>
                                <div class="row">
									
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="titulo"><?= i18n("DNI")?></label> <input id="dni" type="text"  name="dni" onblur="comprobarDNI(this.id)" class="form-control"  required="required" > </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="imagenruta"><?= i18n("Teléfono")?></label> <input id="telefono" type="text" name="telefono"  onblur="comprobarTelf(this.id)" class="form-control"  required="required" > </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="imagenruta"><?= i18n("Contraseña")?></label> <input id="passwd" type="password" name="passwd" onblur="comprobarTexto(this.id,50)" class="form-control"  required="required" > </div>
                                    </div>
                                </div>
                                <div class="row">
									
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="titulo"><?= i18n("Género")?></label> <select class="form-control" name="genero" id="genero">
                                         <option value="hombre"><?= i18n("Hombre")?></option>
                                          <option value="mujer"><?= i18n("Mujer")?></option>
      
                                         </select> </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="imagenruta"><?= i18n("Dirección de vivienda")?></label> <input id="direccion" type="text" name="direccion"  onblur="validarVacio(this.id)" class="form-control"  > </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="titulo">Rol</label> <select class="form-control" name="rol" id="rol">
                                         <option value="administrador"><?= i18n("Administrador")?></option>
                                          <option value="usuario"><?= i18n("Usuario")?></option>
      
                                         </select> </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    
                                    <div class="col-md-12"> <button type="submit" class="btn btn-success btn-send pt-2 btn-block w-100" name="submit"  value="submit"> <?= i18n("Añadir")?>  </button></div>
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

  document.getElementById("passwd").value= md5(document.getElementById("passwd").value);

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