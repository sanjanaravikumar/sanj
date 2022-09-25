<?php include 'mainfiles.php';?>
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Dispense Drug to patient</h2>
                        <!-- <a href="adddrugstock.php" class="btn btn-success pull-right" title="Add new Record" data-toggle='tooltip'>
                            <span class='glyphicon glyphicon-plus'></span> Add New stock details</a> -->
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <?php include 'menu.php';?>
                        </div>
                        <div class="col-md-9">
                            <div class="wrapper">
                            <?php
                            //SELECT `id`, `patientname`, `gender`, `dob`, `mobile`, `address` FROM `patient` WHERE 1
                            //SELECT `id`, `patient`, `dateofpres`, `prescription`, `patientsMedicalHist` FROM `prescription` WHERE 1
                            //SELECT `drugID`, `drugName`, `drugCategory`, `description` FROM `drug` WHERE 1
                            //SELECT `catID`, `catName`, `descr` FROM `category` WHERE 1
                            //SELECT `drug`, `stockqty`, `stockedDate`, `expiryDate` FROM `pharmacy` WHERE 1
                            //$sql = "SELECT * FROM patient p LEFT JOIN prescription ps ON p. drug d JOIN category c ON d.drugCategory = c.catID LEFT JOIN pharmacy p ON d.drugID = p.drug";
                            $sql = "SELECT p.id,patientname,prescription,patientsMedicalHist FROM patient p JOIN prescription ps ON p.id=ps.patient";
                            if($result = $pdo->query($sql)){
                                if($result->rowCount() > 0){
                                    ?>
                                    <table class='table table-bordered table-striped' id='example'>
                                        <thead>
                                            <tr>
                                                <th>Patient ID</th>
                                                <th> Name</th>
                                                <th>prescription</th>
                                                <th>Medical History</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i=1;
                                        while($row = $result->fetch()){
                                            ?>
                                             <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['patientname']; ?></td>
                                                <td><?php echo $row['prescription']; ?></td>
                                                <td><?php echo $row['patientsMedicalHist']; ?></td>
                                                
                                                <td>
                                                    <a href='dispence.php?id=<?php echo $row['id']; ?>' title='Dispense drugs to patient' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>
                                                    </td>
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