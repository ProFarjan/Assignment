<?php

class Registration extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index () {

		$this->db->from('db_division');
		$divisions = $this->db->get()->result_array();

		$this->load->view('registration', ['divisions' => $divisions]);

	}

	public function getDistrictById () {
		$id = $this->uri->segment(2);
		if (!empty($id)) {
			$this->db->from('db_district');
			$this->db->where('division_id', $id);
			$districts = $this->db->get()->result_array();
			if (is_array($districts) && count($districts) > 0) {
				echo json_encode($districts);
			}
		}
	}

	public function getUpazilaById () {
		$id = $this->uri->segment(2);
		if (!empty($id)) {
			$this->db->from('db_upazila');
			$this->db->where('district_id', $id);
			$districts = $this->db->get()->result_array();
			if (is_array($districts) && count($districts) > 0) {
				echo json_encode($districts);
			}
		}
	}

	public function getBoardList () {
		$this->db->from('db_board');
		$board_list = $this->db->get()->result_array();
		if (is_array($board_list) && count($board_list) > 0) {
			echo json_encode($board_list);
		}
	}

	public function getExamNameList () {
		$this->db->from('db_exam_name');
		$exam_list = $this->db->get()->result_array();
		if (is_array($exam_list) && count($exam_list) > 0) {
			echo json_encode($exam_list);
		}
	}

	public function getInstituteList () {
		$this->db->from('db_university');
		$ins_list = $this->db->get()->result_array();
		if (is_array($ins_list) && count($ins_list) > 0) {
			echo json_encode($ins_list);
		}
	}

	public function save () {

		$applicant_name = $this->input->post('applicant_name');
		$email_address = $this->input->post('email_address');
		$mailing_address = $this->input->post('mailing_address');
		$division = $this->input->post('division');
		$district = $this->input->post('district');
		$upazila = $this->input->post('upazila');
		$full_address = $this->input->post('full_address');
		$language = $this->input->post('language');

		$this->db->insert("db_registration", [
			"name" => $applicant_name,
			"email" => $email_address,
			"mailing_address" => $mailing_address,
			"division_id" => $division,
			"district_id" => $district,
			"upazila_id" => $upazila,
			"address" => $full_address,
			"language" => $language,
		]);
		$reg_id = $this->db->insert_id();
		if (!empty($reg_id)) {

			$exam = $this->input->post('exam');
			$university = $this->input->post('university');
			$board = $this->input->post('board');
			$result = $this->input->post('result');
			$edu = [];
			if (count($exam) > 0) {
				foreach ($exam as $k => $val) {
					$education = [
						'reg_id' => $reg_id,
						'exam_id' => $val,
						'university_id' => $university[$k],
						'board_id' => $board[$k],
						'result' => $result[$k]
					];
					$edu[] = $education;
				}
				$this->db->insert_batch("reg_education",$edu);
			}

			$training = $this->input->post('training');
			$training_data = [];
			if (!empty($training)) {
				$training_name = $this->input->post('training_name');
				$training_details = $this->input->post('training_details');
				$training_institute = $this->input->post('training_institute');
				if (count($training_name) > 0) {
					foreach ($training_name as $k => $val) {
						$training_arr = [
							'reg_id' => $reg_id,
							'name' => $val,
							'details' => $training_details[$k],
							'institute' => $training_institute[$k],
						];
						$training_data[] = $training_arr;
					}
					$this->db->insert_batch("reg_training",$training_data);
				}
			}

		}

	}

	function update () {
		if ($this->session->has_userdata('is_login')) {
			$this->form_validation->set_rules('applicant_name', 'Applicant Name', 'required');
			$this->form_validation->set_rules('email_address', 'Email', 'required');
			$this->form_validation->set_rules('division_edit', 'Division', 'required');
			$this->form_validation->set_rules('district_edit', 'District', 'required');
			$this->form_validation->set_rules('upazila_edit', 'Upazila', 'required');
			$this->form_validation->set_rules('full_address', 'address', 'required');
			$this->form_validation->set_rules('id', 'ID', 'required');

			$name = $this->input->post('applicant_name');
			$email = $this->input->post('email_address');
			$division = $this->input->post('division_edit');
			$district = $this->input->post('district_edit');
			$upazila = $this->input->post('upazila_edit');
			$address = $this->input->post('full_address');
			$id = $this->input->post('id');

			if ($this->form_validation->run() == false){
				$this->form_validation->set_message('form_invalid','Form All Fields Must Be Required!!');
				echo false;
			}else{
				$this->db->where('id',$id);
				$this->db->update('db_registration', [
					'name' => $name,
					'email' => $email,
					'division_id' => $division,
					'district_id' => $district,
					'upazila_id' => $upazila,
					'address' => $address,
					'updated_at' => date('Y-m-d H:i:s')
				]);
				echo true;
			}
		}
	}

}
