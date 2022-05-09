<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$proyectos = $view->getVariable("proyectos");
$numproyectos= count($proyectos);
$y=0;

 ?>


<div class="container mt-5 mb-5">
<div class ="algright">
<?php if( isset($_SESSION['rol']) && $_SESSION['rol']== "administrador"){ ?>
      <a  href="index.php?controller=proyectos&amp;action=add"><i class="ml-2 mt-1 black  material-icons signup">add_circle</i> </a> </div><?php } ?>
<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
<?php// while($y < $proyectos){ ?>	
	<div class="col">
		
		<div class="card radius-15">
			<div class="card-body text-center">
				<div class="p-4 border radius-15">
					<img src="images/galeria.webp" width="110" height="110" class="rounded-circle shadow" alt="">
					<h5 class="mb-0 mt-5">Titulo</h5>
					<p class="mb-3 textoverflowl">Esta es una pedazo de descripcion muy grande enorme, de locos pa rayarse completamente</p>
					<button type="button" class="btn btn-success btnreadmore" onclick="window.location.href='index.php?controller=proyectos&amp;action=view&amp;id=<?=$proyectos[$y]->getId();?>'">Leer más >></button>
                    
                    
                    
					<?php if( isset($_SESSION['rol']) && $_SESSION['rol']== "administrador"){ ?>
                        <div class="  w-100">
          <button type="button" class="btn btn-warning" onclick="window.location.href='index.php?controller=proyectos&amp;action=edit&amp;id=<?=$proyectos[$y]->getId() ;?>'">Editar</button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteProyecto<?=$proyectos[$y]->getId() ;?>">Borrar</button>
          
                    </div>
        
      
       
            
        <!-- MODAL ELIMINAR Videotutorial-->
    <div class=" modal fade" id="modalDeleteProyecto<?=$proyectos[$y]->getId() ;?>" tabindex="-1" role="dialog" aria-labelledby="titleModalDelete" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="col-9 px-0 mx-auto modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModalDelete">Eliminar proyecto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                  
                <div>
                    <div class="mx-auto px-0 cuerpoModal modal-body ">
                        <p class="p-5">¿Estás seguro de querer borrar ""?</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="window.location.href='index.php?controller=proyectos&action=delete&id=<?=$proyectos[$y]->getId() ;?>'">Eliminar</button>
                        <button type="button" class="btn btn-light " data-dismiss="modal">Cerrar</button>
                        
                    </div>
					
				</div>
                
			</div>
            
		</div>
        
	</div>
    <?php  }?>
    </div>     
    </div>
    </div>
    </div>
    <?php // $y = $y+1;} ?> 
	
	
	</div>
</div>
</div>