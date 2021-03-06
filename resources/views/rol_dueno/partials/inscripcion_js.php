<?php
?>
<script type="text/javascript">
$(function () {
    $('#torta').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            <?php if(isset($total)){?>
            text: ' Cantidad de inscriptos: {{$total}} '
            <?php }?>

        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Genero',
            data: [
                    <?php
                    if(isset($genero))
                    {

                    foreach ($genero as $key => $value) {
                    ?>

                ['{{$value['nombre']}}', {{$value['count'] }} ],

                    <?php
                    }
                    }
                    ?>

                    <?php
                    if(isset($preinforme))
                    {
                    foreach ($preinforme as $key => $value) {

                    ?>

                     [ '{{$key}}', {{$value->count()}} ],

                <?php
                }
                }
                ?>

            ]
        }]
    });
    //Fin de la torta


        //BAR CHART
        var bar = new Morris.Bar({
          element: 'bar-chart',
          resize: true,
          data: [
              <?php
              if(isset($disponibilidad))
               {
              foreach($disponibilidad as $insc ){
              ?>
               {y: '{{$insc["label"]}}', a: {{$insc["si"]}}, b: {{$insc["no"]}} },
              <?php
               }
                }
              ?>
          ],
          barColors: ['#00a65a', '#f56954'],
          xkey: 'y',
          ykeys: ['a','b'],
          labels: ['SI','NO'],
          hideHover: 'auto'
        });

    //DONUT CHART
    var donut = new Morris.Donut({
        element: 'sales-chart',
        resize: true,
        colors: ["#3c8dbc", "#f56954", "#00a65a"],
        data: [
           <?php
           if(isset($nivelEstudios))
           {
            foreach ($nivelEstudios as $key => $value) {
            ?>
            //{label: "Download Sales", value: 12},
            { label:'{{$key}}', value: {{$value->count()}} },

            <?php
            }
            }
            ?>
        ],
        hideHover: 'auto'
    });


});
</script>