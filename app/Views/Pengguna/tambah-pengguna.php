<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<div class="pagetitle">
  <h1>Master Data Pengguna</h1>
  <p>Silahkan tambahkan pengguna baru pada halaman ini</p>
</div>

<div class="col-lg-12">

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Form Tambah Pengguna</h5>

      <!-- Vertical Form -->
      <form class="row g-3" action="<?= site_url('simpan-pengguna'); ?>" method="POST">
        <div class="col-12">
          <label for="inputNanme4" class="form-label">Username</label>
          <input type="text" class="form-control <?= session()->has('errors') ? 'is-invalid' : null; ?>" id="inputUsn" name="username" placeholder="Masukan Username" autofocus autocomplete="off">
          <?php if (session()->has('errors') && session('errors')['username']) : ?>
            <div class="invalid-feedback">
              <p>
                <?= session('errors')['username']; ?>
              </p>
            </div>
          <?php endif; ?>
        </div>
        <div class="col-12">
          <label for="inputNanme5" class="form-label">Nama Pengguna</label>
          <input type="text" class="form-control <?= session()->has('errors') ? 'is-invalid' : null; ?>" id="inputNama" name="nama_user" placeholder="Masukan Nama Pengguna" autocomplete="off">
          <?php if (session()->has('errors') && session('errors')['nama_user']) : ?>
            <div class="invalid-feedback">
              <p>
                <?= session('errors')['nama_user']; ?>
              </p>
            </div>
          <?php endif; ?>
        </div>
        <div class="col-12">
          <label for="inputNanme6" class="form-label">Password</label>
          <input type="password" class="form-control <?= session()->has('errors') ? 'is-invalid' : null; ?>" id="inputPw" name="password" placeholder="Masukan Password" autocomplete="off">
          <?php if (session()->has('errors') && session('errors.password')) : ?>
            <div class="invalid-feedback">
              <p>
                <?= session('errors.password'); ?>
              </p>
            </div>
          <?php endif; ?>
        </div>
        <div class="col-12">
          <label for="inputNanme7" class="form-label">Level</label>
          <select id="level" class="form-control" name="level">
            <option selected>Admin</option>
            <option>Kasir</option>
          </select>
        </div>
        <div class="text-left">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form><!-- Vertical Form -->
    </div>
  </div>

  <?= $this->endSection(); ?>