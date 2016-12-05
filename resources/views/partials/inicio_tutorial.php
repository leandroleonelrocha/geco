<?php
?>
<script type="text/javascript">
function startIntro(texto){

    var intro = introJs();
    intro.setOptions({

            'showProgress': true,
            steps: [
              { 
                intro: texto
              },
              
              <?php
              foreach($array as $key => $valor){
              ?>  
              
              {element: document.querySelector(<?php echo "'".$key."'" ?>), intro: <?php echo "'".$valor."'" ?>},

              <?php 
              }
            ?>
          
        ]
    });

  intro.start();
}
</script>
