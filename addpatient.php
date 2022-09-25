<?php
include_once 'mainfiles.php';
 
// Define variables and initialize with empty values
$name = $address =$dob=$mobile= $gender = "";
$name_err = $address_err = $dob_err = $mobile_err = $gender_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }

    $input_dob = trim($_POST['dob']);
    if(empty($input_dob)){
        $dob_err = "Please enter an address.";     
    } else{
        $dob = $input_dob;
    }

    $input_mobile = trim($_POST['mobile']);
    if(empty($input_mobile)){
        $mobile_err = "Please enter an mobile number.";     
    } else{
        $mobile = $input_mobile;
    }
    
    // Validate salary
    $input_gender = trim($_POST["gender"]);
    if(empty($input_gender)){
        $gender_err = "Please enter the salary amount.";     
    } 
    /* elseif(!ctype_digit($input_gender)){
        $gender_err = "Please enter a positive integer value.";
    } */ 
    else{
        $gender = $input_gender;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // //SELECT `id`, `patientname`, `gender`, `dob`, `mobile`, `address` FROM `patient` WHERE 1
                    
        // Prepare an insert statement
        $sql = "INSERT INTO patient (id,patientname, address,dob, mobile, gender) VALUES (:id,:name, :address,:dob, :mobile, :gender)";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $param_id);
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":address", $param_address);
            $stmt->bindParam(":dob", $param_dob);
            $stmt->bindParam(":mobile", $param_mobile);
            $stmt->bindParam(":gender", $param_gender);
            
            // Set parameters
            $param_id = trim($_POST["patientID"]);
            $param_name = $name;
            $param_address = $address;
            $param_dob = $dob;
            $param_mobile = $mobile;
            $param_gender = $gender;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: patients.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
}
?>
 


 <div class="row">
<div class="page-header centered clearfix"> <h2 class="pull-left">Register new Patient</h2></div>
            
    <div class="col-md-12">
        <div class="col-md-3">
            <?php include 'menu.php';?>
        </div>
        <div class="col-md-6">
                    <p>Please fill this form and submit to add patient's record to the database.</p>
                    
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Address</label>
                            <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
                            <span class="help-block"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($dob_err)) ? 'has-error' : ''; ?>">
                            <label>DOB</label>
                            <input type="text" name="dob" class="form-control col-md-6 datepicker" id='start_dt' value="<?php echo $dob; ?>" readonly>
                            <span class="help-block"><?php echo $dob_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($mobile_err)) ? 'has-error' : ''; ?>">
                            <label>Mobile</label>
                            <input name="mobile" class="form-control"><?php echo $mobile; ?>
                            <span class="help-block"><?php echo $mobile_err;?></span>
                        </div>
                        <div class="form-group">
                                       <label>Gender</label>
                                       <select name="gender" class="form-control">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                   </div>
                                   <input type="hidden" name="patientID" class="form-control" value="<?php echo mt_rand(); ?>">
                            
                            
                                   <input type="submit" class="btn btn-primary" value="Submit">
                                   <button type="reset" class="btn btn-default">Cancel</button>
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