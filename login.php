<script type="text/javascript">
function mostrarPassword(){
		var cambio = document.getElementById("txtContrasenia");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 
	
	$(document).ready(function () {
	//CheckBox mostrar contraseña
	$('#ShowPassword').click(function () {
		$('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
	});
});s
</script>
<?php
  include("bd.php");

  $bdusu="";
  $bdcontra="";
  $bdNombreUsuario="";
  $bdintereses="";
   
  if(isset($conexion)){
     
   if($_POST){
      
     $bdusu=(isset($_POST["txtNombre"]))?$_POST["txtNombre"]:"";

     if ($bdusu!="") {  
       // verifica si el usuario y contraseña coinciden con la base de datos
       //$sql="SELECT * FROM usuarios where usuario=:usuario";
       $sql="SELECT personas_id, user_login, correo, nombre_completo, password, intereses
             FROM tb_personas_datos_extra a, tb_claves_aut b WHERE (tipouso_id=1) and ( a.personas_id=b.catalogo_id and (:usuario in (user_login, correo) ) )";
       
       $sentencia=$conexion->prepare($sql);
       $sentencia->bindparam(":usuario",$bdusu); 
       $sentencia->execute();
       $resultado=$sentencia->fetch(PDO::FETCH_LAZY);
       
       
       $bdcontra=(isset($resultado["password"]))?$resultado["password"]:"";
       $bdNombreUsuario=(isset($resultado["nombre_completo"]))?$resultado["nombre_completo"]:"";
       $bdPersonasId=(isset($resultado["personas_id"]))?$resultado["personas_id"]:"";
       $bdintereses=(isset($resultado["intereses"]))?$resultado["intereses"]:"";

                
        if ( ($_POST["txtNombre"]==$bdusu) && ($_POST["txtContrasenia"]==$bdcontra) ) {
            session_start();                 
            $_SESSION['login']="true";
            $_SESSION['usuario']=$bdusu;
            $_SESSION["nombre"]=$bdNombreUsuario;
            $_SESSION["personas_id"]=$bdPersonasId;
            $_SESSION["intereses"]=$bdintereses;            

        
            header("location:index.php");
        }else echo "<script> alert('Usuario o contraseña incorrecta') </script>";
    }
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
        <title>Login - Oasis Inmobiliario</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
    </head>
    <body class="bg-light.bg-gradient">
    <nav class="sb-topnav navbar navbar-expand navbar-light bg-secondary">
<!-- Navbar Brand-->
            <a class="navbar-brand ps-3 " href="http://OasisInmobiliario.com">Oasis Inmobiliario</a>
            <a name="btnDescargaApp" id="btnDescargaApp" class="btn btn-primary" href="descarga.php" role="button">Descarga aplicacion</a>                                
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4 ">Ingresar</h3></div>
                                    <div class="card-body">
                                        <form action="login.php"  method="post">
                                            <div class="form-floating mb-3">
                                                <input name="txtNombre" class="form-control" id="inputEmail" type="text" placeholder="name@example.com" />
                                                <label for="inputEmail">Correo </label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <div class="input-group">                                                                                                                                                                                                                                                                                                                                         
                                                    <input name="txtContrasenia" class="form-control" id="txtContrasenia" type="password" placeholder="Password" />                                                  
                                                   <button   id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                                                 </div>                                                                                                                                                                                               
                                            </div>
                                            
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="contrasenia.php">Olvidaste la contraseña?</a>
                                               <button class="btn btn-primary"  type="submit">Entrar al sistema</button> 
                                                
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
