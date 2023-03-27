<!DOCTYPE html>
<html>
<head>
	<title>Verify Email</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<!-- Custom CSS -->
	<style>
		.form-group label {
			font-weight: bold;
			margin-top: 10px;
		}
	</style>
</head>
<body>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header text-center" style="background-color: #007bff;">
    					<h3>Verify Email</h3>
    					<p>Please enter the verification code sent to your email address.</p>
					</div>
					<div class="card-body">
						<?php if(isset($_SESSION['error'])): ?>
							<div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
							<?php unset($_SESSION['error']); ?>
						<?php endif; ?>
						<form action="verify_process.php" method="get">
							<div class="form-group">
								<label for="code">Verification Code:</label>
								<input type="text" class="form-control" id="code" name="code" required>
							</div>
                            <button class="btn btn-primary" type="submit">Verify</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Bootstrap JS and jQuery -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
