<?php
    include("bd.php");

    //$paginadeGracias="https://hurtadorealty.com/gracias";
    $paginadeGracias="https://hurtadorealty.com/pago-hurtado-realty/";
    $valorNulo=NULL;
    $fechaReg=new DateTime("now",null);    
    $fechaRegistro=$fechaReg->format('Y-m-d 00:00:00');
    $inputFirstName=( isset($_POST["inputFirstName"]) )? $_POST["inputFirstName"]:""  ; 
    $inputLastName=""  ; 
    $inputEmail=""  ; 
    $inputPhone=""  ; 


    $inputNumeroCuenta=0;
    $inputNombreBanco=""    ;
    $inputNombreCuenta="";
    $inputNumeroDeRuta="";
    $inputFaceBook="";
    $inputInstagram="";
    $inputTiktok="";
    $inputComentarios="";

    $inputLicNumber="";
    

    $inputContactoEmergencia=""    ;
    $inputNumeroContactoEmergencia="";

    $inputBirthDay=$fechaReg->format('Y-m-d');
    
    $nombreCompleto="";
    $inputLanguage="";
    $inputPorcentaje="";
    $inputComisionid=0;
    
    $cuentaYaExiste="0";
    $bdPersonasId="";
    $inputReferidoPor="";

    $inputDireccion=""; 
    $inputCodigoPostal="";
    $inputCiudad="";
    $inputEstado="";
    $inputPais="";
    $txtDireccion="";
    
    $txtTipoPersonaId="3";    
    $txtStatusId="9";
    $txtPersonaActId="0";
    $inputAgenteId="0";
    $txtRutaVideo="";
    $txtRutaImagen="";
    $txtAgenteId="registeragents.php";

    if ($_GET)
    {
        if (isset($_GET["agente_id"]))
        {  $inputAgenteId=$_GET["agente_id"];                      
           if (is_numeric($_GET["agente_id"])){
                  $txtAgenteId="registeragents.php"."?agente_id=".$inputAgenteId; 
                  
                  list($inputReferidoPor,$txtRutaVideo,$txtRutaImagen)=referidoPor2($inputAgenteId,$conexion);
           } else {$txtAgenteId="registeragents.php";
                   $inputAgenteId="0";
                   
                   }
           
        }
    }   
if ($_POST)
{

    $inputFirstName=( isset($_POST["inputFirstName"]) )? $_POST["inputFirstName"]:""  ; 
    $inputLastName=( isset($_POST["inputLastName"]) )? $_POST["inputLastName"]:""  ; 
    $nombreCompleto=$inputFirstName.' '.$inputLastName;
    $inputEmail=( isset($_POST["inputEmail"]) )? $_POST["inputEmail"]:""  ; 
    $inputPhone=( isset($_POST["inputPhone"]) )? $_POST["inputPhone"]:""  ; 
    $inputBirthDay=( isset($_POST["inputBirthDay"]) )? $_POST["inputBirthDay"]:"";       
    $inputLanguage=( isset($_POST["btnradio"]) )? $_POST["btnradio"]:""  ; 
    $inputPorcentaje=( isset($_POST["btnradio2"]) )? $_POST["btnradio2"]:""  ;     
     
    if (isset($_POST["inputReferidoPor"])) 
    {
        $inputReferidoPor=( isset($_POST["inputReferidoPor"]) )? $_POST["inputReferidoPor"]:""  ; 
    }


    
    $inputNombreBanco=( isset($_POST["inputNombreBanco"]) )? $_POST["inputNombreBanco"]:""  ; 
    $inputLicNumber=( isset($_POST["inputLicNumber"]) )? $_POST["inputLicNumber"]:""  ;     
    $inputNombreCuenta=( isset($_POST["inputNombreCuenta"]) )? $_POST["inputNombreCuenta"]:""  ; 
    $inputNumeroCuenta=( isset($_POST["inputNumeroCuenta"]) )? $_POST["inputNumeroCuenta"]:""  ; 
    $inputNumeroDeRuta=( isset($_POST["inputNumeroDeRuta"]) )? $_POST["inputNumeroDeRuta"]:""  ; 
    $inputDireccion=( isset($_POST["inputDireccion"]) )? $_POST["inputDireccion"]:""  ; 
    $inputCodigoPostal=( isset($_POST["inputCodigoPostal"]) )? $_POST["inputCodigoPostal"]:""  ; 
    $inputCiudad=( isset($_POST["inputCiudad"]) )? $_POST["inputCiudad"]:""  ; 
    $inputEstado=( isset($_POST["inputEstado"]) )? $_POST["inputEstado"]:""  ;     
    $inputPais=( isset($_POST["inputPais"]) )? $_POST["inputPais"]:""  ;     

    $inputFaceBook=( isset($_POST["inputFaceBook"]) )? $_POST["inputFaceBook"]:""  ; 
    $inputInstagram=( isset($_POST["inputInstagram"]) )? $_POST["inputInstagram"]:""  ; 
    $inputTiktok=( isset($_POST["inputTiktok"]) )? $_POST["inputTiktok"]:""  ; 
    $inputContactoEmergencia=( isset($_POST["inputContactoEmergencia"]) )? $_POST["inputContactoEmergencia"]:""  ; 
    $inputNumeroContactoEmergencia=( isset($_POST["inputNumeroContactoEmergencia"]) )? $_POST["inputNumeroContactoEmergencia"]:""  ; 
    $inputComentarios=( isset($_POST["inputComentarios"]) )? $_POST["inputComentarios"]:""  ; 
    
    try 
    {       
        $cuentaYaExiste=existeCorreo($inputEmail,$conexion);
        if($cuentaYaExiste=="0")
        {
            
                    $fechaActua=$fechaReg->format('Y-m-d h:i:s');            
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


                    if (isset($resultado["id"]))
                    {
                        $bdPersonasId=$resultado["id"];

                        // inserta en personas datos extra
                        $sql="INSERT INTO tb_personas_datos_extra (personas_id, nombre, apellido,fecha_nacimiento,
                         telefono1, nombre_completo, tipo_persona_id,
                        fecha_cap, fecha_act, idioma,persona_act_id, correo, user_login, referido_por, comision,
                        agente_id, status_id , idioma_id) 
                        values (:personas_id, :nombre, :apellido, :fecha_nacimiento,
                        :telefono1, :nombre_completo, :tipo_persona_id,
                        :fecha_cap, :fecha_act, :idioma, :persona_act_id, :correo, :user_login, :referido_por,:comision,
                        :agente_id, :status_id, (select  id from tb_idiomas where descripcion=:idioma2)
                         )" ;
                        $sentenciaSQL=$conexion->prepare($sql);
                        $sentenciaSQL->bindParam(":personas_id",$bdPersonasId);           
                        $sentenciaSQL->bindParam(":nombre",$inputFirstName);           
                        $sentenciaSQL->bindParam(":apellido",$inputLastName);           
                        $inputBirthDay=($inputBirthDay=="")?$valorNulo:$inputBirthDay;
                        $sentenciaSQL->bindParam(":fecha_nacimiento",$inputBirthDay);                         
                        $sentenciaSQL->bindParam(":telefono1",$inputPhone);           
                        $sentenciaSQL->bindParam(":nombre_completo",$nombreCompleto);           
                        $sentenciaSQL->bindParam(":tipo_persona_id",$txtTipoPersonaId);            
                        $sentenciaSQL->bindParam(":fecha_cap",$fechaRegistro);           
                        $sentenciaSQL->bindParam(":fecha_act",$fechaActua);   
                        $sentenciaSQL->bindParam(":idioma",$inputLanguage);           
                        $sentenciaSQL->bindParam(":idioma2",$inputLanguage);                                   
                        $sentenciaSQL->bindParam(":comision",$inputPorcentaje);           
                        $sentenciaSQL->bindParam(":persona_act_id",$txtPersonaActId);           
                        $sentenciaSQL->bindParam(":correo",$inputEmail);           
                        $sentenciaSQL->bindParam(":user_login",$inputEmail);           
                        $sentenciaSQL->bindParam(":referido_por",$inputReferidoPor);                                  
                        $sentenciaSQL->bindParam(":agente_id",$inputAgenteId);           
                        $sentenciaSQL->bindParam(":status_id",$txtStatusId);           
                        $sentenciaSQL->execute();                    
                        // Insertar datos de los agentes                        
                        $sql="INSERT INTO tb_agentes_datos (persona_id, lic_number, bank_name, account_name, account_number,
                              routing_number, facebook_url,  instagram_url, tiktok_url, emergency_contact, phone_emergency, 
                              referal_for, aditional_comments, plan_comision_id, porc_comision) 
                        values (:bdPersonasId, :lic_number,  :bank_name, :account_name, :account_number,
                              :routing_number, :facebook_url,  :instagram_url, :tiktok_url, :emergency_contact, :phone_emergency, 
                              :referal_for, :aditional_comments, (select  id from tb_planes_comisiones where porc_agente=:porc_agente),
                              :porc_comision) " ;                            
                        $sentenciaSQL=$conexion->prepare($sql);                        
                        $sentenciaSQL->bindParam(":lic_number",$inputLicNumber);           
                        $sentenciaSQL->bindParam(":bank_name",$inputNombreBanco);                                   
                        $sentenciaSQL->bindParam(":account_name",$inputNombreCuenta);                                   
                        $sentenciaSQL->bindParam(":account_number",$inputNumeroCuenta);                                   
                        $sentenciaSQL->bindParam(":routing_number",$inputNumeroDeRuta);                                   
                        $sentenciaSQL->bindParam(":facebook_url",$inputFaceBook);                                   
                        $sentenciaSQL->bindParam(":instagram_url",$inputInstagram);                                   
                        $sentenciaSQL->bindParam(":tiktok_url",$inputTiktok);                                   
                        $sentenciaSQL->bindParam(":emergency_contact",$inputContactoEmergencia);                                   
                        $sentenciaSQL->bindParam(":phone_emergency",$inputNumeroContactoEmergencia);   
                        $sentenciaSQL->bindParam(":referal_for",$inputReferidoPor);   
                        $sentenciaSQL->bindParam(":aditional_comments",$inputComentarios); 
                        $sentenciaSQL->bindParam(":porc_agente",$inputPorcentaje);                                             
                        $sentenciaSQL->bindParam(":porc_comision",$inputPorcentaje);                           
                        $sentenciaSQL->bindParam(":bdPersonasId",$bdPersonasId);                                   
                        $sentenciaSQL->execute();     
                        // Insertar la direccion en la tabla de direcciones
                        $sql="INSERT INTO tb_direcciones (nombre, direccion, cp, ciudad, estado, pais, fecha_cap, fecha_act, persona_act_id, tipo_persona_id, persona_id, status_id)
                              VALUES                     (:nombre, :direccion, :cp, :ciudad, :estado, :pais, :fecha_cap, :fecha_act, :persona_act_id, :tipo_persona_id, :persona_id, :status_id) ";
                        $txtDireccion="Casa";
                        $txtTipoPersonaId="3";    
                        $txtStatusId="6";
                        $txtPersonaActId="0";
                        $sentenciaSQL=$conexion->prepare($sql);                        
                        $sentenciaSQL->bindParam(":nombre",$txtDireccion);           
                        $sentenciaSQL->bindParam(":direccion",$inputDireccion);                                   
                        $sentenciaSQL->bindParam(":cp",$inputCodigoPostal);                                   
                        $sentenciaSQL->bindParam(":ciudad",$inputCiudad);                                   
                        $sentenciaSQL->bindParam(":estado",$inputEstado);                                   
                        $sentenciaSQL->bindParam(":pais",$inputPais);                                   
                        $sentenciaSQL->bindParam(":fecha_cap",$fechaRegistro);   
                        $sentenciaSQL->bindParam(":fecha_act",$fechaActua);   
                        $sentenciaSQL->bindParam(":persona_act_id",$txtPersonaActId);   
                        $sentenciaSQL->bindParam(":tipo_persona_id",$txtTipoPersonaId);   
                        $sentenciaSQL->bindParam(":persona_id",$bdPersonasId);   
                        $sentenciaSQL->bindParam(":status_id",$txtStatusId);                                   
                        $sentenciaSQL->execute();     
                        
                        
                        
     /*              
                        ?>
                        <div class="alert alert-primary" role="alert">
                        <strong>Atencion </strong> <?php echo "Se registró el agente";  ?>
                        </div>
                        <?php
     */
                                        header("Location: $paginadeGracias");  
                                        die();
                    }                    
        }        
    } catch (PDOException $error) { 
        ?>
        <div class="alert alert-primary" role="alert">
        <strong>Atencion </strong> <?php echo "Error en registro... ".$error;  ?>
        </div>
 <?php  } 
 } ?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Registro de Agentes - Hurtado Realty</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        
    </head>
    <body class="bg-light.bg-gradient">   
            <nav class="sb-topnav navbar navbar-expand navbar-light bg-secondary">
            <!-- Navbar Brand-->

            <a class=" navbar-brand ps-3" href="http://hurtadorealty.com">Hurtado Realty</a>          
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
                        
                            <div class="col-lg-6 mt-5">  
                            <?php if ($txtRutaVideo!="") { ?>
                            <video autoplay controls src="./assets/video/<?php echo $txtRutaVideo; ?>"  width="448"  height="336">                                                               
                            </video>
                                <?php } else { if($txtRutaImagen!="") { ?>
                            <br/>
                            <img src="./wp-content/uploads/documentos/img/<?php echo $txtRutaImagen; ?>" width="448"  height="336"/> 
                                <?php }} ?>
                            </div>
                        </div>    

                        <div class="col-lg-4">                                                                  
                        </div>    
                    </div>    


                        <div class="row justify-content-center">                            
    
                            <div class="col-lg-6">                                                          
                                <div class="card shadow-lg border-0 rounded-lg mt-5">                                                                                                                               
                                <div class="small">                                
                                   
                                   <?php if($cuentaYaExiste!="0"){  echo "" ?>
                                        <div id="error" class="alert alert-danger ocultar" role="alert">Ese correo ya esta registrado en la plataforma! Ingresa con tu usuario y contraseña</div>  
                                   <?php ; }    ?>                                   
                                                                   
                               </div>
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>                                    

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
                                                        <input  value="<?php echo $inputLicNumber;?>" class="form-control" id="inputLicNumber" type="text"  name="inputLicNumber" placeholder="Lic Numbre" />
                                                        <label for="inputLicNumber">Lic Number</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input value="<?php echo $inputNumeroDeRuta;?>" class="form-control" id="inputNumeroDeRuta" type="text"   name="inputNumeroDeRuta" placeholder="Route number" />
                                                        <label for="inputNumeroDeRuta">Route number</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input value="<?php echo $inputDireccion; ?>" class="form-control" id="inputDireccion" type="text" name="inputDireccion"  placeholder="Address" />
                                                <label for="inputDireccion">Addess</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input  value="<?php echo $inputCodigoPostal;?>" class="form-control" id="inputCodigoPostal" type="text"  name="inputCodigoPostal" placeholder="Postal code" />
                                                        <label for="inputCodigoPostal">Postal Code</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input value="<?php echo $inputCiudad;?>" class="form-control" id="inputCiudad" type="text"   name="inputCiudad" placeholder="City" />
                                                        <label for="inputCiudad">City</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input  value="<?php echo $inputEstado;?>" class="form-control" id="inputEstado" type="text"  name="inputEstado" placeholder="State" />
                                                        <label for="inputEstado">State</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input value="<?php echo $inputPais;?>" class="form-control" id="inputPais" type="text"   name="inputPais" placeholder="Country" />
                                                        <label for="inputPais">Country</label>
                                                    </div>
                                                </div>
                                            </div>                                                                                                                                                                                
                                            <div class="form-floating mb-3">
                                                <input value="<?php echo $inputNombreBanco; ?>" class="form-control" id="inputNombreBanco" type="text" name="inputNombreBanco"  placeholder="Bank" />
                                                <label for="inputNombreBanco">Bank name</label>
                                            </div>
                                            
                                            <div class="row mb-3">                                                
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input value="<?php echo $inputNumeroCuenta; ?>" class="form-control" id="inputNumeroCuenta" type="number" name="inputNumeroCuenta"   placeholder="Account number" />
                                                        <label for="inputNumeroCuenta">Account number</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">                                           
                                                        <input value="<?php echo $inputNombreCuenta;?>"  class="form-control" id="inputNombreCuenta" type="text" name="inputNombreCuenta" placeholder="Account name" />
                                                        <label for="inputNombreCuenta">Account name</label>
                                                    </div>
                                                </div>                                                
                                            </div>                                            
                                            <div class="form-floating mb-3">
                                                
                                                <i class="fab fa-facebook" style="font-size:24px"></i>                                                
                                                <input value="<?php echo $inputFaceBook; ?>" class="form-control" id="inputFaceBook" type="text" name="inputFaceBook"  placeholder="FaceBook" />
                                                <label  for="inputFaceBook">FaceBook</label>
                                            </div>                                            
                                            <div class="form-floating mb-3">                                                
                                                <i class="fab fa-instagram" style="font-size:24px"></i>
                                                <input value="<?php echo $inputInstagram; ?>" class="form-control" id="inputInstagram" type="text" name="inputInstagram"  placeholder="  Instagram" />
                                                <label  for="inputInstagram">  Instagram</label>
                                            </div>                                                          
                                            <div class="form-floating mb-3">                                                
                                                <i class="fab fa-tiktok" style="font-size:24px"></i>
                                                <input value="<?php echo $inputTiktok; ?>" class="form-control" id="inputTiktok" type="text" name="inputTiktok"  placeholder="Tiktok" />
                                                <label  for="inputTiktok">Tiktok</label>
                                            </div>                                                          
                                            <div class="row mb-3">                                                
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input value="<?php echo $inputContactoEmergencia; ?>" class="form-control" id="inputContactoEmergencia" type="text" name="inputContactoEmergencia"   placeholder="Emergency Contact" />
                                                        <label for="inputContactoEmergencia">Emergency Contact</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">                                           
                                                        <input value="<?php echo $inputNumeroContactoEmergencia;?>"  class="form-control" id="inputNumeroContactoEmergencia" type="text" name="inputNumeroContactoEmergencia" placeholder="Phone number (Emergency contact)" />
                                                        <label for="inputNumeroContactoEmergencia">Phone number (Emergency contact)</label>
                                                    </div>
                                                </div>                                                
                                            </div>                                            
                                            <div class="row mb-3">                                                
                                                <div class="col-md-6">                                                                                                
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    
                                                                Commission plan
                                                                <br/>
                                                                <div  class="btn-group" role="group" aria-label="Basic checkbox toggle button group">                                                            
                                                                    <input value="90" type="radio" class="btn-check" checked name="btnradio2" id="btncheck4" autocomplete="off">
                                                                    <label class="btn btn-outline-primary" for="btncheck4">90%</label>

                                                                    <input value="85" type="radio" class="btn-check" name="btnradio2" id="btncheck5" autocomplete="off">
                                                                    <label class="btn btn-outline-primary" for="btncheck5">85%</label>

                                                                    <input value="80" type="radio" class="btn-check" name="btnradio2" id="btncheck6" autocomplete="off">
                                                                    <label class="btn btn-outline-primary" for="btncheck6">80%</label>

                                                                    <input value="100" type="radio" class="btn-check" name="btnradio2" id="btncheck7" autocomplete="off">
                                                                    <label class="btn btn-outline-primary" for="btncheck7">100%</label>                                                                    
                                                                </div>                                                        
                                                    </div>        
                                                </div>                                                                                                    
                                                <div class="col-md-6">                                                    
                                                    <div class="form-floating mb-3 mb-md-0">

                                                        <input value="<?php echo $inputReferidoPor; ?>" class="form-control" 
                                                                id="inputReferidoPor" type="text" name="inputReferidoPor" 
                                                                <?php echo ($inputReferidoPor!="")?"disabled":""?>
                                                                placeholder="Referred by" />
                                                        <label for="inputReferidoPor">Referred by</label>
                                                    </div>                                                                                                                
                                                </div>                                                                                             
                                            </div>                                            

                                            <div class="row mb-3">   
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        Language 
                                                        <br/>
                                                        <div  class="btn-group" role="group" aria-label="Basic checkbox toggle button group">                                                            
                                                            <input value="Spanish" type="radio" class="btn-check" checked name="btnradio" id="btncheck1" autocomplete="off">
                                                            <label class="btn btn-outline-primary" for="btncheck1">Spanish</label>

                                                            <input value="English" type="radio" class="btn-check" name="btnradio" id="btncheck2" autocomplete="off">
                                                            <label class="btn btn-outline-primary" for="btncheck2">English</label>

                                                            <input value="French" type="radio" class="btn-check" name="btnradio" id="btncheck3" autocomplete="off">
                                                            <label class="btn btn-outline-primary" for="btncheck3">French</label>
                                                        </div>                                                        
                                                    </div>
                                                </div>                                                    
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <div class="mb-3">
                                                          <label for="" class="form-label">Comments</label>
                                                          <textarea class="form-control" name="inputComentarios" id="inputComentarios" rows="3"></textarea>
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
                            </div>      
                            <div class="col-lg-6 mt-5">  
                            <video autoplay controls src="./assets/video/bienvenidaAgentes.MP4" width="640"  height="480">                                    
                            <img src="./assets/img/imgRegistro.jpeg" alt="Video no soportado" />Su navegador no soporta este formato de video                                
                            </video>
                            </div> -->
                        </div>
                    </div>
                </main>
            </div>
            
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
