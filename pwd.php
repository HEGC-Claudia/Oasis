<?php
    include("bd.php");


    $valorNulo=NULL;
    $fechaReg=new DateTime("now",null);    
    $fechaRegistro=$fechaReg->format('Y-m-d 00:00:00');
    $inputSolicitudId=0;
    $inputPassword=""  ;     
    $inputPasswordConfirm=""  ;     
    $inputCteId="0";

    $nombreCompleto="";
    $coincidenContraseñas="1";
    $bdPersonasId="";
    
    
    
    $txtPersonaActId="0";
    $txtPersonaId="pwd.php";
    $exito=false;

    if ($_GET){
        if (isset($_GET["id"]))
        {  $inputSolicitudId=$_GET["id"];                      
           if (is_numeric($_GET["id"])){
                 
                  $sql="SELECT * from tb_solicitud_recupera_password a where status_id=2 and id=:id";                 
                  $sentencia=$conexion->prepare($sql);
                  $sentencia->bindparam(":id",$inputSolicitudId); 
                  $sentencia->execute();
                  $resultado=$sentencia->fetch(PDO::FETCH_LAZY); 
                  if (isset($resultado["id"]))
                  {
                    $inputCteId=$resultado["persona_id"];
                    $txtPersonaId="pwd.php"."?id=".$inputSolicitudId;                 
                  }else  header("Location:login.php");



           } else {$txtPersonaId="login.php";
                   $inputCteId="0";
                   header("Location:login.php");
                   }
           
        } else header("Location:login.php"); 
       } else  header("Location:login.php");     
if ($_POST){
   
    $inputPassword=( isset($_POST["inputPassword"]) )? $_POST["inputPassword"]:""  ;     
    $inputPasswordConfirm=( isset($_POST["inputPasswordConfirm"]) )? $_POST["inputPasswordConfirm"]:""  ;         
    
  if ($inputPassword==$inputPasswordConfirm) {    
    $coincidenContraseñas="1";
    
    try {
                    $fechaActua=$fechaReg->format('Y-m-d H:i:s');            
// BUSCAR SI tiene alguna contraseña en la tabla tb_claves_aut
                    $sql="SELECT * FROM  tb_claves_aut  b where catalogo_id=:personas_id";                   
                    $sentencia=$conexion->prepare($sql);
                    $sentencia->bindparam(":personas_id",$inputCteId); 
                    $sentencia->execute();
                    $resultado=$sentencia->fetch(PDO::FETCH_LAZY); 
                    
                    if (isset($resultado["id"]))
                    {                          
                        // actualiza
                        $sql="UPDATE tb_claves_aut SET password=:password WHERE catalogo_id=:catalogo_id ";
                        $sentenciaSQL=$conexion->prepare($sql);
                        $sentenciaSQL->bindParam(":catalogo_id",$inputCteId);  
                        $sentenciaSQL->bindParam(":password",$inputPassword);
                        $sentenciaSQL->execute();

                    }else  // inserta
                    {                         
                        $sql="SELECT * from tb_personas_datos_extra  where personas_id=:personas_id";                   
                        $sentencia=$conexion->prepare($sql);
                        $sentencia->bindparam(":personas_id",$inputCteId); 
                        $sentencia->execute();
                        $resultado=$sentencia->fetch(PDO::FETCH_LAZY);                
                        $descrPassword="Password para ".$resultado["nombre_completo"];                         
                           
                        $sql="INSERT INTO  tb_claves_aut ( descripcion, password, tipouso_id, catalogo_id)  
                              VALUES (:descrPassword, :password, 4, :inputCteId)" ;
                        $sentenciaSQL=$conexion->prepare($sql);
                        $sentenciaSQL->bindParam(":inputCteId",$inputCteId);
                        $sentenciaSQL->bindParam(":descrPassword",$descrPassword);
                        $sentenciaSQL->bindParam(":password",$inputPassword);
                        $sentenciaSQL->execute();                                               
                    }

                    // deshabilitar el link
                    $sql="UPDATE tb_solicitud_recupera_password SET status_id=3  WHERE id=:id ";
                    $sentenciaSQL=$conexion->prepare($sql);
                    $sentenciaSQL->bindParam(":id",$inputSolicitudId);  
                    $sentenciaSQL->execute();
                    $exito=true;
                    header("Location:login.php");                                                       
    
      } catch (PDOException $error) { ?>
        <div class="alert alert-primary" role="alert">
        <strong>Atencion </strong> <?php echo "Ocurrió un error al actualizar el password... ".$error;  ?>
        </div>
        <?php }  
  } else $coincidenContraseñas="0";
}

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Recuperar password - Oasis Inmobiliario</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">   
            <nav class="sb-topnav navbar navbar-expand navbar-light bg-light">
            <!-- Navbar Brand-->

            <a class="navbar-brand ps-3" href="http://OasisInmobiliario.com">Oasis Inmobiliario</a>          
            <form class=" d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" >                            
                <a name="btnNavbarSearch" id="btnNavbarSearch" class="btn btn-primary" href="login.php" role="button">Ingresar</a>
            </form>           
        </nav>           
        <div id="layoutAuthentication">        
            <div id="layoutAuthentication_content">
                <main>                                                      
                    <div class="container">
                        <div class="row justify-content-center">                            
    
                            <div class="col-lg-6">                                                          
                                <div class="card shadow-lg border-0 rounded-lg mt-5">                                                                                                                               
                                <div class="small">                                
                                   <?php if($coincidenContraseñas!="1"){  echo "" ?>
                                    <div id="error" class="alert alert-danger ocultar" role="alert">Las Contraseñas no coinciden, vuelve a intentar!</div>  
                                   <?php ; }    ?>                                                                                                   
                               </div>
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">RECUPERAR CONTRASEÑA</h3></div>                                    

                                    <div class="card-body">                                        
                                        <form action=<?php echo $txtPersonaId ;?>     method="post">
                                            
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPassword" type="password" required name="inputPassword" placeholder="Create a password" />
                                                        <label for="inputPassword">Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPasswordConfirm" type="password" required  name="inputPasswordConfirm" placeholder="Confirm password" />
                                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            <div class="mt-4 mb-0">                                           
                                                <div class="d-grid">
                                                <button class="btn btn-primary btn-block"  type="submit" >Cambiar</button> 
                                                </div>                                                
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.php">Recordaste tu password? Inicia sesion</a></div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </main>
            </div>
            
        </div>


<!-- Portfolio item 1 modal popup-->
<div class="portfolio-modal modal fade" id="portfolioModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Recuperacion exitosa!!</h2>                                   
                                    <p>Iniciar sesion </p>
                                    <ul class="list-inline">
                                        
                                        <li>
                                            <strong>URL:</strong>
                                            <a href= "login.php" </a>
                                        </li>                                        
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Cerrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
