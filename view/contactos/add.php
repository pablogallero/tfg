<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


$errors = $view->getVariable("errors");

$view->setVariable("title", "Edit Post");

?>
<div class="container mb-5"><div class=" text-center mt-5 ">
        <h1><?= i18n("Añadir contacto")?></h1>
    </div>
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form id="contact-form" role="form" action="index.php?controller=contactos&amp;action=add" onsubmit="return validarformulariocontacto()" method="POST">
                            <div class="controls">
							
                                <div class="row">
									
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="nombre"><?= i18n("Nombre")?></label> <input id="nombre" onblur="comprobarAlfabetico(this.id,50)" type="text" name="nombre" class="form-control" placeholder="<?= i18n("Introduzca aquí el nombre")?>" required="required" > </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="apellidos"><?= i18n("Apellidos")?></label> <input id="apellidos"  onblur="comprobarAlfabetico(this.id,50)" type="text" name="apellidos" class="form-control" placeholder="<?= i18n("Introduzca aquí los apellidos")?>" required="required" > </div>
                                    </div>
                                </div>

                                <div class="row">
									
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="email">Email</label> <input id="email" type="text" onblur="comprobarEmail(this.id)" name="email" class="form-control" placeholder="<?= i18n("Introduzca aquí el email")?>" required="required" > </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="telefono"><?= i18n("Teléfono")?></label> <input id="telefono" type="text"  onblur="comprobarTelf(this.id)" name="telefono" class="form-control" placeholder="<?= i18n("Introduzca aquí el teléfono")?>" required="required" > </div>
                                    </div>
                                </div>
                                
                                <div class="row">
									
                                    <div class="col-md-3">
                                        <div class="form-group"> <label for="rutafoto"><?= i18n("Foto de perfil")?></label> <input id="fotoperfil" type="file" accept="image/png, image/jpeg" name="rutafoto" class="form-control"  required="required" > </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group"> <label for="form_need"><?= i18n("Cargo")?></label> <select id="cargo" name="cargo" class="form-control" required="required" data-error="Indica el cargo, por favor.">
                                                <option value="" selected disabled><?= i18n("Selecciona un cargo")?></option>
                                                <option value="Administrador"><?= i18n("Administrador")?></option>
                                                <option value="Jefe"><?= i18n("Jefe")?></option>
                                                <option value="Directivo"><?= i18n("Directivo")?></option>
                                                
                                            </select> </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> <label for="rutatwitter"> <?= i18n("Nombre en Twitter")?></label> <input id="twitter"  onblur="comprobarTexto(this.id,25)"type="text" name="rutatwitter" class="form-control" placeholder="<?= i18n("Su @ en Twitter")?>" required="required" > </div>
                                    </div>
                                    <div class="col-md-12"> <button type="submit" class="btn btn-success btn-send pt-2 btn-block w-100" name="submit" value="submit"><?= i18n("Añadir")?></button></div>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- /.8 -->
        </div> <!-- /.row-->
    </div>
</div>