$(function () {
        // AREA CHART
         "use strict";
        var area = new Morris.Area({
          element: 'revenue-chart',
          resize: true,
          data: [
            {y: '2011 Q1', item1: 2666, item2: 2666},
            {y: '2011 Q2', item1: 2778, item2: 2294},
            {y: '2011 Q3', item1: 4912, item2: 1969},
            {y: '2011 Q4', item1: 3767, item2: 3597},
            {y: '2012 Q1', item1: 6810, item2: 1914},
            {y: '2012 Q2', item1: 5670, item2: 4293},
            {y: '2012 Q3', item1: 4820, item2: 3795},
            {y: '2012 Q4', item1: 15073, item2: 5967},
            {y: '2013 Q1', item1: 10687, item2: 4460},
            {y: '2013 Q2', item1: 8432, item2: 5713}
          ],
          xkey: 'y',
          ykeys: ['item1', 'item2'],
          labels: ['Item 1', 'Item 2'],
          lineColors: ['#a0d0e0', '#3c8dbc'],
          hideHover: 'auto'
        });

        // LINE CHART
        var line = new Morris.Line({
          element: 'line-chart',
          resize: true,
          data: [
            {y: '2011 Q1', item1: 2666},
            {y: '2011 Q2', item1: 2778},
            {y: '2011 Q3', item1: 4912},
            {y: '2011 Q4', item1: 3767},
            {y: '2012 Q1', item1: 6810},
            {y: '2012 Q2', item1: 5670},
            {y: '2012 Q3', item1: 4820},
            {y: '2012 Q4', item1: 15073},
            {y: '2013 Q1', item1: 10687},
            {y: '2013 Q2', item1: 8432}
          ],
          xkey: 'y',
          ykeys: ['item1'],
          labels: ['Item 1'],
          lineColors: ['#3c8dbc'],
          hideHover: 'auto'
        });

        //DONUT CHART
        var donut = new Morris.Donut({
          element: 'sales-chart',
          resize: true,
          colors: ["#3c8dbc", "#f56954", "#00a65a"],
          data: [
            {label: "Download Sales", value: 12},
            {label: "In-Store Sales", value: 30},
            {label: "Mail-Order Sales", value: 20}
          ],
          hideHover: 'auto'
        });
       
     


       

        $( "#btn_buscar" ).on( "click", function() {
            var fecha = $("#reservation").val();
            var value = $("#selectvalue").val();

            if(value == "preinforme")
            {
	            console.log(value);
	             $.ajax({
	                        type:'POST',
	                        url:'estadistica_preinformes_ajax',
	                        headers: {
	                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                        },
	                        data:'fecha='+fecha,
	                        success:function(data){
	                        	 //DONUT CHART
	                        	 console.log(data);
	                        	var player = [];
						   		var score = [];

						   		for(var i in data) {

									player.push(data[i].nombre);
									score.push(data[i].count);
								}


						        var donut = new Morris.Donut({
						          element: 'sales-chart',
						          resize: true,
						          colors: ["#3c8dbc", "#f56954", "#00a65a"],
						          data: [
						          	

						             {label: player, value: score},
						              
						          
						          ],
						          
						          hideHover: 'auto'
						        });
		                      

	                        }
	            });// Fin del ajax
        	}// fin de la condicion

        	 if(value == "inscripcion")
            {
	            console.log(value);
	             $.ajax({
	                        type:'POST',
	                        url:'estadistica_inscripcion_ajax',
	                        headers: {
	                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                        },
	                        data:'fecha='+fecha,
	                        success:function(data){
	                        	//BAR CHART
	                        	
	                        	var cars = {y: 'Poseen computadora', a: 100, b: 90};
	                        	var player = [];
						   		
						   		for(var i in data) {
						   			var item ={};
									player.push({ y:'Poseen computadora', a: data[i].count, b:data[i].count});
										
								}

								console.log(player);


						        var bar = new Morris.Bar({
						          element: 'bar-chart',
						          resize: true,
						          data: [cars],

						          barColors: ['#00a65a', '#f56954'],
						          xkey: 'y',
						          ykeys: ['a', 'b'],
						          labels: ['Si', 'No'],
						          hideHover: 'auto'
						        });

	                        }
	            });// Fin del ajax
        	}// fin de la condicion


        }); // Fin del evento click



});//Fin de la funcion
