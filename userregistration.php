
<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>User Registration</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<!-- Custom CSS -->
	<style>
		.form-group label {
			font-weight: bold;
			margin-top: 10px;
		}
		.password-strength {
			margin-top: 10px;
		}
		.password-strength span {
			display: inline-block;
			padding: 5px;
			color: #fff;
			border-radius: 5px;
			font-weight: bold;
		}
		.password-strength .weak {
			background-color: #dc3545;
		}
		.password-strength .fair {
			background-color: #ffc107;
		}
		.password-strength .strong {
			background-color: #28a745;
		}
		.terms-label {
 		    display: flex;
            align-items: center;
        }
	</style>
</head>
<body>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card">
				<div class="card-header text-center" style="background-color: #007bff;">
    				<h3> User Registration</h3>
    				<p2> Please fill this form to create an account.</p2>
				</div>


					<div class="card-body">
					<?php if(isset($_SESSION['error'])): ?>
							<div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
							<?php unset($_SESSION['error']); ?>
						<?php endif; ?>
						<form action="register_process.php" method="post" id="register-form">
							<div class="form-group row">
								<div class="col">
									<label for="first_name">First Name:</label>
									<input type="text" class="form-control" id="first_name" name="first_name" required>
								</div>
								<div class="col">
									<label for="last_name">Last Name:</label>
									<input type="text" class="form-control" id="last_name" name="last_name" required>
								</div>
							</div>
							<div class="form-group">
							<label for="email">Email:</label>
								<input type="email" class="form-control" id="email" name="email" required>
								<div id="emailAlert" class="alert alert-danger d-none mt-2"></div>
							</div>

							<div class="form-group">
								<label for="contact_number">Contact Number:</label>
								<input type="text" class="form-control" id="contact_number" name="contact_number" required>
							</div>
							
							<div class="form-group">
								<label for="password">Password:</label>
								<div class="input-group">
									<input type="password" class="form-control" id="password" name="password" required>
									<div class="input-group-append">
									  	<button class="btn btn-outline-primary" type="button" id="show_password">Show</button>
									</div>
								</div>
								<small id="passwordHelp" class="form-text text-muted">Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.</small>

								<div id="passwordAlert" class="alert alert-danger d-none mt-2"></div>
								</div>
						<div class="form-group confirm-password">
							<label for="confirm_password">Confirm Password:</label>
							<div class="input-group">
								<input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
								<div class="input-group-append">
									<button class="btn btn-outline-primary" type="button" id="show_confirm_password">Show</button>
							    </div>
							</div>
						</div>

						<div class="form-group form-check">
							<div class="d-flex align-items-center" style="align-items: center;">
							<input type="checkbox" class="form-check-input" id="terms_of_service" required style="margin-right: 5px;">
								<label class="form-check-label" for="terms_of_service">I agree with the <a href="/terms-of-service">terms of services</a></label>
							</div>
						</div>

						
						<?php if(isset($_SESSION['error'])): ?>
  						 <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
  						 <?php unset($_SESSION['error']); ?>
						<?php endif; ?>
						<button type="submit" class="btn btn-primary" type="button">Register</button>

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
<!-- Custom JS -->
<script>
	$(document).ready(function() {
	  // Update password strength indicator on keyup
	  $('#password').on('keyup', function() {
	    var password = $(this).val();
	    var strength = getPasswordStrength(password);
	    updatePasswordStrengthIndicator(strength);
	  });

	  // Validate password on form submit
	  $('#register-form').submit(function(e) {
	    var password = $('#password').val();
	    var confirm_password = $('#confirm_password').val();

	    if (password.length < 8) {
	      $('#passwordAlert').text('Password must be at least 8 characters long.').removeClass('d-none');
	      return false;
	    }

	    if (password !== confirm_password) {
	      $('#passwordAlert').text('Passwords do not match.').removeClass('d-none');
	      return false;
	    }

	    var strength = getPasswordStrength(password);
	    if (strength < 2) {
	      $('#passwordAlert').text('Password is too weak. Please choose a stronger password.').removeClass('d-none');
	      return false;
	    }

	    return true;
	  });


       // Check if email is already registered on form submit
         $('#register-form').submit(function(e) {
          var email = $('#email').val();
        $.ajax({
         url: 'check_email.php',
         type: 'post',
         data: {email: email},
         success: function(response) {
      if (response == 'registered') {
        $('#emailAlert').text('Email address already registered!').removeClass('d-none');
        e.preventDefault(); // Prevent form submission if email already registered
      } else {
        $('#emailAlert').addClass('d-none');
      }
    }
  });
});
	

	  // Calculate password strength
	  function getPasswordStrength(password) {
	    var strength = 0;
	    if (password.length >= 8) {
	      strength++;
	    }
	    if (password.match(/[a-z]/) && password.match(/[A-Z]/)) {
	      strength++;
	    }
	    if (password.match(/[0-9]/)) {
	      strength++;
	    }
	    if (password.match(/[^a-zA-Z0-9]/)) {
	      strength++;
	    }
	    return strength;
	  }

	  // Show/hide password
	  $('#show_password').on('click', function() {
	    var passwordField = $('#password');
	    var fieldType = passwordField.attr('type');

	    if (fieldType == 'password') {
	      passwordField.attr('type', 'text');
	      $(this).text('Hide');
	    } else {
	      passwordField.attr('type', 'password');
	      $(this).text('Show');
	    }
	  });

	  // Show/hide confirm password
	  $('#show_confirm_password').on('click', function() {
	    var confirmPasswordField = $('#confirm_password');
	    var fieldType = confirmPasswordField.attr('type');

	    if (fieldType == 'password') {
	      confirmPasswordField.attr('type', 'text');
	      $(this).text('Hide');
	    } else {
	      confirmPasswordField.attr('type', 'password');
	      $(this).text('Show');
	    }
	  });
	});

</script>
