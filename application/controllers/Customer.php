<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Data Customer";
        $data['customer'] = $this->admin->getAllCustomer();
        $this->template->load('templates/dashboard', 'customer/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Customer";
            $this->template->load('templates/dashboard', 'customer/add', $data);
        } else {
                $input = $this->input->post(null, true);
                $insert = $this->admin->insert('customer', $input);

                if ($insert) {
                    set_pesan('data berhasil disimpan.');
                    redirect('customer');
                } else {
                    set_pesan('Opps ada kesalahan!');
                    redirect('customer/add');
                }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Customer";
            $data['customer'] = $this->admin->get('customer', ['id' => $id]);
            $this->template->load('templates/dashboard', 'customer/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('customer', 'id', $id, $input);

            if ($update) {
                set_pesan('data berhasil diedit.');
                redirect('customer');
            } else {
                set_pesan('data gagal diedit.');
                redirect('customer/edit/' . $id);
            }
        }
    }

    public function delete($getId)  
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('customer', 'id', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('customer');
    }

}
