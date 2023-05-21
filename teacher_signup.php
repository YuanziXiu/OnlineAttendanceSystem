<!DOCTYPE html>
<html>
<head>
<!-- Added heading "1s Attendance System" here -->
  <h1 class="text-center mt-4">1sAttendance System</h1>
  <title>Teacher Registration</title>
  <link rel="stylesheet" type="text/css" href="CSS/styles.css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="JS/main.js"></script>
  <style>
	body{
      background-color: lightgrey;
	}
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mt-5">
          <div class="card-body">
            <div id="message"></div>
            <form id="registerForm" action="process_signup.php" method="post">
              <h2 class="text-center mb-4">Teacher Registration</h2>
              <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
                <input type="hidden" name="signup_type" value="teacher">
              </div>
              <input type="submit" value="Register" class="btn btn-primary btn-block">
            </form>
            <p class="mt-3 text-center">Already registered? <a href="index.php">Login here</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
