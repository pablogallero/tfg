<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$fotos = $view->getVariable("fotos");
$numpaginas= intval(count($fotos)/20);
if(count($fotos)%20 != 0){
$numpaginas=$numpaginas+1;
}
$pagina=$_GET["pagina"];
$x=0;
$y=0;
$fila=0;
 ?>



<section class="container galeria my-5 py-5">
  <h3 class="text-uppercase text-center mb-4"><?= i18n("Galería")?></h3>  
  <p class="lead text-center mb-5"><?= i18n("Una lista de nuestros mejores momentos.") ?></p>
  <?php if( isset($_SESSION['rol']) && $_SESSION['rol']== "administrador"){ ?>
      <a  href="index.php?controller=galeria&amp;action=add"><i class="ml-2 mt-1 black  material-icons signup">add_circle</i> </a> </div><?php } ?> 
  <hr class="">

  <?php while($y<=6){ 
    ?> <div class="row justify-content-center"> <?php
  while($x<=2 && isset($fotos[$x+3*$y+20*$pagina])){
    ?>
    
    
    <div class="col-lg-4 column">
              <img src="galeria/<?= $fotos[$x+3*$y+20*$pagina]->getRuta() ?>" <?php if(!isset($_SESSION['rol']) || $_SESSION['rol']!="administrador"){ ?> onclick="aumentar(this.id)" <?php } else{ ?>onclick="aumentarAdmin(this.id)" <?php } ?> id="<?=$fotos[$x+3*$y+20*$pagina]->getRuta()?>" alt="Galeria Imagen"> 
              </div>


              <div class="modal fade" id="imgMostrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modalgaleria" role="document">
    <div class="modal-content modalgaleria ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <img  id="imagenbig" alt="Galeria Imagen" > 
      
    </div>
   
        </div>
        </div>



        <div class="modal fade" id="imgMostrarDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modalgaleria" role="document">
    <div class="modalgaleria modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <img  id="imagenbigadmin"   alt="Galeria Imagen"> 
      
    
    <div class="modal-footer">
    <button type="button" class="btn btn-danger" id="botonborrar" ><?= i18n("Eliminar")?></button>
   
          </div>
          
       
       
            
        <!-- MODAL ELIMINAR Videotutorial-->

        </div>
  </div>
  </div>
<script>

function aumentar(id){
  document.getElementById("imagenbig").src="galeria/"+id;
  

    $('#imgMostrar').modal('toggle');

    }

    
function aumentarAdmin(id){
  document.getElementById("imagenbigadmin").src="galeria/"+id;
  document.getElementById("botonborrar").onclick= function(){window.location.href="index.php?controller=galeria&action=delete&imagen="+id};
  
    $('#imgMostrarDelete').modal('toggle');

    }

    


</script>
      <?php
      $x=$x+1;
      
      
    } 
    $y=$y+1; ?> </div>  <?php $x=0;}
      if($pagina!=0){
        $paginaanterior=$pagina-1;  
       ?>

       
      <a class="floatleft ml-5 mb-2" href="index.php?controller=galeria&amp;action=showall&amp;pagina=<?=$paginaanterior?>"> <i class=" mt-1   material-icons ">arrow_back</i></a>
      <?php }
      if($pagina<$numpaginas-1){
        $paginasiguiente=$pagina+1;
        ?>
      <a class="floatright mr-5 mt-2" href="index.php?controller=galeria&amp;action=showall&amp;pagina=<?=$paginasiguiente?>"> <i class=" ml-2 mt-1   material-icons ">arrow_forward</i></a>
      <?php } ?>

      </section> 


