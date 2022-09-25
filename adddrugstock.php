<?php 
include 'mainfiles.php';
// Define variables and initialize with empty values
$drugname = $drugQty = $expiryDate = "";
$drugname_err = $drugQty_err = $expiryDate_err = "";
$stockqty = 0;
$isNewEntry = true;
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $stockqty = trim($_POST["drugQty"]);
    // Validate username
    if(empty(trim($_POST["drugQty"]))){
        $drugQty_err = "Please enter drug Quantity.";
    } else{
        // Prepare a select statement
        $sql = "SELECT stockqty FROM pharmacy WHERE drug = :drugname";
        //SELECT `drug`, `stockqty`, `stockedDate`, `expiryDate` FROM `pharmacy` WHERE 1
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":drugname", $param_drugname, PDO::PARAM_STR);
            
            // Set parameters
            $param_drugname = trim($_POST["drugname"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    //$stmt = $pdo->query($query );
                    $row = $stmt->fetch();
                    $stockqty += $row['stockqty'];
                    $isNewEntry = false;
                } else{
                    $isNewEntry = true;
                    //$stockqty = trim($_POST["drugQty"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Validate description
    if(empty(trim($_POST["expiryDate"]))){
        $expiryDate_err = "Please provide the expiry Date.";     
    } else{
        $expiryDate = trim($_POST["expiryDate"]);
    }    
    $drugname = trim($_POST["drugname"]);    
   
    // Check input errors before inserting in database
    if(empty($drugname_err) && empty($descr_err)){
        
        $sql = "";
        if($isNewEntry){
        $sql = "INSERT INTO pharmacy(drug, stockqty,stockedDate, expiryDate) VALUES (:drug, :stockqty,:stockedDate, :expiryDate)";
        }else{
            $sql = "UPDATE pharmacy SET stockqty=:stockqty, stockedDate=:stockedDate, expiryDate=:expiryDate WHERE drug=:drug";
        }
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":drug", $param_drugID, PDO::PARAM_INT);
            $stmt->bindParam(":stockqty", $param_stockqty, PDO::PARAM_STR);
            $stmt->bindParam(":stockedDate", $param_stockedDate);
            $stmt->bindParam(":expiryDate", $param_expiryDate);
            
            // Set parameters
            
            $param_drugID = $drugname;
            $param_stockqty = $stockqty;
            $param_stockedDate = date("Y-m-d");
            $param_expiryDate = date($expiryDate);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                echo '<meta content="1;drugstocklist.php" http-equiv="refresh" />';
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
                    <label>Drug</label>
                    <select name="drugname" id="drugname" class="form-control">
                    <?php
                        $query = "SELECT * FROM  drug";
                        $stmt = $pdo->query($query );
                        foreach ($stmt as $row) {
                            echo "<option value='{$row['drugID']}'>{$row['drugName']}</option>";
                        }
                        ?>
                        </select>
                </div>
                <div class="form-group <?php echo (!empty($drugQty_err)) ? 'has-error' : ''; ?>">
                    <label>Quantity</label>
                    <input type="number" name="drugQty" class="form-control" value="<?php echo $drugQty; ?>">
                    <span class="help-block"><?php echo $drugQty_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($expiryDate_err)) ? 'has-error' : ''; ?>">
                    <label>Expiry Date</label>
                    <input type="text" name="expiryDate" class="form-control col-md-6 datepicker" id='start_dt'  value="<?php echo $expiryDate; ?>" readonly >
                     <span class="help-block"><?php echo $expiryDate_err; ?></span>
                </div>
                <br>
                
                <div class="form-group">
                   
                </div>
                            
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Stock ">
                    <input type="reset" class="btn btn-default" value="Reset">
                </div>
            </form>
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