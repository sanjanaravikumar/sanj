<?php
    require_once "mainfiles.php";
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    
    // Prepare a select statement
    $sql = "SELECT s.id as id, names, email, password, gender, mobile, image, userrole, isActive,r.id as roleID, role, descr FROM user s JOIN role r on s.userrole=r.id  WHERE s.id = :id";
    
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
                $name = $row["names"];
                $address = $row["email"];
                $role = $row['role'];
                $gender = $row['gender'];
                $mobile = $row['mobile'];
                $image = $row['image'];
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
<div class="page-header centered clearfix"> <h2 class="pull-left">User Profile</h2></div>
            
    <div class="col-md-12">
        <div class="col-md-3">
            <?php include 'menu.php';?>
        </div>
        <div class="col-md-6">
                   <div class="form-group">
                        <p class="form-control-static">
                        <strong>Name: </strong> <code><?php echo $name; ?> </code></p>
                    </div>
                    <div class="form-group">
                        <p class="form-control-static"><strong>Email: </strong>  <code><?php echo $address; ?> </code></p>
                    </div>
                    <div class="form-group">
                        <p class="form-control-static"> <strong>Gender: </strong> <code><?php echo $gender; ?> </code></p>
                    </div>
                    <div class="form-group">
                        <p class="form-control-static"><strong>Role: </strong>  <code><?php echo  $role; ?> </code></p>
                    </div>
                   
                    <div class="form-group">
                        <p class="form-control-static"><strong>Mobile: </strong>  <code><?php echo $mobile; ?> </code></p>
                    </div>
                    </div>    
        <div class="col-md-3">
                    
                <div class="centered">
                    <img src="upload/<?php
                    $src =$image; 
                     if(!empty($src)){
                        echo $src;
                    }
                    else{
                        echo 'na.jpg';
                    }
                    ?>" style=" margin-top: 10px;width:100px;height:120px;"/>
                </div>
                    
            </div>
    </div>
    
<div class="page-header centered clearfix"></div>
</div>
    <?php include 'footer.php';?>