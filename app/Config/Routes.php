<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->post('/login-pengguna', 'Login::prosesLogin');
$routes->get('logout', 'Login::logout');

//Admin
$routes->get('/halaman-admin', 'Admin::halamanAdmin', ['filter' => 'otentifikasi']);
$routes->get('/halaman-kasir', 'Kasir::halamanKasir', ['filter' => 'otentifikasi']);

//kategori_produk
$routes->get('/kategori-produk', 'KategoriProduk::kategori', ['filter' => 'otentifikasi']);
$routes->get('/tambah-kategori', 'KategoriProduk::tambahKategori', ['filter' => 'otentifikasi']);
$routes->post('/simpan-kategori', 'KategoriProduk::simpanKategori');
$routes->get('/edit-kategori/(:num)', 'KategoriProduk::editKategori/$1', ['filter' => 'otentifikasi']);
$routes->post('/perbarui-kategori', 'KategoriProduk::simpanEditKategori');
$routes->post('/hapus-kategori/(:num)', 'KategoriProduk::hapusKategori/$1');
$routes->get('/cek-kategori/(:segment)', 'KategoriProduk::cekRelasii/$1');

//satuan_produk
$routes->get('/satuan-produk', 'SatuanProduk::satuan', ['filter' => 'otentifikasi']);
$routes->get('/tambah-satuan', 'SatuanProduk::tambahSatuan', ['filter' => 'otentifikasi']);
$routes->post('/simpan-satuan', 'SatuanProduk::simpanSatuan');
$routes->get('/edit-satuan/(:num)', 'SatuanProduk::editSatuan/$1', ['filter' => 'otentifikasi']);
$routes->post('/perbarui-satuan', 'SatuanProduk::simpanEditSatuan');
$routes->post('/hapus-satuan/(:num)', 'SatuanProduk::hapusSatuan/$1');
$routes->get('/cek-satuan/(:segment)', 'SatuanProduk::cekRelasiSatuanPrd/$1');

//produk
$routes->get('/data-produk', 'Produk::produk', ['filter' => 'otentifikasi']);
$routes->get('tambah-produk', 'Produk::tambahProduk', ['filter' => 'otentifikasi']);
$routes->post('simpan-produk', 'Produk::simpanProduk');
$routes->get('/edit-produk/(:num)', 'Produk::editProduk/$1', ['filter' => 'otentifikasi']);
$routes->post('/perbarui-produk', 'Produk::simpanEditProduk');
$routes->get('/hapus-produk/(:num)', 'Produk::hapusProduk/$1');

//pengguna
$routes->get('/data-pengguna', 'Pengguna::pengguna', ['filter' => 'otentifikasi']);
$routes->get('/tambah-pengguna', 'Pengguna::tambahPengguna', ['filter' => 'otentifikasi']);
$routes->post('/simpan-pengguna', 'Pengguna::simpanPengguna');
$routes->get('/edit-pengguna/(:any)', 'Pengguna::editPengguna/$1', ['filter' => 'otentifikasi']);
$routes->post('/perbarui-pengguna/(:any)', 'Pengguna::simpanEditPengguna/$1');
$routes->get('/hapus-pengguna/(:any)', 'Pengguna::hapusPengguna/$1');

//penjualan
$routes->get('/transaksi-jual', 'TransaksiPenjualan::transaksi', ['filter' => 'otentifikasi']);
$routes->post('/simpan-transaksi', 'TransaksiPenjualan::transaksiSimpan');
$routes->get('/pembayaran', 'TransaksiPenjualan::simpanPembayaran');

//laporan stij
$routes->get('/laporan-stok', 'Stok::laporanStok');

//laporan penjualan
$routes->get('/laporan-penjualan', 'LaporanPenjualan::index');
$routes->post('/laporan-penjualan', 'LaporanPenjualan::generate_laporan_penjualan');

//cetak
$routes->get('/cetak-laporan-stok', 'CetakStok::generate');
$routes->get('/cetak-laporan-stok/(:num)', 'CetakStok::generate$1');
