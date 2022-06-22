<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$calendario = $view->getVariable("events");
$x=0;
 ?>
 <!-- Button trigger modal -->

<!-- Modal -->
<?php if(isset($_SESSION["rol"]) && $_SESSION["rol"]=="administrador"){ ?>
<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?= i18n("Añadir evento")?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="index.php?controller=calendario&amp;action=add" onsubmit="return validarformulariocalendarioadd()" method="POST">
      <div class="modal-body">
      <label for="exampleColorInput" class="form-label"><?= i18n("Título")?></label>
        <input type="text" class="form-control mb-4" id="title" onblur="validarVacio(this.id)" name="title">
        <label for="exampleColorInput" class="form-label"><?= i18n("Color")?></label>
        <input type="color" class="mb-4" value="#5fc500"  id="color" name="color">
        <br>
        <label for="exampleColorInput" class="form-label"><?= i18n("Fecha inicio")?></label>
        <input type="text" class="form-control mb-4"  id="start_datef" name="start_date">
        <label for="exampleColorInput" class="form-label"><?= i18n("Fecha fin")?></label>
        <input type="text" class="form-control mb-4"  id="end_datef" name="end_date">
        <label for="exampleColorInput" class="form-label"><?= i18n("Hora inicio")?></label>
        <input type="time" class="form-control mb-4"  id="start_hourf" name="start_hour">
        <label for="exampleColorInput" class="form-label"><?= i18n("Hora fin")?></label>
        <input type="time" class="form-control mb-4"  id="end_hourf" name="end_hour">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><?= i18n("Cerrar")?></button>
        <button type="submit" id="saveBtn" class="btn btn-success"><?= i18n("Añadir")?></button>
      </div>
</form>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?= i18n("Modificar evento")?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="index.php?controller=calendario&amp;action=edit" onsubmit="return validarformulariocalendarioedit()" method="POST">
      <div class="modal-body">
      <label for="exampleColorInput" class="form-label">Id</label>
      <input type="text" class="form-control mb-4" readonly id="ided" name="ided">
      <label for="exampleColorInput" class="form-label"><?= i18n("Título")?></label>
        <input type="text" class="form-control mb-4" onblur="validarVacio(this.id)" id="titleed" name="titleed">
        <label for="exampleColorInput" class="form-label"><?= i18n("Color")?></label>
        <input type="color" class=" mb-4"   id="colored" name="colored">
        <br>
        <label for="exampleColorInput" class="form-label"><?= i18n("Fecha inicio")?></label>
        <input type="text" class="form-control mb-4"  id="start_dateed" name="start_dateed">
        <label for="exampleColorInput" class="form-label"><?= i18n("Fecha fin")?></label>
        <input type="text" class="form-control mb-4"  id="end_dateed" name="end_dateed">
        <label for="exampleColorInput" class="form-label"><?= i18n("Hora inicio")?></label>
        <input type="time" class="form-control mb-4"  id="start_houred" name="start_houred">
        <label for="exampleColorInput" class="form-label"><?= i18n("Hora fin")?></label>
        <input type="time" class="form-control mb-4"  id="end_houred" name="end_houred">
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><?= i18n("Cerrar")?></button>
        <button type="submit" id="saveBtn" class="btn btn-success"><?= i18n("Editar")?></button>
      </div>
</form>
    </div>
  </div>
</div>
<?php } ?>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?= i18n("Eliminar evento")?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="index.php?controller=calendario&amp;action=edit" onsubmit="return validarformulariocalendariodel()" method="POST">
      <div class="modal-body">
      <label for="exampleColorInput" class="form-label">Id</label>
      <input type="text" class="form-control mb-4" readonly id="iddel" name="ided">
      <label for="exampleColorInput" class="form-label"><?= i18n("Título")?></label>
        <input type="text" class="form-control mb-4" onblur="validarVacio(this.id)" id="titledel" name="titleed">
        <label for="exampleColorInput" class="form-label"><?= i18n("Color")?></label>
        <input type="color" class=" mb-4"   id="colordel" name="colored">
        <br>
        <label for="exampleColorInput" class="form-label"><?= i18n("Fecha inicio")?></label>
        <input type="text" class="form-control mb-4"  id="start_datedel" name="start_dateed">
        <label for="exampleColorInput" class="form-label"><?= i18n("Fecha fin")?></label>
        <input type="text" class="form-control mb-4"  id="end_datedel" name="end_dateed">
        <label for="exampleColorInput" class="form-label"><?= i18n("Hora inicio")?></label>
        <input type="time" class="form-control mb-4"  id="start_hourdel" name="start_houred">
        <label for="exampleColorInput" class="form-label"><?= i18n("Hora fin")?></label>
        <input type="time" class="form-control mb-4"  id="end_hourdel" name="end_houred">
        

      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><?= i18n("Cerrar")?></button>
        <button type="submit" id="saveBtn" class="btn btn-success"><?= i18n("Editar")?></button>
        <a id="adelete"> <button type="button" id="btndelete" class="btn btn-warning" ><?= i18n("Borrar")?></button></a>
      </div>
</form>
    </div>
  </div>
</div>
<!-- add calander in this div -->
<div class="container mt-5 mb-5">

<div id="calendar">


</div>

</div>




</div>

<?php if( isset($_SESSION['rol']) && $_SESSION['rol']== "administrador"){ ?>
<script>

$(document).ready(function() {
var booking= <?php echo json_encode($calendario); ?>;

    $('#calendar').fullCalendar({
events: booking,
selectable:true,
selectHelper:true,
select: function(start,end,allDays){
    var start_date= moment(start).format('YYYY-MM-DD');
    var end_date= moment(end).format('YYYY-MM-DD');
    var start_hour = moment(start).format('HH:mm:ss');
        
        var end_hour = moment(end).format('HH:mm:ss');
    document.getElementById("start_datef").value = start_date;
    document.getElementById("end_datef").value = end_date;
    document.getElementById("start_hourf").value = start_hour;
    document.getElementById("end_hourf").value = end_hour;
    $('#bookingModal').modal('toggle');
    
   
},
editable:true,
eventDrop:function(event){
    var id= event.id;
    
    var start_date = moment(event.start).format('YYYY-MM-DD');
   
    var end_date= moment(event.end).format('YYYY-MM-DD');
    var start_hour = moment(event.start).format('HH:mm:ss');
        
        var end_hour = moment(event.end).format('HH:mm:ss');
    var title= event.title;
    var color =event.color;
    
    document.getElementById("ided").value = id;
    document.getElementById("titleed").value = title;
    document.getElementById("colored").value = color.replace(' ','');
    
    console.log(document.getElementById("colored").value.replace(' ',''));
  
    document.getElementById("start_dateed").value = start_date;
    document.getElementById("end_dateed").value = end_date;
    document.getElementById("start_houred").value = start_hour;
    document.getElementById("end_houred").value = end_hour;
   
    $('#editModal').modal('toggle');
    
    
},
eventClick:function(event){
    var id= event.id;
    var title= event.title;
    var color = event.color;
    var start_date = moment(event.start).format('YYYY-MM-DD');
   
    var end_date= moment(event.end).format('YYYY-MM-DD');
    var start_hour = moment(event.start).format('HH:mm:ss');
        
        var end_hour = moment(event.end).format('HH:mm:ss');
    document.getElementById("iddel").value = id;
    document.getElementById("titledel").value = title;
    document.getElementById("colordel").value = color.replace(' ','');
    document.getElementById("start_datedel").value = start_date;
    document.getElementById("end_datedel").value = end_date;
    document.getElementById("start_hourdel").value = start_hour;
    document.getElementById("end_hourdel").value = end_hour;
    document.getElementById("adelete").href = 'index.php?controller=calendario&action=delete&id='+id;
    
    $('#deleteModal').modal('toggle');
}
    })

    
}) 


</script>
 <?php } else{?>

  <script>

$(document).ready(function() {
var booking= <?php echo json_encode($calendario); ?>;

    $('#calendar').fullCalendar({
events: booking,
selectable:true,
selectHelper:true})})
</script>
<?php  }?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalComprobacion"><?= i18n("Error de validación")?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="parrafovalidacion"> </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><?= i18n("Cerrar")?></button>
        
      </div>
    </div>
  </div>
</div>