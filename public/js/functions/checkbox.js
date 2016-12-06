// $(document).ready(function(){
// 	/* ------------------------------ Asistencias ------------------------------ */
// 	$('.asistencia').checkboxpicker({
// 	  html: true,
// 	  offLabel: '<span class="glyphicon glyphicon-remove">',
// 	  onLabel: '<span class="glyphicon glyphicon-ok">'
// 	});

// 	$('.asistencia').change(function(event) {
//         var thiss = $(this), asistio;
//         if (thiss.prop('checked')) asistio = 1;
//         else asistio = 0;
        
//         $.ajax({
//             url: thiss.data('url'),
//             // type: 'POST',
//             type: 'GET',
//             dataType: 'json',
//             data: {clase_id: thiss.data('clase'), matricula_id: thiss.data('matricula'), asistio: asistio},
//         })
//         .done(function() {
//             console.log("exito")
//         })
//         .fail(function() {
//             console.log("error");
//         });
//     });
// });