<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


$errors = $view->getVariable("errors");
$user= $view->getVariable("usuario");
$view->setVariable("title", "Ver usuario");

?>
<div class="row">

        <div class="col-sm-12 col-md-10 ml-auto mr-auto mt-4 mb-4">
            <form>
                <div class="divShowCurrent">
                    <h4 class="ml-4 mt-4 mb-4">Perfil</h4>
                    <div class="divLabelInput ml-4">
                        <label class="labelShowCurrent col-4" for="inputNombre">NOMBRE</label>
                        <input class="quitarReadOnly inputShowCurrent ml-3 col-7" id="inputNombre" name="name" type="text" value="<?=$user->getUsername()?>" readonly>
                    </div>
                    <div class="divLabelInput ml-4 mb-3 mt-4">
                        <label class="labelShowCurrent col-4" for="inputPass">CONTRASEÑA</label>
                        <input class="quitarReadOnly inputShowCurrent ml-3 col-7" id="inputPass" name="passwd" type="text" value="<?=$user->getPasswd()?>" placeholder="..............." readonly>
                    </div>  

                    <div class=" ml-4">
                        <label class="labelShowCurrent col-4" for="inputNombre">ROL</label>
                        <input class="quitarReadOnly inputShowCurrent ml-3 col-7" id="inputNombre" name="rol" type="text" value="<?=$user->getRol()?>" readonly>
                    </div>
                </div>

                
                <div class="divShowCurrent mt-4">
                    <h4 class="ml-4 mt-4 mb-4">Información de contacto</h4>
                    <div class="divLabelInput ml-4">
                        <label class="labelShowCurrent col-4" for="inputNombre">TELEFONO</label>
                        <input class="quitarReadOnly inputShowCurrent ml-3 col-7" id="inputNombre" name="telf" type="text" value="<?=$user->getTelefono()?>" readonly>
                    </div>
                    <div class="ml-4 mb-3 mt-4">
                        <label class="labelShowCurrent col-4" for="inputPass">EMAIL</label>
                        <input class="quitarReadOnly inputShowCurrent ml-3 col-7" id="inputPass" name="email" type="email" value="<?=$user->getEmail()?>" readonly>
                    </div>  
                </div>

                <div class="divShowCurrent mt-4">
                    <h4 class="ml-4 mt-4 mb-4">Datos personales</h4>
                    <div class="divLabelInput ml-4">
                        <label class="labelShowCurrent col-4" for="inputNombre">DNI</label>
                        <input class="inputShowCurrent ml-3 col-7" id="inputNombre" type="text" value="<?=$user->getDni()?>" readonly>
                    </div>
                    <div class="divLabelInput ml-4 mt-4">
                        <label class="labelShowCurrent col-4" for="inputPass">DIRECCIÓN</label>
                        <input class="quitarReadOnly inputShowCurrent ml-3 col-7" id="inputPass" name="direccion" type="text" value="<?=$user->getDireccion()?>" readonly>
                    </div>
                    <div class="ml-4 mb-3 mt-4">
                        <label class="labelShowCurrent col-4" for="inputPass">GÉNERO</label>
                        <input class="inputShowCurrent ml-3 col-7" id="inputPass" type="text" value="<?=$user->getGenero()?>" readonly>
                    </div>  
                </div>

                <div class="text-right  mt-4">
                <button type="button" class="btn btn-warning" onclick="window.location.href='index.php?controller=users&amp;action=edit&amp;id=<?=$user->getId() ;?>'">Modificar</button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteUser<?=$user->getId() ;?>">Eliminar</button>
                    
        <button type="button" class="btn btn-info" onclick="window.location.href='index.php?controller=users&amp;action=showall'">Atrás</button>
                    
                </div>
                
            </form>
            
        
        </div>
    
</div>


        <!-- MODAL ELIMINAR Usuario-->
        <div class=" modal fade" id="modalDeleteUser<?=$user->getId() ;?>" tabindex="-1" role="dialog" aria-labelledby="titleModalDelete" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="col-9 px-0 mx-auto modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModalDelete">Eliminar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                  
                <div>
                    <div class="mx-auto px-0 cuerpoModal modal-body ">
                        <p>¿Estás seguro de querer borrar "<?=$user->getEmail() ;?>"?</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="window.location.href='index.php?controller=users&action=delete&id=<?= $user->getId()?>'">Eliminar</button>
                    <button type="button" class="btn btn-light " data-dismiss="modal">Cerrar</button>
                        
                    </div>
                </div>

            </div>
        </div>
</div>
</div> 