
<?php
  include("bd.php");
      session_start();
      
      if (isset($_SESSION)) {
        if(isset($_SESSION['login'])!='true' ){
          echo "no logeuado";    
          header("location:login.php");
      }  
      }


      $docto_id="1";

      $sql=" SELECT * 
            FROM tb_doc_tenant_application a 
            WHERE  persona_id=:persona_id            
            ORDER BY fecha  DESC";
        $sentencia=$conexion->prepare($sql);
        $sentencia->bindparam(":persona_id",$_SESSION["personas_id"]); 
        $sentencia->execute();
        $lista_tenant_applicacion=$sentencia->fetchall(PDO::FETCH_ASSOC);
   
        $sql=" SELECT * 
        FROM tb_doc_landlords a 
        WHERE  persona_id=:persona_id            
        ORDER BY fecha  DESC";
    $sentencia=$conexion->prepare($sql);
    $sentencia->bindparam(":persona_id",$_SESSION["personas_id"]); 
    $sentencia->execute();
    $lista_listalandors=$sentencia->fetchall(PDO::FETCH_ASSOC);        


      include("cabecera.php")
?>
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Rentar (Inquilino)</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Consulta de Documentos </li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Documentos a llenar                               
                            </div>  
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tenant Application
                                <button  type="button" onclick="location.href='tennant_app.php'" class="btn btn-primary">Crear + </button>
                                
                            </div>
                            <div class="card-body">
                                <table id="datatablesDocto1">
                                    <thead>
                                        <tr>                                           
                                            <th>Application Date </th>
                                            <th>Applicant’s Name:</th>
                                            <th>BirthDay</th>
                                            <th>Present Address </th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Applicant’s Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php foreach ($lista_tenant_applicacion as $registro) { ?>                                                      
                                        <tr>
                                            <td><?php echo $registro["fecha"]; ?></td>
                                            <td><?php echo $registro["applicant_name"];?> </td>
                                            <td><?php echo $registro["birtdhday_applicant"];?></td>                                    
                                            <td><?php echo $registro["present_address"];?></td>                                            
                                            
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
<!-- documento 2 -->
                    <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Lease Walk through Inspection
                                <div>
                                <button  type="button" onclick="location.href='tennant_app.php'" class="btn btn-primary">Crear + </button>                                
                                    </div>
                            </div>
                            <div class="card-body">
                                <table id="datatablesDocto2">
                                    <thead>
                                        <tr>                                           
                                        <th>Application Date </th>
                                            <th>Name</th>
                                            <th>BirthDay</th>
                                            <th>Present Address </th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        
                                    </tfoot>
                                    <tbody>
                                    <?php foreach ($lista_tenant_applicacion as $registro) { ?>                                                      
                                        <tr>
                                            <td><?php echo $registro["fecha"]; ?></td>
                                            <td><?php echo $registro["applicant_name"];?> </td>
                                            <td><?php echo $registro["birtdhday_applicant"];?></td>                                    
                                            <td><?php echo $registro["present_address"];?></td>                                                                                          
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
<!-- fin documento 2 -->
 <!-- documento 3 -->
 <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Landlords
                                <button  type="button" onclick="location.href='landlords.php'" class="btn btn-primary">Crear   <i class="fas fa-circle-plus"></i></button>                                                                
                                <button  type="button" onclick="location.href='landlords.php?psn_id=1'; " class="btn btn-primary">Editar  <i class="fas fa-pen-to-square"></i></button>                                     
                            </div>
                            <div class="card-body">
                                <table id="datatablesDocto3">
                                    <thead>
                                        <tr>                                                                                  
                                            <th>Date</th>
                                            <th>Address</th>
                                            <th>Lease Starts </th>
                                            <th>Lease Ends </th>
                                            <th>Landlord name</th>
                                            <th>Tennant name</th>
                                            <th>Contact information</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        
                                    </tfoot>
                                    <tbody>
                                    <?php foreach ($lista_listalandors as $registro) { ?>                                                      
                                        <tr>
                                            
                                            <td><?php echo $registro["fecha"]; ?></td>
                                            <td><?php echo $registro["address"];?> </td>
                                            <td><?php echo $registro["lease_starts"];?></td>                                    
                                            <td><?php echo $registro["lease_ends"];?></td>                                            
                                            <td><?php echo $registro["landlord1_name"];?></td>                                            
                                            <td><?php echo $registro["tennant1_name"];?></td>                                            
                                            <td><?php echo $registro["contact_information"];?></td>                                                                                        
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
<!-- fin documento 3 -->
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
