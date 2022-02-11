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
	<!-- SELECT2 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

	<!-- STYLE CSS -->
	<link
			href="<?=site_url('assets/css/style.css');?>"
			rel="stylesheet"
	/>

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
	<section class="gradient-custom">
		<div class="container py-5 h-100">
			<div class="row justify-content-center align-items-center h-100">
				<div class="col-12 col-lg-9 col-xl-7">
					<div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
						<div class="card-body p-4 p-md-5">
							<h3 class="mb-4 pb-2 pb-md-0 mb-md-5" style="text-align: center;">Registration Form</h3>
							<form class="needs-validation" id="registration-form" novalidate>

								<div class="row">
									<h5>Basic Information</h5>
									<hr/>
									<div class="col-md-12 mb-4">

										<div class="form-outline">
											<input type="text" id="applicant_name" name="applicant_name" class="form-control form-control-lg" required minlength="3" />
											<label class="form-label" for="applicant_name">Applicant's Name</label>
										</div>

									</div>
								</div>

								<div class="row">
									<div class="col-md-6 mb-4 d-flex align-items-center">

										<div class="form-outline w-100">
											<input
												type="email"
												class="form-control form-control-lg"
												id="email_address"
												name="email_address"
												required
											/>
											<label for="email_address" class="form-label">Email Address</label>
										</div>

									</div>
									<div class="col-md-6 mb-4 d-flex align-items-center">

										<div class="form-outline w-100">
											<input
												type="email"
												class="form-control form-control-lg"
												id="mailing_address"
												name="mailing_address"
												required
											/>
											<label for="mailing_address" class="form-label">Mailing Address</label>
										</div>

									</div>
								</div>

								<div class="row">
									<div class="col-md-4 mb-3 pb-2">

										<select class="select2" name="division" id="division" data-placeholder="Division" required onchange="javascript:getDistrictList(this);">
											<option value=""></option>
											<?php foreach($divisions as $division):?>
											<option value="<?=$division['id'];?>"><?=$division['name'];?></option>
											<?php endforeach;?>
										</select>

									</div>
									<div class="col-md-4 mb-3 pb-2">

										<select class="select2" name="district" id="district" data-placeholder="District" required onchange="javascript:getUpazilaList(this);">
											<option value=""></option>
										</select>

									</div>
									<div class="col-md-4 mb-3 pb-2">

										<select class="select2" name="upazila" id="upazila" data-placeholder="Upazila" required>
											<option value=""></option>
										</select>

									</div>
								</div>

								<div class="row">
									<div class="col-md-12 mb-4 d-flex align-items-center">
										<div class="form-outline w-100">
											<textarea class="form-control" id="full_address" name="full_address" rows="2" required minlength="6"></textarea>
											<label class="form-label" for="full_address">Full Address</label>
										</div>

									</div>
								</div>

								<div class="row">
									<p class="m-0 mb-2"><strong>Language Proficiency</strong></p>
									<div class="col-md-6 mb-4 d-flex align-items-center">

										<div class="form-check form-check-inline">
											<input
												class="form-check-input"
												type="radio"
												name="language"
												id="english"
												value="English"
											/>
											<label class="form-check-label" for="english">English</label>
										</div>

										<div class="form-check form-check-inline">
											<input
												class="form-check-input"
												type="radio"
												name="language"
												id="bangla"
												value="Bangla"
											=											/>
											<label class="form-check-label" for="bangla">Bangla</label>
										</div>

										<div class="form-check form-check-inline">
											<input
												class="form-check-input"
												type="radio"
												name="language"
												id="french"
												value="French"
											/>
											<label class="form-check-label" for="french">French</label>
										</div>

									</div>
								</div>

								<div class="row">
									<h5>Education Qualification</h5>
									<hr/>
									<div class="table-responsive">
										<table class="my-table" id="eduTable">
											<thead>
												<tr>
													<th>Exam Name</th>
													<th>University</th>
													<th>Board</th>
													<th width="15%">Result</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<select class="select2 edu_exam" name="exam[]" data-placeholder="Examination">
															<option value=""></option>
														</select>
													</td>
													<td>
														<select class="select2 edu_uni" name="university[]" data-placeholder="University">
															<option value=""></option>
															<option value="WY">Wyoming</option>
														</select>
													</td>
													<td>
														<select class="select2 edu_board" name="board[]" data-placeholder="Board">
															<option value=""></option>
														</select>
													</td>
													<td>
														<input
															type="text"
															name="result[]"
															class="form-control form-control-lg"
															style="line-height: 1.82;"
														/>
													</td>
													<td style="text-align: center;">
														<span class="badge bg-primary" style="cursor: pointer;" onclick="javascript:addNewEducation()">Add</span>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>

								<div class="row mt-4">
									<h5>Other's Information</h5>
									<hr/>
									<div class="col-md-6 mb-3 pb-2">

										<label for="formFileSm" class="form-label">
											<strong>Photo</strong>
										</label>
										<input class="form-control form-control-sm" id="photo" name="photo" type="file" />

									</div>
									<div class="col-md-6 mb-3 pb-2">

										<label for="formFileSm" class="form-label">
											<strong>CV Attachment</strong>
										</label>
										<input class="form-control form-control-sm" id="cv" name="cv" type="file" />

									</div>
								</div>

								<div class="row">
									<p class="m-0 mb-2">
										<strong>If you have any professional training</strong>
									</p>
									<div class="col-md-12 mb-4 d-flex align-items-center">
										<div class="form-check form-check-inline">
											<input
												class="form-check-input"
												type="radio"
												name="training"
												id="training_yes"
												value="Yes"
											/>
											<label class="form-check-label" for="training_yes">Yes</label>
										</div>

										<div class="form-check form-check-inline">
											<input
												class="form-check-input"
												type="radio"
												name="training"
												id="training_no"
												value="No"
											/>
											<label class="form-check-label" for="training_no">No</label>
										</div>

									</div>
								</div>

								<div class="row" id="trainingDev" style="display: none;">
									<table class="my-table" id="trainingTbl">
										<thead>
											<tr>
												<th>Training Name</th>
												<th>Training Details</th>
												<th>Institute Name</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
													<input
														type="text"
														name="training_name[]"
														class="form-control form-control-lg"
													/>
												</td>
												<td>
													<input
														type="text"
														name="training_details[]"
														class="form-control form-control-lg"
													/>
												</td>
												<td>
													<input
														type="text"
														name="training_institute[]"
														class="form-control form-control-lg"
													/>
												</td>
												<td style="text-align: center;">
													<span class="badge bg-info" style="cursor: pointer;" onclick="javascript:addNewTraining();">Add</span>
												</td>
											</tr>
										</tbody>
									</table>
								</div>

								<div class="mt-4 pt-2">
									<button class="btn btn-primary btn-lg ladda-button" id="submit-btn" data-style="expand-left" type="submit">
										<span class="ladda-label">Submit</span>
									</button>
								</div>

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script>

		var board_list = exam_list = ins_list = [];
		$(function () {

			commonData('get_board_list', '.edu_board');
			commonData('get_exam_list', '.edu_exam');
			commonData('get_institute_list', '.edu_uni');

			$( "input ,textarea" ).focusin(function() {
				$( this ).next( "label" ).css({
					"background": "#fff",
					"padding-left": "8px",
					"padding-right": "8px",
				});
			});
			$(".select2").select2({
				placeholder: $(".select2").data('placeholder'),
				width: "100%",
				allowClear: true,
			});

			$('input[type=radio][name=training]').change(function() {
				if (this.value == 'Yes') {
					$("#trainingDev").slideDown();
				}else if (this.value == 'No') {
					$("#trainingDev").slideUp();
				}
			});

			//$('#registration-form').submit(function (e) {
				$("#registration-form").validate({
					submitHandler: function (form) {

						e.preventDefault();

						let form_data = new FormData(this);
						$.ajax({
							cache: false,
							contentType: false,
							processData: false,
							data: form_data,
							type: 'POST',
							url: '<?=site_url("save_data");?>',
							success: (res) => {
								if (res) {
									console.log(res);
								}
							},
							error: (err) => {
								alert(err.message);
							}
						});

					}
			});

		});

		function addNewEducation () {
			const random_num = Math.floor(Math.random() * 500);
			const row = '<tr>'+
				'	<td>'+
				'		<select class="select2" id="edu_exam'+random_num+'" name="exam[]" data-placeholder="Examination">'+
				'			<option value=""></option>'+
				'		</select>'+
				'	</td>'+
				'	<td>'+
				'		<select class="select2" id="edu_uni'+random_num+'" name="university[]" data-placeholder="University">'+
				'			<option value=""></option>'+
				'		</select>'+
				'	</td>'+
				'	<td>'+
				'		<select class="select2" id="edu_board'+random_num+'" name="board[]" data-placeholder="Board">'+
				'			<option value=""></option>'+
				'		</select>'+
				'	</td>'+
				'	<td>'+
				'		<input'+
				'			type="text"'+
				'			name="result[]"'+
				'			class="form-control form-control-lg"'+
				'			style="line-height: 1.82;"'+
				'		/>'+
				'	</td>'+
				'	<td style="text-align: center;">'+
				'		<span class="badge bg-danger" style="cursor: pointer;" onclick="javascript:delEduRow(this);">Del</span>'+
				'	</td>'+
				'</tr>';
				$('#eduTable tbody').append(row);

				$(".select2").select2({
					placeholder: $(".select2").data('placeholder'),
					width: "100%",
					allowClear: true,
				});

				setOptionValue(board_list, '#edu_board'+random_num);
				setOptionValue(exam_list, '#edu_exam'+random_num);
				setOptionValue(ins_list, '#edu_uni'+random_num);
		}

		function addNewTraining () {
			const row = '<tr>'+
				'	<td>'+
				'		<input'+
				'			type="text"'+
				'			name="training_name[]"'+
				'			class="form-control form-control-lg"'+
				'		/>'+
				'	</td>'+
				'	<td>'+
				'		<input'+
				'			type="text"'+
				'			name="training_details[]"'+
				'			class="form-control form-control-lg"'+
				'		/>'+
				'	</td>'+
				'	<td>'+
				'		<input'+
				'			type="text"'+
				'			name="training_institute[]"'+
				'			class="form-control form-control-lg"'+
				'		/>'+
				'	</td>'+
				'	<td style="text-align: center;">'+
				'		<span class="badge bg-danger" style="cursor: pointer;" onclick="javascript:delEduRow(this);">Del</span>'+
				'</tr>';
				$('#trainingTbl tbody').append(row);
		}

		function getUpazilaList (tag) {
			const val = $(tag).val().trim();
			if (val) {
				$.ajax({
					url: '<?=site_url("get_upazila_by_id");?>/' + val,
					method: 'GET',
					success: (res) => {
						if (res) {
							let options = JSON.parse(res);
							$('#upazila').empty();
							$('#upazila').append('<option></option>');
							options.forEach(option => {
								$('#upazila').append(new Option(option.name, option.id, true, true))
							});
							$('#upazila').val('');
							$('#upazila').trigger('change');
						}
					}
				});
			}
		}

		function getDistrictList (tag) {
			const val = $(tag).val().trim();
			if (val) {
				$.ajax({
					url: '<?=site_url("get_district_by_id");?>/' + val,
					method: 'GET',
					success: (res) => {
						if (res) {
							let options = JSON.parse(res);
							$('#upazila').empty();

							$('#district').empty();
							$('#district').append('<option></option>');
							options.forEach(option => {
								$('#district').append(new Option(option.name, option.id, true, true))
							});
							$('#district').val('');
							$('#district').trigger('change');
						}
					}
				});
			}
		}

		function delEduRow(tag) {
			$(tag).parents('tr').remove();
		}

		function commonData (uri, select_tag) {
			$.ajax({
				url: '<?=base_url();?>' + uri,
				method: 'GET',
				success: (res) => {
					if (res) {
						let options = JSON.parse(res);
						$(select_tag).empty();
						$(select_tag).append('<option></option>');
						options.forEach(option => {
							$(select_tag).append(new Option(option.name, option.id, true, true))
						});
						$(select_tag).val('');
						$(select_tag).trigger('change');

						switch (select_tag) {
							case '.edu_board':
								board_list = options;
								break;
							case '.edu_exam':
								exam_list = options;
								break;
							case '.edu_uni':
								ins_list = options;
								break;
							default:

						}

					}
				}
			});
		}

		function setOptionValue (data, tag) {
			$(tag).empty();
			$(tag).append('<option></option>');
			data.forEach(option => {
				$(tag).append(new Option(option.name, option.id, true, true));
			});
			$(tag).val('');
			$(tag).trigger('change');
		}

	</script>

</body>
</html>
