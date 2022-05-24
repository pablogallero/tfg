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
									<h3 class="mb-4"><?= i18n("Contacta con nosotros")?></h3>
									<div id="form-message-warning" class="mb-4"></div> 
				      		
									<form method="POST" role="form" action="index.php?controller=contactos&amp;action=contacto" id="contactForm" onsubmit="return validarformulariocontactar()" name="contactForm" class="contactForm">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="label" for="name"><?= i18n("Tu nombre")?></label>
													<input type="text" class="form-control" name="nombre" id="nombre" onblur="comprobarAlfabetico(this.id,50)" placeholder="<?= i18n("Nombre")?>">
												</div>
											</div>
											<div class="col-md-6"> 
												<div class="form-group">
													<label class="label" for="email"><?= i18n("Dirección de respuesta")?></label>
													<input type="email" class="form-control" name="email"  id="email"  onblur="comprobarEmail(this.id)">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label class="label" for="subject"><?= i18n("Asunto")?></label>
													<input type="text" class="form-control" name="asunto" id="asunto" onblur="validarVacio(this.id)" placeholder="<?= i18n("Asunto")?>">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label class="label" for="#"><?= i18n("Mensaje")?></label>
													<textarea name="mensaje" class="form-control" id="mensaje" cols="30" rows="4"  onblur="validarVacio(this.id)"placeholder="<?= i18n("Mensaje")?>"></textarea>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<button type="submit" value="Enviar" class="btn btn-primary"><?= i18n("Enviar")?> </button>
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
