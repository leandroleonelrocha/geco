@extends('template')

@section('css')
    <link rel="stylesheet" href="{{asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
@endsection

@section('content')
	
	<div class="row">
	
             <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-body no-padding">
                  <!-- THE CALENDAR -->
                  <div id="calendar"></div>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->

	</div>

@endsection

@include('rol_filial.grupos.partials.nueva_clase_modal')
@include('rol_filial.grupos.partials.editar_clase_modal')


@section('js')

<script src="{{asset('js/calendario/moment.min.js') }}"></script>
<script src="{{asset('js/calendario/fullcalendar.min.js') }}"></script>
<script src="{{asset('plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>

<script>

	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        	monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
     	    dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
    		dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			selectable: true,
			selectHelper: true,
			select: function(start, end) {
				
				$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd').modal('show');
			},
			eventRender: function(event, element) {
				element.bind('dblclick', function() {
					var id = event.id;
					console.log(event);
					var url = "clases/matricula/"+id;
					var urlborrar = "clases/borrar_clase/"+id;
					//document.getElementById("mylink").href = url;

					$('#ModalEdit #id').val(event.id);
					$('#ModalEdit #descripcion').val(event.title);
					$('#ModalEdit #color').val(event.color);

					$('#ModalEdit #clase_matricula').attr('href', url );
					$('#ModalEdit #clase_borrar').attr('href', urlborrar );


					//window.location=("clases/matricula/" + data);
					$('#ModalEdit').modal('show');
				});
			},
			eventDrop: function(event, delta, revertFunc) { // si changement de position

				edit(event);


			},
			
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

				edit(event);

			},
			events: [
			<?php foreach($events as $event): 
							
				$start = explode(" ", $event['fecha']);

				$end = explode(" ", $event['fecha']);
				if($start[1] == '00:00:00'){
					$start = $start[0];
				}else{
					$start = $event['fecha'];
				}
				if($end[1] == '00:00:00'){
					$end = $end[0];
				}else{
					$end = $event['fecha'];
				}
			?>
				{
					id: '<?php echo $event['id']; ?>',
					title: '<?php echo $event['descripcion']; ?>',
					start: '<?php echo $start; ?>',
					end: '<?php echo $end; ?>',
					color: '<?php echo $event['color']; ?>',
				},

			<?php endforeach; ?>
			]
		});
		
		function edit(event){
			start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			
			$.ajax({
			 url: 'editar_clase_arrastrando',
			 type: "POST",
			 headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
			 data: {Event:Event},
			 success: function(rep) {
			 		alert(rep);

				}
			});
		}
		
	});

</script>

@endsection