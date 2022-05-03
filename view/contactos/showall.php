<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$contactos = $view->getVariable("contactos");
$numcontactos= count($contactos);
$y=0;

 ?>


<div class="container mt-5 mb-5">
<div class ="algright">
<?php if( isset($_SESSION['rol']) && $_SESSION['rol']== "administrador"){ ?>
      <a  href="index.php?controller=contactos&amp;action=add"><i class="ml-2 mt-1 black  material-icons signup">add_circle</i> </a> </div><?php } ?>
<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
<?php while($y < $numcontactos){ ?>	
	<div class="col">
		
		<div class="card radius-15">
			<div class="card-body text-center">
				<div class="p-4 border radius-15">
					<img src="images/<?= $contactos[$y]->getRutafoto() ?>" width="110" height="110" class="rounded-circle shadow" alt="">
					<h5 class="mb-0 mt-5"><?= $contactos[$y]->getNombre() ?> <?= $contactos[$y]->getApellidos() ?></h5>
					<p class="mb-3"><?= $contactos[$y]->getCargo() ?></p>
					<p class="mb-3"><?= $contactos[$y]->getEmail() ?></p>
					<p class="mb-3"><?= $contactos[$y]->getTelefono() ?></p>
					<div class="list-inline contacts-social mt-3 mb-3"> 
						<a href="https://twitter.com/<?= $contactos[$y]->getRutatwitter()  ?>" class="list-inline-item bg-twitter text-white border-0"><i class="bx bxl-twitter"></i></a>
						
					</div>
                    
                    
                    
					<?php if( isset($_SESSION['rol']) && $_SESSION['rol']== "administrador"){ ?>
                        <div class="  w-100">
          <button type="button" class="btn btn-warning" onclick="window.location.href='index.php?controller=contactos&amp;action=edit&amp;id=<?=$contactos[$y]->getId() ;?>'">Editar</button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteContacto<?=$contactos[$y]->getId() ;?>">Borrar</button>
          
                    </div>
        
      
       
            
        <!-- MODAL ELIMINAR Videotutorial-->
    <div class=" modal fade" id="modalDeleteContacto<?=$contactos[$y]->getId() ;?>" tabindex="-1" role="dialog" aria-labelledby="titleModalDelete" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="col-9 px-0 mx-auto modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModalDelete">Eliminar contacto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                  
                <div>
                    <div class="mx-auto px-0 cuerpoModal modal-body ">
                        <p class="p-5">¿Estás seguro de querer borrar "<?=$contactos[$y]->getNombre() ;?> <?=$contactos[$y]->getApellidos() ;?>"?</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="window.location.href='index.php?controller=contactos&action=delete&id=<?=$contactos[$y]->getId() ;?>'">Eliminar</button>
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
    <?php  $y = $y+1;} ?> 
	
	
	</div>
</div>
</div>