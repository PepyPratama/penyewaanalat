<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);

defined('BASEPATH') or exit('No direct script access allowed');

class Owner extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        function tanggalIndonesia($tanggal)
        {
            $bulan = [
                1 => 'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ];

            $pecahkan = explode('-', date('Y-m-d', strtotime($tanggal)));

            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }
    }


    public function index()
    {
        $id_user = $this->session->userdata('id_user');

        if (!$id_user) {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger solid alert-dismissible fade show">
                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                    </button><strong>Maaf, Silahkan login terlebih dahulu!</strong>
                </div>'
            );

            redirect('login');
        }

        $data = [
            'title'     => 'Dashboard',
            'pembelian' => $this->Model_owner->getTotalPembelian(),
            'alat'      => $this->Model_owner->getTotalAlat(),
            'penyewaan' => $this->Model_owner->getTotalPenyewaan(),
            'transaksi' => $this->Model_owner->getTotalTransaksi(),
        ];

        $this->load->view('templates/owner/header', $data);
        $this->load->view('templates/owner/topbar');
        $this->load->view('templates/owner/sidebar');
        $this->load->view('owner/dashboard');
        $this->load->view('templates/owner/footer');
    }


    // START PEMBELIAN
    public function pembelian()
    {
        $data = [
            'title'     => 'Data Pembelian',
            'pembelian' => $this->Model_owner->getAllPembelian(),
        ];

        $this->load->view('templates/owner/header', $data);
        $this->load->view('templates/owner/topbar');
        $this->load->view('templates/owner/sidebar');
        $this->load->view('owner/pembelian');
        $this->load->view('templates/owner/footer');
    }

    // START DETAIL
    public function detail_pembelian($id_pembelian)
    {
        $data = [
            'title'     => 'Data Pembelian',
            'pembelian' => $this->Model_owner->getPembelianById($id_pembelian),
        ];

        $this->load->view('templates/owner/header', $data);
        $this->load->view('templates/owner/topbar');
        $this->load->view('templates/owner/sidebar');
        $this->load->view('owner/detail_pembelian');
        $this->load->view('templates/owner/footer');
    }

    public function edit_jumlah_acc($id_pembelian)
    {
        $data = [
            'id_pembelian'  => htmlspecialchars($this->input->post('id_pembelian', TRUE)),
            'jumlah_acc'    => htmlspecialchars($this->input->post('jumlah_acc', TRUE)),
        ];

        $this->Model_owner->editPembelian($id_pembelian, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-warning solid alert-dismissible fade show">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close">
                    <span><i class="mdi mdi-close"></i></span>
                </button>
                Jumlah Pembelian berhasil diubah!
            </div>'
        );

        redirect('owner/detail_pembelian/' . $id_pembelian);
    }

    public function edit_status_pembelian($id_pembelian)
    {
        $data = [
            'id_pembelian'  => htmlspecialchars($this->input->post('id_pembelian', TRUE)),
            'status'        => htmlspecialchars($this->input->post('status', TRUE)),
        ];

        $this->Model_owner->editPembelian($id_pembelian, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-warning solid alert-dismissible fade show">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close">
                    <span><i class="mdi mdi-close"></i></span>
                </button>
                Status Pembelian berhasil diubah!
            </div>'
        );

        redirect('owner/detail_pembelian/' . $id_pembelian);
    }

    public function edit_pembelian($id_pembelian)
    {
        // Ambil input dari form
        $jumlah_pembelian = (int)htmlspecialchars($this->input->post('jumlah_pembelian', TRUE)); // Sesuaikan dengan input di form
        $status = htmlspecialchars($this->input->post('status', TRUE));

        // Ambil data pembelian berdasarkan ID
        $pembelian = $this->Model_owner->getPembelianById($id_pembelian);
        $jenis_pembelian = $pembelian['jenis_pembelian'];
        $nama_alat = $pembelian['nama_alat'];

        // Dapatkan id_alat berdasarkan nama_alat
        $id_alat = $this->Model_owner->getIdAlatByNamaAlat($nama_alat);

        // Update status pembelian
        $data = [
            'status' => $status,
        ];
        $this->Model_owner->editPembelian($id_pembelian, $data);

        // Update stok berdasarkan status dan jenis pembelian
        if ($status === 'disetujui' && $jenis_pembelian === 'alat lama' && $id_alat) {
            $this->Model_owner->updateStok($id_alat, $jumlah_pembelian, '+');
        } elseif ($status === 'tidak disetujui' && $jenis_pembelian === 'alat lama' && $id_alat) {
            $this->Model_owner->updateStok($id_alat, $jumlah_pembelian, '-');
        }

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-warning solid alert-dismissible fade show">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close">
                    <span><i class="mdi mdi-close"></i></span>
                </button>
                Data berhasil diubah!
            </div>'
        );
        redirect('owner/pembelian');
    }


    // LAPORAN
    public function laporan_pembelian()
    {
        $data = [
            'title'     => 'Data Pembelian',
            'pembelian' => $this->Model_owner->getAllPembelian(),
        ];

        $this->load->view('templates/owner/header', $data);
        $this->load->view('templates/owner/topbar');
        $this->load->view('templates/owner/sidebar');
        $this->load->view('owner/laporan_pembelian');
        $this->load->view('templates/owner/footer');
    }

    public function pembelian_excel()
    {
        $data = [
            'pembelian' => $this->Model_owner->getAllPembelian(),
        ];

        require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $excel = new PHPExcel();

        $excel->getProperties()->setCreator("Peps")
            ->setLastModifiedBy("Peps")
            ->setTitle("Laporan Pembelian");

        $header = [
            'A1' => 'No',
            'B1' => 'Nama Alat',
            'C1' => 'Harga Beli',
            'D1' => 'Jumlah Pembelian',
            'E1' => 'Jenis Pembelian',
            'F1' => 'Status',
        ];

        foreach ($header as $cell => $value) {
            $excel->setActiveSheetIndex(0)->setCellValue($cell, $value);
        }

        // Set header style
        $headerStyle = [
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['rgb' => 'FFFF00']
            ],
            'font' => [
                'bold' => true
            ],
            'alignment' => [
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                ]
            ]
        ];

        $excel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($headerStyle);

        $row = 2;

        foreach ($data['pembelian'] as $value) {
            $excel->getActiveSheet()
                ->setCellValue('A' . $row, $row - 1)
                ->setCellValue('B' . $row, $value['nama_alat'])
                ->setCellValue('C' . $row, number_format($value['harga_beli']))
                ->setCellValue('D' . $row, $value['jumlah_pembelian'])
                ->setCellValue('E' . $row, $value['jenis_pembelian'])
                ->setCellValue('F' . $row, $value['status']);
            $row++;
        }

        $excel->getActiveSheet()->setTitle('Laporan Pembelian');

        foreach (range('A', 'F') as $columnID) {
            $excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }

        $excel->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Pembelian.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $writer->save('php://output');
        exit;
    }

    public function pembelian_pdf()
    {
        $data = [
            'pembelian' => $this->Model_owner->getAllPembelian(),
        ];

        $this->load->view('owner/pembelian_pdf', $data);
    }


    // START ALAT
    public function laporan_alat()
    {
        $data = [
            'title'     => 'Data Alat',
            'alat'      => $this->Model_owner->getAllAlat(),
            'pembelian' => $this->Model_owner->getAllPembelian(),
            'kategori'  => $this->Model_owner->getAllKategoriAlat(),
        ];

        $this->load->view('templates/owner/header', $data);
        $this->load->view('templates/owner/topbar');
        $this->load->view('templates/owner/sidebar');
        $this->load->view('owner/laporan_alat');
        $this->load->view('templates/owner/footer');
    }

    public function alat_excel()
    {
        $data = [
            'alat'  => $this->Model_owner->getAllAlat(),
        ];

        require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $excel = new PHPExcel();

        $excel->getProperties()->setCreator("Peps")
            ->setLastModifiedBy("Peps")
            ->setTitle("Laporan Alat");

        $header = [
            'A1' => 'No',
            'B1' => 'Nomor Seri',
            'C1' => 'Nama Alat',
            'D1' => 'Kategori Alat',
            'E1' => 'Harga Sewa',
            'F1' => 'Stok Keseluruhan',
            'G1' => 'Stok Rusak',
            'H1' => 'Stok Tersedia',
            'I1' => 'Stok Disewa',
        ];

        foreach ($header as $cell => $value) {
            $excel->setActiveSheetIndex(0)->setCellValue($cell, $value);
        }

        // Set header style
        $headerStyle = [
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['rgb' => 'FFFF00']
            ],
            'font' => [
                'bold' => true
            ],
            'alignment' => [
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                ]
            ]
        ];

        $excel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($headerStyle);

        $row = 2;

        foreach ($data['alat'] as $value) {
            $excel->getActiveSheet()
                ->setCellValue('A' . $row, $row - 1)
                ->setCellValue('B' . $row, $value['no_seri'])
                ->setCellValue('C' . $row, $value['nama_alat'])
                ->setCellValue('D' . $row, $value['nama_kategori'])
                ->setCellValue('E' . $row, number_format($value['harga_sewa']))
                ->setCellValue('F' . $row, $value['stok_keseluruhan'])
                ->setCellValue('G' . $row, $value['stok_rusak'])
                ->setCellValue('H' . $row, $value['stok_tersedia'])
                ->setCellValue('I' . $row, $value['stok_disewa']);
            $row++;
        }

        $excel->getActiveSheet()->setTitle('Laporan Alat');

        foreach (range('A', 'I') as $columnID) {
            $excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }

        $excel->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Alat.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $writer->save('php://output');
        exit;
    }

    public function alat_pdf()
    {
        $data = [
            'alat'  => $this->Model_owner->getAllAlat(),
        ];

        $this->load->view('owner/alat_pdf', $data);
    }
    // END ALAT


    public function laporan_alat_rusak()
    {
        $data = [
            'title'     => 'Data Alat',
            'alat'      => $this->Model_owner->getAllAlatRusak(),
            'pembelian' => $this->Model_owner->getAllPembelian(),
            'kategori'  => $this->Model_owner->getAllKategoriAlat(),
        ];

        $this->load->view('templates/owner/header', $data);
        $this->load->view('templates/owner/topbar');
        $this->load->view('templates/owner/sidebar');
        $this->load->view('owner/laporan_alat_rusak');
        $this->load->view('templates/owner/footer');
    }

    public function alat_rusak_excel()
    {
        $data = [
            'alat'  => $this->Model_owner->getAllAlatRusak(),
        ];

        require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $excel = new PHPExcel();

        $excel->getProperties()->setCreator("Peps")
            ->setLastModifiedBy("Peps")
            ->setTitle("Laporan Alat Rusak");

        $header = [
            'A1' => 'No',
            'B1' => 'Nomor Seri',
            'C1' => 'Nama Alat',
            'D1' => 'Kategori Alat',
            'E1' => 'Harga Sewa',
            'F1' => 'Stok Keseluruhan',
            'G1' => 'Stok Rusak',
            'H1' => 'Stok Tersedia',
            'I1' => 'Stok Disewa',
        ];

        foreach ($header as $cell => $value) {
            $excel->setActiveSheetIndex(0)->setCellValue($cell, $value);
        }

        // Set header style
        $headerStyle = [
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['rgb' => 'FFFF00']
            ],
            'font' => [
                'bold' => true
            ],
            'alignment' => [
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                ]
            ]
        ];

        $excel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($headerStyle);

        $row = 2;

        foreach ($data['alat'] as $value) {
            $excel->getActiveSheet()
                ->setCellValue('A' . $row, $row - 1)
                ->setCellValue('B' . $row, $value['no_seri'])
                ->setCellValue('C' . $row, $value['nama_alat'])
                ->setCellValue('D' . $row, $value['nama_kategori'])
                ->setCellValue('E' . $row, number_format($value['harga_sewa']))
                ->setCellValue('F' . $row, $value['stok_keseluruhan'])
                ->setCellValue('G' . $row, $value['stok_rusak'])
                ->setCellValue('H' . $row, $value['stok_tersedia'])
                ->setCellValue('I' . $row, $value['stok_disewa']);
            $row++;
        }

        $excel->getActiveSheet()->setTitle('Laporan Alat Rusak');

        foreach (range('A', 'I') as $columnID) {
            $excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }

        $excel->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Alat Rusak.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $writer->save('php://output');
        exit;
    }

    public function alat_rusak_pdf()
    {
        $data = [
            'alat'  => $this->Model_owner->getAllAlatRusak(),
        ];

        $this->load->view('owner/alat_rusak_pdf', $data);
    }


    // START PENYEWAAN
        public function laporan_penyewaan() 
        {
            $data = [
                'title' => 'Data Penyewaan',
                'penyewaan' => $this->Model_owner->getAllPenyewaan()
            ];
            $this->load->view('templates/owner/header', $data);
            $this->load->view('templates/owner/topbar');
            $this->load->view('templates/owner/sidebar');
            $this->load->view('owner/laporan_penyewaan');
            $this->load->view('templates/owner/footer');
        }
    
    
    public function penyewaan_excel()
{
    $tanggal_awal   = $this->input->post('tanggal_awal');
    $tanggal_akhir  = $this->input->post('tanggal_akhir');
    $status_pembayaran = $this->input->post('status_pembayaran');
    $status_penyewaan = $this->input->post('status_penyewaan');

    $data = [
        'penyewaan' => $this->Model_owner->filterPenyewaan($tanggal_awal, $tanggal_akhir, $status_pembayaran, $status_penyewaan)
    ];

    require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
    require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

    $excel = new PHPExcel();
    // (code omitted for brevity)
}

public function penyewaan_pdf()
{
    $id_user = $this->session->userdata('id_user');

    $tanggal_awal   = $this->input->post('tanggal_awal');
    $tanggal_akhir  = $this->input->post('tanggal_akhir');
    $status_pembayaran = $this->input->post('status_pembayaran');
    $status_penyewaan = $this->input->post('status_penyewaan');

    $penyewaan = $this->Model_owner->filterPenyewaan($tanggal_awal, $tanggal_akhir, $status_pembayaran, $status_penyewaan);
    $penyewaan_ids = array_column($penyewaan, 'id_penyewaan');

    $data = [
        'penyewaan'         => $penyewaan,
        'ringkasan_alat'    => $this->Model_owner->getRingkasanAlat($penyewaan_ids),
        'user'    => $this->Model_owner->getUserById($id_user)
    ];

    $this->load->view('owner/penyewaan_pdf', $data);
}
    // END PENYEWAAN


    // START PROFILE
    public function profile()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title' => 'Data Profile',
            'user'  => $this->Model_owner->getUserById($id_user),
        ];

        $this->load->view('templates/owner/header', $data);
        $this->load->view('templates/owner/topbar');
        $this->load->view('templates/owner/sidebar');
        $this->load->view('owner/profile');
        $this->load->view('templates/owner/footer');
    }

    public function edit_profile()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'nama_lengkap'  => htmlspecialchars($this->input->post('nama_lengkap', TRUE)),
            'email'         => htmlspecialchars($this->input->post('email', TRUE)),
            'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        ];

        $this->Model_owner->editProfile($id_user, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-warning solid alert-dismissible fade show">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                Data berhasil diubah!
            </div>'
        );
        redirect('owner/profile');
    }
    // END PROFILE
}

/* End of file Owner.php */
