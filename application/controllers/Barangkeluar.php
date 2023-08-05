<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barangkeluar extends CI_Controller
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
        $data['title'] = "Barang keluar";
        $data['filter'] = '';
        $data['barangkeluar'] = $this->admin->getBarangkeluar();
        $this->template->load('templates/dashboard', 'barang_keluar/data', $data);
    }
    public function filterSold()
    {
        $rule = $this->input->post('filter');
        $dateStart  = $this->input->post('date1');
        $dateEnd = $this->input->post('date2');
        $data['title'] = "Barang keluar";
        $data['filter'] = "";
        $data['barangkeluar'] = '';
        if ($rule == 'ttlSold') {
            $data['filter'] = "Filter berdasarkan barang terlaris";
            $data['barangkeluar'] = $this->admin->getFilter($rule);
        } else if ($dateStart) {
            $data['filter'] = "Filter berdasarkan tanggal " . $dateStart . " Sampai " . $dateEnd;
            $data['barangkeluar'] = $this->admin->getFilter($rule, $dateStart, $dateEnd);
        } else {
            $data['filter'] = '';
            $data['barangkeluar'] = $this->admin->getBarangkeluar();
        }
        //print_r('datarule = > '.$rule);
        $this->template->load('templates/dashboard', 'barang_keluar/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal_keluar', 'Tanggal Keluar', 'required|trim');
        $this->form_validation->set_rules('barang_id', 'Barang', 'required');

        $input = $this->input->post('barang_id', true);
        $stok = $this->admin->get('barang', ['id_barang' => $input])['stok'];
        $stok_valid = $stok + 1;

        $this->form_validation->set_rules(
            'jumlah_keluar',
            'Jumlah Keluar',
            "required|trim|numeric|greater_than[0]|less_than[{$stok_valid}]",
            [
                'less_than' => "Jumlah Keluar tidak boleh lebih dari {$stok}"
            ]
        );
    }

    public function add()
    {
        // $this->_validasi();
        $this->form_validation->set_rules('tanggal_keluar', 'Tanggal Keluar', 'required|trim');
        $this->form_validation->set_rules('barang_id', 'Barang', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Barang Keluar";
            $data['barang'] = $this->admin->getBarangInBarangMasuk();

            // Mendapatkan dan men-generate kode transaksi barang keluar
            $kode = 'T-BK-' . date('ymd');
            $kode_terakhir = $this->admin->getMax('barang_keluar', 'id_barang_keluar', $kode);
            $kode_tambah = substr($kode_terakhir, -5, 5);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_barang_keluar'] = $kode . $number;

            $this->template->load('templates/dashboard', 'barang_keluar/add', $data);
        } else {
            $stok = $this->input->post('stok');
            $jumlah_keluar = $this->input->post('jumlah_keluar');

            // Cek barang keluar, tidak boleh lebih dari dari stok
            if ($jumlah_keluar > $stok) {
                echo '<script>alert(`Jumlah barang keluar tidak boleh lebih dari stok barang!`); window.location.href = "'.base_url('barangkeluar/add').'";</script>';
            } else {
                $input = $this->input->post(null, true);

                // Get data barang has stok
                $barang_has_stok = $this->admin->get('barang_has_stok', ['barang_masuk_id' => $input["id_barang_masuk"]]);

                // Update data stok di barang has stok
                $update_barang_has_stok = $this->admin->update('barang_has_stok','id_barang_has_stok',
                    $barang_has_stok['id_barang_has_stok'],
                    ['stok' => $barang_has_stok['stok'] - $jumlah_keluar]
                );

                // Hapus object yang ada di array
                unset($input["id_barang_masuk"]);
                unset($input["stok"]);

                $insert = $this->admin->insert('barang_keluar', $input);

                if ($insert && $update_barang_has_stok) {
                    set_pesan('data berhasil disimpan.');
                    redirect('barangkeluar');
                } else {
                    set_pesan('Opps ada kesalahan!');
                    redirect('barangkeluar/add');
                }
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('barang_keluar', 'id_barang_keluar', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('barangkeluar');
    }
}
