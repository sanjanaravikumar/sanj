<?php
    require_once "config.php";
    
session_start();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="upload/medicallogo.jpg">
    <title>Nightingale Dispensary Management System</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
  <link href="bootstrap/css/DataTables/datatables.min.css" rel="stylesheet">  

  <!-- Datepicker -->
  <link rel="stylesheet" type="text/css" href="bootstrap/datepicker.css" /> 
<script type="text/javascript" src="bootstrap/datepicker.js"></script>
<script type="text/javascript" src="bootstrap/timepicker.js"></script>

  <script src="bootstrap/css/DataTables/datatables.min.js"></script>
  <script type="text/javascript" src="bootstrap/simpletreemenu.js">

/***********************************************
* Simple Tree Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
***********************************************/

</script>

<link rel="stylesheet" type="text/css" href="bootstrap/simpletree.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/styles.css" />
   
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="gradient-border" > 
        <div role="navigation" class="navbar navbar-default navbar-static-top">
            <div class="container">       
		        <div class="navbar-header">
                    <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <h2><a href="#" class="navbar-brand"> Nightingale Dispensary Management System</a></h2>
                </div>		
            </div>
        </div>
        <div class="container" style="min-height:500px;">