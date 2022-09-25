<?php
$level = $_SESSION["userrole"];
?>
<ul id="treemenu1" class="treeview">
<li><a href="dashboard.php">Home</a></li>

<?php
if($level == 1 || $level == 3){
?>
<li>Patients
	<ul>
	<li><a href="addpatient.php">New admission</a></li>
	<li><a href="patients.php">View List</a></li>
	</ul>
</li>
<?php
}
?>
<li>Users
	<ul>
	<?php
	if($level == 1){
	?>
	<li><a href="adduser.php" >New user</a></li>
	<li><a href="userslist.php">users list</a></li>
	<?php
		}
	?>
	<li><a href="photoupdate.php">Update Profile photo</a></li>
	<li><a href="resetpassword.php">Password Reset</a></li>
	
	<?php
	if($level == 1 || $level == 2){
	?>
	<li> Doctor
		<ul>
		<li><a href="addprescr.php">Prescription</a></li>
		</ul>
	</li>
	<?php } ?>
</ul>
</li>
<?php
if($level == 1 || $level == 4){
?>
<li>Pharmacy
	<ul>
	<li><a href="drugstocklist.php">Stock list</a></li>
	<li><a href="dispensedrug.php">Dispense</a></li>
	<li>Medics
		<ul rel="open">
		<li>Drug
			<ul>
				<li><a href="adddrugstock.php">Add Stock</a></li>
			<li><a href="adddrug.php">New Drug</a></li>
			<li>Category
                <ul>
		            <li><a href="addcategory.php">New Category</a></li>
		            <li><a href="catslist.php">Category List</a></li>
		        </ul>
			</li>
			<li><a href="drugslist.php">Drugs List</a></li>
			<!-- <li>Sub item 1.1.1.3</li>
			<li>Sub item 1.1.1.4</li> -->
			</ul>
		</li>
		</ul>
	</li>
    </ul>
</li>
<?php
}
?>
<li><a href="logout.php" ><span class='glyphicon glyphicon-exit'></span> Sign Out</a></li>
</ul>

<script type="text/javascript">
//ddtreemenu.createTree(treeid, enablepersist, opt_persist_in_days (default is 1))
ddtreemenu.createTree("treemenu1", true)

</script>