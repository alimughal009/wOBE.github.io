<!DOCTYPE html>
<html>
<head>
	<title>User Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<style>
		body {
			background-color: #f2f2f2;
		}

		.container {
			margin-top: 100px;
			max-width: 500px;
			border: 1px solid #ccc;
			border-radius: 5px;
			padding: 30px;
			background-color: #fff;
			box-shadow: 0 0 10px #ccc;
		}

		h2 {
			margin-bottom: 30px;
			text-align: center;
			font-weight: bold;
			color: #333;
		}

		label {
			font-weight: bold;
			color: #333;
		}

		input[type="email"],
		input[type="password"] {
			width: 100%;
			height: 50px;
			font-size: 16px;
			border-radius: 5px;
			border: 1px solid #ccc;
			padding: 10px;
			margin-bottom: 20px;
		}

		input[type="submit"] {
			width: 100%;
			height: 50px;
			font-size: 16px;
			border-radius: 5px;
			border: none;
			background-color: #007bff;
			color: #fff;
			cursor: pointer;
			margin-top: 20px;
		}

		input[type="submit"]:hover {
			background-color: #0069d9;
		}

        .error {
            color: red;
            margin-bottom: 10px;
        }

	</style>
</head>
<body>
	<div class="container">
		<h2>User Login</h2>
        <?php if(isset($_SESSION['error'])): ?>
        <div class="error">
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
        <?php endif; ?>
		<form action="login_process.php" method="post">
			<div class="form-group">
				<label>Email:</label>
				<input type="email" name="email" class="form-control" required>
			</div>
			<div class="form-group">
				<label>Password:</label>
				<input type="password" name="password" class="form-control" required>
			</div>
			<input type="submit" value="Login">
		</form>
	</div>
</body>
</html>
