<?php include 'mainfiles.php';?>
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">List of Available Drugs</h2>
                        <a href="adddrug.php" class="btn btn-success pull-right" title="Add new Record" data-toggle='tooltip'>
                            <span class='glyphicon glyphicon-plus'></span> Add New Drug details</a>
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
                            $sql = "SELECT * FROM drug d JOIN category c on d.drugCategory = c.catID";
                            if($result = $pdo->query($sql)){
                                if($result->rowCount() > 0){
                                    echo "<table class='table table-bordered table-striped' id='example'>";
                                        echo "<thead>";
                                            echo "<tr>";
                                                echo "<th>Drug ID</th>";
                                                echo "<th>Drug Name</th>";
                                                echo "<th>Category</th>";
                                                echo "<th>Description</th>";
                                                echo "<th>Action</th>";
                                            echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody>";
                                        $i=1;
                                        while($row = $result->fetch()){
                                            ?>
                                             <tr>
                                               <td> <?php echo $row['drugID'];?> </td>
                                               <td> <?php echo $row['drugName']; ?> </td>
                                               <td> <?php echo $row['catName']; ?> </td>
                                               <td> <?php echo $row['description']; ?> </td>
                                               <td>
                                                 <a href='readdrug.php?id=<?php echo $row['drugID']; ?>' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>
                                                 <a href='updatedrug.php?id=<?php echo $row['drugID']; ?>' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>
                                                 <a href='deletedrug.php?id=<?php echo $row['drugID']; ?>' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>
                                            </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        echo "</tbody>";                            
                                    echo "</table>";
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
                        <br>
                       <p><button class="btn btn-block btn-primary" onclick="goBack()"> << Back</button></p>
                      
                    </div>
                    
                    <div class="page-header clearfix">
                       </div>
                </div>
            </div>    
        </div>
    </div>
    <?php include 'footer.php';?>    