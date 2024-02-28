<?= $this->extend('layout/template'); ?>
<?= $this->section('konten') ?>


<div class="pagetitle">
    <h1>Laporan Stok</h1>
    <p>Berikut adalah data laporan stok</p>
</div>
<p><a href="<?= site_url('cetak-laporan-stok'); ?>" class="btn btn-primary btn-sm">
        <i class="bi bi-printer"></i> Cetak</a></p>
<div class="card">
    <div class="card-body">
        <div class="row mb-4">
            <!--<h5 class="card-title">Berikut Adalah Data Kategori Produk</h5> -->
            <!-- Table with hoverable rows -->
            <div class="pagetitle mt-4">
            </div>
            <table id="myTable" class="table table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = null;
                    foreach ($listProduk as $baris) :
                        $no++
                    ?>

                        <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $baris['nama_produk']; ?></td>
                            <td><?= $baris['harga_jual']; ?></td>
                            <td><?= $baris['stok']; ?>


                            <?php
                        endforeach;
                            ?>
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>