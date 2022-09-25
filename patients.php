<?php include 'mainfiles.php';?>
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">List of Patients Details</h2>
                        <a href="addpatient.php" class="btn btn-success pull-right" title="Add new patient's Record" data-toggle='tooltip'>
                            <span class='glyphicon glyphicon-plus'></span> Add New Patient details</a>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <?php include 'menu.php';?>
                        </div>
                        <div class="col-md-9">
                            <div class="wrapper">
                            <?php
                            // Include config file
                            require_once "config.php";
                            //SELECT `id`, `patientname`, `gender`, `dob`, `mobile`, `address` FROM `patient` WHERE 1
                            // Attempt select query execution
                            $sql = "SELECT * FROM patient";
                            if($result = $pdo->query($sql)){
                                if($result->rowCount() > 0){
                                    echo "<table class='table table-bordered table-striped' id='example'>";
                                        echo "<thead>";
                                            echo "<tr>";
                                                echo "<th>Patient ID</th>";
                                                echo "<th>Name</th>";
                                                echo "<th>Address</th>";
                                                echo "<th>DOB</th>";
                                                echo "<th>Gender</th>";
                                                echo "<th>Mobile</th>";
                                                echo "<th>Action</th>";
                                            echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody>";
                                        while($row = $result->fetch()){
                                            echo "<tr>";
                                                echo "<td>" . $row['id'] . "</td>";
                                                echo "<td>" . $row['patientname'] . "</td>";
                                                echo "<td>" . $row['address'] . "</td>";
                                                echo "<td>" . $row['dob'] . "</td>";
                                                echo "<td>" . $row['gender'] . "</td>";
                                                echo "<td>" . $row['mobile'] . "</td>";
                                                echo "<td>";
                                                    echo "<a href='readpatient.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                                    echo "<a href='updatepatient.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                                    echo "<a href='deletepatient.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                                echo "</td>";
                                            echo "</tr>";
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