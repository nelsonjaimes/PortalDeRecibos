 <?php

                  $bus_serie= isset($_GET["bus_serie"])? $_GET["bus_serie"]:null;
                  $bus_emisor = isset($_GET["bus_emisor"])? $_GET["bus_emisor"]:null;
                  $bus_correlativo =isset($_GET["bus_correlativo"])? $_GET["bus_correlativo"]:null;
                  $bus_fechaemision=isset($_GET["bus_fechaemision"])? $_GET["bus_fechaemision"]:null;
                  $bus_tipodocumento=isset($_GET["bus_tipodocumento"])? $_GET["bus_tipodocumento"]:null;
                  $bus_monto=isset($_GET["bus_monto"])? $_GET["bus_monto"]:null;
                  $bus_monto2 = (float)$bus_monto;

                


                 sleep(2);
                 echo consulta_bd($bus_serie,$bus_correlativo,$bus_emisor,$bus_fechaemision,$bus_tipodocumento,$bus_monto2);               
                   
                      
            

             


                    function consulta_bd($bus_serie,$bus_correlativo,$bus_emisor,$bus_fecha_emision,$bus_tipo_documento,$bus_monto2) 
                    {
                        #CONECCION CON LA BASE DE DATOS 
                          //$db_host="162.222.226.133";
                          $db_host="localhost";
                          $db_nombre="mmconpfa_factura_electronica";
                          //$db_usuario="mmconpfa_admin";
                          $db_usuario="root";
                          //$db_contra="aml11021959";
                          $db_contra="";
                          $conexion =mysqli_connect($db_host,$db_usuario,$db_contra,$db_nombre);
                          # code...
                          if (mysqli_connect_errno()) {
                          echo "fallo al conectar con la BD ";
                          exit(); 
                           }

                             mysqli_set_charset($conexion,"utf8");
                             $consulta = "SELECT * FROM 
                             tbl_comprobantes_electronicos WHERE  serie='".$bus_serie."' AND correlativo='".$bus_correlativo."'
                              AND emisor='".$bus_emisor."' AND fecha_emision='".$bus_fecha_emision."' AND tipo_documento='".$bus_tipo_documento."'
                              AND monto='".$bus_monto2."'";   

                              $resultado= mysqli_query($conexion,$consulta);
                              $fila= mysqli_fetch_array($resultado,MYSQL_ASSOC);
                              if(empty($fila)){

                                  echo "<div class='division_nohay'> <label>NO HAY REGISTROS </label> </div>";
                              }else {  

                                 
                               echo "<div class='division_tabla'> <table class='busqueda_tabla'>
                                <tr class='cabecera_tabla' >
                                        <td class='fecha_cabecera' > Fecha </td>
                                        <td> Serie</td>
                                        <td> Correlativo </td>
                                       <td> Tipo documento</td>
                                       <td> Monto </td>
                                       <td colspan='3'> Archivos </td>
                                       

                                 </tr>";

                           while (!empty($fila)) {
                             
                             echo "<tr class='fila_tabla' >";
                              
                             echo "<td class='celda_tabla' >". $fila['fecha_emision']."</td>";
                             echo "<td class='celda_tabla' >". $fila['serie']."</td>";
                             echo "<td class='celda_tabla' >". $fila['correlativo']."</td>";
                             echo "<td class='celda_tabla' >". $fila['tipo_documento']."</td>";
                             echo "<td class='celda_tabla' >". $fila['monto']."</td>";
                             echo "<td class='celda_tabla'>"."<a href=".$fila['url_pdf'].">  <img src='img/pdf.png' width='40' height='40' /> </a> </td>";
                             echo "<td class='celda_tabla'>"."<a href=".$fila['url_xml'].">  <img src='img/xml.png' width='40' height='40' /> </a> </td>";
                             echo "<td class='celda_tabla'>"."<a href=".$fila['url_pack']."> <img src='img/rar.png' width='40' height='40' /> </a>  </td>";
                              
                          
                              echo "</tr> ";

                              

                              $fila = mysqli_fetch_array($resultado,MYSQL_ASSOC);
                              
                           } //end while


                           
                           echo "</table> </div>";
                           
                             //echo "<script language='javascript'>mostrarArea('div_correo');</script>"; 
                          


                         


                           } //end else
                    mysqli_close($conexion); 
                    }
                          
   ?>
