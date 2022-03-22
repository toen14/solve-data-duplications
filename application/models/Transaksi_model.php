<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
    public function get_all_transaksi()
    {
        $query = $this->db->get('transaksi');
        return $query->result();
    }

    public function insert_transaksi($request)
    {
        $this->no_bukti      = $this->generate_bukti_id();
        $this->date          = $request['date'];
        $this->name          = $request['name'];
        $this->address       = $request['address'];
        $this->donation_type = $request['donation_type'];   
        $this->register      = $this->generate_register_id();
        $this->db->insert('transaksi', $this);

        return $this->db->insert_id();
    }

    public function create_npwz(int $id)
    {
        $data = $this->db->get_where('transaksi', ["id" => $id])->row();
        $this->db->update(
            'transaksi', 
            ['npwz' => 'NPWZ-'. explode('-', $data->register)[1]], 
            ['id' => $id]
        );
    }

    public function generate_register_id()
    {
        return "REG-". time() . rand(1, 9999999999);
    }

    public function generate_bukti_id()
    {
        return "BUKTI-". time() . rand(1, 9999999999);
    }
}
