<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$calendario = $view->getVariable("events");
$x=0;
 ?>
 <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Añadir evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="index.php?controller=calendario&amp;action=add" method="POST">
      <div class="modal-body">
        <input type="text" class="form-control mb-4" id="title" name="title">
        <label for="exampleColorInput" class="form-label">Color</label>
        <input type="color" class="form-control"  id="color" name="color">
        <input type="text" class="form-control mt-3" readonly id="start_datef" name="start_date">
        <input type="text" class="form-control mt-3" readonly id="end_datef" name="end_date">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
        <button type="submit" id="saveBtn" class="btn btn-success">Añadir</button>
      </div>
</form>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="index.php?controller=calendario&amp;action=edit" method="POST">
      <div class="modal-body">
      <label for="exampleColorInput" class="form-label">Id</label>
      <input type="text" class="form-control mb-4" readonly id="ided" name="ided">
      <label for="exampleColorInput" class="form-label">Titulo</label>
        <input type="text" class="form-control mb-4" id="titleed" name="titleed">
        <label for="exampleColorInput" class="form-label">Color</label>
        <input type="color" class="form-control"  id="colored" name="colored">
        <input type="text" class="form-control mt-3" readonly id="start_dateed" name="start_dateed">
        <input type="text" class="form-control mt-3" readonly id="end_dateed" name="end_dateed">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
        <button type="submit" id="saveBtn" class="btn btn-success">Editar</button>
      </div>
</form>
    </div>
  </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="index.php?controller=calendario&amp;action=delete" method="POST">
      <div class="modal-body">
      <label for="exampleColorInput" class="form-label">Id</label>
      <input type="text" class="form-control mb-4" readonly id="iddel" name="iddel">
      <label for="exampleColorInput" class="form-label">Titulo</label>
        <input type="text" class="form-control mb-4" readonly id="titledel" name="titledel">
        <label for="exampleColorInput" class="form-label">Color</label>
        <input type="color" class="form-control"  id="colordel" readonly name="colordel">
        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
        <button type="submit" id="saveBtn" class="btn btn-warning">Borrar</button>
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
    document.getElementById("start_datef").value = start_date;
    document.getElementById("end_datef").value = end_date;
    $('#bookingModal').modal('toggle');
    
   
},
editable:true,
eventDrop:function(event){
    var id= event.id;
    
    var start_date = moment(event.start).format('YYYY-MM-DD');
    var end_date= moment(event.end).format('YYYY-MM-DD');
    var title= event.title;
    var color = event.color;
    document.getElementById("ided").value = id;
    document.getElementById("titleed").value = title;
    document.getElementById("start_dateed").value = start_date;
    document.getElementById("end_dateed").value = end_date;
    document.getElementById("colored").value = color;
    $('#editModal').modal('toggle');
    
    
},
eventClick:function(event){
    var id= event.id;
    var title= event.title;
    var color = event.color;
    
    document.getElementById("iddel").value = id;
    document.getElementById("titledel").value = title;
    document.getElementById("colordel").value = color;
    $('#deleteModal').modal('toggle');
}
    })

    
}) 


</script>