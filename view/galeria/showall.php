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
  <h3 class="text-uppercase text-center mb-4">Galería</h3>  
  <p class="lead text-center mb-5">Una lista de nuestros mejores momentos.</p>
  <hr class="">

  <?php while($y<=6){ 
    ?> <div class="row justify-content-center"> <?php
  while($x<=2 && isset($fotos[$x+3*$y+20*$pagina])){
    ?>
    
    
    <div class="col-lg-4 column">
              <img src="galeria/<?= $fotos[$x+3*$y+20*$pagina]->getRuta() ?>" onclick="aumentar(this.id)" id="<?=$fotos[$x+3*$y+20*$pagina]->getRuta()?>" alt="Galeria Imagen"> 
              </div>


              <div class="modal fade" id="imgMostrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <img src="galeria/<?= $fotos[$x+3*$y+20*$pagina]->getRuta() ?>"  id="imagenbig" alt="Galeria Imagen"> 

    </div>
  </div>
  </div>
              <script>

function aumentar(id){
  document.getElementById("imagenbig").src="galeria/"+id;
    $('#imgMostrar').modal('toggle');

    }

    



</script>
      <?php
      $x=$x+1;
      
      
    } 
    $y=$y+1; ?> </div>  <?php $x=0;}
      if($pagina!=0){
        $paginaanterior=$pagina-1;  
       ?>

        </section>
      <a href="index.php?controller=galeria&amp;action=showall&amp;pagina=<?=$paginaanterior?>"> <i class=" mt-1   material-icons ">arrow_back</i></a>
      <?php }
      if($pagina<$numpaginas-1){
        $paginasiguiente=$pagina+1;
        ?>
      <a href="index.php?controller=galeria&amp;action=showall&amp;pagina=<?=$paginasiguiente?>"> <i class=" mt-1   material-icons ">arrow_forward</i></a>
      <?php } ?>

      


