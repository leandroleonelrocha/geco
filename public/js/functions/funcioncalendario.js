$(document).ready(function() {

    var hora_desde;
    var grupo_id;
    var docente_id;


    $(".timepicker").timepicker({
        showInputs: false,

    });

	  $.ajax({
	    url: 'process',
	        type: 'POST', // Send post data
	        data: 'type=fetch',
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        async: false,
	        success: function(s){
	         
           console.log(s);
	          json_events = s;
	        }
	  });


    var currentMousePos = {
        x: -1,
        y: -1
    };
      jQuery(document).on("mousemove", function (event) {
          currentMousePos.x = event.pageX;
          currentMousePos.y = event.pageY;
      });

    /* initialize the external events
    -----------------------------------------------------------------*/

        function ini_events(ele) {
          ele.each(function () {

             $(this).data('event', {
		        title: $.trim($(this).text()), // use the element's text as the event title
		        stick: true // maintain when user navigates (see docs on the renderEvent method)
		      });

		      // make the event draggable using jQuery UI
		      $(this).draggable({
		        zIndex: 999,
		        revert: true,      // will cause the event to go back to its
		        revertDuration: 0  //  original position after the drag
		      });

          });
        }
        ini_events($('#external-events div.external-event'));



       /* ADDING EVENTS */
        var currColor = "#3c8dbc"; //Red by default
        //Color chooser button
        var colorChooser = $("#color-chooser-btn");
        $("#color-chooser > li > a").click(function (e) {
          e.preventDefault();
          //Save color
          currColor = $(this).css("color");
          //Add color effect to button
          $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
        });
        $("#add-new-event").click(function (e) {
          e.preventDefault();
          //Get value and make sure it is not null
          var val = $("#new-event").val();
          if (val.length == 0) {
            return;
          }

          //Create events
          var event = $("<div />");
          event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event ui-draggable ui-draggable-handle");
          event.html(val);
          $('#external-events').prepend(event);

          //Add draggable funtionality
          ini_events(event);

          //Remove event from text input
          $("#new-event").val("");
        });


    /*  initialize the calendar
    -----------------------------------------------------------------
        Datos del grupo
        Hora de la clase
    */    
    

    $('#calendar').fullCalendar({
      events: JSON.parse(json_events),
     

      utc: true,
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      editable: true,
      droppable: true, 
      slotDuration: '00:30:00',
      // Nuevo evento 
      eventReceive: function(event){
        var grupo_id = $( "#grupo_idselected option:selected" ).val();
        var title = event.title;
        var start = event.start.format("YYYY-MM-DD");
        var docente_id = $( "#docente_idselected option:selected" ).val();
        var dia = 1;
        var hora_desde = $('.timepicker').val();
        var hora_hasta = $('.timepicker').val();      
        $.ajax({
            url: 'process',
            data: 'type=new&grupo_id='+grupo_id+'&fecha='+start+'&descripcion='+title+'&docente_id='+docente_id+'&hora_desde='+hora_desde+'&hora_hasta='+hora_hasta,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            dataType: 'json',
            success: function(response){
              event.id = response.eventid;
              $('#calendar').fullCalendar('updateEvent',event);
              getFreshEvents();
            },
            error: function(e){
              console.log(e.responseText);

            }
          });
        $('#calendar').fullCalendar('updateEvent',event);
        console.log(event);
      },

      eventDrop: function(event, delta, revertFunc) {
            var title = event.title;
            var start = event.start.format();
            
            console.log(event.start);
            var end = (event.end == null) ? start : event.end.format();
            $.ajax({
          url: 'process',
          data: 'type=resetdate&title='+title+'&start='+start+'&end='+end+'&eventid='+event.id,
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST',
          dataType: 'json',
          success: function(response){
            if(response.status != 'success')                
            revertFunc();
          },
          error: function(e){             
            revertFunc();
            alert('Error processing your request: '+e.responseText);
          }
        });
        },
        eventClick: function(event, jsEvent, view) {
          	console.log(event.id);

           var data = event.id;
          window.location=("clases/matricula/" + data);
      },

      eventResize: function(event, delta, revertFunc) {
        console.log(event);
        var title = event.title;
        var end = event.end.format();
        var start = event.start.format();
            $.ajax({
          url: 'process',
          data: 'type=resetdate&title='+title+'&start='+start+'&end='+end+'&eventid='+event.id,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST',
          dataType: 'json',
          success: function(response){
            if(response.status != 'success')                
            revertFunc();
          },
          error: function(e){             
            revertFunc();
            alert('Error processing your request: '+e.responseText);
          }
        });
        },

      eventDragStop: function (event, jsEvent, ui, view) {
          if (isElemOverDiv()) {
            var con = confirm('Are you sure to delete this event permanently?');
            if(con == true) {
            $.ajax({
                url: 'process',
                data: 'type=remove&eventid='+event.id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                dataType: 'json',
                success: function(response){
                  console.log(response);
                  if(response.status == 'success'){
                    $('#calendar').fullCalendar('removeEvents');
                        getFreshEvents();
                      }
                },
                error: function(e){ 
                  alert('Error processing your request: '+e.responseText);
                }
              });
          }   
        }
      }
    });

  function getFreshEvents(){
    $.ajax({
      url: 'process',
          type: 'POST', // Send post data
          data: 'type=fetch',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          async: false,
          success: function(s){
            freshevents = s;
          }
    });
    $('#calendar').fullCalendar('addEventSource', JSON.parse(freshevents));
  }


  function isElemOverDiv() {
        var trashEl = jQuery('#trash');

        var ofs = trashEl.offset();

        var x1 = ofs.left;
        var x2 = ofs.left + trashEl.outerWidth(true);
        var y1 = ofs.top;
        var y2 = ofs.top + trashEl.outerHeight(true);

        if (currentMousePos.x >= x1 && currentMousePos.x <= x2 &&
            currentMousePos.y >= y1 && currentMousePos.y <= y2) {
            return true;
        }
        return false;
    }

  });
