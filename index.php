<!DOCTYPE html>
<html lang="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Title Page</title>
  
  <!-- font-awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
  <!-- Bootstrap JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- jQueryUi -->
  <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script-->

  <link rel="stylesheet" href="fullcalendar/fullcalendar.min.css">
  <link rel="stylesheet" href="fullcalendar/fullcalendar.print.css" media="print">
  <link rel="stylesheet" href="custom.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>

  <div class="container-fluid">
    <button id="b" class="btn-dark rounded mt-3">Information</button>
    <hr>

    <div class="row">
      <div class="col-md-4" style="margin-bottom: 50px;">
        <div class="card"> 

          <!-- choice a color -->
          <div class="row m-2">
            <!--div class="col-md-2">
              <label for="color" class="control-label">Color</label>
            </div-->
            <div class="col-md-12">
              <select name="color" class="form-control" id="color">
                <option value="">Choose Color</option>
                <option style="color:#0071c5;" value="#0071c5"> &#9899; Blue</option>
                <option style="color:#2E716A;" value="#2E716A"> &#9899;Teal</option>
                <option style="color:#00a65a;" value="#00a65a;"> &#9899; Green</option>
                <option style="color:#FF8C00;" value="#FF8C00"> &#9899; Orange</option>
                <option style="color:#CA0202;" value="#CA0202"> &#9899; Dark Red</option>
                <option style="color:#f56954;" value="#f56954">  &#9899; Lite Red</option>     
              </select>
            </div>
          </div>


          <!-- how to use -->
          <div class="row"  id="how" style="display: none">
            <div class="col-md-12">
              <ol class='text-info list-group'>
                <li class='list-group-item list-group-item-dark'> <i class="fa fa-info-circle"></i> You must change the color.The default color is blue.</li>
                <li class='list-group-item list-group-item-info'> <i class="fa fa-info-circle"></i> Click on the Date to Insert Event.</li>
                <li class='list-group-item list-group-item-danger'> <i class="fa fa-info-circle"></i> Drag on the Date to Insert Event in Mulitple Date.</li>
                <li class='list-group-item list-group-item-success'> <i class="fa fa-info-circle"></i> Click on the Event to Edit Event.</li>
                <li class='list-group-item list-group-item-primary'> <i class="fa fa-info-circle"></i> Resize Event to Update Event.</li>
                <li class='list-group-item list-group-item-warning'> <i class="fa fa-info-circle"></i> Move the Event to Update Event.</li>
                <li class='list-group-item list-group-item-danger'> <i class="fa fa-info-circle"></i> Right Click on the Event to Delete.</li>
              </ol>
            </div>
          </div>
                   
        </div>
      </div>

      <div class="col-md-8">
        <div id="calendar"></div>
      </div>

      

    </div>
  </div>

        
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="fullcalendar/fullcalendar.min.js"></script>
</html>

<script>
  
  $(document).ready(function($) {
    $("#b").click(function(event) {
      /* Act on the event */
      $( "#how" ).toggle( "slide", { direction: "up" }, 1000);
    });
    
  });     

</script>
  

  
<script>
   
   $(document).ready(function() {
    var calendar = $('#calendar').fullCalendar({
     theme: true,    
     themeSystem:'bootstrap4',   
     height:500,
     editable:true,
     eventLimit: true,
     header: {
        left: 'prevYear,prev,next,nextYear today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek'
    },
    customButtons: {
        ForwardButton: {
            icon: "right-single-arrow",
        },
        BackwardButton: {
            icon: "left-single-arrow",
        }
    },
     events: 'action.php',
     selectable:true,
     selectHelper:true,
     select: function(startDate, endDate, allDay)
     {
        var title = prompt("Enter Event Title");
        if(title){
                var start = startDate.format();
                var end = endDate.format();
                var color = $("#color").val();
                $.ajax({
                url:"crud.php",
                type:"POST",
                data:{title:title, start:start, end:end,color:color, insert:'0k'},
                success:function()
                {
                    calendar.fullCalendar('refetchEvents');
                }
                })
        }
     },
     editable:true,
     eventResize:function(event)
     {
      var start= moment(event.start).format('YYYY/MM/DD');
      var end= moment(event.end).format('YYYY/MM/DD');
      var title = event.title;
      var id = event.id;
      var color = $("#color").val();
      $.ajax({
       url:"crud.php",
       type:"POST",
       data:{title:title, start:start, end:end, id:id,  update:'ok'},
       success:function(){
        calendar.fullCalendar('refetchEvents');
       }
      })
     },
 
     eventDrop:function(event)
     {
       var start= moment(event.start).format('YYYY/MM/DD');
       var end= moment(event.end).format('YYYY/MM/DD');
      var title = event.title;
      var id = event.id;
      var color = $("#color").val();
      $.ajax({
       url:"crud.php",
       type:"POST",
       data:{title:title, start:start, end:end, id:id, update:'ok'},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
       }
      });
     },
 
     eventClick:function(event)
     {
                var start = moment(event.start).format('YYYY/MM/DD');
                var end = moment(event.end).format('YYYY/MM/DD');
                var id = event.id;
                var color = $("#color").val();
                var title = prompt("Enter New Event Title");
                if(title){
                $.ajax({
                url:"crud.php",
                type:"POST",
                data:{title:title, start:start, end:end, id:id,color:color, update:'ok'},
                success:function()
                {
                    calendar.fullCalendar('refetchEvents');
                }
                });
                }
     },
     droppable : true,
     drop: function(date){
        var originalEventObject = $(this).data('eventObject');
        var copiedEventObject = $.extend({}, originalEventObject);
        var title = copiedEventObject.title;
        copiedEventObject.backgroundColor = $(this).css('background-color');
        var color = copiedEventObject.backgroundColor;
            $.ajax({
                url:"crud.php",
                type:"POST",
                data:{title:title, start:date.format(),color:color, insert:'0k'},
                success:function()
                {
                    calendar.fullCalendar('refetchEvents');
                }
                })
        if ($('#drop-remove').is(':checked')) { 
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
          var id = $(this).attr('tanboe');
          $.ajax({
                url:"crud.php",
                type:"POST",
                data:{id:id, delete_event:'ok'},
                success:function()
                {
                ele.remove();
                }
            })
        }
     },
     eventRender: function (event, element) {
        element.bind('mousedown', function (e) {
            if (e.which == 3) {
            if(confirm("Are you sure you want to remove it?"))
            {
            var id = event.id;
            $.ajax({
                url:"crud.php",
                type:"POST",
                data:{id:id, delete:'ok'},
                success:function()
                {
                calendar.fullCalendar('refetchEvents');
                }
            })
            }
            }
        });
    }
    });
   });
   
   </script>