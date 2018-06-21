<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Almacenamiento virtual</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" type="text/css" href="css/estilo.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
  <link rel="stylesheet"  type ="text/css" href="css/jquery-ui.min.css">
  
  


  <script type="text/javascript">

  


      function efecto(){
 
  $(this).children('i').toggleClass('fa-pencil');
  // Switches the forms  
  $('.form').animate({
    height: "toggle",
    'padding-top': 'toggle',
    'padding-bottom': 'toggle',
    opacity: "toggle"
  }, "slow");
      

      }

      function calendario(){

     $("#txt_fechaemision").datepicker($.datepicker.regional['es']);
     $("#txt_fechaemision").datepicker('option', 'dateFormat', 'yy-mm-dd');



      }



      function  getTablaRegistro(){

          var tabla  = $.ajax({
              url:'php/tablaconsulta.php',
              dataType:'text',
              async:false,

          }).responseText;




      }


      function isAlfaNumerico( palabra){
        var vsCadena = palabra;

            var vsExprReg = /^[a-z0-9\s\-\&\/]+$/i;

            if (!vsExprReg.test(vsCadena)) {
                return false;
            }else{

              return true;
            }
        
      }
          
      
         function isNumerico( palabra){
        var vsCadena = palabra;

           var vsExprReg = /^[0-9\s.\-\&\/]+$/i;

            if (!vsExprReg.test(vsCadena)) {
                return false;
            }else{

              return true;
            }
        
      }
  

          function aMayusculas1(){
            var obj = document.getElementById("txt_serie").value;
            obj = obj.toUpperCase();
            document.getElementById("txt_serie").value = obj;
                    }

          function aMayusculas2(){
            var obj = document.getElementById("correlativo").value;
            obj = obj.toUpperCase();
            document.getElementById("correlativo").value = obj;
        }
        function aMayusculas3(){
            var obj = document.getElementById("imagen").value;
            obj = obj.toUpperCase();
            document.getElementById("imagen").value = obj;
        }

           function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }

   

            //utlizando Jquery   
             $(document).ready(function(){

              /*  $("#a_correo").click(function(e){
                  e.preventDefault();
                    $("#div_correo").show(2000);
                    $("#div_correo").show("fast");

                }); */
 
                  $('#btn_correo').click( function(e){
                    e.preventDefault();
                    var email=$('#txt_email').val();
                      if ($.trim(email).length==0) {
                        $("#label_mensaje").show("fast");    
                        $("#label_mensaje").html("ingrese un correo");
                        $("#txt_email").focus();

                      } else
                        if(!isValidEmailAddress(email)){
                           $("#label_mensaje").show("fast");    
                           $("#label_mensaje").html("direccion de correo invalida");
                           $("#txt_email").val('');
                           $("#txt_email").focus();

                        }else {

                           $.ajax({
                           type: "POST",
                           url: "php/correo.php",
                           data : ('info_email='+email),
                            beforeSend: function(){
                            $("#label_mensaje").show("fast"); 
                            $("#txt_email").attr('disabled','disabled'); 
                            $("#label_mensaje").html("enviando...");
                            },
                           success:function(respuesta){
                              $("#label_mensaje").show("fast");  
                              switch(respuesta){
                               case '0':   $("#label_mensaje").html("no se pudo enviar, intentelo nuevamente");  break;
                                 case '1':   $("#label_mensaje").html("se envio correctamente"); break; 

                                }


                                $("#txt_email").removeAttr('disabled');
                                $("#txt_email").val('');
                                $("#txt_email").focus();
                           
                                

                          
                           }})
                              

                        }


                  });


                     //consulta para la base de datos ...
                     $("#btn_enviar").click(function(e){
                           e.preventDefault();

                           var bus_estado=true;
                           var bus_serie=$("#txt_serie").val();
                           var bus_correlativo=$("#correlativo").val();
                           var bus_emisor=$("#selector_emisor").val();
                           var bus_tipodocumento=$("#selector_documento").val();
                           var bus_fechaemision=$("#txt_fechaemision").val();
                           var bus_monto=$("#txt_monto").val();
                           var bus_imagen = $("#imagen").val();
                           var bus_aleatorio=$("#aleatorio").val();

                            if ($.trim(bus_serie).length==0) {
                                 bus_estado=false; 
                                $(".div_alerta").show(300);
                                $(".div_alerta").show("fast");
                                $(".div_espera").hide();
                                $("#txt_serie").focus();
                                $("#label_alerta").html("Ingrese la serie");
                                
                                

                            } else if (!isAlfaNumerico($.trim(bus_serie))) {
                                       bus_estado=false;
                                       $(".div_alerta").show(300);
                                       $(".div_alerta").show("fast");
                                      $(".div_espera").hide();
                                      $("#txt_serie").focus();
                                      $("#txt_serie").val('');
                                     $("#label_alerta").html("Serie invalida");
                                      return false;
                                 }  
                                 else if($.trim(bus_correlativo).length==0){
                                      bus_estado=false;
                                      $(".div_alerta").show(300);
                                      $(".div_alerta").show("fast");
                                      $(".div_espera").hide();
                                      $("#correlativo").focus();
                                     $("#label_alerta").html("Ingrese el correlativo");
                                      
                                }else  if (!isAlfaNumerico($.trim(bus_correlativo))) {
                                   bus_estado=false;
                                    $(".div_alerta").show(300);
                                    $(".div_alerta").show("fast");
                                    $(".div_espera").hide();
                                    $("#correlativo").focus();
                                    $("#correlativo").val('');
                                    $("#label_alerta").html("Correlativo invalido");
                                    

                                 } else 
                                    if($.trim(bus_fechaemision).length==0){
                                       bus_estado=false;
                                      $(".div_alerta").show(300);
                                      $(".div_alerta").show("fast");
                                      $(".div_espera").hide(); 
                                      $("#txt_fechaemision").focus();
                                     $("#label_alerta").html("Ingrese la fecha de emision");
                                   }else 
                                     if($.trim(bus_monto).length==0){
                                      bus_estado=false;
                                     $(".div_alerta").show(300);
                                     $(".div_alerta").show("fast");
                                     $(".div_espera").hide();
                                     $("#txt_monto").focus();
                                     $("#label_alerta").html("Ingrese el monto");
                                     }

                                     else if ($.trim(bus_imagen).length==0){
                                           bus_estado=false;
                                          $(".div_alerta").show(300);
                                          $(".div_alerta").show("fast");
                                          $(".div_espera").hide();
                                          $("#imagen").focus();

                                          $("#label_alerta").html("Ingrese las letras de la imagen");

                                         }else  if($.trim(bus_imagen)!=$.trim(bus_aleatorio)){
                                             bus_estado=false;
                                             $(".div_alerta").show(300);
                                             $(".div_alerta").show("fast");
                                             $(".div_espera").hide();
                                             $("#imagen").val('');
                                             $("#imagen").focus();   
                                             $("#label_alerta").html("El texto no coincide con la imagen");
                                         } 


                                         if(bus_estado==true){
                                              var bus_monto2=parseFloat(bus_monto);
                                   
                                            $.ajax({
                                          type: "GET",
                                          url:'php/tablaconsulta.php',
                                          data : ('bus_serie='+bus_serie +"&bus_correlativo="+bus_correlativo+"&bus_emisor="+
                                             bus_emisor+"&bus_tipodocumento="+bus_tipodocumento+"&bus_fechaemision="+bus_fechaemision+
                                             "&bus_monto="+bus_monto2 
                                            ),
                                          beforeSend: function(){
                                           $(".division_tabla").hide(2000);
                                          $(".division_tabla").hide('fast');
                                           $(".div_correo").hide(2000);
                                          $(".div_correo").hide('fast');
                                          $(".division_nohay").hide();  
                                          $(".div_espera").show(500);
                                          $(".div_espera").show('slow'); 
                                          $(".div_alerta").hide();
                                          $("#label_espera").html("espere un momento...");
                                         
                                          },
                                         success:function(respuesta){
                                            document.getElementById("seccion_tabla").innerHTML=respuesta;
                                           $(".div_espera").hide();
                                           $(".seccion_tabla").show(2000);
                                           $(".seccion_tabla").show("fast");
                                           $("#div_correo").show(1000);
                                           $("#div_correo").show('slow');
                                           

                          
                                             }})
                              


                                         }


                     });
                            
                


                });
           
          

           function ocultarArea(id){
            $(document).ready(function(){
                $(id).hide(2000);
                $(id).hide("fast");

                });
           }
           

        function isValidEmailAddress(emailAddress) {
            var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
            return pattern.test(emailAddress);
        };


          
          
           

           
       
         //CONTROL DE FUNCIONES 

           window.onload=function(){

           //document.getElementById("enviar").onclick=validarDatos;
           document.getElementById("txt_fechaemision").onmouseover=calendario;
           document.getElementById("txt_serie").onblur=aMayusculas1;
           document.getElementById("correlativo").onblur=aMayusculas2;
           document.getElementById("imagen").onblur=aMayusculas3;
         

          

          }

           window.onclick=function(){
           document.getElementById("btn_toggle").onclick=efecto;
          
           }             
  





 </script>
</head>

<body>
  

<div class="pen-title">
  <i class=''></i><a></a></span>
</div>
<!-- Form Module-->
<div class="form-module">
  <div class="toggle" id="btn_toggle"><i class="fa fa-times fa-pencil"></i>
    <div class="tooltip">Todos los documentos</div>
  </div>


  <div class="form">
  <p><marquee> Contáctanos: (+51) 727-1997 o Visita nuestra página web en www.mmconsultoresinformaticos.net</marquee></p>
 
  <!-- <img src="img/logocolor.png" width="130" height="63"  alt=""/ > -->
       

        <form >
        <h2>Documento único</h2>
        <label>EMISOR</label>

          <select class="campo1" name="selector_emisor" id="selector_emisor">
            <ul>
              <option>Banco de la Nacion</option>
              <option>BCP</option>
              <option>Banco de credito</option>
            </ul>
          </select>

        <div style="width:50%; float:left;">
         <label>SERIE</label>
          <input type="text" name="txt_serie" id="txt_serie" placeholder="" >

          <label>TIPO DE DOCUMENTO</label>

            <select name="selector_documento" id="selector_documento">
              <option>Factura electronica</option>
              <option>Boleta de venta</option>
          </select>

           <label>MONTO</label>
            <input type="number" step="0.01"  min="0"placeholder="S/." name="txt_monto" id="txt_monto">
          </div>





          <div style="width:50%; float:left;">
            <label>CORRELATIVO</label>
            <input type="text" name="txt_correlativo" id="correlativo"  placeholder=""></input>

            <label>F.EMISIÓN </label>
            <input type="text" name="txt_fechaemision" id="txt_fechaemision"  placeholder="AAAA/mm/dd"></input>

            <label>TEXTO DE IMAGEN </label>
            <input type="text" name="imagen" id="imagen" maxlength="4"></input>
         
          </div>
   
          <?php

            function getRandomCode(){
            $an = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $su = strlen($an) - 1;
            return  substr($an, rand(0, $su), 1) .
                    substr($an, rand(0, $su), 1) .
                    substr($an, rand(0, $su), 1) .
                    substr($an, rand(0, $su), 1);
            }

          
           ?>
                <div  class="cuadro" id="cuadro">
                 <input type="text" name="aleatorio" id="aleatorio" class="cuadro" value=<?php echo getRandomCode(); ?> type="text"  readonly >

                 </div>
                                 


             <button name="btn_enviar"  id="btn_enviar" type="submit" >BUSCAR</button>

      </form>


      <!-- mensaje espera -->
        <div id="div_espera" class="div_espera"  style="display:none;">
        <label id="label_espera"></label>

      </div>



      <!--  mensaje de alerta-->
      <div id="div_alerta" class="div_alerta" style="display:none;">
        <label id="label_alerta">...</label>

      </div>

      <section id="seccion_tabla" class="seccion_tabla" style="display:none;">
      <!-- tabla de la base de datos  -->


      </section>


 <!-- -->
      <div id="div_correo" class="div_correo" style="display:none;" >
        
          <form action="" name="formulario" method="post" >
            
                         
        <input type='email' name='txt_email' placeholder='Correo Electronico'  id="txt_email">
        <button name="btn_correo" id="btn_correo" type="submit">  <img src='img/adelante.png' width='30' height='30' /> </button>           
        <label id="label_mensaje" class="label_mensaje" style="display:none;" ></label> 
        </form>
        
      

          
        
         
      </div>


     




 
  </div>


  

  <div class="form">
    <h2>Todos los documentos</h2>
    <form>
    <label>EMISOR</label>
      <select class="campo1">
        <ul>
          <option>empresa1</option>
          <option>empresa2</option>
          <option>empresa3</option>
        </ul>
      </select>
      <input type="text" placeholder="Ruc"/>
      
      <button>BUSCAR</button>
    </form>
  </div>


 
  


  <div class="cta"><a href="http://andytran.me">Los datos son confidenciales, estamos monitoriando cada movimiento por su seguridad.</a></div>

</div>


  

 
  <script src='http://codepen.io/andytran/pen/vLmRVp.js'></script>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="js/jquery.ui.datepicker-es.js"></script>
 

  





</body>
</html>
