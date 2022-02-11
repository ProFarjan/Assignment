<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registration Form</title>

	<!-- Font Awesome -->
	<link
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
		rel="stylesheet"
	/>
	<!-- Google Fonts -->
	<link
		href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
		rel="stylesheet"
	/>
	<!-- MDB -->
	<link
		href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css"
		rel="stylesheet"
	/>
	<!-- STYLE CSS -->
	<link
		href="<?=site_url('assets/css/style.css');?>"
		rel="stylesheet"
	/>
	<!-- SELECT2 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

	<!-- JQuery -->
	<script
		src="https://code.jquery.com/jquery-3.6.0.min.js"
	></script>

	<!-- MDB -->
	<script
		type="text/javascript"
		src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"
	></script>

	<!-- SELECT2 JS -->
	<script
		src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"
	></script>

	<!-- JQUERY VALIDATION -->
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"
	></script>
</head>

<body>
	<section class="vh-100" style="background-color: #508bfc;">
		<div class="container py-5 h-100">
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="col-12 col-md-8 col-lg-6 col-xl-5">
					<div class="card shadow-2-strong" style="border-radius: 1rem;">
						<div class="card-body p-5 text-center">

							<h3 class="mb-5">Sign in</h3>
							<form action="<?=site_url('login');?>" method="post">
								<?php echo form_error('form_invalid'); ?>
								<div class="form-outline mb-4">
									<?php echo form_error('email'); ?>
									<input type="email" id="typeEmailX-2" name="email" class="form-control form-control-lg" />
									<label class="form-label" for="typeEmailX-2">Email</label>
								</div>

								<div class="form-outline mb-4">
									<?php echo form_error('password'); ?>
									<input type="password" id="typePasswordX-2" name="password" class="form-control form-control-lg" />
									<label class="form-label" for="typePasswordX-2">Password</label>
								</div>

								<!-- Checkbox -->
								<div class="form-check d-flex justify-content-start mb-4">
									<input
										class="form-check-input"
										type="checkbox"
										value=""
										id="form1Example3"
									/>
									<label class="form-check-label" for="form1Example3"> Remember password </label>
								</div>

								<button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</body>

</html>
