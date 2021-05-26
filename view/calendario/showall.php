<?php


require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();


 ?>

<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col-lg-7"><div id="CalendarioWeb"> </div></div>
        <div class="col"></div>

<script>
    $(document).ready(function(){
      $('#CalendarioWeb').fullCalendar();
    });
    
</script>

