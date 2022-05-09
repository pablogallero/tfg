<!-- add calander in this div -->
<div class="container mt-5 mb-5">

<div id="calendar"></div>

</div>


<!-- Modal  to Add Event -->
<div id="createEventModal" class="modal fade" role="dialog">
 <div class="modal-dialog">

 <!-- Modal content-->
 <div class="modal-content">
 <div class="modal-header">
 <button type="button" class="close" data-dismiss="modal">×</button>
 <h4 class="modal-title">Add Event</h4>
 </div>
 <div class="modal-body">
 <div class="control-group">
 <label class="control-label" for="inputPatient">Event:</label>
 <div class="field desc">
 <input class="form-control" id="title" name="title" placeholder="Event" type="text" value="">
 </div>
 </div>
 
 <input type="hidden" id="startTime"/>
 <input type="hidden" id="endTime"/>
 
 
 
 <div class="control-group">
 <label class="control-label" for="when">When:</label>
 <div class="controls controls-row" id="when" style="margin-top:5px;">
 </div>
 </div>
 
 </div>
 <div class="modal-footer">
 <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
 <button type="submit" class="btn btn-primary" id="submitButton">Save</button>
 </div>
 </div>

 </div>
</div>

<!-- Modal to Event Details -->
<div id="calendarModal" class="modal fade">
<div class="modal-dialog">
 <div class="modal-content">
 <div class="modal-header">
 <button type="button" class="close" data-dismiss="modal">×</button>
 <h4 class="modal-title">Event Details</h4>
 </div>
 <div id="modalBody" class="modal-body">
 <h4 id="modalTitle" class="modal-title"></h4>
 <div id="modalWhen" style="margin-top:5px;"></div>
 </div>
 <input type="hidden" id="eventID"/>
 <div class="modal-footer">
 <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
 <button type="submit" class="btn btn-danger" id="deleteButton">Delete</button>
 </div>
 </div>
</div>
</div>
<!--Modal-->