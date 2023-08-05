<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function pdf()
    {
        // Ambil data dari POST atau GET
        $penjualan = json_decode($this->input->post('penjualan'), true);
        $grandTotal = $this->input->post('grandTotal');
        $selectedTotal = $this->input->post('selectedTotal');
        $method = $this->input->post('method');
        $customer = $this->input->post('customer');
        
        $customerData = $this->admin->getCustomer($customer);
        
        $selectedRows = $this->input->post('selectRow');
        $selectedData = [];
        
        if (!empty($selectedRows) && is_array($selectedRows)) {
            foreach ($selectedRows as $rowId => $value) {
                if ($value == 'on') {
                    foreach ($penjualan as $b) {
                        if ($b['id'] == $rowId) {
                            $selectedData[] = $b;
                            break;
                        }
                    }
                }
            }
        }
        // var_dump($customerData);

        $this->generate($selectedData, $selectedTotal, $method, $customerData);
    }
    public function generate($penjualan, $selectedTotal, $method, $customer)
    {
        $this->load->library('CustomPDF');
        $pdf = new FPDF();
        $pdf->AddPage('L', 'A5');
        // Text on the left side
        $pdf->SetFont('Times', 'B', 13);
        $pdf->Cell(0, 0, 'CV. VICTORY ABADI', 0, 0, 'L');
        $pdf->SetX(160);
        $pdf->Cell(0, 0, 'FAKTUR TUNAI', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(0, 10, 'JL. KALIKASA KM15 GG DAMANG ARI LUHING', 0, 1, 'L');
        $pdf->Cell(0, 0, 'RT 18 RW 04 DS PAREGGEAN KOTAWARINGIN TIMUR KAB. KOTAWARINGIN TIMUR', 0, 1, 'L');
        $pdf->SetX(160);
        $pdf->Cell(0, 5, 'Kepada Yth : ', 0, 1, 'L');
        $pdf->SetX(160);
        $pdf->Cell(0, 5, $customer[0]['nama'], 0, 1, 'L');
        $pdf->SetX(160);
        $pdf->SetFillColor(255, 255, 255); 
        $pdf->MultiCell(0, 5, $customer[0]['alamat'], 0, 'L', true);
        $pdf->SetX(160);
        $pdf->Cell(0, 5, 'Tanggal: ' . date('Y-m-d H:i:s'), 0, 1, 'L');
        
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(20, 10, 'Kode', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Nama Barang', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Jumlah Barang', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Harga', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Total', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 8);
        $total = 0;
        foreach ($penjualan as $b) {
            $pdf->Cell(20, 10, $b['id_barang'], 1, 0, 'C');
            $pdf->Cell(40, 10, $b['nama_barang'], 1, 0, 'C');
            $pdf->Cell(40, 10, number_format($b['jml'], 0, ',', '.'). ' ' . ($b['nama_satuan']), 1, 0, 'C');
            $pdf->Cell(40, 10, 'Rp ' . number_format($b['harga'], 0, ',', '.'), 1, 0, 'C');
            $pdf->Cell(40, 10, 'Rp ' . number_format($b['total'], 0, ',', '.'), 1, 1, 'C');

            $total += $b['total'];
        }

        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetX(136); 
        $pdf->Cell(0, 10, 'Total            :   Rp ' . number_format($total, 0, ',', '.'), 0, 1, 'L');
        
        $pdf->Ln(10);
        $pdf->SetX(26);
        $pdf->Cell(0, 0, 'PENERIMA: ', 0, 1, 'L');
        $pdf->SetX(84);
        $pdf->Cell(0, 0, 'HORMAT KAMI: ', 0, 1, 'L');

        $file_name = 'invoice' . ' ' . $customer[0]['nama'];
        $pdf->Output('I', $file_name);
    }
    public function index()
    {
        $data['title'] = "Penjualan";
        $data['penjualan'] = $this->admin->getAllPenjualan();
        $data['satuan'] = $this->admin->getAllSatuan();
        $data['customer'] = $this->admin->getAllCustomer();
        $this->template->load('templates/dashboard', 'penjualan/index', $data);
    }
    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('penjualan', 'id', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('penjualan');
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('id_barang', 'Pilih Barang', 'required');
        $this->form_validation->set_rules('jml', 'Jumlah', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('total', 'Total', 'required');
    }
    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Penjualan";
            $data['barang'] = $this->admin->getAllBarang();
            $data['satuan'] = $this->admin->getAllSatuan();
            $this->template->load('templates/dashboard', 'penjualan/add', $data);
        } else {
            $post = $this->input->post(null, true);

            $input = [
                'id_barang' => $post['id_barang'],
                'id_satuan' => $post['id_satuan'],
                'jml' => $post['jml'],
                'harga' => $post['harga'],
                'total' => $post['total'],
                'tgl' => $post['tgl']
            ];

            $insert = $this->admin->insert('penjualan', $input);

            if ($insert) {
                set_pesan('data berhasil disimpan');
                redirect('penjualan');
            } else {
                set_pesan('gagal menyimpan data');
                redirect('penjualan/add');
            }
        }
    }
    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Penjualan";
            $data['barang'] = $this->admin->get('barang');
            $data['satuan'] = $this->admin->getAllSatuan();
            $data['penjualan'] = $this->admin->get('penjualan', ['id' => $id]);
            $this->template->load('templates/dashboard', 'penjualan/edit', $data);
        } else {
            $post = $this->input->post(null, true);

            $input = [
                'id_barang' => $post['id_barang'],
                'id_satuan' => $post['id_satuan'],
                'jml' => $post['jml'],
                'harga' => $post['harga'],
                'total' => $post['total'],
                'tgl' => $post['tgl']
            ];
            
            $update = $this->admin->update('penjualan', 'id', $id, $input);

            if ($update) {
                set_pesan('data berhasil disimpan');
                redirect('penjualan');
            } else {
                set_pesan('gagal menyimpan data');
                redirect('penjualan/edit/' . $id);
            }
        }
    }
}

