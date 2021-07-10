<?php class CartModel extends CI_Model
{
    public function select($tabel)
    {
        $select = $this->db->get($tabel);
        return $select->result();
    }
}
