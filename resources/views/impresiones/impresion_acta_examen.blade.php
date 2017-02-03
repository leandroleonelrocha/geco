<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>@lang('impresiones/acta_examen.acta')</title>
      <style>

          *{
              font-size: 90%;
              margin:5px;
              padding:2px;
          }

          table{
              border-collapse: collapse;
          }

          .titulo{
              width: 100%;
              margin-top: 5px;
              margin-bottom: -25px !important;
          }

          .titulo *{
              vertical-align: middle !important;
              display: inline-block;
          }


          .titulo span{
              width: 50%;
              /*border: 1px solid red;*/
          }

           .right{
                display: inline-block;
                width: 50%;
            }

            .left{
                width: 50%;
                display: inline-block;
                
            }

            .content{
                border-top: 1px solid #c1c1c1;
                padding-top: 10px;
                margin-top: -40px !important;
            }

            .content span,.content p{
                display: inline-block;
                vertical-align: top !important;
            }

            .content span{
                width:100%;
            } 
            

          .border{
              /*border-bottom: 1px solid black;*/
              margin-top: -10px !important;
              padding-top: 0 !important;
              margin-bottom: -20px !important;
              padding-bottom: 0 !important;
          }

          #table2{
            border-collapse: collapse;
          }

      </style>
  </head>
  <body>


  <div class="titulo">
      <span>ACTA N° 12321</span>
      <span>AUTORIZACION N° 432</span>
  </div>

  <table width="100%" cellpadding="10" border="1" style="margin-top: -10px !important;">
      <tr>
          <th></th>
          <th>@lang('impresiones/acta_examen.ayn')</th>
          <th>@lang('impresiones/acta_examen.teorico')</th> 
          <th>@lang('impresiones/acta_examen.practico')</th>
          <th>@lang('impresiones/acta_examen.recuperatorios')</th>
          <th>@lang('impresiones/acta_examen.ficha')</th>
          <th>@lang('impresiones/acta_examen.curso')</th>
           
      </tr>
      <tr>
          <th>1</th> 
          <td > Jorge, Roberto</td>
          <th>7</th> 
          <th>8</th>
          <th></th>
          <th>5464/12</th>
          <th>OFFICE</th>
           
      </tr>



  </table>



   <div class="content">
      <div class="border left">
          <h4>
              ** 
          </h4>


          <div>
              <div>
                  <b>@lang('impresiones/acta_examen.codigo')</b>:1234 OPW OFFICE FULL
              </div>

              <div>
                  <b>@lang('impresiones/acta_examen.profesor')</b>: Esteban Vals
         
              </div>

            


          </div>
      </div>

      <div class="border right">
          <h4>
              ** 
          </h4>


          <div>
              <div>
                  <b>@lang('impresiones/acta_examen.ayn')</b>:
                  zassda 
              </div>

              <div>
                  <b>@lang('impresiones/acta_examen.ndocumento')</b>:
                 546456
              </div>
          </div>
      </div>

    </div>

  </body>

</html>