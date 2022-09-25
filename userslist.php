<?php include 'mainfiles.php';?>
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">List of Users</h2>
                        <a href="adduser.php" class="btn btn-success pull-right" title="Add new user Record" data-toggle='tooltip'>
                            <span class='glyphicon glyphicon-plus'></span> Add New System user</a>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <?php include 'menu.php';?>
                        </div>
                        <div class="col-md-9">
                            <div class="wrapper">
                            <?php
                            // Include config file
                            //SELECT `id`, `patientname`, `gender`, `dob`, `mobile`, `address` FROM `patient` WHERE 1
                            // Attempt select query execution
                            $sql = "SELECT s.id as id, names, email, password, gender, mobile, image, userrole, isActive,r.id as roleID, role, descr FROM user s JOIN role r on s.userrole=r.id";
                            if($result = $pdo->query($sql)){
                                if($result->rowCount() > 0){
                                    echo "<table class='table table-bordered table-striped' id='example'>";
                                        echo "<thead>";
                                            echo "<tr>";
                                                echo "<th>#</th>";
                                               // echo "<th>RID</th>";
                                                echo "<th>Name</th>";
                                                echo "<th>Email</th>";
                                                echo "<th>Gender</th>";
                                                echo "<th>Mobile</th>";
                                                echo "<th>Role</th>";
                                                echo "<th>Action</th>";
                                            echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody>";
                                        $i=1;
                                        while($row = $result->fetch()){
                                            //SELECT `id`, `names`, `email`, `password`, `gender`, `mobile`, `image`, `userrole`, `isActive` FROM `user` WHERE 1
                                            echo "<tr>";
                                                echo "<td>" .$i . " - </td>";
                                                //echo "<td>" .$row['id'] . " - </td>";
                                                //echo "<td>" .$row['roleID'] . " - </td>";
                                                echo "<td>" . $row['names'] . "</td>";
                                                echo "<td>" . $row['email'] . "</td>";
                                                echo "<td>" . $row['gender'] . "</td>";
                                                echo "<td>" . $row['mobile'] . "</td>";
                                                echo "<td>" . $row['role'] . "</td>";
                                                echo "<td>";
                                                    echo "<a href='readuser.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                                    echo "<a href='updateuser.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                                    echo "<a href='deleteuser.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                                echo "</td>";
                                            echo "</tr>";
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