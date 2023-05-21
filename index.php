<!DOCTYPE html>
<html>
<head>
<!-- Added heading "1s Attendance System" here -->
  <h1 class="text-center mt-4">1sAttendance System</h1>
  
  <title>Login</title> 
  <link rel="stylesheet" type="text/css" href="CSS/styles.css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="JS/main.js"></script>
  
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mt-5">
          <div class="card-body">
            <?php if (isset($_GET['message'])): ?>
              <p class="error-message"><?php echo $_GET['message']; ?></p>
            <?php endif; ?>
            <form id="loginForm" action="process_login.php" method="post">
              <h2 class="text-center mb-4">Login</h2>
              <div class="form-group">
                <label for="userType">Login as:</label>
                <select name="userType" id="userType" class="form-control" required>
                  <option value="">Select...</option>
                  <option value="teacher">Teacher</option>
                  <option value="student">Student</option>
                </select>
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
              </div>
              <input type="submit" value="Login" class="btn btn-primary btn-block">
            </form>
            <p class="mt-3 text-center">Not registered? <a href="#" id="signupLink">Register here</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="footer text-center mt-4">
  </div>
</body>
</html>
