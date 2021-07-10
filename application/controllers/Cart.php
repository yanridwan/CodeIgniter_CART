<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('CartModel');
        $this->load->library('cart');
    }

    public function index()
    {
        $data['barang'] = $this->CartModel->select('barang');
        $this->load->view('index', $data);
    }

    public function tambah()
    {
        $data = array(
            'id' => $this->input->post('id'),
            'name' => $this->input->post('nama_barang'),
            'price' => $this->input->post('harga_barang'),
            'qty' => $this->input->post('qty')
        );
        $this->cart->insert($data);
        redirect('cart');
    }

    public function hapus($rowid)
    {
        if ($rowid == "all") {
            $this->cart->destroy();
        } else {
            $data = array(
                'rowid' => $rowid,
                'qty' => 0
            );
            $this->cart->update($data);
        }
        redirect('cart');
    }

    public function ubah()
    {
        $cart_info = $_POST['cart'];
        foreach ($cart_info as $id => $cart) {
            $rowid = $cart['rowid'];
            $price = $cart['price'];
            $amount = $price * $cart['qty'];
            $qty = $$cart['qty'];
            $data = array(
                'rowid' => $rowid,
                'price' => $price,
                'amount' => $amount,
                'qty' => $qty,
            );
            $this->cart->pdate($data);
        }
        redirect('cart');
    }
}
