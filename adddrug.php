<?php 
include 'mainfiles.php';
// Define variables and initialize with empty values
$drugname = $drugCategory = $descr = "";
$drugname_err = $drugCategory_err = $descr_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["drugname"]))){
        $drugname_err = "Please enter drug name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT drugID FROM drug WHERE drugName = :drugname";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":drugname", $param_drugname, PDO::PARAM_STR);
            
            // Set parameters
            $param_drugname = trim($_POST["drugname"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $drugnamee_err = "This drug name is already exists.";
                } else{
                    $drugname = trim($_POST["drugname"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Validate drug name
    if(empty(trim($_POST["drugname"]))){
        $drugname_err = "Please enter a drug name.";     
    } else{
        $drugname = trim($_POST["drugname"]);
    }
    
    // Validate description
    if(empty(trim($_POST["descr"]))){
        $descr_err = "Please provide the drug description.";     
    } else{
        $descr = trim($_POST["descr"]);
    }
   
    // Check input errors before inserting in database
    if(empty($drugname_err) && empty($descr_err)){
        
        // Prepare an insert statement
        //INSERT INTO `drug`(`drugID`, `drugName`, `drugCategory`, `description`) VALUES ([value-1],[value-2],[value-3],[value-4])
        $sql = "INSERT INTO drug(drugID, drugName, drugCategory, description) VALUES (:drugID, :drugName, :drugCategory, :description)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":drugID", $param_drugID, PDO::PARAM_INT);
            $stmt->bindParam(":drugName", $param_drugName, PDO::PARAM_STR);
            $stmt->bindParam(":drugCategory", $param_drugCategory, PDO::PARAM_INT);
            $stmt->bindParam(":description", $param_description, PDO::PARAM_STR);
            
            // Set parameters
            
            $param_drugID = trim($_POST["drugID"]);
            $param_drugName = $drugname;
            $param_drugCategory = trim($_POST["drugCategory"]);
            $param_description = $descr;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                echo '<meta content="1;drugslist.php" http-equiv="refresh" />';
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
<div class="page-header centered clearfix"> <h2 class="pull-left">Capture Drug Details</h2></div>
            
    <div class="col-md-12">
        <div class="col-md-3">
            <?php include 'menu.php';?>
        </div>
        <div class="col-md-6">
           <p>Please fill this form to capture drug details.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($drugname_err)) ? 'has-error' : ''; ?>">
                    <label>Drug Name</label>
                    <input type="text" name="drugname" class="form-control" value="<?php echo $drugname; ?>">
                    <span class="help-block"><?php echo $drugname_err; ?></span>
                </div>
               <div class="form-group <?php echo (!empty($drugCategory_err)) ? 'has-error' : ''; ?>">
                    <label>Category</label>
                    <select name="drugCategory" id="drugCategory" class="form-control">
                    <?php
                        $query = "SELECT * FROM  category";
                        $stmt = $pdo->query($query );
                        foreach ($stmt as $row) {
                            echo "<option value='{$row['catID']}'>{$row['catName']}</option>";
                        }
                        ?>
                        </select>
                </div> 
                
                <div class="form-group <?php echo (!empty($descr_err)) ? 'has-error' : ''; ?>">
                    <label>Description</label>
                    <textarea type="text" name="descr" class="form-control" value="<?php echo $descr; ?>"></textarea>
                    <span class="help-block"><?php echo $descr_err; ?></span>
                </div> 	   
                <input type="hidden" name="drugID" class="form-control" value="<?php echo mt_rand(); ?>">
                            
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Add Drug Details">
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