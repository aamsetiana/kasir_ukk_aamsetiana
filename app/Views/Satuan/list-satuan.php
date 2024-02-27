<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<div class="pagetitle">
  <h1>Master Jenis Satuan</h1>
  <p>Berikut adalah jenis satuan, silahkan tambahkan jenis satuan baru pada halaman ini</p>
</div>
<p><a href="<?= site_url('tambah-satuan'); ?>" class="btn btn-primary btn-sm">
    <i class="ri-add-circle-line"></i> Tambah</a></p>

<!-- notifikasi tambah -->
<?php if (session()->getFlashdata('tambah2')) : ?>
  <div class="alert alert-success" role="alert">
    <?= session()->getFlashdata('tambah2'); ?>
  <?php endif; ?>
  </div>
  <!-- end notifikasi -->

  <!-- notifikasi edit -->
  <?php if (session()->getFlashdata('edit2')) : ?>
    <div class="alert alert-success" role="alert">
      <?= session()->getFlashdata('edit2'); ?>
    <?php endif; ?>
    </div>
    <!-- end notifikasi -->

    <!-- notifikasi hapus -->
    <?php if (session()->getFlashdata('hapus2')) : ?>
      <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('hapus2'); ?>
      <?php endif; ?>
      <!-- end notifikasi -->
      </div>

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
                <th>Nama Satuan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>

              <?php
              $no = null;
              foreach ($listSatuan as $baris) :
                $no++
              ?>

                <tr>
                  <th scope="row"><?= $no; ?></th>
                  <td><?= $baris['nama_satuan']; ?></td>
                  <td>
                    <a href=<?= site_url('/edit-satuan/' .  $baris['id_satuan']); ?>><i class="btn btn-primary btn-sm bi bi-pencil-square"></i></a>
                    <form action="<?= site_url('/hapus-satuan/' . $baris['id_satuan']); ?>" method="POST" class="d-inline-block">
                      <button type="submit" class="btn btn-danger btn-sm bi bi bi-trash-fill" id="hapusSatuanProduk" data-id="<?= $baris['id_satuan']; ?>"></button>
                    </form>

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