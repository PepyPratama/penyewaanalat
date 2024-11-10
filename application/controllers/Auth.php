<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function login()
    {
        $this->validasiLogin();

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $email      = htmlspecialchars($this->input->post('email', TRUE));
            $password   = htmlspecialchars($this->input->post('password', TRUE));

            $user = $this->db->get_where('tbl_user', ['email' => $email])->row_array();

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'id_user'       => $user['id_user'],
                        'nama_lengkap'  => $user['nama_lengkap'],
                        'email'         => $user['email'],
                        'id_role'       => $user['id_role']
                    ];

                    $this->session->set_userdata($data);

                    // cek id_role
                    if ($user['id_role'] == 1) {
                        redirect('admin');
                    } elseif ($user['id_role'] == 2) {
                        redirect('owner');
                    } elseif ($user['id_role'] == 3) {
                        redirect('home');
                    } else {
                        redirect('home');
                    }
                } else {
                    $this->session->set_flashdata(
                        'pesan',
                        '<div class="alert alert-danger solid alert-dismissible fade show">
                            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                            </button><strong>Maaf, Password salah!</strong>
                        </div>'
                    );
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-danger solid alert-dismissible fade show">
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                        </button><strong>Email tidak terdaftar!</strong> Silahkan registrasi akun terlebih dahulu.
                    </div>'
                );
                redirect('login');
            }
        }
    }

    public function register()
    {
        $this->load->library('email');

        $this->validasiRegistrasi();

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
        } else {
            $data = [
                'nama_lengkap'  => htmlspecialchars($this->input->post('nama_lengkap', TRUE)),
                'email'         => htmlspecialchars($this->input->post('email', TRUE)),
                'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'id_role'       => 3
            ];

            $this->Model_auth->tambahData($data);

            $this->email->from('pepy.10520114@mahasiswa.unikom.ac.id', 'PT KREASI MEZZO UTAMA');
            $this->email->to($data['email']);
            $this->email->subject('Registrasi Berhasil');
            $this->email->message('Selamat! Akun Anda telah berhasil dibuat di PT KREASI MEZZO UTAMA.<br><br>Berikut adalah detail akun Anda:<br><br>Nama Lengkap: ' . $data['nama_lengkap'] . '<br>Email: ' . $data['email'] . '<br><br>Anda dapat menggunakan akun ini untuk melakukan penyewaan alat kami. Jika ada pertanyaan atau bantuan lebih lanjut, silakan hubungi kami melalui nomor telepon atau email yang tercantum di website.<br><br>Terima kasih telah mendaftar di PT KREASI MEZZO UTAMA. Kami berharap dapat memberikan layanan terbaik untuk Anda.<br><br>Salam,<br>Tim PT KREASI MEZZO UTAMA');

            if ($this->email->send()) {
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-success solid alert-dismissible fade show">
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                    <strong>Registrasi akun berhasil!</strong> Silahkan login.</div>'
                );
            } else {
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-danger solid alert-dismissible fade show">
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                    <strong>Registrasi akun berhasil!</strong> Tetapi gagal mengirim email.</div>'
                );
            }

            redirect('login');
        }
    }

    public function notFound()
    {
        $this->load->view('404');
    }

    public function logout()
    {
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('nama_lengkap');
        $this->session->unset_userdata('id_role');
        redirect('home');
    }

    // VALIDASI
    private function validasiLogin()
    {
        $this->form_validation->set_rules('email', 'email', 'required|trim', [
            'required'      => '%s belum diisi',
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]', [
            'required'      => '%s belum diisi',
            'min_length'    => '%s minimal 5 karakter'
        ]);
    }

    private function validasiRegistrasi()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tbl_user.email]', [
            'required'      => '%s belum diisi',
            'valid_email'   => '%s tidak valid',
            'is_unique'     => '%s sudah terdaftar'
        ]);

        $this->form_validation->set_rules('nama_lengkap', 'Nama lengkap', 'required|trim', [
            'required'      => '%s belum diisi'
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]', [
            'required'      => '%s belum diisi',
            'min_length'    => '%s minimal 5 karakter'
        ]);
    }
}

/* End of file Auth.php */
