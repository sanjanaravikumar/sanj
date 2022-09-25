<?php
 include 'mainfiles.php';
 // Initialize the session
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

$level = $_SESSION["userrole"];
?>
            <div class="row">               
                <div class="col-md-12">
                    <div class="col-md-10">
                    <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["names"]); ?></b>. Welcome .</h1>
                </div>
                    <div class="col-md-2 centered">
                    <img src="upload/<?php
                    $src = $_SESSION["image"]; 
                     if(!empty($src)){
                        echo $src;
                    }
                    else{
                        echo 'na.jpg';
                    }
                    ?>" style=" margin-top:0px;width:100px;height:100px;"/>
                    
                </div>
                </div>
                
<div class="page-header centered clearfix"></div>
                <div class="col-md-12">
                    <div class="col-md-3">
                        <?php include 'menu.php';?>
                    </div>
                    <div class="col-md-9">
                        <div class="wrapper">
                        <div class="row">
                        <?php
                            if($level == 1){
                            ?>
                            <div class="cardCount col-md-3">
                                <!-- <img src="img_avatar.png" alt="Avatar" style="width:100%"> -->
                                <span class='glyphicon glyphicon-user centered'></span>
                                <div class="container">
                                    <h4><b>Users</b></h4>
                                    <p>
                                        <?php
                                    $sql = "SELECT role, count(s.id) as no  FROM user s JOIN role r on s.userrole=r.id  GROUP BY role";
                                    if($result = $pdo->query($sql)){
                                        if($result->rowCount()>0){
                                            while($row = $result->fetch()){
                                                echo '<p><strong>'.$row['role'].'</strong>: '.$row['no'].'</p>';
                                            }
                                        }
                                    }
                                    ?></p>
                                </div>
                            </div>
                            
                            <?php
                            }
                            ?>
                            <!-- <div class="cardCount col-md-3">
                            
                            </div> -->
                            <?php
                            if($level != 3){
                            ?>
                            <div class="cardCount col-md-3">
                            <span class='glyphicon glyphicon-plus centered'></span>
                                <div class="container">
                                    <h4><b>Drugs in Pharmacy</b></h4>
                                    <p>
                                    <?php
                                    $sql = "SELECT count(drug) as no, SUM(stockqty) as totalstock  FROM pharmacy WHERE stockqty > 0 AND expiryDate >= CURDATE() ";
                                    if($result = $pdo->query($sql)){
                                        if($result->rowCount()>0){
                                            while($row = $result->fetch()){
                                                echo '<p><strong>Stocked Drugs: '.$row['no'].'</strong> </p>';
                                                echo '<p><strong>Total stock: '.$row['totalstock'].'</strong></p>';
                                            }
                                        }
                                    }
                                    ?></p>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                            <!-- 
                            <div class="cardCount col-md-3">
                                <img src="img_avatar.png" alt="Avatar" style="width:100%">
                                <div class="container">
                                    <h4><b>Users</b></h4>
                                    <p><8></p>
                                </div>
                            </div> -->
                        </div>
                        <div class="row">                        
                        <div class="col-md-12">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div>

                        </div>
                        <div class="row">
                        <?php
                            if($level != 3){
                            ?>
                            <div class="cardCount col-md-4">
                                <span class='glyphicon glyphicon-user centered'></span>
                                <div class="container">
                                    <h4><b>Drugs</b></h4>
                                    <p>
                                        <?php
                                    $sql = "SELECT COUNT(*) as expiDrugs FROM pharmacy WHERE expiryDate < CURDATE()";
                                    if($result = $pdo->query($sql)){
                                        if($result->rowCount()>0){
                                            while($row = $result->fetch()){
                                                echo '<p><strong>Number of Expired Drugs</strong>: '.$row['expiDrugs'].'</p>';
                                            }
                                        }
                                    }
                                    ?>
                                    <br>
                                        <?php
                                    $sqlOut = "SELECT COUNT(*) as outStockDrugs FROM pharmacy WHERE stockqty = 0 AND expiryDate >= CURDATE()";
                                     if($resultOut = $pdo->query($sqlOut)){
                                        if($resultOut->rowCount()>0){
                                            while($rowo = $resultOut->fetch()){
                                                echo '<p><strong>Number of Out of Stock Drugs</strong>: '.$rowo['outStockDrugs'].'</p>';
                                            }
                                        }
                                    }
                                    ?></p>
                                </div>
                            </div>
                            
                            <?php
                            }
                            ?>
                              <a href="patients.php">                         
                            <div class="cardCount col-md-4">
                            <span class='glyphicon glyphicon-user centered'></span>
                                <div class="container">
                                    <h4><b>Patients</b></h4>
                                    <p>
                                    <?php
                                    $sql = "SELECT count(id) as patients FROM patient";
                                    if($result = $pdo->query($sql)){
                                        if($result->rowCount()>0){
                                            while($row = $result->fetch()){
                                                echo '<p><strong>Total: '.$row['patients'].'</strong> </p>';
                                            }
                                        }
                                    }
                                    ?></p>
                                </div>
                            </div>
                            </a>
                            <!-- 
                            <div class="cardCount col-md-3">
                                <img src="img_avatar.png" alt="Avatar" style="width:100%">
                                <div class="container">
                                    <h4><b>Users</b></h4>
                                    <p><8></p>
                                </div>
                            </div> -->
                        </div>
</div>
                    </div>
                </div>
            </div>
<div class="page-header centered clearfix"></div>
        </div>
    <?php include 'footer.php';?>