<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Login");

$errors = $view->getVariable("errors");
?>
 <section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark " style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

            <form action="index.php?controller=users&amp;action=login" method="POST">
              
              <label class="form-label" for="typeEmailX">Email</label>
                <input type="email"  name="email" id="typeEmailX" class="form-control form-control-lg" />
               
              

              <div class="form-outline form-white mb-4">
              <label class="form-label" for="typePasswordX">Password</label>
                <input type="password" name="passwd" id="typePasswordX" class="form-control form-control-lg" />
                
              
            </form>
              <p class="small mb-4 pb-lg-2"><a class="text-white-50" href="#!">¿Has olvidado tu contraseña?</a></p>

              <button class="btn btnlogin btn-outline-light btn-lg mb-4" type="submit" value="submit">Login</button>
              <hr>
              
              </div>

            </div>

            <div>
              <p class="mb-0">¿Aún no tienes cuenta? <a href="#!" class="text-white-50 fw-bold">Regístrate</a></p>
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
