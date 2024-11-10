<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // CEK KONDISI LOGIN
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

        // FORMAT BULAN
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


    // DASHBOARD
    public function index()
    {
        $data = [
            'title'         => 'Dashboard',
            'pembelian'     => $this->Model_admin->getTotalPembelian(),
            'alat'          => $this->Model_admin->getTotalAlat(),
            'penyewaan'     => $this->Model_admin->getTotalPenyewaan(),
            'transaksi'     => $this->Model_admin->getTotalTransaksi(),
            'notifikasi'    => $this->Model_admin->getNotifikasiChechout(),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/dashboard', $data); // Kirim data ke view dashboard
        $this->load->view('templates/admin/footer');
    }



    // START PEMBELIAN
    public function pembelian()
    {
        $data = [
            'title'         => 'Data Pembelian',
            'pembelian'     => $this->Model_admin->getAllPembelian(),
            'alat'          => $this->Model_admin->getAllPembelianByStatusDiSetujui(),
            'notifikasi'    => $this->Model_admin->getNotifikasiChechout(),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/pembelian');
        $this->load->view('templates/admin/footer');
    }

    public function tambah_pembelian()
    {
        $jenis_pembelian = htmlspecialchars($this->input->post('jenis_pembelian', TRUE));

        if ($jenis_pembelian == 'alat baru') {
            $nama_alat          = htmlspecialchars($this->input->post('nama_alat_baru', TRUE));
            $nama_toko          = htmlspecialchars($this->input->post('nama_toko_baru', TRUE));
            $jumlah_pembelian   = htmlspecialchars($this->input->post('jumlah_pembelian_baru', TRUE));
            $harga_beli         = htmlspecialchars($this->input->post('harga_beli_baru', TRUE));
            $tanggal_pembelian  = htmlspecialchars($this->input->post('tanggal_pembelian_baru', TRUE));
        } elseif ($jenis_pembelian == 'alat lama') {
            $nama_alat          = htmlspecialchars($this->input->post('nama_alat_lama', TRUE));
            $nama_toko          = htmlspecialchars($this->input->post('nama_toko_lama', TRUE));
            $jumlah_pembelian   = htmlspecialchars($this->input->post('jumlah_pembelian_lama', TRUE));
            $harga_beli         = htmlspecialchars($this->input->post('harga_beli_lama', TRUE));
            $tanggal_pembelian  = htmlspecialchars($this->input->post('tanggal_pembelian_lama', TRUE));
        }

        $data = [
            'nama_alat'         => $nama_alat,
            'nama_toko'         => $nama_toko,
            'jumlah_pembelian'  => $jumlah_pembelian,
            'harga_beli'        => $harga_beli,
            'jenis_pembelian'   => $jenis_pembelian,
            'tanggal_pembelian' => $tanggal_pembelian,
            'status'            => 'pending',
        ];

        // Menyimpan data dan mendapatkan ID pembelian
        $id_pembelian = $this->Model_admin->tambahPembelian($data);

        // Membuat kode pembelian
        $kode_pembelian = 'PO' . str_pad($id_pembelian, 3, '0', STR_PAD_LEFT);
        $this->Model_admin->updateKodePembelian($id_pembelian, $kode_pembelian);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success solid alert-dismissible fade show">
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
            Data berhasil disimpan!
        </div>'
        );
        redirect('admin/pembelian');
    }

    public function edit_pembelian($id_pembelian)
    {
        $data = [
            'id_pembelian'      => htmlspecialchars($this->input->post('id_pembelian', TRUE)),
            'nama_alat'         => htmlspecialchars($this->input->post('nama_alat', TRUE)),
            'nama_toko'         => htmlspecialchars($this->input->post('nama_toko', TRUE)),
            'jumlah_pembelian'  => htmlspecialchars($this->input->post('jumlah_pembelian', TRUE)),
            'harga_beli'        => htmlspecialchars($this->input->post('harga_beli', TRUE)),
            'tanggal_pembelian' => htmlspecialchars($this->input->post('tanggal_pembelian', TRUE)),
        ];

        $this->Model_admin->editPembelian($id_pembelian, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-warning solid alert-dismissible fade show">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                Data berhasil diubah!
            </div>'
        );
        redirect('admin/pembelian');
    }

    public function detail_pembelian($id_pembelian)
    {
        $data = [
            'title'         => 'Data Pembelian',
            'pembelian'     => $this->Model_admin->getDetailPembelian($id_pembelian),
            'notifikasi'    => $this->Model_admin->getNotifikasiChechout(),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/detail_pembelian');
        $this->load->view('templates/admin/footer');
    }

    // public function hapus_pembelian($id_pembelian)
    // {
    //     $this->Model_admin->hapusPembelian($id_pembelian);
    //     $this->session->set_flashdata(
    //         'pesan',
    //         '<div class="alert alert-danger solid alert-dismissible fade show">
    //             <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
    //             Data berhasil dihapus!
    //         </div>'
    //     );

    //     redirect('admin/pembelian');
    // }
    // END PEMBELIAN


    // START ALAT
    public function alat()
    {
        $data = [
            'title'         => 'Data Alat',
            'alat'          => $this->Model_admin->getAllAlat(),
            'pembelian'     => $this->Model_admin->getAllPembelianByStatusDiSetujui(),
            'kategori'      => $this->Model_admin->getAllKategoriAlat(),
            'notifikasi'    => $this->Model_admin->getNotifikasiChechout(),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/alat');
        $this->load->view('templates/admin/footer');
    }

    public function tambah_alat()
    {
        $config['upload_path']      = './assets/images/upload_alat/';
        $config['allowed_types']    = 'gif|jpg|jpeg|png';
        $config['max_size']         = 2048;

        $this->load->library('upload', $config);

        $id_pembelian = htmlspecialchars($this->input->post('id_pembelian', TRUE));

        // Validasi ID Pembelian
        if ($this->Model_admin->cekAlat($id_pembelian)) {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger solid alert-dismissible fade show">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                Nama alat sudah ada
            </div>'
            );
            redirect('admin/alat');
        }

        if (!$this->upload->do_upload('foto')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
            redirect('admin/alat');
        } else {
            $upload_foto    = $this->upload->data();
            $foto           = $upload_foto['file_name'];

            // Ambil stok keseluruhan dari jumlah pembelian berdasarkan ID pembelian
            $stok_keseluruhan = $this->Model_admin->getJumlahPembelianById($id_pembelian);

            $data = [
                'id_kategori_alat'  => htmlspecialchars($this->input->post('id_kategori_alat', TRUE)),
                'id_pembelian'      => $id_pembelian,
                'no_seri'           => htmlspecialchars($this->input->post('no_seri', TRUE)),
                'harga_sewa'        => htmlspecialchars($this->input->post('harga_sewa', TRUE)),
                'stok_keseluruhan'  => $stok_keseluruhan,
                'stok_rusak'        => 0,
                'stok_tersedia'     => $stok_keseluruhan - 0,
                'stok_disewa'       => 0,
                'spesifikasi'       => htmlspecialchars($this->input->post('spesifikasi', TRUE)),
                'foto'              => $foto
            ];

            $this->Model_admin->tambahAlat($data);
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success solid alert-dismissible fade show">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                Data berhasil disimpan!
            </div>'
            );

            redirect('admin/alat');
        }
    }


    public function edit_alat($id_alat)
    {
        $stok_keseluruhan   = htmlspecialchars($this->input->post('stok_keseluruhan', TRUE));
        $stok_rusak         = htmlspecialchars($this->input->post('stok_rusak', TRUE));
        $stok_disewa        = htmlspecialchars($this->input->post('stok_disewa', TRUE));

        $stok_tersedia = $stok_keseluruhan - $stok_rusak - $stok_disewa;

        $data = [
            'id_alat'           => htmlspecialchars($this->input->post('id_alat', TRUE)),
            'id_kategori_alat'  => htmlspecialchars($this->input->post('id_kategori_alat', TRUE)),
            'id_pembelian'      => htmlspecialchars($this->input->post('id_pembelian', TRUE)),
            'no_seri'           => htmlspecialchars($this->input->post('no_seri', TRUE)),
            'harga_sewa'        => htmlspecialchars($this->input->post('harga_sewa', TRUE)),
            'stok_keseluruhan'  => $stok_keseluruhan,
            'stok_rusak'        => $stok_rusak,
            'stok_tersedia'     => $stok_tersedia,
            'stok_disewa'       => $stok_disewa,
            'spesifikasi'       => htmlspecialchars($this->input->post('spesifikasi', TRUE)),
        ];

        if (!empty($_FILES['foto']['name'])) {
            $config['upload_path']      = './assets/images/upload_alat/';
            $config['allowed_types']    = 'gif|jpg|jpeg|png';
            $config['max_size']         = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto')) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('admin/alat');
            } else {
                $upload_foto = $this->upload->data();
                $data['foto'] = $upload_foto['file_name'];
            }
        }

        $this->Model_admin->editAlat($id_alat, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-warning solid alert-dismissible fade show">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                Data berhasil diubah!
            </div>'
        );
        redirect('admin/alat');
    }

    public function hapus_alat($id_alat)
    {
        $this->Model_admin->hapusAlat($id_alat);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-danger solid alert-dismissible fade show">
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
            Data berhasil dihapus!</div>'
        );
        redirect('admin/alat');
    }
    // END ALAT


    // START KATEGORI ALAT
    public function kategori_alat()
    {
        $data = [
            'title'         => 'Data Kategori Alat',
            'kategori'      => $this->Model_admin->getAllKategoriAlat(),
            'notifikasi'    => $this->Model_admin->getNotifikasiChechout(),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/kategori_alat');
        $this->load->view('templates/admin/footer');
    }

    public function tambah_kategori_alat()
    {
        $data = [
            'nama_kategori' => htmlspecialchars($this->input->post('nama_kategori', TRUE))
        ];

        $this->Model_admin->tambahKategoriAlat($data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success solid alert-dismissible fade show">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                Data berhasil disimpan!
            </div>'
        );
        redirect('admin/kategori_alat');
    }

    public function edit_kategori_alat($id_kategori_alat)
    {
        $data = [
            'id_kategori_alat'  => $this->input->post('id_kategori_alat'),
            'nama_kategori'     => $this->input->post('nama_kategori')
        ];

        $this->Model_admin->editKategoriAlat($id_kategori_alat, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-warning solid alert-dismissible fade show">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                Data berhasil diubah!
            </div>'
        );
        redirect('admin/kategori_alat');
    }

    public function hapus_kategori_alat($id_kategori_alat)
    {
        $this->Model_admin->hapusKategoriAlat($id_kategori_alat);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-danger solid alert-dismissible fade show">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                Data berhasil dihapus!
            </div>'
        );
        redirect('admin/kategori_alat');
    }
    // END KATEGORI ALAT

    // START PENYEWAAN DETAIL
    public function penyewaan_detail()
    {
        $data = [
            'title'     => 'Data Penyewaan Detail',
            'penyewaan' => $this->Model_admin->getAllDetailPenyewaan()
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/penyewaan_detail');
        $this->load->view('templates/admin/footer');
    }
    // END PENYEWAAN DETAIL


    // START TRANSAKSI
    public function transaksi()
    {
        $data = [
            'title'         => 'Data Transaksi',
            'penyewaan'     => $this->Model_admin->getAllPenyewaan(),
            'notifikasi'    => $this->Model_admin->getNotifikasiChechout(),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/transaksi');
        $this->load->view('templates/admin/footer');
    }

    public function detail_transaksi($id_penyewaan)
    {
        $data = [
            'title'             => 'Data Transaksi',
            'penyewaan'         => $this->Model_admin->getPenyewaanById($id_penyewaan),
            'penyewaan_detail'  => $this->Model_admin->getPenyewaanDetailByIdPenyewaan($id_penyewaan),
            'notifikasi'        => $this->Model_admin->getNotifikasiChechout(),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/detail_transaksi');
        $this->load->view('templates/admin/footer');
    }

    public function edit_status($id_penyewaan)
{
    $data = [
        'id_penyewaan'          => $this->input->post('id_penyewaan'),
        'status_pembayaran'     => $this->input->post('status_pembayaran'),
        'status_pelunasan'      => $this->input->post('status_pelunasan'),
        'keterangan_ditolak'    => $this->input->post('keterangan_ditolak'),
    ];

    if ($data['status_pembayaran'] == 'diterima') {
        $penyewaan_detail = $this->Model_admin->getPenyewaanDetailByIdPenyewaan($id_penyewaan);

        foreach ($penyewaan_detail as $detail) {
            $id_alat    = $detail['id_alat'];
            $jumlah     = $detail['jumlah'];

            if ($data['status_pelunasan'] == 'sudah lunas') {
                $this->Model_admin->updateStokAlat($id_alat, $jumlah);
            } elseif ($data['status_penyewaan'] == 'dikembalikan') {
                $this->Model_admin->kembalikanStokAlat($id_alat, $jumlah);
            }
        }

        // Ubah status penyewaan menjadi 'disewakan'
        $this->Model_admin->updateStatusPenyewaan($id_penyewaan, 'disewakan');

        $penyewaan  = $this->Model_admin->getPenyewaanById($id_penyewaan);
        $user       = $this->Model_admin->getUserById($penyewaan['id_user']);

        // Kirim notifikasi email
        $this->load->library('email');
        $this->email->from('pepy.10520114@mahasiswa.unikom.ac.id', 'PT KREASI MEZZO UTAMA');
        $this->email->to($user['email']);
        $this->email->subject('Status Pembayaran Diterima');
        $this->email->message('Kepada Yth. ' . $user['nama_lengkap'] . ',<br><br>Dengan hormat, kami informasikan bahwa pembayaran Anda telah kami terima. <br><br>Terima kasih telah menggunakan layanan kami.<br><br>Hormat kami,<br>PT KREASI MEZZO UTAMA');

        if (!$this->email->send()) {
            log_message('error', 'Email gagal dikirim: ' . $this->email->print_debugger());
        }
    }

    $this->Model_admin->editPenyewaan($id_penyewaan, $data);

    if ($data['status_pembayaran'] == 'ditolak') {
        $this->Model_admin->hapusTransaksi($id_penyewaan);
    }

    $this->session->set_flashdata(
        'pesan',
        '<div class="alert alert-warning solid alert-dismissible fade show">
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
            Data berhasil diubah!
        </div>'
    );

    redirect('admin/transaksi');
}


public function edit_pengembalian($id_penyewaan)
{
    $data = [
        'id_penyewaan'              => $this->input->post('id_penyewaan'),
        'status_penyewaan'          => $this->input->post('status_penyewaan'),
        'keterangan_pengembalian'   => $this->input->post('keterangan_pengembalian'),
        'detail_pengembalian'       => $this->input->post('detail_pengembalian'),
        'waktu_pengembalian'        => $this->input->post('waktu_pengembalian'),
        'denda_keterlambatan'       => $this->input->post('denda_keterlambatan'),
        'nama_penerima'             => $this->input->post('nama_penerima'),
    ];

    // Logika untuk mengubah status penyewaan dan mengembalikan stok
    if (in_array($data['keterangan_pengembalian'], ['Tidak Ada Kerusakan', 'Kerusakan Ringan', 'Kerusakan Berat'])) {
        $data['status_penyewaan'] = 'Dikembalikan';

        // Dapatkan detail penyewaan untuk mengembalikan stok alat
        $penyewaan_detail = $this->Model_admin->getPenyewaanDetailByIdPenyewaan($id_penyewaan);

        foreach ($penyewaan_detail as $detail) {
            $id_alat = $detail['id_alat'];
            $jumlah = $detail['jumlah'];

            // Mengembalikan stok alat yang berkurang
            $this->Model_admin->kembalikanStokAlat($id_alat, $jumlah);
        }
    }

    date_default_timezone_set('Asia/Jakarta');

    if ($data['status_penyewaan'] === 'diterima') {
        $data['tanggal_diterima'] = date('Y-m-d H:i:s'); 
    }
    

    // Simpan perubahan ke database
    $this->Model_admin->editPenyewaan($id_penyewaan, $data);

    // Set pesan flash untuk notifikasi sukses
    $this->session->set_flashdata(
        'pesan',
        '<div class="alert alert-warning solid alert-dismissible fade show">
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
            Data berhasil diubah!
        </div>'
    );

    // Redirect ke halaman transaksi
    redirect('admin/transaksi');
}

    // END TRANSAKSI


    // START USER
    public function user()
    {
        $data = [
            'title'         => 'Data User',
            'user'          => $this->Model_admin->getAllUser(),
            'role'          => $this->Model_admin->getAllRole(),
            'notifikasi'    => $this->Model_admin->getNotifikasiChechout(),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/user');
        $this->load->view('templates/admin/footer');
    }

    public function tambah_user()
    {
        $data = [
            'id_role'       => htmlspecialchars($this->input->post('id_role', TRUE)),
            'nama_lengkap'  => htmlspecialchars($this->input->post('nama_lengkap', TRUE)),
            'email'         => htmlspecialchars($this->input->post('email', TRUE)),
            'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        ];

        $this->Model_admin->tambahUser($data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success solid alert-dismissible fade show">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                Data berhasil disimpan!
            </div>'
        );
        redirect('admin/user');
    }

    public function edit_user($id_user)
    {
        $data = [
            'id_user'       => $this->input->post('id_user'),
            'id_role'       => $this->input->post('id_role', TRUE),
            'nama_lengkap'  => $this->input->post('nama_lengkap', TRUE),
            'email'         => $this->input->post('email', TRUE),
        ];

        $this->Model_admin->editUser($id_user, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-warning solid alert-dismissible fade show">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                Data berhasil diubah!
            </div>'
        );
        redirect('admin/user');
    }

    public function hapus_user($id_user)
    {
        $this->Model_admin->hapusUser($id_user);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-danger solid alert-dismissible fade show">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                Data berhasil dihapus!
            </div>'
        );
        redirect('admin/user');
    }
    // END USER


    // START PROFILE
    public function profile()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'         => 'Data Profile',
            'user'          => $this->Model_admin->getUserById($id_user),
            'notifikasi'    => $this->Model_admin->getNotifikasiChechout(),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/profile');
        $this->load->view('templates/admin/footer');
    }

    public function edit_profile()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'nama_lengkap'  => htmlspecialchars($this->input->post('nama_lengkap', TRUE)),
            'email'         => htmlspecialchars($this->input->post('email', TRUE)),
            'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        ];

        $this->Model_admin->editProfile($id_user, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-warning solid alert-dismissible fade show">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                Data berhasil diubah!
            </div>'
        );
        redirect('admin/profile');
    }
    // END PROFILE
}

/* End of file Admin.php */
