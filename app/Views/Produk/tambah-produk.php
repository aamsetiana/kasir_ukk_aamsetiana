<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<div class="col-lg-12">

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Form Tambah Produk</h5>

      <!-- Vertical Form -->
      <form class="row g-3" action="<?= site_url('simpan-produk'); ?>" method="POST">
        <div class="col-12">
          <label for="inputNanme4" class="form-label">Kode Produk</label>
          <input type="hidden" class="form-control" id="InputId" name="id_produk">
          <input type="text" class="form-control <?= session()->has('errors') ? 'is-invalid' : null; ?>" id="inputKode" name="kode_produk" placeholder="Masukan Kode Produk" autofocus autocomplete="off">
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
          <input type="text" class="form-control <?= session()->has('errors') ? 'is-invalid' : null; ?>" id="inputProduk" name="nama_produk" placeholder="Masukan Nama Produk" autocomplete="off">
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
          <input type="text" class="form-control uang <?= session()->has('errors') ? 'is-invalid' : null; ?>" id="inputHb" name="harga_beli" placeholder="Masukan Harga Beli" autocomplete="off">
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
          <input type="text" class="form-control uang <?= session()->has('errors') ? 'is-invalid' : null; ?>" id="inputHj" name="harga_jual" placeholder="Masukan Harga Jual" autocomplete="off">
          <?php if (session()->has('errors') && session('errors.harga_jual')) : ?>
            <div class="invalid-feedback">
              <p>
                <?= session('errors.harga_jual'); ?>
              </p>
            </div>
          <?php endif; ?>
        </div>
        <!-- <div class="col-12">
          <label for="inputNanme4" class="form-label">Diskon</label>
          <input type="text" class="form-control uang" id="inputDiskon" name="diskon" required name="produk" placeholder="Masukan Nama Produk" autocomplete="off">
        </div> -->
        <div class="col-12">
          <label for="inputNanme4" class="form-label">Satuan Produk</label>
          <select class="form-control" id="inputSatuan" name="jenis_satuan">
            <?php

            if (isset($listSatuan)) {
              $no = null;
              foreach ($listSatuan as $baris) {
                $no++;

                echo '<option value="' . $baris['id_satuan'] . '">' . $baris['nama_satuan'] . '</option>';
              }
            }

            ?>
          </select>
        </div>
        <div class="col-12">
          <label for="inputNanme4" class="form-label">Kategori Produk</label>
          <select class="form-control" id="inputJenis" name="jenis_kategori">
            <?php

            if (isset($listKategori)) {
              $no = null;
              foreach ($listKategori as $baris) {
                $no++;

                echo '<option value="' . $baris['id_kategori'] . '">' . $baris['nama_kategori'] . '</option>';
              }
            }

            ?>
          </select>
        </div>
        <div class="col-12">
          <label for="inputNanme4" class="form-label">Stok</label>
          <input type="text" class="form-control barang <?= session()->has('errors') ? 'is-invalid' : null; ?>" id="inputStok" name="stok" placeholder="Masukan Nama Produk" autocomplete="off">
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