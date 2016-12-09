function startIntro(){
    
    var intro = introJs();
    intro.setOptions({

            'showProgress': true,
            steps: [
              { 
                intro: "Hello world!"
              },
              
              <?php
              foreach ($array as $key => $valor){
              ?>  
              
              {element: document.querySelector(<?php echo "'".$key."'" ?>), intro: <?php echo "'".$valor."'" ?>},

              <?php 
              }
            ?>
          
        ]
    });

  intro.start();
}