<?php
session_start();
include 'connectToDatabase.php';
$conn = connectToDatabase();

// Select courses the student is registered for
$sql_registered = "SELECT courses.id, courses.course_name FROM courses INNER JOIN registrations ON courses.id = registrations.course_id WHERE registrations.student_id = '{$_SESSION['student_id']}'";
$result_registered = mysqli_query($conn, $sql_registered);

// Select courses that the student has not registered yet
$sql_not_registered = "SELECT id, course_name FROM courses WHERE id NOT IN (SELECT course_id FROM registrations WHERE student_id = '{$_SESSION['student_id']}')";
$result_not_registered = mysqli_query($conn, $sql_not_registered);

// Reset the results for select options
$result_registered_for_select = mysqli_query($conn, $sql_registered);
$result_not_registered_for_select = mysqli_query($conn, $sql_not_registered);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="JS/main.js"></script>
</head>
<body>
<h1>Student Dashboard</h1>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <h2>Menu</h2>
                <ul class="list-group">
                    <li class="list-group-item" data-option="register"><a href="#">Register Course</a></li>
                    <li class="list-group-item" data-option="mark"><a href="#">Mark Attendance</a></li>
                    <li class="list-group-item" data-option="view"><a href="#">View Attendance</a></li>
                    <li class="list-group-item" data-option="logout"><a href="logout.php">Logout</a></li>
                </ul>
            </div>
            <div class="col-md-9">
                <!-- The register course form -->
                <div class="row option-content" id="register" style="display: none;">
                    <div class="col-md-12">
                        <h2>Register Course</h2>
                        <form action='process_student.php' method='POST'>
                            <div class="form-group">
                                <label for="courseIdRegister">Course</label>
                                <select id="courseIdRegister" class="form-control" name='course_id'>
                                    <?php
                                    while($row = mysqli_fetch_assoc($result_not_registered_for_select)) {
                                        echo "<option value='{$row['id']}'>{$row['course_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
							<input type='submit' name='register_course' value='Register Course' class="btn btn-primary mb-2">
                        </form>
                    </div>
                </div>
                <!-- The mark attendance form -->
                <div class="row option-content" id="mark" style="display: none;">
                    <div class="col-md-12">
                        <h2>Mark Attendance</h2>
                        <form action='process_student.php' method='POST'>
                            <div class="form-group">
                                <label for="courseIdMark">Course</label>
                                <select id="courseIdMark" class="form-control" name='course_id'>
                                    <?php
                                    mysqli_data_seek($result_registered_for_select, 0); // rewind result set
                                    while($row = mysqli_fetch_assoc($result_registered_for_select)) {
                                        echo "<option value='{$row['id']}'>{$row['course_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <input type='submit' name='mark_attendance' value='Mark Attendance' class="btn btn-primary mb-2">
                        </form>
                    </div>
                </div>
                <!-- The view attendance form -->
                <div class="row option-content" id="view" style="display: none;">
                    <div class="col-md-12">
                        <h2>View Attendance</h2>
                        <form>
                            <div class="form-group">
                                <label for="courseIdView">Course</label>
                                <select id="courseIdView" class="form-control">
                                    <?php
                                    mysqli_data_seek($result_registered_for_select, 0); // rewind result set
                                    while($row = mysqli_fetch_assoc($result_registered_for_select)) {
                                        echo "<option value='{$row['id']}'>{$row['course_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type='button' id='viewAttendanceButton' class="btn btn-primary mb-2">View Attendance</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h2>Your Courses</h2>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Course ID</th>
                                    <th>Course Name</th>
                                    <th>Attendance Status</th>
                                    <th>Attendance Date</th>
                                </tr>
                            </thead>
                            <tbody id='coursesTbody'>
                                <?php
                                mysqli_data_seek($result_registered, 0); // rewind result set
                                while($row = mysqli_fetch_assoc($result_registered)) {
                                    echo "<tr>";
                                    echo "<td>{$row['id']}</td>";
                                    echo "<td class='course-name' data-course-id='{$row['id']}'>{$row['course_name']}</td>";
                                    echo "<td class='attendance-status'>-</td>";
                                    echo "<td class='attendance-date'>-</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
						<?php if (isset($_GET['message'])): ?>
							<p class="error-message"><?php echo $_GET['message']; ?></p>
						<?php endif; ?>						
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
