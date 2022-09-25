<?php
    require_once "mainfiles.php";
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    
    // Prepare a select statement
    $sql = "SELECT * FROM patient p LEFT JOIN prescription ps ON p.id= ps.patient WHERE p.id = :id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Retrieve individual field value
                $name = $row["patientname"];
                $address = $row["address"];
                $dob = $row['dob'];
                $gender = $row['gender'];
                $mobile = $row['mobile'];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
 
 <div class="row">
<div class="page-header centered clearfix"> <h2 class="pull-left">Patient ID: <code><?php echo $row["patient"]; ?></code> Profile</h2></div>
            
    <div class="col-md-12">
        <div class="col-md-3">
            <?php include 'menu.php';?>
        </div>
        <div class="col-md-4">
        <table class='table table-hover centerd'>
                <tbody>
                    <tr>
                        <td>
                   <div class="form-group">
                        <p class="form-control-static">
                        <strong>Name: </strong> </p>
                    </div>
                        </td>
                        <td><code><?php echo $name; ?> </code></td>
                    </tr>
                    <tr>
                        <td>
                         <div class="form-group">
                        <p class="form-control-static"><strong>Address: </strong></p>
                    </div>
                    </td>
                        <td>  <code><?php echo $address; ?> </code></td>
                    </tr>
                    <tr>
                        <td>
                         <div class="form-group">
                        <p class="form-control-static"><strong>DOB: </strong></p>
                    </div>
                    </td>
                        <td>  <code><?php echo $dob; ?> </code></td>
                    </tr>
                    <tr>
                        <td>
                    <div class="form-group">
                        <p class="form-control-static"> <strong>Age: </strong> </p>
                    </div>
                    </td>
                        <td><code><?php $dob=$row['dob'];
											function ageCalculator($dob){
												if(!empty($dob) && $dob != '0000-00-00'){
													$birthdate = new DateTime($dob);
													$today   = new DateTime('today');
													$age = $birthdate->diff($today)->y;
													return $age;
													
												}else{
													return 0;
												}
											}
											if(ageCalculator($dob)>0){
											echo ageCalculator($dob).' Years old ';
											}else{
												echo '<i style="color:red;"> ---- </i>';
											} ?> </code></td>
                    </tr>
                    <tr>
                        <td>
                         <div class="form-group">
                        <p class="form-control-static"><strong>Phone Number: </strong></p>
                    </div>
                    </td>
                        <td>  <code><?php echo $mobile; ?> </code></td>
                    </tr>
                </tbody>
             </table>  
             </div> 
        <div class="col-md-5">
            <h3>prescriptions</h3>
            <?php
            if(!empty($row["prescription"])){
            ?>
            <div class="form-group">
                        <p class="form-control-static">
                        <strong>Prescription Details: </strong> <code><?php echo $row["prescription"]; ?> </code></p>
                    </div>
                    <div class="form-group">
                        <p class="form-control-static"><strong>Medical History: </strong>  <code><?php echo $row["patientsMedicalHist"]; ?> </code></p>
                    </div>
                <!--     
                <div class="centered">
                    <img src="upload/medicallogo.jpg" style=" margin-top: 10px;width:300px;height:320px;"/>
                </div> -->
                   <?php
            }else {
                echo '<code> Patient has no prescriptions yet.</code>';
            }
                   ?> 
            </div>
    </div>
    
<div class="page-header centered clearfix"></div>
</div>
    <?php include 'footer.php';?>