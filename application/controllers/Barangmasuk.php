<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barangmasuk extends CI_Controller
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
        $data['title'] = "Barang Masuk";
        $data['barangmasuk'] = $this->admin->getBarangMasuk();
        $this->template->load('templates/dashboard', 'barang_masuk/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required|trim');
        $this->form_validation->set_rules('supplier_id', 'Supplier', 'required');
        $this->form_validation->set_rules('barang_id', 'Barang', 'required');
        $this->form_validation->set_rules('jumlah_masuk', 'Jumlah Masuk', 'required|trim|numeric|greater_than[0]');
        $this->form_validation->set_rules('expired', 'Expired', 'required|trim');
    }

    public function add($id = '')
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Barang Masuk";
            $data['supplier'] = $this->admin->get('supplier');
            $data['barang'] = $this->admin->get('barang');
            
            /** kode nya dipindah ke admin modal biar bisa dipanggil sekaligus */
            // Mendapatkan dan men-generate kode transaksi barang masuk
            // $kode = 'T-BM-' . date('ymd');
            // $kode_terakhir = $this->admin->getMax('barang_masuk', 'id', $kode);
            // $kode_tambah = substr($kode_terakhir, -5, 5);
            // $kode_tambah++;
            // $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            // $data['id_barang_masuk'] = $kode . $number;

            // untuk ambil kode barang masuk
            $data['id_barang_masuk'] = $this->admin->kode();

            if ($id != null || $id != '') {
                $id_trx = $id;
                $data['barang_masuk'] = $this->db->query("select * from barang_masuk where id_barang_masuk = '$id_trx'")->row();
                // var_dump($data['barang_masuk']->supplier_id);exit;
                $data['title'] = "Barang Masuk";
                $data['supplier'] = $this->admin->get('supplier');
                $data['barang'] = $this->admin->get('barang');
                // $data = [
                //     'title'             => 'Barang Masuk',
                //     'id_barang_masuk'   => $id_trx,
                //     'supplier'          => $barang_masuk->supplier_id,
                //     'barang'            => $barang_masuk->barang_id,
                //     'jumlah_masuk'      => $barang_masuk->jumlah_masuk,
                //     'tanggal_masuk'     => $barang_masuk->tanggal_masuk,
                // ];
                // $data['id_barang_masuk'] = $id_trx;

                // $data['barang']
            }

            $this->template->load('templates/dashboard', 'barang_masuk/add', $data);
        } else {
            $obj_latest_expired = $this->admin->getLatestExpired($this->input->post('barang_id'));
            $latest_expired = $obj_latest_expired->latest_expired;

            // cek utk ada id atau engga 
            if ($this->uri->segment(3) == '') {
                // Cek tanggal kadaluarsa, tidak boleh lebih atau sama dengan tanggal kadaluarsa sebelumnya
                if ($this->input->post('expired') <= $latest_expired && $latest_expired != null) {
                    echo '<script>alert(`Expired barang harus lebih dari expired barang sebelumnya`); window.location.href = "'.base_url('barangmasuk/add').'";</script>';
                } else {
                    $input = $this->input->post(null, true);
                    $insert = $this->admin->insert('barang_masuk', $input);
    
                    // Insert stok barang masuk ke table barang_has_stok
                    $insert_barang_has_stok = $this->admin->insert('barang_has_stok', [
                        'barang_id'       => $input['barang_id'],
                        'barang_masuk_id' => $input['id_barang_masuk'],
                        'stok'            => $input['jumlah_masuk'],
                        'expired'         => $input['expired'],
                    ]);
    
                    if ($insert && $insert_barang_has_stok) {
                        set_pesan('data berhasil disimpan.');
                        redirect('barangmasuk');
                    } else {
                        set_pesan('Opps ada kesalahan!');
                        redirect('barangmasuk/add');
                    }
                }
            } else {
                $input = $this->input->post(null, true);

                // ubah status dan input expired date
                $update = [
                    'expired'   => $input['expired'],
                    'is_input'  => 1
                ];
                $this->db->where('id_barang_masuk', $id);
                $this->db->update('barang_masuk', $update);

                $insert_barang_has_stok = $this->admin->insert('barang_has_stok', [
                    'barang_id'       => $input['barang_id'],
                    'barang_masuk_id' => $input['id_barang_masuk'],
                    'stok'            => $input['jumlah_masuk'],
                    'expired'         => $input['expired'],
                ]);

                if ($update && $insert_barang_has_stok) {
                    set_pesan('data berhasil disimpan.');
                    redirect('barangmasuk');
                } else {
                    set_pesan('Opps ada kesalahan!');
                    redirect('barangmasuk/add/' . $id);
                }
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('barang_masuk', 'id_barang_masuk', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('barangmasuk');
    }
}
