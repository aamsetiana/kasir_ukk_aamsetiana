<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<?php
// print_r($listKategori);
?>

<div class="pagetitle">
  <h1>Master Jenis Kategori</h1>
  <p>Berikut adalah data jenis kategori, silahkan tambahkan jenis kategori baru pada halaman ini</p>
</div>
<p><a href="<?= site_url('tambah-kategori'); ?>" class="btn btn-primary btn-sm">
    <i class="ri-add-circle-line"></i> Tambah</a></p>

<!-- notifikasi tambah -->
<?php if (session()->getFlashdata('tambah1')) : ?>
  <div class="alert alert-success" role="alert">
    <?= session()->getFlashdata('tambah1'); ?>
  <?php endif; ?>
  </div>
  <!-- end notifikasi -->

  <!-- notifikasi edit -->
  <?php if (session()->getFlashdata('edit1')) : ?>
    <div class="alert alert-success" role="alert">
      <?= session()->getFlashdata('edit1'); ?>
    <?php endif; ?>
    </div>
    <!-- end notifikasi -->

    <!-- notifikasi hapus -->
    <?php if (session()->getFlashdata('hapus1')) : ?>
      <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('hapus1'); ?>
      <?php endif; ?>
      <!-- end notifikasi -->
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
                  <th>Nama Kategori</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $no = null;
                foreach ($listKategori as $baris) :
                  $no++
                ?>

                  <tr>
                    <th scope="row"><?= $no; ?></th>
                    <td><?= $baris['nama_kategori']; ?></td>
                    <td>
                      <a href=<?= site_url('/edit-kategori/' . $baris['id_kategori']); ?>><i class="btn btn-primary btn-sm bi bi-pencil-square"></i></a>
                      <form action="<?= site_url('/hapus-kategori/' . $baris['id_kategori']); ?>" method="POST" class="d-inline-block">
                        <button type="submit" class="btn btn-danger btn-sm bi bi bi-trash-fill" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" id="hapusKategoriProduk" data-id="<?= $baris['id_kategori']; ?>"></button>
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