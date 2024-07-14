<?php require_once 'app/views/templates/header.php'?>

<main role="main" class="container-fluid">
	<div class="row">
				<div class="col-md-7 justify-content-center align-items-center">
    
        <div class="text-center mt-5">
                <h1>You are not logged in</h1>
				</div>
   

	<section class="vh-50 mt-5">
		<div class="container py-2 h-100" >
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="col-lg-6">
					<div style="border-radius: 1rem; background-color: #6c757d;">
						<div class="card-body p-5 text-center">
							<?php if (isset($_SESSION['failedAuth']) && $_SESSION['failedAuth'] >= 3): ?>
									<div class="alert alert-danger" role="alert">
											<?php echo "Exceeded failed login attempts, please wait 60 seconds"; ?>
									</div>
							<?php endif ?>
							<?php if (isset($_SESSION['failedAuth']) && $_SESSION['failedAuth'] < 3): ?>
									<div class="alert alert-danger" role="alert">
											<?php echo "Incorrect username or password, please try again"; ?>
									</div>
							<?php endif ?>
							<h1 class="mb-4" style="color: white">Sign in</h1>
							<form action="/login/verify" method="post" >
							<fieldset>
							
								<div class="form-floating mb-3">
									<input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username">
									<label for="floatingInput">Username</label>
								</div>
								<div class="form-floating">
									<input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
									<label for="floatingPassword">Password</label>
								</div>
								<div class="d-flex justify-content-between align-items-center mb-4">
									
								</div>
							<button type="submit" class="btn btn-primary btn-lg" >Login</button>
								<hr class="my-3">
								
								<p><a href="/create" class="text-white">Register Here</a></p>
							</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
			</div>
		<div class="col-sm-5 px-0">
				<img src="https://images.unsplash.com/photo-1692986527123-0934f9cf9e81?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mjd8fGNpbmVtYXxlbnwwfHwwfHx8MA%3D%3D" class="w-100 vh-100" style="object-fit: cover; object-position: center;">
		</div>
		
	</div>
	
    <?php require_once 'app/views/templates/footer.php' ?>
