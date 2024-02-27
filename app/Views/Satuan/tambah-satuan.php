<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<div class="pagetitle">
  <h1>Master Jenis Satuan</h1>
  <p>Silahkan tambahkan satuan produk baru pada halaman ini</p>
</div>

<div class="col-lg-12">

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Form Tambah Satuan</h5>
      <!-- Vertical Form -->
      <form class="row g-3" action="<?= site_url('simpan-satuan'); ?>" method="POST">
        <div class="col-12">
          <label for="inputNanme4" class="form-label">Jenis Satuan</label>
          <input type="hidden" class="form-control" id="InputSatuan" name="id_satuan">
          <input type="text" class="form-control <?= session()->has('errors') ? 'is-invalid' : null; ?>" id="inputSat" name="nama_satuan" autofocus autocomplete="off">
          <?php if (session()->has('errors') && session('errors')['nama_satuan']) : ?>
            <div class="invalid-feedback">
              <p>
                <?= session('errors')['nama_satuan']; ?>
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