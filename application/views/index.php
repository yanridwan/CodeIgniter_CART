<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>CART-PHP(Codeigniter)</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-4" style="padding-bottom: 5%;">
                <h1 align="center" style="padding-top: 20%;">CART-PHP</h1>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <table class="table table-striped" border="1px">
                            <thead align="center">
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th style="width: 20%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($barang as $data) : ?>
                                    <tr>
                                        <form method="post" action="<?= base_url('cart/tambah'); ?>">
                                            <td><?= $no++ ?></td>
                                            <td><?= $data->barang_nama ?></td>
                                            <td>Rp<?= number_format("$data->barang_harga", 0, ",", ".") ?></td>
                                            <td>
                                                <input type="hidden" name="id" value="<?= $data->barang_id ?>">
                                                <input type="hidden" name="nama_barang" value="<?= $data->barang_nama ?>">
                                                <input type="hidden" name="harga_barang" value="<?= $data->barang_harga ?>">
                                                <input type="hidden" name="qty" value="1">
                                                <button class="btn btn-success" type="submit">Tambah</button>
                                            </td>
                                        </form>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="col-xs-12 col-md-6">
                        <table class="table table-striped" border="1px">
                            <thead align="center">
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th style="width: 20%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $cart = $this->cart->contents();
                                if (empty($cart)) {
                                ?>
                                    <tr>
                                        <td colspan="5" align="center">Maaf Belum Ada Barang</td>
                                    </tr>
                                    <?php
                                } else {
                                    $no = 1;
                                    $grand_total = 0;
                                    foreach ($this->cart->contents() as $items) {
                                        $grand_total = $grand_total + $items['subtotal'];
                                    ?>
                                        <input type="hidden" name="cart[<?php echo $items['id']; ?>][id]" value="<?php echo $items['id']; ?>" />
                                        <input type="hidden" name="cart[<?php echo $items['id']; ?>][rowid]" value="<?php echo $items['rowid']; ?>" />
                                        <input type="hidden" name="cart[<?php echo $items['id']; ?>][name]" value="<?php echo $items['name']; ?>" />
                                        <input type="hidden" name="cart[<?php echo $items['id']; ?>][price]" value="<?php echo $items['price']; ?>" />
                                        <input type="hidden" name="cart[<?php echo $items['id']; ?>][qty]" value="<?php echo $items['qty']; ?>" />
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $items['name'] ?></td>
                                            <td>Rp<?= number_format($items['price'], 0, ',', '.') ?></td>
                                            <td><?= $items['qty'] ?></td>
                                            <td>Rp<?= number_format($items['subtotal'], 0, ',', '.') ?></td>
                                            <td><a href="<?= base_url() ?>cart/hapus/<?= $items['rowid']; ?>"><button class="btn btn-danger">Hapus</button></a></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                                <tr>
                                    <td colspan="4" align="center">Total</td>
                                    <td><?= number_format($this->cart->total(), 0, ',', '.') ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
</body>

</html>