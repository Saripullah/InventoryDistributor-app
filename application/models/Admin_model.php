<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function kode()
    {
        $kode = 'T-BM-' . date('ymd');
        $kode_terakhir = $this->admin->getMax('barang_masuk', 'id_barang_masuk', $kode);
        $kode_tambah = substr($kode_terakhir, -5, 5);
        $kode_tambah++;
        $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
        $kode_akhir = $kode . $number;
        return $kode_akhir;
    }

    public function toggle_req($id, $isPermit)
    {
        if ($isPermit != 5) {
            $this->db->set('isPermit', $isPermit);
            $this->db->where('barang_requests.id', $id);
            $this->db->update('barang_requests');
            return $this->db->affected_rows() > 0;
        } else {
            // ambil data dari barang request nya
            $data = $this->db->query("select * from barang_requests where id ='$id'")->row();
            $id_barang = $data->barang_id;
            $supplier_id = $data->supplier_id;
            $jumlah_masuk = $data->total;
            $tanggal_masuk = date('Y-m-d');

            // proses 1, update ke tbl barang request
            $this->db->set('isPermit', $isPermit);
            $this->db->where('barang_requests.id', $id);
            $this->db->update('barang_requests');

            // proses 2, insert ke tbl barang masuk
            $post = [
                'id_barang_masuk'   => $this->kode(),
                'supplier_id'       => $supplier_id,
                'user_id'           => $this->session->userdata('login_session')['user'],
                'barang_id'         => $id_barang,
                'jumlah_masuk'      => $jumlah_masuk,
                'tanggal_masuk'     => $tanggal_masuk
            ];
            $this->db->insert('barang_masuk', $post);

            return $post;
        }
    }

    public function cekRequest()
    {
        $data = $this->db->query("select a.*, b.nama_barang
        from barang_requests a 
        join barang b on a.barang_id = b.id_barang
        where isPermit = '0';")->result();
        return $data;
    }

    public function update_request($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('barang_requests', $data);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function show_req($id)
    {
        $this->db->select('*');
        $this->db->from('barang_requests');
        $this->db->where('barang_requests.id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function insert_request($data)
    {
        $this->db->insert('barang_requests', $data);
    }
    public function getCustomer($id)
    {
        $this->db->where('id =', $id);
        return $this->db->get('customer')->result_array();
    }


    public function getAllCustomer()
    {
        return $this->db->get('customer')->result_array();
    }

    public function getAllUser()
    {
        return $this->db->get('user')->result_array();
    }
    public function getAllBarang()
    {
        return $this->db->get('barang')->result_array();
    }
    public function getAllSupplier()
    {
        return $this->db->get('supplier')->result_array();
    }
    public function getAllSatuan()
    {
        return $this->db->get('satuan')->result_array();
    }
    public function getAllPenjualan()
    {
        $this->db->select('penjualan.id, barang.id_barang, barang.nama_barang, penjualan.jml, penjualan.harga, penjualan.total,penjualan.tgl,satuan.nama_satuan');
        $this->db->from('penjualan');
        $this->db->join('barang', 'barang.id_barang = penjualan.id_barang');
        $this->db->join('satuan', 'satuan.id_satuan = penjualan.id_satuan');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function index($id = null)
    {
        if ($id) {
            $this->db->select('barang_requests.id, user.nama, supplier.nama_supplier, barang.nama_barang, barang_requests.total, barang_requests.isPermit, barang_requests.tanggal, satuan.nama_satuan ');
            $this->db->from('barang_requests');
            $this->db->join('user', 'barang_requests.user_id = user.id_user');
            $this->db->join('barang', 'barang_requests.barang_id = barang.id_barang');
            $this->db->join('supplier', 'barang_requests.supplier_id = supplier.id_supplier');
            $this->db->join('satuan', 'barang_requests.satuan_id = satuan.id_satuan');
            $this->db->where('barang_requests.user_id', $id);
            $this->db->where('barang_requests.isPermit != 5');
            $query = $this->db->get();
            return $query->result();
        } else {
            $this->db->select('barang_requests.id, user.nama, supplier.nama_supplier, barang.nama_barang, barang_requests.total, barang_requests.isPermit, barang_requests.tanggal, satuan.nama_satuan ');
            $this->db->from('barang_requests');
            $this->db->join('user', 'barang_requests.user_id = user.id_user');
            $this->db->join('barang', 'barang_requests.barang_id = barang.id_barang');
            $this->db->join('supplier', 'barang_requests.supplier_id = supplier.id_supplier');
            $this->db->join('satuan', 'barang_requests.satuan_id = satuan.id_satuan');
            $this->db->where('barang_requests.isPermit != 5');
            $query = $this->db->get();
            return $query->result();
        }
    }
    public function get($table, $data = null, $where = null)
    {
        if ($data != null) {
            return $this->db->get_where($table, $data)->row_array();
        } else {
            return $this->db->get_where($table, $where)->result_array();
        }
    }

    public function find($table, $col, $colVal)
    {
        return $this->db->from($table)->where($col . ' = ', $colVal)->get()->row();
    }

    public function update($table, $pk, $id, $data)
    {
        $this->db->where($pk, $id);
        return $this->db->update($table, $data);
    }

    public function insert($table, $data, $batch = false)
    {
        return $batch ? $this->db->insert_batch($table, $data) : $this->db->insert($table, $data);
    }

    public function delete($table, $pk, $id)
    {
        return $this->db->delete($table, [$pk => $id]);
    }

    public function getUsers($id)
    {
        /**
         * ID disini adalah untuk data yang tidak ingin ditampilkan. 
         * Maksud saya disini adalah 
         * tidak ingin menampilkan data user yang digunakan, 
         * pada managemen data user
         */
        $this->db->where('id_user !=', $id);
        return $this->db->get('user')->result_array();
    }

    public function getBarang()
    {
        $this->db->join('jenis j', 'b.jenis_id = j.id_jenis');
        $this->db->join('satuan s', 'b.satuan_id = s.id_satuan');
        $this->db->order_by('id_barang');
        return $this->db->get('barang b')->result_array();
    }

    // Get barang untuk data barang
    public function getBarangHasStok()
    {
        $get_barang_has_stok = $this->db->query("SELECT 
                                                    barang.id_barang,
                                                    barang.nama_barang,
                                                    barang.harga,
                                                    satuan.nama_satuan,
                                                    jenis.nama_jenis,
                                                    barang_has_stok.stok,
                                                    barang_has_stok.expired
                                                    FROM barang_has_stok
                                                        LEFT JOIN barang
                                                            ON barang_has_stok.barang_id = barang.id_barang
                                                        LEFT JOIN satuan
                                                            ON barang.satuan_id = satuan.id_satuan
                                                        LEFT JOIN jenis
                                                            ON barang.jenis_id = jenis.id_jenis
                                                        WHERE barang_has_stok.barang_id =  barang.id_barang
                                                        AND CASE WHEN ( SELECT COUNT(*) FROM barang_has_stok barang_has_stok_layer_2 WHERE barang_has_stok_layer_2.barang_id = barang.id_barang ) > 1 THEN barang_has_stok.stok != 0 ELSE TRUE END
                                                        ORDER BY barang.id_barang ASC, barang_has_stok.id_barang_has_stok ASC
        ");
        return $get_barang_has_stok->result_array();
    }

    // Get barang masuk untuk data barang masuk
    public function getBarangMasuk($limit = null, $id_barang = null, $range = null)
    {
        $this->db->select('*');
        $this->db->join('user u', 'bm.user_id = u.id_user',  'left');
        $this->db->join('supplier sp', 'bm.supplier_id = sp.id_supplier',  'left');
        $this->db->join('barang b', 'bm.barang_id = b.id_barang',  'left');
        $this->db->join('satuan s', 'b.satuan_id = s.id_satuan',  'left');
        if ($limit != null) {
            $this->db->limit($limit);
        }

        if ($id_barang != null) {
            $this->db->where('id_barang', $id_barang);
        }

        if ($range != null) {
            $this->db->where('tanggal_masuk' . ' >=', $range['mulai']);
            $this->db->where('tanggal_masuk' . ' <=', $range['akhir']);
        }

        // $this->db->order_by('barang_id');
        $this->db->order_by('tanggal_masuk', 'desc');
        return $this->db->get('barang_masuk bm')->result_array();
    }

    // Get tanggal kadaluarsa terbaru
    public function getLatestExpired($barang_id)
    {
        $this->db->select('max(expired) as latest_expired');
        $this->db->from('barang_masuk');
        $this->db->where('barang_id', $barang_id);
        $query = $this->db->get();
        return $query->row();
    }

    // Get barang keluar untuk data barang keluar
    public function getBarangKeluar($limit = null, $id_barang = null, $range = null)
    {
        $this->db->select('*');
        $this->db->join('user u', 'bk.user_id = u.id_user');
        $this->db->join('barang b', 'bk.barang_id = b.id_barang');
        $this->db->join('satuan s', 'b.satuan_id = s.id_satuan');
        if ($limit != null) {
            $this->db->limit($limit);
        }
        if ($id_barang != null) {
            $this->db->where('id_barang', $id_barang);
        }
        if ($range != null) {
            $this->db->where('tanggal_keluar' . ' >=', $range['mulai']);
            $this->db->where('tanggal_keluar' . ' <=', $range['akhir']);
        }
        $this->db->order_by('id_barang_keluar', 'DESC');
        return $this->db->get('barang_keluar bk')->result_array();
    }

    // Get barang yang ada di barang masuk
    public function getBarangInBarangMasuk()
    {
        $barang = $this->db->query("SELECT 
                                        barang.id_barang, 
                                        barang.nama_barang 
	                                FROM barang_masuk
                                    LEFT JOIN barang
  	                                    ON barang_masuk.barang_id = barang.id_barang
                                    WHERE barang_masuk.barang_id = barang.id_barang
                                    GROUP BY barang_masuk.barang_id");
        return $barang->result_array();
    }

    public function cekBarang()
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('stok <', 10);
        $query = $this->db->get();
        return $query->result();
    }

    public function getFilter($rule, $dateStart = null, $dateEnd = null)
    {
        if ($rule == 'ttlSold') {
            $result = $this->db->query("SELECT bk.id_barang_keluar,bk.tanggal_keluar,bk.tanggal_sekarang,b.nama_barang,bk.jumlah_keluar,s.nama_satuan,us.nama, SUM(bk.jumlah_keluar) as total_sold
                FROM barang_keluar as bk
                JOIN user as us ON bk.user_id = us.id_user
                JOIN barang as b ON bk.barang_id = b.id_barang
                JOIN satuan as s ON b.satuan_id = s.id_satuan
                GROUP BY b.nama_barang, bk.jumlah_keluar
                HAVING COUNT(bk.jumlah_keluar) > 0
                ORDER BY total_sold
                DESC");
            return $result->result_array();
        } elseif ($dateStart != null || $dateEnd != null) {
            $result = $this->db->query("SELECT bk.id_barang_keluar,bk.tanggal_keluar,bk.tanggal_sekarang,b.nama_barang,bk.jumlah_keluar,s.nama_satuan,us.nama FROM `barang_keluar` as bk
                LEFT JOIN user as us ON bk.user_id = us.id_user
                LEFT JOIN barang as b ON bk.barang_id = b.id_barang
                LEFT JOIN satuan as s ON b.satuan_id = s.id_satuan
                WHERE bk.tanggal_keluar >= '$dateStart'
                AND bk.tanggal_keluar <= '$dateEnd'
                ORDER BY bk.jumlah_keluar
                                DESC");
            return $result->result_array();
        } else {
            $this->db->select('*');
            $this->db->join('user u', 'bk.user_id = u.id_user');
            $this->db->join('barang b', 'bk.barang_id = b.id_barang');
            $this->db->join('satuan s', 'b.satuan_id = s.id_satuan');
            $this->db->order_by('id_barang_keluar', 'DESC');
            return $this->db->get('barang_keluar bk')->result_array();
        }
    }

    public function getMax($table, $field, $kode = null)
    {
        $this->db->select_max($field);
        if ($kode != null) {
            $this->db->like($field, $kode, 'after');
        }
        return $this->db->get($table)->row_array()[$field];
    }

    public function count($table)
    {
        return $this->db->count_all($table);
    }

    public function sum($table, $field)
    {
        $this->db->select_sum($field);
        return $this->db->get($table)->row_array()[$field];
    }

    public function min($table, $field, $min)
    {
        $field = $field . ' <=';
        $this->db->where($field, $min);
        return $this->db->get($table)->result_array();
    }

    public function chartBarangMasuk($bulan)
    {
        $like = 'T-BM-' . date('y') . $bulan;
        $this->db->like('id_barang_masuk', $like, 'after');
        return count($this->db->get('barang_masuk')->result_array());
    }

    public function chartBarangKeluar($bulan)
    {
        $like = 'T-BK-' . date('y') . $bulan;
        $this->db->like('id_barang_keluar', $like, 'after');
        return count($this->db->get('barang_keluar')->result_array());
    }

    public function laporan($table, $mulai, $akhir)
    {
        $tgl = $table == 'barang_masuk' ? 'tanggal_masuk' : 'tanggal_keluar';
        $this->db->where($tgl . ' >=', $mulai);
        $this->db->where($tgl . ' <=', $akhir);
        return $this->db->get($table)->result_array();
    }

    public function cekStok($id)
    {
        $this->db->join('satuan s', 'b.satuan_id=s.id_satuan');
        return $this->db->get_where('barang b', ['id_barang' => $id])->row_array();
    }

    // Get barang untuk add di barang keluar
    public function getBarangForBarangKeluar($id)
    {
        $barang = $this->db->query("SELECT
                                        barang.*,
                                        barang_has_stok.stok as stok_barang_keluar,
                                        barang_has_stok.barang_masuk_id as id_barang_masuk,
                                        satuan.nama_satuan
                                    FROM barang_has_stok
                                        LEFT JOIN barang
                                            ON barang_has_stok.barang_id = barang.id_barang
                                        LEFT JOIN satuan
                                            ON barang.satuan_id = satuan.id_satuan
                                        WHERE barang_has_stok.barang_id = '$id'
                                            AND barang_has_stok.stok != 0
                                        ORDER BY barang_has_stok.id_barang_has_stok ASC
                                        LIMIT 1");
        return $barang->row_array();
    }

    // Get barang dengan parameter id
    public function detailBarang($id)
    {
        $barang = $this->db->query("SELECT 
                                        barang.nama_barang,
                                        barang.harga,
                                        barang.stok,
                                        satuan.nama_satuan,
                                        jenis.nama_jenis,
                                        id_satuan
                                    FROM barang 
                                    LEFT JOIN satuan
                                        ON barang.satuan_id = satuan.id_satuan
                                    LEFT JOIN jenis
                                        ON barang.jenis_id = jenis.id_jenis
                                    WHERE barang.id_barang = '$id'
                                    ");
        return $barang->row();
    }
public function checkReferencedData($table, $column, $id)
    {
    // Lakukan query ke tabel barang dengan menggunakan WHERE untuk mencocokkan id_barang dengan $id
    $this->db->where($column, $id);
    $query = $this->db->get($table);

    // Cek jumlah baris hasil query
    return $query->num_rows() > 0;
    }

}