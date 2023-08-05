<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Requestbarang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index_gudang()
    {
        $data['title'] = "Request Barang";
        $data['datas'] = $this->admin->index($this->session->userdata('login_session')['user']);
        $this->template->load('templates/dashboard', 'request_produk/index_gudang',$data);
    }
    public function index_admin()
    {
        $data['title'] = "Request Barang";        
        $data['user'] = $this->admin->getAllUser();
        $data['barang'] = $this->admin->getAllBarang();
        $data['supplier'] = $this->admin->getAllSupplier();
        $data['satuan'] = $this->admin->getAllSatuan();
        $data['datas'] = $this->admin->index();
        $this->template->load('templates/dashboard', 'request_produk/index_admin',$data);
    }

    public function alldatas()
    {
        $data['title'] = "Tambah Request Barang";
        $data['user'] = $this->admin->getAllUser();
        $data['barang'] = $this->admin->getAllBarang();
        $data['supplier'] = $this->admin->getAllSupplier();
        $data['satuan'] = $this->admin->getAllSatuan();
        $this->template->load('templates/dashboard', 'request_produk/create',$data);
    }

    public function input()
    {        
        $input = $this->input->post();
        $this->admin->insert_request($input);        
        if (is_admin()) {
            $this->session->set_flashdata('message', 'Sukses menambahkan data');
            redirect('requestbarang/index_admin');
        } else {
            $this->session->set_flashdata('message', 'Sukses menambahkan data');
            redirect('requestbarang/index_gudang');
        }
    }

    public function show($id)
    {
        $id = encode_php_tags($id);
        $data['datas'] = $this->admin->show_req($id);
        $data['title'] = 'Edit Data';
        $data['user'] = $this->admin->getAllUser();
        $data['barang'] = $this->admin->getAllBarang();
        $data['supplier'] = $this->admin->getAllSupplier();
        $data['satuan'] = $this->admin->getAllSatuan();
        
        $this->template->load('templates/dashboard', 'request_produk/edit',$data);
    }

    public function show_admin($id)
    {
        $id = encode_php_tags($id);
        $data['datas'] = $this->admin->show_req($id);
        $data['title'] = 'Edit Data';
        $data['user'] = $this->admin->getAllUser();
        $data['barang'] = $this->admin->getAllBarang();
        $data['supplier'] = $this->admin->getAllSupplier();
        $data['satuan'] = $this->admin->getAllSatuan();
        
        $this->template->load('templates/dashboard', 'request_produk/edit_admin',$data);
    }

    public function update()
    {
        $id = $this->input->post('id');
        $user_id = $this->input->post('user_id');
        $supplier_id = $this->input->post('supplier_id');
        $barang_id = $this->input->post('barang_id');
        $satuan_id = $this->input->post('satuan_id');
        $total = $this->input->post('total');
        $isPermit = $this->input->post('isPermit');

        $data = [
            'id'=>$id,
            'user_id' => $user_id,
            'barang_id' => $barang_id,
            'supplier_id' => $supplier_id,
            'satuan_id' => $satuan_id,
            'total' => $total,
            'isPermit' => $isPermit,
            'tanggal' => date('Y-m-d H:i:s')
        ];
        $result = $this->admin->update_request($data);
        if ($result) {
            if (is_admin()) {
                $this->session->set_flashdata('message', 'Data berhasil diupdate.');
                redirect('requestbarang/index_admin');
            } else {
                $this->session->set_flashdata('message', 'Data berhasil diupdate.');
                redirect('requestbarang/index_gudang');
            }
        } else {
            if (is_admin()) {
                $this->session->set_flashdata('message', 'Gagal silahkan coba lagi.');
                redirect('requestbarang/index_admin');
            } else {
                $this->session->set_flashdata('message', 'Gagal silahkan coba lagi.');
                redirect('requestbarang/index_gudang');
            }
        }
    }

    public function toggle()
    {
        $id = $this->input->post('id');
        $isPermit = $this->input->post('isPermit');
        $result = $this->admin->toggle_req($id,$isPermit);
        if ($result) {
            $this->session->set_flashdata('message', 'Request berhasil disetujui.');
            redirect('requestbarang/index_admin');
        } else {
            $this->session->set_flashdata('message', 'Data gagal silahkan ulangi.');
            redirect('requestbarang/index_admin');
        }
        
    }

    public function delete($id)
    {
        $id = encode_php_tags($id);
        if ($this->admin->delete('barang_requests', 'id', $id)) {
        }
        if (is_admin()) {
            $this->session->set_flashdata('message', 'Sukses menghapus data');
            redirect('requestbarang/index_admin');
        } else {
            $this->session->set_flashdata('message', 'Sukses menghapus data');
            redirect('requestbarang/index_gudang');
        }
    }

}
