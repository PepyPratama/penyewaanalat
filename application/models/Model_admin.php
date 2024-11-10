<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_admin extends CI_Model
{
    // GET DATA ATAU AMBIL DATA
    public function getTotalPembelian()
    {
        return $this->db->count_all('tbl_pembelian');
    }

    public function getTotalAlat()
    {
        return $this->db->count_all('tbl_alat');
    }

    public function getTotalPenyewaan()
    {
        return $this->db->count_all('tbl_penyewaan');
    }

    public function getTotalTransaksi()
    {
        return $this->db->count_all('tbl_transaksi');
    }

    public function getNotifikasiChechout()
    {
        $this->db->select('p.id_penyewaan, u.nama_lengkap, p.tanggal_checkout');
        $this->db->from('tbl_penyewaan p');
        $this->db->join('tbl_user u', 'u.id_user = p.id_user', 'INNER');
        $this->db->order_by('p.tanggal_checkout', 'DESC');
        $this->db->limit(10);
        return $this->db->get()->result_array();
    }


    // CEK DATA
    public function cekAlat($id_pembelian)
    {
        $this->db->where('id_pembelian', $id_pembelian);
        $query = $this->db->get('tbl_alat');
        return $query->num_rows() > 0;
    }



    // GET ALL DATA
    public function getAllPembelian()
    {
        return $this->db->order_by('id_pembelian', 'DESC')->get('tbl_pembelian')->result_array();
    }

    public function getAllPembelianByStatusDiSetujui()
    {
        $this->db->order_by('p.nama_alat', 'ASC');
        $this->db->where('p.status', 'disetujui');
        $this->db->where('p.jenis_pembelian', 'alat baru');
        return $this->db->get('tbl_pembelian AS p')->result_array();
    }

    public function getAllKategoriAlat()
    {
        return $this->db->order_by('nama_kategori', 'ASC')->get('tbl_kategori_alat')->result_array();
    }

    public function getAllAlat()
    {
        $this->db->join('tbl_kategori_alat AS k', 'k.id_kategori_alat = a.id_kategori_alat', 'INNER');
        $this->db->join('tbl_pembelian AS p', 'p.id_pembelian = a.id_pembelian', 'INNER');
        $this->db->order_by('p.kode_pembelian', 'DESC');
        return $this->db->get('tbl_alat AS a')->result_array();
    }

    public function getAllPenyewaan()
    {
        $this->db->order_by('p.id_penyewaan', 'DESC');
        $this->db->join('tbl_user AS u', 'u.id_user = p.id_user', 'INNER');
        return $this->db->order_by('p.id_penyewaan', 'DESC')->get('tbl_penyewaan AS p')->result_array();
    }

    public function getAllDetailPenyewaan()
    {
        $this->db->join('tbl_penyewaan AS p', 'p.id_penyewaan = ps.id_penyewaan', 'INNER');
        $this->db->join('tbl_alat AS a', 'a.id_alat = ps.id_alat', 'INNER');
        $this->db->join('tbl_pembelian AS pb', 'pb.id_pembelian = a.id_pembelian', 'INNER');
        return $this->db->get('tbl_penyewaan_detail AS ps')->result_array();
    }

    public function getAllTransaksi()
    {
        $this->db->join('tbl_penyewaan AS p', 'p.id_penyewaan = t.id_penyewaan', 'INNER');
        $this->db->join('tbl_user AS u', 'u.id_user = p.id_user', 'INNER');
        return $this->db->get('tbl_transaksi AS t')->result_array();
    }

    public function getAllUser()
    {
        $this->db->join('tbl_user_role AS user_role', 'user_role.id_role = user.id_role', 'INNER');
        $this->db->order_by('user.nama_lengkap', 'ASC');
        return $this->db->get('tbl_user AS user')->result_array();
    }

    public function getAllRole()
    {
        return $this->db->order_by('role', 'ASC')->get('tbl_user_role')->result_array();
    }




    // GET DATA BY ID
    public function getPembelianById($id_pembelian)
    {
        return $this->db->get_where('tbl_pembelian', ['id_pembelian' => $id_pembelian])->row_array();
    }

    public function getDetailPembelian($id_pembelian)
    {
        return $this->db->get_where('tbl_pembelian', ['id_pembelian' => $id_pembelian])->row_array();
    }

    public function getAlatById($id_alat)
    {
        return $this->db->get_where('tbl_alat', ['id_alat' => $id_alat])->row_array();
    }

    public function getPenyewaanById($id_penyewaan)
    {
        // return $this->db->get_where('tbl_penyewaan', ['id_penyewaan' => $id_penyewaan])->row_array();


        $this->db->where('p.id_penyewaan', $id_penyewaan);
        $this->db->join('tbl_penyewaan_detail AS pd', 'pd.id_penyewaan = p.id_penyewaan', 'INNER');
        $this->db->join('tbl_transaksi AS t', 't.id_penyewaan = p.id_penyewaan', 'LEFT');
        $this->db->join('tbl_user AS u', 'u.id_user = p.id_user', 'INNER');
        // $this->db->order_by('p.nama_alat', 'ASC');
        return $this->db->get('tbl_penyewaan AS p')->row_array();
    }

    public function getPenyewaanDetailByIdPenyewaan($id_penyewaan)
    {
        $this->db->where('ps.id_penyewaan', $id_penyewaan);
        $this->db->join('tbl_penyewaan AS p', 'p.id_penyewaan = ps.id_penyewaan', 'INNER');
        $this->db->join('tbl_alat AS a', 'a.id_alat = ps.id_alat', 'INNER');
        $this->db->join('tbl_pembelian AS pb', 'pb.id_pembelian = a.id_pembelian', 'INNER');
        return $this->db->get('tbl_penyewaan_detail AS ps')->result_array();
    }

    public function updateStatusPenyewaan($id_penyewaan, $status_baru)
    {
        $this->db->where('id_penyewaan', $id_penyewaan);
        $this->db->update('tbl_penyewaan', ['status_penyewaan' => $status_baru]);
    }


    // public function getUserById($id_user)
    // {
    //     return $this->db->get_where('tbl_user', ['id_user' => $id_user])->row_array();
    // }

    public function getUserById($id_user)
    {
        $this->db->where('user.id_user', $id_user);
        $this->db->join('tbl_user_role AS user_role', 'user_role.id_role = user.id_role', 'INNER');
        return $this->db->get('tbl_user AS user')->row_array();
    }

    public function getJumlahPembelianById($id_pembelian)
    {
        $this->db->select('jumlah_pembelian');
        $this->db->where('id_pembelian', $id_pembelian);
        $query = $this->db->get('tbl_pembelian'); // Ganti dengan tabel pembelian Anda
        if ($query->num_rows() > 0) {
            return $query->row()->jumlah_pembelian;
        } else {
            return 0; // ID pembelian tidak ditemukan
        }
    }
    
    // TAMBAH DATA
    public function tambahPembelian($data)
    {
        $this->db->insert('tbl_pembelian', $data);
        return $this->db->insert_id(); // Mengembalikan ID pembelian yang baru
    }

    public function tambahAlat($data)
    {
        $this->db->insert('tbl_alat', $data);
    }

    public function tambahKategoriAlat($data)
    {
        $this->db->insert('tbl_kategori_alat', $data);
    }

    public function tambahUser($data)
    {
        $this->db->insert('tbl_user', $data);
    }





    // EDIT DATA
    public function editPembelian($id_pembelian, $data)
    {
        $this->db->where('id_pembelian', $id_pembelian)->update('tbl_pembelian', $data);
    }

    public function editAlat($id_alat, $data)
    {
        $this->db->where('id_alat', $id_alat)->update('tbl_alat', $data);
    }

    public function editKategoriAlat($id_kategori_alat, $data)
    {
        $this->db->where('id_kategori_alat', $id_kategori_alat)->update('tbl_kategori_alat', $data);
    }

    public function updateStokAlat($id_alat, $jumlah)
    {
        $this->db->trans_start();

        $this->db->set('stok_tersedia', 'stok_tersedia - ' . $jumlah, FALSE);
        $this->db->where('id_alat', $id_alat);
        $this->db->update('tbl_alat');

        $this->db->set('stok_disewa', 'stok_disewa + ' . $jumlah, FALSE);
        $this->db->where('id_alat', $id_alat);
        $this->db->update('tbl_alat');

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function kembalikanStokAlat($id_alat, $jumlah_alat)
    {
        $this->db->trans_start();

        $this->db->set('stok_tersedia', 'stok_tersedia + ' . $jumlah_alat, FALSE);
        $this->db->where('id_alat', $id_alat);
        $this->db->update('tbl_alat');

        $this->db->set('stok_disewa', 'stok_disewa - ' . $jumlah_alat, FALSE);
        $this->db->where('id_alat', $id_alat);
        $this->db->update('tbl_alat');

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function editPenyewaan($id_penyewaan, $data)
    {
        $this->db->where('id_penyewaan', $id_penyewaan)->update('tbl_penyewaan', $data);
    }

    public function editUser($id_user, $data)
    {
        $this->db->where('id_user', $id_user)->update('tbl_user', $data);
    }

    public function editProfile($id_user, $data)
    {
        $this->db->where('id_user', $id_user)->update('tbl_user', $data);
    }

    public function updateKodePembelian($id_pembelian, $kode_pembelian)
    {
        $this->db->where('id_pembelian', $id_pembelian);
        $this->db->update('tbl_pembelian', ['kode_pembelian' => $kode_pembelian]);
    }






    // HAPUS DATA
    public function hapusPembelian($id_pembelian)
    {
        $this->db->delete('tbl_pembelian', ['id_pembelian' => $id_pembelian]);
    }

    public function hapusAlat($id_alat)
    {
        $this->db->delete('tbl_alat', ['id_alat' => $id_alat]);
    }

    public function hapusKategoriAlat($id_kategori_alat)
    {
        $this->db->delete('tbl_alat', ['id_kategori_alat' => $id_kategori_alat]);
        $this->db->delete('tbl_kategori_alat', ['id_kategori_alat' => $id_kategori_alat]);
    }

    public function hapusPenyewaan($id_penyewaan)
    {
        // // Ambil detail penyewaan
        // $penyewaan_details = $this->db->get_where('tbl_penyewaan_detail', ['id_penyewaan' => $id_penyewaan])->result();

        // // Update stok untuk setiap alat yang disewa
        // foreach ($penyewaan_details as $detail) {
        //     $this->db->set('stok_tersedia', 'stok_tersedia + ' . $detail->jumlah_alat, FALSE);
        //     $this->db->set('stok_disewa', 'stok_disewa - ' . $detail->jumlah_alat, FALSE);
        //     $this->db->where('id_alat', $detail->id_alat);
        //     $this->db->update('tbl_alat');
        // }

        // Hapus data penyewaan
        $this->db->delete('tbl_penyewaan_detail', ['id_penyewaan' => $id_penyewaan]);
        $this->db->delete('tbl_transaksi', ['id_penyewaan' => $id_penyewaan]);
        $this->db->delete('tbl_penyewaan', ['id_penyewaan' => $id_penyewaan]);

        return TRUE;
    }

    public function hapusTransaksi($id_penyewaan)
    {
        $this->db->delete('tbl_transaksi', ['id_penyewaan' => $id_penyewaan]);
    }

    public function hapusUser($id_user)
    {
        $this->db->delete('tbl_user', ['id_user' => $id_user]);
    }
}

/* End of file Model_admin.php */
