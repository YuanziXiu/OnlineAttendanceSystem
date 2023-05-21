<?php
session_start();
include 'connectToDatabase.php';
$conn = connectToDatabase();

$sql = "SELECT id, course_name FROM courses WHERE teacher_id = '{$_SESSION['teacher_id']}'";
$result = mysqli_query($conn, $sql);

// add these lines
$sql_attendance = "SELECT attendance.status, attendance.date, courses.id, courses.course_name FROM attendance INNER JOIN courses ON attendance.course_id = courses.id WHERE courses.teacher_id = '{$_SESSION['teacher_id']}'";
$result_attendance = mysqli_query($conn, $sql_attendance);

$result_for_select = mysqli_query($conn, $sql); // second result set for select options
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="JS/main.js" defer></script>
</head>
<body>
    <h1>Teacher Dashboard</h1>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <h2>Menu</h2>
                <ul class="list-group">
                    <li class="list-group-item" data-option="add"><a href="#">Add Course</a></li>
                    <li class="list-group-item" data-option="delete"><a href="#">Delete Course</a></li>
                    <li class="list-group-item" data-option="view"><a href="#">View Attendance</a></li>
                    <li class="list-group-item" data-option="logout"><a href="logout.php">Logout</a></li>
                </ul>
            </div>
            <div class="col-md-9">
                <!-- The add course form -->
                <div class="row option-content" id="add" style="display: none;">
                    <div class="col-md-12">
                        <h2>Add Course</h2>
                        <form action='process_teacher.php' method='POST'>
                            <div class="form-group">
                                <label for="courseName">Course Name</label>
                                <input type='text' class="form-control" id="courseName" name='add_course' placeholder='Course Name'>
                            </div>
                            <input type='submit' value='Add Course' class="btn btn-primary mb-2">
                        </form>
                    </div>
                </div>
                <!-- The delete course form -->
                <div class="row option-content" id="delete" style="display: none;">
                    <div class="col-md-12">
                        <h2>Delete Course</h2>
                        <form action='process_teacher.php' method='GET'>
                            <div class="form-group">
                                <label for="courseId">Course</label>
                                <select id="courseId" class="form-control" name='course_id'>
                                    <?php
                                    while($row = mysqli_fetch_assoc($result_for_select)) {
                                        echo "<option value='{$row['id']}'>{$row['course_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <input type='submit' value='Delete Course' class="btn btn-danger mb-2">
                        </form>
                    </div>
                </div>
                <!-- The view attendance form -->
                <div class="row option-content" id="view" style="display: none;">
                    <div class="col-md-12">
                        <h2>View Attendance</h2>
                        <form id='attendance-form'>
                            <div class="form-group">
                                <label for="courseIdView">Course</label>
                                <select id="courseIdView" class="form-control" name='course_id'>
                                    <?php
                                    $result_for_select_2 = mysqli_query($conn, $sql); // third result set for select options
                                    while($row = mysqli_fetch_assoc($result_for_select_2)) {
                                        echo "<option value='{$row['id']}'>{$row['course_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <input type='submit' value='View Attendance' class="btn btn-success mb-2">
                        </form>
                    </div>
                </div>
                <!-- The course info will be here -->
                <div class="row" id="courseInfo">
                    <div class="col-md-12">
                        <h2>Course Information</h2>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Course ID</th>
                                    <th scope="col">Course Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>{$row['id']}</td>";
                                    echo "<td class='course-name' data-course-id='{$row['id']}'>{$row['course_name']}</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- The attendance info will be here -->
                <div class="row" id="attendance-info" style="display: none;">
                    <div class="col-md-12">
                        <h2>Attendance Information</h2>
                        <table class="table table-striped" id="attendance-table">
                            <thead>
                                <tr>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Attendance Status</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
							<tbody>               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
