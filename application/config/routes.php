<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route["default_controller"]	= "Awal";
$route["404_override"]			= "Galat/_404";
$route["translate_uri_dashes"]	= FALSE;

//API
$route["otentikasi"]        = "Otentikasi/index";
$route["otentikasi/masuk"]  = "Otentikasi/masuk";
$route["otentikasi/keluar"] = "Otentikasi/keluar";

$route["organisasi"]                = "Organisasi/index";
$route["organisasi/logo"]           = "Organisasi/logo";
$route["organisasi/perbarui"]       = "Organisasi/perbarui";
$route["organisasi/(:any)"]         = "Organisasi/lihat/$1";

$route["keanggotaan"]               = "Keanggotaan/index";
$route["keanggotaan/tambah"]        = "Keanggotaan/tambah";
$route["keanggotaan/perbarui"]      = "Keanggotaan/perbarui";
$route["keanggotaan/username"]      = "Keanggotaan/username";
$route["keanggotaan/password"]      = "Keanggotaan/password";
$route["keanggotaan/hapus"]         = "Keanggotaan/index";
$route["keanggotaan/hapus/(:any)"]  = "Keanggotaan/hapus/$1";
$route["keanggotaan/foto"]          = "Keanggotaan/foto";
$route["keanggotaan/(:any)"]        = "Keanggotaan/daftar/$1";
$route["keanggotaan/(:any)/(:any)"] = "Keanggotaan/lihat/$1/$2";

$route["divisi"]                = "Divisi/daftar";
$route["divisi/jabatan"]        = "Divisi/index";
$route["divisi/jabatan/(:num)"] = "Divisi/jabatan/$1";
$route["divisi/(:num)"]         = "Divisi/lihat/$1";

$route["keuangan"]                  = "Keuangan/index";
$route["keuangan/bulan/(:any)"]     = "Keuangan/bulan_daftar/$1";
$route["keuangan/tambah"]           = "Keuangan/tambah";
$route["keuangan/perbarui"]         = "Keuangan/perbarui";
$route["keuangan/hapus"]            = "Keuangan/index";
$route["keuangan/hapus/(:any)"]     = "Keuangan/hapus/$1";
$route["keuangan/lihat/(:num)"]     = "Keuangan/lihat/$1";
$route["keuangan/(:any)"]           = "Keuangan/daftar/$1";
$route["keuangan/(:any)/(:num)"]    = "Keuangan/daftar/$1/$2";

$route["jpendapat"]         = "JPendapat/daftar";
$route["jpendapat/simpan"]  = "JPendapat/simpan";

$route["kegiatan"]               = "Kegiatan/index";
$route["kegiatan/tambah"]        = "Kegiatan/tambah";
$route["kegiatan/perbarui"]      = "Kegiatan/perbarui";
$route["kegiatan/hapus"]         = "Kegiatan/index";
$route["kegiatan/hapus/(:any)"]  = "Kegiatan/hapus/$1";
$route["kegiatan/(:any)"]        = "Kegiatan/daftar/$1";
$route["kegiatan/(:any)/(:num)"] = "Kegiatan/lihat/$1/$2";

$route["berkas"]               = "Berkas/daftar";
$route["berkas/tambah"]        = "Berkas/tambah";
$route["berkas/perbarui"]      = "Berkas/perbarui";
$route["berkas/hapus"]         = "Berkas/index";
$route["berkas/hapus/(:any)"]  = "Berkas/hapus/$1";
$route["berkas/(:num)"]        = "Berkas/lihat/$1";

$route["artikel"]               = "Artikel/index";
$route["artikel/tambah"]        = "Artikel/tambah";
$route["artikel/hapus/(:num)"]  = "Artikel/hapus/$1";

$route["berita"]               = "Berita/index";
$route["berita/tambah"]        = "Berita/tambah";
$route["berita/hapus/(:num)"]  = "Berita/hapus/$1";

$route["galeri"]        = "Galeri/index";
$route["galeri/simpan"] = "Galeri/simpan";
$route["galeri/(:any)"] = "Galeri/lihat/$1";

$route["pengaturan"] = "Pengaturan/index";
$route["pengaturan/renew"] = "Pengaturan/renew";
$route["pengaturan/hapus/(:any)"] = "Pengaturan/hapus/$1";