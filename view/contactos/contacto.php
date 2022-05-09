<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


$errors = $view->getVariable("errors");
$contactos= $view->getVariable("contactosadmin");

?>
<section class="ftco-section mb-5">
		<div class="container">
			<div class="row justify-content-center">
				
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-10">
					<div class="wrapper imgback" style="background-image: url(images/img.jpg);">
						<div class="row">
							<div class="col-md-9 col-lg-7">
								<div class="contact-wrap w-100 p-md-5 p-4">
									<h3 class="mb-4">Contacta con nosotros</h3>
									<div id="form-message-warning" class="mb-4"></div> 
				      		
									<form method="POST" role="form" action="index.php?controller=contactos&amp;action=contacto" id="contactForm" name="contactForm" class="contactForm">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="label" for="name">Tu nombre</label>
													<input type="text" class="form-control" name="nombre" id="name" placeholder="Nombre">
												</div>
											</div>
											<div class="col-md-6"> 
												<div class="form-group">
													<label class="label" for="email">Dirección de respuesta</label>
													<input type="email" class="form-control" name="email" id="email" >
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label class="label" for="subject">Asunto</label>
													<input type="text" class="form-control" name="asunto" id="subject" placeholder="Asunto">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label class="label" for="#">Mensaje</label>
													<textarea name="mensaje" class="form-control" id="message" cols="30" rows="4" placeholder="Mensaje"></textarea>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<input type="submit" value="Enviar" class="btn btn-primary">
													<div class="submitting"></div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
