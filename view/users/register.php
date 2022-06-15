
<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Register");

$errors = $view->getVariable("errors");
?>
 <section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark " style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

            <form id="registerform" action="index.php?controller=users&amp;action=register" onsubmit="return  encryptpass()  & validarformularioadduser() " method="POST">
              
              <label class="form-label" for="typeEmailX">Email</label>
                <input type="email"  name="email"  id="typeEmailX"  onblur="comprobarEmail(this.id)" class="form-control form-control-lg mb-3" />
               
              

              <div class="form-outline form-white mb-4">
              <label class="form-label" for="typePasswordX">Contraseña</label>
                <input type="password" name="passwd" id="typePasswordX"   onblur="comprobarTexto(this.id,50)" class="form-control form-control-lg mb-3" />
            
				<label class="form-label" for="typeUsernameX">Nombre de usuario</label>
                <input type="text"  name="username" id="typeUsernameX"  onblur="comprobarTexto(this.id,25)" class="form-control form-control-lg mb-3" />
				<label class="form-label" for="typeDniX">DNI</label>
                <input type="text"  name="dni" id="typeDniX"  onblur="comprobarDNI(this.id)" class="form-control form-control-lg mb-3" />
				<label class="form-label" for="typeTelefonoX">Teléfono</label>
                <input type="text"  name="telefono" id="typeTelefonoX"  onblur="comprobarTelf(this.id)" class="form-control form-control-lg mb-3" />
				<label class="form-label" for="typeDireccionX">Dirección</label>
                <input type="text"  name="direccion" id="typeDireccionX"  onblur="validarVacio(this.id)" class="form-control form-control-lg mb-3" />
				<label class="form-label" for="typegeneroX">Género</label>
				<select name="genero" class=" form-control form-control-lg mb-3">
					<option value="1">Mujer</option> 
       				<option value="2">Hombre</option> 
       				
       				
				</select> 
            <?php  ?>
              
            </form>
            

              <button class="btn btnlogin btn-outline-light btn-lg mt-4" type="submit" value="submit">Registrarse</button>
             
              
              </div>

            </div>

          

          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php $view->moveToFragment("css");?>
<link rel="stylesheet" type="text/css" src="css/style2.css">
<?php $view->moveToDefaultFragment(); ?>




<script>
function encryptpass(){

  document.getElementById("typePasswordX").value= md5(document.getElementById("typePasswordX").value);

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
