<?php
  
  //  instruccion para conectarse a la base de datos
   $servidor="app.hurtadorealty.com";
   $baseDeDatos="hurtadorealty";
   $usuario="hurtadorealty";
   $contrasenia="xS2Dc0QFQbMvuQ8A";
   
   function existeCorreo($correoUsuario, $conexion)
   {
    $sql="SELECT * FROM tb_personas_datos_extra  WHERE correo=:correo";
    $sentencia=$conexion->prepare($sql);
    $sentencia->bindparam(":correo",$correoUsuario); 
    $sentencia->execute();
    $resultado=$sentencia->fetch(PDO::FETCH_LAZY);
    if (isset($resultado["correo"])) return "1"; else return "0";         
   }

   function referidoPor($agente_id,$conexion)
   {
       $sql="SELECT * FROM tb_personas_datos_extra  WHERE personas_id=:personas_id";
       $sentencia=$conexion->prepare($sql);
       $sentencia->bindparam(":personas_id",$agente_id); 
       $sentencia->execute();
       $resultado=$sentencia->fetch(PDO::FETCH_LAZY);  
       if (isset($resultado["nombre_completo"])) {
           return $resultado["nombre_completo"];
       }   
   }
   function referidoPor2($agente_id,$conexion)
   {
       $sql="SELECT * from tb_personas_datos_extra a
             left join tb_videos_agentes b on a.personas_id=b.persona_id
             left join tb_doctos_sistema c  on a.personas_id=c.persona_id and tipodoc=5
             where  a.personas_id=:personas_id";
             
       $sentencia=$conexion->prepare($sql);
       $sentencia->bindparam(":personas_id",$agente_id); 
       $sentencia->execute();
       $resultado=$sentencia->fetch(PDO::FETCH_LAZY);  
       if (isset($resultado["nombre_completo"])) {                  
           return array(  $resultado["nombre_completo"], $resultado["nombre_archivo"], $resultado["nombrearchivo"]);
       }   
   }
   function DatosLandlords($persona_id,$conexion)
   {
       $sql="SELECT * from tb_doc_landlords a             
             where  a.persona_id=:persona_id";
             
       $sentencia=$conexion->prepare($sql);
       $sentencia->bindparam(":persona_id",$persona_id); 
       $sentencia->execute();
       $resultado=$sentencia->fetch(PDO::FETCH_LAZY);  
       if (isset($resultado["address"])) {                  
           return array(  $resultado["address"], $resultado["landlord1_name"], $resultado["tennant1_name"]);
       }   
   }


     try {
        $conexion=new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$contrasenia);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
        //echo "Conexion establecida";

       // $sql="INSERT INTO fotos (ID, nombre, ruta) VALUES(NULL,'Una foto mas','foto2.jpg') ";
        
       // $conexion->exec($sql);

     } catch (PDOException $error) {          ?>
     <?php//     echo "No se puedo conectar con el servidor... "; ?>
          <div class="alert alert-primary" role="alert">
            <strong>Atencion </strong> <?php echo "No se puedo conectar con el servidor... ".$error;  ?>
          </div>
          
          
     <?php }  ?>


