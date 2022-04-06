
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

            <form action="index.php?controller=users&amp;action=register" method="POST">
              
              <label class="form-label" for="typeEmailX">Email</label>
                <input type="email"  name="email" id="typeEmailX" class="form-control form-control-lg mb-3" />
               
              

              <div class="form-outline form-white mb-4">
              <label class="form-label" for="typePasswordX">Contraseña</label>
                <input type="password" name="passwd" id="typePasswordX" class="form-control form-control-lg mb-3" />
            
				<label class="form-label" for="typeUsernameX">Nombre de usuario</label>
                <input type="text"  name="username" id="typeUsernameX" class="form-control form-control-lg mb-3" />
				<label class="form-label" for="typeDniX">DNI</label>
                <input type="text"  name="dni" id="typeDniX" class="form-control form-control-lg mb-3" />
				<label class="form-label" for="typeTelefonoX">Teléfono</label>
                <input type="text"  name="telefono" id="typeTelefonoX" class="form-control form-control-lg mb-3" />
				<label class="form-label" for="typeDireccionX">Dirección</label>
                <input type="text"  name="direccion" id="typeDireccionX" class="form-control form-control-lg mb-3" />
				<label class="form-label" for="typegeneroX">Género</label>
				<select name="genero" class=" form-control form-control-lg mb-3">
					<option value="1">Mujer</option> 
       				<option value="2">Hombre</option> 
       				
       				
				</select> 
            
              
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

