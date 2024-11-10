<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_auth extends CI_Model
{
    public function tambahData($data)
    {
        $this->db->insert('tbl_user', $data);
    }
}

/* End of file Model_auth.php */
