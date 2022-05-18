<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


$errors = $view->getVariable("errors");



?>
<div class="container mb-5"><div class=" text-center mt-5 ">
        <h1>Añadir proyecto</h1>
    </div>
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form id="contact-form" role="form" enctype="multipart/form-data" action="index.php?controller=proyectos&amp;action=add"  method="POST">
                            <div class="controls">
							
                                <div class="row">
									
                                    <div class="col-md-12">
                                        <div class="form-group"> <label for="titulo">Título</label> <input id="form_name" type="text" name="titulo" class="form-control"  placeholder="Introduzca aquí el título" required="required" > </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
									
                                    <div class="col-md-12">
                                        <div class="form-group"> <label for="titulo">Imagen</label> <input id="form_name" type="file" name='imagen' class="form-control"  placeholder="Introduzca aquí el título" required="required" > </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                    <h3 class="display-3 titulovideos">¿Qué es?</h3> 
                                        <div class="form-group">   <textarea rows="15" name="introduccion" id="mytextarea"></textarea> </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                    <h3 class="display-3 titulovideos">Objetivos</h3> 
                                        <div class="form-group">   <textarea rows="15" name="objetivos" id="mytextarea1"></textarea> </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                    <h3 class="display-3 titulovideos">Metodología</h3> 
                                        <div class="form-group">   <textarea rows="15" name="metodologia" id="mytextarea2"></textarea> </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                    <h3 class="display-3 titulovideos">Conclusiones</h3> 
                                        <div class="form-group">   <textarea rows="15" name="conclusiones" id="mytextarea3"></textarea> </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12"> <button type="submit" class="btn btn-success btn-send pt-2 btn-block w-100" name="submit" value="submit"> Añadir </button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- /.8 -->
        </div> <!-- /.row-->
    </div>
</div>


    <script type="text/javascript">
      tinymce.init({
        selector: '#mytextarea'
      });
      tinymce.init({
        selector: '#mytextarea1'
      });
      tinymce.init({
        selector: '#mytextarea2'
      });
      tinymce.init({
        selector: '#mytextarea3'
      });
    </script>