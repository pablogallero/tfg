<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


$errors = $view->getVariable("errors");
$contacto= $view->getVariable("contacto");
$view->setVariable("title", "Edit Post");

?>
<div class="container mb-5"><div class=" text-center mt-5 ">
        <h1><?= i18n("Editar contacto")?></h1>
    </div>
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form id="contact-form" role="form" action="index.php?controller=contactos&amp;action=edit&amp;id=<?= $contacto->getId() ?>" onsubmit="return validarformulariocontactoedit()" method="POST" enctype="multipart/form-data">
                            <div class="controls">
							
                                <div class="row">
									
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="nombre"><?= i18n("Nombre")?></label> <input id="nombre" onblur="comprobarAlfabetico(this.id,50)"  type="text" name="nombre" class="form-control" value="<?= $contacto->getNombre() ?>" placeholder="<?= i18n("Introduzca aquí el nombre")?>" required="required" > </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="apellidos"><?= i18n("Apellidos")?></label> <input id="apellidos" onblur="comprobarAlfabetico(this.id,50)"  type="text" name="apellidos" class="form-control" value="<?= $contacto->getApellidos() ?>" placeholder="<?= i18n("Introduzca aquí los apellidos")?>" required="required" > </div>
                                    </div>
                                </div>

                                <div class="row">
									
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="email">Email</label> <input id="email" onblur="comprobarEmail(this.id)" type="text" name="email" class="form-control" value="<?= $contacto->getEmail() ?>" placeholder="<?= i18n("Introduzca aquí el email")?>" required="required" > </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="telefono"><?= i18n("Teléfono")?></label> <input id="telefono" onblur="comprobarTelf(this.id)" type="text" name="telefono" class="form-control" value="<?= $contacto->getTelefono() ?>" placeholder="<?= i18n("Introduzca aquí el teléfono")?>" required="required" > </div>
                                    </div>
                                </div>
                                
                                <div class="row">
									
                                    <div class="col-md-12">
                                    <img id="preview" src="images/<?= $contacto->getRutafoto() ?>"  width="150" height="150" alt="Preview" />
                                        <div class="form-group"> <label for="rutafoto"><?= i18n("Foto de perfil")?></label> <input id="fotoperfil" type="file" accept="image/png, .jpeg, .jpg, image/gif" name="rutafoto" class="form-control"  > </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group"> <label for="form_need"><?= i18n("Cargo")?></label> <select id="cargo" name="cargo" class="form-control" required="required" data-error="Indica el cargo, por favor.">
                                                <option value=""  disabled><?= i18n("Selecciona un cargo")?></option>

                                                <option <?php if($contacto->getCargo() =="Administrador"){ ?> selected <?php } ?> value="Administrador" ><?= i18n("Administrador")?></option>
                                                <option <?php if($contacto->getCargo() =="Jefe"){ ?> selected <?php } ?> value="Jefe" ><?= i18n("Jefe")?></option>
                                                <option <?php if($contacto->getCargo() =="Directivo"){ ?> selected <?php } ?> value="Directivo" ><?= i18n("Directivo")?></option>
                                                
                                            </select> </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="rutatwitter"> <?= i18n("Nombre en Twitter")?></label> <input id="twitter" onblur="comprobarTexto(this.id,25)"  type="text" name="rutatwitter" class="form-control" value="<?= $contacto->getRutatwitter() ?>" placeholder="<?= i18n("Su @ en Twitter")?>" required="required" > </div>
                                    </div>
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


<script>

fotoperfil.onchange = evt => {
  const [file] = fotoperfil.files
  if (file) {
    preview.src = URL.createObjectURL(file)
  }
}
  </script>