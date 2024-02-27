<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<div class="pagetitle">
  <h1>Master Data Produk</h1>
  <p>Berikut adalah data Produk, silahkan tambahkan data produk baru pada halaman ini</p>
</div>
<p><a href="<?= site_url('tambah-produk'); ?>" class="btn btn-primary btn-sm">
    <i class="ri-add-circle-line"></i> Tambah</a></p>

<!-- notifikasi simpan -->
<?php if (session()->getFlashdata('tambah3')) : ?>
  <div class="alert alert-success" role="alert">
    <?= session()->getFlashdata('tambah3'); ?>
  <?php endif; ?>
  </div>
  <!-- end notifikasi -->

  <!-- notifikasi edit -->
  <?php if (session()->getFlashdata('edit3')) : ?>
    <div class="alert alert-success" role="alert">
      <?= session()->getFlashdata('edit3'); ?>
    <?php endif; ?>
    </div>
    <!-- end notifikasi -->

    <!-- notifikasi hapus -->
    <?php if (session()->getFlashdata('hapus3')) : ?>
      <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('hapus3'); ?>
      <?php endif; ?>
      </div>
      <!-- end notifikasi -->

      <div class="card">
        <div class="card-body">
          <!--<h5 class="card-title">Berikut Adalah Data Kategori Produk</h5> -->
          <!-- Table with hoverable rows -->
          <div class="pagetitle mt-4">
          </div>
          <table id="myTable" class="table table-sm">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <!-- <th>Diskon</th> -->
                <th>Satuan</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th class="actions-column">Aksi</th>
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
                  <td><?= $baris['kode_produk']; ?></td>
                  <td><?= $baris['nama_produk']; ?></td>
                  <td><?= number_format($baris['harga_beli'], 0, ',', '.'); ?></td>
                  <td><?= number_format($baris['harga_jual'], 0, ',', '.'); ?></td>
                  <td><?= $baris['nama_satuan']; ?></td>
                  <td><?= $baris['nama_kategori']; ?></td>
                  <td><?= $baris['stok']; ?></td>
                  <td>
                    <a href=<?= site_url('/edit-produk/' . $baris['id_produk']); ?>><i class="btn btn-primary btn-sm bi bi-pencil-square"></i></a>
                    <a href=<?= site_url('/hapus-produk/' . $baris['id_produk']); ?> onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"><i class="btn btn-danger btn-sm bi bi bi-trash-fill"></i></a>

                  <?php
                endforeach;
                  ?>
                  </td>
                </tr>
            </tbody>
          </table>

          <?= $this->endSection(); ?>