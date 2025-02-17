<script>
                                            function pregunta() {
                                                if (confirm('¿Estas seguro de grabar la información?')) {
                                                    document.getElementById('miformulario').submit();
                                                }
                                            }

                                            document.addEventListener('DOMContentLoaded', function() {
                                            document.getElementById('enviar').addEventListener('click', function(e) {
                                                e.preventDefault();
                                                pregunta()
                                            });
                                            });

                                                                                     
</script>                                                             
<?php
    include("bd.php");
$paginadeConsultadeDocumentos="doctos_tennant.php";
$paginadeOnBoarding="https://hurtadorealty.com/onboarding";
$valorNulo=NULL;    
$txtPersonaId="1"    ;
$txtStatusId="1";
$inputAddress="";
$inputLeaseStarts=NULL;
$inputLeaseEnds=NULL;
$inputContactInformation="";
$inputLandor1_name="";
$inputLandor1_phone="";
$inputLandor1_email="";
$inputLandor2_name="";
$inputLandor2_phone="";
$inputLandor2_email="";
$inputTennant1_name="";
$inputTennant1_phone="";
$inputTennant1_email="";
$inputTennant2_name="";
$inputTennant2_phone="";
$inputTennant2_email="";
$inputRadio1="1";
$inputDepositInstructions="";
$inputBankName="";
$inputRoutingNumber="";
$inputBankAccountNumber="";


session_start();


      if (isset($_SESSION)) {
        if(isset($_SESSION['login'])!='true' ){
          echo "no logeuado";    
          header("location:login.php");
        }
        }       
  
      include("cabecera.php");
      
      if ($_GET){
        if (isset($_GET["psn_id"]))
        {  $inputPersonaId=$_GET["psn_id"];                      
           if (is_numeric($_GET["psn_id"])){
                  $txtPersonaId="landlords.php"."?psn_id=".$inputPersonaId; 
                  //$inputReferidoPor=referidoPor($inputAgenteId,$conexion);
                  list($inputAddress,$inputLandor1_name,$inputTennant1_name)=DatosLandlords($inputPersonaId,$conexion);                  
           } else {$txtPersonaId="landlords.php";
                   $inputPersonaId="0";
                   
                   }
           
        }
       } 


      if ($_POST)
      {
        
        $inputAddress               =( isset($_POST["inputAddress"]) )? $_POST["inputAddress"]:""  ; 
        $inputLeaseStarts           =( isset($_POST["inputLeaseStarts"]) )? $_POST["inputLeaseStarts"]:""  ; 
        $inputLeaseEnds             =( isset($_POST["inputLeaseEnds"]) )? $_POST["inputLeaseEnds"]:""  ; 
        $inputContactInformation    =( isset($_POST["inputContactInformation"]) )? $_POST["inputContactInformation"]:""  ; 
        $inputLandor1_name          =( isset($_POST["inputLandor1_name"]) )? $_POST["inputLandor1_name"]:""  ; 
        $inputLandor1_phone         =( isset($_POST["inputLandor1_phone"]) )? $_POST["inputLandor1_phone"]:""  ; 
        $inputLandor1_email         =( isset($_POST["inputLandor1_email"]) )? $_POST["inputLandor1_email"]:""  ; 
        $inputLandor2_name          =( isset($_POST["inputLandor2_name"]) )? $_POST["inputLandor2_name"]:""  ; 
        $inputLandor2_phone         =( isset($_POST["inputLandor2_phone"]) )? $_POST["inputLandor2_phone"]:""  ; 
        $inputLandor2_email         =( isset($_POST["inputLandor2_email"]) )? $_POST["inputLandor2_email"]:""  ; 
        $inputTennant1_name         =( isset($_POST["inputTennant1_name"]) )? $_POST["inputTennant1_name"]:""  ; 
        $inputTennant1_phone        =( isset($_POST["inputTennant1_phone"]) )? $_POST["inputTennant1_phone"]:""  ; 
        $inputTennant1_email        =( isset($_POST["inputTennant1_email"]) )? $_POST["inputTennant1_email"]:""  ; 
        $inputTennant2_name         =( isset($_POST["inputTennant2_name"]) )? $_POST["inputTennant2_name"]:""  ; 
        $inputTennant2_phone        =( isset($_POST["inputTennant2_phone"]) )? $_POST["inputTennant2_phone"]:""  ; 
        $inputTennant2_email        =( isset($_POST["inputTennant2_email"]) )? $_POST["inputTennant2_email"]:""  ; 

        
        $inputRadio1=( isset($_POST["btnradio1"]) )? $_POST["btnradio1"]:""  ; 
        
        try {
           
            $sql="INSERT INTO tb_doc_landlords (
            persona_id, fecha, status_id, address, lease_starts, lease_ends, contact_information,
            landlord1_name, landlord1_phone, landlord1_email, landlord2_name, landlord2_phone, landlord2_email,
            tennant1_name, tennant1_phone, tennant1_email, tennant2_name, tennant2_phone, tennant2_email,
            payment_willbe, deposit_instructions, bank_name, routing_number, bank_account_number    
            )    VALUES ( 
                :persona_id, 
                :fecha, 
                :status_id, 
                :address, :lease_starts, :lease_ends, :contact_information,
                :landlord1_name, :landlord1_phone, :landlord1_email, :landlord2_name, :landlord2_phone, :landlord2_email,
                :tennant1_name, :tennant1_phone, :tennant1_email, :tennant2_name, :tennant2_phone, :tennant2_email,
                :payment_willbe, :deposit_instructions, :bank_name, :routing_number, :bank_account_number )";

            
            $fechaReg=new DateTime("now",null);    
            $fechaRegistro=$fechaReg->format('Y-m-d 00:00:00');

            if ($inputLeaseStarts=="") { $inputLeaseStarts=NULL; }
            if ($inputLeaseEnds=="") { $inputLeaseEnds=NULL; }
            
            $sentenciaSQL=$conexion->prepare($sql);                        
            $sentenciaSQL->bindParam(":persona_id",$txtPersonaId);           
            $sentenciaSQL->bindParam(":fecha",$fechaRegistro);                                   
            $sentenciaSQL->bindParam(":status_id",$txtStatusId);                                   
            $sentenciaSQL->bindParam(":address",$inputAddress);                                   
            $sentenciaSQL->bindParam(":lease_starts",$inputLeaseStarts);                                   
            $sentenciaSQL->bindParam(":lease_ends",$inputLeaseEnds);                                   
            $sentenciaSQL->bindParam(":contact_information",$inputContactInformation);   
            
            $sentenciaSQL->bindParam(":landlord1_name",$inputLandor1_name);   
            $sentenciaSQL->bindParam(":landlord1_phone",$inputLandor1_phone);   
            $sentenciaSQL->bindParam(":landlord1_email",$inputLandor1_email);   

            $sentenciaSQL->bindParam(":landlord2_name",$inputLandor2_name);   
            $sentenciaSQL->bindParam(":landlord2_phone",$inputLandor2_phone);                                   
            $sentenciaSQL->bindParam(":landlord2_email",$inputLandor2_email);                                   


            $sentenciaSQL->bindParam(":tennant1_name",$inputTennant1_name);                                   
            $sentenciaSQL->bindParam(":tennant1_phone",$inputTennant2_phone);                                   
            $sentenciaSQL->bindParam(":tennant1_email",$inputTennant2_email);   
            $sentenciaSQL->bindParam(":tennant2_name",$inputTennant2_name);               
            $sentenciaSQL->bindParam(":tennant2_phone",$inputTennant2_phone);   
            $sentenciaSQL->bindParam(":tennant2_email",$inputTennant2_email);   

            
            $sentenciaSQL->bindParam(":payment_willbe",$inputRadio11);   
            $sentenciaSQL->bindParam(":deposit_instructions",$inputDepositInstructions);
            $sentenciaSQL->bindParam(":bank_name",$inputBankName);
            $sentenciaSQL->bindParam(":routing_number",$inputRoutingNumber);   
            $sentenciaSQL->bindParam(":bank_account_number",$inputBankAccountNumber);
            
            $sentenciaSQL->execute();          

           // con esta funcion direcciona a la pagina de consulta           
           ?>
            <Script languaje="JavaScript">
                     location ="doctos_tennant.php"
            </Script>
            <?php            
            
        } catch (PDOException $error) { 
            ?>
            <div class="alert alert-primary" role="alert">
            <strong>Atencion </strong> <?php echo "Error en registro... ".$error;  ?>
            echo error
            </div>
            <?php 
        }
      }

?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Landlords  </h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Captura de documento</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p class="mb-0">
                                    Favor de llenar toda la información solicitada.
                                    <button  id="btnConsulta" name="btnConsulta" type="button" onclick="location.href='<?php echo $paginadeConsultadeDocumentos; ?>'" class="btn btn-primary">Consultar </button>
                                </p>
                             
                            </div>
                        </div>
                        
                        <section class="container">
                            <div class="row justify-content-center">                            
                                <!-- <div class="row mb-3">                                 -->
                                    <div class="col-lg-5">                                                                                          

                                        <form id="miformulario" action=""     method="post">                                
                                                    <div class="row mb-3">                                          
                                                        <div class="col-md-0">                                                                                                                                                           
                                                            <div class="form-floating mb-0">
                                                                    <input value="<?php echo $inputAddress; ?>" class="form-control" id="inputAddress" type="text" name="inputAddress"  placeholder="Address" />
                                                                    <label  for="inputAddress">    Address</label>                                                       
                                                            </div   >        
                                                        </div   >                                                                                                                
                                                    </div   >                                                            
                                                    <div class="row mb-3">                                                
                                                        <div class="col-md-6">                                                    
                                                            <div class="form-floating mb-0">                                                
                                                                    <input value="<?php echo $inputLeaseStarts; ?>" class="form-control" id="inputLeaseStarts" type="date" name="inputLeaseStarts"  placeholder="  Lease Starts" />
                                                                    <label  for="inputLeaseStarts">  Lease Starts</label>                                                                                                                                                                               
                                                            </div   >        
                                                        </div   >        
                                                        <div class="col-md-6">                                                                                                            
                                                            <div class="form-floating mb-0">                                                                                                       
                                                                    <!-- <i class="fab " style="font-size:24px"></i> -->
                                                                    <input value="<?php echo $inputLeaseEnds; ?>" class="form-control" id="inputLeaseEnds" type="date" name="inputLeaseEnds"  placeholder="  Lease Ends" />
                                                                    <label  for="inputLeaseEnds">  Lease Ends</label>                                                                                                                                                                               
                                                            </div   >             
                                                        </div   >             
                                                    </div   >                                                             
                                                    <div class="row mb-3">                                                             
                                                        <div class="col-md-0">        
                                                            <div class="form-floating mb-0">                                                                                                                                                                                    
                                                                    <input value="<?php echo $inputContactInformation; ?>" class="form-control" name="inputContactInformation" id="inputContactInformation" placeholder="Contact Information" ></input>
                                                                    <label for="inputContactInformation" class="form-label">Contact information</label>                                                                
                                                                
                                                            </div>            
                                                        </div>                                                                        
                                                    </div>                                                                    
                                                                                                                                                                                                               
                                                    <div class="row mb-3">                                                       
                                                        <div class="col-md-0">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                                <input value="<?php echo $inputLandor1_name; ?>" class="form-control" id="inputLandor1_name" type="text" name="inputLandor1_name"   placeholder="Landlord Name" />
                                                                <label for="inputLandor1_name"> Landlord Name</label>
                                                            </div>
                                                        </div>                                                                                                             
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">                                                            
                                                                <input value="<?php echo $inputLandor1_phone; ?>" class="form-control" id="inputLandor1_phone" type="text" name="inputLandor1_phone"   placeholder="Phone" />
                                                                <label for="inputLandor1_phone">Phone</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                                <input value="<?php echo $inputLandor1_email; ?>"  class="form-control" id="inputLandor1_email" type="email" name="inputLandor1_email" placeholder="Email" />
                                                                <label for="inputLandor1_email"> Email</label>
                                                            </div>
                                                        </div>                                                
                                                    </div>

                                                    <div class="row mb-3">                                                       
                                                        <div class="col-md-0">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                                <input value="<?php echo $inputLandor2_name; ?>" class="form-control" id="inputLandor2_name" type="text" name="inputLandor2_name"   placeholder="Landlord Name" />
                                                                <label for="inputLandor2_name"> Landlord Name</label>
                                                            </div>
                                                        </div>                                                                                                               
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">                                                            
                                                                <input value="<?php echo $inputLandor2_phone; ?>" class="form-control" id="inputLandor2_phone" type="text" name="inputLandor2_phone"   placeholder="Phone" />
                                                                <label for="inputLandor2_phone">Phone</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                                <input value="<?php echo $inputLandor2_email; ?>"  class="form-control" id="inputLandor2_email" type="email" name="inputLandor2_email" placeholder="Email" />
                                                                <label for="inputLandor2_email"> Email</label>
                                                            </div>
                                                        </div>                                                
                                                    </div>
                                                    
                                                    <div class="row mb-3">                                                       
                                                        <div class="col-md-0">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                                <input value="<?php echo $inputTennant1_name; ?>" class="form-control" id="inputTennant1_name" type="text" name="inputTennant1_name"   placeholder="Tennant Name" />
                                                                <label for="inputTennant1_name"> Tennant Name</label>
                                                            </div>
                                                        </div>                                                                                                             
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">                                                            
                                                                <input value="<?php echo $inputTennant1_phone; ?>" class="form-control" id="inputTennant1_phone" type="text" name="inputTennant1_phone"   placeholder="Phone" />
                                                                <label for="inputTennant1_phone">Phone</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                                <input value="<?php echo $inputTennant1_email; ?>"  class="form-control" id="inputTennant1_email" type="email" name="inputTennant1_email" placeholder="Email" />
                                                                <label for="inputTennant1_email"> Email</label>
                                                            </div>
                                                        </div>                                                
                                                    </div>                                                    

                                                    <div class="row mb-3">                                                       
                                                        <div class="col-md-0">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                                <input value="<?php echo $inputTennant2_name; ?>" class="form-control" id="inputTennant2_name" type="text" name="inputTennant2_name"   placeholder="Tennant Name" />
                                                                <label for="inputTennant2_name"> Tennant Name</label>
                                                            </div>
                                                        </div>                                                                                                             
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">                                                            
                                                                <input value="<?php echo $inputTennant2_phone; ?>" class="form-control" id="inputTennant2_phone" type="text" name="inputTennant2_phone"   placeholder="Phone" />
                                                                <label for="inputTennant2_phone">Phone</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                                <input value="<?php echo $inputTennant2_email; ?>"  class="form-control" id="inputTennant2_email" type="email" name="inputTennant2_email" placeholder="Email" />
                                                                <label for="inputTennant2_email"> Email</label>
                                                            </div>
                                                        </div>                                                
                                                    </div>                                                    
                                                                                                                                                                                                                                                      
                                                    <div class="row mb-3">                                                
                                                        <div class="col-md-9">
                                                            <!-- <div class="form-floating mb-3 mb-md-0">                                                         -->
                                                                Pay will Be
                                                                <div  class="btn-group" role="group" aria-label="Basic checkbox toggle button group">                                                                                                                                 
                                                                    <input value="1" type="radio" class="btn-check"  name="btnradio1" id="btncheck1" autocomplete="off"  <?php if($inputRadio1=="1"){  echo "checked" ;} ?> >
                                                                    <label class="btn btn-outline-primary" for="btncheck1">Cash</label>
                                                                    <input value="2" type="radio" class="btn-check" name="btnradio1" id="btncheck2" autocomplete="off" <?php if($inputRadio1=="2"){  echo "checked" ;} ?> >
                                                                    <label class="btn btn-outline-primary" for="btncheck2">Deposit</label>
                                                                    <input value="3" type="radio" class="btn-check" name="btnradio1" id="btncheck3" autocomplete="off" <?php if($inputRadio1=="3"){  echo "checked" ;} ?> >
                                                                    <label class="btn btn-outline-primary" for="btncheck3">Cashier check</label>                                                                    
                                                                </div>                                                        
                                                            <!-- </div> -->
                                                        </div>    
                                                        
                                                    </div   >           
                                                    
                                                    
                                                    <div class="row mb-3">
                                                        <div class="col-md-0">
                                                            <div class="form-floating mb-3 mb-md-0">                                                            
                                                                <input value="<?php echo $inputDepositInstructions; ?>" class="form-control" id="inputDepositInstructions" type="text" name="inputDepositInstructions"  placeholder="Deposit Instructions" />
                                                                <label for="inputDepositInstructions"> Deposit Instructions</label>
                                                            </div>
                                                        </div>                                                        
                                                                                                                
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-0">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                            
                                                                <input value="<?php echo $inputBankName; ?>" class="form-control" id="inputBankName" type="text" name="inputBankName"  placeholder="Bank Name" />
                                                                <label for="inputBankName">Bank Name</label>
                                                            </div>
                                                        </div>                                                        
                                                        
                                                    </div>            
                                                    <div class="row mb-3">
                                                        <div class="col-md-0">
                                                            <div class="form-floating mb-3 mb-md-0">                                                            
                                                                <input value="<?php echo $inputRoutingNumber; ?>" class="form-control" id="inputRoutingNumber" type="text" name="inputRoutingNumber"  placeholder="Routing Number" />
                                                                <label for="inputRoutingNumber"> Name</label>
                                                            </div>
                                                        </div>                                                                                                                                                            
                                                    </div>                                                                
                                                    
                                                    <div class="row mb-3">
                                                        <div class="col-md-0">
                                                            <div class="form-floating mb-3 mb-md-0">                                                            
                                                                <input value="<?php echo $inputBankAccountNumber; ?>" class="form-control" id="inputBankAccountNumber" type="text" name="inputBankAccountNumber"  placeholder="Bank Account Numbe" />
                                                                <label for="inputBankAccountNumber"> Bank Account Number</label>
                                                            </div>
                                                        </div>                                                                                                                                                            
                                                    </div>                                                            



                                                    <div class="mt-4 mb-0">                                           
                                                        <div class="d-grid">
                                                            <button id="enviar" value="Enviar" class="btn btn-primary btn-block"  type="submit" >Grabar datos</button> 
                                                        </div>                                                                                                
                                                    </div>

                                        </form>               
                                        
                                    </div>        
                                <!-- </div>                                             -->
                            </div>
                        </section>


                        <div style="height: 100vh"></div>
                        <div class="card mb-4"><div class="card-body">When scrolling, the navigation stays at the top of the page. This is the end of the static navigation demo.</div></div>
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
    </body>
</html>
