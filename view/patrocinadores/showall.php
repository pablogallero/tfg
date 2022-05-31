<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$patrocinadores = $view->getVariable("patrocinadores");
$categorias = $view->getVariable("categorias");
$x=0;
$y=0;
 ?>
<section class="container my-5 py-5">

<h3 class="text-uppercase text-center mb-4"><?= i18n("Patrocinadores")?></h3>
<div class ="algright">
      <a  href="index.php?controller=patrocinadores&amp;action=add"><i class="ml-2 mt-1 black  material-icons signup">add_circle</i> </a> </div>
<table class="table table-hover   ">
  <thead>
    <tr>
      <th scope="col ">Id</th>
      <th scope="col"><?= i18n("Nombre")?></th>
      <th scope="col"><?= i18n("Imagen")?></th>
      <th scope="col"><?= i18n("Categorías")?></th>
      
    </tr>
  </thead>
  <tbody>
   <?php while($x < count($patrocinadores))   { ?>
  <tr >
      <th scope="row" ><?= $patrocinadores[$x]->getId() ?></th>
      <td ><?= $patrocinadores[$x]->getNombre() ?></td>
      <td ><?= $patrocinadores[$x]->getImagen() ?></td>
      <td ><?= $patrocinadores[$x]->getCategoria() ?></td>
      <td> <button type="button" class="btn btn-warning" onclick="window.location.href='index.php?controller=patrocinadores&amp;action=edit&amp;id=<?=$patrocinadores[$x]->getId() ;?>'"><?= i18n("Modificar")?></button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDeletePatrocinador<?=$patrocinadores[$x]->getId() ;?>"><?= i18n("Eliminar")?></button>
          

         
            
        <!-- MODAL ELIMINAR Usuario-->
<div class=" modal fade" id="modalDeletePatrocinador<?=$patrocinadores[$x]->getId() ;?>" tabindex="-1" role="dialog" aria-labelledby="titleModalDelete" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="col-9 px-0 mx-auto modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModalDelete"><?= i18n("Eliminar")?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                  
                <div>
                    <div class="mx-auto px-0 cuerpoModal modal-body ">
                        <p><?= i18n("¿Estás seguro de querer borrar")?> "<?=$patrocinadores[$x]->getNombre() ;?>"?</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger mt-3" onclick="window.location.href='index.php?controller=patrocinadores&action=delete&id=<?= $patrocinadores[$x]->getId()?>'"><?= i18n("Eliminar")?></button>
                        <button type="button" class="btn btn-light " data-dismiss="modal"><?= i18n("Cerrar")?></button>
                        
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

<h3 class="text-uppercase text-center mt-5 mb-4"><?= i18n("Categorías")?></h3>
<div class ="algright">
      <a  href="index.php?controller=patrocinadores&amp;action=addcat"><i class="ml-2 mt-1 black  material-icons signup">add_circle</i> </a> </div>
<table class="table table-hover   ">
  <thead>
    <tr>
      <th scope="col ">Id</th>
      <th scope="col"><?= i18n("Nombre")?></th>
      <th scope="col"><?= i18n("Color")?></th>
      
    </tr>
  </thead>
  <tbody>
   <?php while($y < count($categorias))   { ?>
  <tr >
      <th scope="row" ><?= $categorias[$y]->getId() ?></th>
      <td ><?= $categorias[$y]->getNombre() ?></td>
      <td ><?= $categorias[$y]->getColor() ?></td>
      
      <td> <button type="button" class="btn btn-warning" onclick="window.location.href='index.php?controller=patrocinadores&amp;action=editcat&amp;id=<?=$categorias[$y]->getId() ;?>'"><?= i18n("Modificar")?></button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteCategoria<?=$categorias[$y]->getId() ;?>"><?= i18n("Eliminar")?></button>
          

         
            
        <!-- MODAL ELIMINAR Usuario-->
<div class=" modal fade" id="modalDeleteCategoria<?=$categorias[$y]->getId();?>" tabindex="-1" role="dialog" aria-labelledby="titleModalDelete" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="col-9 px-0 mx-auto modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModalDelete"><?= i18n("Eliminar categoría")?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                  
                <div>
                    <div class="mx-auto px-0 cuerpoModal modal-body ">
                        <p><?= i18n("¿Estás seguro de querer borrar")?> "<?=$categorias[$y]->getNombre() ;?>"?</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger mt-3" onclick="window.location.href='index.php?controller=patrocinadores&action=deletecat&id=<?= $categorias[$y]->getId()?>'"><?= i18n("Eliminar")?></button>
                        <button type="button" class="btn btn-light " data-dismiss="modal"><?= i18n("Cerrar")?></button>
                        
                    </div>
                </div>

            </div>
        </div>
</div>
</div> </td>
      
    </tr>
<?php $y = $y+1;} ?>
    
  </tbody>
</table>
   </section>