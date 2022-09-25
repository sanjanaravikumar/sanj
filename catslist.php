<?php include 'mainfiles.php';?>
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">List of Available Drugs Category</h2>
                        <a href="addcategory.php" class="btn btn-success pull-right" title="Add new Record" data-toggle='tooltip'>
                            <span class='glyphicon glyphicon-plus'></span> Add New Drug Category details</a>
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
                            $sql = "SELECT * FROM  category ";
                            if($result = $pdo->query($sql)){
                                if($result->rowCount() > 0){
                                    echo "<table class='table table-bordered table-striped' id='example'>";
                                        echo "<thead>";
                                            echo "<tr>";
                                                echo "<th>#</th>";;
                                                echo "<th>Category</th>";
                                                echo "<th>Description</th>";
                                                echo "<th>Action</th>";
                                            echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody>";
                                        $i=1;
                                        while($row = $result->fetch()){
                                             echo "<tr>";
                                                echo "<td>" . $i . " - </td>";
                                                echo "<td>" . $row['catName'] . "</td>";
                                                echo "<td>" . $row['descr'] . "</td>";
                                                echo "<td>";
                                                    echo "<a href='updatecategory.php?id=". $row['catID'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                                    echo "<a href='deletecategory.php?id=". $row['catID'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
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
                    </div>
                    
                    <div class="page-header clearfix">
                       </div>
                </div>
            </div>    
        </div>
    </div>
    <?php include 'footer.php';?>    