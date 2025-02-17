<?php
    include("bd.php");


    $valorNulo=NULL;
    $registroCompletado=0;
    $fechaReg=new DateTime("now",null);    
    $fechaRegistro=$fechaReg->format('Y-m-d 00:00:00');
    $inputFirstName=( isset($_POST["inputFirstName"]) )? $_POST["inputFirstName"]:""  ; 
    $inputLastName=""  ; 
    $inputEmail=""  ; 
    $inputPhone=""  ; 
    $inputPassword=""  ;     
    $inputPasswordConfirm=""  ;     
    $inputBirthDay=$fechaReg->format('Y-m-d');
    $txtIntereses1= "Comprar";
    $txtIntereses2= ""; 
    $txtIntereses3=""; 
    $txtIntereses4=""; 
    $txtIntereses5=""; 
    $txtIntereses6=""; 
    $txtIntereses7=""; 
    $txtIntereses8="";    
    $txtIntereses ="";

    $nombreCompleto="";
    $inputLanguage="";
    $coincidenContraseñas="1";
    $cuentaYaExiste="0";
    $bdPersonasId="";
    $inputReferidoPor="";
    $txtRutaVideo="";
    $txtRutaImagen="";
    
    
    $txtTipoPersonaId="7";    
    $txtStatusId="9";
    $txtPersonaActId="0";
    $inputAgenteId="0";
    $txtAgenteId="registerclient1.php";

    if ($_GET){
        if (isset($_GET["agente_id"]))
        {  $inputAgenteId=$_GET["agente_id"];                      
           if (is_numeric($_GET["agente_id"])){
                  $txtAgenteId="registerclient1.php"."?agente_id=".$inputAgenteId; 
                  $inputReferidoPor=referidoPor($inputAgenteId,$conexion);
           } else {$txtAgenteId="registerclient1.php";
                   $inputAgenteId="0";
                   $inputReferidoPor="";
                   }
           
        }
       } 
    
if ($_POST){

    $inputFirstName=( isset($_POST["inputFirstName"]) )? $_POST["inputFirstName"]:""  ; 
    $inputLastName=( isset($_POST["inputLastName"]) )? $_POST["inputLastName"]:""  ; 
    $nombreCompleto=$inputFirstName.' '.$inputLastName;
    $inputEmail=( isset($_POST["inputEmail"]) )? $_POST["inputEmail"]:""  ; 
    $inputPhone=( isset($_POST["inputPhone"]) )? $_POST["inputPhone"]:""  ; 
    $inputPassword=( isset($_POST["inputPassword"]) )? $_POST["inputPassword"]:""  ;     
    $inputPasswordConfirm=( isset($_POST["inputPasswordConfirm"]) )? $_POST["inputPasswordConfirm"]:""  ;         
    $inputBirthDay=( isset($_POST["inputBirthDay"]) )? $_POST["inputBirthDay"]:"";       
    
    $inputLanguage=( isset($_POST["btnradio"]) )? $_POST["btnradio"]:""  ; ;
    $inputReferidoPor=( isset($_POST["inputReferidoPor"]) )? $_POST["inputReferidoPor"]:""  ; ;
       
    
    $txtIntereses1=  (isset($_POST["cbIntereses1"]))?$_POST["cbIntereses1"]:"";
    $txtIntereses2=  (isset($_POST["cbIntereses2"]))?$_POST["cbIntereses2"]:"";
    $txtIntereses3=  (isset($_POST["cbIntereses3"]))?$_POST["cbIntereses3"]:"";
    $txtIntereses4=  (isset($_POST["cbIntereses4"]))?$_POST["cbIntereses4"]:"";
    $txtIntereses5=  (isset($_POST["cbIntereses5"]))?$_POST["cbIntereses5"]:"";
    $txtIntereses6=  (isset($_POST["cbIntereses6"]))?$_POST["cbIntereses6"]:"";
    $txtIntereses7=  (isset($_POST["cbIntereses7"]))?$_POST["cbIntereses7"]:"";
    $txtIntereses8=  (isset($_POST["cbIntereses8"]))?$_POST["cbIntereses8"]:"";    
    
    
    $txtIntereses= ($txtIntereses!="") 
                    ? $txtIntereses. ((isset($txtIntereses1) && ($txtIntereses1!="")) ?"-".$txtIntereses1:"")
                    : ((isset($txtIntereses1)) ?$txtIntereses1:"");

    $txtIntereses= ($txtIntereses!="") 
                    ? $txtIntereses. ((isset($txtIntereses2) && ($txtIntereses2!="") ) ?"-".$txtIntereses2:"")
                    : ((isset($txtIntereses2)) ?$txtIntereses2:"");

    $txtIntereses= ($txtIntereses!="") 
                    ? $txtIntereses. ((isset($txtIntereses3) && ($txtIntereses3!="")) ?"-".$txtIntereses3:"")
                    : ((isset($txtIntereses3)) ?$txtIntereses3:"");
    $txtIntereses= ($txtIntereses!="") 
                    ? $txtIntereses. ((isset($txtIntereses4) && ($txtIntereses4!="")) ?"-".$txtIntereses4:"")
                    : ((isset($txtIntereses4)) ?$txtIntereses4:"");

    $txtIntereses= ($txtIntereses!="") 
                    ? $txtIntereses. ((isset($txtIntereses5) && ($txtIntereses5!="")) ?"-".$txtIntereses5:"")
                    : ((isset($txtIntereses5)) ?$txtIntereses5:"");
    $txtIntereses= ($txtIntereses!="") 
                    ? $txtIntereses. ((isset($txtIntereses6) && ($txtIntereses6!="")) ?"-".$txtIntereses6:"")
                    : ((isset($txtIntereses6)) ?$txtIntereses6:"");
    $txtIntereses= ($txtIntereses!="") 
                    ? $txtIntereses. ((isset($txtIntereses7) && ($txtIntereses7!="")) ?"-".$txtIntereses7:"")
                    : ((isset($txtIntereses7)) ?$txtIntereses7:"");
    $txtIntereses= ($txtIntereses!="") 
                    ? $txtIntereses. ((isset($txtIntereses8) && ($txtIntereses8!="")) ?"-".$txtIntereses8:"")
                    : ((isset($txtIntereses8)) ?$txtIntereses8:"");                    

  if ($inputPassword==$inputPasswordConfirm) {    
    $coincidenContraseñas="1";
    
    // validar si existe el correo

    try {
       /* 
        $sql="SELECT * FROM tb_personas_datos_extra  WHERE correo=:correo";
        $sentencia=$conexion->prepare($sql);
        $sentencia->bindparam(":correo",$inputEmail); 
        $sentencia->execute();
        $resultado=$sentencia->fetch(PDO::FETCH_LAZY);
        if (isset($resultado["correo"])) {
         $cuentaYaExiste="1";

        }else
        { $cuentaYaExiste="0";   
            
         */
        $cuentaYaExiste=existeCorreo($inputEmail,$conexion);
        if($cuentaYaExiste=="0"){
                    $fechaActua=$fechaReg->format('Y-m-d H:i:s');            
            
                    // registra la cuenta en tb_personas
                    
                    $sql="Insert into tb_personas (user_login, correo, fecha_registro, wp_users_id) 
                         values (:usuario, :correo, :fechaReg ,0)";
                    $sentenciaSQL=$conexion->prepare($sql);
                    $sentenciaSQL->bindParam(":usuario",$inputEmail);           
                    $sentenciaSQL->bindParam(":correo",$inputEmail);                                               
                    $sentenciaSQL->bindParam(":fechaReg",$fechaRegistro);           
                    $sentenciaSQL->execute();

                    // busca el id que le genero
                    $sql="SELECT * FROM tb_personas  WHERE correo=:correo";
                    $sentencia=$conexion->prepare($sql);
                    $sentencia->bindparam(":correo",$inputEmail); 
                    $sentencia->execute();
                    $resultado=$sentencia->fetch(PDO::FETCH_LAZY);                   


                    if (isset($resultado["id"])){
                        $bdPersonasId=$resultado["id"];

                        // inserta en personas datos extra
                        $sql="INSERT INTO tb_personas_datos_extra (personas_id, nombre, apellido,fecha_nacimiento,
                        intereses, telefono1, nombre_completo, tipo_persona_id,
                        fecha_cap, fecha_act, idioma,persona_act_id, correo, user_login, referido_por,
                        agente_id, status_id , idioma_id) 
                        values (:personas_id, :nombre, :apellido, :fecha_nacimiento,
                        :intereses, :telefono1, :nombre_completo, :tipo_persona_id,
                        :fecha_cap, :fecha_act, :idioma, :persona_act_id, :correo, :user_login, :referido_por,
                        :agente_id, :status_id, (select  id from tb_idiomas where descripcion=:idioma2) )" ;
                        $sentenciaSQL=$conexion->prepare($sql);
                        $sentenciaSQL->bindParam(":personas_id",$bdPersonasId);           
                        $sentenciaSQL->bindParam(":nombre",$inputFirstName);           
                        $sentenciaSQL->bindParam(":apellido",$inputLastName);           
                        $inputBirthDay=($inputBirthDay=="")?$valorNulo:$inputBirthDay;
                        $sentenciaSQL->bindParam(":fecha_nacimiento",$inputBirthDay);                                                           
                        $sentenciaSQL->bindParam(":intereses",$txtIntereses);           
                        $sentenciaSQL->bindParam(":telefono1",$inputPhone);           
                        $sentenciaSQL->bindParam(":nombre_completo",$nombreCompleto);           
                        $sentenciaSQL->bindParam(":tipo_persona_id",$txtTipoPersonaId);            
                        $sentenciaSQL->bindParam(":fecha_cap",$fechaRegistro);           
                        $sentenciaSQL->bindParam(":fecha_act",$fechaActua);   
                        $sentenciaSQL->bindParam(":idioma",$inputLanguage);           
                        $sentenciaSQL->bindParam(":idioma2",$inputLanguage);                                   
                        $sentenciaSQL->bindParam(":persona_act_id",$txtPersonaActId);           
                        $sentenciaSQL->bindParam(":correo",$inputEmail);           
                        $sentenciaSQL->bindParam(":user_login",$inputEmail);           
                        $sentenciaSQL->bindParam(":referido_por",$inputReferidoPor); 
                                  
                        $sentenciaSQL->bindParam(":agente_id",$inputAgenteId);           
                        $sentenciaSQL->bindParam(":status_id",$txtStatusId);           
                        $sentenciaSQL->execute();                    

                        // insertar password en claves_aut
                        $sql="INSERT INTO tb_claves_aut (id, descripcion, password, tipouso_id, catalogo_id) 
                              values (0,Concat('Password para ',:nombreCompleto),:inputPassword,4, :bdPersonasId)" ;                            
                        $sentenciaSQL=$conexion->prepare($sql);                        
                        $sentenciaSQL->bindParam(":nombreCompleto",$nombreCompleto);           
                        $sentenciaSQL->bindParam(":inputPassword",$inputPassword);                                   
                        $sentenciaSQL->bindParam(":bdPersonasId",$bdPersonasId);                                   
                        $sentenciaSQL->execute();                    

                        $registroCompletado=1;                 
/*
                        session_start();                 
                        $_SESSION['login']="true";
                        $_SESSION['usuario']=$inputEmail;
                        $_SESSION["nombre"]=$nombreCompleto;
                        $_SESSION["personas_id"]=$bdPersonasId;   
                        header("Location:index.php");                                     
                        */
                    }
                    
        }        

      } catch (PDOException $error) { ?>
        <div class="alert alert-primary" role="alert">
        <strong>Atencion </strong> <?php echo "Error en registro... ".$error;  ?>
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
        <title>Register - Hurtado Realty</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-light.bg-gradient">   
            <nav class="sb-topnav navbar navbar-expand navbar-light bg-secondary">
            <!-- Navbar Brand-->

            <a class="navbar-brand ps-3" href="http://hurtadorealty.com">Hurtado Realty</a>          
            <form class=" d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" >                            
                <a name="btnNavbarSearch" id="btnNavbarSearch" class="btn btn-primary" href="login.php" role="button">Ingresar</a>
            </form>           
        </nav>    
    
        <div id="layoutAuthentication">        
            <div id="layoutAuthentication_content">
                <main>                                                      
                    <div class="container">
                        <div class="row justify-content-center">                             
                        <div class="col-lg-4">                                                                  
                        </div>    
                        <div class="col-lg-4">                                                              
                        <video autoplay controls src="./assets/video/bienvenidaContactos.MP4" width="448"  height="336">                                    
                            <img src="./assets/img/imgRegistro.jpeg" alt="Video no soportado" />Su navegador no soporta este formato de video                                
                            </video>
                        </div>    
                        <div class="col-lg-4">                                                                  
                        </div>    
                        </div>    
                        <div class="row justify-content-center">                                
                            <div class="col-lg-6">                                                          
                                <div class="card shadow-lg border-0 rounded-lg mt-5">                                                                                                                               
                                <div class="small">                                
                                   <?php if($coincidenContraseñas!="1"){  echo "" ?>
                                    <div id="error" class="alert alert-danger ocultar" role="alert">Las Contraseñas no coinciden, vuelve a intentar!</div>  
                                   <?php ; }    ?>

                                   <?php if($cuentaYaExiste!="0"){  echo "" ?>
                                        <div id="error" class="alert alert-danger ocultar" role="alert">Ese correo ya esta registrado en la plataforma! Ingresa con tu usuario y contraseña</div>  
                                   <?php ; }    ?>   
                                   <?php if($registroCompletado=="1"){  echo "" ?>
                                    <div id="error" class="alert alert-danger ocultar" role="alert">Tu registro ha sido exitoso!!! En breve una persona del equipo se pondré en contacto contigo.</div>  
                                   <?php ; }    ?> 
                                                                                                   
                                                                   
                               </div>
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Crear cuenta</h3></div>                                    

                                    <div class="card-body">                                        
                                        <form action=<?php echo $txtAgenteId ;?>     method="post">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input value="<?php echo $inputFirstName;?>" class="form-control" id="inputFirstName" name="inputFirstName" type="text" required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">First name</label>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input value="<?php echo $inputLastName; ?>" class="form-control" id="inputLastName" name="inputLastName" type="text" required placeholder="Enter your last name" />
                                                        <label  for="inputLastName">Last name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input value="<?php echo $inputEmail; ?>" class="form-control" id="inputEmail" type="email" name="inputEmail" required placeholder="name@example.com" />
                                                <label for="inputEmail">Email address</label>
                                            </div>
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
                                            <div class="row mb-3">                                                
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input value="<?php echo $inputPhone; ?>" class="form-control" id="inputPhone" type="text" name="inputPhone" required  placeholder="Mobile phone number" />
                                                        <label for="inputPhone">Mobile phone number</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">                                           
                                                        <input value="<?php echo $inputBirthDay;?>"  class="form-control" id="inputBirthDay" type="date" name="inputBirthDay" placeholder="Your birthday" />
                                                        <label for="inputBirthDay">Your Birthday</label>
                                                    </div>
                                                </div>                                                
                                            </div>

                                            <div class="row mb-3">                                                
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    Intereses                                                        
                                                    <div class="form-check">    
                                                    <input  <?php echo ($txtIntereses1!="")?"checked":""; ?>  name="cbIntereses1" value="Comprar" class="form-check-input" type="checkbox"  id=""  >
                                                    <label class="form-check-label" for="">
                                                        Comprar
                                                    </label>
                                                    </div>
                                                    <div class="form-check">
                                                    <input <?php echo ($txtIntereses2!="")?"checked":""; ?> name="cbIntereses2" value="Vender" class="form-check-input" type="checkbox" id="" >
                                                    <label class="form-check-label" for="">
                                                        Vender
                                                    </label>
                                                    </div>
                                                    <div class="form-check">
                                                    <input <?php echo ($txtIntereses3!="")?"checked":""; ?> name="cbIntereses3"  value="Renta Inquilino" class="form-check-input" type="checkbox"  id="" >
                                                    <label class="form-check-label" for="">
                                                        Rentar(Inquilino)
                                                    </label>
                                                    </div>
                                                    <div class="form-check">    
                                                    <input <?php echo ($txtIntereses4!="")?"checked":""; ?> name="cbIntereses4" value="Renta Arrendador" class="form-check-input" type="checkbox" value="4" id="">
                                                    <label class="form-check-label" for="">
                                                        Rentar(Arrendador)
                                                    </label>
                                                    </div>
                                                    <div class="form-check">
                                                    <input <?php echo ($txtIntereses8!="")?"checked":""; ?> name="cbIntereses8" value="Invertir" class="form-check-input" type="checkbox" id="" >
                                                    <label class="form-check-label" for="">
                                                        Invertir
                                                    </label>
                                                    </div>                                                    
                                                    <div class="form-check">    
                                                    <input <?php echo ($txtIntereses5!="")?"checked":""; ?> name="cbIntereses5" value="Prestamo" class="form-check-input" type="checkbox"  id="">
                                                    <label class="form-check-label" for="">
                                                        Prestamo
                                                    </label>
                                                    </div>
                                                    <div class="form-check">    
                                                    <input <?php echo ($txtIntereses6!="")?"checked":""; ?>  name="cbIntereses6" value="Realtor" class="form-check-input" type="checkbox"  id="">
                                                    <label class="form-check-label" for="">
                                                        Realtor
                                                    </label>
                                                    </div>
                                                    <div class="form-check">    
                                                    <input <?php echo ($txtIntereses7!="")?"checked":""; ?> name="cbIntereses7" value="Lender" class="form-check-input" type="checkbox"  id="">
                                                    <label class="form-check-label" for="">
                                                        Lender
                                                    </label>
                                                    </div>                                                       
                                                </div>
                                            </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        Idioma 
                                                        <br/>
                                                        <div  class="btn-group" role="group" aria-label="Basic checkbox toggle button group">                                                            
                                                            <input value="Spanish" type="radio" class="btn-check" checked name="btnradio" id="btncheck1" autocomplete="off">
                                                            <label class="btn btn-outline-primary" for="btncheck1">Español</label>

                                                            <input value="English" type="radio" class="btn-check" name="btnradio" id="btncheck2" autocomplete="off">
                                                            <label class="btn btn-outline-primary" for="btncheck2">Inglés</label>

                                                            <input value="French" type="radio" class="btn-check" name="btnradio" id="btncheck3" autocomplete="off">
                                                            <label class="btn btn-outline-primary" for="btncheck3">Francés</label>
                                                        </div>
                                                        
                                                    </div>
                                                    <br/>
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <div class="form-floating mb-3">
                                                        <input value="<?php echo $inputReferidoPor; ?>" class="form-control" 
                                                                id="inputReferidoPor" type="text" name="inputReferidoPor" 
                                                                <?php echo ($inputReferidoPor!="")?"disabled":""?>
                                                                placeholder="Referido por" />
                                                        <label for="inputReferidoPor">Referido por</label>
                                                        </div>                                                        
                                                        </div>                

                                                </div>                                                
                                            </div>
                                            <div class="mt-4 mb-0">                                           
                                                <div class="d-grid">
                                                <button class="btn btn-primary btn-block"  type="submit" >Create Account</button> 
                                                </div>                                                
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-lg-6 mt-5">  -- >
                            <img src="./assets/img/imgRegistro.jpeg" class="img-fluid rounded-top" alt="">
                            </div>      -->
                           <!-- 
                            <div class="col-lg-6 mt-5">  -- >
                            <video autoplay controls src="./assets/video/bienvenidaContactos.MP4" width="448"  height="336">                                    
                            <img src="./assets/img/imgRegistro.jpeg" alt="Video no soportado" />Su navegador no soporta este formato de video                                
                            </video>
                            </div>
                            -->
                        </div>
                    </div>
                </main>
            </div>
            
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
