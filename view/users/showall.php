<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$usuarios = $view->getVariable("usuarios");

$x=0;

 ?>
<section class="container my-5 py-5">
<div class ="algright">
      <a  href="index.php?controller=users&amp;action=add"><i class="ml-2 mt-1 black  material-icons signup">add_circle</i> </a> </div>
<table class="table table-hover   ">
  <thead>
    <tr>
      <th scope="col ">Id</th>
      <th scope="col">Email</th>
      <th scope="col">Rol</th>
      
    </tr>
  </thead>
  <tbody>
   <?php while($x < count($usuarios))   { ?>
  <tr >
      <th scope="row" onclick="window.location.href='index.php?controller=users&amp;action=view&amp;id=<?=$usuarios[$x]->getId() ;?>'"><?= $usuarios[$x]->getId() ?></th>
      <td onclick="window.location.href='index.php?controller=users&amp;action=view&amp;id=<?=$usuarios[$x]->getId() ;?>'"><?= $usuarios[$x]->getEmail() ?></td>
      <td onclick="window.location.href='index.php?controller=users&amp;action=view&amp;id=<?=$usuarios[$x]->getId() ;?>'"><?= $usuarios[$x]->getRol() ?></td>
      <td> <button type="button" class="btn btn-warning" onclick="window.location.href='index.php?controller=users&amp;action=edit&amp;id=<?=$usuarios[$x]->getId() ;?>'">Modificar</button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteUser<?=$usuarios[$x]->getId() ;?>">Eliminar</button>
          

         
            
        <!-- MODAL ELIMINAR Usuario-->
<div class=" modal fade" id="modalDeleteUser<?=$usuarios[$x]->getId() ;?>" tabindex="-1" role="dialog" aria-labelledby="titleModalDelete" aria-hidden="true">
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
                        <p>¿Estás seguro de querer borrar "<?=$usuarios[$x]->getEmail() ;?>"?</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger mt-3" onclick="window.location.href='index.php?controller=users&action=delete&id=<?= $usuarios[$x]->getId()?>'">Eliminar</button>
                        <button type="button" class="btn btn-light " data-dismiss="modal">Cerrar</button>
                        
                    </div>
                </div>

            </div>
        </div>
</div>
</div> </td>
      
    </tr>
<?php $x = $x+1;} ?>
    
  </tbody>
</table>
   </section>