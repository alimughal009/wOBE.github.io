

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            padding: 50px;
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #333;
            background-color: #f8f9fa;
        }
        h1 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 30px;
        }
        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        li {
            margin-bottom: 10px;
        }
        li a {
            display: block;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
        }
        li a:hover {
            background-color: #0062cc;
            color: #fff;
        }
        .logout {
            display: inline-block;
            padding: 10px;
            background-color: #dc3545;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
        .logout:hover {
            background-color: #c82333;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the wOBE Admin Dashboard</h1>
        <ul>
            <li><a href="usermangement.php" target="_blank">User Management</a></li>
            <li><a href="coursemanagement.php" target="_blank">Course Management</a></li>
            <li><a href="assesmentmanagement.php" target="_blank">Assessment Management</a></li>
            <li><a href="reporting.php" target="_blank">Reporting</a></li>
            <li><a href="systemmanagement.php" target="_blank">System Management</a></li>
        </ul>
        <form method="post" style="margin-top: 30px;">
            <button type="submit" name="logout" class="logout">Logout</button>
        </form>
    </div>
</body>
</html>
