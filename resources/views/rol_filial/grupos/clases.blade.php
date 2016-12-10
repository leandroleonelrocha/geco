@extends('template')

@section('css')
    <link rel="stylesheet" href="{{asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body no-padding">
          <div id="calendar"></div>
        </div>
      </div>
    </div>
</div>

@endsection
@section('modal')
	@include('rol_filial.grupos.partials.nueva_clase_modal')
	@include('rol_filial.grupos.partials.editar_clase_modal')
@endsection

@section('js')

<script src="{{asset('js/calendario/moment.min.js') }}"></script>
<script src="{{asset('js/calendario/fullcalendar.min.js') }}"></script>
<script src="{{asset('plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script>
	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			monthNames: ['@lang('grupo.enero')','@lang('grupo.febrero')','@lang('grupo.marzo')','@lang('grupo.abril')','@lang('grupo.mayo')','@lang('grupo.junio')','@lang('grupo.julio')','@lang('grupo.agosto')','@lang('grupo.septiembre')','@lang('grupo.octubre')','@lang('grupo.noviembre')','@lang('grupo.diciembre')'],
        	monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
     	    dayNames: ['@lang('grupo.domingo')','@lang('grupo.lunes')','@lang('grupo.martes')','@lang('grupo.miercoles')','@lang('grupo.jueves')','@lang('grupo.viernes')','@lang('grupo.sabado')'],
    		dayNamesShort: ['@lang('grupo.dom')','@lang('grupo.lun')','@lang('grupo.mar')','@lang('grupo.mie')','@lang('grupo.jue')','@lang('grupo.vie')','@lang('grupo.sab')'],
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listWeek'

			},
			buttonText: {
		          today:    'hoy', 
		          month:    'mes',
		          week:     'semana',
		          day:      'dia',
		          list:     'lista'
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

					$.ajax({
						url: 'buscar_clase',
						type: "POST",
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						data: 'clase_id='+id,
						success: function(data) {
							
							$('#ModalEdit #clase_id').val(data.id);
							$('#ModalEdit #descripcion').val(data.descripcion);
							$('#ModalEdit #docente_id').val(data.docente_id);
							$('#ModalEdit #horario_desde').val(data.horario_desde);
							$('#ModalEdit #horario_hasta').val(data.horario_hasta);
							$('#ModalEdit .cantidad_personas').html(data.cantidad_personas);
							$('#ModalEdit #clase_matricula').attr('href', url );
							$('#ModalEdit #clase_borrar').attr('href', urlborrar );

							$('#ModalEdit').modal('show');
						}
					});
				
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
				if($event->Grupo->filial_id == $filial)
				{
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

						id: '<?php if(isset($event)) echo $event['id']; ?>',
						title: '<?php if(isset($event)) echo $event->Grupo->fullname; ?>',
						start: '<?php if(isset($event)) echo $start.'T'.$event->horario_desde; ?>',
						end: '<?php if(isset($event)) echo $end.'T'.$event->horario_hasta; ?>',
						color: '<?php if(isset($event)) echo $event->Grupo->color; ?>',
					
				},


			<?php } endforeach; ?>
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