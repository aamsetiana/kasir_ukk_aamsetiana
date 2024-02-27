<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<div class="col-lg-12">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Edit Produk</h5>

            <!-- Vertical Form -->
            <form class="row g-3" action="<?= site_url('perbarui-produk'); ?>" method="POST">
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Kode Produk</label>
                    <input type="hidden" class="form-control" id="inputId" value="<?= $detailProduk[0]['id_produk']; ?>" name="id_produk">
                    <input type="text" class="form-control <?= session()->has('errors') ? 'is-invalid' : null; ?>" id="inputKode" value="<?= $detailProduk[0]['kode_produk']; ?>" name="kode_produk">
                    <?php if (session()->has('errors') && session('errors.kode_produk')) : ?>
                        <div class="invalid-feedback">
                            <p>
                                <?= session('errors.kode_produk'); ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control <?= session()->has('errors') ? 'is-invalid' : null; ?>" id="inputNama" value="<?= $detailProduk[0]['nama_produk']; ?>" name="nama_produk">
                    <?php if (session()->has('errors') && session('errors.nama_produk')) : ?>
                        <div class="invalid-feedback">
                            <p>
                                <?= session('errors.nama_produk'); ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Harga Beli</label>
                    <input type="text" class="form-control uang <?= session()->has('errors') ? 'is-invalid' : null; ?>" id="inputHarga" value="<?= $detailProduk[0]['harga_beli']; ?>" name="harga_beli">
                    <?php if (session()->has('errors') && session('errors.harga_beli')) : ?>
                        <div class="invalid-feedback">
                            <p>
                                <?= session('errors.harga_beli'); ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Harga Jual</label>
                    <input type="text" class="form-control uang <?= session()->has('errors') ? 'is-invalid' : null; ?>" id="inputHj" value="<?= $detailProduk[0]['harga_jual']; ?>" name="harga_jual">
                    <?php if (session()->has('errors') && session('errors.harga_jual')) : ?>
                        <div class="invalid-feedback">
                            <p>
                                <?= session('errors.harga_jual'); ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Satuan Produk</label>
                    <select class="form-control" id="inputSatuan" name="jenis_satuan">
                        <?php

                        if (isset($listSatuan)) {
                            $no = null;
                            foreach ($listSatuan as $baris) {
                                $no++;
                                $detailProduk[0]['id_satuan'] == $baris['id_satuan'] ? $pilih = 'selected' : $pilih = null;

                                echo '<option ' . $pilih . ' value="' . $baris['id_satuan'] . '">' . $baris['nama_satuan'] . ' </option>';
                            }
                        }

                        ?>
                    </select>
                </div>
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Kategori Produk</label>
                    <select class="form-control" id="inputKategori" name="jenis_kategori">
                        <?php

                        if (isset($listKategori)) {
                            $no = null;
                            foreach ($listKategori as $baris) {
                                $no++;
                                $detailProduk[0]['id_kategori'] == $baris['id_kategori'] ? $pilih = 'selected' : $pilih = null;

                                echo '<option ' . $pilih . ' value="' . $baris['id_kategori'] . '">' . $baris['nama_kategori'] . ' </option>';
                            }
                        }

                        ?>
                    </select>
                </div>
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Stok</label>
                    <input type="text" class="form-control barang <?= session()->has('errors') ? 'is-invalid' : null; ?>" id="inputStok" value="<?= $detailProduk[0]['stok']; ?>" name="stok">
                    <?php if (session()->has('errors') && session('errors.stok')) : ?>
                        <div class="invalid-feedback">
                            <p>
                                <?= session('errors.stok'); ?>
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