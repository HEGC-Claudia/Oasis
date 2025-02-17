
<?php
  include("bd.php");

  $bdusu="";
  $bdcontra="";
  $bdNombreUsuario="";
  $bdintereses="";
  $solicitudEnviada="0";
  $fechaReg=new DateTime("now",null);  
  $bdId=0;
  $fechaRegistro=$fechaReg->format('Y-m-d 00:00:00');
  // status_id 
  // 1.-Solicitud enviada
  // 2.-Correo enviado
  // 3.-Password cambiado
  // 4.- Link cancelado por reenvio de solicitd 
   
  if(isset($conexion)){
     
   if($_POST){
    $solicitudEnviada="0";      
     $bdusu=(isset($_POST["inputEmail"]))?$_POST["inputEmail"]:"";

     if ($bdusu!="") {  
       // hace proceso de que si elcorreo existe en la base de datos va a hacer una solicitud de cambio de contraseña
       $sql="SELECT * FROM tb_personas_datos_extra a where correo=:usuario  ";      
       $sentencia=$conexion->prepare($sql);
       $sentencia->bindparam(":usuario",$bdusu); 
       $sentencia->execute();
       $resultado=$sentencia->fetch(PDO::FETCH_LAZY);
       
       
       $bdNombreUsuario=(isset($resultado["nombre_completo"]))?$resultado["nombre_completo"]:"";
       $bdPersonaId=(isset($resultado["personas_id"]))?$resultado["personas_id"]:"";
       $bdCorreo=(isset($resultado["correo"]))?$resultado["correo"]:"";
       $txtLink="";
       $solicitudEnviada="1";
        if ( ($_POST["inputEmail"]==$bdCorreo) ) {
              // primero ve si hay otra solicitud para cancelar el link 
              $sql="SELECT * FROM tb_solicitud_recupera_password a where status_id=1 and  persona_id=:persona_id  ";      
              $sentencia=$conexion->prepare($sql);
              $sentencia->bindparam(":persona_id",$bdPersonaId); 
              $sentencia->execute();
              $resultado=$sentencia->fetch(PDO::FETCH_LAZY);

              $bdId=(isset($resultado["id"]))?$resultado["id"]:0;
              if ($bdId!=0)
              {
                
                $sql="UPDATE tb_solicitud_recupera_password SET status_id=4 WHERE persona_id=:persona_id";
                $sentencia=$conexion->prepare($sql);
                $sentencia->bindparam(":persona_id",$bdPersonaId); 
                $sentencia->execute();                                     
              }
            // aqui hace las operaciones de insertar en la tabla de solicitud


            $sql="INSERT INTO tb_solicitud_recupera_password (persona_id, fecha, status_id)
                  VALUES (:persona_id, :fecha,1) ";
       
            $sentencia=$conexion->prepare($sql);
            $sentencia->bindparam(":persona_id",$bdPersonaId); 
            $sentencia->bindparam(":fecha",$fechaRegistro);            
            $sentencia->execute();  
            // recupera el id generado
            $sql="SELECT * FROM tb_solicitud_recupera_password a where status_id=1 and  persona_id=:persona_id  ";      
            $sentencia=$conexion->prepare($sql);
            $sentencia->bindparam(":persona_id",$bdPersonaId); 
            $sentencia->execute();
            $resultado=$sentencia->fetch(PDO::FETCH_LAZY);
            $bdId=(isset($resultado["id"]))?$resultado["id"]:0;            
            
            $txtLink="http://app.oasisinmobiliario.com/pwd.php?id=".$bdId;    
            $sql="UPDATE tb_solicitud_recupera_password SET link=:link where id=:id";                        
            $sentencia=$conexion->prepare($sql);
            $sentencia->bindparam(":id",$bdId); 
            $sentencia->bindparam(":link",$txtLink);                         
            $sentencia->execute();             

        }
    } else echo "<script> alert('Debes introducir un correo válido') </script>";
  }
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
        <title>Recuperar contraseña- Oasis Inmobiliario</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
    </head>
    <body class="bg-primary">
    <nav class="sb-topnav navbar navbar-expand navbar-light bg-light">
<!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="http://OasisInmobiliario.com">Oasis Inmobiliario</a>
            <form  class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" href="register.php">
                <div class="input-group">
                <a name="btnNavbarSearch" id="btnNavbarSearch" class="btn btn-primary" href="register.php" role="button">Registrarse</a>
                </div>
            </form>           
        </nav>   
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <?php if($solicitudEnviada=="1"){  echo "" ?>
                                    <div id="error" class="alert alert-danger ocultar" role="alert">Enviamos instrucciones al correo proporcionado. Revísalo para continuar con el proceso de recuperación de contraseña.</div>  
                                <?php ; }    ?> 
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Recupera tu contraseña</h3></div>
                                    <div class="card-body">
                                        <div class="small mb-3 text-muted">Ingresa tu direccion de correo y enviaremos un enlace para recuperar tu contraseña.</div>
                                        <form action="contrasenia.php"  method="post">
                                            <div class="form-floating mb-3">
                                                <input name="inputEmail" class="form-control" id="inputEmail" type="text" placeholder="name@example.com" />
                                                <label for="inputEmail">Correo </label>
                                            </div>
                                            
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="login.php">Recordaste tu contraseña?. Inicia sesion</a>
                                                   <button class="btn btn-primary"  type="submit">Recuperar contraseña</button> 
                                                
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.php">Necesitas una cuenta? Registrate!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>

    </body>
</html>
