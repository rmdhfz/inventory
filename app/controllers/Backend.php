<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->init();
	}
	private function init() {
		$this->load->library('session');
		if (!$this->session->userdata('is_login') ){
			redirect(site_url(), 'refresh');
		}
	}
	private function load($params)
	{
		if (!$params) {
			return false;
		}
		$this->load->view('backend/index', $params);
	}
	public function index() {
		$this->load([
			'file'	=> 'module/dashboard/index',
		]);
	}
	public function logout() {
		$confirm = $this->input->get('confirm', true);
		if (!$confirm) {
			redirect(site_url('dashboard'));
		}
		$this->session->sess_destroy();
		redirect(site_url());
	}
	# employee
	public function employee(){
		$this->load([
			'file'	=>	'module/employee/index'
		]);
	}
	public function employeeData(){
		$this->load->database();
		json(response(true, 200, 'success', $this->db->query("SELECT id, name, email, phone FROM employees")->result()));
	}
	public function listEmployee(){
		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			http_response_code(401);
			return false;
		}
		$this->load->model('model');
		$this->model->listEmployee();
	}
	public function saveEmployee(){
		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			http_response_code(401);
			return false;
		}
		$this->load->database();
		$email    	= post('email');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            json($this->response(false, 400, 'email not valid'));
        }
        $check = $this->db->query("SELECT email FROM employees WHERE email = ? LIMIT 1", [$email]);
        if ($check->num_rows() > 0) {
        	json(response(true, 200, 'user already exist'));
        }
        $phone = post('phone');
		$data = [
			'name'		=>	post('name'),
			'email'		=>	$email,
			'phone'		=>	$phone,
		];
		$save = $this->db->insert('employees', $data);
		if (!$save) {
			json(response(false, 500, 'failed save data'));
		}
		json(response(true, 201, 'success, created'));
	}
	public function findEmployee(){
		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			http_response_code(401);
			return false;
		}
		$id = post('id');
		if (!$id) {
			http_response_code(400);
			return false;
		}
		$this->load->database();
		$check = $this->db->query("SELECT * FROM employees WHERE id = ? LIMIT 1", [$id]);
		if ($check->num_rows() == 0) {
			http_response_code(404);
			return false;
		}
		json(response(true, 200, 'success', $check->row()));
	}
	public function editEmployee(){
		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			http_response_code(401);
			return false;
		}
		$id = post('id');
		if (!$id) {
			http_response_code(400);
			return false;
		}
		$this->load->database();
		$get = $this->db->query("SELECT * FROM employees WHERE id = ? LIMIT 1", [$id]);
		if ($get->num_rows() == 0) {
			http_response_code(404);
			return false;
		}
		$email    = post('email');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            json($this->response(false, 400, 'email not valid'));
        }
        $phone = post('phone');
		$data = [
			'name'		=>	post('name'),
			'email'		=>	$email,
			'phone'		=>	$phone,
		];
		$edit = $this->db->where('id', $id, TRUE)->update('employees', $data);
		if (!$edit) {
			json(response(false, 500, 'failed edit'));
		}
		json(response(true, 201, 'success, updated'));
	}
	public function deleteEmployee(){
		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			http_response_code(401);
			return false;
		}
		$id = post('id');
		if (!$id) {
			http_response_code(400);
			return false;
		}
		$this->load->database();
		$delete = $this->db->delete('employees', ['id' => $id]);
		if (!$delete) {
			json(response(false, 500, 'failed delete'));
		}
		json(response(true, 200, 'success delete'));
	}
	# employee
	# role
	public function role(){
		$this->load([
			'file'	=>	'module/role/index'
		]);
	}
	public function roleData(){
		$this->load->database();
		json(response(true, 200, 'success', $this->db->query("SELECT id, name FROM roles")->result()));
	}
	public function listRole(){
		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			http_response_code(401);
			return false;
		}
		$this->load->model('model');
		$this->model->listRole();
	}
	public function saveRole(){
		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			http_response_code(401);
			return false;
		}
		$this->load->database();
		$data = [
			'name'		=>	post('name'),
		];
		$save = $this->db->insert('roles', $data);
		if (!$save) {
			json(response(false, 500, 'failed save data'));
		}
		json(response(true, 201, 'success, created'));
	}
	public function findRole(){
		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			http_response_code(401);
			return false;
		}
		$id = post('id');
		if (!$id) {
			http_response_code(400);
			return false;
		}
		$this->load->database();
		$check = $this->db->query("SELECT id, name FROM roles WHERE id = ? LIMIT 1", [$id]);
		if ($check->num_rows() == 0) {
			http_response_code(404);
			return false;
		}
		json(response(true, 200, 'success', $check->row()));
	}
	public function editRole(){
		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			http_response_code(401);
			return false;
		}
		$id = post('id');
		if (!$id) {
			http_response_code(400);
			return false;
		}
		$this->load->database();
		$get = $this->db->query("SELECT id, name FROM roles WHERE id = ? LIMIT 1", [$id]);
		if ($get->num_rows() == 0) {
			http_response_code(404);
			return false;
		}
		$data = [
			'name'		=>	post('name'),
		];
		$edit = $this->db->where('id', $id, TRUE)->update('roles', $data);
		if (!$edit) {
			json(response(false, 500, 'failed edit'));
		}
		json(response(true, 201, 'success, updated'));
	}
	public function deleteRole(){
		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			http_response_code(401);
			return false;
		}
		$id = post('id');
		if (!$id) {
			http_response_code(400);
			return false;
		}
		$this->load->database();
		$delete = $this->db->delete('roles', ['id' => $id]);
		if (!$delete) {
			json(response(false, 500, 'failed delete'));
		}
		json(response(true, 200, 'success delete'));
	}
	# role
	# asset
	public function asset(){
		$this->load([
			'file'	=>	'module/asset/index'
		]);
	}
	public function assetNumber($is_return = false)
	{
		$this->load->database();
		$get = $this->db->query("SELECT RIGHT(asset_no, 7) as sequence FROM assets LIMIT 1");
		$sequence;
		if ($get->num_rows() == 0) {
			$sequence = "0000001";
		}else{
			$data = $get->row();
			$sequence = intval($data->sequence) + 1;
		}
		// RFL/2022/05/0000001
		$format = FORMAT_STRING.'/'.date('Y').'/'.date('m').'/'.sprintf("%07s", $sequence);
		if ($is_return) {
			return $format;
		}else{
			json(response(true, 200, 'success', ['number' => $format]));
		}
	}
	public function assetData(){
		$this->load->database();
		json(response(true, 200, 'success', $this->db->query("SELECT id, name, asset_no, type FROM assets")->result()));
	}
	public function listAsset(){
		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			http_response_code(401);
			return false;
		}
		$this->load->model('model');
		$this->model->listAsset();
	}
	public function saveAsset(){
		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			http_response_code(401);
			return false;
		}
		$asset_no = $this->assetNumber(true);
		if (!$asset_no) {
			json(response(false, 400, 'failed get assset number'));
		}
		$this->load->database();
		$data = [
			'name'		=>	post('name'),
			'asset_no'	=>	$asset_no,
			'type'		=>	post('type'),
		];
		$save = $this->db->insert('assets', $data);
		if (!$save) {
			json(response(false, 500, 'failed save data'));
		}
		json(response(true, 201, 'success, created'));
	}
	public function findAsset(){
		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			http_response_code(401);
			return false;
		}
		$id = post('id');
		if (!$id) {
			http_response_code(400);
			return false;
		}
		$this->load->database();
		$check = $this->db->query("SELECT id, name, asset_no, type FROM assets WHERE id = ? LIMIT 1", [$id]);
		if ($check->num_rows() == 0) {
			http_response_code(404);
			return false;
		}
		json(response(true, 200, 'success', $check->row()));
	}
	public function editAsset(){
		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			http_response_code(401);
			return false;
		}
		$id = post('id');
		if (!$id) {
			http_response_code(400);
			return false;
		}
		$this->load->database();
		$get = $this->db->query("SELECT id FROM assets WHERE id = ? LIMIT 1", [$id]);
		if ($get->num_rows() == 0) {
			http_response_code(404);
			return false;
		}
		$asset_no = post('asset_no');
		$data = [
			'name'		=>	post('name'),
			'asset_no'	=>	$asset_no,
			'type'		=>	post('type'),
		];
		$edit = $this->db->where('id', $id, TRUE)->update('assets', $data);
		if (!$edit) {
			json(response(false, 500, 'failed edit'));
		}
		json(response(true, 201, 'success, updated'));
	}
	public function deleteAsset(){
		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			http_response_code(401);
			return false;
		}
		$id = post('id');
		if (!$id) {
			http_response_code(400);
			return false;
		}
		$this->load->database();
		$delete = $this->db->delete('assets', ['id' => $id]);
		if (!$delete) {
			json(response(false, 500, 'failed delete'));
		}
		json(response(true, 200, 'success delete'));
	}
	# asset
	# assignment
	public function assignment(){
		$this->load([
			'file'	=>	'module/assignment/index'
		]);
	}
	public function assignmentData(){
		$this->load->database();
		json(response(true, 200, 'success', $this->db->query("SELECT id, name, assignment_no, type, user_id FROM assignments")->result()));
	}
	public function listAssignment(){
		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			http_response_code(401);
			return false;
		}
		$this->load->model('model');
		$this->model->listAssignment();
	}
	public function saveAssignment(){
		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			http_response_code(401);
			return false;
		}
		$this->load->database();
		$data = [
			'asset_id'		=>	post('asset_id'),
			'employee_id'	=>	post('employee_id'),
		];
		$save = $this->db->insert('assignments', $data);
		if (!$save) {
			json(response(false, 500, 'failed save data'));
		}
		json(response(true, 201, 'success, created'));
	}
	public function findAssignment(){
		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			http_response_code(401);
			return false;
		}
		$id = post('id');
		if (!$id) {
			http_response_code(400);
			return false;
		}
		$this->load->database();
		$check = $this->db->query("SELECT id, asset_id, employee_id FROM assignments WHERE id = ? LIMIT 1", [$id]);
		if ($check->num_rows() == 0) {
			http_response_code(404);
			return false;
		}
		json(response(true, 200, 'success', $check->row()));
	}
	public function editAssignment(){
		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			http_response_code(401);
			return false;
		}
		$id = post('id');
		if (!$id) {
			http_response_code(400);
			return false;
		}
		$this->load->database();
		$get = $this->db->query("SELECT id FROM assignments WHERE id = ? LIMIT 1", [$id]);
		if ($get->num_rows() == 0) {
			http_response_code(404);
			return false;
		}
		$data = [
			'asset_id'		=>	post('asset_id'),
			'employee_id'	=>	post('employee_id'),
		];
		$edit = $this->db->where('id', $id, TRUE)->update('assignments', $data);
		if (!$edit) {
			json(response(false, 500, 'failed edit'));
		}
		json(response(true, 201, 'success, updated'));
	}
	public function deleteAssignment(){
		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			http_response_code(401);
			return false;
		}
		$id = post('id');
		if (!$id) {
			http_response_code(400);
			return false;
		}
		$this->load->database();
		$delete = $this->db->delete('assignments', ['id' => $id]);
		if (!$delete) {
			json(response(false, 500, 'failed delete'));
		}
		json(response(true, 200, 'success delete'));
	}
	# assignment

	# dashboard
	function totalAsset()
	{
		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			http_response_code(405);
			return false;
		}
		$this->load->database();
		$sql = $this->db->query("SELECT COUNT(id) as total FROM assets");
		json(response(true, 200, 'success', ['total' => $sql->row()->total]));
	}
	function totalEmployee()
	{
		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			http_response_code(405);
			return false;
		}
		$this->load->database();
		$sql = $this->db->query("SELECT COUNT(id) as total FROM employees");
		json(response(true, 200, 'success', ['total' => $sql->row()->total]));
	}
	function totalAssignment()
	{
		if ($_SERVER['REQUEST_METHOD'] !== "POST") {
			http_response_code(405);
			return false;
		}
		$this->load->database();
		$sql = $this->db->query("SELECT COUNT(id) as total FROM assignments");
		json(response(true, 200, 'success', ['total' => $sql->row()->total]));
	}
	# dashboard
}