<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>KASIR UKK</title>

  <style>
    /* Aturan CSS langsung */
    .actions-column {
      width: 70px;
      /* Sesuaikan lebar sesuai kebutuhan */
    }

    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: 0;
    }

    .content {
      flex: 1;
    }

    #footer {
      padding: 20px;
      box-sizing: border-box;
      margin-top: auto;
      /* Ini akan mendorong footer ke bagian bawah */
    }
  </style>

  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url('/NiceAdmin/assets/img/favicon.png'); ?>" rel="icon">
  <link href="<?= base_url('/NiceAdmin/assets/img/apple-touch-icon.png'); ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('/NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('/NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('/NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('/NiceAdmin/assets/vendor/quill/quill.snow.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('/NiceAdmin/assets/vendor/quill/quill.bubble.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('/NiceAdmin/assets/vendor/remixicon/remixicon.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('/NiceAdmin/assets/vendor/simple-datatables/style.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('/NiceAdmin/assets/vendor/DataTables/datatables.min.css'); ?>" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url('NiceAdmin/assets/js/charts.js/Chart.min.js'); ?>">

  <link href="<?= base_url('/NiceAdmin/assets/vendor/Select2/select2.min.css'); ?>" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <!-- Template Main CSS File -->
  <link href="<?= base_url('/NiceAdmin/assets/css/style.css'); ?>" rel="stylesheet">

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script> -->
  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 09 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a class="logo d-flex align-items-center">
        <img src="/NiceAdmin/assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Kasir UKK</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->



    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">



        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">

            <span class="d-none d-md-block dropdown-toggle ps-2"><?= session()->get('nama_user'); ?></span>
          </a><!-- End Profile Image Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?= session()->get('level'); ?></h6>
              <span><?= session()->get('email'); ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?= site_url('logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    Apakah Anda yakin ingin logout?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="<?= site_url('logout'); ?>" class="btn btn-primary">Logout</a>
                  </div>
                </div>
              </div>
            </div>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <?php if ($akses == 'Admin') : ?>
        <li class="nav-item">
          <a class="nav-link collapsed  " href="<?= site_url('halaman-admin'); ?>">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li><!-- End Dashboard Nav -->
      <?php endif; ?>

      <?php if ($akses == 'Kasir') : ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="<?= site_url('halaman-kasir'); ?>">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li>
      <?php endif; ?>

      <?php if ($akses == 'Admin') : ?>
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#master-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-box-seam"></i><span>Data Produk</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="master-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="<?= site_url('kategori-produk'); ?>">
                <i class="bi bi-circle"></i><span>Kategori</span>
              </a>
            </li>
            <li>
              <a href="<?= site_url('satuan-produk'); ?>">
                <i class="bi bi-circle"></i><span>Satuan</span>
              </a>
            </li>
            <li>
              <a href="<?= site_url('data-produk'); ?>">
                <i class="bi bi-circle"></i><span>Produk</span>
              </a>
            </li>
          </ul>
        </li><!-- End Components Nav -->
      <?php endif; ?>

      <?php if ($akses == 'Kasir') : ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="<?= site_url('transaksi-jual'); ?>">
            <i class="bi bi-cart4"></i>
            <span>Transaksi</span>
          </a>
        </li><!-- End Profile Page Nav -->
      <?php endif; ?>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-clipboard-data"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <?php if ($akses == 'Admin') : ?>
            <li>
              <a href="<?= site_url('laporan-penjualan'); ?>">
                <i class="bi bi-circle"></i><span>Laporan Penjualan</span>
              </a>
            </li>
          <?php endif; ?>
          <li>
            <a href="<?= site_url('laporan-stok'); ?>">
              <i class="bi bi-circle"></i><span>Laporan Stok</span>
            </a>
          </li>

        </ul>
      </li><!-- End Tables Nav -->

      <?php if ($akses == 'Admin') : ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="<?= site_url('data-pengguna'); ?>">
            <i class="bi bi-person"></i>
            <span>Pengguna</span>
          </a>
        </li><!-- End Profile Page Nav -->
      <?php endif; ?>

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <section class="section">
      <?php echo $this->renderSection('konten'); ?>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


  <!-- Vendor JS Files -->
  <script src="<?= base_url('/NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js'); ?>"></script>
  <script src="<?= base_url('/NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?= base_url('/NiceAdmin/assets/vendor/chart.js/chart.umd.js'); ?>"></script>
  <script src="<?= base_url('/NiceAdmin/assets/vendor/echarts/echarts.min.js'); ?>"></script>
  <script src="<?= base_url('/NiceAdmin/assets/vendor/quill/quill.min.js'); ?>"></script>
  <script src="<?= base_url('/NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js'); ?>"></script>
  <script src="<?= base_url('/NiceAdmin/assets/vendor/tinymce/tinymce.min.js'); ?>"></script>
  <script src="<?= base_url('/NiceAdmin/assets/vendor/php-email-form/validate.js'); ?>"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url('/NiceAdmin/assets/js/main.js'); ?>"></script>

  <script src="<?= base_url('NiceAdmin/assets/js/charts.js/Chart.min.js'); ?>"></script>
  <script src="<?= base_url('/NiceAdmin/assets/vendor/DataTables/datatables.min.js'); ?>"></script>
  <script src="<?= base_url('/NiceAdmin/assets/vendor/Select2/select2.min.js'); ?>"></script>
  <!-- format uang -->
  <script src="<?= base_url('/NiceAdmin/assets/vendor/jquery-mask/jquery.mask.js'); ?>"></script>
  <!-- cdn jquery -->

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->


  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>

  <script>
    $(document).ready(function() {
      //merubah angka menjadi format uang
      $('.uang').mask('000.000.000.000.000', {
        reverse: true
      });

      //merubah menjadi format stok
      $('.barang').mask('000.000', {
        reverse: true
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $('.js-example-basic-single').select2();
    });

    document.addEventListener('DOMContentLoaded', function() {

      periksaKeterkaitanDataSatuan();
      periksaKeterkaitanDataKategori();

      // Periksa keterkaitan satuan
      function periksaKeterkaitanDataKategori() {
        let daftarIdData = [];
        let buttons = document.querySelectorAll('#hapusKategoriProduk');
        buttons.forEach(function(button) {
          daftarIdData.push(button.dataset.id);
        });

        daftarIdData.forEach(function(idData) {
          let xhr = new XMLHttpRequest();
          xhr.open('GET', '<?= site_url('cek-kategori/'); ?>' + idData, true);
          xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
              if (xhr.status === 200) {

                // Respons berhasil diterima
                let response = JSON.parse(xhr.responseText);

                if (response.has_relasi) {
                  let tombol = document.querySelector('#hapusKategoriProduk[data-id="' + idData + '"]');
                  tombol.disabled = true;

                  let pesan = document.createElement('span');
                  pesan.classList.add('pesan-error');
                  pesan.textContent = 'Data sudah digunakan';

                  pesan.style.display = 'inline-block';
                  pesan.style.color = 'red';
                  pesan.style.marginLeft = '10px';
                  pesan.style.backgroundColor = 'rgba(255, 0, 0, 0.1)';

                  tombol.parentNode.insertBefore(pesan, tombol.nextSibling);
                }
              } else {
                // Respons gagal
                console.error('Terjadi kesalahan saat melakukan permintaan AJAX');
              }
            }
          };
          xhr.send();
        });
      }

      // Periksa keterkaitan kategori
      function periksaKeterkaitanDataSatuan() {
        let daftarIdData = [];
        let buttons = document.querySelectorAll('#hapusSatuanProduk');
        buttons.forEach(function(button) {
          daftarIdData.push(button.dataset.id);
        });

        daftarIdData.forEach(function(idData) {
          let xhr = new XMLHttpRequest();
          xhr.open('GET', '<?= site_url('cek-satuan/'); ?>' + idData, true);
          xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
              if (xhr.status === 200) {

                // Respons berhasil diterima
                let response = JSON.parse(xhr.responseText);

                if (response.has_relasi_satuan) {
                  let tombol = document.querySelector('#hapusSatuanProduk[data-id="' + idData + '"]');
                  tombol.disabled = true;

                  let pesan = document.createElement('span');
                  pesan.classList.add('pesan-error');
                  pesan.textContent = 'Data sudah digunakan';

                  pesan.style.display = 'inline-block';
                  pesan.style.color = 'red';
                  pesan.style.marginLeft = '10px';
                  pesan.style.backgroundColor = 'rgba(255, 0, 0, 0.1)';

                  tombol.parentNode.insertBefore(pesan, tombol.nextSibling);
                }
              } else {
                // Respons gagal
                console.error('Terjadi kesalahan saat melakukan permintaan AJAX');
              }
            }
          };
          xhr.send();
        });
      }
    });
  </script>

  <script>
    // Ambil data dari controller
    // Ambil data dari controller
    var chartData = <?= json_encode($chartData) ?>;

    // Daftar bulan untuk label chart
    var months = chartData.months;

    // Data pendapatan bulanan
    var incomeData = chartData.monthlyIncome;

    // Buat grafik menggunakan Chart.js
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: months,
        datasets: [{
          label: 'Pendapatan',
          data: incomeData,
          backgroundColor: [
            'rgba(54, 162, 235, 0.2)', // Light blue
            'rgba(75, 192, 192, 0.2)', // Lighter blue
            'rgba(102, 227, 236, 0.2)', // Even lighter blue
            'rgba(129, 252, 255, 0.2)', // Very light blue
            'rgba(153, 102, 255, 0.2)' // Lighter purple (existing color)
          ],
          borderColor: [
            'rgba(54, 162, 235, 1)', // Blue
            'rgba(75, 192, 192, 1)', // Medium blue
            'rgba(102, 227, 236, 1)', // Darker blue
            'rgba(129, 252, 255, 1)', // Lightest blue
            'rgba(153, 102, 255, 1)' // Purple (existing color)
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

  <script>
    $(document).ready(function() {
      $('.dropdown-item[href="<?= site_url('logout'); ?>"]').click(function(e) {
        e.preventDefault(); // Prevent default action
        if (confirm("Apakah Anda yakin ingin logout?")) {
          // User confirmed, proceed with the actual logout link
          window.location.href = $(this).attr('href');
        }
      });
    });
  </script>

  <!-- <script>
    // menu active
    $(document).ready(function() {
            let currentUrl = window.location.href;

            $('.nav-link').each(function() {

                let linkUrl = $(this).attr('href');

                if (currentUrl.indexOf(linkUrl) !== -1) {
                    $(this).addClass('active');
                }
            });
        });
  </script> -->


  <!-- <script>
    function aturStatusPembayaran() {
      let totalBayar = parseFloat($('#jumlahPembayaran').val());
      let totalHargaSemuaBarang = parseFloat($('#totalHargaSemuaBarang').text());

      if (totalBayar >= totalHargaSemuaBarang) {
        $('#btnPembayaran').prop('disabled', false);
      } else {
        $('#btnPembayaran').prop('disabled', true);
      }
    }
  </script> -->

  <!-- <script>
    function aturStatusPembayaran() {
      let totalBayar = parseFloat($('#jumlahPembayaran').val());
      let totalHargaSemuaBarang = parseFloat($('#totalHargaSemuaBarang').text());

      if (totalBayar >= totalHargaSemuaBarang) {
        $('#btnPembayaran').prop('disabled', false);
      } else {
        $('#btnPembayaran').prop('disabled', true);
      }
    }

    // Ketika nilai pembayaran berubah, hitung jumlah kembali dan perbarui tampilan
    $('#jumlahPembayaran').on('input', function() {
      let totalBayar = parseFloat($(this).val());
      let totalHargaSemuaBarang = parseFloat($('#totalHargaSemuaBarang').text());
      let kembali = totalBayar - totalHargaSemuaBarang;

      $('#kembali').val(kembali.toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR'
      }));

      // Memanggil fungsi untuk mengatur status pembayaran setiap kali nilai berubah
      aturStatusPembayaran();
    });

    // Saat formulir pembayaran diserahkan, lakukan pembayaran
    $('#formPembayaran').submit(function(e) {
      e.preventDefault();

      let totalBayar = parseFloat($('#jumlahPembayaran').val());
      let totalHargaSemuaBarang = parseFloat($('#totalHargaSemuaBarang').text());

      if (totalBayar >= totalHargaSemuaBarang) {
        let kembali = totalBayar - totalHargaSemuaBarang;
        alert('Pembayaran berhasil! Kembali: ' + kembali.toLocaleString('id-ID', {
          style: 'currency',
          currency: 'IDR'
        }));

        $.ajax({
          type: "POST",
          url: "<?= site_url('pembayaran'); ?>",
          data: $('#formPembayaran').serialize(),
          success: function(response) {
            console.log(response)
          }
        });

        location.reload();
      } else {
        alert('Pembayaran kurang! Jumlah yang dibayarkan harus lebih besar atau sama dengan total harga semua barang.');
      }
    });
  </script> -->


  <!-- <script>
    function perbaruiTotalHarga() {
      var totalHargaSemuaBarang = 0;
      $('.total-harga').each(function() {
        totalHargaSemuaBarang += parseFloat($(this).text().replace(',', '.')); // Ambil nilai total harga setiap item dan tambahkan ke total harga semua barang
      });
      $('#totalHargaSemuaBarang').text(totalHargaSemuaBarang.toFixed(2).toString().replace('.', ','));
    }

    function aturStatusPembayaran() {
      let totalBayar = parseFloat($('#jumlahPembayaran').val());
      let totalHargaSemuaBarang = parseFloat($('#totalHargaSemuaBarang').text());

      if (totalBayar >= totalHargaSemuaBarang) {
        $('#btnPembayaran').prop('disabled', false);
      } else {
        $('#btnPembayaran').prop('disabled', true);
      }
    }

    // Ketika nilai pembayaran berubah, hitung jumlah kembali dan perbarui tampilan
    $('#jumlahPembayaran').on('input', function() {
      let totalBayar = parseFloat($(this).val());
      let totalHargaSemuaBarang = parseFloat($('#totalHargaSemuaBarang').text());
      let kembali = totalBayar - totalHargaSemuaBarang;

      $('#kembali').val(kembali.toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR'
      }));

      // Memanggil fungsi untuk mengatur status pembayaran setiap kali nilai berubah
      aturStatusPembayaran();
    });
  </script> -->

</body>

</html>