<?php $this->load->view('header');?>
<body style="background: #eee;">
	<div class="container mt-4">

		<h1>Welcome To Dashboard</h1>
		<p class="lead">This is basic registration data manage system!</p>
		<hr/>

		<div class="card">
			<div class="card-body">
				<h5 class="card-title">
					<strong>Registration List Search Wizard</strong>
					<a href="<?=site_url('logout');?>" style="float: right;">Logout</a>
				</h5>
				<hr/>

				<div class="row">
					<div class="col-md-6 mb-4 d-flex align-items-center">

						<div class="form-outline w-100">
							<label for="full_name" class="form-label">Search Name</label>
							<input
								type="text"
								class="form-control form-control-lg"
								id="full_name"
								name="full_name"
								required
							/>
						</div>

					</div>
					<div class="col-md-6 mb-4 d-flex align-items-center">

						<div class="form-outline w-100">
							<label for="email_address" class="form-label">Search Email Address</label>
							<input
								type="email"
								class="form-control form-control-lg"
								id="email_address"
								name="email_address"
								required
							/>
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

				<button type="button" class="btn btn-primary" id="search-btn" data-style="expand-right" onclick="javascript:getRegData();">
					<span class="ladda-label">Search</span>
				</button>

			</div>
		</div>

		<div class="card mt-4">
			<div class="card-body">
				<h5 class="card-title">
					<strong>Registration List</strong>
				</h5>
				<hr/>

				<table class="table table-sm table-striped table-bordered" id="res-data">
					<thead>
						<tr class="bg-info">
							<th>Applicant's Name</th>
							<th>Email Address</th>
							<th>Division</th>
							<th>District</th>
							<th>Upazila/Thana</th>
							<th>Insert Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>

				<div class="mt-4">
					<nav>
						<ul class="pagination" id="pagination"></ul>
					</nav>
					<div style="float: right;">
						Total Rows: <strong id="total_rows">0</strong>
					</div>
				</div>

			</div>
		</div>

	</div>

	<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Registration Data</h5>
					<button type="button" class="close moodle-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="edit_form">
					<input name="id" id="update_id" type="hidden" />
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6 mb-4">

								<div class="form-outline">
									<label class="form-label" for="applicant_name">Applicant's Name</label>
									<input type="text" id="applicant_name_edit" name="applicant_name" class="form-control form-control-lg" required minlength="3" />
								</div>

							</div>
							<div class="col-md-6 mb-4 d-flex align-items-center">

								<div class="form-outline w-100">
									<label for="email_address" class="form-label">Email Address</label>
									<input
										type="email"
										class="form-control form-control-lg"
										id="email_address_edit"
										name="email_address"
										required
									/>
								</div>

							</div>
						</div>
						<div class="row">
							<div class="col-md-4 mb-3 pb-2">
								<label for="division_edit">Select Division</label>
								<select class="select1" name="division_edit" id="division_edit" data-placeholder="Division" required onchange="javascript:getDistrictList(this,'district_edit');">
									<option value=""></option>
									<?php foreach($divisions as $division):?>
										<option value="<?=$division['id'];?>"><?=$division['name'];?></option>
									<?php endforeach;?>
								</select>

							</div>
							<div class="col-md-4 mb-3 pb-2">
								<label for="district_edit">Select District</label>
								<select class="select1" name="district_edit" id="district_edit" data-placeholder="District" required onchange="javascript:getUpazilaList(this,'upazila_edit');">
									<option value=""></option>
								</select>

							</div>
							<div class="col-md-4 mb-3 pb-2">
								<label for="upazila_edit">Select Upazila</label>
								<select class="select1" name="upazila_edit" id="upazila_edit" data-placeholder="Upazila" required>
									<option value=""></option>
								</select>

							</div>
						</div>
						<div class="row">
								<div class="col-md-12 mb-4 d-flex align-items-center">
									<div class="form-outline w-100">
										<label class="form-label" for="full_address">Full Address</label>
										<textarea class="form-control" id="full_address_edit" name="full_address" rows="2" required minlength="6"></textarea>
									</div>

								</div>
							</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" id="edit-btn" data-style="expand-right">
							<span class="ladda-label">Save changes</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var table_td = null;
		var row_start = 0;
		var row_limit = 5;
		$(function () {
			$(".select2").select2({
				placeholder: $(".select2").data('placeholder'),
				width: "100%",
				allowClear: true,
			});
			$('.moodle-close').click(function () {
				$('#edit-modal').modal('hide');
				table_td = null;
			});

			$("#edit_form").validate({
				submitHandler: function (form) {
					var l = Ladda.create(document.querySelector('#edit-btn'));
					l.start();
					let form_data = new FormData(form);
					$.ajax({
						cache: false,
						contentType: false,
						processData: false,
						data: form_data,
						type: 'POST',
						url: '<?=site_url("update_user_data");?>',
						success: (res) => {
							if (res) {
								Swal.fire(
									'Success',
									'Information Successfully Updated',
									'success'
								).then(() => {
									$('#edit-modal').modal('hide');
									let row_data = $(table_td).data('val');
									let row = $(table_td).parents('tr').find('td');
									row_data.name = $('#applicant_name_edit').val().trim();
									row_data.email = $('#email_address_edit').val().trim();
									row_data.address = $('#full_address_edit').val().trim();
									row_data.division_id = $('#division_edit').val();
									row_data.division_name = $("#division_edit option:selected").text();
									row_data.district_id = $('#district_edit').val();
									row_data.district_name = $('#district_edit option:selected').text();
									row_data.upazila_id = $('#upazila_edit').val();
									row_data.upazila_name = $('#upazila_edit option:selected').text();
									$(row[0]).text(row_data.name);
									$(row[1]).text(row_data.email);
									$(row[2]).text(row_data.division_name);
									$(row[3]).text(row_data.district_name);
									$(row[4]).text(row_data.upazila_name);
									$(row[5]).text(new Date().toDateString());
									$(table_td).data('val',row_data);
								})
							} else {
								Swal.fire(
									'warning',
									'NOT UPDATED!',
									'warning'
								);
							}
							setTimeout(() => l.stop(),500);
						},
						error: (err) => {
							Swal.fire(
								'Error!!',
								err.statusText,
								'error'
							);
							setTimeout(() => l.stop(),500);
						}
					});
				}
			});
		});

		function getRegData (start=null,limit=null) {
			table_td = null;
			if (start == null) {
				var l = Ladda.create(document.querySelector('#search-btn'));
				l.start();
			}
			const name = $('#full_name').val();
			const email = $('#email_address').val();
			const division = $('#division').val();
			const district = $('#district').val();
			const upazila = $('#upazila').val();

			$.ajax({
				url: '<?=site_url("get_reg_list");?>',
				data: {
					name: name,
					email: email,
					division: division,
					district: district,
					upazila: upazila,
					start: (start) ? start : row_start,
					limit: (limit) ? limit : row_limit,
				},
				method: 'GET',
				success: (res) => {
					try {
						const out = JSON.parse(res);
						$('#res-data tbody').empty();
						out.data.forEach(tr => {
							setTrData(tr);
						});
						if (start == null) {
							setTimeout(() => l.stop(),500)
							custom_pagination(out.total);
						}
					}catch (e) {
						Swal.fire(
							'Warning',
							e.message,
							'warning'
						);
						if (start == null) {
							setTimeout(() => l.stop(),500)
						}
					}
				},
				error: (err) => {
					Swal.fire(
						'Error!!',
						err.statusText,
						'error'
					);
					setTimeout(() => l.stop(),500);
				}
			});


		}

		function setTrData (data) {
			let json_string_format = JSON.stringify(data);
			let tr = '<tr>';
			tr += '<td>'+data.name+'</td>';
			tr += '<td>'+data.email+'</td>';
			tr += '<td>'+data.division_name+'</td>';
			tr += '<td>'+data.district_name+'</td>';
			tr += '<td>'+data.upazila_name+'</td>';
			tr += '<td>'+new Date(data.created_at).toDateString()+'</td>';
			tr += '<td><button class="btn btn-info btn-sm" onclick="javascript:editRow('+data.id+',this)" data-val=\''+json_string_format+'\'>Edit</button></td>';
			tr += '</tr>';
			$('#res-data tbody').append(tr);
		}

		function getUpazilaList (tag,id='upazila') {
			const val = $(tag).val().trim();
			if (val) {
				$.ajax({
					url: '<?=site_url("get_upazila_by_id");?>/' + val,
					method: 'GET',
					success: (res) => {
						if (res) {
							let options = JSON.parse(res);
							$('#'+id).empty();
							$('#'+id).append('<option></option>');
							options.forEach(option => {
								$('#'+id).append(new Option(option.name, option.id, true, true))
							});
							$('#'+id).val('');
							$('#'+id).trigger('change');
						}
					}
				});
			}
		}

		function getDistrictList (tag,id='district') {
			const val = $(tag).val().trim();
			if (val) {
				$.ajax({
					url: '<?=site_url("get_district_by_id");?>/' + val,
					method: 'GET',
					success: (res) => {
						if (res) {
							let options = JSON.parse(res);
							$('#upazila').empty();

							$('#'+id).empty();
							$('#'+id).append('<option></option>');
							options.forEach(option => {
								$('#'+id).append(new Option(option.name, option.id, true, true))
							});
							$('#'+id).val('');
							$('#'+id).trigger('change');
						}
					}
				});
			}
		}

		function editRow (id, tag) {
			table_td = tag;
			const data = $(tag).data('val');
			$('#applicant_name_edit').val(data.name);
			$('#email_address_edit').val(data.email);
			$('#full_address_edit').val(data.address);
			$('#update_id').val(data.id);

			$('#division_edit').append('<option selected value="'+data.division_id+'">'+data.division_name+'</option>');
			$('#district_edit').append('<option selected value="'+data.district_id+'">'+data.district_name+'</option>');
			$('#upazila_edit').append('<option selected value="'+data.upazila_id+'">'+data.upazila_name+'</option>');

			$('#edit-modal').modal('show');
		}

		function custom_pagination (total) {
			const rows = parseInt(total/row_limit);
			let li_list = '<li class="page-item disabled"><a class="page-link">Previous</a></li>';
			for (let i = 0; i <= rows; i++) {
				li_list += '<li class="page-item" onclick="javascript:getRegData('+ i +','+ (i+rows) +')"><a class="page-link" href="#">'+(i+1)+'</a></li>';
			}
			li_list += '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
			$('#pagination').empty();
			$('#pagination').append(li_list);
			$('#total_rows').text(total);
		}
	</script>


</body>

</html>
