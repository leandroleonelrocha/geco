<?php
?>
<script type="text/javascript">

  $('#morosidad').highcharts({

       chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Resultados de morosidad: $ <?php if(isset($total_morosidad)) echo $total_morosidad ?>'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}</b><br/>',
            	shared: true
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: [
                		<?php
                		 if(isset($morosidad))
                		 	
	                	 foreach ($morosidad as $key => $value){

	                	?>

	                	{
	                    name: '<?php echo $value->nombre ?>',
	                    y: <?php echo $value->total ?>
	                	}, 

	                	<?php
	                	}
	                	?>
                ]
            }]
        });
 
</script>