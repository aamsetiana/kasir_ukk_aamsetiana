<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<div class="col-lg-12">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Edit Satuan</h5>

            <!-- Vertical Form -->
            <form class="row g-3" action="<?= site_url('perbarui-satuan'); ?>" method="POST">
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Jenis Satuan</label>
                    <input type="hidden" class="form-control" id="InputSatuan" name="id_satuan" value="<?= $detailSatuan[0]['id_satuan']; ?>">
                    <input type="text" class="form-control <?= session()->has('errors') ? 'is-invalid' : null; ?>" id="inputSatuan" autocomplete="off" name="nama_satuan" value="<?= $detailSatuan[0]['nama_satuan']; ?>">
                    <?php if (session()->has('errors') && session('errors.nama_satuan')) : ?>
                        <div class="invalid-feedback">
                            <p>
                                <?= esc(session('errors.nama_satuan')); ?>
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