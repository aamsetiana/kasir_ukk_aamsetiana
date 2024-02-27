<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<div class="pagetitle">
    <h1>Master Data Pengguna</h1>
    <p>Silahkan edit data pengguna pada halaman ini</p>
</div>

<div class="col-lg-12">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Edit Pengguna</h5>

            <!-- Vertical Form -->
            <form class="row g-3" action="<?= site_url('perbarui-pengguna/') . $detailUser[0]['username']; ?>" method="POST">
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Username</label>
                    <input type="text" class="form-control <?= session()->has('errors') ? 'is-invalid' : null; ?>" id="inputUsn" name="username" value="<?= $detailUser[0]['username']; ?>">
                    <?php if (session()->has('errors') && session('errors.username')) : ?>
                        <div class="invalid-feedback">
                            <p>
                                <?= esc(session('errors.username')); ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Nama Pengguna</label>
                    <input type="text" class="form-control <?= session()->has('errors') ? 'is-invalid' : null; ?>" id="inputNama" name="nama_user" value="<?= $detailUser[0]['nama_user']; ?>">
                    <?php if (session()->has('errors') && session('errors.nama_user')) : ?>
                        <div class="invalid-feedback">
                            <p>
                                <?= esc(session('errors.nama_user')); ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- <div class="col-12">
                    <label for="inputNanme4" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputPw" name="password">
                </div> -->
                <div class=" col-12">
                    <label for="inputNanme4" class="form-label">Level</label>
                    <select id="level" class="form-control" name="level">
                        <option selected>pilih jenis level</option>
                        <option value="Admin" <?= $detailUser[0]['level'] == 'Admin' ? 'selected' : null; ?>>Admin</option>
                        <option value="Kasir" <?= $detailUser[0]['level'] == 'Kasir' ? 'selected' : null; ?>>Kasir</option>
                    </select>
                </div>
                <div class="text-left">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form><!-- Vertical Form -->
        </div>
    </div>

    <?= $this->endSection(); ?>