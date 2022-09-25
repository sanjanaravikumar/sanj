<?php include 'mainfiles.php';?>
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left"> Drug Stock</h2>
                        <a href="adddrugstock.php" class="btn btn-success pull-right" title="Add new Record" data-toggle='tooltip'>
                            <span class='glyphicon glyphicon-plus'></span> Add New stock details</a>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <?php include 'menu.php';?>
                        </div>
                        <div class="col-md-9">
                            <div class="wrapper">
                            <?php
                            //SELECT `drugID`, `drugName`, `drugCategory`, `description` FROM `drug` WHERE 1
                            //SELECT `catID`, `catName`, `descr` FROM `category` WHERE 1
                            //SELECT `drug`, `stockqty`, `stockedDate`, `expiryDate` FROM `pharmacy` WHERE 1
                            $sql = "SELECT * FROM drug d JOIN category c ON d.drugCategory = c.catID LEFT JOIN pharmacy p ON d.drugID = p.drug";
                            if($result = $pdo->query($sql)){
                                if($result->rowCount() > 0){
                                    ?>
                                    <table class='table table-bordered table-striped' id='example'>
                                        <thead>
                                            <tr>
                                                <th>Drug ID</th>
                                                <th>Drug Name</th>
                                                <th>Category</th>
                                                <th>Quantity</th>
                                                <th>Stocked on</th>
                                                <th>Expires on</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i=1;
                                        while($row = $result->fetch()){
                                            ?>
                                             <tr>
                                                <td><?php echo $row['drugID']; ?></td>
                                                <td><?php echo $row['drugName']; ?></td>
                                                <td><?php echo $row['catName']; ?></td>
                                                <td><?php
                                                $qty =   $row['stockqty']; 
                                                if(!empty($qty)){
                                                    echo  $qty;
                                                }else{
                                                    echo '<code>--</code>';
                                                }
                                                ?></td>
                                                <td><?php                                                
                                                $stockedDate =   $row['stockedDate']; 
                                                if(!empty($stockedDate)){
                                                    echo  $stockedDate;
                                                }else{
                                                    echo '<code>--</code>';
                                                } 
                                                 ?></td>
                                                <td><?php
                                                 $expiryDate =   $row['expiryDate']; 
                                                 if(!empty($expiryDate)){
                                                     echo  $expiryDate;
                                                 }else{
                                                     echo '<code>--</code>';
                                                 } 
                                                  ?></td>
                                            </tr>
                                            <?php

                                            $i++;
                                        }
                                        ?>
                                        </tbody>                            
                                    </table>
                                    <?php
                                    // Free result set
                                    unset($result);
                                } else{
                                    echo "<p class='lead'><em>No records were found.</em></p>";
                                }
                            } else{
                                echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                            }
                            
                            // Close connection
                            unset($pdo);
                            ?>
                        </div>
                    </div>
                    
                    <div class="page-header clearfix">
                       </div>
                </div>
            </div>    
        </div>
    </div>
    <?php include 'footer.php';?>    