<?php 
include 'mainfiles.php';
// Define variables and initialize with empty values
$catname = $descr = "";
$catname_err = $descr_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["catname"]))){
        $catname_err = "Please enter category name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT catID FROM category WHERE catName = :catname";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":catname", $param_catname, PDO::PARAM_STR);
            
            // Set parameters
            $param_catname = trim($_POST["catname"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $catnamee_err = "This category name is already exists.";
                } else{
                    $catname = trim($_POST["catname"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Validate cat name
    if(empty(trim($_POST["catname"]))){
        $catname_err = "Please enter a category name.";     
    } else{
        $catname = trim($_POST["catname"]);
    }
    
    // Validate description
    if(empty(trim($_POST["descr"]))){
        $descr_err = "Please provide the category description.";     
    } else{
        $descr = trim($_POST["descr"]);
    }
   
    // Check input errors before inserting in database
    if(empty($catname_err) && empty($descr_err)){
        
        // Prepare an insert statement
        //INSERT INTO `drug`(`drugID`, `drugName`, `catCategory`, `description`) VALUES ([value-1],[value-2],[value-3],[value-4])
        $sql = "INSERT INTO category(catName, descr) VALUES (:catName, :description)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":catName", $param_catName, PDO::PARAM_STR);
            $stmt->bindParam(":description", $param_description, PDO::PARAM_STR);
            
            // Set parameters
            $param_catName = $catname;
            $param_description = $descr;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                echo '<meta content="1;catslist.php" http-equiv="refresh" />';
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
//SELECT `catID`, `catName`, `descr` FROM `category` WHERE 1
?>
 
<div class="row">
<div class="page-header centered clearfix"> <h2 class="pull-left">Drug Category</h2></div>
            
    <div class="col-md-12">
        <div class="col-md-3">
            <?php include 'menu.php';?>
        </div>
        <div class="col-md-6">
           <p>Please fill this form to capture drug category details.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($catname_err)) ? 'has-error' : ''; ?>">
                    <label>Category Name</label>
                    <input type="text" name="catname" class="form-control" value="<?php echo $catname; ?>">
                    <span class="help-block"><?php echo $catname_err; ?></span>
                </div>                
                <div class="form-group <?php echo (!empty($descr_err)) ? 'has-error' : ''; ?>">
                    <label>Description</label>
                    <textarea type="text" name="descr" class="form-control" value="<?php echo $descr; ?>"></textarea>
                    <span class="help-block"><?php echo $descr_err; ?></span>
                </div> 	   
                            
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Add category Details">
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