<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>


<div class="col-lg-12">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title text-center" style="font-size: 27px;">Laporan Penjualan</h1>

            <!-- Vertical Form -->
            <form class="row g-3" action="<?= site_url('laporan-penjualan'); ?>" method="POST">
                <div class="col-12">
                    <div class="form-group mb-3">
                        <label for="namaSatuan" class="form-label">Penjualan Berdasarkan Bulan</label>
                        <select name="bulan" id="bulan" class="form-control">
                            <option value="" selected>--pilih bulan--</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="namaSatuan" class="form-label">Penjualan Berdasarkan Tahun</label>
                        <input type="number" name="tahun" id="tahun" min="2022" max="2050" value="<?php echo date('Y'); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="namaSatuan" class="form-label">Jenis Laporan</label>
                        <select name="jenis_laporan" id="jenis_laporan" class="form-control">
                            <option value="" selected>--pilih jenis--</option>
                            <option value="bulanan">Bulanan</option>
                            <option value="tahunan">Tahunan</option>
                        </select>
                    </div>
            </form><!-- Vertical Form -->
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </div>
    </div>

    <?= $this->endSection(); ?>