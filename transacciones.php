<?php 
      
      include("bd.php");
      
      session_start();
      
      if (isset($_SESSION)) {
        if(isset($_SESSION['login'])!='true' ){
          echo "no logeuado";    
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


$sql=" SELECT sale_price, fecha_ini_trans, a.descripcion as descTrans,  b.descripcion as descStatus , a.status_id as status_id 
       FROM tb_transacciones_proceso a , tb_status_transacc b 
       WHERE  a.status_id=b.id 
       AND transacc_proc_id in ( select  transacc_proc_id from tb_personas_transaccion b where b.persona_id=:persona_id) 
       ORDER BY fecha_ini_trans DESC";
$sentencia=$conexion->prepare($sql);
$sentencia->bindparam(":persona_id",$_SESSION["personas_id"]); 
$sentencia->execute();
$lista_transacciones=$sentencia->fetchall(PDO::FETCH_ASSOC);


include("cabecera.php");
?>



            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Transacciones</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables </li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Aqui podrás consultar los avances de tus transacciones
                                <a target="_blank" href="https://datatables.net/">xx</a>

                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Todas tus transacciones
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>                                           
                                            <th>Fecha de inicio</th>
                                            <th>Descripcion</th>
                                            <th>Estatus</th>
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
                                    <?php foreach ($lista_transacciones as $registro) { ?>                                                      
                                        <tr>
                                            <td><?php echo $registro["fecha_ini_trans"]; ?></td>
                                            <td><?php echo $registro["descTrans"];?> </td>
                                            <td><?php echo $registro["descStatus"];?></td>                                    
                                            <td><?php echo $registro["sale_price"];?></td>
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
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
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
