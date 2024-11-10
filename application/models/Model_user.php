<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_user extends CI_Model
{
    // GET DATA
    public function getAllAlat()
    {
        $this->db->join('tbl_pembelian AS p', 'p.id_pembelian = a.id_pembelian', 'INNER');
        $this->db->join('tbl_kategori_alat AS k', 'k.id_kategori_alat = a.id_kategori_alat', 'INNER');
        return $this->db->get('tbl_alat AS a')->result_array();
    }

    public function getAlatById($id_alat)
    {
        $this->db->where('id_alat', $id_alat);
        $this->db->join('tbl_pembelian AS p', 'p.id_pembelian = a.id_pembelian', 'INNER');
        $this->db->join('tbl_kategori_alat AS k', 'k.id_kategori_alat = a.id_kategori_alat', 'INNER');
        return $this->db->get('tbl_alat AS a')->row_array();
    }

    public function getAlatByKategori($kategori)
    {
        $this->db->where('k.nama_kategori', $kategori);
        $this->db->join('tbl_kategori_alat AS k', 'k.id_kategori_alat = a.id_kategori_alat', 'INNER');
        $this->db->join('tbl_pembelian AS p', 'p.id_pembelian = a.id_pembelian', 'INNER');
        return $this->db->get('tbl_alat AS a')->result_array();
    }

    public function getAllKategori()
    {
        return $this->db->get('tbl_kategori_alat')->result_array();
    }

    public function getUserById($id_user)
    {
        return $this->db->get_where('tbl_user', ['id_user' => $id_user])->row_array();
    }

    public function getKeranjang($id_user, $id_alat)
    {
        return $this->db->get_where('tbl_keranjang', ['id_user' => $id_user, 'id_alat' => $id_alat])->row();
    }

    public function getKeranjangByIdUser($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->join('tbl_alat AS a', 'a.id_alat = k.id_alat', 'INNER');
        $this->db->join('tbl_pembelian AS p', 'p.id_pembelian = a.id_pembelian', 'INNER');
        $this->db->join('tbl_kategori_alat AS ka', 'ka.id_kategori_alat = a.id_kategori_alat', 'INNER');
        return $this->db->get('tbl_keranjang AS k')->result_array();
    }

    public function getJumlahItemKeranjang($id_user)
    {
        return $this->db->where('id_user', $id_user)->from('tbl_keranjang')->count_all_results();
    }

    public function getCartItem($id_user, $id_alat)
    {
        return $this->db->get_where('tbl_keranjang', ['id_user' => $id_user, 'id_alat' => $id_alat])->row();
    }

    public function getPenyewaanByUserId($id_user)
    {
        $this->db->where('p.id_user', $id_user);
        $this->db->order_by('p.id_penyewaan', 'DESC');
        $this->db->join('tbl_user AS u', 'u.id_user = p.id_user', 'INNER');
        return $this->db->get('tbl_penyewaan AS p')->result_array();
    }

    public function getDetailPenyewaanByIdPenyewaan($id_penyewaan)
    {
        $this->db->where('ps.id_penyewaan', $id_penyewaan);
        $this->db->join('tbl_penyewaan AS p', 'p.id_penyewaan = ps.id_penyewaan', 'INNER');
        $this->db->join('tbl_transaksi AS t', 't.id_penyewaan = p.id_penyewaan', 'LEFT');
        $this->db->join('tbl_user AS u', 'u.id_user = p.id_user', 'INNER');
        $this->db->join('tbl_alat AS a', 'a.id_alat = ps.id_alat', 'INNER');
        $this->db->join('tbl_pembelian AS pb', 'pb.id_pembelian = a.id_pembelian', 'INNER');
        $this->db->join('tbl_kategori_alat ka', 'ka.id_kategori_alat = a.id_kategori_alat', 'INNER');
        return $this->db->get('tbl_penyewaan_detail AS ps')->result_array();
    }

    public function getPenyewaanByIdPenyewaan($id_penyewaan)
    {
        $this->db->where('pd.id_penyewaan', $id_penyewaan);
        $this->db->join('tbl_transaksi AS t', 't.id_penyewaan = p.id_penyewaan', 'LEFT');
        $this->db->join('tbl_penyewaan_detail AS pd', 'p.id_penyewaan = pd.id_penyewaan', 'INNER');
        $this->db->join('tbl_alat AS a', 'a.id_alat = pd.id_alat', 'INNER');
        $this->db->join('tbl_pembelian AS pb', 'pb.id_pembelian = a.id_pembelian', 'INNER');
        $this->db->join('tbl_kategori_alat ka', 'ka.id_kategori_alat = a.id_kategori_alat', 'INNER');
        return $this->db->get('tbl_penyewaan AS p')->result_array();
    }
    public function getPenyewaan($id_penyewaan)
    {
        $this->db->where('p.id_penyewaan', $id_penyewaan);
        $this->db->join('tbl_user AS u', 'u.id_user = p.id_user', 'INNER');
        return $this->db->get('tbl_penyewaan AS p')->row_array();
    }

    public function getTransaksiByIdPenyewaan($id_penyewaan)
    {
        $this->db->where('t.id_penyewaan', $id_penyewaan);
        $this->db->join('tbl_penyewaan p', 'p.id_penyewaan = t.id_penyewaan', 'INNER');
        return $this->db->get('tbl_transaksi AS t')->row_array();
    }

    public function getTransaksiById($id_transaksi)
    {
        return $this->db->where('id_transaksi', $id_transaksi)->get('tbl_transaksi')->row_array();
    }

    public function getStokTersedia($id_alat)
    {
        $this->db->select('stok_keseluruhan, stok_rusak, stok_disewa');
        $this->db->from('tbl_alat');
        $this->db->where('id_alat', $id_alat);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $stok_tersedia = $row->stok_keseluruhan - $row->stok_rusak - $row->stok_disewa;
            return $stok_tersedia;
        } else {
            return 0;
        }
    }

    public function getIdAlatFromKeranjang($id_keranjang)
    {
        $this->db->select('id_alat');
        $this->db->from('tbl_keranjang');
        $this->db->where('id_keranjang', $id_keranjang);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->id_alat;
        } else {
            return null;
        }
    }

    public function getTanggalDisewa($id_alat)
    {
        $this->db->select('p.tanggal_sewa, p.tanggal_kembali');
        $this->db->where('pd.id_alat', $id_alat);
        $this->db->where('p.status_pembayaran', 'diterima');
        $this->db->join('tbl_penyewaan_detail pd', 'p.id_penyewaan = pd.id_penyewaan');
        $this->db->group_by('p.tanggal_sewa, p.tanggal_kembali');
        return $this->db->get('tbl_penyewaan AS p')->result_array();
    }


    public function getTotalStock($id_alat)
    {
        $this->db->select('stok_tersedia');
        $this->db->where('id_alat', $id_alat);
        return $this->db->get('tbl_alat')->row()->stok_tersedia;
    }

    public function getUrutanPenyewaanHariIni($tanggal)
    {
        $this->db->where('DATE(tanggal_checkout)', $tanggal);
        $this->db->from('tbl_penyewaan');
        return $this->db->count_all_results() + 1;
    }

    public function updateKodePenyewaan($id_penyewaan, $kode_penyewaan)
    {
        $this->db->where('id_penyewaan', $id_penyewaan);
        $this->db->update('tbl_penyewaan', ['kode_penyewaan' => $kode_penyewaan]);
    }



    // ADD DATA
    public function tambahKeKeranjang($data)
    {
        $this->db->insert('tbl_keranjang', $data);
    }

    public function tambahItem($data)
    {
        return $this->db->insert('tbl_keranjang', $data);
    }

    public function tambahPenyewaan($data)
    {
        return $this->db->insert('tbl_penyewaan', $data);
    }

    public function tambahPenyewaanDetail($data)
    {
        return $this->db->insert('tbl_penyewaan_detail', $data);
    }

    public function addTransaksi($data)
    {
        $this->db->insert('tbl_transaksi', $data);
    }

    // public function update_tanggal_kembali($id_penyewaan, $tanggal_kembali) {
    //     $data = [
    //         'tanggal_kembali' => $tanggal_kembali
    //     ];
    
    //     $this->db->where('id_penyewaan', $id_penyewaan);
    //     return $this->db->update('tbl_penyewaan', $data);
    // }    

    public function getDetailPenyewaan($id_penyewaan)
    {
    $this->db->where('id_penyewaan', $id_penyewaan);
    return $this->db->get('tbl_penyewaan')->row_array();
    }



    // UPDATE DATA
    public function updateKeranjang($id_user, $id_alat, $data)
    {
        $this->db->where(['id_user' => $id_user, 'id_alat' => $id_alat]);
        $this->db->update('tbl_keranjang', $data);
    }

    public function updateCartItemQty($id_user, $id_alat, $new_qty)
    {
        $this->db->where(['id_user' => $id_user, 'id_alat' => $id_alat]);
        return $this->db->update('tbl_keranjang', ['qty' => $new_qty]);
    }

    public function updateJumlahPadaKeranjang($id_keranjang, $data)
    {
        $this->db->where('id_keranjang', $id_keranjang)->update('tbl_keranjang', $data);
    }

    public function updateStok($id_alat, $data)
    {
        $this->db->where('id_alat', $id_alat)->update('tbl_stok_alat', $data);
    }

    public function updateTransaksi($id_transaksi, $data)
    {
        $this->db->where('id_transaksi', $id_transaksi)->update('tbl_transaksi', $data);
    }

    public function updateSubTotal($id_penyewaan, $sub_total)
    {
        // $this->db->where('id_penyewaan', $id_penyewaan);
        // $this->db->update('tbl_penyewaan', ['sub_total' => $sub_total]);

        $this->db->where('id_penyewaan', $id_penyewaan)->update('tbl_penyewaan',  ['sub_total' => $sub_total]);
    }

    public function updatePenyewaan($id_penyewaan, $data)
    {
        $this->db->where('id_penyewaan', $id_penyewaan)->update('tbl_penyewaan', $data);
    }

    public function updateUser($id_user, $data)
    {
        $this->db->where('id_user', $id_user)->update('tbl_user', $data);
    }

    // public function perpanjang_sewa($id_penyewaan, $tanggal_kembali) {
    //     $data = [
    //         'tanggal_kembali' => $tanggal_kembali
    //     ];
        
    //     $this->db->where('id_penyewaan', $id_penyewaan);
    //     return $this->db->update('tbl_penyewaan', $data);
    // }    

    public function update_tanggal_kembali($id_penyewaan, $data)
{
    $this->db->where('id_penyewaan', $id_penyewaan);
    $this->db->update('tbl_penyewaan', $data);
}


    // DELETE DATA
    public function hapusItemPadaKeranjang($id_keranjang)
    {
        $this->db->delete('tbl_keranjang', ['id_keranjang' => $id_keranjang]);
    }

    public function hapusCart($id_user)
    {
        $this->db->delete('tbl_keranjang', ['id_user' => $id_user]);
    }

    public function hapustransaksi($id_penyewaan)
    {
        $this->db->delete('tbl_transaksi', ['id_penyewaan' => $id_penyewaan]);
        $this->db->delete('tbl_penyewaan_detail', ['id_penyewaan' => $id_penyewaan]);
        $this->db->delete('tbl_penyewaan', ['id_penyewaan' => $id_penyewaan]);
    }

    public function hapusPenyewaanDetail($id_penyewaan)
    {
        $this->db->delete('tbl_penyewaan_detail', ['id_penyewaan' => $id_penyewaan]);
    }
}

/* End of file Model_user.php */
