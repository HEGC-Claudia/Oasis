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
$inputApplicantName="";
$inputApplicantBirthday=NULL;
$inputMaritalStatus="";
$inputSSNumber="";
$inputStateDriverLic="";
$inputSpouseName="";
$inputSpouseBirthday=NULL;
$inputSpouseSSNumber="";
$inputSpouseStateDriverLic="";
$inputPresentAddress="";
$inputPhoneNumber="";
$inputSpousePhoneNumber="";
$inputEmailAddress="";
$inputSpouseEmailAddress="";
$inputPetKindWeight="";
$imputPet=0;
$inputOtrOcupName1="";
$inputBirthDate1=NULL;
$inputRelationship1="";
$inputOtrOcupName2="";
$inputBirthDate2=NULL;
$inputRelationship2="";
$inputOtrOcupName3="";
$inputBirthDate3=NULL;
$inputRelationship3="";
$inputOtrOcupName4="";
$inputBirthDate4=NULL;
$inputRelationship4="";

$inputCurrentLandlordName="";
$inputCurrentLandlordPhone="";
$inputDatesFrom=NULL;
$inputDatesTo=NULL;
$inputMonthlyRentAmount=0;
$inputReasonforMoving="";
$inputExplain1="";
$inputExplain2="";
$inputCurrentEmployer="";
$inputCurrentPosition="";
$inputEmployerAddress="";
$inputSupervisorName="";
$inputSupervisorPhone="";
$inputEmployedFrom=NULL;
$inputEmployedTo=NULL;
$inputSalaryorWages=0;

$inputSpouseCurrentEmployer="";
$inputSpouseCurrentPosition="";
$inputSpouseEmployerAddress="";
$inputSpouseSupervisorName="";
$inputSpouseSupervisorPhone="";
$inputSpouseEmployedFrom=NULL;
$inputSpouseEmployedTo=NULL;
$inputSpouseSalaryorWages=0;

$inputOtherIncome="";
$inputReferenceName1="";
$inputReferencePhone1="";
$inputReferenceRelationship1="";
$inputReferenceName2="";
$inputReferencePhone2="";
$inputReferenceRelationship2="";
$inputReferenceName3="";
$inputReferencePhone3="";
$inputReferenceRelationship3="";
$inputRadio1="0";
$inputRadio2=0;
$inputRadio3=0;
$inputRadio4=0;
$inputRadio5=0;


session_start();


      if (isset($_SESSION)) {
        if(isset($_SESSION['login'])!='true' ){
          echo "no logeuado";    
          header("location:login.php");
        }
        }       
  
      include("cabecera.php");
      
      if ($_POST)
      {
        
        $inputApplicantName     =( isset($_POST["inputApplicantName"]) )? $_POST["inputApplicantName"]:""  ; 
        $inputApplicantBirthday =( isset($_POST["inputApplicantBirthday"]) )? $_POST["inputApplicantBirthday"]:NULL  ; 
        $inputMaritalStatus     =( isset($_POST["inputMaritalStatus"]) )? $_POST["inputMaritalStatus"]:""  ; 
        $inputSSNumber          =( isset($_POST["inputSSNumber"]) )? $_POST["inputSSNumber"]:""  ; 
        $inputStateDriverLic    =( isset($_POST["inputStateDriverLic"]) )? $_POST["inputStateDriverLic"]:""  ; 
        $inputSpouseBirthday    =( isset($_POST["inputSpouseBirthday"]) )? $_POST["inputSpouseBirthday"]:NULL  ; 
        $inputSpouseSSNumber=( isset($_POST["inputSpouseSSNumber"]) )? $_POST["inputSpouseSSNumber"]:""  ; 
        $inputSpouseStateDriverLic=( isset($_POST["inputSpouseStateDriverLic"]) )? $_POST["inputSpouseStateDriverLic"]:""  ; 
        $inputPresentAddress=( isset($_POST["inputPresentAddress"]) )? $_POST["inputPresentAddress"]:""  ; 
        $inputPhoneNumber=( isset($_POST["inputPhoneNumber"]) )? $_POST["inputPhoneNumber"]:""  ; 
        $inputSpousePhoneNumber=( isset($_POST["inputSpousePhoneNumber"]) )? $_POST["inputSpousePhoneNumber"]:""  ; 
        $inputEmailAddress=( isset($_POST["inputEmailAddress"]) )? $_POST["inputEmailAddress"]:""  ; 
        $inputSpouseEmailAddress=( isset($_POST["inputSpouseEmailAddress"]) )? $_POST["inputSpouseEmailAddress"]:""  ; 
        $inputPetKindWeight=( isset($_POST["inputPetKindWeight"]) )? $_POST["inputPetKindWeight"]:""  ; 
        $inputOtrOcupName1=( isset($_POST["inputOtrOcupName1"]) )? $_POST["inputOtrOcupName1"]:""  ; 
        $inputBirthDate1=( isset($_POST["inputBirthDate1"]) )? $_POST["inputBirthDate1"]:NULL  ;         
        $inputRelationship1=( isset($_POST["inputRelationship1"]) )? $_POST["inputRelationship1"]:""  ; 
        $inputOtrOcupName2=( isset($_POST["inputOtrOcupName2"]) )? $_POST["inputOtrOcupName2"]:""  ; 
        $inputBirthDate2=( isset($_POST["inputBirthDate2"]) )? $_POST["inputBirthDate2"]:NULL  ; 
        $inputRelationship2=( isset($_POST["inputRelationship2"]) )? $_POST["inputRelationship2"]:""  ; 
        $inputOtrOcupName3=( isset($_POST["inputOtrOcupName3"]) )? $_POST["inputOtrOcupName3"]:""  ; 
        $inputBirthDate3=( isset($_POST["inputBirthDate3"]) )? $_POST["inputBirthDate3"]:NULL  ; 
        $inputRelationship3=( isset($_POST["inputRelationship3"]) )? $_POST["inputRelationship3"]:""  ; 
        $inputOtrOcupName4=( isset($_POST["inputOtrOcupName4"]) )? $_POST["inputOtrOcupName4"]:""  ; 
        $inputBirthDate4=( isset($_POST["inputBirthDate4"]) )? $_POST["inputBirthDate4"]:NULL  ; 
        $inputRelationship4=( isset($_POST["inputRelationship4"]) )? $_POST["inputRelationship4"]:""  ;         
        $inputCurrentLandlordName=( isset($_POST["inputCurrentLandlordName"]) )? $_POST["inputCurrentLandlordName"]:""  ; 
        $inputCurrentLandlordPhone=( isset($_POST["inputCurrentLandlordPhone"]) )? $_POST["inputCurrentLandlordPhone"]:""  ; 
        $inputDatesFrom=( isset($_POST["inputDatesFrom"]) )? $_POST["inputDatesFrom"]:NULL  ; 
        $inputDatesTo=( isset($_POST["inputDatesTo"]) )? $_POST["inputDatesTo"]:NULL  ; 

        $inputMonthlyRentAmount=( isset($_POST["inputMonthlyRentAmount"]) )? $_POST["inputMonthlyRentAmount"]:""  ; 
        $inputReasonforMoving=( isset($_POST["inputReasonforMoving"]) )? $_POST["inputReasonforMoving"]:""  ; 
        $inputExplain1=( isset($_POST["inputExplain1"]) )? $_POST["inputExplain1"]:""  ; 
        $inputExplain2=( isset($_POST["inputExplain2"]) )? $_POST["inputExplain2"]:""  ; 

        $inputCurrentEmployer=( isset($_POST["inputCurrentEmployer"]) )? $_POST["inputCurrentEmployer"]:""  ; 
        $inputCurrentPosition=( isset($_POST["inputCurrentPosition"]) )? $_POST["inputCurrentPosition"]:""  ; 
        $inputEmployerAddress=( isset($_POST["inputEmployerAddress"]) )? $_POST["inputEmployerAddress"]:""  ; 
        $inputSupervisorName=( isset($_POST["inputSupervisorName"]) )? $_POST["inputSupervisorName"]:""  ; 
        $inputSupervisorPhone=( isset($_POST["inputSupervisorPhone"]) )? $_POST["inputSupervisorPhone"]:""  ; 
        $inputEmployedFrom=( isset($_POST["inputEmployedFrom"]) )? $_POST["inputEmployedFrom"]:NULL  ; 
        $inputEmployedTo=( isset($_POST["inputEmployedTo"]) )? $_POST["inputEmployedTo"]:NULL  ; 
        $inputSalaryorWages=( isset($_POST["inputSalaryorWages"]) )? $_POST["inputSalaryorWages"]:""  ; 

        $inputSpouseCurrentEmployer=( isset($_POST["inputSpouseCurrentEmployer"]) )? $_POST["inputSpouseCurrentEmployer"]:""  ; 
        $inputSpouseCurrentPosition=( isset($_POST["inputSpouseCurrentPosition"]) )? $_POST["inputSpouseCurrentPosition"]:""  ; 
        $inputSpouseEmployerAddress=( isset($_POST["inputSpouseEmployerAddress"]) )? $_POST["inputSpouseEmployerAddress"]:""  ; 
        $inputSpouseSupervisorName=( isset($_POST["inputSpouseSupervisorName"]) )? $_POST["inputSpouseSupervisorName"]:""  ; 
        $inputSpouseSupervisorPhone=( isset($_POST["inputSpouseSupervisorPhone"]) )? $_POST["inputSpouseSupervisorPhone"]:""  ; 
        $inputSpouseEmployedFrom=( isset($_POST["inputSpouseEmployedFrom"]) )? $_POST["inputSpouseEmployedFrom"]:""  ; 
        $inputSpouseEmployedTo=( isset($_POST["inputSpouseEmployedTo"]) )? $_POST["inputSpouseEmployedTo"]:""  ; 
        $inputSpouseSalaryorWages=( isset($_POST["inputSpouseSalaryorWages"]) )? $_POST["inputSpouseSalaryorWages"]:""  ; 


        $inputOtherIncome=( isset($_POST["inputOtherIncome"]) )? $_POST["inputOtherIncome"]:""  ; 
        $inputReferenceName1=( isset($_POST["inputReferenceName1"]) )? $_POST["inputReferenceName1"]:""  ; 
        $inputReferencePhone1=( isset($_POST["inputReferencePhone1"]) )? $_POST["inputReferencePhone1"]:""  ; 
        $inputReferenceRelationship1=( isset($_POST["inputReferenceRelationship1"]) )? $_POST["inputReferenceRelationship1"]:""  ; 
        $inputReferenceName2=( isset($_POST["inputReferenceName2"]) )? $_POST["inputReferenceName2"]:""  ; 
        $inputReferencePhone2=( isset($_POST["inputReferencePhone2"]) )? $_POST["inputReferencePhone2"]:""  ; 
        $inputReferenceRelationship2=( isset($_POST["inputReferenceRelationship2"]) )? $_POST["inputReferenceRelationship2"]:""  ; 
        $inputReferenceName2=( isset($_POST["inputReferenceName2"]) )? $_POST["inputReferenceName2"]:""  ; 
        $inputReferencePhone2=( isset($_POST["inputReferencePhone2"]) )? $_POST["inputReferencePhone2"]:""  ; 
        $inputReferenceRelationship2=( isset($_POST["inputReferenceRelationship2"]) )? $_POST["inputReferenceRelationship2"]:""  ; 
        $inputReferenceName3=( isset($_POST["inputReferenceName3"]) )? $_POST["inputReferenceName3"]:""  ; 
        $inputReferencePhone3=( isset($_POST["inputReferencePhone3"]) )? $_POST["inputReferencePhone3"]:""  ; 
        $inputReferenceRelationship3=( isset($_POST["inputReferenceRelationship3"]) )? $_POST["inputReferenceRelationship3"]:""  ; 


        $inputRadio1=( isset($_POST["btnradio1"]) )? $_POST["btnradio1"]:""  ; 
        $inputRadio2=( isset($_POST["btnradio2"]) )? $_POST["btnradio2"]:""  ; 
        $inputRadio3=( isset($_POST["btnradio3"]) )? $_POST["btnradio3"]:""  ; 
        $inputRadio4=( isset($_POST["btnradio4"]) )? $_POST["btnradio4"]:""  ;         
        $inputRadio5=( isset($_POST["btnradio5"]) )? $_POST["btnradio5"]:""  ;                 

        try {
           
            $sql="INSERT INTO tb_doc_tenant_application (
            persona_id, 
            fecha, 
            status_id, 
            applicant_name, 
            birtdhday_applicant, 
            marital_status, 
            ss_num, 
            driver_lic_num, 
            spouse_name, 
            spouse_birthday, 
            
            spouse_ss, 
            spouse_driver_lic_num,                                
            present_address, 
            phone_number, 
            spouse_phone_number, 
            email_address,
            spouse_email, 
            pets, 
            pet_kind_weight, 
            ocup1_name, 
            
            ocup1_birthday, 
            ocup1_relation, 
            ocup2_name, 
            ocup2_birthday,
            ocup2_relation, 
            ocup3_name, 
            ocup3_birthday, 
            ocup3_relation, 
            ocup4_name, 
            ocup4_birthday, 

            ocup4_relation, 
            current_landlord_name,
            current_landlord_phone, 
            dates_from, 
            dates_to,                                
            montly_rent_amount, 
            reason_moving, 
            desalojado, 
            desalojado_razon, 
            condenado_por_delito, 

            condenado_razon, 
            ce_name, 
            ce_position, 
            ce_address, 
            ce_superv_name, 
            ce_superv_phone,
            ce_from, 
            ce_to, 
            ce_salary, 
            sal_mon_hou, 

            spouse_emp_name, 
            spouse_emp_pos, 
            spouse_emp_address, 
            spouse_emp_sup_name, 
            spouse_emp_sup_phone, 
            spouse_emp_from, 
            spouse_emp_to,
            spouse_emp_salary, 
            spouse_emp_sal_mon_hou, 
            other_income,

            p_ref1_name,
            p_ref1_phone, 
            p_ref1_rel, 
            p_ref2_name, 
            p_ref2_phone, 
            p_ref2_rel, 
            p_ref3_name, 
            p_ref3_phone, 
            p_ref3_rel
            )
                 VALUES ( 
                 :persona_id, 
                 :fecha, 
                 :status_id, 
                 :applicant_name, 
                 :birtdhday_applicant, 
                 :marital_status, 
                 :ss_num, 
                 :driver_lic_num, 
                 :spouse_name, 
                 :spouse_birthday, 
                 
                 :spouse_ss, :spouse_driver_lic_num, :present_address, :phone_number, :spouse_phone_number, :email_address, :spouse_email, :pets, :pet_kind_weight, :ocup1_name, 
                 :ocup1_birthday, :ocup1_relation, :ocup2_name, :ocup2_birthday,:ocup2_relation, :ocup3_name, :ocup3_birthday, :ocup3_relation, :ocup4_name, :ocup4_birthday, 
                 :ocup4_relation, :current_landlord_name, :current_landlord_phone, :dates_from, :dates_to, :montly_rent_amount, :reason_moving, :desalojado, :desalojado_razon, :condenado_por_delito, 
                 :condenado_razon, :ce_name, :ce_position, :ce_address, :ce_superv_name, :ce_superv_phone,:ce_from, :ce_to, :ce_salary, :sal_mon_hou, 
                 :spouse_emp_name, :spouse_emp_pos, :spouse_emp_address, :spouse_emp_sup_name, :spouse_emp_sup_phone, :spouse_emp_from, :spouse_emp_to, :spouse_emp_salary, :spouse_emp_sal_mon_hou, :other_income, 
                 :p_ref1_name, :p_ref1_phone, :p_ref1_rel, :p_ref2_name, :p_ref2_phone, :p_ref2_rel, :p_ref3_name, :p_ref3_phone, :p_ref3_rel)";

            
            $fechaReg=new DateTime("now",null);    
            $fechaRegistro=$fechaReg->format('Y-m-d 00:00:00');

            if ($inputApplicantBirthday=="") { $inputApplicantBirthday=NULL; }
            if ($inputSpouseBirthday=="") { $inputSpouseBirthday=NULL; }
            if ($inputBirthDate1=="") { $inputBirthDate1=NULL; }
            if ($inputBirthDate2=="") { $inputBirthDate2=NULL; }
            if ($inputBirthDate3=="") { $inputBirthDate3=NULL; }
            if ($inputBirthDate4=="") { $inputBirthDate4=NULL; }            
            if ($inputEmployedFrom=="") { $inputEmployedFrom=NULL; }            
            if ($inputEmployedTo=="") { $inputEmployedTo=NULL; }                        
            if ($inputSpouseEmployedFrom=="") { $inputSpouseEmployedFrom=NULL; }            
            if ($inputSpouseEmployedTo=="") { $inputSpouseEmployedTo=NULL; }                        
            if ($inputDatesFrom=="") { $inputDatesFrom=NULL; }            
            if ($inputDatesTo=="") { $inputDatesTo=NULL; }                        

            $sentenciaSQL=$conexion->prepare($sql);                        
            $sentenciaSQL->bindParam(":persona_id",$txtPersonaId);           
            $sentenciaSQL->bindParam(":fecha",$fechaRegistro);                                   
            $sentenciaSQL->bindParam(":status_id",$txtStatusId);                                   
            $sentenciaSQL->bindParam(":applicant_name",$inputApplicantName);                                   
            $sentenciaSQL->bindParam(":birtdhday_applicant",$inputApplicantBirthday);                                   
            $sentenciaSQL->bindParam(":marital_status",$inputMaritalStatus);                                   
            $sentenciaSQL->bindParam(":ss_num",$inputSSNumber);   
            $sentenciaSQL->bindParam(":driver_lic_num",$inputStateDriverLic);   
            $sentenciaSQL->bindParam(":spouse_name",$inputSpouseName);   
            $sentenciaSQL->bindParam(":spouse_birthday",$inputSpouseBirthday);   

            $sentenciaSQL->bindParam(":spouse_ss",$inputSpouseSSNumber);   
            $sentenciaSQL->bindParam(":spouse_driver_lic_num",$inputSpouseStateDriverLic);                                   
            $sentenciaSQL->bindParam(":present_address",$inputPresentAddress);                                   
            $sentenciaSQL->bindParam(":phone_number",$inputPhoneNumber);                                   
            $sentenciaSQL->bindParam(":spouse_phone_number",$inputSpousePhoneNumber);                                   
            $sentenciaSQL->bindParam(":email_address",$inputEmailAddress);   
            $sentenciaSQL->bindParam(":spouse_email",$inputSpouseEmailAddress);   
            $sentenciaSQL->bindParam(":pets",$inputRadio1);   
            $sentenciaSQL->bindParam(":pet_kind_weight",$inputPetKindWeight);   
            $sentenciaSQL->bindParam(":ocup1_name",$inputOtrOcupName1);   

            $sentenciaSQL->bindParam(":ocup1_birthday",$inputBirthDate1);
            $sentenciaSQL->bindParam(":ocup1_relation",$inputRelationship1);
            $sentenciaSQL->bindParam(":ocup2_name",$inputOtrOcupName1);   
            $sentenciaSQL->bindParam(":ocup2_birthday",$inputBirthDate1);
            $sentenciaSQL->bindParam(":ocup2_relation",$inputRelationship1);
            $sentenciaSQL->bindParam(":ocup3_name",$inputOtrOcupName3);   
            $sentenciaSQL->bindParam(":ocup3_birthday",$inputBirthDate3);
            $sentenciaSQL->bindParam(":ocup3_relation",$inputRelationship3);
            $sentenciaSQL->bindParam(":ocup4_name",$inputOtrOcupName4);   
            $sentenciaSQL->bindParam(":ocup4_birthday",$inputBirthDate4);
            
            $sentenciaSQL->bindParam(":ocup4_relation",$inputRelationship4);
            $sentenciaSQL->bindParam(":current_landlord_name",$inputCurrentLandlordName);   
            $sentenciaSQL->bindParam(":current_landlord_phone",$inputCurrentLandlordPhone);   
            $sentenciaSQL->bindParam(":dates_from",$inputDatesFrom);                                   
            $sentenciaSQL->bindParam(":dates_to",$inputDatesTo);                                   
            $sentenciaSQL->bindParam(":montly_rent_amount",$inputMonthlyRentAmount);                                   
            $sentenciaSQL->bindParam(":reason_moving",$inputReasonforMoving);                                   
            $sentenciaSQL->bindParam(":desalojado",$inputRadio2);   
            $sentenciaSQL->bindParam(":desalojado_razon",$inputExplain1);   
            $sentenciaSQL->bindParam(":condenado_por_delito",$inputRadio3);   

            $sentenciaSQL->bindParam(":condenado_razon",$inputExplain2);   
            $sentenciaSQL->bindParam(":ce_name",$inputCurrentEmployer);   
            $sentenciaSQL->bindParam(":ce_position",$inputCurrentPosition);   
            $sentenciaSQL->bindParam(":ce_address",$inputEmployerAddress);
            $sentenciaSQL->bindParam(":ce_superv_name",$inputSupervisorName);                                   
            $sentenciaSQL->bindParam(":ce_superv_phone",$inputSupervisorPhone);                                   
            $sentenciaSQL->bindParam(":ce_from",$inputEmployedFrom);                                   
            $sentenciaSQL->bindParam(":ce_to",$inputEmployedTo);   
            $sentenciaSQL->bindParam(":ce_salary",$inputSalaryorWages);   
            $sentenciaSQL->bindParam(":sal_mon_hou",$inputRadio4);   
            
            $sentenciaSQL->bindParam(":spouse_emp_name",$inputSpouseCurrentEmployer);   
            $sentenciaSQL->bindParam(":spouse_emp_pos",$inputSpouseCurrentPosition);   
            $sentenciaSQL->bindParam(":spouse_emp_address",$inputSpouseCurrentPosition);               
            $sentenciaSQL->bindParam(":spouse_emp_sup_name",$inputSpouseSupervisorName);                                   
            $sentenciaSQL->bindParam(":spouse_emp_sup_phone",$inputSpouseSupervisorPhoneSupervisorPhone);                                   
            $sentenciaSQL->bindParam(":spouse_emp_from",$inputSpoEmployedFrom);                                   
            $sentenciaSQL->bindParam(":spouse_emp_to",$inputSpouseEmployedTo);   
            $sentenciaSQL->bindParam(":spouse_emp_salary",$inputSpouseSalaryorWages);   
            $sentenciaSQL->bindParam(":spouse_emp_sal_mon_hou",$inputRadio5);   
            $sentenciaSQL->bindParam(":other_income",$inputOtherIncome);   

            $sentenciaSQL->bindParam(":p_ref1_name",$inputReferenceName1);   
            $sentenciaSQL->bindParam(":p_ref1_phone",$inputReferencePhone1);   
            $sentenciaSQL->bindParam(":p_ref1_rel",$inputReferenceRelationship1);   
            $sentenciaSQL->bindParam(":p_ref2_name",$inputReferenceName2);   
            $sentenciaSQL->bindParam(":p_ref2_phone",$inputReferencePhone2);   
            $sentenciaSQL->bindParam(":p_ref2_rel",$inputReferenceRelationship2);   
            $sentenciaSQL->bindParam(":p_ref3_name",$inputReferenceName3);   
            $sentenciaSQL->bindParam(":p_ref3_phone",$inputReferencePhone3);   
            $sentenciaSQL->bindParam(":p_ref3_rel",$inputReferenceRelationship3);   


           $sentenciaSQL->execute();          
           // con esta funcion direcciona a la pagina de consulta           
           ?>
            <Script languaje="JavaScript">
                     location ="doctos_tenant.php"
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
                        <h1 class="mt-4">Tennant Application  </h1>
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
                                                                    <input value="<?php echo $inputApplicantName; ?>" class="form-control" id="inputApplicantName" type="text" name="inputApplicantName"  placeholder="Applicant's Name" />
                                                                    <label  for="inputApplicantName">    Applicant's Name</label>                                                       
                                                            </div   >        
                                                        </div   >                                                                                                                
                                                    </div   >                                                            
                                                    <div class="row mb-3">                                                
                                                        <div class="col-md-4">                                                    
                                                            <div class="form-floating mb-0">                                                                                                                                                         
                                                                    <!-- <i class="fab " style="font-size:24px"></i>                                                            -->
                                                                    <input value="<?php echo $inputApplicantBirthday; ?>" class="form-control" id="inputApplicantBirthday" type="date" name="inputApplicantBirthday"  placeholder="  Applicant Birthday" />
                                                                    <label  for="inputApplicantBirthday">  Applicant Birthday</label>                                                                                                                                                                               
                                                            </div   >        
                                                        </div   >        
                                                        <div class="col-md-8">                                                                                                            
                                                            <div class="form-floating mb-0">                                                                                                       
                                                                    <!-- <i class="fab " style="font-size:24px"></i> -->
                                                                    <input value="<?php echo $inputMaritalStatus; ?>" class="form-control" id="inputMaritalStatus" type="text" name="inputMaritalStatus"  placeholder="  Marital Status" />
                                                                    <label  for="inputMaritalStatus">  Marital Status</label>                                                       
                                                            </div   >             
                                                        </div   >             
                                                    </div   >                                                             
                                                    <div class="row mb-3">                                                                                                                
                                                        <div class="col-md-6">                                                                                                                                                                                                           
                                                            <div class="form-floating mb-0">                                                                                                       
                                                                    <!-- <i class="fab " style="font-size:24px"></i> -->
                                                                    <input value="<?php echo $inputSSNumber; ?>" class="form-control" id="inputSSNumber" type="text" name="inputSSNumber"  placeholder="  SS#" />
                                                                    <label  for="inputSSNumber">  SS#</label>                                                       
                                                            </div   >                                                            
                                                        </div   >                                                            
                                                        <div class="col-md-6">                                                                                                                                                                                                                                                                   
                                                            <div class="form-floating mb-0">                                                                                                       
                                                                    <!-- <i class="fab " style="font-size:24px"></i> -->
                                                                    <input value="<?php echo $inputStateDriverLic; ?>" class="form-control" id="inputStateDriverLic" type="text" name="inputStateDriverLic"  placeholder="  State Driver Lic.#" />
                                                                    <label  for="inputStateDriverLic">  State Driver Lic.#</label>                                                       
                                                            </div   >                                                            
                                                        </div   >                                                                                                                        
                                                    </div   >                                                                                                                
                                                    <div class="row mb-3">                                                                                                                                                                    
                                                        <div class="col-md-8">                                                                                                                
                                                            <div class="form-floating mb-0">                                                                                                       
                                                                    <!-- <i class="fab " style="font-size:24px"></i> -->
                                                                    <input value="<?php echo $inputSpouseName; ?>" class="form-control" id="inputSpouseName" type="text" name="inputSpouseName"  placeholder="  Spouse Name" />
                                                                    <label  for="inputSpouseName">  Spouse Name</label>                                                       
                                                            </div   >                                                                                                                
                                                        </div   >                                                                                                                                                                        
                                                        <div class="col-md-4">                                                        
                                                            <div class="form-floating mb-0">                                                                                                                                                         
                                                                    <!-- <i class="fab " style="font-size:24px"></i>                                                            -->
                                                                    <input value="<?php echo $inputSpouseBirthday; ?>" class="form-control" id="inputSpouseBirthday" type="date" name="inputSpouseBirthday"  placeholder="  Spouse Birthday" />
                                                                    <label  for="inputSpouseBirthday">  Spouse Birthday</label>                                                                                                                                                                               
                                                            </div   >        
                                                        </div   >                                                                                                                                                                                                                                    
                                                    </div   >                                                                                                                                                                    
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">                                                                                                                    
                                                            <div class="form-floating mb-0">                                                                                                       
                                                                    <!-- <i class="fab " style="font-size:24px"></i> -->
                                                                    <input value="<?php echo $inputSpouseSSNumber; ?>" class="form-control" id="inputSpouseSSNumber" type="text" name="inputSpouseSSNumber"  placeholder="  Spouse SS#" />
                                                                    <label  for="inputSpouseSSNumber">  Spouse SS#</label>                                                       
                                                            </div   >                                                                                                                
                                                        </div   >                                                                                                                                                                            
                                                        <div class="col-md-6">                                                                                                                    
                                                            <div class="form-floating mb-0">                                                                                                       
                                                                    <!-- <i class="fab " style="font-size:24px"></i> -->
                                                                    <input value="<?php echo $inputSpouseStateDriverLic; ?>" class="form-control" id="inputSpouseStateDriverLic" type="text" name="inputSpouseStateDriverLic"  placeholder="  Spouse State Driver Lic.#" />
                                                                    <label  for="inputSpouseStateDriverLic">  Spouse State Driver Lic.#</label>                                                       
                                                            </div   >
                                                        </div   >                                                                                                                                                                            
                                                    </div   >                                                                                                                
                                                    <div class="row mb-3">                                                             
                                                        <div class="col-md-0">        
                                                            <div class="form-floating mb-0">                                                                                                                                                                                    
                                                                    <input value="<?php echo $inputPresentAddress; ?>" class="form-control" name="inputPresentAddress" id="inputPresentAddress" rows="3"></input>
                                                                    <label for="inputPresentAddress" class="form-label">Present Address</label>                                                                
                                                                
                                                            </div>            
                                                        </div>                                                                        
                                                    </div>                                                                    

                                                    <div class="row mb-3">                                                             
                                                        <div class="col-md-6">                                                                                                                                                                            
                                                            <div class="form-floating mb-0">                                                                                                       
                                                                    <input value="<?php echo $inputPhoneNumber; ?>" class="form-control" id="inputPhoneNumber" type="text" name="inputPhoneNumber"  placeholder="  Phone Number" />
                                                                    <label  for="inputPhoneNumber">  Phone Number</label>
                                                            </div   >
                                                        </div   >                                                                
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-0">                                                                                                       
                                                                    <input value="<?php echo $inputSpousePhoneNumber; ?>" class="form-control" id="inputSpousePhoneNumber" type="text" name="inputSpousePhoneNumber"  placeholder="  Spouse Phone Number" />
                                                                    <label  for="inputSpousePhoneNumber">  Spouse Phone Number</label>                                                       
                                                            </div   >
                                                        </div   >
                                                    </div   >                                

                                                    <div class="row mb-3">                                                                                                                 
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-0">                                                                                                                                                                   
                                                                <!-- <i class="fab " style="font-size:24px"></i> -->
                                                                    <input value="<?php echo $inputEmailAddress; ?>" class="form-control" id="inputEmailAddress" type="email" name="inputEmailAddress"  placeholder="  Email Address" />
                                                                    <label  for="inputEmailAddress">  Email Address</label>                                                       
                                                            </div   >       
                                                        </div   >                                                               
                                                        <div class="col-md-6">    
                                                            <div class="form-floating mb-0">                                                                                                                                                                           
                                                                    <input value="<?php echo $inputSpouseEmailAddress; ?>" class="form-control" id="inputSpouseEmailAddress" type="email" name="inputSpouseEmailAddress"  placeholder="  Spouse Email Address" />
                                                                    <label  for="inputSpouseEmailAddress">  Spouse Email Address</label>                                                       
                                                            </div   >       
                                                        </div   >
                                                    </div   >
                                                                                             
                                                                                                        
                                                    <div class="row mb-3">                                                
                                                        <div class="col-md-3">
                                                            <!-- <div class="form-floating mb-3 mb-md-0">                                                         -->
                                                                Pets
                                                                <div  class="btn-group" role="group" aria-label="Basic checkbox toggle button group">                                                                                                                                 
                                                                    <input value="1" type="radio" class="btn-check"  name="btnradio1" id="btncheck1" autocomplete="off"  <?php if($inputRadio1=="1"){  echo "checked" ;} ?> >
                                                                    <label class="btn btn-outline-primary" for="btncheck1">Yes</label>
                                                                    <input value="0" type="radio" class="btn-check" name="btnradio1" id="btncheck2" autocomplete="off" <?php if($inputRadio1=="0"){  echo "checked" ;} ?> >
                                                                    <label class="btn btn-outline-primary" for="btncheck2">No</label>
                                                                </div>                                                        
                                                            <!-- </div> -->
                                                        </div>    
                                                        <div class="col-md-9">                                                        
                                                            <div class="form-floating mb-0">                                                                                                       
                                                                <input value="<?php echo $inputPetKindWeight; ?>" class="form-control" id="inputPetKindWeight" type="text" name="inputPetKindWeight"  placeholder="  If Yes, Kind & Weight" />
                                                                <label  for="inputPetKindWeight">  If Yes, Kind & Weight:</label>                                                       
                                                            </div   >                                                         
                                                        </div   >                                                                     
                                                    </div   >           
                                                    
                                                    <h2>Other Occupants (All ages):</h2>                                                                                                                                                                     
                                                    <div class="row mb-3">                                                       
                                                        <div class="col-md-0">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                                <input value="<?php echo $inputOtrOcupName1; ?>" class="form-control" id="inputOtrOcupName1" type="text" name="inputOtrOcupName1"   placeholder="Name" />
                                                                <label for="inputOtrOcupName1"> Name</label>
                                                            </div>
                                                        </div>              
                                                                                                  
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">                                                            
                                                                <input value="<?php echo $inputBirthDate1; ?>" class="form-control" id="inputBirthDate1" type="date" name="inputBirthDate1"   placeholder="Birth Date" />
                                                                <label for="inputBirthDate1">Birth Date</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                                <input value="<?php echo $inputRelationship1; ?>"  class="form-control" id="inputRelationship1" type="text" name="inputRelationship1" placeholder="Relationship" />
                                                                <label for="inputRelationship1"> Relationship</label>
                                                            </div>
                                                        </div>                                                
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-0">
                                                            <div class="form-floating mb-3 mb-md-0">                                                            
                                                                <input value="<?php echo $inputOtrOcupName2; ?>" class="form-control" id="inputOtrOcupName2" type="text" name="inputOtrOcupName2"  placeholder="Name" />
                                                                <label for="inputOtrOcupName2"> Name</label>
                                                            </div>
                                                        </div>                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">                                                            
                                                                <input value="<?php echo $inputBirthDate2; ?>" class="form-control" id="inputBirthDate2" type="date" name="inputBirthDate2"   placeholder="Birth Date" />
                                                                <label for="inputBirthDate2">Birth Date</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">                                                               
                                                                <input value="<?php echo $inputRelationship2; ?>"  class="form-control" id="inputRelationship2" type="text" name="inputRelationship2" placeholder="Relationship" />
                                                                <label for="inputRelationship2"> Relationship</label>
                                                            </div>
                                                        </div>                                                
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-0">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                            
                                                                <input value="<?php echo $inputOtrOcupName3; ?>" class="form-control" id="inputOtrOcupName3" type="text" name="inputOtrOcupName3"  placeholder="Name" />
                                                                <label for="inputOtrOcupName3"> Name</label>
                                                            </div>
                                                        </div>                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                                                                       
                                                                <input value="<?php echo $inputBirthDate3; ?>" class="form-control" id="inputBirthDate3" type="date" name="inputBirthDate3"   placeholder="Birth Date" />
                                                                <label for="inputBirthDate3">Birth Date</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">                                                                                         
                                                                <input value="<?php echo $inputRelationship3; ?>"  class="form-control" id="inputRelationship3" type="text" name="inputRelationship3" placeholder="Relationship" />
                                                                <label for="inputRelationship3"> Relationship</label>
                                                            </div>
                                                        </div>                                                
                                                    </div>            
                                                    <div class="row mb-3">
                                                        <div class="col-md-0">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                            
                                                                <input value="<?php echo $inputOtrOcupName4; ?>" class="form-control" id="inputOtrOcupName4" type="text" name="inputOtrOcupName4"  placeholder="Name" />
                                                                <label for="inputOtrOcupName4"> Name</label>
                                                            </div>
                                                        </div>                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                                                                       
                                                                <input value="<?php echo $inputBirthDate4; ?>" class="form-control" id="inputBirthDate4" type="date" name="inputBirthDate4"   placeholder="Birth Date" />
                                                                <label for="inputBirthDate4">Birth Date</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">                                                                                         
                                                                <input value="<?php echo $inputRelationship4; ?>"  class="form-control" id="inputRelationship4" type="text" name="inputRelationship4" placeholder="Relationship" />
                                                                <label for="inputRelationship4"> Relationship</label>
                                                            </div>
                                                        </div>                                                
                                                    </div>                                                                
                                                    
                                                    <h2>Housing History:</h2>                                                                                                                                                                     
                                                    <div class="row mb-3">                                                       
                                                        <div class="col-md-8">
                                                            <div class="form-floating mb-3 mb-md-0">                                                            
                                                                <input value="<?php echo $inputCurrentLandlordName; ?>" class="form-control" id="inputCurrentLandlordName" type="text" name="inputCurrentLandlordName"   placeholder="Current Landlord" />
                                                                <label for="inputCurrentLandlordName"> Current Landlord</label>
                                                            </div>
                                                        </div>                                                        
                                                        <div class="col-md-4">
                                                            <div class="form-floating mb-4 mb-md-0">
                                                                <input value="<?php echo $inputCurrentLandlordPhone; ?>" class="form-control" id="inputCurrentLandlordPhone" type="text" name="inputCurrentLandlordPhone"   placeholder="Phone #" />
                                                                <label for="inputCurrentLandlordPhone">Phone #</label>
                                                            </div>
                                                        </div>                                                       
                                                    </div>    

                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                        <div class="form-floating mb-3 mb-md-0">
                                                            
                                                                <input value="<?php echo $inputDatesFrom; ?>" class="form-control" id="inputDatesFrom" type="date" name="inputDatesFrom"   placeholder="Dates From" />
                                                                <label for="inputDatesFrom">Dates From</label>
                                                            </div>
                                                        </div>                                                        
                                                        <div class="col-md-4">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                            
                                                                <input value="<?php echo $inputDatesTo; ?>" class="form-control" id="inputDatesTo" type="date" name="inputDatesTo"   placeholder="Dates To" />
                                                                <label for="inputDatesTo">Dates To</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-floating mb-3 mb-md-0">       
                                                            
                                                                <input value="<?php echo $inputMonthlyRentAmount; ?>"  class="form-control" id="inputMonthlyRentAmount" type="number" name="inputMonthlyRentAmount" placeholder="Monthly Rent Amount" />
                                                                <label for="inputMonthlyRentAmount"> Monthly Rent Amount</label>
                                                            </div>
                                                        </div>                                                
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-0">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                            
                                                                <input value="<?php echo $inputReasonforMoving; ?>" class="form-control" id="inputReasonforMoving" type="text" name="inputReasonforMoving"   placeholder="Reason for Moving" />
                                                                <label for="inputReasonforMoving"> Reason for Moving:</label>
                                                            </div>
                                                        </div>                                                        
                                                    </div>                                                          
                                                    <br>
                                                    <div class="row mb-3">                                                
                                                        <div class="col-md-0">
                                                            <!-- <div class="form-floating mb-3 mb-md-0">                                                         -->
                                                            Have you ever been evicted from any Lease Premises?     
                                                                <div  class="btn-group" role="group" aria-label="Basic checkbox toggle button group">                                                            
                                                                    <input value="1" type="radio" class="btn-check" name="btnradio2" id="btncheckYes2" autocomplete="off" <?php if($inputRadio2=="1"){  echo "checked" ;} ?> >
                                                                    <label class="btn btn-outline-primary" for="btncheckYes2">Yes</label>
                                                                    <input value="0" type="radio" class="btn-check" name="btnradio2" id="btncheckNo2" autocomplete="off"  <?php if($inputRadio2=="0"){  echo "checked" ;} ?> >
                                                                    <label class="btn btn-outline-primary" for="btncheckNo2">No</label>
                                                                </div>                                                        
                                                            <!-- </div> -->
                                                        </div>    
                                                        <div class="col-md-0">                                                        
                                                            <div class="form-floating mb-0">                                                                                                       
                                                                <input value="<?php echo $inputExplain1; ?>" class="form-control" id="inputExplain1" type="text" name="inputExplain1"  placeholder="  If YES, Explain" />
                                                                <label  for="inputExplain1">  If YES, Explain</label>
                                                            </div   >                                                         
                                                        </div   >                                                                     
                                                    </div   >           
                                                    <br>
                                                    <div class="row mb-3">                                                
                                                        <div class="col-md-0">
                                                            <!-- <div class="form-floating mb-3 mb-md-0">                                                         -->
                                                            Have you or any Occupants EVER been convicted for a FEOLNY or a MISDERMEANOR?
                                                                <div  class="btn-group" role="group" aria-label="Basic checkbox toggle button group">                                                            
                                                                    <input value="1" type="radio" class="btn-check" name="btnradio3" id="btncheckYes3" autocomplete="off" <?php if($inputRadio3=="1"){  echo "checked" ;} ?> >
                                                                    <label class="btn btn-outline-primary" for="btncheckYes3">Yes</label>
                                                                    <input value="0" type="radio" class="btn-check" name="btnradio3" id="btncheckNo3" autocomplete="off"  <?php if($inputRadio3=="0"){  echo "checked" ;} ?> >
                                                                    <label class="btn btn-outline-primary" for="btncheckNo3">No</label>
                                                                </div>                                                        
                                                            <!-- </div> -->
                                                        </div>    
                                                        <div class="col-md-0">                                                        
                                                            <div class="form-floating mb-0">                                                                                                       
                                                                <input value="<?php echo $inputExplain2; ?>" class="form-control" id="inputExplain2" type="text" name="inputExplain2"  placeholder="  If YES, Explain" />
                                                                <label  for="inputExplain2">  If YES, Explain</label>
                                                            </div   >                                                         
                                                        </div   >                                                                     
                                                    </div   >                                                               

                                                    <h2>Employment History:</h2>                                                                                                                                                                     
                                                    <div class="row mb-3">                                                       
                                                        <div class="col-md-8">
                                                            <div class="form-floating mb-3 mb-md-0">                                                            
                                                                <input value="<?php echo $inputCurrentEmployer; ?>" class="form-control" id="inputCurrentEmployer" type="text" name="inputCurrentEmployer"   placeholder="Current Employer" />
                                                                <label for="inputCurrentEmployer"> Current Employer</label>
                                                            </div>
                                                        </div>                                                        
                                                        <div class="col-md-4">
                                                            <div class="form-floating mb-4 mb-md-0">
                                                                <input value="<?php echo $inputCurrentPosition; ?>" class="form-control" id="inputCurrentPosition" type="text" name="inputCurrentPosition"   placeholder="Position" />
                                                                <label for="inputCurrentPosition">Position</label>
                                                            </div>
                                                        </div>              
                                                    </div>                                                                      
                                                    <div class="row mb-3">                                                                                                   
                                                        <div class="col-md-0">
                                                            <div class="form-floating mb-4 mb-md-0">
                                                                <input value="<?php echo $inputEmployerAddress; ?>" class="form-control" id="inputEmployerAddress" type="text" name="inputEmployerAddress"   placeholder="Address" />
                                                                <label for="inputEmployerAddress">Address</label>
                                                            </div>
                                                        </div>                                                                                                               
                                                    </div>    
                                                    <div class="row mb-3">                                                       
                                                        <div class="col-md-8">
                                                            <div class="form-floating mb-3 mb-md-0">                                                            
                                                                <input value="<?php echo $inputSupervisorName; ?>" class="form-control" id="inputSupervisorName" type="text" name="inputSupervisorName"   placeholder="Supervisor Name" />
                                                                <label for="inputSupervisorName"> Supervisor Name</label>
                                                            </div>
                                                        </div>                                                        
                                                        <div class="col-md-4">
                                                            <div class="form-floating mb-4 mb-md-0">
                                                                <input value="<?php echo $inputSupervisorPhone; ?>" class="form-control" id="inputSupervisorPhone" type="text" name="inputSupervisorPhone"   placeholder="Phone #" />
                                                                <label for="inputSupervisorPhone">Phone #</label>
                                                            </div>
                                                        </div>                                                       
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                        <div class="form-floating mb-3 mb-md-0">
                                                            
                                                                <input value="<?php echo $inputEmployedFrom; ?>" class="form-control" id="inputEmployedFrom" type="date" name="inputEmployedFrom"   placeholder="Employed From" />
                                                                <label for="inputEmployedFrom">Employed From</label>
                                                            </div>
                                                        </div>                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                            
                                                                <input value="<?php echo $inputEmployedTo; ?>" class="form-control" id="inputEmployedTo" type="date" name="inputEmployedTo"   placeholder="Employed To" />
                                                                <label for="inputEmployedTo">Employed To</label>
                                                            </div>
                                                        </div>                                                        
                                                    </div>                
                                                    <div class="row mb-3">                                    
                                                        <div class="col-md-6">
                                                                <div class="form-floating mb-3 mb-md-0">                                                                       
                                                                    <input value="<?php echo $inputSalaryorWages; ?>"  class="form-control" id="inputSalaryorWages" type="number" name="inputSalaryorWages" placeholder="Salary or Wages" />
                                                                    <label for="inputSalaryorWages"> Salary or Wages</label>
                                                                </div>
                                                            </div>                                                                                                        
                                                            <div class="col-md-6">                                                            
                                                                <div  class="btn-group" role="group" aria-label="Basic checkbox toggle button group">                                                            
                                                                    <input value="1" type="radio" class="btn-check" name="btnradio4" id="btncheckMonthly" autocomplete="off" <?php if($inputRadio4=="1"){  echo "checked" ;} ?> >
                                                                    <label class="btn btn-outline-primary" for="btncheckMonthly">Monthly</label>
                                                                    <input value="0" type="radio" class="btn-check" name="btnradio4" id="btncheckHourly" autocomplete="off" <?php if($inputRadio4=="0"){  echo "checked" ;} ?> >
                                                                    <label class="btn btn-outline-primary" for="btncheckHourly">Hourly</label>
                                                                </div>                                                                                                                        
                                                            </div>                                                                                                                                                                    
                                                    </div>                

<!-- // de aqio -->
                                                    <div class="row mb-3">                                                       
                                                        <div class="col-md-8">
                                                            <div class="form-floating mb-3 mb-md-0">                                                            
                                                                <input value="<?php echo $inputSpouseCurrentEmployer; ?>" class="form-control" id="inputSpouseCurrentEmployer" type="text" name="inputSpouseCurrentEmployer"   placeholder="Spouse Current Employer" />
                                                                <label for="inputSpouseCurrentEmployer"> Spouse Current Employer</label>
                                                            </div>
                                                        </div>                                                        
                                                        <div class="col-md-4">
                                                            <div class="form-floating mb-4 mb-md-0">
                                                                <input value="<?php echo $inputSpouseCurrentPosition; ?>" class="form-control" id="inputSpouseCurrentPosition" type="text" name="inputSpouseCurrentPosition"   placeholder="Position" />
                                                                <label for="inputSpouseCurrentPosition">Position</label>
                                                            </div>
                                                        </div>              
                                                    </div>                                                                      
                                                    <div class="row mb-3">                                                                                                   
                                                        <div class="col-md-0">
                                                            <div class="form-floating mb-4 mb-md-0">
                                                                <input value="<?php echo $inputSpouseEmployerAddress; ?>" class="form-control" id="inputSpouseEmployerAddress" type="text" name="inputSpouseEmployerAddress"   placeholder="Address" />
                                                                <label for="inputSpouseEmployerAddress">Address</label>
                                                            </div>
                                                        </div>                                                                                                               
                                                    </div>    
                                                    <div class="row mb-3">                                                       
                                                        <div class="col-md-8">
                                                            <div class="form-floating mb-3 mb-md-0">                                                            
                                                                <input value="<?php echo $inputSpouseSupervisorName; ?>" class="form-control" id="inputSpouseSupervisorName" type="text" name="inputSpouseSupervisorName"   placeholder="Supervisor Name" />
                                                                <label for="inputSpouseSupervisorName"> Supervisor Name</label>
                                                            </div>
                                                        </div>                                                        
                                                        <div class="col-md-4">
                                                            <div class="form-floating mb-4 mb-md-0">
                                                                <input value="<?php echo $inputSpouseSupervisorPhone; ?>" class="form-control" id="inputSpouseSupervisorPhone" type="text" name="inputSpouseSupervisorPhone"   placeholder="Phone #" />
                                                                <label for="inputSpouseSupervisorPhone">Phone #</label>
                                                            </div>
                                                        </div>                                                       
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                        <div class="form-floating mb-3 mb-md-0">
                                                            
                                                                <input value="<?php echo $inputSpouseEmployedFrom; ?>" class="form-control" id="inputSpouseEmployedFrom" type="date" name="inputSpouseEmployedFrom"   placeholder="Employed From" />
                                                                <label for="inputSpouseEmployedFrom">Employed From</label>
                                                            </div>
                                                        </div>                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                            
                                                                <input value="<?php echo $inputSpouseEmployedTo; ?>" class="form-control" id="inputSpouseEmployedTo" type="date" name="inputSpouseEmployedTo"   placeholder="Employed To" />
                                                                <label for="inputSpouseEmployedTo">Employed To</label>
                                                            </div>
                                                        </div>                                                        
                                                    </div>                
                                                    <div class="row mb-3">                                    
                                                        <div class="col-md-6">
                                                                <div class="form-floating mb-3 mb-md-0">                                                                       
                                                                    <input value="<?php echo $inputSpouseSalaryorWages; ?>"  class="form-control" id="inputSpouseSalaryorWages" type="number" name="inputSpouseSalaryorWages" placeholder="Salary or Wages" />
                                                                    <label for="inputSpouseSalaryorWages"> Salary or Wages</label>
                                                                </div>
                                                            </div>                                                                                                        
                                                            <div class="col-md-6">                                                            
                                                                <div  class="btn-group" role="group" aria-label="Basic checkbox toggle button group">                                                            
                                                                    <input value="1" type="radio" class="btn-check" name="btnradio5" id="btncheckSpouseMonthly" autocomplete="off" <?php if($inputRadio5=="1"){  echo "checked" ;} ?> >
                                                                    <label class="btn btn-outline-primary" for="btncheckSpouseMonthly">Monthly</label>
                                                                    <input value="0" type="radio" class="btn-check" name="btnradio5" id="btncheckSpouseHourly" autocomplete="off" <?php if($inputRadio5=="0"){  echo "checked" ;} ?> >
                                                                    <label class="btn btn-outline-primary" for="btncheckSpouseHourly">Hourly</label>
                                                                </div>                                                                                                                        
                                                            </div>                                                                                                                                                                    
                                                    </div>                
<!-- // aqui -->


                                                    <div class="row mb-3">                                    
                                                        <div class="col-md-0">
                                                        <div class="form-floating mb-3 mb-md-0">                                                                       
                                                                    <input value="<?php echo $inputOtherIncome; ?>"  class="form-control" id="inputOtherIncome" type="text" name="inputOtherIncome" placeholder="Other Income (If any)" />
                                                                    <label for="inputOtherIncome"> Other Income (If any)</label>
                                                                </div>                                                            
                                                        </div>                                                                       
                                                    </div>                                                                                                                                                                                
                                                    <h2>Personal References:</h2>                                                                                                                                                                     
                                                    <div class="row mb-3">                                                       
                                                        <div class="col-md-0">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                                <input value="<?php echo $inputReferenceName1; ?>" class="form-control" id="inputReferenceName1" type="text" name="inputReferenceName1"   placeholder="Name" />
                                                                <label for="inputReferenceName1"> Name</label>
                                                            </div>
                                                        </div>                                                                                                               
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">                                                            
                                                                <input value="<?php echo $inputReferencePhone1; ?>" class="form-control" id="inputReferencePhone1" type="text" name="inputReferencePhone1"   placeholder="Phone #" />
                                                                <label for="inputReferencePhone1">Phone #</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                                <input value="<?php echo $inputReferenceRelationship1; ?>"  class="form-control" id="inputReferenceRelationship1" type="text" name="inputReferenceRelationship1" placeholder="Relationship" />
                                                                <label for="inputReferenceRelationship1"> Relationship</label>
                                                            </div>
                                                        </div>                                                
                                                    </div>
                                                    <div class="row mb-3">                                                       
                                                        <div class="col-md-0">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                                <input value="<?php echo $inputReferenceName2; ?>" class="form-control" id="inputReferenceName2" type="text" name="inputReferenceName2"   placeholder="Name" />
                                                                <label for="inputReferenceName2"> Name</label>
                                                            </div>
                                                        </div>                                                                                                               
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">                                                            
                                                                <input value="<?php echo $inputReferencePhone2; ?>" class="form-control" id="inputReferencePhone2" type="text" name="inputReferencePhone2"   placeholder="Phone #" />
                                                                <label for="inputReferencePhone2">Phone #</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                                <input value="<?php echo $inputReferenceRelationship2; ?>"  class="form-control" id="inputReferenceRelationship2" type="text" name="inputReferenceRelationship2" placeholder="Relationship" />
                                                                <label for="inputReferenceRelationship2"> Relationship</label>
                                                            </div>
                                                        </div>                                                
                                                    </div>         
                                                    <div class="row mb-3">                                                       
                                                        <div class="col-md-0">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                                <input value="<?php echo $inputReferenceName3; ?>" class="form-control" id="inputReferenceName3" type="text" name="inputReferenceName3"   placeholder="Name" />
                                                                <label for="inputReferenceName3"> Name</label>
                                                            </div>
                                                        </div>                                                                                                               
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">                                                            
                                                                <input value="<?php echo $inputReferencePhone3; ?>" class="form-control" id="inputReferencePhone3" type="text" name="inputReferencePhone3"   placeholder="Phone #" />
                                                                <label for="inputReferencePhone3">Phone #</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                                <input value="<?php echo $inputReferenceRelationship3; ?>"  class="form-control" id="inputReferenceRelationship3" type="text" name="inputReferenceRelationship3" placeholder="Relationship" />
                                                                <label for="inputReferenceRelationship3"> Relationship</label>
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
