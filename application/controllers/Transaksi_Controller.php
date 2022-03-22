<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_Controller extends CI_Controller
{

	public $data;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Transaksi_model');
		$this->data = $this->parse_data($this->input->raw_input_stream);
	}

	public function index()
	{
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($this->Transaksi_model->get_all_transaksi()));
	}

	public function post()
	{
		// $this->output
		// ->set_content_type('application/json')
		// ->set_output(json_encode(array(
		// 	"name" => $_POST['name']
		// )));

		
		$this->db->trans_start();
			$id = $this->Transaksi_model->insert_transaksi($this->data);
			$this->Transaksi_model->create_npwz($id);
		$this->db->trans_complete();
	}

	public function parse_data(string $data)
	{
		return json_decode($data, true);
	}
}
