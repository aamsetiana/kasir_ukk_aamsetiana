<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<div class="pagetitle">
    <h1>Transaksi Pembelian</h1>
    <p>Silahkan lakukan transaksi di halaman ini</p>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Form Transaksi</h5>

        <!-- Multi Columns Form -->
        <form class="row g-3" action="<?= site_url('simpan-transaksi') ?>" method="POST">
            <div class="col-md-4">
                <label for="nofaktur" class="form-label fw-bold">No Faktur</label>
                <label class="form-control" id="input" name="noFaktur" readonly style="background-color: #f0f0f0; color: #333;"><?= $no_faktur ?></label>
            </div>
            <div class="col-md-3">
                <label for="inputEmail5" class="form-label fw-bold">Tanggal</label>
                <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d'); ?>" readonly style="background-color: #f0f0f0; color: #333;">
            </div>
            <div class="col-md-3">
                <label for="user" class="form-label fw-bold">Kasir</label>
                <input type="text" class="form-control" value="<?= session()->get('nama_user'); ?>" readonly style="background-color: #f0f0f0; color: #333;">
                <!-- <input type="time" class="form-control" id="waktu" name="waktu" readonly>
                <script>
                    // Mendapatkan elemen input waktu
                    var inputWaktu = document.getElementById('waktu');

                    // Mendapatkan waktu terkini
                    var waktuSekarang = new Date();

                    // Mendapatkan komponen jam dan menit dari waktu terkini
                    var jam = ('0' + waktuSekarang.getHours()).slice(-2); // Format jam dua digit
                    var menit = ('0' + waktuSekarang.getMinutes()).slice(-2); // Format menit dua digit

                    // Mengatur nilai input waktu dengan waktu terkini
                    inputWaktu.value = jam + ':' + menit;
                </script> -->
            </div>

            <!-- <div class="col-md-2">
                <label for="kode_produk" class="form-label fw-bold">Aksi</label>
            </div> -->
            <div class="col-md-4">
                <label class="form-label">Kode Produk</label>
                <input type="hidden" class="form-control" value="<?= $no_faktur; ?>" name="no_faktur">
                <select class="js-example-basic-single form-select form-control <?= session()->has('errors') ? 'is-invalid' : null ?>" name="id_produk">
                    <option value="">--Daftar Produk--</option>
                    <?php if (isset($produkList)) :
                        foreach ($produkList as $row) : ?>
                            <option value="<?= $row['id_produk']; ?>"><?= $row['nama_produk']; ?> | <?= $row['stok']; ?> | <?= number_format($row['harga_jual'], 0, ',', '.'); ?></option>

                    <?php
                        endforeach;
                    endif; ?>
                </select>
                <?php if (isset(session('errors')['id_produk'])) : ?>
                    <div class="mx-1 invalid-feedback">
                        <p style="font-size: 1rem;">
                            <?= session('errors')['id_produk']; ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-3">
                <label for="inputCity" class="form-label">Jumlah</label>
                <input type="text" class="form-control barang <?= session()->has('errors') ? 'is-invalid' : null ?>" id="inputCity" name="qty" autocomplete="off">
                <?php if (isset(session('errors')['qty'])) : ?>
                    <div class="mx-1 invalid-feedback">
                        <p style="font-size: 1rem;">
                            <?= session('errors')['qty']; ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-1">
                <label for="inputZip" class="form-label fw-bold">Aksi</label>
                <div class="input-group">
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-cart-plus-fill"></i>
                    </button>&nbsp;
                    <!-- <button class="btn btn-danger" type="button" id="btnHapusTransaksi">
                        <i class="bi bi-trash"></i>
                    </button>&nbsp; -->
                </div>

                <!-- <div class="col-md-4">
                <label for="inputState" class="form-label">Total Bayar</label>
                <input type="text" class="form-control" id="inputCity">
            </div>
            <div class="col-md-3">
                <label for="inputZip" class="form-label">Kembalian</label>
                <input type="text" class="form-control" id="inputZip">
            </div> -->
            </div>
        </form><!-- End Multi Columns Form -->

        <div class="col-sm-12 mt-4">
            <div class="row">
            </div>
            <div class="card card-primary ">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered text-center mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Total</th>
                                    <!-- <th scope="col">Aksi</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($detailPenjualan) && !empty($detailPenjualan)) :
                                    $no = 1;
                                    foreach ($detailPenjualan as $detail) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $detail['nama_produk']; ?></td>
                                            <td><?= $detail['qty']; ?></td>
                                            <td><?= number_format($detail['total_harga'], 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php endforeach;
                                else : ?>
                                    <tr>
                                        <td colspan="4">Tidak ada produk</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-3">
                                        <h3 class="card-title">TOTAL : RP <?= number_format($totalHarga, 0, ',', '.'); ?></h3>
                                        <a href="<?= site_url('pembayaran') ?>" id="btnPembayaran" class="btn btn-primary btn-lg mt-3">Bayar</a>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Bayar</label>
                                            <input type="text" name="txtbayar" class="form-control" id="txtbayar">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Kembali</label>
                                            <input type="text" name="kembali" class="form-control" id="kembali" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Ambil elemen-elemen yang diperlukan
                var txtBayar = document.getElementById('txtbayar');
                var kembali = document.getElementById('kembali');
                var totalHarga = <?= $totalHarga ?>; // Ambil total harga dari controller dan diteruskan ke view

                // Tambahkan event listener untuk memantau perubahan pada input bayar
                txtBayar.addEventListener('input', function() {
                    // Ambil nilai yang dibayarkan
                    var bayar = parseFloat(txtBayar.value);

                    // Hitung kembaliannya
                    var kembalian = bayar - totalHarga;

                    // Tampilkan kembaliannya pada input kembali
                    if (kembalian >= 0) {
                        kembali.value = kembalian.toFixed(2).replace(/(\.00)+$/, ''); // Menampilkan hingga 2 digit desimal
                    } else {
                        kembali.value = '0'; // Jika kembalian negatif, tampilkan '0.00'
                    }
                });
            });
        </script>


        <!-- <script>
        $(function() {
            $("#barcode-input").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "<?php echo base_url('TransaksiPenjualan/getProductName'); ?>",
                        method: 'post',
                        dataType: 'json',
                        data: {
                            barcode: request.term
                        },
                        success: function(data) {
                            if (!data.error) {
                                $('#product-name').val(data.nama);
                            } else {
                                $('#product-name').val('');
                                alert(data.error);
                            }
                        }
                    });
                },
                minLength: 2
            });
        });
    </script> -->

        <!-- <script>
    $(document).ready(function() {

        buatFaktur();
    });

    function buatFaktur() {
        $.ajax({
            type: "post",
            url: "<?= site_url('TransaksiPenjualan/buatFaktur') ?>",
            data: {
                tanggal: $('#tanggal').val()
            },
            dataType: "json",
            success: function(response) {
                if (response.fakturpenjualan) {
                    $('#noFaktur').val(response.fakturpenjualan);
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script> -->


        <?= $this->endSection(); ?>