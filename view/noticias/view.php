<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$noticia = $view->getVariable("noticia");
$errors = $view->getVariable("errors");
$nuevocomentario = $view->getVariable("comentario");
$view->setVariable("title", "Mostrar noticia");
$fecha=date_parse($noticia->getFecha());
$fechanoticia=$fecha["day"]."/".$fecha["month"]."/".$fecha["year"];
$numcomentarios=intval(count($noticia->getComentarios()));
$x=0;
?>
<div class="container my-5 w-75 ">
<h1 class="display-3 titulovideos"><?= $noticia->getTitulo() ?></h1> </a>

<div class="row d-flex  align-items-center  ">
<img class=" img-fluid mx-auto w-50 h-50 mb-5 "   src="images/<?= $noticia->getImagenruta() ?>" alt="Generic placeholder image"> 
          
          <div class="col-md-12  align-items-center mt-5">
          <p class="lead textovideos"><?= nl2br($noticia->getCuerponoticia())?></p>
          <p class="lead textovideos  text-center"><?= $fechanoticia ?></p>
          <?php if( isset($_SESSION['rol']) && $_SESSION['rol']== "administrador"){ ?>
            <button type="button" class="btn btn-warning" onclick="window.location.href='index.php?controller=noticias&amp;action=edit&amp;id=<?=$noticia->getId() ;?>'"><?= i18n("Modificar")?></button>
        <button type="button" class="btn text-center btn-danger " data-toggle="modal" data-target="#modalDeleteNoticia<?=$noticia->getId() ;?>"><?= i18n("Borrar")?></button>
          

          
         
            
        <!-- MODAL ELIMINAR COMENTARIO-->
<div class=" modal fade" id="modalDeleteNoticia<?=$noticia->getId() ;?>" tabindex="-1" role="dialog" aria-labelledby="titleModalDelete" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="col-9 px-0 mx-auto modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModalDelete"><?= i18n("Borrar noticia")?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                  
                <div>
                    <div class="mx-auto px-0 cuerpoModal modal-body ">
                        <p class="p-5"><?= i18n("¿Estás seguro de querer borrar esta noticia y sus comentarios?")?></p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="window.location.href='index.php?controller=noticias&action=delete&id=<?= $noticia->getId()?>'"><?= i18n("Eliminar")?></button>
                        <button type="button" class="btn btn-light " data-dismiss="modal"><?= i18n("Cerrar")?></button>
                        
                    </div>
                </div>

            </div>
        </div>
</div>
          
        <?php 
          }
        if(isset($_SESSION['currentuser'])){?>
       <!-- <section class="content-item" id="comments">-->
        <div class="container mt-5">   
    	<h3 class=" text-center"><?php echo $numcomentarios; if($numcomentarios!=1){ ?> <?= i18n("Comentarios")?> <?php } else{

                ?> <?= i18n("Comentario")?> <?php } ?></h3>
        
                                <form id="contact-form" class=" align-items-center" role="form" action="index.php?controller=comentarios&amp;action=add&id=<?=$noticia->getId()?>" method="POST" onsubmit="return validarformularioComentario()" >
                                <textarea class="form-control mt-5" id="cuerpocoment" name="cuerpocoment" placeholder="Inserte aquí su comentario" ></textarea>
                                <button type="submit" value="submit" class="btn btn-normal pull-right  text-center"><?= i18n("Añadir comentario")?></button>
                                <form>
                                <hr class="mt-5 ">          
            <div class="col-sm-8">   
                
            
                
                
                <?php if(isset($noticia->getComentarios()[0])){ while(isset($noticia->getComentarios()[$x])){ ?>
                <!-- COMMENT - START -->
               
    <div class="card p-3 mt-5">

                        <div class="d-flex justify-content-between align-items-center">

                      <div class="user d-flex flex-row align-items-center">

                        <img src="images/fotoperfilanonimo.png" width="30" class="user-img rounded-circle mr-2">
                        <span><small class="font-weight-bold text-primary"><?=$noticia->getComentarios()[$x]->getUser()->getUsername()?></small> <small class="font-weight-bold"><?=$noticia->getComentarios()[$x]->getCuerpo()?></small></span>
                          
                      </div>


                      <small><?=$noticia->getComentarios()[$x]->getFecha()?></small>

                      </div>


                      <div class="action d-flex justify-content-between mt-2 align-items-center">

                        <div class="reply px-4">
                        <?php if( isset($_SESSION['rol']) && ($_SESSION['rol']== "administrador" || $_SESSION['currentuser']== $noticia->getComentarios()[$x]->getUser()->getEmail() )){ ?>
        <button type="button" class="btn float-r btn-danger " data-toggle="modal" data-target="#modalDeleteComentario<?=$noticia->getComentarios()[$x]->getId() ;?>"><?= i18n("Borrar")?></button>
          

          
         
            
        <!-- MODAL ELIMINAR COMENTARIO-->
<div class=" modal fade" id="modalDeleteComentario<?=$noticia->getComentarios()[$x]->getId() ;?>" tabindex="-1" role="dialog" aria-labelledby="titleModalDelete" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="col-9 px-0 mx-auto modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModalDelete"><?= i18n("Eliminar comentario")?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                  
                <div>
                    <div class="mx-auto px-0 cuerpoModal modal-body ">
                        <p class="p-5"><?= i18n("¿Estás seguro de querer borrar el comentario?")?></p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger " onclick="window.location.href='index.php?controller=comentarios&action=delete&id=<?= $noticia->getComentarios()[$x]->getId()?>'"><?= i18n("Eliminar")?></button>
                        <button type="button" class="btn btn-light " data-dismiss="modal"><?= i18n("Cerrar")?></button>
                        
                    </div>
                </div>

            </div>
        </div>
</div>
<?php } ?>    
                        </div>

                        <div class="icons align-items-center">

                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-check-circle-o check-icon"></i>
                            
                        </div>
                          
                      </div>


                        
                    </div>
                    <?php $x = $x+1;}} ?>
<!-- </section>  --> 
<?php } ?>   
        </div>
        
       
