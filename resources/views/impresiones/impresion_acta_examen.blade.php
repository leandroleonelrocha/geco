<!DOCTYPE html>
<html lang="en">

<head>
    <title>@lang('impresiones/acta_examen.acta')</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        *{
            padding:0;
            margin: 0;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            font-size: 11px;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
        }

        html, body {
            min-height: 100%;
        }

        body {
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            font-size: 14px;
            line-height: 1.42857143;
            color: #333;
            background-color: #fff;
            margin: 15px !important;
            padding: 15px !important;
        }

        body {
            margin: 0;
            margin-top: 20px;
        }

        html {
            font-size: 10px;
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        }


        .img-responsive{
            width: 100%;
        }

        .font21{
            font-size: 18px;
        }

        .col-xs-12{
            width: 100%;
            float: left;
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-xs-6{
            width: 50%;
            float: left;
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-xs-10{
            width: 66.66%;
            float: left;
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-xs-4{
            width: 25%;
            float: left;
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-xs-3{
            width: 33.33%;
            float: left;
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-xs-8{
            width: 75%;
            float: left;
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-xs-offset-1{
            margin-left: 8.33%;
        }

        .col-xs-offset-2{
            margin-left:  17%;
        }

        .text-center{
            text-align: center;
        }

        .row {
            margin-right: -15px;
            margin-left: -15px;
        }


        /*Tablas*/
        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
        }

        table {
            background-color: transparent;
        }

        table {
            border-spacing: 0;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }

        .table>thead:first-child>tr:first-child>th {
            border-top: 0;
        }

        .table>thead>tr>th {
            border-bottom: 2px solid #f4f4f4;
        }

        .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
            border-top: 1px solid #f4f4f4;
        }

        .table>thead>tr>th {
            vertical-align: bottom;
            border-bottom: 2px solid #ddd;
        }

        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }

        th {
            text-align: left;
        }

        td, th {
            padding: 0;
        }

        .table-striped>thead>tr:nth-child(2) {
            background-color: #f9f9f9;
        }

        .colorWhite{
            color: white;
        }

        .bg-blue{
            background-color: #3498db;
        }

        .blue{
            color: #3498db;
        }

        #logo{
            /*width:150px;*/
        }

        .center-vertical{
            margin-top: 50px;
            height:50px;

        }

        .center-block{
            margin: auto;
        }

        .mb-40n{
            margin-bottom: -40px;
        }

        .mb-20{
            margin-bottom: 20px;
        }

        .mt-20{
            margin-top: 20px;
        }

        .mt-10{
            margin-top: 10px;
        }

        .ml-80{
            margin-left: 80px;
        }

        .pull-right{
            float: right;
        }

        .text-danger{
            color: #a94442;
        }

        .border{
            border: 1px solid #ddd;
        }

        .footer{
            width: 110px;
            margin-top:-21px;
            padding:5px;
            float:right;
        }


        .upper{
            text-transform: uppercase;
        }

        .text-right{
            text-align: right;
        }

        .p10{
            padding:10px;
        }

        .little,.little *{
            font-size: 80%;
        }

        .cierre>div{
            width:50%;
            display: inline-block;
            vertical-align: top;
        }

    </style>

</head>
<body>
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