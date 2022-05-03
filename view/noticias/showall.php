<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$noticias = $view->getVariable("noticiasall");
$numpaginas= intval(count($noticias)/4);
if(count($noticias)%4 != 0){
$numpaginas=$numpaginas+1;
}
$pagina=$_GET["pagina"];
$x=0;
 ?>



<section class="container my-5 py-5">
  <h3 class="text-uppercase text-center mb-4">NOTICIAS</h3>
  <p class="lead text-center mb-5">Aquí encontrarás las noticias relacionadas con la organización.</p>  
  <?php if( isset($_SESSION['rol']) && $_SESSION['rol']== "administrador"){ ?>
          <div class ="algright">
      <a  href="index.php?controller=noticias&amp;action=add"><i class="ml-2 mt-1 black  material-icons signup">add_circle</i> </a> </div><?php } ?>  
  <hr class="">
  </section>
  <!-- fin Cards -->
  <!-- START THE FEATURETTES -->
  <div class="container my-5">
  <div class="row">
  <?php  if(isset($noticias[$x+4*$pagina])){ ?>
    <div class="col-md-7   d-flex ">
    
    <div class="row " >
    
    <img class=" img-fluid mx-auto w-85 h-85"  src="images/<?= $noticias[$x+4*$pagina]->getImagenruta() ?>" alt="Generic placeholder image">
    <div class="texto-encima ">
    <a class="linkblanco" href="index.php?controller=noticias&action=view&id=<?= $noticias[$x+4*$pagina]->getId()?>">   <h2 class="display-5"><?= $noticias[$x+4*$pagina]->getTitulo() ?></h2> </a>
  
            
  </div>
  
  </div>
    
            
          
          </div>
                   
          <div class="col-md-4 ml-3 d-wrapper ">
          
  <?php }; $x=$x+1 ;while($x<=3 && isset($noticias[$x+4*$pagina])){?>
      
        
    
        
    <div class="row ">
    
    <img class=" img-fluid mx-auto w-50 h-50 mb-4 "   src="images/<?= $noticias[$x+4*$pagina]->getImagenruta() ?>" alt="Generic placeholder image">
            
    <a class="mt-auto mb-auto linknegro " href="index.php?controller=noticias&action=view&id=<?= $noticias[$x+4*$pagina]->getId()?>"> <h4 class="display-5  ml-4 textoverflow"><?= $noticias[$x+4*$pagina]->getTitulo() ?></h4></a>
            
  </div>
  
        
         

          
         
        
        
      
      <?php $x=$x+1; }?>
  </div>
      </div>
      
      <?php 
      if($pagina!=0){
        $paginaanterior=$pagina-1;  
       ?>
       
       
       
       
      <a class="floatleft ml-4 mt-2" href="index.php?controller=noticias&amp;action=showall&amp;pagina=<?=$paginaanterior?>"><i class=" mt-1   material-icons ">arrow_back</i></a>
      <?php }
      if($pagina<$numpaginas-1){
        $paginasiguiente=$pagina+1;
        ?>
      <a class="floatright mr-5 mt-2" href="index.php?controller=noticias&amp;action=showall&amp;pagina=<?=$paginasiguiente?>"><i class="ml-2 mt-1  material-icons">arrow_forward</i></a>
      <?php } ?>

      </div>
      </div>
