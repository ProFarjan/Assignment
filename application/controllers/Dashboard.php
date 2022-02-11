<?php

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->has_userdata('is_login')) {
			redirect('login');
		}
	}

	public function index () {

		$this->db->from('db_division');
		$divisions = $this->db->get()->result_array();

		$this->load->view('dashboard',['divisions' => $divisions]);
	}

	public function getRegistrationData () {
		$this->db->select('r.*, div.name as division_name, dis.name as district_name, upa.name as upazila_name');
		$this->db->from('db_registration as r');

		$this->db->join('db_division as div', 'div.id = r.division_id');
		$this->db->join('db_district as dis', 'dis.id = r.district_id');
		$this->db->join('db_upazila as upa', 'upa.id = r.upazila_id');

		$name = $this->input->get('name');
		if (!empty($name)) {
			$this->db->like('r.name', $name);
		}
		$email = $this->input->get('email');
		if (!empty($email)) {
			$this->db->where('r.email', $email);
		}
		$division = $this->input->get('division');
		if (!empty($division)) {
			$this->db->where('r.division_id', $division);
		}
		$district = $this->input->get('district');
		if (!empty($district)) {
			$this->db->where('r.district_id', $district);
		}
		$upazila = $this->input->get('upazila');
		if (!empty($upazila)) {
			$this->db->where('r.upazila_id', $upazila);
		}
		$start = $this->input->get('start');
		$limit = $this->input->get('limit');
		$this->db->limit($limit, $start);

		$res = $this->db->get()->result_array();
		$total = $this->db->count_all('db_registration');

		echo json_encode([
			'total' => $total,
			'search_total' => count($res),
			'data' => $res,
		]);
	}

	public function logout () {
		session_decode();
		session_unset();
		redirect('');
	}


}
