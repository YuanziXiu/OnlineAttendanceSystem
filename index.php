<?php
  session_start();
  $isIndex = 1;
  if(array_key_exists('teacher_id',$_SESSION) && isset($_SESSION['teacher_id'])) {
   header('Location: teacher.php');
  } else {
    if(!$isIndex) header('Location: index.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/style.css"/>
  <title>Student Attendance</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/login.js"></script>
   <!-- Custom styles for this template -->
    <link href="navbar-fixed-top.css" rel="stylesheet">
 </head>
 <body>
 
    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Online Attendance</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<head>
    <title>Home</title>
    <style>
        body {
            text-align: center;
        }

        .button-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10vh
        }

        .button-wrapper a {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 20vw; 
            height: 20vw; 
            font-size: 30px;
            text-decoration: none;
            background-color: #428bca;
            color: white;
            border: none;
            text-align: center;
            transition: background-color 0.3s ease;
            border-radius: 5%;
        }

        .button-wrapper a:hover {
            background-color: #336699;
        }
    </style>
</head>
<body>  
    <h2 style='color:gray; margin-top: 15vh; margin-right:52vw;'>Choose your identity:</h2>
    <div class="button-wrapper">
        <a href="student.php">Student</a>
        <a href="index.php" style="margin-left: 10%;">Tutor</a>
    </div>
</body>
</html>
