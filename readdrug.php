<?php
    require_once "mainfiles.php";
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    
    // Prepare a select statement
    $sql = "SELECT * FROM drug d JOIN category c on d.drugCategory = c.catID WHERE d.drugID = :id";
    
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
                $drugID = $row["drugID"];
                $drugName = $row["drugName"];
                $catName = $row["catName"];
                $description = $row['description'];
                $drugCategory = $row['drugCategory'];
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
<div class="page-header centered clearfix"> <h2 class="pull-left">Drug ID: <code><?php echo $row["drugID"]; ?></code> Details</h2></div>
            
    <div class="col-md-12">
        <div class="col-md-3">
            <?php include 'menu.php';?>
        </div>
        <div class="col-md-8">
            <table class='table table-hover centerd'>
                <tbody>
                    <tr>
                        <td>
                   <div class="form-group">
                        <p class="form-control-static">
                        <strong>Name: </strong> </p>
                    </div>
                        </td>
                        <td><code><?php echo $drugName; ?> </code></td>
                    </tr>
                    <tr>
                        <td>
                         <div class="form-group">
                        <p class="form-control-static"><strong>category: </strong></p>
                    </div>
                    </td>
                        <td>  <code><?php echo $catName; ?> </code></td>
                    </tr>
                    <tr>
                        <td>
                    <div class="form-group">
                        <p class="form-control-static"> <strong>Description: </strong> </p>
                    </div>
                    </td>
                        <td><code><?php echo $description; ?> </code></td>
                    </tr>
                </tbody>
             </table>
                   
                   
                    </div>    
       <!--  <div class="col-md-3">
    </div> -->


<div class="page-header centered clearfix"></div>
</div>
    <?php include 'footer.php';?>