<?php 
      
      include("bd.php");
      
      session_start();
      
      if (isset($_SESSION)) {
        if(isset($_SESSION['login'])!='true' ){
          echo "no logueado";    
          header("location:login.php");
      }  
      }
      
/*
$sql="SELECT user_login, correo, nombre_completo, password
             FROM tb_personas_datos_extra a, tb_claves_aut b WHERE a.personas_id=b.catalogo_id and user_login=:usuario";
       
$sentencia= $conexion->prepare("SELECT * FROM  tb_ ");
$sentencia->execute();
$lista_portafolio=$sentencia->fetchall(PDO::FETCH_ASSOC);
*/


$sql=" SELECT a.*, nombre_completo 
       FROM tb_mensajes a  
       LEFT JOIN tb_personas_datos_extra b on a.emisor_persona_id=b.personas_id
       WHERE  a.status_id != 2 
       AND receptor_persona_id=:persona_id 
       ORDER BY fecha_envio DESC";
$sentencia=$conexion->prepare($sql);
$sentencia->bindparam(":persona_id",$_SESSION["personas_id"]); 
$sentencia->execute();
$lista_mensajes=$sentencia->fetchall(PDO::FETCH_ASSOC);


include("cabecera.php");
?>



            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Mensajes</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Mensajes</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Aqui podrás consultar los mensajes que te enviaremos para informarte algun requerimiento de tus transacciones
                                <a target="_blank" href=""></a>

                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Todos tus mensajes
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>                                           
                                            <th>Fecha</th>
                                            <th>Mensaje</th>
                                            <th>Enviado por</th>
                                            <th>Respuesta</th>
                                            <th>Fecha respuesta</th>
                                            <th>Valor </th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php foreach ($lista_mensajes as $registro) { ?>                                                      
                                        <tr>
                                            <td><?php echo $registro["fecha_envio"]; ?></td>
                                            <td><?php echo $registro["mensaje"];?> </td>
                                            <td><?php echo $registro["nombre_completo"];?></td>                                    
                                            <td><?php echo $registro["respuesta"];?></td>                                    
                                            <td><?php echo $registro["fecha_respuesta"];?></td>                                    
                                            <td><?php echo $registro["status_id"];?></td>
                                        </tr>
                                        <?php } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Oasis Inmobiliario 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
