<?php 
include 'mainfiles.php';
// Define variables and initialize with empty values
$patientname = $patientsMedicalHist = $prescription = "";
$patientname_err = $patientsMedicalHist_err = $prescription_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $patientsMedicalHist = trim($_POST["patientsMedicalHist"]);
    // Validate username
    if(empty(trim($_POST["patientsMedicalHist"]))){
        $patientsMedicalHist = "Please enter patients Medical History.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id,patient FROM prescription WHERE patient = :patientname";
        //SELECT `drug`, `stockqty`, `stockedDate`, `prescription` FROM `pharmacy` WHERE 1
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":patientname", $param_patientname, PDO::PARAM_STR);
            
            // Set parameters
            $param_patientname = trim($_POST["patientname"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    //echo "Oops! Something went wrong. Please try again later.";
                } else{
                    //$stockqty = trim($_POST["patientsMedicalHist"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Validate description
    if(empty(trim($_POST["prescription"]))){
        $prescription_err = "Please provide the expiry Date.";     
    } else{
        $prescription = trim($_POST["prescription"]);
    }    
    $patientname = trim($_POST["patientname"]);    
   
    // Check input errors before inserting in database
    if(empty($patientname_err) && empty($descr_err)){
        //SELECT `id`, `patient`, `dateofpres`, `prescription`, `patientsMedicalHist` FROM `prescription` WHERE 1
        $sql = "INSERT INTO prescription(patient, dateofpres,prescription, patientsMedicalHist) VALUES (:patient, :dateofpres,:prescription, :patientsMedicalHist)";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":patient", $param_patient, PDO::PARAM_STR);
            $stmt->bindParam(":dateofpres", $param_dateofpres);
            $stmt->bindParam(":patientsMedicalHist", $param_patientsMedicalHist);
            $stmt->bindParam(":prescription", $param_prescription);
            
            // Set parameters
            
            $param_patient = $patientname;
            $param_dateofpres =  date("Y-m-d");
            $param_patientsMedicalHist =$patientsMedicalHist;
            $param_prescription = $prescription;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                echo '<meta content="1;dashboard.php" http-equiv="refresh" />';
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}
?>
 
<div class="row">
<div class="page-header centered clearfix"> <h2 class="pull-left">Capture Patients Prescription Details</h2></div>
            
    <div class="col-md-12">
        <div class="col-md-3">
            <?php include 'menu.php';?>
        </div>
        <div class="col-md-6">
           <p>Please fill this form to capture prescription details.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($patientname_err)) ? 'has-error' : ''; ?>">
                    <label>Patient Name</label>
                    <select name="patientname" id="patientname" class="form-control">
                    <?php
                    //SELECT `id`, `patientname`, `gender`, `dob`, `mobile`, `address` FROM `patient` WHERE 1
                        $query = "SELECT * FROM  patient";
                        $stmt = $pdo->query($query );
                        foreach ($stmt as $row) {
                            echo "<option value='{$row['id']}'>{$row['patientname']}</option>";
                        }
                        ?>
                        </select>
                </div>
                <div class="form-group <?php echo (!empty($patientsMedicalHist)) ? 'has-error' : ''; ?>">
                    <label>Patients Medical History	</label>
                    <textarea type="text" name="patientsMedicalHist" class="form-control" value="<?php echo $patientsMedicalHist; ?>"></textarea>
                    <span class="help-block"><?php echo $patientsMedicalHist; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($prescription_err)) ? 'has-error' : ''; ?>">
                    <label>Prescription Details</label>
                    <textarea type="text" name="prescription" class="form-control" value="<?php echo $prescription; ?>"></textarea>
                    <span class="help-block"><?php echo $prescription_err; ?></span>
                </div>
                
                            
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Prescribe ">
                    <input type="reset" class="btn btn-default" value="Reset">
                </div>
            </form>
            <br>
            <p><button class="btn btn-block btn-primary" onclick="goBack()"> << Back</button></p>
                      
        </div>    
        <div class="col-md-3">
                <div class="centered">
                    <img src="upload/medicallogo.jpg" style=" margin-top: 70px;width:300px;height:320px;"/>
                </div>
                    
            </div>
    </div>
    
<div class="page-header centered clearfix"></div>
</div>
    <?php include 'footer.php';?>