<?php
include 'mainfiles.php';
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    echo '<meta content="1;dashboard.php" http-equiv="refresh" />';
    //header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter your email.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        //SELECT `id`, `names`, `email`, `password`, `gender`, `mobile`, `image`, `userrole`, `isActive` FROM `user` WHERE 1
        $sql = "SELECT id, names, email, password,userrole,image FROM user WHERE email = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            //$stmt->bindParam(":isActive", $param_isActive, PDO::PARAM_INT);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            //$param_username = 1;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["email"];
                        $fnames = $row["names"];
                        $userrole = $row["userrole"];
                        $image = $row["image"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            //session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["names"] = $fnames;
                            $_SESSION["image"] = $image; 
                            $_SESSION["userrole"] = $userrole;
                            $_SESSION["email"] = $username;                            
                            
                            // Redirect user to welcome page
                            echo '<meta content="1;dashboard.php" http-equiv="refresh" />';
                            //header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}
?>
   <div class="container" style="min-height:500px;">
            <div class="wrapper">
                <div class="row">
                    <div class="col-md-3">
                    <div class="centered">
                    <img src="upload/medicallogo.jpg" style=" margin-top: 70px;width:200px;height:200px;"/></div>
                    </div>
                    <div class="col-md-6">
                    <div class="centered">
                        <h2>Login</h2>
                        <p>Please fill in your credentials to login.</p>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                <label>Email</label>
                                <input type="email" name="username" class="form-control" value="<?php echo $username; ?>">
                                <span class="help-block"><?php echo $username_err; ?></span>
                            </div>    
                            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                                <span class="help-block"><?php echo $password_err; ?></span>
                            </div>
                            <div class="form-group centered">
                                <input type="submit" class="btn btn-primary" value="Login">
                            </div>
                            
                        </form>
                    </div>                    
                    <div class="col-md-3">
                    </div>
                </div>
            </div>
        </div>
   <?php include 'footer.php';?>