<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<div class="pagetitle">
  <h1>Master Edit Kategori</h1>
  <p>Silahkan tambahkan jenis kategori baru pada halaman ini</p>
</div>

<div class="col-lg-12">

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Form Edit Kategori</h5>

      <!-- Vertical Form -->
      <form class="row g-3" action="<?= site_url('perbarui-kategori'); ?>" method="POST">
        <div class="col-12">
          <label for="inputNanme4" class="form-label">Jenis Kategori</label>
          <input type="hidden" class="form-control" id="InputJenis" name="id_kategori" value="<?= $detailKategori[0]['id_kategori']; ?>">
          <input type="text" class="form-control <?= session()->has('errors') ? 'is-invalid' : null; ?>" id="inputJenis" autocomplete="off" name="nama_kategori" value="<?= $detailKategori[0]['nama_kategori']; ?>">
          <?php if (session()->has('errors') && session('errors.nama_kategori')) : ?>
            <div class="invalid-feedback">
              <p>
                <?= esc(session('errors.nama_kategori')); ?>
              </p>
            </div>
          <?php endif; ?>
        </div>
        <div class="text-left">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form><!-- Vertical Form -->
    </div>
  </div>

  <?= $this->endSection(); ?>