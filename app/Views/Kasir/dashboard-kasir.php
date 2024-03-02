<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>

<div class="pagetitle">
    <h1 class="mb-4">Selamat Datang <?= session()->get('nama_user'); ?></h1>
</div>

<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <!-- Revenue Card
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card revenue-card">
            <div class="card-body">
              <h5 class="card-title">Laporan Penjualan Bulanan<span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="ps-3">

                </div>
              </div>
            </div>
          </div>
        </div>End Revenue Car -->

                <!-- Revenue Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Produk<span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $totalProduk; ?> Produk</h6>
                                    <!-- <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Revenue Car-->

                <!--Sales Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Stok Produk</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?php echo $total_stok; ?></h6>
                                    <span class="text-success small pt-1 fw-bold">STOK PRODUK TERSEDIA</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Sales Card -->


                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Stok Habis</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?php echo $jumlah_stok_kosong; ?></h6>
                                    <span class="text-danger small pt-1 fw-bold">STOK PRODUK TIDAK TERSEDIA</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Sales Card -->


                <?= $this->endSection(); ?>