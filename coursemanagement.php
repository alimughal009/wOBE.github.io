<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Course Management</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Custom CSS -->
    <style>
        /* Add custom styles here */
    </style>
</head>
<body>
    <div class="container">
        <h1>Course Management</h1>
        <form>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description"></textarea>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" class="form-control" id="start_date">
            </div>
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" class="form-control" id="end_date">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection information
                $host = "localhost:3307";
                $user = "root";
                $password = "";
                $dbname = "wobe";

                // Connect to the database
                $conn = new mysqli($host, $user, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Function to add a new course
                function add_course($name, $description, $start_date, $end_date) {
                    global $conn;
                    $sql = "INSERT INTO courses (name, description, start_date, end_date) VALUES ('$name', '$description', '$start_date', '$end_date')";
                    if ($conn->query($sql) === TRUE) {
                        return true;
                    } else {
                        return false;
                    }
                }

                // Function to update an existing course
                function update_course($id, $name, $description, $start_date, $end_date) {
                    global $conn;
                    $sql = "UPDATE courses SET name='$name', description='$description', start_date='$start_date', end_date='$end_date' WHERE id='$id'";
                    if ($conn->query($sql) === TRUE) {
                        return true;
                    } else {
                        return false;
                    }
                }

                // Function to delete a course
function delete_course($id) {
    global $conn;
    $sql = "DELETE FROM courses WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}



// Close the database connection
$conn->close();
?>

<!-- HTML code -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Course Management</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Course Management</h1>
    <?php if (isset($message)): ?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php endif; ?>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-4">
            <h3>Add Course</h3>
            <form method="post" action="index.php">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="add_course" class="btn btn-primary">Add Course</button>
                </div>
            </form>
        </div>
        <div class="col-md-8">
            <h3>View Courses</h3>
            <?php if (count($courses) > 0): ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($courses as $course): ?>
                        <tr>
                            <td><?php echo $course['id']; ?></td>
                            <td><?php echo $course['name']; ?></td>
                            <td><?php echo $course['description']; ?></td>
                            <td><?php echo $course['start_date']; ?></td>
                            <td><?php echo $course['end_date']; ?></td>
                            <td>
                                        <a href="edit.php?id=<?php echo $course['id']; ?>" class="btn btn-primary">Edit</a>
                                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                            <input type="hidden" name="id" value="<?php echo $course['id']; ?>">
                                            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No courses found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>