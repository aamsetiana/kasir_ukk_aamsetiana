<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<div class="pagetitle">
  <h1>Master Data Pengguna</h1>
  <p>Berikut adalah data pengguna, silahkan tambahkan pengguna baru pada halaman ini</p>
</div>
<!-- <?php
      print_r($listPengguna);
      ?> -->
<p><a href="<?= site_url('tambah-pengguna'); ?>" class="btn btn-primary btn-sm">
    <i class="ri-add-circle-line"></i> Tambah</a></p>

<!-- notifikasi tambah -->
<?php if (session()->getFlashdata('tambah')) : ?>
  <div class="alert alert-success" role="alert">
    <?= session()->getFlashdata('tambah'); ?>
  <?php endif; ?>
  </div>
  <!-- end notifikasi -->

  <!-- notifikasi edit -->
  <?php if (session()->getFlashdata('edit')) : ?>
    <div class="alert alert-success" role="alert">
      <?= session()->getFlashdata('edit'); ?>
    <?php endif; ?>
    </div>
    <!-- end notifikasi -->

    <!-- notifikasi edit -->
    <?php if (session()->getFlashdata('hapus')) : ?>
      <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('hapus'); ?>
      <?php endif; ?>
      <!-- end notifikasi -->
      </div>

      <div class="card">
        <div class="card-body">
          <!--<h5 class="card-title">Berikut Adalah Data Kategori Produk</h5> -->
          <!-- Table with hoverable rows -->
          <table id="myTable" class="table table-sm">
            <div class="pagetitle mt-4">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Email</th>
                  <th scope="col">Username</th>
                  <th scope="col">Nama Pengguna</th>
                  <th scope="col">Password</th>
                  <th scope="col">Level</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>

                <?php
                if (isset($listPengguna)) {
                  $no = null;
                  foreach ($listPengguna as $baris) {
                    $no++
                ?>

                    <tr>
                      <th scope="row"><?= $no; ?></th>
                      <td><?= $baris['email']; ?></td>
                      <td><?= $baris['username']; ?></td>
                      <td><?= $baris['nama_user']; ?></td>
                      <td><?= $baris['password']; ?></td>
                      <td><?= $baris['level']; ?></td>
                      <td>
                        <a href="<?= site_url('/edit-pengguna/' . $baris['email']); ?>"><i class="btn btn-primary btn-sm bi bi-pencil-square"></i></a>
                        <a href="<?= site_url('/hapus-pengguna/' . $baris['email']); ?>"><i class="btn btn-danger btn-sm bi bi bi-trash-fill" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')"></i></a>

                    <?php
                  }
                }
                    ?>
                      </td>
                    </tr>
              </tbody>
          </table>
          <!-- End Table with hoverable rows -->


          <?= $this->endSection(); ?>