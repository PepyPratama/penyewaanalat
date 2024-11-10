<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_owner extends CI_Model
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

    public function getAllPembelian()
    {
        return $this->db->order_by('kode_pembelian', 'DESC')->get('tbl_pembelian')->result_array();
    }

    // GET ALL DATA
    public function getAllDetailPembelian()
    {
        return $this->db->order_by('id_pembelian', 'DESC')->get('tbl_pembelian')->result_array();
    }


    public function getAllKategoriAlat()
    {
        return $this->db->order_by('nama_kategori', 'ASC')->get('tbl_kategori_alat')->result_array();
    }

    public function getAllAlat()
    {
        $this->db->join('tbl_kategori_alat AS k', 'k.id_kategori_alat = a.id_kategori_alat', 'INNER');
        $this->db->join('tbl_pembelian AS p', 'p.id_pembelian = a.id_pembelian', 'INNER');
        $this->db->order_by('p.nama_alat', 'ASC');
        return $this->db->get('tbl_alat AS a')->result_array();
    }

    public function getAllAlatRusak()
    {
        $this->db->join('tbl_kategori_alat AS k', 'k.id_kategori_alat = a.id_kategori_alat', 'INNER');
        $this->db->join('tbl_pembelian AS p', 'p.id_pembelian = a.id_pembelian', 'INNER');
        $this->db->where('a.stok_rusak >', 0);
        $this->db->order_by('p.nama_alat', 'ASC');
        return $this->db->get('tbl_alat AS a')->result_array();
    }

    // public function getAllPenyewaan()
    // {
    //     $this->db->join('tbl_user AS u', 'u.id_user = p.id_user', 'INNER');
    //     $this->db->join('tbl_penyewaan_detail AS pd', 'pd.id_penyewaan = p.id_penyewaan', 'LEFT');
    //     $this->db->join('tbl_alat AS a', 'a.id_alat = pd.id_alat', 'INNER');
    //     $this->db->join('tbl_pembelian AS pb', 'pb.id_pembelian = a.id_pembelian', 'INNER');
    //     return $this->db->get('tbl_penyewaan AS p')->result_array();
    // }

    public function getAllPenyewaan()
    {
        $this->db->select('p.*, u.nama_lengkap');
        $this->db->join('tbl_user AS u', 'u.id_user = p.id_user', 'INNER');
        $penyewaan = $this->db->get('tbl_penyewaan AS p')->result_array();

        foreach ($penyewaan as &$item) {
            $this->db->select('pb.nama_alat, pd.jumlah, a.no_seri');
            $this->db->join('tbl_alat AS a', 'a.id_alat = pd.id_alat', 'INNER');
            $this->db->join('tbl_pembelian AS pb', 'pb.id_pembelian = a.id_pembelian', 'INNER');
            $this->db->where('pd.id_penyewaan', $item['id_penyewaan']);
            $item['details'] = $this->db->get('tbl_penyewaan_detail AS pd')->result_array();
        }

        return $penyewaan;
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

    public function getAlatById($id_alat)
    {
        return $this->db->get_where('tbl_alat', ['id_alat' => $id_alat])->row_array();
    }

    public function getPenyewaanById($id_penyewaan)
    {
        return $this->db->get_where('tbl_penyewaan', ['id_penyewaan' => $id_penyewaan])->row_array();
    }

    public function getPenyewaanDetailByIdPenyewaan($id_penyewaan)
    {
        return $this->db->get_where('tbl_penyewaan_detail', ['id_penyewaan' => $id_penyewaan])->result_array();
    }

    public function getUserById($id_user)
    {
        $this->db->where('user.id_user', $id_user);
        $this->db->join('tbl_user_role AS user_role', 'user_role.id_role = user.id_role', 'INNER');
        return $this->db->get('tbl_user AS user')->row_array();
    }

    public function getIdAlatByNamaAlat($nama_alat)
    {
        $this->db->select('tbl_alat.id_alat');
        $this->db->from('tbl_pembelian');
        $this->db->join('tbl_alat', 'tbl_pembelian.id_pembelian = tbl_alat.id_pembelian');
        $this->db->where('tbl_pembelian.nama_alat', $nama_alat);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->id_alat;
        }

        return null;
    }



    // EDIT DATA
    public function editPembelian($id_pembelian, $data)
    {
        $this->db->where('id_pembelian', $id_pembelian)->update('tbl_pembelian', $data);
    }

    public function updateStok($id_alat, $jumlah_pembelian, $operation = '+')
    {
        if (empty($id_alat) || !is_numeric($jumlah_pembelian) || $jumlah_pembelian <= 0 || !in_array($operation, ['+', '-'])) {
            return;
        }

        // Update stok keseluruhan dan stok tersedia
        $this->db->set('stok_keseluruhan', 'stok_keseluruhan ' . $operation . ' ' . (int)$jumlah_pembelian, FALSE);
        $this->db->set('stok_tersedia', 'stok_tersedia ' . $operation . ' ' . (int)$jumlah_pembelian, FALSE);
        $this->db->where('id_alat', $id_alat);
        $this->db->update('tbl_alat');

        if ($this->db->affected_rows() == 0) {
            log_message('error', 'Gagal memperbarui stok untuk ID alat: ' . $id_alat);
        }
    }

    // FILTER DATA
    public function filterPenyewaan($tanggal_awal, $tanggal_akhir, $opsi_pembayaran = null, $status_penyewaan = null)
{
    $this->db->select('*');
    $this->db->from('tbl_penyewaan as p');
    $this->db->where('tanggal_sewa >=', $tanggal_awal);
    $this->db->where('tanggal_sewa <=', $tanggal_akhir . ' 23:59:59');
    $this->db->where('status_pelunasan', 'sudah lunas');
    if ($opsi_pembayaran) {
        $this->db->where('opsi_pembayaran', $opsi_pembayaran);
    }
    if ($status_penyewaan) {
        $this->db->where('status_penyewaan', $status_penyewaan);
    }
    $this->db->join('tbl_user AS u', 'u.id_user = p.id_user', 'INNER');
    $this->db->order_by('tanggal_sewa', 'ASC');
    $query = $this->db->get();

    return $query->result_array();
}


public function getRingkasanAlat($penyewaan_ids)
{
    if (empty($penyewaan_ids)) {
        // Jika tidak ada ID penyewaan, kembalikan array kosong
        return [];
    }

    // Ubah array ID penyewaan menjadi format string untuk query SQL
    $ids = implode(',', $penyewaan_ids);

    // Query SQL dengan perbaikan
    $this->db->select('p.nama_alat, SUM(pd.jumlah) as total_disewa');
    $this->db->from('tbl_penyewaan_detail as pd');
    $this->db->join('tbl_alat as a', 'a.id_alat = pd.id_alat', 'INNER');
    $this->db->join('tbl_pembelian as p', 'p.id_pembelian = a.id_pembelian', 'INNER');
    $this->db->where_in('pd.id_penyewaan', $penyewaan_ids); // Menggunakan where_in() dengan array ID
    $this->db->group_by('p.nama_alat');
    $this->db->order_by('total_disewa', 'DESC');
    $this->db->limit(1);
    
    $query = $this->db->get();
    return $query->result_array();
}

}

/* End of file Model_owner.php */
