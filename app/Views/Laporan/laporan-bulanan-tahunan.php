<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<!-- Page Heading -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="card-title" style="font-size: 27px;">Laporan Penjualan</h1>
                <div style="display: grid; gap: 10px;">
                    <p>Berikut adalah data penjualan</p>
                </div>
                <!-- <p class="font-weight-bold">Jenis Laporan : <span class="font-weight-normal"><?= $jenis_laporan == 'bulanan' ? 'Bulanan' : 'Tahunan' ?></span></p>
                <p class="font-weight-bold">Bulan : <span class="font-weight-normal"><?= ($bulan == '' ? '' : $bulan); ?></span></p>
                <p class="font-weight-bold">Tahun: <span class="font-weight-normal"><?= $tahun ?></span></p> -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="card">
    <div class="card-body">
        <div class="row mb-4">
            <!--<h5 class="card-title">Berikut Adalah Data Kategori Produk</h5> -->
            <!-- Table with hoverable rows -->
            <div class="pagetitle mt-4">
            </div>
            <table id="myTable" class="table table-sm ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = null;
                    foreach ($detail_penjualan as $baris) :
                        $no++
                    ?>

                        <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $baris['nama_produk'] ?></td>
                            <td><?= $baris['qty'] ?></td>
                            <td><?= $baris['harga_beli'] ?></td>
                            <td><?= $baris['harga_jual'] ?></td>
                            <td><?= $baris['total_harga'] ?></td>

                        <?php
                    endforeach;
                        ?>
                <tfoot>
                    <tr>
                        <td colspan="5">Total Penjualan:</td>
                        <td><?= $total_penjualan ?></td>
                    </tr>
                    <tr>
                        <td colspan="5">Total Keuntungan:</td>
                        <td><?= $total_keuntungan ?></td>
                    </tr>
                </tfoot>

                </tr>
                </tbody>
            </table>
        </div>
        <!-- Tombol Kembali -->
        <div class="text-center mt-2">
            <a href="<?= site_url('laporan-penjualan'); ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>



<?= $this->endSection(); ?>