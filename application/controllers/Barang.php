<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
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
        $data['title'] = "Barang";
        $data['barang'] = $this->admin->getBarang();
        $data['barangHasStoks'] = $this->admin->getBarangHasStok();
        $data['cekbarang'] = $this->admin->cekBarang();
        $this->template->load('templates/dashboard', 'barang/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('jenis_id', 'Jenis Barang', 'required');
        $this->form_validation->set_rules('satuan_id', 'Satuan Barang', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim|numeric|greater_than[0]');
    }

    public function add()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Barang";
            $data['jenis'] = $this->admin->get('jenis');
            $data['satuan'] = $this->admin->get('satuan');

            // Mengenerate ID Barang
            $kode_terakhir = $this->admin->getMax('barang', 'id_barang');
            $kode_tambah = substr($kode_terakhir, -6, 6);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 6, '0', STR_PAD_LEFT);
            $data['id_barang'] = 'B' . $number;

            $this->template->load('templates/dashboard', 'barang/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert_barang = $this->admin->insert('barang', $input);

            $barang_id = $this->input->post('id_barang');

            // Insert to table barang_has_stok
            $insert_barang_has_stok = $this->admin->insert('barang_has_stok', [
                'barang_id' => $barang_id,
                'stok' => 0,
                'expired' => '-',
            ]);

            if ($insert_barang && $insert_barang_has_stok) {
                set_pesan('data berhasil disimpan');
                redirect('barang');
            } else {
                set_pesan('gagal menyimpan data');
                redirect('barang/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Barang";
            $data['jenis'] = $this->admin->get('jenis');
            $data['satuan'] = $this->admin->get('satuan');
            $data['barang'] = $this->admin->get('barang', ['id_barang' => $id]);
            $this->template->load('templates/dashboard', 'barang/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('barang', 'id_barang', $id, $input);

            if ($update) {
                set_pesan('data berhasil disimpan');
                redirect('barang');
            } else {
                set_pesan('gagal menyimpan data');
                redirect('barang/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
         // Query ke tabel barang untuk memeriksa apakah id_satuan sudah terdaftar
        $isPenjualanReferenced = $this->admin->checkReferencedData('penjualan', 'id_barang', $id);
        $isRequestbarangReferenced = $this->admin->checkReferencedData('barang_requests', 'barang_id', $id);

        if ($isRequestbarangReferenced || $isPenjualanReferenced) {
            set_pesan('Gagal dihapus dikarenakan Data Barang masih terkait.');
        } else {
            if ($this->admin->delete('barang_has_stok', 'barang_id', $id) && ($this->admin->delete('barang', 'id_barang', $id)))  {
        
                set_pesan('Data berhasil dihapus.');
            } else {
                set_pesan('Data gagal dihapus.', false);
            }
        }
        redirect('barang');
    }

    // Get stok untuk barang keluar
    public function getstok($getId)
    {
        $id = encode_php_tags($getId);
        $query = $this->admin->getBarangForBarangKeluar($id);
        output_json($query);
    }

    public function getdetailbarang($getId)
    {
        $id = encode_php_tags($getId);
        $query = $this->admin->detailBarang($id);
        output_json($query);
    }
}
