<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
        
        $id_user    = $this->session->userdata('id_user');
        $kategori   = $this->Model_user->getAllKategori();

        $data = [
            'title'     => 'Home',
            'id_user'   => $id_user,
            'cekItem'   => $this->Model_user->getJumlahItemKeranjang($id_user),
            'alat'      => $this->Model_user->getAllAlat(),
            'kategori'  => $kategori,
        ];

        foreach ($kategori as $kat) {
            $data[$kat['nama_kategori']] = $this->Model_user->getAlatByKategori($kat['nama_kategori']);
        }

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/home');
        $this->load->view('templates/user/footer');
    }

    // public function detail($id_alat)
    // {
    //     $id_user = $this->session->userdata('id_user');

    //     $data = [
    //         'title'     => 'Detail',
    //         'id_user'   => $id_user,
    //         'alat'      => $this->Model_user->getAlatById($id_alat),
    //         'cekItem'   => $this->Model_user->getJumlahItemKeranjang($id_user),
    //     ];

    //     $this->load->view('templates/user/header', $data);
    //     $this->load->view('templates/user/navbar');
    //     $this->load->view('user/detail');
    //     $this->load->view('templates/user/footer');
    // }

    // public function detail($id_alat)
    // {
    //     $id_user = $this->session->userdata('id_user');

    //     $tanggalDisewa = $this->Model_user->getTanggalDisewa($id_alat);

    //     $data = [
    //         'title'         => 'Detail',
    //         'id_user'       => $id_user,
    //         'alat'          => $this->Model_user->getAlatById($id_alat),
    //         'cekItem'       => $this->Model_user->getJumlahItemKeranjang($id_user),
    //         'tanggalDisewa' => $tanggalDisewa,
    //     ];

    //     $this->load->view('templates/user/header', $data);
    //     $this->load->view('templates/user/navbar');
    //     $this->load->view('user/detail', $data);
    //     $this->load->view('templates/user/footer');
    // }

    public function detail($id_alat)
    {
        $id_user = $this->session->userdata('id_user');

        $tanggalDisewa  = $this->Model_user->getTanggalDisewa($id_alat);

        $data = [
            'title'         => 'Detail',
            'id_user'       => $id_user,
            'alat'          => $this->Model_user->getAlatById($id_alat),
            'cekItem'       => $this->Model_user->getJumlahItemKeranjang($id_user),
            'tanggalDisewa' => $tanggalDisewa,
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/detail', $data);
        $this->load->view('templates/user/footer');
    }

    public function home()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Home',
            'id_user'   => $id_user,
            'cekItem'   => $this->Model_user->getJumlahItemKeranjang($id_user),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/home.php');
        $this->load->view('templates/user/footer');
    }
    public function tentangKami()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Tentang Kami',
            'id_user'   => $id_user,
            'cekItem'   => $this->Model_user->getJumlahItemKeranjang($id_user),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/tentang_kami.php');
        $this->load->view('templates/user/footer');
    }
    public function equipment()
    {
        $id_user = $this->session->userdata('id_user');

        $kategori   = $this->Model_user->getAllKategori();

        $data = [
            'title'     => 'Equipment',
            'id_user'   => $id_user,
            'cekItem'   => $this->Model_user->getJumlahItemKeranjang($id_user),
            'alat'      => $this->Model_user->getAllAlat(),
            'kategori'  => $kategori,
        ];

        foreach ($kategori as $kat) {
            $data[$kat['nama_kategori']] = $this->Model_user->getAlatByKategori($kat['nama_kategori']);
        }

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/equipment.php');
        $this->load->view('templates/user/footer');
    }

    public function kontak()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Kontak',
            'id_user'   => $id_user,
            'cekItem'   => $this->Model_user->getJumlahItemKeranjang($id_user),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/kontak');
        $this->load->view('templates/user/footer');
    }
    public function faq()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'FAQ',
            'id_user'   => $id_user,
            'cekItem'   => $this->Model_user->getJumlahItemKeranjang($id_user),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/faq');
        $this->load->view('templates/user/footer');
    }

    public function cetak_nota($id_penyewaan)
    {
        $data = [
            'penyewaan'         => $this->Model_user->getPenyewaan($id_penyewaan),
            'penyewaan_detail'  => $this->Model_user->getDetailPenyewaanByIdPenyewaan($id_penyewaan),
        ];

        $this->load->view('user/nota', $data);
    }

    public function profile()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Kontak',
            'id_user'   => $id_user,
            'cekItem'   => $this->Model_user->getJumlahItemKeranjang($id_user),
            'user'      => $this->Model_user->getUserById($id_user),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/profile');
        $this->load->view('templates/user/footer');
    }

    public function edit_profile()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'email'        => $this->input->post('email'),
            'password'     => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
        ];

        $this->Model_user->updateUser($id_user, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Profile berhasil diedit.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );

        redirect('profile');
    }

    public function cart()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Cart',
            'id_user'   => $id_user,
            'cekItem'   => $this->Model_user->getJumlahItemKeranjang($id_user),
            'cart'      => $this->Model_user->getKeranjangByIdUser($id_user),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/cart');
        $this->load->view('templates/user/footer');
    }

    // FUNGSI TAMBAH ITEM KE KERANJANG
    public function addToCart($id_alat)
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

        // Periksa apakah alat sudah ada di keranjang
        $item = $this->Model_user->getKeranjang($id_user, $id_alat);

        if ($item) {
            $data = [
                'jumlah' => $item->jumlah + 1
            ];

            $this->Model_user->updateKeranjang($id_user, $id_alat, $data);
        } else {
            $data = [
                'id_user'   => $id_user,
                'id_alat'   => $id_alat,
                'jumlah'    => 1,
            ];

            $this->Model_user->tambahKeKeranjang($data);
        }

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Berhasil menambahkan ke keranjang.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );

        redirect('detail/' . $id_alat);
    }

    // FUNGSI EDIT JUMLAH ITEM DI KERANJANG
    public function edit($id_keranjang)
    {
        $data = [
            'id_keranjang'  => $this->input->post('id_keranjang'),
            'jumlah'        => $this->input->post('jumlah'),
        ];

        $this->Model_user->updateJumlahPadaKeranjang($id_keranjang, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Jumlah berhasil diubah!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'
        );

        redirect('cart');
    }


    // FUNGSI HAPUS ITEM DI KERANJANG
    public function hapus($id_keranjang)
    {
        $this->Model_user->hapusItemPadaKeranjang($id_keranjang);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Item berhasil dihapus.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );

        redirect('cart');
    }

    // public function perpanjang_sewa($id_penyewaan) {
    //     $id_penyewaan = $this->input->post('id_penyewaan');
    //     $tanggal_kembali = $this->input->post('tanggal_kembali');
    
    //     // Validasi input
    //     if (empty($id_penyewaan) || empty($tanggal_kembali)) {
    //         echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
    //         return;
    //     }
    
    //     // Update tanggal kembali
    //     $this->load->model('Model_user');
    //     $result = $this->Model_user->update_tanggal_kembali($id_penyewaan, $tanggal_kembali);
    
    //     if ($result) {
    //         echo json_encode(['success' => true]);
    //     } else {
    //         echo json_encode(['success' => false, 'message' => 'Gagal memperpanjang sewa']);
    //     }
    // }    

    public function perpanjang_sewa() 
    {
        $id_penyewaan = $this->input->post('id_penyewaan');
        $tanggal_kembali = $this->input->post('tanggal_kembali');
        
        // Membuat array data di controller
        $data = [
            'tanggal_kembali' => $tanggal_kembali,
        ];
    
        // Panggil model untuk memperbarui tanggal kembali dengan array data
        $this->Model_user->update_tanggal_kembali($id_penyewaan, $data);
    
        // Set flash message dan redirect
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Tanggal sewa berhasil diperpanjang.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );
    
        redirect('transaksi');
    }
       

    public function checkout()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Checkout',
            'id_user'   => $id_user,
            'cekItem'   => $this->Model_user->getJumlahItemKeranjang($id_user),
            'cart'      => $this->Model_user->getKeranjangByIdUser($id_user),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/checkout');
        $this->load->view('templates/user/footer');
    }

    public function checkout_penyewaan()
    {
    $id_user    = $this->session->userdata('id_user');
    $nama_user  = $this->session->userdata('nama_lengkap');
    $email_user = $this->session->userdata('email');

    // Ambil tanggal sewa dan kembali, hitung jumlah hari sewa
    $tanggal_sewa       = new DateTime($this->input->post('tanggal_sewa'));
    $tanggal_kembali    = new DateTime($this->input->post('tanggal_kembali'));
    $jumlah_hari        = $tanggal_sewa->diff($tanggal_kembali)->days + 1;

    // Cek apakah tanggal sewa sudah lewat
    $tanggal_sekarang = new DateTime();
    $tanggal_sekarang->setTime(0, 0); // Set jam ke 00:00 untuk hanya membandingkan tanggal

    if ($tanggal_sewa < $tanggal_sekarang) {
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Checkout Gagal!</strong> Mohon pilih tanggal sewa yang berlaku mulai dari hari ini atau tanggal yang akan datang.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        redirect('checkout');
        return;
    }

    // Ambil keranjang belanja user dan inisialisasi sub_total
    $cart       = $this->Model_user->getKeranjangByIdUser($id_user);
    $sub_total  = 0;

    // Periksa stok tersedia dan hitung sub_total
    $stok_tidak_tersedia    = array_filter($cart, function ($item) use (&$sub_total, $jumlah_hari) {
        $stok_tersedia      = $item['stok_tersedia'];
        if ($stok_tersedia < $item['jumlah']) {
            return true;
        }
        $sub_total += $item['jumlah'] * $item['harga_sewa'] * $jumlah_hari;
        return false;
    });

    if ($stok_tidak_tersedia) {
        $pesan = '<strong>Checkout Gagal!</strong> <ol>';
        foreach ($stok_tidak_tersedia as $barang) {
            if ($barang['stok_tersedia'] == 0) {
                $pesan .= '<li>' . htmlspecialchars($barang['nama_alat'], ENT_QUOTES, 'UTF-8') . ' - Stok barang tidak tersedia</li>';
            } else {
                $stok_tersedia = min($barang['stok_tersedia'], $barang['jumlah']);
                $pesan .= '<li>' . htmlspecialchars($barang['nama_alat'], ENT_QUOTES, 'UTF-8') . ' - Stok yang tersedia hanya ' . htmlspecialchars($stok_tersedia, ENT_QUOTES, 'UTF-8') . '</li>';
            }
        }
        $pesan .= '</ol>';
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $pesan . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        redirect('checkout');
        return;
    }

    date_default_timezone_set('Asia/Jakarta');

    $tanggal_checkout = new DateTime();
    $metode_pembayaran = strtolower($this->input->post('metode_pembayaran'));

    if ($metode_pembayaran == 'transfer') {
        $tanggal_checkout->modify('+10 minutes');
    }

    $batas_waktu_upload = $tanggal_checkout->format('Y-m-d H:i:s');

    // Simpan data penyewaan tanpa kode penyewaan terlebih dahulu
    $data = [
        'id_user'               => $id_user,
        'tanggal_sewa'          => $this->input->post('tanggal_sewa'),
        'tanggal_kembali'       => $this->input->post('tanggal_kembali'),
        'no_telp'               => $this->input->post('no_telp'),
        'metode_pembayaran'     => $this->input->post('metode_pembayaran'),
        'opsi_pembayaran'       => $this->input->post('opsi_pembayaran'),
        'sub_total'             => $sub_total,
        'status_pembayaran'     => 'belum dibayar',
        'status_pelunasan'      => 'belum lunas',
        'status_penyewaan'      => 'pending',
        'tanggal_checkout'      => date('Y-m-d H:i:s'),
        'batas_waktu_upload'    => $batas_waktu_upload,
    ];

    $this->Model_user->tambahPenyewaan($data);

    // Ambil ID penyewaan yang baru
    $id_penyewaan = $this->db->insert_id();

    // Buat kode penyewaan dengan menambahkan id_penyewaan ke tanggal
    $kode_penyewaan = date('dmY') . $id_penyewaan;

    // Update kode_penyewaan di database
    $this->Model_user->updatePenyewaan($id_penyewaan, ['kode_penyewaan' => $kode_penyewaan]);

    // Tambahkan detail penyewaan
    $rincian_pemesanan = '';
    foreach ($cart as $item) {
        $this->Model_user->tambahPenyewaanDetail([
            'id_penyewaan'  => $id_penyewaan,
            'id_alat'       => $item['id_alat'],
            'jumlah'        => $item['jumlah']
        ]);

        $rincian_pemesanan .= $item['nama_alat'] . ' - Jumlah: ' . $item['jumlah'] . ', Harga Sewa: ' . $item['harga_sewa'] . '<br>';
    }

    $this->Model_user->hapusCart($id_user);

    $tanggalSewa        = tanggalIndonesia($this->input->post('tanggal_sewa'));
    $tanggalKembali     = tanggalIndonesia($this->input->post('tanggal_kembali'));
    $metodePembayaran   = strtolower($this->input->post('metode_pembayaran'));

    if ($metodePembayaran === 'cash') {
        $pesanPembayaran = 'Silahkan melakukan pembayaran dengan cara datang langsung ke Toko kami pada Tanggal: ' . $tanggalSewa . '<br><br>';
    } else {
        $pesanPembayaran = 'Silahkan melakukan pembayaran dalam waktu 24 jam<br><br>';
    }

    $this->email->from('pepy.10520114@mahasiswa.unikom.ac.id', 'PT. MEZZO KREASI UTAMA');
    $this->email->to([$data['email']]);
    $this->email->subject('Penyewaan Baru');
    $this->email->message(
        'Halo ' . $nama_user . ',<br><br>' .
            'Terima kasih telah melakukan penyewaan. Berikut adalah detail penyewaan Anda:<br><br>' .
            'Kode Penyewaan: ' . $kode_penyewaan . '<br>' .
            'Tanggal Sewa: ' . $tanggalSewa . '<br>' .
            'Tanggal Kembali: ' . $tanggalKembali . '<br>' .
            'Metode Pembayaran: ' . ucwords($this->input->post('metode_pembayaran')) . '<br>' .
            'Opsi Pembayaran: ' . ucwords($this->input->post('opsi_pembayaran')) . '<br>' .
            'Total Biaya: Rp ' . number_format($sub_total, 2, ',', '.') . '<br><br>' .
            'Rincian Pemesanan:<br>' . $rincian_pemesanan . '<br>' .
            $pesanPembayaran .
            'Salam,<br>' .
            'PT KREASI MEZZO UTAMA'
    );

    if ($this->email->send()) {
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Checkout berhasil, silahkan melakukan pembayaran.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    } else {
        $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Checkout berhasil, tetapi gagal mengirim email ke Anda.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    $this->session->set_flashdata('batas_waktu_upload', $batas_waktu_upload);
    redirect('pembayaran/' . $id_penyewaan);
}


    public function pembatalan_otomatis()
    {
        $id_penyewaan   = $this->input->post('id_penyewaan');
        $data_pesanan   = ['status_pembayaran' => 'dibatalkan'];

        $this->Model_user->updatePenyewaan($id_penyewaan, $data_pesanan);

        // $data_pembatalan = ['id_penyewaan' => $id_penyewaan,];
        // $this->Model_user->addPembatalanPesanan($data_pembatalan);

        // $data_detail = ['id_penyewaan' => $id_penyewaan,];
        // $this->Model_user->hapusPenyewaanDetail($id_penyewaan, $data_detail);
    }

    // public function pembayaran($id_penyewaan)
    // {
    //     $id_user = $this->session->userdata('id_user');

    //     $penyewaan  = $this->Model_user->getDetailPenyewaanByIdPenyewaan($id_penyewaan);
    //     $transaksi  = $this->Model_user->getTransaksiByIdPenyewaan($id_penyewaan);

    //     $data = [
    //         'title'                     => 'Pembayaran',
    //         'id_user'                   => $id_user,
    //         'cekItem'                   => $this->Model_user->getJumlahItemKeranjang($id_user),
    //         'penyewaan'                 => $penyewaan,
    //         'bukti_transfer_lunas'      => $transaksi ? $transaksi['bukti_transfer_lunas'] : null,
    //         'bukti_transfer_dp_awal'    => $transaksi ? $transaksi['bukti_transfer_dp_awal'] : null,
    //         'bukti_transfer_dp_akhir'   => $transaksi ? $transaksi['bukti_transfer_dp_akhir'] : null,
    //         'id_transaksi'              => $transaksi ? $transaksi['id_transaksi'] : null,
    //         'data'                      => $penyewaan
    //     ];

    //     $this->load->view('templates/user/header', $data);
    //     $this->load->view('templates/user/navbar');
    //     $this->load->view('user/pembayaran', $data);
    //     $this->load->view('templates/user/footer');
    // }

    public function pembayaran($id_penyewaan)
    {
        $id_user = $this->session->userdata('id_user');

        $penyewaan = $this->Model_user->getPenyewaanByIdPenyewaan($id_penyewaan);
        $transaksi = $this->Model_user->getTransaksiByIdPenyewaan($id_penyewaan);

        $data = [
            'title'                     => 'Pembayaran',
            'id_user'                   => $id_user,
            'cekItem'                   => $this->Model_user->getJumlahItemKeranjang($id_user),
            'penyewaan'                 => $penyewaan,
            'bukti_transfer_lunas'      => $transaksi['bukti_transfer_lunas'] ?? null,
            'bukti_transfer_dp_awal'    => $transaksi['bukti_transfer_dp_awal'] ?? null,
            'bukti_transfer_dp_akhir'   => $transaksi['bukti_transfer_dp_akhir'] ?? null,
            'id_transaksi'              => $transaksi['id_transaksi'] ?? null
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/pembayaran', $data);
        $this->load->view('templates/user/footer');
    }


    // FUNGSI UPLOAD BUKTI TRANSFER LUNAS
    public function transfer_lunas()
    {
        $config['upload_path']      = './assets/images/bukti_transfer/lunas/';
        $config['allowed_types']    = 'gif|jpg|jpeg|png';
        $config['max_size']         = 2048;

        $this->load->library('upload', $config);

        $id_penyewaan     = $this->input->post('id_penyewaan');
        $id_transaksi   = $this->input->post('id_transaksi');

        if ($id_transaksi) {
            $transaksi              = $this->Model_user->getTransaksiById($id_transaksi);
            $bukti_transfer_lama    = $transaksi['bukti_transfer_lunas'];
            $path_file_lama         = './assets/images/bukti_transfer/lunas/' . $bukti_transfer_lama;

            if ($bukti_transfer_lama && file_exists($path_file_lama)) {
                unlink($path_file_lama);
            }
        }

        if (!$this->upload->do_upload('bukti_transfer_lunas')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
            redirect('pembayaran');
        } else {
            $upload_foto    = $this->upload->data();
            $transfer_lunas = $upload_foto['file_name'];

            $data = [
                'id_penyewaan'              => $id_penyewaan,
                'bukti_transfer_lunas'      => $transfer_lunas,
                'bukti_transfer_dp_awal'    => null,
                'bukti_transfer_dp_akhir'   => null,
                'tgl_transfer_lunas'        => date('Y-m-d'),
                'tgl_transfer_dp_awal'      => null,
                'tgl_transfer_dp_akhir'     => null,
            ];

            if ($id_transaksi) {
                $this->Model_user->updateTransaksi($id_transaksi, $data);
            } else {
                $this->Model_user->addTransaksi($data);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Bukti transfer lunas berhasil diupload!</div>');
            redirect('transaksi');
        }
    }

    // FUNGSI UPLOAD BUKTI TRANSFER DP AWAL
    public function transfer_dp_awal()
    {
        $config['upload_path']      = './assets/images/bukti_transfer/dp_awal/';
        $config['allowed_types']    = 'gif|jpg|jpeg|png';
        $config['max_size']         = 2048;

        $this->load->library('upload', $config);

        $id_penyewaan   = $this->input->post('id_penyewaan');
        $id_transaksi   = $this->input->post('id_transaksi');

        if ($id_transaksi) {
            $transaksi              = $this->Model_user->getTransaksiById($id_transaksi);
            $bukti_transfer_lama    = $transaksi['bukti_transfer_dp_awal'];
            $path_file_lama         = './assets/images/bukti_transfer/dp_awal/' . $bukti_transfer_lama;

            if ($bukti_transfer_lama && file_exists($path_file_lama)) {
                unlink($path_file_lama);
            }
        }

        if (!$this->upload->do_upload('bukti_transfer_dp_awal')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
            redirect('pembayaran');
        } else {
            $upload_foto        = $this->upload->data();
            $transfer_dp_awal   = $upload_foto['file_name'];

            $data = [
                'id_penyewaan'              => $id_penyewaan,
                'bukti_transfer_lunas'      => null,
                'bukti_transfer_dp_awal'    => $transfer_dp_awal,
                'tgl_transfer_dp_awal'      => date('Y-m-d'),
            ];

            if ($id_transaksi) {
                $transaksi = $this->Model_user->getTransaksiById($id_transaksi);
                $data['bukti_transfer_dp_akhir']    = $transaksi['bukti_transfer_dp_akhir'];
                $data['tgl_transfer_dp_akhir']      = $transaksi['tgl_transfer_dp_akhir'];

                $this->Model_user->updateTransaksi($id_transaksi, $data);
            } else {
                $this->Model_user->addTransaksi($data);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Bukti DP Awal berhasil diupload!</div>');
            redirect('transaksi');
        }
    }

    // FUNGSI UPLOAD BUKTI TRANSFER DP AKHIR
    public function transfer_dp_akhir()
    {
        $config['upload_path']      = './assets/images/bukti_transfer/dp_akhir/';
        $config['allowed_types']    = 'gif|jpg|jpeg|png';
        $config['max_size']         = 2048;

        $this->load->library('upload', $config);

        $id_penyewaan   = $this->input->post('id_penyewaan');
        $id_transaksi   = $this->input->post('id_transaksi');

        if ($id_transaksi) {
            $transaksi              = $this->Model_user->getTransaksiById($id_transaksi);
            $bukti_transfer_lama    = $transaksi['bukti_transfer_dp_akhir'];
            $path_file_lama         = './assets/images/bukti_transfer/dp_akhir/' . $bukti_transfer_lama;

            if ($bukti_transfer_lama && file_exists($path_file_lama)) {
                unlink($path_file_lama);
            }
        }

        if (!$this->upload->do_upload('bukti_transfer_dp_akhir')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
            redirect('pembayaran');
        } else {
            $upload_foto        = $this->upload->data();
            $transfer_dp_akhir  = $upload_foto['file_name'];

            $data = [
                'id_penyewaan'              => $id_penyewaan,
                'bukti_transfer_dp_akhir'   => $transfer_dp_akhir,
                'bukti_transfer_lunas'      => null,
                'tgl_transfer_dp_akhir'     => date('Y-m-d'),
                'tgl_transfer_lunas'        => null,
            ];

            if ($id_transaksi) {
                $this->Model_user->updateTransaksi($id_transaksi, $data);
            } else {
                $this->Model_user->addTransaksi($data);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Bukti DP Akhir berhasil diupload!</div>');
            redirect('transaksi');
        }
    }

    // VIEW TRANSAKSI
    public function transaksi()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Transaksi',
            'id_user'   => $id_user,
            'cekItem'   => $this->Model_user->getJumlahItemKeranjang($id_user),
            'penyewaan' => $this->Model_user->getPenyewaanByUserId($id_user),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/transaksi');
        $this->load->view('templates/user/footer');
    }

    // FUNGSI HAPUS TRANSAKSI
    public function hapus_transaksi($id_penyewaan)
    {
        $this->Model_user->hapustransaksi($id_penyewaan);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Data transaksi berhasil dihapus!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'
        );

        redirect('transaksi');
    }

    // VIEW DETAIL PENYEWAAN
    public function detail_penyewaan($id_penyewaan)
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Detail Penyewaan',
            'id_user'   => $id_user,
            'cekItem'   => $this->Model_user->getJumlahItemKeranjang($id_user),
            'penyewaan' => $this->Model_user->getDetailPenyewaanByIdPenyewaan($id_penyewaan),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/navbar');
        $this->load->view('user/detail_penyewaan');
        $this->load->view('templates/user/footer');
    }
}

/* End of file User.php */
